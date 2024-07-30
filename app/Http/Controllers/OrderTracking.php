<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;
use App\Models\bulkorders;
use App\Models\orderautoupdate;
use App\Models\smartship;

class OrderTracking extends Controller
{



// User Online Tracking Orders
public function TrackPage(){
    return view('UserPanel.Tracking.Tracking');
}
    
public function TrackOrder(Request $req){
    error_reporting(1);
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
        $responsetkn = curl_exec($curl);
        $responseictkn = json_decode($responsetkn, true);
        curl_close($curl);
        $nimbustokentkn = $responseictkn['data'];
        $nimbustoken = trim($nimbustokentkn);
    // Token Generate

    $userid = session()->get('UserLogin2id');
    $tracking_number = $req->orderno;
    
    $totaltrack = 1;
    $localstatus = 1;
    $allawbno = explode(",",$tracking_number);
    // $aidno = 1;
    $params = array();

    foreach($allawbno as $airwaybillnumber){
        $statuscode = "";
        $location = "";
        $statusdate = "";
        $msg = "";
    
        $airwaybillnumber = trim($airwaybillnumber);
        $checking = bulkorders::where('Awb_Number',$airwaybillnumber)->where('User_Id',$userid)->first();
        $tracking_numberchecked = $checking['Awb_Number'];
        $tracking_courier = $checking['awb_gen_courier'];
        $courier_ship_no = $checking['courier_ship_no'];







        if($tracking_courier=="Smartship"){
// Smartship Start

$smartshiptoken1 = smartship::where('id', 1)->first('token');
$smartshiptoken = $smartshiptoken1['token'];

            $localstatus = 0;
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.smartship.in/v1/Trackorder?tracking_numbers=$airwaybillnumber",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $smartshiptoken"
              ),
            ));
            
            $responselist = curl_exec($curl);
            $responselists = json_decode($responselist, true);
            curl_close($curl);


        $statuscode = $responselists['data']['scans'][$courier_ship_no][0]['action'];
        $location = $responselists['data']['scans'][$courier_ship_no][0]['location'];
        $statusdate = $responselists['data']['scans'][$courier_ship_no][0]['date_time'];
        $msg = $responselists['data']['scans'][$courier_ship_no][0]['status_description'];
            

            
// Smartship End
        }elseif($tracking_courier=="Nimbus"){
// Nimbus Start
            $localstatus = 0;
             $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.nimbuspost.com/v1/shipments/track/$airwaybillnumber",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $nimbustoken",
                "Content-Type: application/json"
            ),
            ));
            $responselist = curl_exec($curl);
            $responselists = json_decode($responselist, true);
            curl_close($curl);
            $statuscode = $responselists['data']['history'][0]['status_code'];
            $location = $responselists['data']['history'][0]['location'];
            $statusdate = $responselists['data']['history'][0]['event_time'];
            $msg = $responselists['data']['history'][0]['message'];
// Nimbus End
        }elseif($tracking_courier=="Intargos1"){
// Intargos Start
            $localstatus = 0;

        echo "<br>Intargos1 - <br>";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.intargos.com/api/ShipmentSummary',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "waybill": "'.$airwaybillnumber.'"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: SW8EBDO64AZYQKPTU15FZRGV0IWVH7'
        ),
        ));

        $response = curl_exec($curl);
        $responsestatus = json_decode($response, true);
        curl_close($curl);

        $laststatusdateare = $responsestatus['summary']['lastscanned'];
            $dateisa = date_create($laststatusdateare);
            $statusdate = date_format($dateisa,"Y-m-d");
        $statuscode = $responsestatus['summary']['status'];
        $location = $responsestatus['summary']['location'];
        $msg = $responsestatus['summary']['remark'];
