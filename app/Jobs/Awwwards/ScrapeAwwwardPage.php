<?php

namespace CMV\Jobs\Awwwards;

use CMV\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeAwwwardPage extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /** @var integer */
    protected $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    public function queue($queue, $command)
    {
        $queue->pushOn('awards_scraper', $command);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $res = $client->post('http://www.awwwards.com/directory/search/', [
            'body' => [
                'numItems' => $this->page*30,
            ],
            'headers' => [
                'Host' => 'www.awwwards.com',
                'Origin' => 'http://www.awwwards.com',
                'Referer' => 'http://www.awwwards.com/directory/search/',
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36',
                'X-Requested-With' => 'XMLHttpRequest',
            ]
        ]);

        $html = @(new Crawler((string) $res->getBody()));

        foreach ($html->filter('a.url-profile') as $node) {
            /** @var \DOMElement $node */
            $username = trim($node->getAttribute('href'), '/');
            $this->dispatch(new ScrapeAwwwardProfile(trim($username)));
        }
    }
}
