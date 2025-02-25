<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;
use App\Models\CourierApiDetail;
use App\Models\courierlist;
use App\Models\courierpermission;
use App\Models\Hubs;
use App\Models\OrdersStatus;
use App\Models\CourierNames;
use App\Models\bulkorders;
use App\Models\bulkordersfile;
use App\Models\EcomAwbs;
use App\Models\smartship;
use App\Models\BulkPincode;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DateTime;




class APIBigShip extends Controller
{
    public function OrderPlaceToCourier()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(20)
            ->get();

        // print_r($params);
        echo "Working Total Order : ";
        echo count($params);
        echo "<br><br>";
        // Update Selected Orders To Generate A AWB Number
        foreach ($params as $param) {
            $crtidis = $param->Single_Order_Id;
            bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 1]);
        }
        // Update Selected Orders To Generate A AWB Number


        // echo "<br>";
        // echo count($params);
        $loopno = 0;
        $loopnocheck = 0;
        $warehouseresponse = "";



        foreach ($params as $param) {
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
            echo "<br>";
            echo $paymentmode;
            echo " courierstart first<br>";
            foreach ($finalcourierlists as $courierapicodeno) {
                echo $courierapicodeno;
                if ($courierapicodeno == "smp01") {
                    echo "<br>smartship Start<br>";
                    $thisgenerateawbno = "";

                    // smartshiptoken and warehouse shmartship id 
                    $smartshiptoken = smartship::where('id', 1)->first()->token;
                    $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
                    if ($warehouseid == "") {
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                        continue;
                    }

                    // smartship api start Order Place
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.smartship.in/v2/app/Fulfillmentservice/orderRegistrationOneStep',
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
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
                } elseif ($courierapicodeno == "ecom01") {
                    echo "<br>Ecom Start<br>";
                    $thisgenerateawbno = "";
                    // Ecom Section Start
                    error_reporting(1);
                    // Ecom Order Place
                    $picodematch = BulkPincode::where('pincode', $dapin)->where('courier', 'ecom')->exists();

                    if (!$picodematch) {
                        echo "pincode not found in list";
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
                    } else {
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

                        echo "<br><pre>";
                        print_r(($responseecom));
                        echo "</pre><br>";



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
                            bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom']);
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
                    }






                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                } elseif ($courierapicodeno == "xpressbee0") {
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

                    // Convert 0.3 kg to grams
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
                            'awb_gen_by' => 'Xpressbee',
                            'awb_gen_courier' => 'Xpressbee',
                            'showerrors' => 'pending pickup'
                        ]);
                    } else {
                        $errmessage = $responseData['message'];
                        bulkorders::where('Single_Order_Id', $crtidis)->update([
                            'showerrors' => $errmessage,
                            'order_status_show' => $errmessage
                        ]);

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
                            if ($courierapicodeno == "ecom01") {
                                echo "<br>Ecom Start<br>";
                                $thisgenerateawbno = "";
                                // Ecom Section Start
                                error_reporting(1);
                                // Ecom Order Place




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

                                echo "<br><pre>";
                                print_r(($responseecom));
                                echo "</pre><br>";



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
                                    bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom', 'showerrors' => 'booked']);
                                } else {
                                    $courierassigns = courierpermission::where('user_id', $userid)
                                        // ->where('courier_priority', '!=', '0')
                                        ->where('courier_priority',  '3')
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
                                        if ($courierapicodeno == "bluedart0") {
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
                                            }





                                            // Ecom Order Place End //
                                            // Ecom Section End
                                            // echo "<br>Ecom End<br>";

                                            if ($thisgenerateawbno) {
                                                break;
                                            }
                                        }
                                    }
                                }
                                // Ecom Order Place End //
                                // Ecom Section End
                                // echo "<br>Ecom End<br>";

                                if ($thisgenerateawbno) {
                                    break;
                                }
                            }
                        }
                    }
                } elseif ($courierapicodeno == "xpressbee02") {
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
                            'awb_gen_by' => 'Xpressbee',
                            'awb_gen_courier' => 'Xpressbee2',
                            'showerrors' => 'pending pickup'
                        ]);
                    } else {
                        $errmessage = $responseData['message'];
                        bulkorders::where('Single_Order_Id', $crtidis)->update([
                            'showerrors' => $errmessage,
                            'order_status_show' => $errmessage
                        ]);

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
                            if ($courierapicodeno == "ecom01") {
                                echo "<br>Ecom Start<br>";
                                $thisgenerateawbno = "";
                                // Ecom Section Start
                                error_reporting(1);
                                // Ecom Order Place
                                $picodematch = BulkPincode::where('pincode', $dapin)->where('courier', 'ecom')->exists();

                                if (!$picodematch) {
                                    bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => 'non service pincode']);
                                } else {
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

                                    echo "<br><pre>";
                                    print_r(($responseecom));
                                    echo "</pre><br>";



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
                                        bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom', 'showerrors' => 'booked']);
                                    }
                                    // Ecom Order Place End //
                                    // Ecom Section End
                                    // echo "<br>Ecom End<br>";
                                }






                                if ($thisgenerateawbno) {
                                    break;
                                }
                            }
                            if ($courierapicodeno == "bluedart0") {
                                echo "<br>bluedart Start<br>";
                                $thisgenerateawbno = "";
                                $hubtitle = Hubs::where('hub_id', $pkpkid)->first()->hub_title;

                                // Ecom Section Start
                                error_reporting(1);

                                try {
                                    $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
                                        "email" => "info@shipnick.com",
                                        "password" => "8mVxTvH)6g8v"
                                    ]);

                                    if ($response->successful()) {
                                        $responseData = $response->json();
                                        $token = $responseData['token'];
                                        echo $token;

                                        $ecomdate = date_create($idate);
                                        $invicedateecom = date_format($ecomdate, "d-m-Y");

                                        echo $invicedateecom . "<br>";

                                        if ($paymentmode == 'prepaid') {
                                            $paymentmode = "PPD";
                                        }

                                        $response = Http::withHeaders([
                                            'Content-Type' => 'application/json',
                                            'Authorization' => 'Bearer ' . $token
                                        ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
                                            "order_id" => $autogenorderno,
                                            "order_date" => $invicedateecom,
                                            "pickup_location" => $hubtitle,
                                            "channel_id" => "",
                                            "comment" => "Reseller: M/s Goku",
                                            "billing_customer_name" => $daname,
                                            "billing_last_name" => "",
                                            "billing_address" => $daadrs,
                                            "billing_address_2" => "",
                                            "billing_city" => $dacity,
                                            "billing_pincode" => $dapin,
                                            "billing_state" => $dastate,
                                            "billing_country" => "India",
                                            "billing_email" => "",
                                            "billing_phone" => $damob,
                                            "shipping_is_billing" => true,
                                            "order_items" => [
                                                [
                                                    "name" => $iname,
                                                    "sku" => $iival,
                                                    "units" => $iqlty,
                                                    "selling_price" => $itamt,
                                                    "discount" => "",
                                                    "tax" => "",
                                                    "hsn" => ""
                                                ]
                                            ],
                                            "payment_method" => $paymentmode,
                                            "shipping_charges" => 0,
                                            "giftwrap_charges" => 0,
                                            "transaction_charges" => 0,
                                            "total_discount" => 0,
                                            "sub_total" => $icoda,
                                            "length" => $ilgth,
                                            "breadth" => $iwith,
                                            "height" => $ihght,
                                            "weight" => $iacwt,
                                            "order_type" => 'ESSENTIALS'
                                        ]);

                                        $responseData1 = $response->json();


                                        if (isset($responseData1['shipment_id'])) {
                                            $shipment_id = $responseData['shipment_id'];

                                            $response = Http::withHeaders([
                                                'Content-Type' => 'application/json',
                                                'Authorization' => 'Bearer ' . $token
                                            ])->post('https://apiv2.shiprocket.in/v1/external/courier/assign/awb', [
                                                "shipment_id" => $shipment_id
                                            ]);
                                            $responseData = $response->json();
                                            //      echo "<br><pre>";
                                            // print_r($responseData);
                                            // echo "</pre><br>";

                                            if (isset($responseData['shipment_id'])) {
                                                $responseData = $response->json();
                                                $awb = $responseData['response']['data']['awb_code'];
                                                $order_id = $responseData['response']['data']['order_id'];
                                                $shipment_id = $responseData['response']['data']['shipment_id'];
                                                $routing_code = $responseData['response']['data']['routing_code'];

                                                bulkorders::where('Single_Order_Id', $crtidis)->update([
                                                    'courier_ship_no' => $shipment_id,
                                                    'Awb_Number' => $awb,
                                                    'dtdcerrors' => $routing_code,
                                                    'shferrors' => $order_id,
                                                    'awb_gen_by' => 'Bluedart',
                                                    'awb_gen_courier' => 'Bluedart',
                                                    'showerrors' => 'Booked'
                                                ]);
                                            } else {
                                                $responseData = $response->json();
                                                $error = $responseData['message'];
                                                bulkorders::where('Single_Order_Id', $crtidis)->update([
                                                    'showerrors' => $error
                                                ]);
                                            }
                                        }
                                    }
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            }
                        }
                    }
                } elseif ($courierapicodeno == "xpressbee03") {
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
                    } else {
                        // print_r($responseData);
                        $errmessage = $responseData['message'];
                        bulkorders::where('Single_Order_Id', $crtidis)->update([
                            'showerrors' => $errmessage,
                            'order_status_show' => $errmessage
                        ]);

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
                            if ($courierapicodeno == "ecom01") {
                                echo "<br>Ecom Start<br>";
                                $thisgenerateawbno = "";
                                // Ecom Section Start
                                error_reporting(1);
                                // Ecom Order Place
                                $picodematch = BulkPincode::where('pincode', $dapin)->where('courier', 'ecom')->exists();

                                if (!$picodematch) {
                                    bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => 'non service pincode']);
                                } else {
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

                                    echo "<br><pre>";
                                    print_r(($responseecom));
                                    echo "</pre><br>";



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
                                        bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom', 'showerrors' => 'booked']);
                                    }
                                    // Ecom Order Place End //
                                    // Ecom Section End
                                    // echo "<br>Ecom End<br>";
                                }






                                if ($thisgenerateawbno) {
                                    break;
                                }
                            }
                            if ($courierapicodeno == "bluedart0") {
                                echo "<br>bluedart Start<br>";
                                $thisgenerateawbno = "";
                                $hubtitle = Hubs::where('hub_id', $pkpkid)->first()->hub_title;

                                // Ecom Section Start
                                error_reporting(1);

                                try {
                                    $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
                                        "email" => "info@shipnick.com",
                                        "password" => "8mVxTvH)6g8v"
                                    ]);

                                    if ($response->successful()) {
                                        $responseData = $response->json();
                                        $token = $responseData['token'];
                                        echo $token;

                                        $ecomdate = date_create($idate);
                                        $invicedateecom = date_format($ecomdate, "d-m-Y");

                                        echo $invicedateecom . "<br>";

                                        if ($paymentmode == 'prepaid') {
                                            $paymentmode = "PPD";
                                        }

                                        $response = Http::withHeaders([
                                            'Content-Type' => 'application/json',
                                            'Authorization' => 'Bearer ' . $token
                                        ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
                                            "order_id" => $autogenorderno,
                                            "order_date" => $invicedateecom,
                                            "pickup_location" => $hubtitle,
                                            "channel_id" => "",
                                            "comment" => "Reseller: M/s Goku",
                                            "billing_customer_name" => $daname,
                                            "billing_last_name" => "",
                                            "billing_address" => $daadrs,
                                            "billing_address_2" => "",
                                            "billing_city" => $dacity,
                                            "billing_pincode" => $dapin,
                                            "billing_state" => $dastate,
                                            "billing_country" => "India",
                                            "billing_email" => "",
                                            "billing_phone" => $damob,
                                            "shipping_is_billing" => true,
                                            "order_items" => [
                                                [
                                                    "name" => $iname,
                                                    "sku" => $iival,
                                                    "units" => $iqlty,
                                                    "selling_price" => $itamt,
                                                    "discount" => "",
                                                    "tax" => "",
                                                    "hsn" => ""
                                                ]
                                            ],
                                            "payment_method" => $paymentmode,
                                            "shipping_charges" => 0,
                                            "giftwrap_charges" => 0,
                                            "transaction_charges" => 0,
                                            "total_discount" => 0,
                                            "sub_total" => $icoda,
                                            "length" => $ilgth,
                                            "breadth" => $iwith,
                                            "height" => $ihght,
                                            "weight" => $iacwt,
                                            "order_type" => 'ESSENTIALS'
                                        ]);

                                        $responseData1 = $response->json();


                                        if (isset($responseData1['shipment_id'])) {
                                            $shipment_id = $responseData['shipment_id'];

                                            $response = Http::withHeaders([
                                                'Content-Type' => 'application/json',
                                                'Authorization' => 'Bearer ' . $token
                                            ])->post('https://apiv2.shiprocket.in/v1/external/courier/assign/awb', [
                                                "shipment_id" => $shipment_id
                                            ]);
                                            $responseData = $response->json();
                                            //      echo "<br><pre>";
                                            // print_r($responseData);
                                            // echo "</pre><br>";

                                            if (isset($responseData['shipment_id'])) {
                                                $responseData = $response->json();
                                                $awb = $responseData['response']['data']['awb_code'];
                                                $order_id = $responseData['response']['data']['order_id'];
                                                $shipment_id = $responseData['response']['data']['shipment_id'];
                                                $routing_code = $responseData['response']['data']['routing_code'];

                                                bulkorders::where('Single_Order_Id', $crtidis)->update([
                                                    'courier_ship_no' => $shipment_id,
                                                    'Awb_Number' => $awb,
                                                    'dtdcerrors' => $routing_code,
                                                    'shferrors' => $order_id,
                                                    'awb_gen_by' => 'Bluedart',
                                                    'awb_gen_courier' => 'Bluedart',
                                                    'showerrors' => 'Booked'
                                                ]);
                                            } else {
                                                $responseData = $response->json();
                                                $error = $responseData['message'];
                                                bulkorders::where('Single_Order_Id', $crtidis)->update([
                                                    'showerrors' => $error
                                                ]);
                                            }
                                        }
                                    }
                                } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                            }
                        }
                    }
                } elseif ($courierapicodeno == "bluedart01") {
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

                    if ($thisgenerateawbno) {
                        break;
                    }
                } elseif ($courierapicodeno == "bluedart0") {
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

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
            }
        }
    }


    public function OrderPlaceToCourier121()
    {

        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');


        //  Http::get('https://shipnick.com/order-update-ecom');
        //  Http::get('https://shipnick.com/order-update-intransit-ecom');
        //  Http::get('https://shipnick.com/order-update-ofd-ecom');
        //  Http::get('https://www.shipnick.com/UPBulk_cancel_Order_API');






    }

    public function OrdercancelToCourier()
    {
        // Initialize variables
        $loopno = 0;
        $tdateare = date('Y-m-d H:i:s'); // Assuming this is the current date/time

        $params = bulkorders::where('order_cancel', '1')
            // ->where('order_cancel_reasion', ' ')
            ->where('awb_gen_by', '!=', '')
            ->where('order_status_show', '!=', ['Cancel'])
            //   ->where('awb_gen_by','Ecom')
            //   ->where('User_Id', '109')
            //   ->where('order_status_show', '0011')

            ->orderByDesc('Single_Order_Id')
            ->limit(80)
            ->get();
        // dd($params);
        $totalOrders = $params->count();
        echo "Working Total Order: $totalOrders<br><br>";

        foreach ($params as $param) {
            $loopno++;



            echo  $shipment_id = $param->shferrors;
            echo  $Awb = $param->Awb_Number;
            echo  $order_id = $param->ordernoapi;
            echo  $courierare = $param->awb_gen_by;
            echo  $courierare1 = $param->awb_gen_courier;
            $courier_ship_no = $param->courier_ship_no;

            if ($courierare == "Ecom") {
                // Handle Ecom courier cancellation
                $response = $this->cancelEcomOrder($Awb);

                // Process response and update status accordingly
            } elseif ($courierare == "EkartRS") {
                // Handle Xpressbee courier cancellation
                $response = $this->cancelEkartOrder($order_id,$Awb);

                // Process response and update status accordingly
            } elseif ($courierare1 == "Xpressbee") {
                // Handle Xpressbee courier cancellation
                $response = $this->cancelXpressbeeOrder($Awb);

                // Process response and update status accordingly
            } elseif ($courierare1 == "Xpressbee2") {
                // Handle Xpressbee courier cancellation
                $response = $this->cancelXpressbee2Order($Awb);

                // Process response and update status accordingly
            } elseif ($courierare1 == "Xpressbee3") {
                // Handle Xpressbee courier cancellation
                $response = $this->cancelXpressbee3Order($Awb);

                // Process response and update status accordingly
            } elseif ($courierare == "Bluedart") {
                // Handle Xpressbee courier cancellation
                $response = $this->cancelBluedartOrder($shipment_id);

                // Process response and update status accordingly
            } elseif ($courierare == "Bluedart-sc") {
                // Handle Xpressbee courier cancellation
                $response = $this->cancelbluedart_scOrder($courier_ship_no);

                // Process response and update status accordingly
            }

            // Additional processing or logging can be done here
        }
    }
    private function cancelEkartOrder($order_id ,$Awb)
    {
        $tdateis = date('Y-m-d');

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'rapidshyp-token' => '57731822281d866169a9563742c0b806bbce5d34916c66eacfe41e00965924ca',
        ])->post('https://api.rapidshyp.com/rapidshyp/apis/v1/cancel_order', [
            'orderId' => $order_id,
            'storeName' => 'DEFAULT',
        ]);
        $responseDatanew = $response->json();
        $remark = $responseDatanew['remarks'];

        $cancelstatus = "Cancel";
       
        $alertmsg = "Order delete please refresh page if not deleted";
        bulkorders::where('Awb_Number', $Awb)
            ->update([

                'canceldate' => $tdateis,
                'order_status_show' => $cancelstatus,
                'order_cancel_reasion' => $remark
            ]);
    }

    private function cancelEcomOrder($awb)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://shipment.ecomexpress.in/apiv2/cancel_awb/',
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073', 'password' => 'lnR1C8NkO1', 'awbs' => $awb),
                CURLOPT_HTTPHEADER => array(
                    'Cookie: AWSALB=AeNFVNg5YazTNZT3iTzkFmP1DGxIXjSwm802sL2a8MKv8RVIoTkF9rBYh4EHXvqxTESwcYY4wb9WEom5iKNafMRefor3n6z/O2JmkKZgr/xyYUr1u9kfyCr2hc/1; AWSALBCORS=AeNFVNg5YazTNZT3iTzkFmP1DGxIXjSwm802sL2a8MKv8RVIoTkF9rBYh4EHXvqxTESwcYY4wb9WEom5iKNafMRefor3n6z/O2JmkKZgr/xyYUr1u9kfyCr2hc/1'
                ),
            ));


            $response = curl_exec($curl);
            $responseic = json_decode($response, true);
            curl_close($curl);






            //   echo $statuscheck = $responseic['status'];
            echo "<br>";
            echo $statuscheck = $responseic['0']['success'];

            $tdateis = date('Y-m-d'); // Assuming this is the current date

            if ($responseic['0']['success']) {
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order delete please refresh page if not deleted";

                bulkorders::where('Awb_Number', $awb)->update([
                    'canceldate' => $tdateis,
                    'order_status_show' => "Cancel",
                    'order_cancel_reasion' => $cancelreason
                ]);
            }
            if (!$responseic['0']['success']) {
                $cancelstatus = "Cancel";

                echo  $alertmsg = $responseic['0']['reason'];
                bulkorders::where('Awb_Number', $awb)->update([
                    'canceldate' => $tdateis,
                    'order_status_show' => "Cancel",
                    'order_cancel_reasion' => $alertmsg
                ]);
            }
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            \Log::error('Exception occurred during cancelEcomOrder: ' . $e->getMessage());
            // You may want to throw the exception again to propagate it up
            // throw $e;
        }
    }

    private function cancelXpressbee2Order($awb)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'glamfuseindia67@gmail.com',
            'password' => 'shyam104A@',
        ]);

        $responseData = $response->json();
        $xpressbeetoken = $responseData['data'];

        // Make the cancel shipment API call using the token
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $xpressbeetoken,
        ])->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
            'awb' => $awb,
        ]);
        $responseData1 = $response->json();

        echo "<br><pre>";
        print_r($responseData1);
        echo "</pre><br>";

        // return $response->json();
        $tdateis = date('Y-m-d'); // Assuming this is the current date
        $statuscheck = $responseData1['status'];
        if ($statuscheck == true) {
            // echo $responseic['message'];
            $tdateis =  $tdateis;
            $cancelint = 1;
            $cancelstatus = "Cancel";
            $cancelreason = "Client Cancel";
            $alertmsg = "Order delete please refresh page if not deleted";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => $cancelstatus,
                    'order_cancel_reasion' => $cancelreason
                ]);
        } elseif ($statuscheck == false) {
            // echo $responseic['message'];
            $alertmsg = "Order not delete please try again";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => "Cancel",
                    'order_cancel_reasion' => $alertmsg
                ]);
        }
    }
    private function cancelXpressbee3Order($awb)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'Ballyfashion77@gmail.com',
            'password' => 'shyam104A@',
        ]);

        $responseData = $response->json();
        $xpressbeetoken = $responseData['data'];

        // Make the cancel shipment API call using the token
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $xpressbeetoken,
        ])->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
            'awb' => $awb,
        ]);
        $responseData1 = $response->json();

        echo "<br><pre>";
        print_r($responseData1);
        echo "</pre><br>";

        // return $response->json();
        $tdateis = date('Y-m-d'); // Assuming this is the current date
        $statuscheck = $responseData1['status'];
        if ($statuscheck == true) {
            // echo $responseic['message'];
            $tdateis =  $tdateis;
            $cancelint = 1;
            $cancelstatus = "Cancel";
            $cancelreason = "Client Cancel";
            $alertmsg = "Order delete please refresh page if not deleted";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => $cancelstatus,
                    'order_cancel_reasion' => $cancelreason
                ]);
        } elseif ($statuscheck == false) {
            // echo $responseic['message'];
            $alertmsg = "Order not delete please try again";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => "Cancel",
                    'order_cancel_reasion' => $alertmsg
                ]);
        }
    }
    private function cancelXpressbeeOrder($awb)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'glamfuseindia67@gmail.com',
            'password' => 'shyam104A@',
        ]);

        $responseData = $response->json();
        $xpressbeetoken = $responseData['data'];

        // Make the cancel shipment API call using the token
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $xpressbeetoken,
        ])->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
            'awb' => $awb,
        ]);
        $responseData1 = $response->json();

        echo "<br><pre>";
        print_r($responseData1);
        echo "</pre><br>";

        // return $response->json();
        $tdateis = date('Y-m-d'); // Assuming this is the current date
        $statuscheck = $responseData1['status'];
        if ($statuscheck == true) {
            // echo $responseic['message'];
            $tdateis =  $tdateis;
            $cancelint = 1;
            $cancelstatus = "Cancel";
            $cancelreason = "Client Cancel";
            $alertmsg = "Order delete please refresh page if not deleted";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => $cancelstatus,
                    'order_cancel_reasion' => $cancelreason
                ]);
        } elseif ($statuscheck == false) {
            // echo $responseic['message'];
            $alertmsg = "Order not delete please try again";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => "Cancel",
                    'order_cancel_reasion' => $alertmsg
                ]);
        }
    }
    private function cancelBluedartOrder($shipment_id)
    {
        // Authenticate and get the token
        $authResponse = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            "email" => "info@shipnick.com",
            "password" => "8mVxTvH)6g8v"
        ]);

        $authData = $authResponse->json();

        // Check if authentication was successful and token is received
        if (isset($authData['token'])) {
            $token = $authData['token'];
        } else {
            echo "Authentication failed!";
            return;
        }

        // Cancel the order using the received token
        $cancelResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->post('https://apiv2.shiprocket.in/v1/external/orders/cancel', [
            'ids' => [$shipment_id]
        ]);

        $cancelData = $cancelResponse->json();

        echo "<br><pre>";
        print_r($cancelData);
        echo "</pre><br>";
        echo $shipment_id;

        $currentDate = date('Y-m-d'); // Current date

        // Check if the 'status' key exists in the response data
        if (isset($cancelData['status']) && $cancelData['status'] == 200) {
            $cancelStatus = "Cancel";
            $cancelReason = "Client Cancel";
            $alertMsg = "Order deleted. Please refresh the page if not deleted.";

            bulkorders::where('shferrors', $shipment_id)
                ->update([
                    'canceldate' => $currentDate,
                    'order_status_show' => $cancelStatus,
                    'order_cancel_reasion' => $cancelReason
                ]);
        } else {
            $alertMsg = "Order not deleted. Please try again.";

            // Check for error messages in the response data
            // $errorMessage = isset($cancelData['message']) ? $cancelData['message'] : $alertMsg;


            bulkorders::where('shferrors', $shipment_id)
                ->update([
                    'canceldate' => $currentDate,
                    'order_cancel_reasion' => 'canceled',
                    'order_status_show' => 'Cancel'
                ]);
        }
    }
    private function cancelbluedart_scOrder($courier_ship_no)
    {
        $response = Http::post('https://www.shipclues.com/api/order-cancel', [
            'ApiKey' => 'TdRxkE0nJd4R78hfEGSz2P5CAIeqzUtZ84EFDUX9',
            'OrderID' => $courier_ship_no,
        ]);



        $responseData1 = $response->json();
        $tdateis = date('Y-m-d'); // Assuming this is the current date
        $statuscheck = $responseData1['status'];
        if ($statuscheck == true) {
            // echo $responseic['message'];
            $tdateis =  $tdateis;

            $alertmsg = "Order delete please refresh page if not deleted";
            bulkorders::where('courier_ship_no', $courier_ship_no)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' =>  "Cancel",
                    'order_cancel_reasion' => "Client Cancel"
                ]);
        } else {
            // echo $responseic['message'];
            $alertmsg = "Order not delete please try again";
            bulkorders::where('Awb_Number', $awb)
                ->update([

                    'canceldate' => $tdateis,
                    'order_status_show' => "Cancel",
                    'order_cancel_reasion' => $alertmsg
                ]);
        }
    }
}
