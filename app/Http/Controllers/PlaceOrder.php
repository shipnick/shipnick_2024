<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Allusers;
use App\Models\OrderStatusLabel;
use DB;
use Excel;

class PlaceOrder extends Controller
{
// All Orders
    public function AllOrders(){
        $allriders = Allusers::where('usertype','rider')->get();
        $allusers = Allusers::where('usertype','user')->get();
        // $params = orderdetail::where('awb_no','!=','')->orderby('orderid','desc')->get();
        // $params = bulkorders::where('Awb_Number','!=','')
        //                       ->where('order_cancel','!=','1')
        //                       ->orderby('Single_Order_Id','desc')
        //                       ->get();
        // $params = bulkorders::orderby('Single_Order_Id','desc')
        //                       ->get();
        $params = bulkorders::where('order_cancel','!=','1')
                            ->where('Awb_Number','!=','')
                            ->where('order_status_show','!=','Upload')
                            ->get();
        return view('Admin.PlaceOrder.AllOrders',['params'=>$params,'allriders'=>$allriders,'allusers'=>$allusers]);
    }
    
public function AllOrdersFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('order_status_show','!=','Upload')
                    ->where('Awb_Number','!=','')
                    ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();
    $allusers = Allusers::where('usertype','user')->get();
    return view('Admin.PlaceOrder.AllOrders',['params'=>$params,'allusers'=>$allusers]);
}
// All Orders




    public function AllOrderManage(Request $req)
    {
        // return $req->input();
        $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->where('status','1')->get();
        $params = orderdetail::where('order_status','Upload')
                            ->orderby('orderid','desc')
                            ->get();
        return view('Admin.PlaceOrder.AllOrdersManage',['params'=>$params,'allriders'=>$allriders,'allusers'=>$allusers]);
    }

    public function AllOrderManageAction(Request $req)
    {
    $riderids = Allusers::where('name',$req->ridername)->first();
    $riderid = $riderids['id'];
    $crtorderdetails = orderdetail::where('orderid',$req->orderno)->first();
    $crtorderid = $crtorderdetails['orderid'];
    $defaultno = 1000;
    $orderuid = $defaultno+$crtorderid;
    $d1 = date("d");
    $m1 = date("m");
    $y1 = date("y");
    $awbno = "SL".$y1.$m1.$d1.$orderuid;
        $params = orderdetail::where('orderid',$req->orderno)
                            ->update([
                                'awb_no'=>$awbno,
                                'order_status'=>"Progress",
                                'courier_name'=>"ShipXpress",
                                'order_start_date'=>date('Y-m-d'),
                                'order_riderid'=>$riderid,
                                'order_ridername'=>$req->ridername
                            ]);
        $req->session()->flash('status','Order Move To Rider');
        return redirect('/All_Orders_Manage');
    }
// All Orders























// Pending Orders
    public function AllOrdersPending()
    {
        $allusers = Allusers::where('usertype','user')->get();
        $allriders = Allusers::where('usertype','rider')->get();
        $params = bulkorders::where('order_status_show','!=','Delivered')
                              ->where('order_status_show','!=','RTO Delivered')
                              ->where('order_status_show','!=','Upload')
                              ->where('Awb_Number','!=','')
                              ->where('order_cancel','!=','1')
                              ->orderby('Single_Order_Id','desc')
                              ->get();
        $statuslabels = OrderStatusLabel::all();
        return view('Admin.PlaceOrder.AllOrdersPending',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders,'statuslabels'=>$statuslabels]);
    }
public function AllOrdersPendingFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('order_status_show','!=','Delivered')
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
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    return view('Admin.PlaceOrder.AllOrdersPending',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders]);
}
// Pending Orders
// Change Status
    public function AllOrdersStatus(Request $req)
    {
        // return $req->param;
        $orderid = $req->orderid;
        $labelid = $req->labelid;
        $labeldetails = OrderStatusLabel::where('labelid',$labelid)->first();
        orderdetail::where('orderid',$orderid)
                    ->update([
                            'order_status'=>$labeldetails['labelcate'],
                            'order_status1'=>$labeldetails['labelname']
                            ]);
        return $labeldetails['labelname'];
    }
// Change Status










// Complete Orders
    public function AllOrdersComplete(){
        $allusers = Allusers::where('usertype','user')->get();
        $allriders = Allusers::where('usertype','rider')->get();
        $params = bulkorders::where('order_status_show','Delivered')
                              ->where('Awb_Number','!=','')
                              ->where('order_cancel','!=','1')
                              ->orderby('Single_Order_Id','desc')
                              ->get();
        $statuslabels = OrderStatusLabel::all();
        return view('Admin.PlaceOrder.AllOrdersComplete',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders,'statuslabels'=>$statuslabels]);
    }
