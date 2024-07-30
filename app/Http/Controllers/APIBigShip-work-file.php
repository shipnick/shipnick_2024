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




// API first Flow Start
public function OrderPlaceToCourier(){
      
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(10)
                    ->get();
$thisgenerateawbno = "";
// print_r($params);
echo "Working Total Order : ";
echo count($params);
echo "<br><br>";
// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
echo "<br><br><br>Current Loop NO is $loopno <br>";
// echo "Qid : ";
// echo $crtidis;
// echo "<br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){

echo "<br> Courier is : ";
echo $courierapicodeno;
echo "  |  Qid no : ";
echo $crtidis;
    if($courierapicodeno == "in01"){
echo "<br>Intargos Start<br>";
$thisgenerateawbno = "";
$thisgenerateawbno = "Intargos-010-".$crtidis;
// Intargos Section Start

    /*
// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID

    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "'.$ivlwt.'",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";

    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //
    */
     
if($thisgenerateawbno){
break;
}



// Intargos Section End
// echo "<br>Intargos End<br>";

    }elseif($courierapicodeno == "ecom01"){
echo "<br>Ecom Start<br>";
// Ecom Section Start
$thisgenerateawbno = "";
$thisgenerateawbno = "Ecom-010-".$crtidis;

/*
error_reporting(1);
    // Ecom Order Place


$ecomawbnofetchs = EcomAwbs::where('awbstatus','0')
                    ->where('awbcate',$paymentmode)
                    ->orderby('awbuid','ASC')
                    ->limit(1)
                    ->get();

// $ecomawbnois = "9360653631";
$ecomawbnois = $ecomawbnofetchs[0]['awbs'];

// foreach($ecomawbnofetchs as $ecomawbnofetch){
//     $ecomcrtidis = $ecomawbnofetch->awbuid ;
//     EcomAwbs::where('awbuid',$ecomcrtidis)->update(['awbstatus'=>1]);
// }

if(empty($ecomawbnois)){
    $eominvalidawbs = "2";
}else{
    foreach($ecomawbnofetchs as $ecomawbnofetch){
        $ecomcrtidis = $ecomawbnofetch->awbuid ;
        EcomAwbs::where('awbuid',$ecomcrtidis)->update(['awbstatus'=>1]);
    }
}


echo $idate;
echo "<br>";
$ecomdate=date_create($idate);
$invicedateecom = date_format($ecomdate,"d-m-Y");
echo "<br>";



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/manifest_awb/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('username' => 'ARTUINFOTECH898811','password' => '8y1LK5ileM','json_input' => '[
            {
                "AWB_NUMBER":"'.$ecomawbnois.'",
                "ORDER_NUMBER":"'.$orderno.'",
                "PRODUCT":"'.$paymentmode.'",
                "CONSIGNEE":"'.$daname.'",
                "CONSIGNEE_ADDRESS1":"'.$daadrs.'",
                "CONSIGNEE_ADDRESS2":"",
                "CONSIGNEE_ADDRESS3":"",
                "DESTINATION_CITY":"'.$dacity.'",
                "PINCODE":"'.$dapin.'",
                "STATE":"'.$dastate.'",
                "MOBILE":"'.$damob.'",
                "TELEPHONE":"'.$damob.'",
                "ITEM_DESCRIPTION":"'.$iname.'",
                "PIECES":'.$iqlty.',
                "COLLECTABLE_VALUE":'.$icoda.',
                "DECLARED_VALUE":'.$itamt.',
                "ACTUAL_WEIGHT":'.$iacwt.',
                "VOLUMETRIC_WEIGHT":'.$ivlwt.',
                "LENGTH":'.$ilgth.',
                "BREADTH":'.$iwith.',
                "HEIGHT":'.$ihght.',
                "PICKUP_NAME":"'.$pkpkname.'",
                "PICKUP_ADDRESS_LINE1":"'.$pkpkaddr.'",
                "PICKUP_ADDRESS_LINE2":"",
                "PICKUP_PINCODE":"'.$pkpkpinc.'",
                "PICKUP_PHONE":"'.$pkpkmble.'",
                "PICKUP_MOBILE":"'.$pkpkmble.'",
                "RETURN_NAME":"'.$pkpkname.'",
                "RETURN_ADDRESS_LINE1":"'.$pkpkaddr.'",
                "RETURN_ADDRESS_LINE2":"",
                "RETURN_PINCODE":"'.$pkpkpinc.'",
                "RETURN_PHONE":"'.$pkpkmble.'",
                "RETURN_MOBILE":"",
                "ADDONSERVICE":[""],
                "DG_SHIPMENT":"false",
                "ADDITIONAL_INFORMATION":
                {
                    "essentialProduct":"Y",
                    "OTP_REQUIRED_FOR_DELIVERY":"Y",
                    "DELIVERY_TYPE":"",
                    "SELLER_TIN":"",
                    "INVOICE_NUMBER":"'.$orderno.'",
                    "INVOICE_DATE":"'.$invicedateecom.'",
                    "ESUGAM_NUMBER":"",
                    "ITEM_CATEGORY":"",
                    "PACKING_TYPE":"",
                    "PICKUP_TYPE":"",
                    "RETURN_TYPE":"",
                    "CONSIGNEE_ADDRESS_TYPE":"",
                    "PICKUP_LOCATION_CODE":"",
                    "SELLER_GSTIN":"",
                    "GST_HSN":"",
                    "GST_ERN":"",
                    "GST_TAX_NAME":"",
                    "GST_TAX_BASE":0,
                    "DISCOUNT":0,
                    "GST_TAX_RATE_CGSTN":0,
                    "GST_TAX_RATE_SGSTN":0,
                    "GST_TAX_RATE_IGSTN":0,
                    "GST_TAX_TOTAL":0,
                    "GST_TAX_CGSTN":0,
                    "GST_TAX_SGSTN":0,
                    "GST_TAX_IGSTN":0
                }
          }
        ]
'),
));

$response = curl_exec($curl);
$responseecom = json_decode($response, true);
curl_close($curl);
// echo $response;


// echo "<br>* -   *   -  Start *   -   *   -   <br>";
// echo "<br>";
// print_r($responseecom);
// echo "<br>* -   *   -   End *   -   *   -   <br>";
// exit();



    if($responseecom['shipments'][0]['success']){
        echo "<br>if section <br>";
        $ecomawbnois = $responseecom['shipments'][0]['awb'];
        $carrierby = "Ecom";
        $ecomorderid = $responseecom['shipments'][0]['order_number'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$ecomorderid,'Awb_Number'=>$ecomawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Ecom']);
    }else{
        echo "<br>else section <br>";
        // $errormsg = $responseio['response'];
        // $errormsg = "Ecom internal error 500";
        if(!empty($responseecom['shipments'][0]['reason'])){
            $errormsg = $responseecom['shipments'][0]['reason'];
        }elseif($eominvalidawbs=="2"){
            $errormsg = "Awb not found";
        }else{
            $errormsg = "Ecom internal error 500";
        }
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // Ecom Order Place End //
    */
if($thisgenerateawbno){
break;
}



// Ecom Section End
// echo "<br>Ecom End<br>";




}elseif($courierapicodeno == "sfax01"){
echo "<br>Shadowfax Start<br>";
// Shadowfax Section Start
$thisgenerateawbno = "";
$thisgenerateawbno = "Shadowfax-010-".$crtidis;

/*
error_reporting(1);
    // Shadowfax Order Place


if(empty($paymentmode)){    $paymentmode = "COD";   }
if($paymentmode == "PPD"){  $paymentmode = "Prepaid";   }


echo $idate;
echo "<br>";
$sfaxdate=date_create($idate);
$invicedatesfax = date_format($sfaxdate,"Y-m-d");
echo "<br>";




$shfxrowdata = '{
  "order_type": "'.$pkpkname.'",
  "order_details": {
      "client_order_id": "'.$orderno.'",
      "actual_weight": '.$iacwt.',
      "volumetric_weight": '.$ivlwt.',
      "product_value": '.$itamt.',
      "payment_mode": "'.$paymentmode.'",
      "cod_amount": "'.$icoda.'",
      "promised_delivery_date": "'.$invicedatesfax.'",
      "total_amount": '.$itamt.',
      "eway_bill": "'.$orderno.'",
      "order_service": "ndd"
  },
  "customer_details": {
      "name": "'.$daname.'",
      "contact": "'.$damob.'",
      "address_line_1": "'.$daadrs.'",
      "address_line_2": "",
      "city": "'.$dacity.'",
      "state": "'.$dastate.'",
      "pincode": '.$dapin.',
      "alternate_contact": "'.$damob.'",
      "latitude": "",
      "longitude": ""
  },
  "pickup_details": {
      "name": "'.$pkpkname.'",
      "contact": "'.$pkpkmble.'",
      "address_line_1": "'.$pkpkaddr.'",
      "address_line_2": "",
      "city": "'.$pkpkcity.'",
      "state": "'.$pkpkstte.'",
      "pincode": '.$pkpkpinc.',
      "latitude": "",
      "longitude": ""
  },
  "rts_details": {
      "name": "'.$pkpkname.'",
      "contact": "'.$pkpkmble.'",
      "address_line_1": "'.$pkpkaddr.'",
      "address_line_2": "",
      "city": "'.$pkpkcity.'",
      "state": "'.$pkpkstte.'",
      "pincode": '.$pkpkpinc.',
      "email": ""
  },
  "product_details": [
      {
          "hsn_code": "'.$orderno.'",
          "invoice_no": "'.$orderno.'",
          "sku_name": "'.$iname.'",
          "sku_id": "'.$orderno.'",
          "category": "",
          "price": '.$itamt.',
          "seller_details": {
              "seller_name": "'.$pkpkname.'",
              "seller_address": "'.$pkpkaddr.'",
              "seller_state": "'.$pkpkstte.'",
              "gstin_number": ""
          },
          "taxes": {
              "cgst": 0,
              "sgst": 0,
              "igst": 0,
              "total_tax": 0
          },
          "additional_details": {
              "requires_extra_care": "False",
              "type_extra_care": "Dangerous Goods"
          }
      }
  ]
}';

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://dale.shadowfax.in/api/v3/clients/orders/?format=json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$shfxrowdata,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Token f44802ba6296dacd9c548887f621debd7d5091cd'
  ),
));

$response = curl_exec($curl);
$responsesfax = json_decode($response, true);
curl_close($curl);
// echo $responsesfax;



echo "<br>* -   *   -  Start *   -   *   -   <br>";
echo "<pre>";
print_r($responsesfax);
echo "<br>* -   *   -   End *   -   *   -   <br>";
// exit();



    if($responsesfax['message']=="Success"){
        echo "<br>if section <br> : ";
        echo $sfxawbnois = $responsesfax['data']['awb_number'];
        echo "<br> : ";
        echo $carrierby = "Shadowfax";
        echo "<br> : ";
        echo $sfxorderid = $responsesfax['data']['id'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$sfxorderid,'Awb_Number'=>$sfxawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Shadowfax']);
    }else{
        echo "<br>else section <br> : ";
        // $errormsg = $responseio['response'];
        // $errormsg = "Ecom internal   error 500";
        if(!empty($responsesfax['errors'])){
            echo $errormsg = $responsesfax['errors'][0]['product_details'][0];
            $errormsg = $responsesfax['errors'][0]['product_details'][0];
        }else{
            $errormsg = "Ecom internal error 500";
        }
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // Shadowfax Order Place End //

// Shadowfax Section End
// echo "<br>Shadowfax End<br>";
*/
if($thisgenerateawbno){
break;
}



    }else{

// $courierapicodeno;
echo "<br>Nimbus Start<br>";
// Nimbus Section Start
$thisgenerateawbno = "";
$thisgenerateawbno = "Nimbus-010-".$crtidis;
/*
if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";

    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "email" : "shipdart27@gmail.com",
            "password" : "Shipd@rt123"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
            echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

        
    if($nimbustoken){

$newiacwt = 0;
$newiacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$newiacwt = ceil($newiacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$newiacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
        print_r($nimbusdata);
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$newiacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
    // Courier Exists Or Not
            if(in_array($courierapicodeno, $avaliablelistare)){
    // Courier Exists Or Not
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Order found $orderno- - <br>";
                
                // if($loopnocheck==1){
                   //  echo "<br> $loopnocheck Loop Continue <br>";
                    bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>""]);     
                    // continue;
                    // break;
                // }
                
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
        // Courier Exists Or Not
            }else{
        // Courier Exists Or Not
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
        // Courier Exists Or Not
            }
        // Courier Exists Or Not

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //
*/

// Nimbus Section End
// echo "<br>Nimbus End<br>";


if($thisgenerateawbno){
break;
}




    }


    // echo "<br> API 2nd Last Section End Return Value : ";
    // echo $thisgenerateawbno;
}


