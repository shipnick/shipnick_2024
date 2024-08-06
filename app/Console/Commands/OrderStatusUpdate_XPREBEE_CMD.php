<?php

namespace App\Console\Commands;

use App\Jobs\OrderStatusUpdate_XPREBEE;
use App\Models\bulkorders;
use Illuminate\Console\Command;

class OrderStatusUpdate_XPREBEE_CMD extends Command
{
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
        $this->comment("Creating ECOM order status update jobs");
        $this->info("Scheduling status_update_XPREBEE at " . date('c') );
        $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
            ->whereNotIn('showerrors', ['delivered', 'cancelled'])
            ->where('order_cancel', '!=', '1')
            ->where('Awb_Number', '!=', '')
            ->whereNotNull('Awb_Number')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number')
            ->limit(1000)
            ->get();

        if ($orders->isEmpty()) {
            $this->info("No EXpressBee orders pending to update status");
            return 0;
        }

        $this->info('EXpressBee Total Jobs: ' . $orders->count());
        foreach ($orders as $order) {
            OrderStatusUpdate_XPREBEE::dispatch($order->toArray())->onQueue('order_status');
        }
        $this->info("EXpressBee Queue completed.");
        return 0;
    }
}