public function AllOrdersCompleteFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('order_status_show','Delivered')
                        ->where('Awb_Number','!=','')
                        ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    return view('Admin.PlaceOrder.AllOrdersComplete',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders]);
}
// Complete Orders
// Cancel Orders
    public function AllOrdersCancel(){
        $allusers = Allusers::where('usertype','user')->get();
        $allriders = Allusers::where('usertype','rider')->get();
        $params = bulkorders::where('order_status_show','RTO Delivered')
                              ->where('Awb_Number','!=','')
                              ->where('order_cancel','!=','1')
                              ->orderby('Single_Order_Id','desc')
                              ->get();
        $statuslabels = OrderStatusLabel::all();
        return view('Admin.PlaceOrder.AllOrdersCancel',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders,'statuslabels'=>$statuslabels]);
    }
    
public function AllOrdersCancelFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('order_status_show','RTO Delivered')
                        ->where('Awb_Number','!=','')
                        ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    return view('Admin.PlaceOrder.AllOrdersCancel',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders]);
}
// Cancel Orders
// Uploaded Orders
    public function AllOrdersUploaded(){
        $allusers = Allusers::where('usertype','user')->get();
        $allriders = Allusers::where('usertype','rider')->get();
        $params = bulkorders::where('order_status_show','Upload')
                              ->where('Awb_Number','!=','')
                              ->where('order_cancel','!=','1')
                              ->orderby('Single_Order_Id','desc')
                              ->get();
        $statuslabels = OrderStatusLabel::all();
        return view('Admin.PlaceOrder.AllOrdersUploaded',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders,'statuslabels'=>$statuslabels]);
    }
public function AllOrdersUploadedFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('order_status_show','Upload')
                        ->where('Awb_Number','!=','')
                        ->where('Awb_Number','!=','')
                        ->where('order_cancel','!=','1');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    return view('Admin.PlaceOrder.AllOrdersUploaded',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders]);
}
// Uploaded Orders
// Canceled Orders
    public function AllOrdersCanceled(){
        $allusers = Allusers::where('usertype','user')->get();
        $allriders = Allusers::where('usertype','rider')->get();
        $params = bulkorders::where('order_cancel',1)
                              ->orderby('Single_Order_Id','desc')
                              ->get();
        $statuslabels = OrderStatusLabel::all();
        return view('Admin.PlaceOrder.AllOrdersCanceled',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders,'statuslabels'=>$statuslabels]);
    }
public function AllOrdersCanceledFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('order_cancel',1);
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    return view('Admin.PlaceOrder.AllOrdersCanceled',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders]);
}
// Canceled Orders
// Failed Orders
public function FailedOrders(){
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    $params = bulkorders::where('Awb_Number','')
                          ->orwhere('apihitornot','0')
                          ->orderby('Single_Order_Id','desc')
                          ->get();
    $statuslabels = OrderStatusLabel::all();
    
    return view('Admin.PlaceOrder.FailedOrders',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders,'statuslabels'=>$statuslabels]);
}
public function FailedOrdersFilter(Request $req){
    if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
    if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
$paramsone = bulkorders::where('Awb_Number','')
                        ->orwhere('apihitornot','0');
if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }
if(!empty($cfromdate) AND !empty($ctodate)){    
$paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

$paramsone->orderby('Single_Order_Id','desc');
$params = $paramsone->get();
    $allusers = Allusers::where('usertype','user')->get();
    $allriders = Allusers::where('usertype','rider')->get();
    return view('Admin.PlaceOrder.FailedOrders',['params'=>$params,'allusers'=>$allusers,'allriders'=>$allriders]);
}
// Failed Orders


    public function readcsv()
    {
    	$fileD = fopen('expertphp-product.csv',"r");
        $column=fgetcsv($fileD);
        while(!feof($fileD)){
         $rowData[]=fgetcsv($fileD);
        }
        foreach ($rowData as $key => $value) {

            $inserted_data=array('name'=>$value[0],
                                 'details'=>$value[1],
                            );

             Product::create($inserted_data);
        }
        print_r($rowData);
    }

    public function SingleReverse()
    {
    	return view('Admin.PlaceOrder.SingleReverse');
    }

    public function BulkReverse()
    {
    	return view('Admin.PlaceOrder.BulkReverse');
    }
}
