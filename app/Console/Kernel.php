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
        \CMV\Console\Commands\ImportPersonNotesFromPipelineCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
    }
}
