<?php

namespace App\Console;

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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
     //   $schedule->command('backup:run')->dailyAt('14:39')->timezone('Europe/Paris');
        $schedule->command('backup:clean')->dailyAt('01:30');
        $schedule->command('backup:run')->dailyAt('02:00');

//            ->onFailure(function () {
//                ...
//            })
//            ->onSuccess(function () {
//                ...
//            });
    }

//    /**
//     * Get the timezone that should be used by default for scheduled events.
//     *
//     * @return \DateTimeZone|string|null
//     */
//    protected function scheduleTimezone()
//    {
//        return 'Africa/Cairo';
//    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

