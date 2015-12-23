<?php

namespace CMV\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \CMV\Console\Commands\Inspire::class,
        \CMV\Console\Commands\ScrapeAwwwards::class,
        \CMV\Console\Commands\Prospector\ImportCompaniesAndContactsFromCSV::class,
        \CMV\Console\Commands\Prospector\ImportDataFromPipelineDeals::class,
        \CMV\Console\Commands\PM\InitProjectOnStaging::class,
        \CMV\Console\Commands\PM\DeployProjectOnStaging::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * This creates a backup of the production DB on s3.
         */
        $schedule->command('backup:run --only-db')
            ->dailyAt('23:21');
//            ->thenPing('http://beats.envoyer.io/heartbeat/Ris6PH8ssc8hlPs');

    }
}