<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\orderdetail;
use App\Models\Allusers;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminDailyReport extends Controller
{
    public function Home()
    {
    	// Today
		$today = Carbon::now();
		$tdate = $today->toDateString();  

        $params = orderdetail::where('order_delivery_date',$tdate)->get();
        return view('Admin.DailyReport.DailyReport',['params'=>$params]);
    }

    function DailyReport()
    {
    	return Excel::download(new DailyReportExport,'DailyReport.xlsx');
    }

}



class DailyReportExport implements WithHeadings,FromCollection
{
    public function collection()
    {
    	$today = Carbon::now();
		$tdate = $today->toDateString();  
		$products = orderdetail::where('order_delivery_date',$tdate)->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->get();

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