// Intargos End
        }elseif($tracking_courier=="Ecom"){
// Ecom Start
            $localstatus = 0;

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://plapi.ecomexpress.in/track_me/api/mawbd/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('username' => 'ARTUINFOTECH898811','password' => '8y1LK5ileM','awb' => $airwaybillnumber)
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);

            $statuscode = $array['object']['field'][10];
            $location = $array['object']['field'][5];
            $statusdate = $array['object']['field'][20];
            $msg = $array['object']['field'][11];
// Ecom End
        }elseif($tracking_courier=="Shadowfax"){
// Shadowfax Start
            $localstatus = 0;

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dale.shadowfax.in/api/v3/clients/bulk_track/?format=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "awb_numbers": [
                    "'.$airwaybillnumber.'"
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token f44802ba6296dacd9c548887f621debd7d5091cd'
            ),
            ));
            $response = curl_exec($curl);
            $responsesfx = json_decode($response, true);
            curl_close($curl);
            $statuscode = $responsesfx['data'][0]['tracking_details']['status_id'];
            $location = $responsesfx['data'][0]['tracking_details']['location'];
            $statusdate = $responsesfx['data'][0]['tracking_details']['created'];
            $msg = $responsesfx['data'][0]['tracking_details']['remarks'];

// Shadowfax End
        }else{
            $localstatus = 1;
        }
        $params[] = array('localstatus'=>$localstatus,'tracking_number'=>$airwaybillnumber,'statuscode'=>$statuscode,'location'=>$location,'statusdate'=>$statusdate,'msg'=>$msg);
    }
            $totaltrack = count($params);
            // print_r($params);
    	    return view('UserPanel.Tracking.Tracking',['totaltrack'=>$totaltrack,'params'=>$params]);
}
// User Online Tracking Orders


// Admin Online Tracking Orders
public function TrackPageAdmin(){
    return view('Admin.Tracking.Tracking');
}

public function TrackOrderAdmin(Request $req){
    error_reporting(1);
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
        $responsetkn = curl_exec($curl);
        $responseictkn = json_decode($responsetkn, true);
        curl_close($curl);
        $nimbustokentkn = $responseictkn['data'];
        $nimbustoken = trim($nimbustokentkn);
    // Token Generate


    $tracking_number = $req->orderno;
    $totaltrack = 1;
    $localstatus = 1;
    $allawbno = explode(",",$tracking_number);
    // $aidno = 1;
    $params = array();

    foreach($allawbno as $airwaybillnumber){
        $statuscode = "";
        $location = "";
        $statusdate = "";
        $msg = "";
        
        $airwaybillnumber = trim($airwaybillnumber);
        // $checking = bulkorders::where('Awb_Number',$airwaybillnumber)->where('User_Id',$userid)->first();
        $checking = bulkorders::where('Awb_Number',$airwaybillnumber)->first();
        $tracking_numberchecked = $checking['Awb_Number'];
        $tracking_courier = $checking['awb_gen_courier'];
        $courier_ship_no = $checking['courier_ship_no'];
    
            if($tracking_courier=="Smartship"){
// Smartship Start

$smartshiptoken1 = smartship::where('id', 1)->first('token');
$smartshiptoken = $smartshiptoken1['token'];

            $localstatus = 0;
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.smartship.in/v1/Trackorder?tracking_numbers=$airwaybillnumber",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $smartshiptoken"
              ),
            ));
            
            $responselist = curl_exec($curl);
            $responselists = json_decode($responselist, true);
            curl_close($curl);


        $statuscode = $responselists['data']['scans'][$courier_ship_no][0]['action'];
        $location = $responselists['data']['scans'][$courier_ship_no][0]['location'];
        $statusdate = $responselists['data']['scans'][$courier_ship_no][0]['date_time'];
        $msg = $responselists['data']['scans'][$courier_ship_no][0]['status_description'];
