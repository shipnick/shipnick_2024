<?php

namespace App\Jobs;

use App\Console\Commands\PlaceShipment_CMD;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use App\Models\BulkPincode;
use App\Models\courierpermission;
use App\Models\Hubs;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class XPressBee03_PlaceOrderJob implements ShouldQueue
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

            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";

            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'Ballyfashion77@gmail.com',
                'password' => 'shyam104A@',
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

            $weightInGrams = $iacwt * 1000; // Convert 0.3 kg to grams
            $weightInInteger = (int)$weightInGrams; // Convert to integer



            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $xpressbeetoken,
            ])->post('https://shipment.xpressbees.com/api/shipments2', [
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
                    'address' => $daadrs . $daadrs2,
                    'address_2' => $daadrs2,
                    'city' => $dacity,
                    'state' => $dastate,
                    'pincode' => $dapin,
                    'phone' => $damob,
                ],
                'pickup' => [
                    'warehouse_name' => $pkpkname,
                    'name' => $pkpkname,
                    'address' => $pkpkaddr,
                    'address_2' => $pkpkaddr,
                    'city' => $pkpkcity,
                    'state' => $pkpkstte,
                    'pincode' => $pkpkpinc,
                    'phone' => $pkpkmble,
                ],
                'order_items' => [
                    [
                        'name' => $iname,
                        'qty' => $iqlty,
                        'price' => $itamt,
                        'sku' => $iival,
                    ],
                ],
                'courier_id' => '1',
                'collectable_amount' => $icoda,
            ]);

            // Handle the response here
            $responseData = $response->json();
            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";


            if (isset($responseData['status']) && $responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];

                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $shipno,
                    'Awb_Number' => $awb,
                    'awb_gen_by' => 'Xpressbee',
                    'awb_gen_courier' => 'Xpressbee3',
                    'showerrors' => 'pending pickup'
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

                $credit1 = 0;
                // Assign credit based on zone
                if ($zone == 'A') {
                    $credit1 = $credit->fwda ?? 0;
                }
                if ($zone == 'B') {
                    $credit1 = $credit->fwdb ?? 0;
                }
                if ($zone == 'C') {
                    $credit1 = $credit->fwdc ?? 0;
                }
                if ($zone == 'D') {
                    $credit1 = $credit->fwdd ?? 0;
                }
                if ($zone == 'E') {
                    $credit1 = $credit->fwde ?? 0;
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
                // print_r($responseData);
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

    public function ifErrorThenNextApi($currentCourier = 'xpressbee03')
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
