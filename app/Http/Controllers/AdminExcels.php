<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminExcels extends Controller
{
    function AllOrders()
    {
    	return Excel::download(new AllOrderExport,'AllOrders.xlsx');
    }

    function AllNewOrders()
    {
    	return Excel::download(new AllNewOrderExport,'AllNewOrders.xlsx');
    }

    function AllPendingOrder()
    {
    	return Excel::download(new AllPendingOrderExport,'AllPendingOrders.xlsx');
    }

    function AllCompleteOrder()
    {
    	return Excel::download(new AllCompleteOrderExport,'AllCompleteOrders.xlsx');
    }

    function AllCancelOrder()
    {
    	return Excel::download(new AllCancelOrderExport,'AllCancelOrders.xlsx');
    }

    function MISReport()
    {
    	return Excel::download(new MISReportExport,'MISReport.xlsx');
    }

    
}

class AllOrderExport implements WithHeadings,FromCollection
{
    public function collection()
    {
		$products = orderdetail::select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->get();

		foreach ($products as $key => $product){
		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
		    	$products[$key]->order_userid = $catName->name;
		}
		return $products;
    }

    public function headings(): array{

		return["AWB No",'Order No','Client Name','Client Mobile','Destination Pincode','COD Amount','Upload Date','Current Status','Customer Name','Courier Name'];

	}
}


class AllNewOrderExport implements WithHeadings,FromCollection
{
    public function collection()
    {
		$products = orderdetail::select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->where('order_status','Upload')->get();

		foreach ($products as $key => $product){
		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
		    	$products[$key]->order_userid = $catName->name;
		}
		return $products;
    }

    public function headings(): array{

		return["AWB No",'Order No','Client Name','Client Mobile','Destination Pincode','COD Amount','Upload Date','Current Status','Customer Name','Courier Name'];

	}
}

class AllPendingOrderExport implements WithHeadings,FromCollection
{
    public function collection()
    {
		$products = orderdetail::select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->where('order_status','Pending')->get();

		foreach ($products as $key => $product){
		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
		    	$products[$key]->order_userid = $catName->name;
		}
		return $products;
    }

    public function headings(): array{

		return["AWB No",'Order No','Client Name','Client Mobile','Destination Pincode','COD Amount','Upload Date','Current Status','Customer Name','Courier Name'];

	}
}


class AllCompleteOrderExport implements WithHeadings,FromCollection
{
    public function collection()
    {
		$products = orderdetail::select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->where('order_status','Complete')->get();

		foreach ($products as $key => $product){
		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
		    	$products[$key]->order_userid = $catName->name;
		}
		return $products;
    }

    public function headings(): array{

		return["AWB No",'Order No','Client Name','Client Mobile','Destination Pincode','COD Amount','Upload Date','Current Status','Customer Name','Courier Name'];

	}
}


class AllCancelOrderExport implements WithHeadings,FromCollection
{
    public function collection()
    {
		$products = orderdetail::select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->where('order_status','Cancel')->get();

		foreach ($products as $key => $product){
		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
		    	$products[$key]->order_userid = $catName->name;
		}
		return $products;
    }

    public function headings(): array{

		return["AWB No",'Order No','Client Name','Client Mobile','Destination Pincode','COD Amount','Upload Date','Current Status','Customer Name','Courier Name'];

	}
}



class MISReportExport implements WithHeadings,FromCollection
{
    public function collection()
    {
		$products = orderdetail::select('awb_no', 'orderno', 'cname', 'caddress','ccity', 'cmobile', 'cpin', 'itmecodamt', 'order_payment_mode', 'order_status', 'order_status_remark', 'order_start_date', 'order_userid', 'order_rider_atmpt',  'order_cancel_reasion', 'order_delivery_date', 'courier_name', 'last_status_date', 'rto_date', 'rto_reason')->where('order_status','Cancel')->get();

		foreach ($products as $key => $product){
		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
		    	$products[$key]->order_userid = $catName->name;
		}
		return $products;
    }

    public function headings(): array{

		return[
"Awb No",
"Order No",
"Client Name",
"Destination Address",
"Destination City",
"Client Mobile",
"Destination Pin",
"COD Amount",
"Payment Mode",
"Order Status",
"Courier Remark",
"Start Date",
"Customer Name",
"AttemptCount",
"RTO Reason",
"Delivery Date",
"Courier Name",
"Last Status date",
"RTO Date",
"RTO Reason"
		];

	}
}