// Smartship End
        }elseif($tracking_courier=="Nimbus"){
// Nimbus Start
        $airwaybillnumber = trim($airwaybillnumber);
        $checking = bulkorders::where('Awb_Number',$airwaybillnumber)->first();
        $tracking_numberchecked = $checking['Awb_Number'];
        if($tracking_numberchecked){
            $localstatus = 0;
             $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.nimbuspost.com/v1/shipments/track/$airwaybillnumber",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $nimbustoken",
                "Content-Type: application/json"
            ),
            ));
            $responselist = curl_exec($curl);
            $responselists = json_decode($responselist, true);
            curl_close($curl);
            $statuscode = $responselists['data']['history'][0]['status_code'];
            $location = $responselists['data']['history'][0]['location'];
            $statusdate = $responselists['data']['history'][0]['event_time'];
            $msg = $responselists['data']['history'][0]['message'];
        }else{
            $localstatus = 1;
        }
}
// Nimbus End

        $params[] = array('localstatus'=>$localstatus,'tracking_number'=>$airwaybillnumber,'statuscode'=>$statuscode,'location'=>$location,'statusdate'=>$statusdate,'msg'=>$msg);
    }
            $totaltrack = count($params);
    	    return view('Admin.Tracking.Tracking',['totaltrack'=>$totaltrack,'params'=>$params]);
    }
// Admin Online Tracking Orders













// Super  Admin Online Tracking Orders
public function TrackPageSuperAdmin(){
    return view('super-admin.Tracking.Tracking');
}

public function TrackOrderSuperAdmin(Request $req){
    error_reporting(1);
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
        $responsetkn = curl_exec($curl);
        $responseictkn = json_decode($responsetkn, true);
        curl_close($curl);
        $nimbustokentkn = $responseictkn['data'];
        $nimbustoken = trim($nimbustokentkn);
    // Token Generate


    $tracking_number = $req->orderno;
    $totaltrack = 1;
    $localstatus = 1;
    $allawbno = explode(",",$tracking_number);
    // $aidno = 1;
    $params = array();

    foreach($allawbno as $airwaybillnumber){
        $statuscode = "";
        $location = "";
        $statusdate = "";
        $msg = "";
    
        $airwaybillnumber = trim($airwaybillnumber);
        $checking = bulkorders::where('Awb_Number',$airwaybillnumber)->first();
        $tracking_numberchecked = $checking['Awb_Number'];
        if($tracking_numberchecked){
            $localstatus = 0;
             $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.nimbuspost.com/v1/shipments/track/$airwaybillnumber",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $nimbustoken",
                "Content-Type: application/json"
            ),
            ));
            $responselist = curl_exec($curl);
            $responselists = json_decode($responselist, true);
            curl_close($curl);
            $statuscode = $responselists['data']['history'][0]['status_code'];
            $location = $responselists['data']['history'][0]['location'];
            $statusdate = $responselists['data']['history'][0]['event_time'];
            $msg = $responselists['data']['history'][0]['message'];
        }else{
            $localstatus = 1;
        }
        $params[] = array('localstatus'=>$localstatus,'tracking_number'=>$airwaybillnumber,'statuscode'=>$statuscode,'location'=>$location,'statusdate'=>$statusdate,'msg'=>$msg);
    }
            $totaltrack = count($params);
            return view('super-admin.Tracking.Tracking',['totaltrack'=>$totaltrack,'params'=>$params]);
    }
// Super Admin Online Tracking Orders








