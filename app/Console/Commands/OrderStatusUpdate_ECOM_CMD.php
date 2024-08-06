<?php

namespace App\Console\Commands;

use App\Jobs\OrderStatusUpdate_ECOM;
use App\Models\bulkorders;
use Illuminate\Console\Command;

class OrderStatusUpdate_ECOM_CMD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spnk:ecom_job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates ECOM order status update jobs';

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
        $this->info("Scheduling status_update_ECOM at " . date('c') );
        
        $params = bulkorders::where('awb_gen_by', 'Ecom') // Check if Awb_Number is not null
            ->whereNotIn('showerrors', ['Delivered'])
            ->where('order_cancel', '!=', 1)
            ->where('Awb_Number', '!=', '') // Assuming you want to order by this column
            ->whereNotNull('Awb_Number')
            ->orderBy('Single_Order_Id', 'desc')
            ->get();

        if ($params->isEmpty()) {
            $this->info("No ECOM orders pending to update status");
            return 0;
        }
        $this->info('ECom Total Jobs: ' . $params->count());
        foreach ($params as $param) {
                OrderStatusUpdate_ECOM::dispatch($param->toArray())->onQueue('order_status');
        }
        $this->info("ECom Queue completed.");
        return 0;
    }
}
