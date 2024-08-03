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

  
class APIBigShip extends Controller
{
    public function page_error()
    {
        return view('UserPanel/page-error-503');
    }
    // API first Flow Start
    public function OrderPlaceToCourier()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(80)
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                                    'password' => 'Xpress@5200',
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
                                        'showerrors'=>'pending pickup' ,
                                        'awb_gen_by' => 'Xpressbee',
                                        'awb_gen_courier' => 'Xpressbee'
                                    ]);
                                } else {
                                    $errmessage = $responseData['message'];
                                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                                        'showerrors' => $errmessage,
                                        'order_status_show' => $errmessage,
                                        'dtdcerrors'=> '1'
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
                 elseif ($courierapicodeno == "xpressbee0") {
                    echo "<br>xpressbee Start<br>";
                    $thisgenerateawbno = "";

                    // Login to get Xpressbee token
                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post('https://shipment.xpressbees.com/api/users/login', [
                        'email' => 'shipnick11@gmail.com',
                        'password' => 'Xpress@5200',
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
                            'awb_gen_by' => 'Xpressbee',
                            'awb_gen_courier' => 'Xpressbee'
                        ]);
                    } else 
                    {
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
                                    bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom','showerrors' => 'booked']);
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

            $responseData = $response->json();
            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";

            if (isset($responseData['shipment_id'])) {
                $shipment_id = $responseData['shipment_id'];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ])->post('https://apiv2.shiprocket.in/v1/external/courier/assign/awb', [
                    "shipment_id" => $shipment_id
                ]);

                if ($response->successful()) {
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
                }else {
                    $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                       'showerrors'=>$error
                    ]); } 
            } 
        } 
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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
                }else {
                    $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                       'showerrors'=>$error
                    ]); } 
            } 
        } 
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} 
                        }
                    }

                    
                }
                elseif ($courierapicodeno == "xpressbee02") {
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
                            'awb_gen_by' => 'Xpressbee',
                            'awb_gen_courier' => 'Xpressbee'
                        ]);
                    } else 
                    {
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
                                    bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom','showerrors' => 'booked']);
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

            $responseData = $response->json();
            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";

            if (isset($responseData['shipment_id'])) {
                $shipment_id = $responseData['shipment_id'];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ])->post('https://apiv2.shiprocket.in/v1/external/courier/assign/awb', [
                    "shipment_id" => $shipment_id
                ]);

                if ($response->successful()) {
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
                }else {
                    $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                       'showerrors'=>$error
                    ]); } 
            } 
        } 
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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
                }else {
                    $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                       'showerrors'=>$error
                    ]); } 
            } 
        } 
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} 
                        }
                    }

                    
                }
                elseif ($courierapicodeno == "bluedart0") {
    echo "<br>bluedart Start<br>";
    $thisgenerateawbno = "";
    $hubtitle = Hubs::where('hub_id', $pkpkid)->first()->hub_title;

    // Ecom Section Start
    error_reporting(1);
    // Ecom Order Place

    try {
        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            "email" => "info@shipnick.com",
            "password" => "8mVxTvH)6g8v"
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            $token = $responseData['token'];
            echo $token;

            echo $idate;
            echo "<br>";
            $ecomdate = date_create($idate);
            echo "<br>";
            echo $invicedateecom = date_format($ecomdate, "d-m-Y");
            echo "<br>";

            echo "ecom manifest";
            echo "<br>";

            if ($paymentmode == 'prepaid') {
                $paymentmode = "prepaid";
            }
            echo $paymentmode;

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
                "shipping_customer_name" => "",
                "shipping_last_name" => "",
                "shipping_address" => "",
                "shipping_address_2" => "",
                "shipping_city" => "",
                "shipping_pincode" => "",
                "shipping_country" => "",
                "shipping_state" => "",
                "shipping_email" => "",
                "shipping_phone" => "",
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

            $responseData = $response->json();
            echo "<br><pre>";
            print_r($responseData);
            echo "</pre><br>";
            echo "<br>";

            if (isset($responseData['shipment_id'])) {
                $shipment_id = $responseData['shipment_id'];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ])->post('https://apiv2.shiprocket.in/v1/external/courier/assign/awb', [
                    "shipment_id" => $shipment_id
                ]);

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $awb = $responseData['response']['data']['awb_code'];
                    echo $order_id = $responseData['response']['data']['order_id'];
                    echo $shipment_id = $responseData['response']['data']['shipment_id'];
                    echo $routing_code = $responseData['response']['data']['routing_code'];

                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                        'courier_ship_no' => $shipment_id,
                        'Awb_Number' => $awb,
                        'dtdcerrors' => $routing_code,
                        'shferrors' => $order_id,
                        'awb_gen_by' => 'Bluedart',
                        'awb_gen_courier' => 'Bluedart'
                    ]);
                } else {
                    $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                       'showerrors'=>$error
                    ]);
                    // Handle error
                    echo "Failed to assign AWB. Response: ";
                    print_r($response->json());
                    
                    
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
                    'password' => 'Xpress@5200',
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
                        'showerrors'=>'pending pickup' ,
                        'awb_gen_by' => 'Xpressbee',
                        'awb_gen_courier' => 'Xpressbee'
                    ]);
                } else {
                    $errmessage = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                        'showerrors' => $errmessage,
                        'order_status_show' => $errmessage,
                        'dtdcerrors'=> '1'
                    ]);

                    
                }
            }
            if ($courierapicodeno == "ecom01") {
                echo "<br>Ecom Start<br>";
                $thisgenerateawbno = "";
                // Ecom Section Start
                error_reporting(1);
                // Ecom Order Place




                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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
                    bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom','showerrors' => 'booked']);
                } else {
                    echo "<br>else section <br>";
                    // $errormsg = $responseio['response'];
                    // $errormsg = "Ecom internal error 500";
                    if (!empty($responseecom['shipments'][0]['reason'])) {
                        $errormsg = $responseecom['shipments'][0]['reason'];
                    } elseif ($eominvalidawbs == "2") {
                        $errormsg = "Awb not found";
                    } else {
                        $errormsg = "Ecom internal error 500";
                    }
                    bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg, 'Awb_Number' => '']);
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
            } else {
                // Handle error
                echo "Failed to create order. Response: ";
                print_r($responseData);
                 $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                       'showerrors'=>$error
                    ]);
            }
        } else {
            // Handle login failure
            echo "Failed to login. Response: ";
            print_r($response->json());
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}else {
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
                    'password' => 'Xpress@5200',
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
                        'showerrors'=>'pending pickup' ,
                        'awb_gen_by' => 'Xpressbee',
                        'awb_gen_courier' => 'Xpressbee'
                    ]);
                } else {
                    $errmessage = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                        'showerrors' => $errmessage,
                        'order_status_show' => $errmessage,
                        'dtdcerrors'=> '1'
                    ]);

                    
                }
            }
            if ($courierapicodeno == "ecom01") {
                echo "<br>Ecom Start<br>";
                $thisgenerateawbno = "";
                // Ecom Section Start
                error_reporting(1);
                // Ecom Order Place




                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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
                    bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom','showerrors' => 'booked']);
                } else {
                    echo "<br>else section <br>";
                    // $errormsg = $responseio['response'];
                    // $errormsg = "Ecom internal error 500";
                    if (!empty($responseecom['shipments'][0]['reason'])) {
                        $errormsg = $responseecom['shipments'][0]['reason'];
                    } elseif ($eominvalidawbs == "2") {
                        $errormsg = "Awb not found";
                    } else {
                        $errormsg = "Ecom internal error 500";
                    }
                    bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg, 'Awb_Number' => '']);
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
        }
    }
    
    
    
    public function OrderPlaceToCourier000122()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(80)
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
               if ($courierapicodeno == "ecom01") {
        echo "<br>Ecom Start<br>";
        $thisgenerateawbno = "";
    
        // Ecom Section Start
        error_reporting(1);
    
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options for the POST request
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                'password' => 'lnR1C8NkO1',
                'count' => '1',
                'type' => 'EXPP'
            )),
        ));
    
        // Execute cURL request
        $response = curl_exec($curl);
        $response = json_decode($response, true);
    
        // Check for cURL errors
        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
            // Handle error as needed
        }
    
        // Close cURL session
        curl_close($curl);
    
        // Check if AWB number is retrieved successfully
        if (isset($response['awb'][0])) {
            $ecomawbnois = $response['awb'][0]; // Extract AWB number from response
            echo "AWB Number: " . $ecomawbnois . "<br>";
    
            // Format date for invoice
            $ecomdate = date_create($idate);
            $invicedateecom = date_format($ecomdate, "d-m-Y");
    
            echo "Invoice Date: " . $invicedateecom . "<br>";
            echo "Payment Mode: " . $paymentmode . "<br>";
    
            // Prepare JSON data for manifest API request
            $manifestData = json_encode(array(
                array(
                    "AWB_NUMBER" => $ecomawbnois,
                    "ORDER_NUMBER" => $orderno,
                    "PRODUCT" => $paymentmode == 'prepaid' ? "PPD" : "", // Adjust as per your logic
                    "CONSIGNEE" => $daname,
                    "CONSIGNEE_ADDRESS1" => $daadrs,
                    "CONSIGNEE_ADDRESS2" => "",
                    "CONSIGNEE_ADDRESS3" => "",
                    "DESTINATION_CITY" => $dacity,
                    "PINCODE" => $dapin,
                    "STATE" => $dastate,
                    "MOBILE" => $damob,
                    "TELEPHONE" => $damob,
                    "ITEM_DESCRIPTION" => $iname,
                    "PIECES" => $iqlty,
                    "COLLECTABLE_VALUE" => $icoda,
                    "DECLARED_VALUE" => $itamt,
                    "ACTUAL_WEIGHT" => $iacwt,
                    "VOLUMETRIC_WEIGHT" => $ivlwt,
                    "LENGTH" => $ilgth,
                    "BREADTH" => $iwith,
                    "HEIGHT" => $ihght,
                    "PICKUP_NAME" => $pkpkname,
                    "PICKUP_ADDRESS_LINE1" => $pkpkaddr,
                    "PICKUP_ADDRESS_LINE2" => "",
                    "PICKUP_PINCODE" => $pkpkpinc,
                    "PICKUP_PHONE" => $pkpkmble,
                    "PICKUP_MOBILE" => $pkpkmble,
                    "RETURN_NAME" => $pkpkname,
                    "RETURN_ADDRESS_LINE1" => $pkpkaddr,
                    "RETURN_ADDRESS_LINE2" => "",
                    "RETURN_PINCODE" => $pkpkpinc,
                    "RETURN_PHONE" => $pkpkmble,
                    "RETURN_MOBILE" => "",
                    "DG_SHIPMENT" => "false",
                    "ADDITIONAL_INFORMATION" => array(
                        "GST_TAX_CGSTN" => 0,
                        "GST_TAX_IGSTN" => 0,
                        "GST_TAX_SGSTN" => 0,
                        "SELLER_GSTIN" => "",
                        "INVOICE_DATE" => $orderno,
                        "INVOICE_NUMBER" => $invicedateecom,
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
            ));
    
            // URL for manifest API endpoint
            $manifestUrl = 'https://shipment.ecomexpress.in/services/expp/manifest/v2/expplus/';
    
            // Initialize cURL session for manifest API request
            $curlManifest = curl_init($manifestUrl);
    
            // Set cURL options for manifest API POST request
            curl_setopt_array($curlManifest, array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                    'password' => 'lnR1C8NkO1',
                    'json_input' => $manifestData,
                )),
                CURLOPT_RETURNTRANSFER => true,
            ));
    
            // Execute cURL request for manifest API
            $responseManifest = curl_exec($curlManifest);
            $responseecom = json_decode($responseManifest, true);
    
            // Check if manifest API call was successful
            if (isset($responseecom['shipments'][0]['success']) && $responseecom['shipments'][0]['success']) {
                echo "Manifest API request successful.<br>";
    
                // Update database with AWB and other details
                bulkorders::where('Single_Order_Id', $crtidis)->update([
                    'courier_ship_no' => $responseecom['shipments'][0]['order_number'],
                    'Awb_Number' => $responseecom['shipments'][0]['awb'],
                    'awb_gen_by' => 'Ecom',
                    'awb_gen_courier' => 'Ecom'
                ]);
    
                // Break out of the loop since AWB number is generated
                break;
            } else {
                echo "Manifest API request failed.<br>";
                // Handle error response from manifest API
                $errormsg = "Ecom manifest API error";
                // Log or handle error as needed
                continue; // Continue to next courier API
            }
    
            // Close cURL session for manifest API
            curl_close($curlManifest);
        } else {
            echo "Failed to retrieve AWB number from Ecom API.<br>";
            // Handle AWB retrieval failure
            continue; // Continue to next courier API
        }
    } elseif ($courierapicodeno == "xpressbee0") {
        echo "<br>xpressbee Start<br>";
        $thisgenerateawbno = "";
    
        // Login to get Xpressbee token
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'shipnick11@gmail.com',
            'password' => 'Xpress@5200',
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
                'awb_gen_by' => 'Xpressbee',
                'awb_gen_courier' => 'Xpressbee'
            ]);
            break;
        } else 
        {
            $errmessage = $responseData['message'];
            bulkorders::where('Single_Order_Id', $crtidis)->update([
                'showerrors' => $errmessage,
                'order_status_show' => $errmessage
            ]);
    
            continue;
    
                               }
    
        
    } elseif ($courierapicodeno == "bluedart0") {
        echo "<br>bluedart Start<br>";
        $thisgenerateawbno = "";
        $hubtitle = Hubs::where('hub_id', $pkpkid)->first()->hub_title;
    
        try {
            // Ecom Order Place
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
    
                echo "ecom manifest";
                echo "<br>";
    
                // Normalize payment mode
                if ($paymentmode == 'prepaid') {
                    $paymentmode = "prepaid";
                }
                echo $paymentmode;
    
                // Create adhoc order
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
                    "billing_phone" => $damob,
                    "order_items" => [
                        [
                            "name" => $iname,
                            "sku" => $iival,
                            "units" => $iqlty,
                            "selling_price" => $itamt,
                            "hsn" => ""
                        ]
                    ],
                    "payment_method" => $paymentmode,
                    "sub_total" => $icoda,
                    "length" => $ilgth,
                    "breadth" => $iwith,
                    "height" => $ihght,
                    "weight" => $iacwt,
                    "order_type" => 'ESSENTIALS'
                ]);
    
                if ($response->successful()) {
                    $responseData = $response->json();
                    $shipment_id = $responseData['shipment_id'];
    
                    // Assign AWB
                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token
                    ])->post('https://apiv2.shiprocket.in/v1/external/courier/assign/awb', [
                        "shipment_id" => $shipment_id
                    ]);
    
                    if ($response->successful()) {
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
                            'awb_gen_courier' => 'Bluedart'
                        ]);
                        break;
                    } else {
                        $responseData = $response->json();
                        $error = $responseData['message'];
                        bulkorders::where('Single_Order_Id', $crtidis)->update([
                            'showerrors' => $error
                        ]);
                        continue;
                    }
                } else {
                    // Handle error creating order
                    $responseData = $response->json();
                    $error = $responseData['message'];
                    bulkorders::where('Single_Order_Id', $crtidis)->update([
                        'showerrors' => $error
                    ]);
                    continue;
                }
            } else {
                // Handle login failure
                echo "Failed to login. Response: ";
                print_r($response->json());
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    } else {
        // Handle any other couriers as needed
        echo "Unknown courier code: $courierapicodeno<br>";
        continue; // Continue to next courier API
    }


            }
        }
    }
   public function addhubinshiprocket()
{
    $params = Hubs::where('Shiprocket_hub_id', NULL)
        ->orderBy('hub_id', 'DESC')
        ->limit(5)
        ->get();

    $loopno = 0; // Initialize the loop counter

    foreach ($params as $param) {
        $loopno++;

        // Extract hub details
        $hubid = $param->hub_id;
        $hub_title = $param->hub_title;
        $hub_name = $param->hub_name;
        $hub_mobile = $param->hub_mobile;
        $address = $param->hub_address1;
        $city = $param->hub_city;
        $state = $param->hub_state;
        $pin_code = $param->hub_pincode;

        // Authenticate with Shiprocket API
        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            "email" => "info@shipnick.com",
            "password" => "8mVxTvH)6g8v"
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            $token = $responseData['token'];

            // Add hub as a pickup location
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])->post('https://apiv2.shiprocket.in/v1/external/settings/company/addpickup', [
                "pickup_location" => $hub_title,
                "name" => $hub_name,
                "email" => "new123@gmail.com",
                "phone" => $hub_mobile,
                "address" => $address,
                "address_2" => '',
                "city" => $city,
                "state" => $state,
                "country" => "India",
                "pin_code" => $pin_code
            ]);

            $responseData = $response->json();
            if ($response->successful()) {
                $shiprocket_hubid = $responseData['address']['id'];
                Hubs::where('hub_id', $hubid)->update(['Shiprocket_hub_id' => $shiprocket_hubid]);
            } else {
                // Handle the error response
                $error = $responseData['errors']['address'][0] ?? 'Unknown error';
                Hubs::where('hub_id', $hubid)->update(['Shiprocket_hub_id' => $error]);
                echo "Failed to add pickup location for hub ID: " . $hubid . " - Error: " . $error . "<br>";
            }
        } else {
            // Handle the error response for login
            echo "Failed to authenticate with Shiprocket API for hub ID: " . $hubid . "<br>";
        }
    }
}

     public function OrderPlaceToCourier1()
    {

        $params = bulkorders::where('showerrors',  'Pincode not serviceable.')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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
                ->where('courier_priority',  '2')
                ->where('showerrors',  'Pincode not serviceable.')
                 ->whereDate('Rec_Time_Date', now()->toDateString()) 
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                       elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            // $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            // if ($warehouseid == "") {
            //     bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
            //     continue;
            // }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
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
        'awb_gen_by' => 'Xpressbee',
        'awb_gen_courier' => 'Xpressbee'
    ]);
} else {
    $errmessage = $responseData['message'];
    bulkorders::where('Single_Order_Id', $crtidis)->update([
        'showerrors' => $errmessage,
        'order_status_show' => $errmessage
    ]);
}

    // Intargos1 New End
}

            }
        }
    }
    // test is this 
    public function OrderPlaceToCourier11()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }

    // test2
    public function OrderPlaceToCourier2()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }

    // test3

    public function OrderPlaceToCourier3()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }

    // test4
    public function OrderPlaceToCourier4()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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
                }elseif ($courierapicodeno == "ecom01") {
                    echo "<br>Ecom Start<br>";
                    $thisgenerateawbno = "";
                    // Ecom Section Start
                    error_reporting(1);
                    // Ecom Order Place




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }
    // test5
    public function OrderPlaceToCourier5()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }
    // test6
    public function OrderPlaceToCourier6()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }
    // test7
    public function OrderPlaceToCourier7()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }

    // test8
    public function OrderPlaceToCourier8()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

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
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
                    }
                    // Ecom Order Place End //
                    // Ecom Section End
                    // echo "<br>Ecom End<br>";

                    if ($thisgenerateawbno) {
                        break;
                    }
                }
                 elseif ($courierapicodeno == "xpressbee0") {
            echo "<br>xpressbee Start<br>";
            $thisgenerateawbno = "";
        
            // Smartship token and warehouse Smartship ID 
            // $xpressbeetoken = smartship::where('id', 2)->first()->token;
            $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
            if ($warehouseid == "") {
                bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                continue;
            }
        
            // Login to get Xpressbee token
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://shipment.xpressbees.com/api/users/login', [
                'email' => 'shipnick11@gmail.com',
                'password' => 'Xpress@5200',
            ]);
        
            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;
        
            // Start order using Xpressbee API
            if ($paymentmode == 'COD') {
                $paymentmode = "cod";
            }

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
                'order_amount' => $icoda,
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
        
            if ($responseData['status'] == "1") {
                $awb = $responseData['data']['awb_number'];
                $shipno = $responseData['data']['shipment_id'];
                $orderno = $responseData['data']['order_id'];
        
                bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $shipno, 'Awb_Number' => $awb, 'awb_gen_by' => 'Xpressbee',  'awb_gen_courier' => 'Xpressbee']);
            } else {
                $errmessage = $responseData['message'];
                bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
            }
    // Intargos1 New End
}
            }
        }
    }
    // test9
    public function OrderPlaceToCourier9()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(800)
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
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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




                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://clbeta.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('username' => 'internaltest_staging', 'password' => '@^2%d@xhH^=9xK4U', 'count' => '1', 'type' => 'EXPP'),
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

                    if($paymentmode=='prepaid'){$paymentmode = "PPD";  }
                    echo $paymentmode ; 

                        echo "<br><pre>";
                                        print_r(($data));
                                        echo "</pre><br>";


                    // URL of the endpoint
                        $url = 'https://clbeta.ecomexpress.in/services/expp/manifest/v2/expplus/';

                        // Data to be sent in the POST request
                        $postData = array(
                            'username' => 'internaltest_staging',
                            'password' => '@^2%d@xhH^=9xK4U',
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
                        
                    //     echo "<br><pre>";
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
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $ecomorderid, 'Awb_Number' => $ecomawbnois, 'awb_gen_by' => $carrierby, 'awb_gen_courier' => 'Ecom']);
                    } else {
                        echo "<br>else section <br>";
                        // $errormsg = $responseio['response'];
                        // $errormsg = "Ecom internal error 500";
                        if (!empty($responseecom['shipments'][0]['reason'])) {
                            $errormsg = $responseecom['shipments'][0]['reason'];
                        } elseif ($eominvalidawbs == "2") {
                            $errormsg = "Awb not found";
                        } else {
                            $errormsg = "Ecom internal error 500";
                        }
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errormsg]);
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



    // Parcelx courier
    public function OrderPlaceToCourier10()
    {

        $params = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(100)
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
            // Parcelx Courier
            $loopno++;
            $crtidis = $param->Single_Order_Id;
            $paymentmode = $param->Order_Type;
            $userid = $param->User_Id;

            if (empty($paymentmode)) {
                $paymentmode = "COD";
            }
            if ($paymentmode == "Prepaid") {
                $paymentmode = "prepaid";
            }
            $orderno = $param->orderno;
            $autogenorderno = $param->ordernoapi;
            $iacwt = 0;
            // Destination Address
            $daname = $param->Name;
            $daadrs = $param->Address;
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
            echo "Courierstart first<br>";
            foreach ($finalcourierlists as $courierapicodeno) {
                echo $courierapicodeno;
                if ($courierapicodeno == "pclx") {

                    echo "<br>Parcelx Start<br>";
                    $thisgenerateawbno = "";

                    // Parcelx Hub ID
                    // $smartshiptoken = smartship::where('id', 1)->first()->token;
                    $warehouseid = Hubs::where('hub_id', $pkpkid)->first()->smartship_hubid;
                    if ($warehouseid == "") {
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 0]);
                        continue;
                    }



                    $parlextoken = '90201ea127961e937c83f8033cb3559e603301';
                    // Wharehouse Generate
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://app.parcelx.in/api/v1/create_warehouse',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                    "address_title":"' . $pkpkname . '",
                    "sender_name":"' . $daname . '",
                    "full_address":"' . $pkpkaddr . '",
                    "phone":"' . $pkpkmble . '",
                    "pincode":"' . $pkpkpinc . '"
                    }',
                        CURLOPT_HTTPHEADER => array(
                            "access-token: $parlextoken",
                            'Content-Type: application/json'
                        ),
                    ));

                    $responseco1 = curl_exec($curl);
                    $responseco1 = json_decode($responseco1, true);
                    curl_close($curl);
                    // echo "</pre><br>";

                    $wharehousecode = $responseco1['responsemsg'];
                    // Wharehouse Generate





                    // Parcelx api start Order Place
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://app.parcelx.in/api/v1/order/create_order',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                        "client_order_id":"' . $orderno . '",
                        "consignee_emailid": "",
                        "consignee_pincode": "' . $dapin . '",
                        "consignee_mobile": "' . $damob . '",
                        "consignee_phone": "",
                        "consignee_address1": "' . $daadrs . '",
                        "consignee_address2": "' . $daadrs . '",
                        "consignee_name": "' . $daname . '",
                        "invoice_number": "' . $orderno . '",
                        "express_type": "surface",
                        "pick_address_id": "' . $wharehousecode . '",
                        "return_address_id": "",
                        "cod_amount": "0",
                        "tax_amount": "0",
                        "mps": "0",
                        "courier_type":0, 
                        "courier_code":"",
                        "products": [
                            {
                                "product_sku": "' . $orderno . '",
                                "product_name": "' . $iname . '",
                                "product_value": "' . $itamt . '",
                                "product_hsnsac": "",
                                "product_taxper": 0,
                                "product_category": "",
                                "product_quantity": "' . $iqlty . '",
                                "product_description": ""
                            }
                        ],
                        "address_type": "Home",
                        "payment_mode": "Prepaid",
                        "order_amount": "' . $icoda . '",
                        "extra_charges": "0",
                        "shipment_width": ["' . $iwith . '"],
                        "shipment_height": ["' . $ihght . '"],
                        "shipment_length": ["' . $ilgth . '"],
                        "shipment_weight": ["' . $iacwt . '"]
                        }',
                        CURLOPT_HTTPHEADER => array(
                            "access-token: $parlextoken",
                            'Content-Type: application/json'
                        ),
                    ));


                    $responseco = curl_exec($curl);
                    $responseco = json_decode($responseco, true);
                    curl_close($curl);
                    // echo "</pre><br>";

                    @$checkerror = $responseco['responsemsg'];
                    if ($status) {
                        echo "<br> its not error on values <br>";
                    } else {
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $checkerror, 'order_status_show' => $checkerror]);
                    }

                    echo "<br><pre>";
                    print_r(($responseco));
                    echo "</pre><br>";
                    // Parcelx api  Order Place End //
                    @$carrierby = $responseco['data']['success_order_details']['orders']['0']['carrier_name'];


                    if ($status) {
                        $awbnosmartship = $responseco['data']['awb_number'];
                        $thisgenerateawbno =  $awbnosmartship;
                        $smartshiporderid = $responseco['data']['order_number'];
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['courier_ship_no' => $smartshiporderid, 'Awb_Number' => $awbnosmartship, 'awb_gen_by' => 'Parcelx', 'awb_gen_courier' => 'Parcelx']);
                    } elseif ($carrierby == 'NSS') {
                        echo 'Carrier NOT ASSIGNED';
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => 'Carrier NOT ASSIGNED']);
                    } else {
                        $errmessage = $responseco['data']['responsemsg'];
                        bulkorders::where('Single_Order_Id', $crtidis)->update(['showerrors' => $errmessage, 'order_status_show' => $errmessage]);
                    }
                }
            }
        }
    }
    public function OrderdetailsCourier()
    {

        $currentMonth = date('m');
        $date = Carbon::today()->subDays(30);
        $params = bulkorders::where('apihitornot', '1')
            ->where('Rec_Time_Date', '>', now()->subDays(12)->endOfDay())

            ->where('showerrors', '!=', 'Cancelled By Client')
            ->where('showerrors', '!=', 'Delivered')
            // ->where('Rec_Time_Date', date('m'))
            // ->whereRaw('MONTH(Rec_Time_Date) = ?',[$currentMonth])
            ->orderby('Single_Order_Id', 'DESC')
            ->get();

        // dd($params);

        // print_r($params);
        echo "Working Total Order : ";
        echo count($params);
        echo "<br><br>";
        // Update Selected Orders To Generate A AWB Number
        foreach ($params as $param) {
            $crtidis = $param->Single_Order_Id;
            // bulkorders::where('Single_Order_Id', $crtidis)->update(['apihitornot' => 1]);
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



            $ordeship = $param->courier_ship_no;
            // dd($ordeship);
            $autogenorderno = $param->ordernoapi;

            $iacwt = 0;


            echo " courierstart first<br>";



            echo "<br>smartship Start<br>";
            $thisgenerateawbno = "";

            // smartshiptoken and warehouse shmartship id 
            $smartshiptoken = smartship::where('id', 1)->first()->token;




            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.smartship.in/v2/app/Fulfillmentservice/orderDetails',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                     "filters":{
                     "filter_type":{
                     "and":{
                     "status":{
                     "status_code":"",
                     "check_type":""
                     },
                     "request_order_id":"",
                     "client_order_reference_id":"' . $autogenorderno . '",
                     "payment_type":"",
                     "created_date":{
                     "from":"",
                     "to":""
                     },
                     "updated_date":{
                     "from":"",
                     "to":""
                     }
                     }
                     }
                     },
                     "sort_by":{
                     "fields":"request_order_id",
                     "type":"desc"
                     },
                     "limit":{
                     "offset":0,
                     "limit":1
                     }
                    }
                    ',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    "Authorization: Bearer $smartshiptoken",
                ),
            ));


            $responseco = curl_exec($curl);
            $responseco = json_decode($responseco, true);
            curl_close($curl);
            echo "</pre><br>";

            echo "<br><pre>";
            print_r(($responseco));
            echo "</pre><br>";




            // smartship api  Order Place End //
            echo @$carrierby = $responseco['data']['orders_details'][$ordeship]['order_details']['status_description'];

            //   echo $awbno = $responseco['data']['orders_details'][$ordeship]['order_details']['awb_number'];

            @$carrierby = $responseco['data']['orders_details'][$ordeship]['order_details']['status_description'];
            bulkorders::where('Single_Order_Id', $crtidis)->update(['order_status_show' => $carrierby]);
        }
    }
    public function OrderPlaceToCourier121()
    {
        // echo file_get_contents('https://www.shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
         Http::get('https://shipnick.com/order-update-ecom');
         Http::get('https://shipnick.com/order-update-intransit-ecom');
         Http::get('https://shipnick.com/order-update-ofd-ecom');
         Http::get('https://www.shipnick.com/UPBulk_cancel_Order_API');
       
        
       
       
        

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
      echo  $courierare = $param->awb_gen_by;

        if ($courierare == "Ecom") {
            // Handle Ecom courier cancellation
            $response = $this->cancelEcomOrder($Awb);

            // Process response and update status accordingly
        } elseif ($courierare == "Xpressbee") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelXpressbeeOrder($Awb);

            // Process response and update status accordingly
        }
        elseif ($courierare == "Bluedart") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelBluedartOrder( $shipment_id);

            // Process response and update status accordingly
        }

        // Additional processing or logging can be done here
    }
} 

private function cancelEcomOrder($awb)
{
    try {
       $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/apiv2/cancel_awb/',
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
                    
                    
       
        

                   echo "<br><pre>";
print_r($responseic);
echo "</pre><br>";






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
                'order_status_show' => $cancelstatus,
                'order_cancel_reasion' => $cancelreason
            ]);
        } 
        if (!$responseic['0']['success']) {
            $cancelstatus = "Cancel";
            
            echo  $alertmsg = $responseic['0']['reason'];
            bulkorders::where('Awb_Number', $awb)->update([
                'canceldate' => $tdateis,
                'order_status_show' => $cancelstatus,
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



private function cancelXpressbeeOrder($awb)
{
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://shipment.xpressbees.com/api/users/login', [
        'email' => 'shipnick11@gmail.com',
        'password' => 'Xpress@5200',
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
                        
                        'canceldate'=>$tdateis,
                        'order_status_show' => $cancelstatus,
                        'order_cancel_reasion' => $cancelreason
                    ]);
                    }  elseif ($statuscheck == false) {
                        // echo $responseic['message'];
                        $alertmsg = "Order not delete please try again";
                        bulkorders::where('Awb_Number',$awb)
                        ->update([
                            
                            'canceldate'=>$tdateis,
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



}