// Order Tracking Auto Update
public function OrderAutoUpdateawbs(){
    // error_reporting(1);
    echo "working<br>";
$tdateis = date('Y-m-d');
$date=date_create($tdateis);
date_sub($date,date_interval_create_from_date_string("7 days"));
$last4thdate = date_format($date,"Y-m-d");



    // bulkorders::where('Last_Stamp_Date','1970-01-01')->update(['Last_Stamp_Date'=>null]);
    // Last_Time_Stamp
    // bulkorders::where('Last_Stamp_Date','')->update(['Last_Stamp_Date'=>$tdateis]);
    // bulkorders::where('Last_Stamp_Date',null)->update(['Last_Stamp_Date'=>$tdateis]);



// Check Process Orders
    $allawbno = bulkorders::where('Awb_Number','!=','')
                            ->where('order_cancel','!=','1')
                            ->where('order_status_show','!=','Delivered')
                            ->where('order_status_show','!=','RTO Delivered')
                            ->get();
    foreach($allawbno as $allawbnoare){
        $airwaybillnumber = $allawbnoare['Awb_Number'];
        $airwaybillnumbergenby = $allawbnoare['awb_gen_courier'];
        $courier_ship_no = $allawbnoare['courier_ship_no'];
        $airwaybillnumber = trim($airwaybillnumber);
        $query = new orderautoupdate;
        $query->awbno = $airwaybillnumber;
        $query->courier_ship_no = $courier_ship_no;
        $query->courier_company = $airwaybillnumbergenby;
        $query->save();
    }
// Check Process Orders



// Check If RTD Case
    $allawbno1 = bulkorders::where('order_cancel','!=','1')
                            ->where('order_status_show','RTO Delivered')
                            ->whereBetween('Last_Stamp_Date', [$last4thdate, $tdateis])
                            ->get();
    foreach($allawbno1 as $allawbnoare1){
        $airwaybillnumber1 = $allawbnoare1['Awb_Number'];
        $airwaybillnumbergenby1 = $allawbnoare1['awb_gen_courier'];
        $airwaybillnumber1 = trim($airwaybillnumber1);
        $query1 = new orderautoupdate;
        $query1->awbno = $airwaybillnumber1;
        $query1->courier_company = $airwaybillnumbergenby1;
        $query1->save();
    }
// Check If RTD Case
// Check If Delivered Case
    $allawbno2 = bulkorders::where('order_cancel','!=','1')
                            ->where('order_status_show','Delivered')
                            ->whereBetween('Last_Stamp_Date', [$last4thdate, $tdateis])
                            ->get();
    // print_r($allawbno2);
    // exit();
    foreach($allawbno2 as $allawbnoare2){
        $airwaybillnumber2 = $allawbnoare2['Awb_Number'];
        $airwaybillnumbergenby2 = $allawbnoare2['awb_gen_courier'];
        $airwaybillnumber2 = trim($airwaybillnumber2);
        $query2 = new orderautoupdate;
        $query2->awbno = $airwaybillnumber2;
        $query2->courier_company = $airwaybillnumbergenby2;
        $query2->save();
    }
// Check If Delivered Case

}




public function OrderAutoUpdateStatus(){
error_reporting(1);
    echo "Woking<br>";
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
    $responsetkn = curl_exec($curl);
    $responseictkn = json_decode($responsetkn, true);
    curl_close($curl);
    $nimbustokentkn = $responseictkn['data'];
    $nimbustoken = trim($nimbustokentkn);
// Token Generate

// echo "Woking";
$allawbno = orderautoupdate::where('awbno','!=','')
                        ->where('hitornot','0')
                        ->limit(50)
                        ->get();



foreach($allawbno as $allawbnoare){
    $statuscode = "";
    $msg = "";
    $airwaybillnumber = $allawbnoare['awbno'];
    $airwaybillnumbercompany = $allawbnoare['courier_company'];
    $airwaybillnumber = trim($airwaybillnumber);
    $courier_ship_no = trim($courier_ship_no);
    
    
    
    
    
    
    
        if($tracking_courier=="Smartship"){
// Smartship Start

$smartshiptoken1 = smartship::where('id', 1)->first('token');
$smartshiptoken = $smartshiptoken1['token'];

            $localstatus = 0;
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.smartship.in/v1/Trackorder?tracking_numbers=$airwaybillnumber",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $smartshiptoken"
              ),
            ));
            
            $responselist = curl_exec($curl);
            $responselists = json_decode($responselist, true);
            curl_close($curl);



        $status = $responselists['status'];
        $statuscode = $responselists['data']['scans'][$courier_ship_no][0]['action'];
        $location = $responselists['data']['scans'][$courier_ship_no][0]['location'];
        $statusdate = $responselists['data']['scans'][$courier_ship_no][0]['date_time'];
        $dateisa = date_create($statusdate);
        $laststatusdate = date_format($dateisa,"Y-m-d");
        $msg = $responselists['data']['scans'][$courier_ship_no][0]['status_description'];

        orderautoupdate::where('awbno',$airwaybillnumber)->update(['hitornot'=>'1']);
        if($status==1){
            bulkorders::where('Awb_Number',$airwaybillnumber)
                ->update([
                    'Last_Stamp_Date'=>$laststatusdate,
                    'order_status'=>$statuscode,
                    'order_status1'=>$msg,
                    'order_status_show'=>$statuscode
                    ]);
        }