echo "<br> API Section End Return Value : ";
echo $thisgenerateawbno;

/*
// Intargos API Section
if($couriernamecode=='IN'){
// Intargos API Section

// Intargos API Section End //
// Nimbus API Section
}elseif($couriernamecode=='NI'){
// Nimbus API Section


// Nimbus API Section End //
}
// Nimbus API Section End //
*/





}

// echo "<br> Last Return Value : ";
// echo $thisgenerateawbno;


  }
// API first Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Second Flow Start
public function OrderPlaceToCouriersecond(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(10)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    echo "<br>";
        print_r($responseio);
    echo "<br>";
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        echo "<br>";
            echo $nimbustoken = trim($nimbustoken);
        echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        

        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Order Match Found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    
                    echo "<br>";
                        echo "<br>";
                            print_r($nimbusdata);
                        echo "<br>";
                        echo "<br>Match Found Result : ";
                        print_r($responseic);
                    echo "<br>";
                    
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}


/*
// Intargos API Section
if($couriernamecode=='IN'){
// Intargos API Section

// Intargos API Section End //
// Nimbus API Section
}elseif($couriernamecode=='NI'){
// Nimbus API Section


// Nimbus API Section End //
}
// Nimbus API Section End //
*/





}


  }
// API Second Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Third Flow Start
public function OrderPlaceToCourierthird(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}


