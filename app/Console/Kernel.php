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
                //   ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection','Shipment Not Handed over'])
                // ->whereIn('showerrors', ['Shipment Not Handed over'])
                // ->where('Rec_Time_Date', '2024-07-24')  
                // ->where('User_Id', '109')
                // ->where('User_Id', '122')
                ->where('order_status', 'upload')
                ->where('order_cancel', '!=', 'upload')
                ->where('Awb_Number', '!=', '') // Assuming you want to order by this column
                ->orderBy('Single_Order_Id', 'desc')
                // ->limit(5)
                ->get();
            //  dd($params);


            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            echo 'ECom Total Jobs: ' . $params->count() . "\n";
            foreach ($params as $param) {
                 OrderStatusUpdate_ECOM::dispatch($param->toArray())->onQueue('order_status');
            }
        })->name('status_update_ECOM')->description('Schedules status update job for orders in ECOM api')->everyFiveMinutes();

        // Xpressbee order status update JOBs (In future this will be moved in Command)
        $schedule->call(function () {
            file_put_contents('order_status.txt', "Scheduling status_update_ECOM at " . date('c') . "\n");
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
                //   ->where('User_Id', '109')
                //   ->where('User_Id', '!=', '109')
                //   ->where('Rec_Time_Date', '2024-07-24')
                // ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                // ->whereIn('showerrors', ['pending pickup'])
                ->where('order_status', '1')
                ->where('order_cancel', '!=', '1')
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'desc')
                // ->limit(80)
                ->select('Awb_Number')
                ->get();

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            set_time_limit(300);
            $completedOrders = 0;
            echo 'XPREBEE Total Jobs: ' . $orders->count() . "\n";
            foreach ($orders as $order) {
                OrderStatusUpdate_XPREBEE::dispatch($order->toArray())->onQueue('order_status');
            }
        })->name('status_update_XPREBEE')->description('Schedules status update job for orders in Xpressbee api')->everyFourMinutes();


        // Now start Job Queue Worker
        $schedule->command('queue:work --queue=order_status --timeout=60 --tries=1 --once')
        ->everyMinute()
        ->withoutOverlapping()
        ->sendOutputTo(storage_path() . '/logs/order_status_jobs.log');
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
