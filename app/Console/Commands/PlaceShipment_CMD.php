<?php

namespace App\Console\Commands;

use App\Helper\UtilityHelper;
use App\Models\bulkorders;
use App\Models\courierpermission;
use App\Models\OrderStatusLabel;
use App\Models\orderdetail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PlaceShipment_CMD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spnk:place-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Places shipment order and gets AWB number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public const API_PROVIDER = [
        'smp01' => 'SmartShip',
        'ecom01' => 'ECom',           // p=2
        'xpressbee0' => 'XPressBee0',  // p=1
        'xpressbee02' => 'XPressBee02', // p=1
        'xpressbee03' => 'XPressBee03', // p=1
        'bluedart01' => 'Shipclues',  // p=3
        'bluedart0' => 'BlueDart',    // p=3
    ];
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->info("Placing orders...");
            $orders = bulkorders::where('apihitornot', '0')
                ->orderby('Single_Order_Id', 'DESC')
                // ->limit(80)
                ->get();
            $this->info("Total orders:" . count($orders));


            // Update Selected Orders To Generate A AWB Number
            foreach ($orders as $order) {
                $crtidis = $order->Single_Order_Id;
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 1]);
            }
            // Update Selected Orders To Generate A AWB Number


            $loopno = 0;
            $data = [];
            foreach ($orders as $param) {
                // echo "<br>".$param->orderno;
                $loopno++;
                // echo "<br><br><br>Current Loop NO is $loopno <br><br>";

                $crtidis = $param->Single_Order_Id;
                $paymentmode = $param->Order_Type;
                $userid = $param->User_Id;


                if (empty($paymentmode)) {
                    $paymentmode = "COD";
                }
                if ($paymentmode == "Prepaid") {
                    $paymentmode = "prepaid";
                }
                $orderno = $param->ordernoapi;
                $autogenorderno = $param->ordernoapi;
                $iacwt = 0;
                // Destination Address
                $daname = $param->Name;
                $daadrs = $param->Address;
                $daadrs2 = $param->Address2;
                $dastate = $param->State;
                $dacity = $param->City;
                $damob = $param->Mobile;
                $dapin = $param->Pincode;
                // Destination Address
                // Product Details
                $iname = $param->Item_Name;
                $iqlty = $param->Quantity;
                $iwith = $param->Width;
                $ihght = $param->Height;
                $ilgth = $param->Length;
                $iacwt = $param->Actual_Weight;
                $ivlwt = $param->volumetric_weight;
                $itamt = $param->Total_Amount;
                $iival = $param->Invoice_Value;
                $icoda = $param->Cod_Amount;
                $iadin = $param->additionaltype;
                // Product Details
                $param->Rec_Time_Stamp;
                $idate = $param->Rec_Time_Date;
                // WareHouse / Pickup Details
                $pkpkid = $param->pickup_id;
                $pkpkname = $param->pickup_name;
                $pkpkmble = $param->pickup_mobile;
                $pkpkpinc = $param->pickup_pincode;
                $pkpkaddr = $param->pickup_address;
                $pkpkstte = $param->pickup_state;
                $pkpkcity = $param->pickup_city;
                // WareHouse / Pickup Details

                // Next Line Data Convert in One Line
                $daname = trim(preg_replace("/\s+/", " ", $daname));
                $daadrs = trim(preg_replace("/\s+/", " ", $daadrs));
                $iname = trim(preg_replace("/\s+/", " ", $iname));
                $pkpkname = trim(preg_replace("/\s+/", " ", $pkpkname));
                $pkpkaddr = trim(preg_replace("/\s+/", " ", $pkpkaddr));
                // Next Line Data Convert in One Line


                // Order Place Courier Checking
                $courierassigns = courierpermission::where('user_id', $userid)
                    // ->where('courier_priority', '!=', '0')
                    ->where('courier_priority',  '1')
                    ->where('admin_flg', '1')
                    ->where('user_flg', '1')
                    ->orderby('courier_priority', 'asc')
                    ->get();
                $abc = 0;
                $finalcouriers = array();
                $finalcourierlists = array();
                foreach ($courierassigns as $courierassign) {
                    // $couriername = $courierassign['courier_code'];
                    $courieridno = $courierassign['courier_idno'];
                    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
                    array_push($finalcourierlists, "$courieridno");
                }
                $this->info("Payment mode: " . $paymentmode);
                foreach ($finalcourierlists as $courierapicodeno) {
                    // $this->info($courierapicodeno);
                    // start check wallet balance is low or not 
                    

                   
                        $data = [
                            'crtidis' => $crtidis,
                            'paymentmode' => $paymentmode,
                            'damob' => $damob,
                            'iacwt' => $iacwt,
                            'autogenorderno' => $autogenorderno,
                            'itamt' => $itamt,
                            'ilgth' => $ilgth,
                            'iwith' => $iwith,
                            'ihght' => $ihght,
                            'iadin' => $iadin,
                            'daname' => $daname,
                            'daadrs' => $daadrs,
                            'daadrs2' => $daadrs2,
                            'dacity' => $dacity,
                            'dastate' => $dastate,
                            'dapin' => $dapin,
                            'pkpkname' => $pkpkname,
                            'pkpkaddr' => $pkpkaddr,
                            'pkpkcity' => $pkpkcity,
                            'pkpkstte' => $pkpkstte,
                            'pkpkpinc' => $pkpkpinc,
                            'pkpkmble' => $pkpkmble,
                            'iname' => $iname,
                            'iqlty' => $iqlty,
                            'itamt' => $itamt,
                            'iival' => $iival,
                            'icoda' => $icoda,
                            'userid' => $userid,
                            'iacwt' => $iacwt,
                            'idate' => $idate,
                            'ecomdate' => $ecomdate = date_create($idate),
                            'data' => $data,
                            'orderno' => $orderno,
                            'ivlwt' => $ivlwt,
                            'invicedateecom' => $invicedateecom = date_format($ecomdate, "d-m-Y"),
                            'pkpkid' => $pkpkid,
                        ];

                        $jobClass = 'App\\Jobs\\' . self::API_PROVIDER[$courierapicodeno] . '_PlaceOrderJob';
                        $this->comment('Dispatching ' . $jobClass);
                        $jobClass::dispatch($data)->onQueue('place_order');
                    
                    // end check wallet balance check 

                    // Used to create JobFiles for provider
                    // $jobClassPrefix = self::API_PROVIDER['bluedart01'];
                    // $this->call('make:job', [
                    //     'name' => $jobClassPrefix . '_PlaceOrderJob'
                    // ]);
                    // dd($jobClassPrefix);




                    // if ($courierapicodeno == "smp01") {
                    // }elseif($courierapicodeno == "ecom01") {

                    // }
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