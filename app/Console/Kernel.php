<?php

namespace App\Console;

use App\Jobs\OrderStatusUpdate_ECOM;
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

        $schedule->call(function () {
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

            foreach ($params as $param) {
                $schedule->job(new OrderStatusUpdate_ECOM($param->toArray()), 'order_status');
                // OrderStatusUpdate_ECOM::dispatch($param->toArray())->onQueue('order_status');
            }
        })->name('status_update_ECOM')->description('Schedules status update job for orders in ECOM api')->hourly();
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