// Smartship End
}

exit();
    
    
    if($airwaybillnumbercompany=="Nimbus"){
        echo "<br>Nimbus - <br>";

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nimbuspost.com/v1/shipments/track/$airwaybillnumber",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $nimbustoken",
            "Content-Type: application/json"
        ),
        ));
        $responselist = curl_exec($curl);
        $responselists = json_decode($responselist, true);
        curl_close($curl);

        echo $statuscode = $responselists['data']['history'][0]['status_code'];
        $location = $responselists['data']['history'][0]['location'];
        $statusdate = $responselists['data']['history'][0]['event_time'];
            $dateisa = date_create($statusdate);
            $laststatusdate = date_format($dateisa,"Y-m-d");
        $msg = $responselists['data']['history'][0]['message'];

        $statusdetails = array('PP'=>'Pending Pickup','IT'=>'In Transit','EX'=>'Exception','OFD'=>'Out For Delivery','DL'=>'Delivered','RT'=>'RTO','RT-IT'=>'RTO In Transit','RT-DL'=>'RTO Delivered');
        
        // echo "<br><br> * - * - ";
        // echo "<br> 1. ";
        $statuscodeare = $statusdetails["$statuscode"];
        // echo "<br> 2. ";
        // echo $statuscode;
        // echo "<br> 3. ";
        // echo $location;
        // echo "<br> 4. ";
        // echo $statusdate;
        // echo "<br> 5. ";
        // echo $msg;
        orderautoupdate::where('awbno',$airwaybillnumber)->update(['hitornot'=>'1']);
        if($statuscodeare){
            bulkorders::where('Awb_Number',$airwaybillnumber)
                ->update([
                    'Last_Stamp_Date'=>$laststatusdate,
                    'order_status'=>$statuscode,
                    'order_status1'=>$msg,
                    'order_status_show'=>$statuscodeare
                    ]);
        }
    }
    if($airwaybillnumbercompany=="Intargos"){
        echo "<br>Intargos - <br>";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.intargos.com/api/ShipmentSummary',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "waybill": "'.$airwaybillnumber.'"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
        'Cookie: ci_session=a498ba5187dda947724c87e5497b4ad4f80b11d3'
        ),
        ));

        $response = curl_exec($curl);
        $responsestatus = json_decode($response, true);
        curl_close($curl);

        $laststatusdateare = $responsestatus['summary']['lastscanned'];
            $dateisa = date_create($laststatusdateare);
            $laststatusdate = date_format($dateisa,"Y-m-d");
        $statuscode = $responsestatus['summary']['status'];
        $responsestatus['summary']['location'];
        $msg = $responsestatus['summary']['remark'];
                
        echo $statuscodeare = $statuscode;
        orderautoupdate::where('awbno',$airwaybillnumber)->update(['hitornot'=>'1']);
        if($statuscodeare){
            bulkorders::where('Awb_Number',$airwaybillnumber)
                ->update([
                    'Last_Stamp_Date'=>$laststatusdate,
                    'order_status'=>$statuscode,
                    'order_status1'=>$msg,
                    'order_status_show'=>$statuscodeare
                    ]);
        }
    }

    if($airwaybillnumbercompany=="Intargos1"){
        echo "<br>Intargos - <br>";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.intargos.com/api/ShipmentSummary',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "waybill": "'.$airwaybillnumber.'"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'signature: SW8EBDO64AZYQKPTU15FZRGV0IWVH7'
        ),
        ));

        $response = curl_exec($curl);
        $responsestatus = json_decode($response, true);
        curl_close($curl);

        $laststatusdateare = $responsestatus['summary']['lastscanned'];
            $dateisa = date_create($laststatusdateare);
            $laststatusdate = date_format($dateisa,"Y-m-d");
        $statuscode = $responsestatus['summary']['status'];
        $responsestatus['summary']['location'];
        $msg = $responsestatus['summary']['remark'];
                
        echo $statuscodeare = $statuscode;
        orderautoupdate::where('awbno',$airwaybillnumber)->update(['hitornot'=>'1']);
        if($statuscodeare){
            bulkorders::where('Awb_Number',$airwaybillnumber)
                ->update([
                    'Last_Stamp_Date'=>$laststatusdate,
                    'order_status'=>$statuscode,
                    'order_status1'=>$msg,
                    'order_status_show'=>$statuscodeare
                    ]);
        }
    }

    if($airwaybillnumbercompany=="Ecom"){
        echo "<br>Ecom - <br>";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://plapi.ecomexpress.in/track_me/api/mawbd/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('username' => 'ARTUINFOTECH898811','password' => '8y1LK5ileM','awb' => $airwaybillnumber)
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);


        echo $array['object']['field'][5];
        echo "<br>";
        echo $statuscode = $array['object']['field'][10];
        echo "<br>";
        echo $msg = $array['object']['field'][11];
        echo "<br>";
        echo $laststatusdateare = $array['object']['field'][20];
            $dateise = substr($laststatusdateare,0,2);
            $monthise = date('m');
            $yearise = substr($laststatusdateare,7,4);
        echo $laststatusdate =  $yearise."-".$monthise."-".$dateise;





        // $laststatusdateare = $responsestatus['summary']['lastscanned'];
            // $dateisa = date_create($laststatusdateare);
            // $laststatusdate = date_format($dateisa,"Y-m-d");
        // $statuscode = $responsestatus['summary']['status'];
        // $responsestatus['summary']['location'];
        // $msg = $responsestatus['summary']['remark'];
                
        echo $statuscodeare = $statuscode;
        orderautoupdate::where('awbno',$airwaybillnumber)->update(['hitornot'=>'1']);
        if($statuscodeare){
            bulkorders::where('Awb_Number',$airwaybillnumber)
                ->update([
                    'Last_Stamp_Date'=>$laststatusdate,
                    'order_status'=>$statuscode,
                    'order_status1'=>$msg,
                    'order_status_show'=>$statuscodeare
                    ]);
        }
    }







}

}
// Order Tracking Auto Update




    public function TrackOrder1($id)
    {
        $tracking_number = $id;
        // $tracking_number = 1605123816250;
        
        $params = orderdetail::where('awb_no',$tracking_number)->first();


    $url = "http://www.pickrr.com/api/tracking-json/?auth_token=42e094b5daec3b715ab96cbb248839dd141263&tracking_id=$tracking_number";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); //Url together with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($result, true);

    return view('UserPanel.Tracking.Tracking',['tracking_number'=>$tracking_number,'json'=>$json,'result'=>$result,'params'=>$params]);

//     print_r($result);
//     print_r($json);
// echo $json['status']['received_by'];
//     echo "<br>";
// echo $json['status']['current_status_type'];
//     echo "<br>";
// echo $json['status']['current_status_body'];
//     echo "<br>";
// echo $json['status']['current_status_location'];
//     echo "<br>";
// echo $json['status']['current_status_time'];

    }


}
