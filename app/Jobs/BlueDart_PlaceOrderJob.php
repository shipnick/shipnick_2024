<?php

namespace App\Jobs;

use App\Models\bulkorders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

            $response = Http::withHeaders([
                'ClientID' => '9JdKNQXv45xuI2mCzFFVSGDdPh4in1ku',
                'clientSecret' => 'JdzNoBQLokmGU6VO',
                'Cookie' => 'BIGipServerpl_netconnect-bluedart.dhl.com_443=!+fTysYqXKJd2sXXfR3BsqrvQUUbjCCBOfXLGrfoTQlQpURtCxgFF1NmiMtHVF5+Xekt82FCu9qga4J8='
            ])->get('https://apigateway.bluedart.com/in/transportation/token/v1/login');

            $responseData1 = $response->json();

            // echo "<br><pre>";
            // print_r($responseData1);
            // echo "</pre><br>";

            echo $token = $responseData1['JWTToken'];


            $hubtitleshipclues = Hubs::where('hub_id', $pkpkid)->first()->Shiprocket_hub_id;
            $inputDate = $param->Last_Time_Stamp;
            $formattedDate = '/Date(' . (new DateTime($inputDate))->getTimestamp() * 1000 . ')/';

            $response = Http::withHeaders([
                'JWTToken' =>  $token,
                'Content-Type' => 'application/json',
                'Cookie' => 'BIGipServerpl_netconnect-bluedart.dhl.com_443=!+fTysYqXKJd2sXXfR3BsqrvQUUbjCCBOfXLGrfoTQlQpURtCxgFF1NmiMtHVF5+Xekt82FCu9qga4J8=',
            ])->post('https://apigateway.bluedart.com/in/transportation/waybill/v1/GenerateWayBill', [
                'Request' => [
                    'Consignee' => [
                        'AvailableDays' => '',
                        'AvailableTiming' => '',
                        'ConsigneeAddress1' => $daadrs,
                        'ConsigneeAddress2' => '',
                        'ConsigneeAddress3' => '',
                        'ConsigneeAddressType' => '',
                        'ConsigneeAddressinfo' => '',
                        'ConsigneeAttention' => 'ABCD',
                        'ConsigneeEmailID' => '',
                        'ConsigneeFullAddress' => '',
                        'ConsigneeGSTNumber' => '',
                        'ConsigneeLatitude' => '',
                        'ConsigneeLongitude' => '',
                        'ConsigneeMaskedContactNumber' => '',
                        'ConsigneeMobile' => $damob,
                        'ConsigneeName' => $daname,
                        'ConsigneePincode' => $dapin,
                        'ConsigneeTelephone' => ''
                    ],
                    'Returnadds' => [
                        'ManifestNumber' => '',
                        'ReturnAddress1' => $pkpkaddr,
                        'ReturnAddress2' => '',
                        'ReturnAddress3' => '',
                        'ReturnAddressinfo' => '',
                        'ReturnContact' => $pkpkmble,
                        'ReturnEmailID' => '',
                        'ReturnLatitude' => '',
                        'ReturnLongitude' => '',
                        'ReturnMaskedContactNumber' => '',
                        'ReturnMobile' => $pkpkmble,
                        'ReturnPincode' => $pkpkpinc,
                        'ReturnTelephone' => ''
                    ],
                    'Services' => [
                        'AWBNo' => '',
                        'ActualWeight' => $iacwt,
                        'CollectableAmount' => 0,
                        'Commodity' => [
                            'CommodityDetail1' => 'Test1',
                            'CommodityDetail2' => 'Test2',
                            'CommodityDetail3' => 'Test3'
                        ],
                        'CreditReferenceNo' => $autogenorderno,
                        'CreditReferenceNo2' => '',
                        'CreditReferenceNo3' => '',
                        'DeclaredValue' => $itamt,
                        'DeliveryTimeSlot' => '',
                        'Dimensions' => [
                            [
                                'Breadth' => $iwith,
                                'Count' => $iqlty,
                                'Height' => $ihght,
                                'Length' => $ilgth
                            ]
                        ],
                        'FavouringName' => '',
                        'IsDedicatedDeliveryNetwork' => false,
                        'IsDutyTaxPaidByShipper' => false,
                        'IsForcePickup' => false,
                        'IsPartialPickup' => false,
                        'IsReversePickup' => false,
                        'ItemCount' => 1,
                        'Officecutofftime' => '',
                        'PDFOutputNotRequired' => true,
                        'PackType' => '',
                        'ParcelShopCode' => '',
                        'PayableAt' => '',
                        'PickupDate' => $formattedDate,
                        'PickupMode' => '',
                        'PickupTime' => '1600',
                        'PickupType' => '',
                        'PieceCount' => '1',
                        'PreferredPickupTimeSlot' => '',
                        'ProductCode' => 'D',
                        'ProductFeature' => '',
                        'ProductType' => 2,
                        'RegisterPickup' => true,
                        'SpecialInstruction' => '',
                        'SubProductCode' => '',
                        'TotalCashPaytoCustomer' => 0,
                        'itemdtl' => [
                            [
                                'CGSTAmount' => 0,
                                'HSCode' => '',
                                'IGSTAmount' => 0,
                                'Instruction' => '',
                                'InvoiceDate' => '/Date(1693177679000)/',
                                'InvoiceNumber' => '',
                                'ItemID' => '1120448',
                                'ItemName' => $iname,
                                'ItemValue' => $itamt,
                                'Itemquantity' => $iqlty,
                                'PlaceofSupply' => '',
                                'ProductDesc1' => '',
                                'ProductDesc2' => '',
                                'ReturnReason' => '',
                                'SGSTAmount' => 0,
                                'SKUNumber' => '',
                                'SellerGSTNNumber' => '',
                                'SellerName' => '',
                                'SubProduct1' => '',
                                'SubProduct2' => '',
                                'TaxableAmount' => 0,
                                'TotalValue' => $itamt,
                                'cessAmount' => '0.0',
                                'countryOfOrigin' => '',
                                'docType' => '',
                                'subSupplyType' => 0,
                                'supplyType' => ''
                            ]
                        ],
                        'noOfDCGiven' => 0
                    ],
                    'Shipper' => [
                        'CustomerAddress1' => $pkpkaddr,
                        'CustomerAddress2' => '',
                        'CustomerAddress3' => '',
                        'CustomerAddressinfo' => '',
                        'CustomerBusinessPartyTypeCode' => '',
                        'CustomerCode' => '957316',
                        'CustomerEmailID' => '',
                        'CustomerGSTNumber' => '',
                        'CustomerLatitude' => '',
                        'CustomerLongitude' => '',
                        'CustomerMaskedContactNumber' => '',
                        'CustomerMobile' => $pkpkmble,
                        'CustomerName' => 'GLAMFUSE INDIA PVT. LTD.',
                        'CustomerPincode' => $pkpkpinc,
                        'CustomerTelephone' => '',
                        'IsToPayCustomer' => false,
                        'OriginArea' => 'HNS',
                        'Sender' => 'GLAMFUSE INDIA PVT. LTD.',
                        'VendorCode' => 'HNS111'
                    ]
                ],
                'Profile' => [
                    'LoginID' => 'HNS49193',
                    'LicenceKey' => 'wgo4jwpyhopkqigtjepsqmme1tngess2',
                    'Api_type' => 'S'
                ]
            ]);





            // Handle the response here
            $responseData = $response->json();

            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";

            if (isset($responseData['GenerateWayBillResult'])) {
                $generateWayBillResult = $responseData['GenerateWayBillResult'];

                // Check if required keys exist in the result
                $awb = $generateWayBillResult['AWBNo'] ?? null;
                $tokenId = $generateWayBillResult['TokenNumber'] ?? null;
                $routeCode = $generateWayBillResult['DestinationArea'] ?? '';
                $routeCode2 = $generateWayBillResult['DestinationLocation'] ?? '';

                // Build routing code
                $routingCode = $routeCode . '/' . $routeCode2;

                // Update the database
                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $tokenId,
                    'Awb_Number' => $awb,
                    'dtdcerrors' => $routingCode,
                    'awb_gen_by' => 'Bluedart',
                    'awb_gen_courier' => 'Bluedart',
                    'showerrors' => 'Booked',
                ]);
            } else {
                echo "<br>else section <br>";
                // $errormsg = $responseio['response'];
                // $errormsg = "Ecom internal error 500";
                // if (!empty($responseecom['shipments'][0]['reason'])) {
                //     $errormsg = $responseecom['shipments'][0]['reason'];
                // } elseif ($eominvalidawbs == "2") {
                //     $errormsg = "Awb not found";
                // } else {
                //     $errormsg = "Ecom internal error 500";
                // }
                // bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
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
                    if ($courierapicodeno == "xpressbee02") {
                        echo "<br>xpressbee Start<br>";
                        $thisgenerateawbno = "";

                        // Login to get Xpressbee token
                        $response = Http::withHeaders([
                            'Content-Type' => 'application/json',
                        ])->post('https://shipment.xpressbees.com/api/users/login', [
                            'email' => 'glamfuseindia67@gmail.com',
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
                                'awb_gen_courier' => 'Xpressbee2',
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
                    if ($courierapicodeno == "xpressbee03") {
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
                                'awb_gen_courier' => 'Xpressbee2',
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
