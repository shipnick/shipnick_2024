<?php

namespace App\Console\Commands;

use App\Jobs\OrderStatusUpdate_XPREBEE;
use App\Models\bulkorders;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class OrderStatusUpdate_XPREBEE_CMD extends Command
{
    private const QUEUE_NAME = 'o_status_xpressbee';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spnk:xpressbee_job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates XPressBee order status update jobs';

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
        $this->comment("Creating XPressBee order status update jobs");

        // avoid adding same jobs if queue is not empty
        $jobsCount = Queue::size(self::QUEUE_NAME);
        if($jobsCount > 0){
            $this->comment("Queue [". self::QUEUE_NAME . "] is not empty so not adding jobs.");
        }
        return 0;

        $this->info("Scheduling status_update_XPREBEE at " . date('c') );

        $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
            ->whereNotIn('showerrors', ['delivered', 'cancelled'])
            ->where('order_cancel', '!=', '1')
            ->where('Awb_Number', '!=', '')
            ->whereNotNull('Awb_Number')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number')
            ->get();

        if ($orders->isEmpty()) {
            $this->info("No EXpressBee orders pending to update status");
            return 0;
        }

        $this->info('EXpressBee Total Jobs: ' . $orders->count());
        foreach ($orders as $order) {
            OrderStatusUpdate_XPREBEE::dispatch($order->toArray())->onQueue(self::QUEUE_NAME);
        }
        $this->info("EXpressBee Queue completed.");
        return 0;
    }
}
