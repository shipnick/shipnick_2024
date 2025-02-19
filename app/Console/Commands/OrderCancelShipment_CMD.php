<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\bulkorders;
use Carbon\Carbon;

class OrderCancelShipment_CMD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spnk:cancel-order1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Places shipment order cancel';

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
        try {
            $this->info("Cancle orders...");
            $orders = bulkorders::where('order_cancel', '1')
                ->orderby('Single_Order_Id', 'DESC')
                ->where('Awb_Number'.'!=','')
                ->where('Last_Time_Stamp', '>=', Carbon::now()->subDays(30))
                ->where('order_cancel_reasion',NULL) 
                // ->limit(80)
                ->get();
            $this->info("Total orders:" . count($orders));


            


            $loopno = 0;
            $data = [];
            foreach ($orders as $param) {
                // echo "<br>".$param->orderno;
                $loopno++;
                // echo "<br><br><br>Current Loop NO is $loopno <br><br>";

                $crtidis = $param->Single_Order_Id;

                if ($param->Single_Order_Id == 'Bluedart')
                {
                    $data = [
                        
                        'Awb_Number'=>$param->Awb_Number
                    ];
                    $jobClass = 'App\\Jobs\\OrderCancel_BluedartJob';
                        $this->comment('Dispatching ' . $jobClass);
                        $jobClass::dispatch($data)->onQueue('cancel-order');

                }
                if ($param->Single_Order_Id == 'EkartRS')
                {
                    $data = [
                        
                        'Awb_Number'=>$param->Awb_Number
                    ];
                    $jobClass = 'App\\Jobs\\OrderCancel_BluedartJob';
                        $this->comment('Dispatching ' . $jobClass);
                        $jobClass::dispatch($data)->onQueue('cancel-order');

                }
                if ($param->Single_Order_Id == 'Xpressbee')
                {
                    $data = [
                        
                        'Awb_Number'=>$param->Awb_Number
                    ];
                    $jobClass = 'App\\Jobs\\OrderCancel_BluedartJob';
                        $this->comment('Dispatching ' . $jobClass);
                        $jobClass::dispatch($data)->onQueue('cancel-order');

                }
                


               
               
                
               

                // Removed due to slow update
                // UtilityHelper::updateBalance($param);
            }
        } catch (\Exception $e) {
            $msg = __FILE__ . ":LINE:" . $e->getLine()  . " MSG: " . $e->getMessage();
            Log::info($msg);
            $this->error($msg);
        }
        return 0;
    }
}
