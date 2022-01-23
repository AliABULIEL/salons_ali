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
        Commands\SendSms::class,
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

        $hourInMinutes = 60;
        $dayInMinutes = $hourInMinutes * 24;
        
        $schedule->command('sms:send ' . $hourInMinutes)
                ->everyMinute()
                ->emailOutputTo( env('MAIL_USERNAME') );

        $schedule->command('sms:send ' . $dayInMinutes)
                ->everyMinute()
                ->emailOutputTo( env('MAIL_USERNAME') );
    }

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
