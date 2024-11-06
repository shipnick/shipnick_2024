<?php

namespace App\Jobs;

use App\Console\Commands\PlaceShipment_CMD;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use App\Models\BulkPincode;
use App\Models\courierpermission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ECom_PlaceOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // $this->onQueue('place_order_xpressbee');
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            extract($this->data);


            echo "<br>Ecom Start<br>";
            $thisgenerateawbno = "";
            // Ecom Section Start
            error_reporting(1);
            // Ecom Order Place
            $picodematch = BulkPincode::where('pincode', $dapin)->where('courier', 'ecom')->exists();

            if ($picodematch) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073', 'password' => 'lnR1C8NkO1', 'count' => '1', 'type' => 'EXPP'),
                ));

                $response = curl_exec($curl);
                $response = json_decode($response, true);

                curl_close($curl);


                // echo "<br><pre>";
                // print_r(($response));
                // echo "</pre><br>";

                echo "<br>";
                echo $ecomawbnois = $response['awb']['0'];
                echo "<br>";



                echo $idate;
                echo "<br>";
                $ecomdate = date_create($idate);
                echo "<br>";
                echo $invicedateecom = date_format($ecomdate, "d-m-Y");
                echo "<br>";



                echo "ecom manifest";
                echo "<br>";

                if ($paymentmode == 'prepaid') {
                    $paymentmode = "PPD";
                }
                echo $paymentmode;

                echo "<br><pre>";
                print_r(($data));
                echo "</pre><br>";


                // URL of the endpoint
                $url = 'https://shipment.ecomexpress.in/services/expp/manifest/v2/expplus/';

                // Data to be sent in the POST request
                $postData = array(
                    'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                    'password' => 'lnR1C8NkO1',
                    'json_input' => json_encode(array(
                        array(
                            "AWB_NUMBER" => "$ecomawbnois",
                            "ORDER_NUMBER" => "$orderno",
                            "PRODUCT" => "$paymentmode",
                            "CONSIGNEE" => "$daname",
                            "CONSIGNEE_ADDRESS1" => "$daadrs",
                            "CONSIGNEE_ADDRESS2" => "",
                            "CONSIGNEE_ADDRESS3" => "",
                            "DESTINATION_CITY" => "$dacity",
                            "PINCODE" => "$dapin",
                            "STATE" => "$dastate",
                            "MOBILE" => "$damob",
                            "TELEPHONE" => "$damob",
                            "ITEM_DESCRIPTION" => "$iname",
                            "PIECES" => $iqlty,
                            "COLLECTABLE_VALUE" => $icoda,
                            "DECLARED_VALUE" => $itamt,
                            "ACTUAL_WEIGHT" => $iacwt,
                            "VOLUMETRIC_WEIGHT" => $ivlwt,
                            "LENGTH" => $ilgth,
                            "BREADTH" => $iwith,
                            "HEIGHT" => $ihght,
                            "PICKUP_NAME" => "$pkpkname",
                            "PICKUP_ADDRESS_LINE1" => "$pkpkaddr",
                            "PICKUP_ADDRESS_LINE2" => "",
                            "PICKUP_PINCODE" => "$pkpkpinc",
                            "PICKUP_PHONE" => "$pkpkmble",
                            "PICKUP_MOBILE" => "$pkpkmble",
                            "RETURN_NAME" => "$pkpkname",
                            "RETURN_ADDRESS_LINE1" => "$pkpkaddr",
                            "RETURN_ADDRESS_LINE2" => "",
                            "RETURN_PINCODE" => "$pkpkpinc",
                            "RETURN_PHONE" => "$pkpkmble",
                            "RETURN_MOBILE" => "",
                            "DG_SHIPMENT" => "false",
                            "ADDITIONAL_INFORMATION" => array(
                                "GST_TAX_CGSTN" => 0,
                                "GST_TAX_IGSTN" => 0,
                                "GST_TAX_SGSTN" => 0,
                                "SELLER_GSTIN" => "",
                                "INVOICE_DATE" => "$orderno",
                                "INVOICE_NUMBER" => "$invicedateecom",
                                "GST_TAX_RATE_SGSTN" => 0,
                                "GST_TAX_RATE_IGSTN" => 0,
                                "GST_TAX_RATE_CGSTN" => 0,
                                "GST_HSN" => "",
                                "GST_TAX_BASE" => 0,
                                "GST_ERN" => "",
                                "ESUGAM_NUMBER" => "",
                                "ITEM_CATEGORY" => "",
                                "GST_TAX_NAME" => "",
                                "ESSENTIALPRODUCT" => "Y",
                                "PICKUP_TYPE" => "",
                                "OTP_REQUIRED_FOR_DELIVERY" => "Y",
                                "RETURN_TYPE" => "WH",
                                "GST_TAX_TOTAL" => 0,
                                "SELLER_TIN" => "",
                                "CONSIGNEE_ADDRESS_TYPE" => "",
                                "CONSIGNEE_LONG" => "1.4434",
                                "CONSIGNEE_LAT" => "2.987"
                            )
                        )
                    ))
                );

                // Initialize cURL session
                $curl = curl_init($url);

                // Set the POST method
                curl_setopt($curl, CURLOPT_POST, true);

                // Set the POST data
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

                // Return the response instead of outputting it
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                // Execute the request
                $response = curl_exec($curl);
                $responseecom = json_decode($response, true);


                // Close cURL session
                curl_close($curl);

                // echo "<br><pre>";
                // print_r(($responseecom));
                // echo "</pre><br>";



                // // echo "<br>* -   *   -  Start *   -   *   -   <br>";
                // echo "<br>";
                // print_r($responseecom);
                // echo "<br>* -   *   -   End *   -   *   -   <br>";
                // exit();



                if ($responseecom['shipments'][0]['success']) {
                    echo "<br>if section <br>";
                    $ecomawbnois = $responseecom['shipments'][0]['awb'];
                    $carrierby = "Ecom";
                    $ecomorderid = $responseecom['shipments'][0]['order_number'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                        'courier_ship_no' => $ecomorderid,
                        'Awb_Number' => $ecomawbnois,
                        'awb_gen_by' => $carrierby,
                        'awb_gen_courier' => 'Ecom',
                        'showerrors' => 'pending pickup',
                        'order_status_show' => 'pending pickup'
                    ]);

                    $param = bulkorders::where('Single_Order_Id', $crtidis)->first();

                    $zone = $param->zone;
                    $userid = $param->User_Id;
                    $courier = $param->awb_gen_by;
                    $awb = $param->Awb_Number;
                    $idnew = $param->Single_Order_Id;
                    $date = $param->Rec_Time_Date;


                    // Fetch credit details
                    $credit = price::where('user_id', $userid)
                        ->where('name', $courier)
                        ->first();

                    if (!$credit) {
                        $credit = price::where('status', 'defult')
                            ->where('name', $courier)
                            ->first();
                        // Handle the case where no credit record is found
                        // Log an error, skip this record, etc.
                        // continue;
                    }

                    // Assign credit based on zone
                    if ($zone == 'A') {
                        $credit1 = $credit->fwda;
                    }
                    if ($zone == 'B') {
                        $credit1 = $credit->fwdb;
                    }
                    if ($zone == 'C') {
                        $credit1 = $credit->fwdc;
                    }
                    if ($zone == 'D') {
                        $credit1 = $credit->fwdd;
                    }
                    if ($zone == 'E') {
                        $credit1 = $credit->fwde;
                    }

                    $transactionCode = "TR00" . $idnew;


                    // Fetch the most recent balance record for the given user
                    $blance = orderdetail::where('user_id', $userid)
                        ->orderBy('orderid', 'DESC')
                        ->first();

                    // Initialize $close_blance with $credit1
                    $close_blance = -$credit1;

                    // Check if a balance record exists and update $close_blance accordingly
                    if ($blance && isset($blance->close_blance)) {
                        // Ensure close_blance is a number, default to 0 if null
                        $previous_blance = $blance->close_blance ?? 0;
                        $close_blance = $previous_blance - $credit1;
                    }
                    // dd($transactionCode,$credit1,$awb , $close_blance,$date);
                    // Create a new order detail record
                    $wellet = new orderdetail;
                    $wellet->debit = $credit1;
                    $wellet->awb_no = $awb;
                    $wellet->date = $date;
                    $wellet->user_id =  $userid;
                    $wellet->transaction = $transactionCode;
                    $wellet->close_blance = $close_blance;
                    $wellet->save();

                    bulkorders::where('Awb_Number', $awb)->update(['shferrors' => 1]);
                } else {
                    $this->ifErrorThenNextApi();
                    echo "<br>else section <br>";
                    $errormsg = $responseio['response'];
                    $errormsg = "Ecom internal error 500";
                    if (!empty($responseecom['shipments'][0]['reason'])) {
                        $errormsg = $responseecom['shipments'][0]['reason'];
                    } elseif ($eominvalidawbs == "2") {
                        $errormsg = "Awb not found";
                    } else {
                        $errormsg = "Ecom internal error 500";
                    }
                }
            }else {
                $this->ifErrorThenNextApi();
                Log::info("picodematch empty");
            }
            // Ecom Order Place End //
            // Ecom Section End
            // echo "<br>Ecom End<br>";

            // if ($thisgenerateawbno) {
            //     break;
            // }
        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            $this->ifErrorThenNextApi();
            $this->fail($th);
            throw $th;
        }
    }

    public function ifErrorThenNextApi()
    {
        try {
            extract($this->data);
            $courierassigns = courierpermission::where('user_id', $userid)
                ->where('courier_priority', '!=', '0')
                ->where('admin_flg', '1')
                ->where('user_flg', '1')
                ->orderby('courier_priority', 'asc')
                ->pluck('courier_idno');
            // dd($courierassigns);

            // Find the index of 'ecom01'
            $index = $courierassigns->search('ecom01');

            // Check if 'ecom01' was found and if there is a next value
            if ($index !== false && $index + 1 < $courierassigns->count()) {
                // Get the next value after 'ecom01'
                $nextCourier = $courierassigns[$index + 1]; //  'xpressbee0'
                // PlaceShipment_CMD::API_PROVIDER['xpressbee0']

                $jobClass = 'App\\Jobs\\' . PlaceShipment_CMD::API_PROVIDER[$nextCourier] . '_PlaceOrderJob';
                Log::info('Dispatching ' . $jobClass);
                $jobClass::dispatch($this->data)->onQueue('place_order');
            }else{
                Log::info("No courier provider");
            }
        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            throw $th;
        }
    }
}