/*
// Intargos API Section
if($couriernamecode=='IN'){
// Intargos API Section

// Intargos API Section End //
// Nimbus API Section
}elseif($couriernamecode=='NI'){
// Nimbus API Section


// Nimbus API Section End //
}
// Nimbus API Section End //
*/





}


  }
// API Third Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Fourth Flow Start
public function OrderPlaceToCourierfourth(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}


/*
// Intargos API Section
if($couriernamecode=='IN'){
// Intargos API Section

// Intargos API Section End //
// Nimbus API Section
}elseif($couriernamecode=='NI'){
// Nimbus API Section


// Nimbus API Section End //
}
// Nimbus API Section End //
*/





}


  }
// API Fourth Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Fifth Flow Start
public function OrderPlaceToCourierfifth(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}


/*
// Intargos API Section
if($couriernamecode=='IN'){
// Intargos API Section

// Intargos API Section End //
// Nimbus API Section
}elseif($couriernamecode=='NI'){
// Nimbus API Section


// Nimbus API Section End //
}
// Nimbus API Section End //
*/





}


  }
// API Fifth Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Sixth Flow Start
public function OrderPlaceToCouriersixth(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}




}


  }
// API Sixth Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Seventh Flow Start
public function OrderPlaceToCourierseventh(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}




}


  }
