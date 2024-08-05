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

        // ECom order status update JOBs (In future this will be moved in Command)
        $schedule->call(function () {
            file_put_contents('order_status.txt', "Scheduling status_update_ECOM at " . date('c') . "\n");
            $params = bulkorders::where('awb_gen_by', 'Ecom') // Check if Awb_Number is not null
                ->whereNotIn('showerrors', ['Delivered'])
                ->where('order_cancel', '!=', 1)
                ->where('Awb_Number', '!=', '') // Assuming you want to order by this column
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'desc')
                ->get();

            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            echo 'ECom Total Jobs: ' . $params->count() . "\n";
            foreach ($params as $param) {
                 OrderStatusUpdate_ECOM::dispatch($param->toArray())->onQueue('order_status');
            }
        })->name('status_update_ECOM')->description('Schedules status update job for orders in ECOM api')->everyFourHours();

        // Xpressbee order status update JOBs (In future this will be moved in Command)
        $schedule->call(function () {
            file_put_contents('order_status.txt', "Scheduling status_update_ECOM at " . date('c') . "\n");
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
                ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                ->where('order_cancel', '!=', '1')
                ->where('Awb_Number', '!=', '')
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'desc')
                ->select('Awb_Number')
                ->get();

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            echo 'XPREBEE Total Jobs: ' . $orders->count() . "\n";
            foreach ($orders as $order) {
                OrderStatusUpdate_XPREBEE::dispatch($order->toArray())->onQueue('order_status');
            }

        })->name('status_update_XPREBEE')->description('Schedules status update job for orders in Xpressbee api')->everyFourHours();


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
