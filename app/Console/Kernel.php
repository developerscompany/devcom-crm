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
         $schedule->exec('git pull https://djkey245:meyson1998@github.com/developerscompany/devcom-crm.git master --force')->dailyAt('16:00');
         $schedule->exec(' git merge --abort')->dailyAt('15:50');
         $schedule->exec('/usr/local/php71/bin/php /usr/local/bin/composer install')->daily()->fridays();
         $schedule->exec('/usr/local/php71/bin/php artisan migrate')->daily()->fridays();
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
