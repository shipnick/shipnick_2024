<?php

namespace App\Console;

use App\Jobs\OrderStatusUpdate_ECOM;
use App\Jobs\OrderStatusUpdate_XPREBEE;
use App\Models\bulkorders;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('spnk:ecom_job')->name('status_update_ECOM')->description('Schedules status update job for orders in ECOM api')->everyThirtyMinutes();
        $schedule->command('spnk:xpressbee_job')->name('status_update_XPREBEE')->description('Schedules status update job for orders in Xpressbee api')->everyMinute();
        // Now start Job Queue Worker
        // $schedule->command('queue:work --queue=order_status --timeout=60 --tries=1 --once')->name('order_status_worker')->description("Process job from order_status queue")
        $schedule->command('queue:work --queue=order_status --timeout=240 --tries=3 --once --backoff=3 --stop-when-empty')->name('order_status_worker')->description("Process job from order_status queue")
        ->everyMinute()
        // ->withoutOverlapping()
        ->sendOutputTo(storage_path() . '/logs/order_status_jobs.log');

        $schedule->command('queue:retry')->hourly()->sendOutputTo(storage_path() . '/logs/job_retries.log');
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
