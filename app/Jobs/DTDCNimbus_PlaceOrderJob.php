<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Console\Commands\PlaceShipment_CMD;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use App\Models\BulkPincode;
use App\Models\courierpermission;
use App\Models\Hubs;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DTDCNimbus_PlaceOrderJob implements ShouldQueue
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

            echo "<br>numbusDtdc Start<br>";
            $thisgenerateawbno = "";

            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->post('https://api.nimbuspost.com/v1/users/login', [
                    'email' => 'shipnicknimbus12@gmail.com',
                    'password' => 'Shipnick@123'
                ]);

            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;

            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }
            if ($paymentmode == 'Prepaid') {
                $paymentmode = "prepaid";
            }
            if (strlen($damob) > 10 && substr($damob, 0, 2) === '91') {
                // Remove the '91' prefix
                $damob = substr($damob, 2);
            }
            // $pkpkmbl = trim($pkpkmbl);  
            // $damob= trim($damob);
            // $pkpkpinc = preg_replace('/[^0-9\']/', '', $pkpkpinc);
            // $dapin = preg_replace('/[^0-9\']/', '', $dapin);

            // Convert 0.3 kg to grams
            $weightInGrams = $iacwt * 1000; // Convert 0.3 kg to grams
            $weightInInteger = (int)$weightInGrams; // Convert to integer



            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $xpressbeetoken,
            ])->post('https://api.nimbuspost.com/v1/shipments', [
                'order_number' => $autogenorderno,
                'shipping_charges' => 0,
                'discount' => 0,
                'cod_charges' => 0,
                'payment_type' => $paymentmode,
                'order_amount' => $itamt,
                'package_weight' => $weightInInteger,
                'package_length' => $ilgth,
                'package_breadth' => $iwith,
                'package_height' => $ihght,
                'request_auto_pickup' => 'yes',
                'consignee' => [
                    'name' => $daname,
                    'address' => $daadrs,
                    'address_2' => $daadrs,
                    'city' => $dacity,
                    'state' => $dastate,
                    'pincode' => $dapin,
                    'phone' => $damob
                ],
                'pickup' => [
                    'warehouse_name' => $pkpkname,
                    'name' => $pkpkname,
                    'address' => $pkpkaddr,
                    'address_2' => $pkpkaddr,
                    'city' => $pkpkcity,
                    'state' => $pkpkstte,
                    'pincode' => $pkpkpinc,
                    'phone' => $pkpkmble
                ],
                'order_items' => [
                    [
                        'name' => $iname,
                        'qty' => $iqlty,
                        'price' => $itamt,
                        'sku' => $iival
                    ]
                ],
                'courier_id' => 80,
                'is_insurance' => 0,
                'tags' => 'tag1, tag2'
            ]);

            // Handle the response here
            $responseData = $response->json();
            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";

            if (isset($responseData['status']) && $responseData['status'] == "1") {
                $awb_number = $responseData['data']['awb_number'];
                $shipment_id = $responseData['data']['shipment_id'];
                $status = $responseData['data']['status'];
                $courier = $responseData['data']['courier_name'];

                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $shipment_id,
                    'Awb_Number' => $awb_number,
                    'awb_gen_by' => 'DTDC',
                    'awb_gen_courier' => $courier,
                    'showerrors' => 'pending pickup',
                    'order_status_show' => $status
                ]);

                $param = bulkorders::where('Awb_Number', $awb_number)->first();

                $zone = $param->zone;
                $userid = $param->User_Id;
                $courier = $param->awb_gen_by;
                $awb = $awb_number;
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
                $wellet->awb_no = $awb_number;
                $wellet->date = $date;
                $wellet->user_id =  $userid;
                $wellet->transaction = $transactionCode;
                $wellet->close_blance = $close_blance;
                $wellet->save();

                bulkorders::where('Awb_Number', $awb_number)->update(['shferrors' => 1]);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'showerrors' => $errmessage,
                    'order_status_show' => $errmessage
                ]);
                $this->ifErrorThenNextApi();
            }
        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            // $this->ifErrorThenNextApi();
            $this->fail($th);
            throw $th;
        }
    }

    public function ifErrorThenNextApi($currentCourier = 'dtdc01')
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
