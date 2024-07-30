<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Allusers;
use App\Models\Hubs;
use App\Models\CourierApiDetail;
use DB;
use Excel;

class UserOrderManage extends Controller
{
// All Orders
public function AllOrders(){
    /*
    $userid = session()->get('UserLogin2id');
    $params = bulkorders::where('User_Id',$userid)
                            ->where('Awb_Number','!=','')
                            ->where('order_cancel','!=','1')
                            ->where('order_status_show','!=','Upload')
                            ->orderby('Single_Order_Id','desc')
                            ->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderAll',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
    */
    $userid = session()->get('UserLogin2id');
    $params = bulkorders::where('User_Id',$userid)
                            ->where('order_status_show','Delivered')
                            ->where('Awb_Number','!=','')
                            ->where('order_cancel','!=','1')
                            ->orderby('Single_Order_Id','desc')
                            ->get();
    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderAll',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
public function AllOrdersfilter(Request $req){
    if(!empty($req->from)){
        $cfromdate = date('Y-m-d',strtotime($req->from));
    }
    if(!empty($req->to)){
        $ctodate = date('Y-m-d',strtotime($req->to));
    }
    $userid = session()->get('UserLogin2id');
    
    $paramsone = bulkorders::where('User_Id',$userid)
                        ->where('Awb_Number','!=','')
                        ->where('order_status_show','!=','Upload')
                        ->where('order_cancel','!=','1');
    if($req->mode){
    $paramsone->where('Order_Type',$req->mode);
    }
    if($req->courier){
    $paramsone->where('awb_gen_by',$req->courier);
    }
    if(!empty($cfromdate) AND !empty($ctodate)){
    $paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));
    }
    