// API Seventh Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Eighth Flow Start
public function OrderPlaceToCouriereight(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == 0){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}




}


  }
// API Eighth Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Ninth Flow Start
public function OrderPlaceToCourierninth(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}




}


  }
// API Ninth Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
// API Tenth Flow Start
public function OrderPlaceToCouriertenth(){
      echo "Working";
        $params = bulkorders::where('apihitornot','0')
                    ->orderby('Single_Order_Id','ASC')
                    ->limit(1)
                    ->get();

// Update Selected Orders To Generate A AWB Number
foreach($params as $param){
  $crtidis = $param->Single_Order_Id ;
  bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1]);
}
// Update Selected Orders To Generate A AWB Number


// echo "<br>";
// echo count($params);
$loopno = 0;
$loopnocheck = 0;
$warehouseresponse = "";



foreach($params as $param){
  // echo "<br>".$param->orderno;
$loopno++;
// echo "<br><br><br>Current Loop NO is $loopno <br><br>";

$crtidis = $param->Single_Order_Id;
$paymentmode = $param->Order_Type;
$userid = $param->User_Id;


if(empty($paymentmode)){  $paymentmode = "COD"; }
if($paymentmode == "Prepaid"){  $paymentmode = "PPD"; }
 $orderno = $param->orderno;

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
 $itamt = $param->Total_Amount;
 $iival = $param->Invoice_Value;
 $icoda = $param->Cod_Amount;
 $iadin = $param->additionaltype;
// Product Details
 $param->Rec_Time_Stamp;
 $param->Rec_Time_Date;
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
    $daname = trim(preg_replace("/\s+/"," ",$daname));
    $daadrs = trim(preg_replace("/\s+/"," ",$daadrs));
    $iname = trim(preg_replace("/\s+/"," ",$iname));
    $pkpkname = trim(preg_replace("/\s+/"," ",$pkpkname));
    $pkpkaddr = trim(preg_replace("/\s+/"," ",$pkpkaddr));
// Next Line Data Convert in One Line


// Order Place Courier Checking
$courierassigns = courierpermission::where('user_id',$userid)
                                    ->where('courier_priority','!=','0')
                                    ->where('admin_flg','1')
                                    ->where('user_flg','1')
                                    ->orderby('courier_priority','asc')
                                    ->get();
$abc = 0;
$finalcouriers = array();
$finalcourierlists = array();
foreach($courierassigns as $courierassign){
    // $couriername = $courierassign['courier_code'];
    $courieridno = $courierassign['courier_idno'];
    // $finalcouriers[] = array("cname"=>"$couriername","cidno"=>"$courieridno");
    array_push($finalcourierlists,"$courieridno");
}

// $arrayidno = array_rand($finalcouriers);
// $couriernamecode = $finalcouriers[$arrayidno]['cname'];
// echo "<br> Courier idno : ";
// echo $courierapicodeno = $finalcouriers[$arrayidno]['cidno'];
// echo "<br>";


foreach($finalcourierlists as $courierapicodeno){
// echo $courierapicodeno;
    if($courierapicodeno == "in01"){
// echo "<br>Intargos Start<br>";
// Intargos Section Start

// Warehouse Pickup ID
    $hubintartosid = Hubs::where('hub_id',$pkpkid)->first('intargos_hubid');
    $warehouseid = $hubintartosid['intargos_hubid'];
    if($warehouseid==""){
        bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
        continue;
    }
// Warehouse Pickup ID
    // InTargos Order Place
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://app.intargos.com/api/CreateOrder',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "consignee_name": "'.$daname.'",
        "consignee_mobile": "'.$damob.'",
        "consignee_phone": "",
        "consignee_emailid": "",
        "consignee_address1": "'.$daadrs.'",
        "consignee_address2": "",
        "address_type": "Home",
        "consignee_pincode": "'.$dapin.'",
        "consignee_city": "'.$dacity.'",
        "consignee_state": "'.$dastate.'",
        "consignee_country": "India",
    
        "invoice_number": "'.$orderno.'",
        "payment_mode": "'.$paymentmode.'",
        "express_type": "surface",
        "is_ndd": "0",
        "order_amount": "'.$icoda.'",
        "tax_amount": "0",
        "extra_charges": "0",
        "total_amount": "'.$itamt.'",
        "cod_amount": "'.$icoda.'",
        "shipment_weight": "'.$iacwt.'",
        "shipment_length": "'.$ilgth.'",
        "shipment_width": "'.$iwith.'",
        "shipment_height": "'.$ihght.'",
        "volumetric_weight": "",
    
        "pick_address_id": "'.$warehouseid.'",
        "return_address_id": "'.$warehouseid.'",
        "latitude": "",
        "longitude": "",
        "products": [
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            },
            {
                "product_name": "'.$iname.'",
                "product_category": "",
                "product_description": "",
                "product_sku": "NA",
                "product_hsnsac": "",
                "product_quantity": "'.$iqlty.'",
                "product_value": "'.$iival.'",
                "product_taxper": 0
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=e992a179dda6510c4de034baa4173306dc602346'
      ),
    ));
    
    $responseio = curl_exec($curl);
    $responseio = json_decode($responseio, true);
    curl_close($curl);
    
    // echo "<pre>";
    // print_r($responseio);
    // echo "</pre>";
    
    if($responseio['status'] == "true"){
      $intargosawbnois = $responseio['waybill'];
      $carrierby = $responseio['carrier'];
      $intarorderid = $responseio['intargos_orderid'];
      bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$intarorderid,'Awb_Number'=>$intargosawbnois,'awb_gen_by'=>$carrierby,'awb_gen_courier'=>'Intargos']);
    }else{
        $errormsg = $responseio['response'];
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errormsg]);
    }
    // InTargos Order Place End //

