<?php

namespace App\Jobs;

use App\Models\bulkorders;
use App\Models\Hubs;
use App\Models\smartship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SmartShip_PlaceOrderJob implements ShouldQueue
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

            echo "<br>smartship Start<br>";
            $thisgenerateawbno = "";

            // smartshiptoken and warehouse shmartship id 
            $smartshiptoken = smartship::where('id', 1)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                // continue;
                return 0;
            }

            // smartship api start Order Place
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.smartship.in/v2/app/Fulfillmentservice/orderRegistrationOneStep',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{

                "request_info":{
                "client_id":"ICIFAAXT1E8ILA22TUGZ0ZPPJ97VURWKRRUW6ZAB",
                "run_type":"create"
                },
                "orders":[
                {
                "client_order_reference_id":"' . $autogenorderno . '",
                "shipment_type":1,
                "order_collectable_amount":"' . $icoda . '",
                "total_order_value":"1",
                "payment_type":"' . $paymentmode . '",
                "package_order_weight":"' . $iacwt . '",
                "package_order_length":"' . $ilgth . '",
                "package_order_height":"' . $ihght . '",
                "package_order_width":"' . $iwith . '",
                "shipper_hub_id":"' . $warehouseid . '",
                "shipper_gst_no":"",
                "order_invoice_date":"' . $idate . '",
                "order_invoice_number":"' . $orderno . '",
                "is_return_qc":"0",
                "return_reason_id":"0",
                "order_meta":{
                "preferred_carriers":[
                1,
                3,
                279
                ]
                },
                "product_details":[
                {
                "client_product_reference_id":"' . $iival . '",
                "product_name":"' . $iname . '",
                "product_category":"none",
                "product_hsn_code":"' . $orderno . '",
                "product_quantity":"' . $iqlty . '",
                "product_invoice_value":"' . $iival . '",
                "product_gst_tax_rate":"0",
                "product_taxable_value":"0",
                "product_sgst_amount":"0",
                "product_sgst_tax_rate":"0",
                "product_cgst_amount":"0",
                "product_cgst_tax_rate":"0"
                }
                ],
                "consignee_details":{
                "consignee_name":"' . $daname . '",
                "consignee_phone":"' . $damob . '",
               
                "consignee_email":"",
                "consignee_complete_address":"' . $daadrs . '",
                "consignee_pincode":"' . $dapin . '"
                }
                }
                ]
               }
               
               
       ',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $smartshiptoken",
                    'Content-Type: application/json'

                ),
            ));
            $responseco = curl_exec($curl);
            $responseco = json_decode($responseco, true);
            curl_close($curl);
            echo "</pre><br>";

            @$checkerror = $responseco['data']['errors']['data_discrepancy']['0']['error']['0'];
            if ($checkerror == "") {

                echo " </pre><br> its not error on values <br>";
            } else {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $checkerror, 'order_status_show' => $checkerror]);
            }

            echo "<br><pre>";
            print_r(($responseco));
            echo "</pre><br>";
            // smartship api  Order Place End //
            @$carrierby = $responseco['data']['success_order_details']['orders']['0']['carrier_name'];


            if (!$responseco['data']['success_order_details']['orders']['0']['awb_number'] == "") {

                $awbnosmartship = $responseco['data']['success_order_details']['orders']['0']['awb_number'];
                $thisgenerateawbno =  $awbnosmartship;
                $smartshiporderid = $responseco['data']['success_order_details']['orders']['0']['request_order_id'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $smartshiporderid, 'Awb_Number' => $awbnosmartship, 'awb_gen_by' => 'Bluedart', 'awb_gen_courier' => 'Smartship']);
            } elseif ($carrierby == 'NSS') {
                echo 'Carrier NOT ASSIGNED';
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => 'Carrier NOT ASSIGNED']);
            } else {

                $errmessage = $responseco['data']['errors']['data_discrepancy']['0']['error']['0'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }






            // Intargos Old End
            // Intargos1 New  Start

        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            $this->fail($th);
            throw $th;
        }
    }
}