    $paramsone->orderby('Single_Order_Id','desc');
    $params = $paramsone->get();
    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderAll',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// All Orders
// Pending Orders
public function PeindigOrders(){
    $userid = session()->get('UserLogin2id');
    $params = bulkorders::where('User_Id',$userid)
                            ->where('order_status_show','!=','Delivered')
                            ->where('order_status_show','!=','RTO Delivered')
                            ->where('order_status_show','!=','Upload')
                            ->where('order_status_show','!=','Cancelled')
                            ->where('Awb_Number','!=','')
                            ->where('order_cancel','!=','1')
                            ->orderby('Single_Order_Id','desc')
                            ->get();
    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderPending',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
public function PeindigOrdersFilter(Request $req){
    $userid = session()->get('UserLogin2id');
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
    
    $paramsone = bulkorders::where('User_Id',$userid)
                    ->where('order_status_show','!=','Delivered')
                    ->where('order_status_show','!=','RTO Delivered')
                    ->where('order_status_show','!=','Upload')
                    ->where('Awb_Number','!=','')
                    ->where('order_cancel','!=','1');
    if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
    if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
    if(!empty($cfromdate) AND !empty($ctodate)){    
    $paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }
    
    $paramsone->orderby('Single_Order_Id','desc');
    $params = $paramsone->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderPending',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// Pending Orders
// Complete Orders
    public function CompleteOrders(){
        /*
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id',$userid)
                                //   ->where('order_status_show','Delivered')
                                  ->where('Awb_Number','!=','')
                                  ->where('order_cancel','!=','1')
                                  ->orderby('Single_Order_Id','desc')
                                  ->get();
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype','user')->get();
        return view('UserPanel.PlaceOrder.OrderComplete',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
        */
        return view('UserPanel.PlaceOrder.OrderComplete');
    }
public function CompleteOrdersFilter(Request $req){
    $userid = session()->get('UserLogin2id');
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('User_Id',$userid)
                    ->where('Awb_Number','!=','')
                    ->where('order_status_show','Delivered')
                    ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderComplete',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// Complete Orders
// Cancel Orders
    public function CancelOrders(){
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id',$userid)
                                  ->where('order_status_show','RTO Delivered')
                                  ->where('Awb_Number','!=','')
                                  ->where('order_cancel','!=','1')
                                  ->orderby('Single_Order_Id','desc')
                                  ->get();
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype','user')->get();
        return view('UserPanel.PlaceOrder.OrderCancel',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
    }
public function CancelOrdersFilter(Request $req){
    $userid = session()->get('UserLogin2id');
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('User_Id',$userid)
                    ->where('order_status_show','RTO Delivered')
                    ->where('Awb_Number','!=','')
                    ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderCancel',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// Cancel Orders
// Uploaded Orders
public function UploadedOrders(){
    $userid = session()->get('UserLogin2id');
    $params = bulkorders::where('User_Id',$userid)
                              ->where('Awb_Number','!=','')
                              ->where('order_status_show','Upload')
                              ->where('order_status_show','!=','Cancelled')
                              ->where('order_cancel','!=','1')
                              ->orderby('Single_Order_Id','desc')
                              ->get();
    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderUploaded',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
public function UploadedOrdersFilter(Request $req){
    $userid = session()->get('UserLogin2id');
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('User_Id',$userid)
                    ->where('Awb_Number','!=','')
                    ->where('order_status_show','Upload')
                    ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderUploaded',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// Uploaded Orders
// Canceled Orders
    public function CanceledOrders(){
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id',$userid)
                                  ->where('order_cancel',1)
                                  ->where('order_status_show','!=','Cancelled')
                                  ->orderby('Single_Order_Id','desc')
                                  ->get();
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype','user')->get();
        return view('UserPanel.PlaceOrder.OrderCanceled',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
    }
public function CanceledOrdersFilter(Request $req){
    $userid = session()->get('UserLogin2id');
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('User_Id',$userid)
                    ->where('order_cancel',1);
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderCanceled',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// Canceled Orders
// Failed Orders
public function FaildedOrders(){
    $userid = session()->get('UserLogin2id');
    $params = bulkorders::where('User_Id',$userid)
                              ->where('Awb_Number','')
                              ->orderby('Single_Order_Id','desc')
                              ->get();
    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderFailed',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
public function FaildedOrdersFilter(Request $req){
    $userid = session()->get('UserLogin2id');
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('User_Id',$userid)
                        ->where('Awb_Number','')
                        ->orwhere('apihitornot','0');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();

    $Hubs = Hubs::all();
    $courierapids = CourierApiDetail::all();
    $allusers = Allusers::where('usertype','user')->get();
    return view('UserPanel.PlaceOrder.OrderFailed',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids]);
}
// Failed Orders




// Delete Orders
    public function DeleteOrders(Request $req,$id)
    {
        $userid = session()->get('UserLogin2id');
        $params = orderdetail::where('order_userid',$userid)
                                ->where('orderid',$id)
                                ->where('order_status','Upload')
                                ->delete();
        if($params){
            $req->session()->flash('status','Order Deleted');
        }else{
            $req->session()->flash('status','Order Not Deleted');
        }
        return redirect()->back();
    }
// Delete Orders


// Cancel This Orders
    public function CancelOrdersNow(Request $req,$id)
    {
        $userid = session()->get('UserLogin2id');
        $params = orderdetail::where('orderid',$id)
                            ->update([
                                'order_status'=>"Cancel",
                                'order_cancel_reasion'=>"User Cancel"
                            ]);
        if($params){
            $req->session()->flash('status','Order Cancel');
        }else{
            $req->session()->flash('status','Order Not Cancel');
        }
        return redirect()->back();
    }






    public function CancelOrdersNowAPI(Request $req)
    {
        $id = $req->input('orderid');
        $awbtrackid = $req->input('awbtrackid');

        $params = orderdetail::where('orderid',$id)
                        ->update([
                            'order_status'=>"Cancel",
                            'order_cancel_reasion'=>"User Cancel"
                        ]);

        if($req->couriername=="Pickrr"){
        // -    -   -   -   Pickrr  -   -   -
        $params = array(
            'auth_token' => '42e094b5daec3b715ab96cbb248839dd141263',
            "tracking_id"=>"$awbtrackid"
                );

            try{
                $json_params = json_encode( $params );
                $url = 'https://pickrr.com/api/order-cancellation/';
                //open connection
                $ch = curl_init();
                //set the url, number of POST vars, POST data
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $json_params);
                curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                //execute post
                $result = curl_exec($ch);
                $result = json_decode($result, true);
                //close connection
                curl_close($ch);

                  $req->session()->flash('status','Order Cancel');
            }
            catch (\Exception $e) {
              $req->session()->flash('status','Order Not Cancel');
            }
        // -    -   -   -   Pickrr  -   -
        }elseif($req->couriername=="SmartShip"){
        // -    -   -   -   SmartShip  -   -

// Token Generate SmartShip
    $params = array(
            "username"=>"info@shipxpress.in",
            "password"=>"55963d6247d3aacb019bc15204c3bd4d",
            "client_id"=>"67SWU5YMPWX8KV0DOM3P0ZF",
            "client_secret"=>"A@)3#X98TLR)FBPZ6(X_Z",
            "grant_type"=>"password"
            // "username"=>"vivek.sankhyan@shopclues.com",
            // "password"=>"e10adc3949ba59abbe56e057f20f883e",
            // "client_id"=>"1ZT6T60OPZ6LGOHOS99IV0ES5UA4",
            // "client_secret"=>"!K3V@Y_7LSD(MUG44ZG4ZTJLZ7FE8)_XI2*_D^5QL9MYGT",
            // "grant_type"=>"password"
        );
    // $clientiddeclare = "1ZT6T60OPZ6LGOHOS99IV0ES5UA4";
    $clientiddeclare = "67SWU5YMPWX8KV0DOM3P0ZF";

    $json_params = json_encode( $params );
    $url = "http://oauth.smartship.in/loginToken.php";
    //open connection
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $json_params);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    //execute post
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    //close connection
    curl_close($ch);
    $tokengenerateis = $result['access_token'];
// Token Generate SmartShip
// Add in SmartShip API
$bearerkey = $tokengenerateis;
$paramsdata = '{
"orders": {
        "client_order_reference_ids":["'.$req->orderno.'"],
        "request_order_ids":[]
    }
}';

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'http://api.smartship.in/v2/app/Fulfillmentservice/orderCancellation',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>$paramsdata,
CURLOPT_HTTPHEADER => array(
"Content-Type: application/json",
"Authorization: Bearer $bearerkey"
),
));

$response = curl_exec($curl);
// $response = json_decode($response, true);
$response = json_decode($response, true);
curl_close($curl);
// print_r($response);
// Add in SmartShip API

        // -    -   -   -   SmartShip  -   -
        }


        $req->session()->flash('status','Order Cancel');
        return redirect()->back();

    }
// Cancel This Orders
    //

}
