<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;
use DB;
use Excel;

class RiderPlaceOrder extends Controller
{
// Change Status
    public function Status_Change(Request $req)
    {
        // return $req->param;
        if($req->paramval == "Pending")
        {
            orderdetail::where('orderid',$req->param)
                        ->update([
                                'order_status'=>$req->paramval,
                                'order_rider_status'=>$req->paramval
                                ]);
        }
        elseif($req->paramval == "Progress")
        {
            orderdetail::where('orderid',$req->param)
                        ->update([
                                'order_status'=>$req->paramval,
                                'order_rider_status'=>$req->paramval
                                ]);
        }elseif($req->paramval == "Complete")
        {
            orderdetail::where('orderid',$req->param)
                        ->update([
                                'order_status'=>$req->paramval,
                                'order_rider_status'=>$req->paramval
                                ]);
        }else
        {
            orderdetail::where('orderid',$req->param)
                        ->update([
                                'order_status'=>"Cancel",
                                'order_rider_status'=>$req->paramval
                                ]);
        }
        // return "working";
    }
// Change Status

// Status_Update
    public function Status_Update(Request $req)
    {
date_default_timezone_set("Asia/Kolkata");

        // return $req->input();
        $crtatmpt = orderdetail::where('orderid',$req->orderid)->first();
        if(empty($crtatmpt['order_rider_atmpt'])){
            orderdetail::where('orderid',$req->orderid)->update(['order_first_attempt_datetime'=>date('Y-m-d H:i:s')]);
        }
        $crtatmptno = $crtatmpt['order_rider_atmpt'] + 1;

if($req->orderstatus=="Complete")
{
    orderdetail::where('orderid',$req->orderid)
                ->update([
                    'order_status'=>$req->orderstatus,
                    'order_status1'=>$req->orderstatus12,
                    'order_complete_remark'=>$req->completemark,
                    'order_delivery_date'=>date('Y-m-d'),
                    'order_payment_mode'=>$req->paymentmode,
                    'order_pending_remark'=>null,
                    'order_cancel_reasion'=>null,
                    'rto_date'=>null,
                    'order_rider_atmpt'=>$crtatmptno,
                    'last_status_date'=>date('Y-m-d H:i:s')
                        ]);
}elseif($req->orderstatus=="Cancel")
{
    orderdetail::where('orderid',$req->orderid)
                ->update([
                    'order_status'=>$req->orderstatus,
                    'order_status1'=>$req->orderstatus11,
                    'order_cancel_reasion'=>$req->cancelremark,
                    'rto_date'=>date('Y-m-d'),
                    'order_rider_atmpt'=>$crtatmptno,
                    'order_complete_remark'=>null,
                    'order_pending_remark'=>null,
                    'order_delivery_date'=>null,
                    'order_payment_mode'=>null,
                    'last_status_date'=>date('Y-m-d H:i:s')
                        ]);
}else
{
        orderdetail::where('orderid',$req->orderid)
                    ->update([
                        'order_status'=>$req->orderstatus,
                        'order_status1'=>$req->orderstatus13,
                        'order_pending_remark'=>$req->pendingremark,
                        'order_rider_atmpt'=>$crtatmptno,
                        'order_complete_remark'=>null,
                        'order_cancel_reasion'=>null,
                        'order_delivery_date'=>null,
                        'order_payment_mode'=>null,
                        'rto_date'=>null,
                        'last_status_date'=>date('Y-m-d H:i:s')
                            ]);
    // orderdetail::where('orderid',$req->orderid)
    //                 ->update([
    //                     'order_status'=>$req->orderstatus,
    //                     'order_status_remark'=>$req->orderremark,
    //                     'order_cancel_reasion'=>$remarkpanelifany,
    //                     'order_delivery_date'=>$datedelivery,
    //                     'order_status_remark'=>$req->completemark,
    //                     'order_payment_mode'=>$req->paymentmode,
    //                     'rto_reason'=>$req->rtoreason,
    //                     'rto_date'=>$datecancel,
    //                     'order_rider_atmpt'=>$crtatmptno
    //                         ]);
}
        $req->session()->flash('status','Status Update');
        // return redirect('/RPAll_Order');
        return redirect()->back();
    }
// Status_Update
    
// AllOrders
    public function AllOrders()
    {
        $riderid = session()->get('UserLogin3id');
        $params = orderdetail::where('order_riderid',$riderid)
                                ->orderby('orderid','desc')
                                ->get();
        return view('RiderPanel.PlaceOrder.AllOrders',['params'=>$params]);
    }
// AllOrders
// All Pending Orders
    public function AllPending()
    {
        $riderid = session()->get('UserLogin3id');
    	$params = orderdetail::where('order_riderid',$riderid)
                                ->where('order_status','Progress')
                                ->orWhere('order_status', 'Pending')
                                ->orderby('orderid','desc')
                                ->get();
    	return view('RiderPanel.PlaceOrder.AllPending',['params'=>$params]);
    }
// All Pending Orders
// All Complete Orders
    public function AllComplete()
    {
        $riderid = session()->get('UserLogin3id');
        $params = orderdetail::where('order_riderid',$riderid)
                                ->where('order_status','Complete')
                                ->orderby('orderid','desc')
                                ->get();
        return view('RiderPanel.PlaceOrder.AllComplete',['params'=>$params]);
    }
// All Complete Orders
// All Cancel Orders
    public function AllCancel()
    {
        $riderid = session()->get('UserLogin3id');
        $params = orderdetail::where('order_riderid',$riderid)
                                ->where('order_status','Cancel')
                                ->orderby('orderid','desc')
                                ->get();
        return view('RiderPanel.PlaceOrder.AllCancel',['params'=>$params]);
    }
// All Cancel Orders




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
    	return view('RiderPanel.PlaceOrder.SingleReverse');
    }

    public function BulkReverse()
    {
    	return view('RiderPanel.PlaceOrder.BulkReverse');
    }
}
