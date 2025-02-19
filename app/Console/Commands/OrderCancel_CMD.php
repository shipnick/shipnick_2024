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
    protected $description = 'cancel shipment order';

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
        $this->comment("cancel  order status update jobs");

        // avoid adding same jobs if queue is not empty
        $jobsCount = Queue::size(self::QUEUE_NAME);
        if ($jobsCount > 0) {
            $this->comment("Queue [" . self::QUEUE_NAME . "] is not empty so not adding jobs.");
            return 0;
        }
        $this->info("Scheduling cancel orders at " . date('c'));
        $orders = bulkorders::where('order_cancel',  '1')
            ->whereNull('order_cancel_reasion')
            ->whereNoNull('Awb_Number')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number','courier_ship_no','awb_gen_courier','ordernoapi','awb_gen_by')
            ->get();

        if ($orders->isEmpty()) {
            $this->info("No EXpressBee orders pending to update status");
            return 0;
        }

        $this->info('EXpressBee Total Jobs: ' . $orders->count());
        foreach ($orders as $order) {
            if($order->awb_gen_by == 'Bluedart'){
                OrderCancel_BluedartJob::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
            }
            if($order->awb_gen_by == 'EkartRS')
            {
                OrderCancel_RapidShipJob::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
            }
            if($order->awb_gen_by == 'Xpressbee')
            {
                OrderCancel_XpresbeeJob::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
            }

            
        }
        $this->info("EXpressBee Queue completed.");
        return 0;
    }
}
