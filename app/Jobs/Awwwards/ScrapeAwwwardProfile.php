<?php

namespace CMV\Jobs\Awwwards;

use CMV\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use CMV\Awwwcategory;
use Guzzle\Plugin\Cookie\CookieJar\CookieJarInterface;
use GuzzleHttp\Client,
    Guzzle\Plugin\Cookie\Cookie,
    Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;

use CMV\Awwward;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeAwwwardProfile extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var string
     */
    protected $username;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->job->attempts() > 2) {
            return $this->job->delete();
        }
        $client = new Client;

        $res = $client->get('http://www.awwwards.com/' . $this->username);
        $crawler = new Crawler($res->getBody()->__toString());

        $aw = Awwward::firstOrNew(['username' => $this->username]);

        $aw->name = $crawler->filter('h1 a')->first()->html();

        $nodes = $crawler->filter('.info .n-1 a[target=_blank]');
        $aw->site_url = $nodes->count() ? $nodes->first()->html() : null;

        $nodes = $crawler->filter('.info .twitter a');
        $aw->twitter = $nodes->count() ? $nodes->first()->html() : null;
        $nodes = $crawler->filter('.info .googleplus a');
        $aw->gplus = $nodes->count() ? $nodes->first()->html() : null;
        $nodes = $crawler->filter('.info .facebook a');
        $aw->facebook = $nodes->count() ? $nodes->first()->html() : null;
        $nodes = $crawler->filter('.info .linkedin a');
        $aw->linkedin = $nodes->count() ? $nodes->first()->html() : null;

        $nodes = $crawler->filter('.info .n-1')->children();
        $location = explode('-', $nodes->count() > 2 ? $nodes->getNode(2)->nodeValue : '');
        $aw->country = isset($location[0]) && $location[0] ? trim($location[0]) : null;
        $aw->city = isset($location[1]) ? trim($location[1]) : null;
        $aw->karma = $crawler->filter('.karma')->first()->html();

        $categories = [];
        foreach ($crawler->filter('.n-2 .list-tags a') as $node) {
            $categories[] = Awwwcategory::firstOrCreate(['name' => html_entity_decode((new Crawler($node))->html())]);
        }

        // probably will need to implement auth request to make the cookies dynamic
        $cookies = [
            'vuserhash' => 'MzQwNzEyOmFVNk1xS0FOcFJoWUN6aXFKeW1NcWVvb0E1NGY3R0xKcHhaRGhHWGNwd0hHbzBSL20zWkRiVUJqTE9JdHIxV2FwbVVnaC9uOXpVZTVQMUVUUVFYNjRnPT0%3D',
            'REMEMBERME' => 'VFZcQ29yZUJ1bmRsZVxFbnRpdHlcVXNlcjpZblY2Wkhsclp3PT06MTQzNjE2NzIzMzo2NDdiMzIwYmRlNTUyZGIxMDk1MTE0N2VlZjExNjFkZmU5ZDlmZTgzZjgzNTNjNmQzZmVhNTJjMWVmYzI2Nzk2',
            'PHPSESSID' => 'd40i6f5g9c8vsjivlbgseg5bb4',
        ];

        $res = $client->get('http://www.awwwards.com/'  .$this->username . '/contact', [
            'cookies' => $cookies
        ]);

        $crawler = new Crawler($res->getBody()->__toString());
        $nodes = $crawler->filter('.ico-skype');
        $aw->skype = $nodes->count() ?
            str_replace(['skype:', '?call'], '', $nodes->first()->attr('href')) :
            null
        ;

        $aw->save();
        $aw->categories()->sync(collect($categories)->lists('id'));
    }
}
