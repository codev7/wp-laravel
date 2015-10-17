<?php

namespace CMV\Console\Commands;

use CMV\Jobs\Awwwards\ScrapeAwwwardPage;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ScrapeAwwwards extends Command
{
    use DispatchesJobs;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:awwwards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // there are ~8.2k meaningful items (the other ones are either spamers or empty users)
        // each page has 30 companies/freelancers
        // equals 266 + 266 * 30 (* 2 if scrape skype) = 16226 requests
        // this console commands dispatches AwwwardPageCommand which in its turn dispatches AwwwardProfileCommand
        $pages = floor(8200/15);
        for ($i=0; $i<=$pages; $i++) $this->dispatch(new ScrapeAwwwardPage($i));
    }
}
