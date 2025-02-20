<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;
use App\Models\bulkorders;
use App\Jobs\OrderCancel_RapidShipJob;
use App\Jobs\OrderCancel_BluedartJob;
use App\Jobs\OrderCancel_XpresbeeJob;

class OrderCancel_CMD extends Command
{
    private const QUEUE_NAME = 'o_cancel_orders';
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spnk:cancel-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel shipment order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment("Canceling order status update jobs");

        // Avoid adding the same jobs if the queue is not empty
        $jobsCount = Queue::size(self::QUEUE_NAME);
        if ($jobsCount > 0) {
            $this->comment("Queue [" . self::QUEUE_NAME . "] is not empty, so not adding jobs.");
            return 0;
        }

        $this->info("Scheduling cancel orders at " . \Carbon\Carbon::now()->toIso8601String());
        
        // Fetch orders to be canceled
        $orders = bulkorders::where('order_cancel', '1')
            ->whereNull('order_cancel_reason')
            ->whereNotNull('Awb_Number')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'courier_ship_no', 'awb_gen_courier', 'ordernoapi', 'awb_gen_by')
            ->get();

        // Check if there are no orders to process
        if ($orders->isEmpty()) {
            $this->info("No ExpressBee orders pending to update status.");
            return 0;
        }

        $this->info('ExpressBee Total Jobs: ' . $orders->count());

        // Loop through orders and dispatch corresponding jobs
        foreach ($orders as $order) {
            switch ($order->awb_gen_by) {
                case 'Bluedart':
                    OrderCancel_BluedartJob::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
                    break;

                case 'EkartRS':
                    OrderCancel_RapidShipJob::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
                    break;

                case 'Xpressbee':
                    OrderCancel_XpresbeeJob::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
                    break;

                default:
                    $this->info("No matching job for AWB generated by: " . $order->awb_gen_by);
                    break;
            }
        }

        $this->info("ExpressBee Queue processing completed.");
        return 0;
    }
}
