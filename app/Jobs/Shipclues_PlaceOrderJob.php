<?php

namespace App\Jobs;

use App\Models\bulkorders;
use App\Models\courierpermission;
use App\Models\Hubs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlueDart_PlaceOrderJob implements ShouldQueue
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

            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";


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



            $hubtitleshipclues = Hubs::where('hub_id', $pkpkid)->first()->Shiprocket_hub_id;


            $response = Http::post('https://www.shipclues.com/api/order-create', [
                'ApiKey' => 'TdRxkE0nJd4R78hfEGSz2P5CAIeqzUtZ84EFDUX9',
                'OrderDetails' => [
                    [
                        'PaymentType' => $paymentmode,
                        'OrderType' => 'forward',
                        'CustomerName' => $daname,
                        'OrderNumber' => $autogenorderno,
                        'Addresses' => [
                            'BilingAddress' => [
                                'AddressLine1' => $daadrs,
                                'AddressLine2' => $daadrs,
                                'City' => $dacity,
                                'State' => $dastate,
                                'Country' => 'India',
                                'Pincode' => $dapin,
                                'ContactCode' => '91',
                                'Contact' => $damob,
                            ],
                            'ShippingAddress' => [
                                'AddressLine1' => $daadrs,
                                'AddressLine2' => $daadrs,
                                'City' => $dacity,
                                'State' => $dastate,
                                'Country' => 'India',
                                'Pincode' => $dapin,
                                'ContactCode' => '91',
                                'Contact' => $damob,
                            ],
                            'PickupAddress' => [
                                'warehouseCode' => $hubtitleshipclues,
                                'WarehouseName' => $pkpkname,
                                'ContactName' => 'person',
                                'AddressLine1' => $pkpkaddr,
                                'AddressLine2' => $pkpkaddr,
                                'City' => $pkpkcity,
                                'State' => $pkpkstte,
                                'Country' => 'India',
                                'Pincode' => $pkpkpinc,
                                'ContactCode' => '91',
                                'Contact' => $pkpkmble,
                            ],
                        ],
                        'Weight' =>  $iacwt,
                        'Length' => $ilgth,
                        'Breadth' => $iwith,
                        'Height' => $ihght,
                        'ProductDetails' => [
                            [
                                'Name' => $iname,
                                'SKU' => $iival,
                                'QTY' => $iqlty,
                                'GST' => 0,
                                'Price' => $itamt,
                            ],
                        ],
                        'InvoiceAmount' =>  $iival,
                        'EwayBill' => null,
                        'ShippingCharge' => '0',
                        'CodCharge' => '0',
                        'Discount' => '0',
                    ],
                ],
            ]);





            // Handle the response here
            $responseData = $response->json();
            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";

            echo $order = $responseData[0]['order_id'];


            $responseship = Http::post('https://www.shipclues.com/api/order-ship', [
                'ApiKey' => 'TdRxkE0nJd4R78hfEGSz2P5CAIeqzUtZ84EFDUX9',
                'OrderID' => $order,
                'PartnerID' => 40,
            ]);
            $responseship = $responseship->json();
            echo "<br><pre>";
            print_r($responseship);
            echo "</pre><br>";


            if ($responseship['status'] == "1") {
                $awb = $responseship['data']['awb_number'];
                $courier = $responseship['data']['courier'];
                $route = $responseship['data']['route_code'];


                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $order,
                    'Awb_Number' => $awb,
                    'awb_gen_by' => 'Bluedart-sc',
                    'awb_gen_courier' => $courier,
                    'dtdcerrors' => $route,
                    'showerrors' => 'ship'
                ]);
            } else {
                echo "<br>else section <br>";
                $errormsg = $responseship['message'];
                // $errormsg = "Ecom internal error 500";
                // if (!empty($responseecom['shipments'][0]['reason'])) {
                //     $errormsg = $responseecom['shipments'][0]['reason'];
                // } elseif ($eominvalidawbs == "2") {
                //     $errormsg = "Awb not found";
                // } else {
                //     $errormsg = "Ecom internal error 500";
                // }
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                // new start 
                $courierassigns = courierpermission::where('user_id', $userid)
                    // ->where('courier_priority', '!=', '0')
                    ->where('courier_priority',  '2')
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
                echo "<br>";
                echo $paymentmode;
                echo " courierstart first<br>";
                foreach ($finalcourierlists as $courierapicodeno) {
                    echo $courierapicodeno;
                    if ($courierapicodeno == "xpressbee0") {
                        echo "<br>xpressbee Start<br>";
                        $thisgenerateawbno = "";

                        // Login to get Xpressbee token
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                        ])->post('https://shipment.xpressbees.com/api/users/login', [
                            'email' => 'shipnick11@gmail.com',
                            'password' => 'Hansi@@2024@@',
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

                        $weightInGrams = 0.3 * $iacwt; // Convert 0.3 kg to grams
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
                                'address' => $daadrs,
                                'address_2' => $daadrs,
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
                                'showerrors' => 'pending pickup',
                                'awb_gen_by' => 'Xpressbee',
                                'awb_gen_courier' => 'Xpressbee',
                                'showerrors' => 'pending pickup'
                            ]);
                        } else {
                            $errmessage = $responseData['message'];
                            bulkorders::where('Single_Order_Id', $crtidis)->update([
                                'showerrors' => $errmessage,
                                'order_status_show' => $errmessage,
                                'dtdcerrors' => '1'
                            ]);
                        }
                    }
                }
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
            $this->fail($th);
            throw $th;
        }
    }
}