// Intargos Section End
// echo "<br>Intargos End<br>";
    }else{
// $courierapicodeno;
// echo "<br>Nimbus Start<br>";
// Nimbus Section Start

if($paymentmode == "COD"){  $paymentmode = "cod"; }
if($paymentmode == "PPD"){  $paymentmode = "prepaid"; }
if($paymentmode == "Prepaid"){  $paymentmode = "prepaid"; }

    echo "Nimbus";
    // Nimbus Order Plade Code
        // Token Generate
        $nimbustoken = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
          CURLOPT_HTTPHEADER => array(
            'content-type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);
        // print_r($responseic);
        $statuscheck = $responseic['status'];
        if($statuscheck == true){   
            $nimbustoken = $responseic['data'];
            $nimbustoken = trim($nimbustoken);
        }elseif($statuscheck == false){    
            bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0]);
            continue;
        }
        // echo "<br>";
        //     echo $nimbustoken = trim($nimbustoken);
        // echo "<br>";
        // Token Generate End

$iacwt = $iacwt*1000;
// $iacwt = 400;

$iqlty = ceil($iqlty);
$iwith = ceil($iwith);
$ihght = ceil($ihght);
$ilgth = ceil($ilgth);
$iacwt = ceil($iacwt);

        $nimbusdata = '{
            "order_number": "'.$orderno.'",
            "shipping_charges": 0,
            "discount": 0,
            "cod_charges": 0,
            "payment_type": "'.$paymentmode.'",
            "order_amount": '.$icoda.',
            "package_weight": '.$iacwt.',
            "package_length": '.$ilgth.',
            "package_breadth": '.$iwith.',
            "package_height": '.$ihght.',
            "request_auto_pickup" : "yes",
            "consignee": {
                "name": "'.$daname.'",
                "address": "'.$daadrs.'",
                "address_2": "",
                "city": "'.$dacity.'",
                "state": "'.$dastate.'",
                "pincode": "'.$dapin.'",
                "phone": "'.$damob.'"
            },
            "pickup": {
                "warehouse_name": "'.$pkpkname.'",
                "name" : "'.$pkpkname.'",
                "address": "'.$pkpkaddr.'",
                "address_2": "",
                "city": "'.$pkpkcity.'",
                "state": "'.$pkpkstte.'",
                "pincode": "'.$pkpkpinc.'",
                "phone": "'.$pkpkmble.'"
            },
            "order_items": [
                {
                    "name": "'.$iname.'",
                    "qty": "'.$iqlty.'",
                    "price": "'.$itamt.'",
                    "sku": ""
                }
            ],
            "courier_id" : "'.$courierapicodeno.'"
        }';
        
    if($nimbustoken){
    
        // Courier List Checking
            $courierlistchecking = '{
                "origin": "'.$pkpkpinc.'",
                "destination": "'.$dapin.'",
                "payment_type": "'.$paymentmode.'",
                "order_amount": "'.$icoda.'",
                "weight": "'.$iacwt.'",
                "length": "'.$ilgth.'",
                "breadth": "'.$iwith.'",
                "height": "'.$ihght.'"
            }';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nimbuspost.com/v1/courier/serviceability',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$courierlistchecking,
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $nimbustoken",
        "Content-Type: application/json"
        ),
        ));
        
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);
        $responselistsar = $responselists['data'];
        
        $avaliablelistare = array();
        foreach($responselistsar as $responselistsa){
            $listid = $responselistsa['id'];
            // $listname = $responselistsa['name'];
            array_push($avaliablelistare,"$listid");
        }
        // Courier List Checking
            echo "<br><br>";
            print_r($avaliablelistare);
            echo "<br>";
            print_r($courierapicodeno);
            if(in_array($courierapicodeno, $avaliablelistare)){
                echo "<br>";
                    $loopnocheck++;
                    echo "Loop No : $loopnocheck";
                echo "<br>";
                echo "<br>- - - Match found $orderno- - <br>";
                /*
                if($loopnocheck==1){
                    echo "<br> $loopnocheck Loop Continue <br>";
                    // continue;
                    break;
                }
                */
                //   break;
                  
                
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$nimbusdata,
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer $nimbustoken"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    echo "<br>Match Found : ";
                    print_r($responseic);
                    $statuscheck = $responseic['status'];
                    if($statuscheck == true){
                         $orderid = $responseic['data']['order_id'];
                         $shipmentid = $responseic['data']['shipment_id'];
                         $awbno = $responseic['data']['awb_number'];
                         $courierid = $responseic['data']['courier_id'];
                         $couriername = ucwords($responseic['data']['courier_name']);
                         $crtstatus = $responseic['data']['status'];
                        $paymentmode = $responseic['data']['payment_type'];
                        bulkorders::where('Single_Order_Id',$crtidis)->update(['courier_ship_no'=>$shipmentid,'Awb_Number'=>$awbno,'awb_gen_by'=>$couriername,'awb_gen_courier'=>'Nimbus','showerrors'=>"Upload"]);
                    }elseif($statuscheck == false){
                         $errmessage = $responseic['message'];
                        //  if($errmessage == "Wallet balance is low."){
                        //      bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>0,'showerrors'=>"Please contact shipdart admin"]);     
                        //  }else{
                                bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>$errmessage]);     
                        //  }
                    }
                
                    echo "<br>";
                    break;
            }else{
                  echo "<br>- - - Match not found $orderno- - <br>";
                //   bulkorders::where('Single_Order_Id',$crtidis)->update(['apihitornot'=>1,'showerrors'=>"Courier not in service"]);     
                  bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Courier not in service"]);
            }

    }else{
        bulkorders::where('Single_Order_Id',$crtidis)->update(['showerrors'=>"Invalid Details"]);
    }
    // Nimbus Order Plade Code End //


// Nimbus Section End
// echo "<br>Nimbus End<br>";
    }
}




}


  }
// API Tenth Flow End * -   *   -   *   -   *   -   *   -   *   -   *   -
  
  

}

