<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\courierpermission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Console\Commands\PlaceShipment_CMD;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use App\Models\smartship;

class ShipwayAmazonShip_PlaceOrderJob implements ShouldQueue
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
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try {
            extract($this->data);


            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "C";
            }
            if ($paymentmode == 'Prepaid') {
                $paymentmode = "P";
            }
            if (strlen($damob) > 10 && substr($damob, 0, 2) === '91') {
                // Remove the '91' prefix
                $damob = substr($damob, 2);
            }

            // Convert 0.3 kg to grams
            $weightInGrams = $iacwt * 1000; // Convert 0.3 kg to grams
            $weightInInteger = (int)$weightInGrams; // Convert to integer

            $rapidshippickupname = smartship::where('expire_in', $pkpkid)->where('courier', 'shipway')->first()->token;

            // Define your request URL
            $url = 'https://app.shipway.com/api/v2orders';

            $data = [
                "order_id" => $autogenorderno,
                "carrier_id" => 81358,
                "warehouse_id" => $rapidshippickupname,
                "return_warehouse_id" => $rapidshippickupname,
                "products" => [
                    [
                        "product" => $iname,
                        "price" => $itamt,
                        "product_code" => "JSN909",
                        "product_quantity" => $iqlty,
                        "discount" => "0",
                        "tax_rate" => "",
                        "tax_title" => "IGST"
                    ]
                ],
                "discount" => "0",
                "shipping" => "0",
                "order_total" => $itamt,
                "gift_card_amt" => "0",
                "taxes" => "0",
                "payment_type" => $paymentmode,
                "email" => "customer@email.com",
                "billing_address" => $daadrs,
                "billing_address2" => $daadrs . $daadrs2,
                "billing_city" => $dacity,
                "billing_state" => $dastate,
                "billing_country" => "India",
                "billing_firstname" => $daname,
                "billing_lastname" => "",
                "billing_phone" => $damob,
                "billing_zipcode" => $dapin,
                "billing_latitude" => "",
                "billing_longitude" => "",
                "shipping_address" => $daadrs,
                "shipping_address2" => $daadrs . $daadrs2,
                "shipping_city" => $dacity,
                "shipping_state" => $dastate,
                "shipping_country" => "India",
                "shipping_firstname" => $daname,
                "shipping_lastname" => "",
                "shipping_phone" => $damob,
                "shipping_zipcode" => $dapin,
                "shipping_latitude" => "",
                "shipping_longitude" => "",
                "order_weight" => $iacwt,
                "box_length" => $ilgth,
                "box_breadth" => $iwith,
                "box_height" => $ihght,
                "order_date" => "2022-06-21 15:35:02"
            ];
            $response = Http::withHeaders([
                'Authorization' => 'Basic R3RoYWtyYWw0ODBAZ21haWwuY29tOms0OTJYMzFsUUwzNXFUUTd3NWwzNlNuZFkwdjExMjQy',
                'Content-Type' => 'application/json',
            ])->post($url, $data);
            $responseDatanew = $response->json();
            if ($responseDatanew['awb_response']['success'] == true) {
                echo $awb = $responseDatanew['awb_response']['AWB'];
                echo $carrier_id = $responseDatanew['awb_response']['carrier_id'];
                echo $carrier_id = $responseDatanew['awb_response']['carrier_name'];

                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $carrier_id,
                    'Awb_Number' => $awb,
                    'awb_gen_by' => 'Amazon ship',
                    'awb_gen_courier' => $courier,

                    'showerrors' => 'Pickup Pending'
                ]);
                echo $label = $responseDatanew['awb_response']['shipping_url'];
                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'dhlerrors' => $label,

                ]);

                $param = bulkorders::where('Awb_Number', $awb)->first();

                $zone = $param->zone;
                $userid = $param->User_Id;
                $courier = $param->awb_gen_by;
                $awb = $awb;
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
                $errmessage = $responseDatanew['awb_response']['error'][0];
                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'showerrors' => $errmessage,
                    'order_status_show' => $errmessage
                ]);
            }
        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            // $this->ifErrorThenNextApi();
            $this->fail($th);
            throw $th;
        }
    }

    public function ifErrorThenNextApi($currentCourier = 'AWShip')
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
            $index = $courierassigns->search($currentCourier);

            // Check if 'ecom01' was found and if there is a next value
            if ($index !== false && $index + 1 < $courierassigns->count()) {
                // Get the next value after 'ecom01'
                $nextCourier = $courierassigns[$index + 1]; //  'xpressbee0'
                // PlaceShipment_CMD::API_PROVIDER['xpressbee0']

                $jobClass = 'App\\Jobs\\' . PlaceShipment_CMD::API_PROVIDER[$nextCourier] . '_PlaceOrderJob';
                Log::info('Dispatching ' . $jobClass);
                $jobClass::dispatch($this->data)->onQueue('place_order');
            } else {
                Log::info("No courier provider");
            }
        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            throw $th;
        }
    }
}
