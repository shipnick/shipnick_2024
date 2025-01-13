<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Allusers;
use App\Models\Hubs;
use App\Models\CourierApiDetail;
use App\Models\smartship;
use DB;
use Excel;
use Carbon\Carbon;

class UserOrderManage extends Controller
{
    public function Orders_new_date(Request $request)
    {

        $userid = session()->get('UserLogin2id');
        if (!empty($request->from)) {
            $cfromdate = date('Y-m-d', strtotime($request->from));
        }
        if (!empty($request->to)) {
            $ctodate = date('Y-m-d', strtotime($request->to));
        }

        $paramsone = bulkorders::where('User_Id', $userid)
            ->where('Rec_Time_Date', '>=', $cfromdate)
            ->where('Rec_Time_Date', '<=', $ctodate)
            ->orderby('Single_Order_Id', 'desc')
            ->get();
        // if($req->mode){    $paramsone->where('Order_Type',$req->mode);          }
        // if($req->courier){    $paramsone->where('awb_gen_by',$req->courier);    }





        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.filterorder', ['params' => $paramsone, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids]);
    }



    // All Orders
    public function AllAllOrders()
    {
        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate
        $params = bulkorders::where('User_Id', $userid)
            // ->where('order_status_show','!=','Delivered')
            // ->where('order_status_show','!=','RTO Delivered')
            // ->where('order_status_show','!=','Upload')
            // ->where('order_status_show','!=','Cancelled')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(500);
        $param1 = bulkorders::where('User_Id', $userid)
            // ->where('order_status_show','!=','Delivered')
            // ->where('order_status_show','!=','RTO Delivered')
            // ->where('order_status_show','!=','Upload')
            // ->where('order_status_show','!=','Cancelled')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->orderby('Single_Order_Id', 'desc')
            ->get();



        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderAllAll', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'param1' => $param1, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function AllAllOrdersFilter(Request $req)
    {
        // dd($req->all());
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($req->to)->endOfDay(); // End of the day for $ctodate

        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type');

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }

        $params = $params->paginate(3000);

        // Debugging: Output the params
        // dd($params); 

        // Retrieve additional data and return the view
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderAllAll', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // All Orders
    // All Delivered Orders
    public function AllOrders()
    {
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
    return view('UserPanel.PlaceOrder.OrderAll',['params'=>$params,'Hubs'=>$Hubs,'allusers'=>$allusers,'courierapids'=>$courierapids ]);
    */
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');

        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id', $userid)
            ->where('showerrors', 'Delivered')
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderAll', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function AllOrdersfilter(Request $req)
    {
        // dd($req->all());
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($req->to)->endOfDay(); // End of the day for $ctodate

        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->where('order_cancel', '!=', '1')
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors');

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }

        $params = $params->paginate(3000);

        // Debugging: Output the params
        // dd($params); 

        // Retrieve additional data and return the view
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderAll', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // All Delivered Orders
    // Pending Orders
    public function PeindigOrders()
    {
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id', $userid)
            // ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup'])
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
            ->where('order_status_show', '!=', 'Cancelled')
            ->whereNotNull('Awb_Number')
            ->where('order_cancel', '!=', '1')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderPending', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function PeindigOrdersFilter(Request $req)

    {
        // dd($req->all());
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        // $cfromdateObj = Carbon::parse($req->from)->startOfDay(); // Start of the day for $cfromdate
        // $ctodateObj = Carbon::parse($req->to)->endOfDay(); // End of the day for $ctodate

        $cfromdateObj = Carbon::parse($req->from)->startOfDay();
        $ctodateObj = Carbon::parse($req->to)->endOfDay();
        //   dd($cfromdateObj,$ctodateObj); 
        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)

            ->where('order_cancel', '!=', '1')
            ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])

            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        // Debugging: Output the params
        // dd($params); 

        // Retrieve additional data and return the view
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderPending', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // Pending Orders
    // Complete Orders
    public function CompleteOrders()
    {
        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');
        return view('UserPanel.PlaceOrder.OrderComplete')->with($data);
    }
    public function CompleteOrdersFilter(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        if (!empty($req->from)) {
            $cfromdate = date('Y-m-d', strtotime($req->from));
        }
        if (!empty($req->to)) {
            $ctodate = date('Y-m-d', strtotime($req->to));
        }
        $paramsone = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '!=', '')
            ->where('order_status_show', 'Delivered')
            ->where('order_cancel', '!=', '1');
        if ($req->mode) {
            $paramsone->where('Order_Type', $req->mode);
        }
        if ($req->courier) {
            $paramsone->where('awb_gen_by', $req->courier);
        }
        if (!empty($cfromdate) and !empty($ctodate)) {
            $paramsone->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate));
        }

        $paramsone->orderby('Single_Order_Id', 'desc');
        $params = $paramsone->get();

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderComplete', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids]);
    }
    // Complete Orders
    // Cancel Orders
    public function CancelOrders()

    {
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id', $userid)
            ->where('showerrors', 'Undelivered')
            // ->whereIn('showerrors', ['Shipment Redirected','Undelivered' ,'RTO Initiated','RTO Delivered' ,'RTO Acknowledged' ,'RTO_OFD' , 'RTO IN INTRANSIT','rto'])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderCancel', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function CancelOrdersFilter(Request $req)
    {
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from);
        $ctodateObj = Carbon::parse($req->to);

        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->where('showerrors', 'Undelivered')
            ->where('order_cancel', '!=', '1')
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderCancel', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids]);
    }
    // Cancel Orders
    // Uploaded Orders
    public function UploadedOrders()
    {
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '!=', '')
            ->where('showerrors', 'Undelivered')
            ->where('order_status_show', '!=', 'Cancelled')
            ->where('order_cancel', '!=', '1')
            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderUploaded', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function UploadedOrdersFilter(Request $req)
    {
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from);
        $ctodateObj = Carbon::parse($req->to);

        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->where('showerrors', 'Undelivered')
            ->where('order_cancel', '!=', '1')
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderUploaded', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // Uploaded Orders
    // Canceled Orders
    public function CanceledOrders()
    {
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', 1)
            // ->where('showerrors', 'Cancelled By Client')
            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderCanceled', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function CanceledOrdersFilter(Request $req)
    {
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from);
        $ctodateObj = Carbon::parse($req->to);
        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->where('showerrors', 'Cancelled By Client')
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderCanceled', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // Canceled Orders


    public function  ofd_orders()
    {
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $params = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])

            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.Orderofd', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function ofd_ordersFilter(Request $req)
    {
        // dd($req->all());
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        // $cfromdateObj = Carbon::parse($req->from)->startOfDay(); // Start of the day for $cfromdate
        // $ctodateObj = Carbon::parse($req->to)->endOfDay(); // End of the day for $ctodate

        $cfromdateObj = Carbon::parse($req->from);
        $ctodateObj = Carbon::parse($req->to);
        //   dd($cfromdateObj,$ctodateObj);
        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)

            ->where('order_cancel', '!=', '1')
            ->where('showerrors', ['Out For Delivery'])

            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        // Debugging: Output the params
        // dd($params); 

        // Retrieve additional data and return the view
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.Orderofd', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // Failed Orders
    public function FaildedOrders()
    {
        $tdate = date('Y-m-d');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $params = bulkorders::where('User_Id', $userid)
            // ->where('dtdcerrors', '1')
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->orderby('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderFailed', ['params' => $params, 'Hubs' => $Hubs, 'allusers' => $allusers, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function FaildedOrdersFilter(Request $req)
    {
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from);
        $ctodateObj = Carbon::parse($req->to);

        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->where('showerrors', 'Pincode not serviceable.')
            ->where('Awb_Number', '')
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->product_name) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.OrderFailed', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }
    // Failed Orders




    // Delete Orders
    public function DeleteOrders(Request $req, $id)
    {
        $userid = session()->get('UserLogin2id');
        $params = orderdetail::where('order_userid', $userid)
            ->where('orderid', $id)
            ->where('order_status', 'Upload')
            ->delete();
        if ($params) {
            $req->session()->flash('status', 'Order Deleted');
        } else {
            $req->session()->flash('status', 'Order Not Deleted');
        }
        return redirect()->back();
    }
    // Delete Orders


    // Cancel This Orders
    public function CancelOrdersNow(Request $req, $id)
    {

        $userid = session()->get('UserLogin2id');

        $awbNumbers = $id;

        // Perform a single update query
        bulkorders::whereIn('Awb_Number', $awbNumbers)
            ->update(['order_cancel' => 1]);

        Http::get('https://www.shipnick.com/UPBulk_cancel_Order_API');

        return redirect()->back();
    }






    public function CancelOrdersNowAPI(Request $req)
    {

        $id = $req->input('orderid');
        $awbtrackid = $req->input('awbtrackid');

        $params = orderdetail::where('orderid', $id)
            ->update([
                'order_status' => "Cancel",
                'order_cancel_reasion' => "User Cancel"
            ]);

        if ($req->couriername == "Pickrr") {
            // -    -   -   -   Pickrr  -   -   -
            $params = array(
                'auth_token' => '42e094b5daec3b715ab96cbb248839dd141263',
                "tracking_id" => "$awbtrackid"
            );

            try {
                $json_params = json_encode($params);
                $url = 'https://pickrr.com/api/order-cancellation/';
                //open connection
                $ch = curl_init();
                //set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //execute post
                $result = curl_exec($ch);
                $result = json_decode($result, true);
                //close connection
                curl_close($ch);

                $req->session()->flash('status', 'Order Cancel');
            } catch (\Exception $e) {
                $req->session()->flash('status', 'Order Not Cancel');
            }
            // -    -   -   -   Pickrr  -   -
        } elseif ($req->couriername == "SmartShip") {
            // -    -   -   -   SmartShip  -   -

            $smartshiptoken1 = smartship::where('id', 1)->first('token');
            $smartshiptoken = $smartshiptoken1['token'];
            // Add in SmartShip API
            $bearerkey = $smartshiptoken;


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.smartship.in/v2/app/Fulfillmentservice/orderCancellation',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                                 "request_info":{
                                 "ip_address":"",
                                 "”browser_name”":"",
                                 "location":""
                                 },
                                 "orders":{
                                 "client_order_reference_ids":[
                                 "' . $req->orderno . '"
                                 ],
                                 "request_order_ids":[
                                
                                 ]
                                 }
                                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    "Authorization: Bearer $bearerkey"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            $response = curl_exec($curl);
            // $response = json_decode($response, true);
            $response = json_decode($response, true);
            curl_close($curl);
            // print_r($response);
            // Add in SmartShip API

            // -    -   -   -   SmartShip  -   -
        } elseif ($req->couriername == "Ecom") {
            // -    -   -   -   Ecom  -   -

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
                CURLOPT_POSTFIELDS => array('username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073', 'password' => 'lnR1C8NkO1', 'awbs' => $awbtrackid),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response, true);
            curl_close($curl);

            // echo $response;
            if ($response['success'] = true) {
                echo "<br>if section <br>";

                $ecomorderid = $response['reason'];
                bulkorders::where('Single_Order_Id', $id)->update(['showerrors' => $ecomorderid]);
            }
        }


        $req->session()->flash('status', 'Order Cancel');
        return redirect()->back();
    }
    // Cancel This Orders
    //
    public function Booked(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Determine the date range based on request parameters or default to today
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::today()->startOfDay();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::today()->endOfDay();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->whereNull('xberrors')
            ->where('Awb_Number', '')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Single_Order_Id','Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','Actual_Weight' ,'Height' , 'Width', 'Length' , 'orderno', 'Quantity', 'Total_Amount','uploadtype');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('warehouse')) {
            // $Hubs1 = Hubs::where('hub_code', $req->warehouse)->first();
            // dd($req->warehouse);
            $query->where('pickup_id', $req->warehouse);
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }
        


        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        // Determine the current month's start and end dates
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Calculate various counts
        $booked = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '!=', '')
            ->whereNull('xberrors')
            ->where('Awb_Number', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$currentMonthStart, $currentMonthEnd])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$currentMonthStart, $currentMonthEnd])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$currentMonthStart, $currentMonthEnd])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$currentMonthStart, $currentMonthEnd])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$currentMonthStart, $currentMonthEnd])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->whereDate('Rec_Time_Date', Carbon::today())
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight', 'Shipment Booked'])
            ->whereBetween('Last_Time_Stamp', [$currentMonthStart, $currentMonthEnd])
            ->count();

        // Prepare data for the view
        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.booked', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }

    
    public function Pickup_pending(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->whereIn('showerrors', ['Booked','Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth(); // Start of the day for $cfromdate
        $ctodateObj1 = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
             ->whereNull('xberrors')
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');



        return view('UserPanel.PlaceOrder1.pickup-pending', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }
    public function Intransit(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '!=', '')
             ->whereNull('xberrors')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.intransit', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }
    public function Ofd(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '!=', '')
             ->whereNull('xberrors')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.ofd', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }
    public function Deliverd(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->where('showerrors', 'Delivered')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
             ->whereNull('xberrors')
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.deliverd', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }
    public function Rto(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->where('showerrors', 'Undelivered')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
             ->whereNull('xberrors')
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.rto', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }
    public function Canceled(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj1 = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::now()->startOfMonth();
        $ctodateObj1 = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::now()->endOfMonth();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)

           
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj1 && $ctodateObj1) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();

        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
             ->whereNull('xberrors')
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.cancelled', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }

    public function Failled(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $Hubs1 = Hubs::where('hub_created_by', $userid)->get();
        // Convert date range inputs to Carbon objects if they are set
        $cfromdateObj = $req->filled('from') ? Carbon::parse($req->from)->startOfDay() : Carbon::today()->startOfDay();
        $ctodateObj = $req->filled('to') ? Carbon::parse($req->to)->endOfDay() : Carbon::today()->endOfDay();

        // Query using Laravel Eloquent
        $query = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->where('Awb_Number', '')
            ->orderBy('Single_Order_Id', 'desc')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type', 'Item_Name','awb_gen_by','Awb_Number','Quantity', 'Total_Amount','orderno','uploadtype','Single_Order_Id');

        // Apply additional filters based on request parameters
        if ($cfromdateObj && $ctodateObj) {
            $query->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);
        }
        if ($req->filled('order_type')) {
            $query->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if ($req->filled('product_name')) {
            $query->where('Item_Name', $req->product_name);
        }
        if ($req->filled('awb')) {
            $query->where('Awb_Number', $req->awb);
        }
        if ($req->filled('courier')) {
            $query->where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        if ($req->filled('cannel')) {
            $query->where('uploadtype', 'like', '%' . $req->cannel . '%');
        }
        if ($req->filled('orderid')) {
            $query->where('orderno', 'like', '%' . $req->orderid . '%');
        }

        $perPage = $req->input('per_page', 50);
        $orders = $query->paginate($perPage);

        // Retrieve additional data
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();


        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $cfromdateObj = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // Current Month
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstart = "1-$crtmonth-$crtyear";
        $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
        $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
        $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));

        $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
        $ctodate = date('Y-m-d', strtotime($currentmonthstend));

        $cfromdateObj1 = Carbon::parse($cfromdate)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj1 = Carbon::parse($ctodate)->endOfDay(); // End of the day for $ctodate

        // booked of today order count
        $booked = bulkorders::where('User_Id', $userid)
             ->whereNull('xberrors')
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
            ->where('order_cancel', '!=', '1')
            ->count();

        $deliver = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->count();

        $pending_pickup = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated','Booked'])
            ->whereNotNull('Awb_Number')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $rto = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
            ->where('Awb_Number', '!=', '')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', '!=', '1')
            ->count();

        $cancel = bulkorders::where('User_Id', $userid)
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->where('order_cancel', 1)
            ->count();

        $ofd = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $failde = bulkorders::where('User_Id', $userid)
            ->where('Awb_Number', '')
            ->where('Rec_Time_Date', $tdate)
            ->count();

        $in_transit = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->count();

        $data = compact('in_transit', 'failde', 'ofd', 'cancel', 'rto', 'pending_pickup', 'deliver', 'booked');

        return view('UserPanel.PlaceOrder1.failed', [
            'params' => $orders,
            'Hubs' => $Hubs,
            'Hubs1' => $Hubs1,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ])->with($data);
    }

    public function awb_order_details($id)
    {
        // Retrieve a single order by 'ordernoapi'
        $order = bulkorders::where('ordernoapi', $id)->first();
        // dd($order);
        // Check if the order exists
        if (!$order) {
            return redirect()->with('error', 'Order not found');
        }

        // Pass the order data to the view
        return view('UserPanel.PlaceOrder.awbOrderDetails', compact('order'));
    }
}
