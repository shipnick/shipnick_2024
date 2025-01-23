<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Console\Commands\PlaceShipment_CMD;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use App\Models\BulkPincode;
use App\Models\courierpermission;
use App\Models\Hubs;
use App\Models\smartship;
use DateTime;

class RapidShip_ekart_PlaceOrderJob implements ShouldQueue
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
                $paymentmode = "COD";
            }
            if ($paymentmode == 'Prepaid') {
                $paymentmode = "PREPAID";
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



            $rapidshippickupname = smartship::where('expire_in', $pkpkid)->where('courier', 'RapidShip')->first()->token;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'rapidshyp-token' => '57731822281d866169a9563742c0b806bbce5d34916c66eacfe41e00965924ca',
            ])
                ->post('https://api.rapidshyp.com/rapidshyp/apis/v1/wrapper', [
                    'orderId' => $autogenorderno,
                    'orderDate' => $inputDate,
                    'pickupAddressName' => $rapidshippickupname,
                    'pickupLocation' => [
                        'contactName' => '',
                        'pickupName' => '',
                        'pickupEmail' => '',
                        'pickupPhone' => '',
                        'pickupAddress1' => '',
                        'pickupAddress2' => '',
                        'pinCode' => '',
                    ],
                    'storeName' => 'DEFAULT',
                    'billingIsShipping' => true,
                    'shippingAddress' => [
                        'firstName' => $daname,
                        'lastName' => 'EXT',
                        'addressLine1' => $daadrs,
                        'addressLine2' => $daadrs2,
                        'pinCode' => $dapin,
                        'email' => 'mahesh.mehra@rapidshyp.com',
                        'phone' => $damob,
                    ],
                    'billingAddress' => [
                        'firstName' => $daname,
                        'lastName' => 'PA',
                        'addressLine1' => $daadrs,
                        'addressLine2' => $daadrs2,
                        'pinCode' => $dapin,
                        'email' => 'mahesh.mehra@rapidshyp.com',
                        'phone' =>  $damob,
                    ],
                    'orderItems' => [
                        [
                            'itemName' => $iname,
                            'sku' => $iival,
                            'description' => $iname,
                            'units' => $iqlty,
                            'unitPrice' => $itamt,
                            'tax' => 0.0,
                            'hsn' => '',
                            'productLength' => 10.0,
                            'productBreadth' => 10.0,
                            'productHeight' => 10.0,
                            'productWeight' => 10.5,
                            'brand' => '',
                            'imageURL' => 'http://example.com/product1.jpg',
                            'isFragile' => false,
                            'isPersonalisable' => false,
                        ],
                    ],
                    'paymentMethod' => $paymentmode,
                    'shippingCharges' => 0,
                    'giftWrapCharges' => 0.0,
                    'transactionCharges' => 0.0,
                    'totalDiscount' => 0.0,
                    'totalOrderValue' => $itamt,
                    'codCharges' => 0.0,
                    'prepaidAmount' => 0.0,
                    'packageDetails' => [
                        'packageLength' => $ilgth,
                        'packageBreadth' => $iwith,
                        'packageHeight' => $ihght,
                        'packageWeight' => $iacwt,
                    ],
                ]);

            $responseic = $response->json(); // Decode JSON response

            if (isset($responseData['status']) && $responseData['status'] == "SUCCESS") {
                $orderno = $responseic['orderId'];
                $awb = $responseic['shipment'][0]['awb'];
                $shipno = $responseic['shipment'][0]['shipmentId'];
                $courierName = $responseic['shipment'][0]['courierName'];
                $appliedWeight = $responseic['shipment'][0]['appliedWeight'];
                $routingCode = $responseic['shipment'][0]['routingCode'];

                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $shipno,
                    'Awb_Number' => $awb,
                    'awb_gen_by' => 'EkartRS',
                    'awb_gen_courier' => $courierName,
                    'showerrors' => 'pending pickup',
                    'courier_actual_weight' => $appliedWeight,
                    'dtdcerrors' => $routingCode,
                    'Clinet_Order_Id' => $orderno
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
                $errmessage = $responseData['remarks'];
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

    public function ifErrorThenNextApi($currentCourier = 'EkartRS')
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
