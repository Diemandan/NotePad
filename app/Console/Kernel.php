<?php

namespace App\Console;

use App\Jobs\Congratulation;
use App\Jobs\RemindMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notepad:dump')->cron('* * * * *');
        $schedule->job(new RemindMail)->cron('*/40 18-21 * * *');
        
        if (env('CONGRATULATE_WITH_BIRTHDAY')) {
            $schedule->job(new Congratulation)->cron('1 0 * * *');
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
