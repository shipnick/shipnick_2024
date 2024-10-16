<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\CourierApiDetail;
use App\Models\Hubs;
use App\Models\OrdersStatus;

use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Manifest;
use App\Models\Manifestorders;
use App\Models\NDRorders;
use App\Models\CourierNames;
use App\Models\Allusers;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class UserExcels extends Controller
{

	public function POD()
    {
		$userid = session()->get('UserLogin2id');

        $params = orderdetail::where('order_userid',$userid)
        					->where('order_status','Complete')
        					->get();
        return view('UserPanel.Reports.PODReport',['params'=>$params]);
    }
    function POD_Report()
    {
    	return Excel::download(new PODReportExport,'PODReport.xlsx');
    }


	public function Daliy()
    {
		$userid = session()->get('UserLogin2id');
    	// Today
		$today = Carbon::now();
		$tdate = $today->toDateString();

        $params = orderdetail::where('order_userid',$userid)
        					->where('order_delivery_date',$tdate)
        					->get();
        return view('UserPanel.Reports.DailyReport',['params'=>$params]);
    }
    function Daliy_Report()
    {
    	return Excel::download(new DailyReportExport,'DailyReport.xlsx');
    }

// NDR Report
	public function NDR(){
		$userid = session()->get('UserLogin2id');
    	$tdate0 = date('Y-m-d');
    	$tdate1 = date('Y-m-d',strtotime("-1 days"));
    	$tdate2 = date('Y-m-d',strtotime("-2 days"));
    	$tdate3 = date('Y-m-d',strtotime("-3 days"));
    	$tdate4 = date('Y-m-d',strtotime("-4 days"));
    
    	$days0 = NDRorders::where('user_id',$userid)->where('uploaddate',$tdate0)->get('uploadtime');
    	$days1 = NDRorders::where('user_id',$userid)->where('uploaddate',$tdate1)->get('uploadtime');
    	$days2 = NDRorders::where('user_id',$userid)->where('uploaddate',$tdate2)->get('uploadtime');
    	$days3 = NDRorders::where('user_id',$userid)->where('uploaddate',$tdate3)->get('uploadtime');
    	$days4 = NDRorders::where('user_id',$userid)->where('uploaddate',$tdate4)->get('uploadtime');
        return view('UserPanel.Reports.NDRReport',['days0'=>$days0,'tdate0'=>$tdate0,'days1'=>$days1,'tdate1'=>$tdate1,'days2'=>$days2,'tdate2'=>$tdate2,'days3'=>$days3,'tdate3'=>$tdate3,'days4'=>$days4,'tdate4'=>$tdate4]);
    }
    function NDR_Report(){
    	return Excel::download(new NDRReportExport,'NDRReport.xls');
    }
// NDR Report


// Manifest
    public function Manifest(){
        $userid = session()->get('UserLogin2id');
		$tdate0 = date('Y-m-d');
		$tdate1 = date('Y-m-d',strtotime("-1 days"));
		$tdate2 = date('Y-m-d',strtotime("-2 days"));
		$tdate3 = date('Y-m-d',strtotime("-3 days"));
		$tdate4 = date('Y-m-d',strtotime("-4 days"));

		$days0 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate0)->get('uploadtime');
		$days1 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate1)->get('uploadtime');
		$days2 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate2)->get('uploadtime');
		$days3 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate3)->get('uploadtime');
		$days4 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate4)->get('uploadtime');
        return view('UserPanel.Reports.ManifestReport',['days0'=>$days0,'tdate0'=>$tdate0,'days1'=>$days1,'tdate1'=>$tdate1,'days2'=>$days2,'tdate2'=>$tdate2,'days3'=>$days3,'tdate3'=>$tdate3,'days4'=>$days4,'tdate4'=>$tdate4]);
    }


    function Manifest_Report(Request $req,$id,$no){
    	$date = $req->id;
    	$time = $req->no;
        return Excel::download(new NDRReportExport($date,$time),'Manifest-Report.xls');
	}
	
	function Manifest_ReportD(){
			return Excel::download(new NDRReportExportD,'delivered_report.xlsx');
	}
	function Manifest_ReportD1(){
			return Excel::download(new NDRReportExportD1,'delivered_report1.xlsx');
	}
	function Manifest_ReportD2(){
			return Excel::download(new NDRReportExportD2,'delivered_report2.xlsx');
	}
	function Manifest_ReportD3(){
			return Excel::download(new NDRReportExportD3,'delivered_report3.xlsx');
	}
	function Manifest_ReportD4(){
			return Excel::download(new NDRReportExportD4,'delivered_report4.xlsx');
	}

	function Manifest_ReportN(Request $req,$id,$no){
		$date = $req->id;
		$time = $req->no;
		return Excel::download(new NDRReportExportN($date,$time),'Non-Delivery_report.xls');
	}

    public function Manifest_Report_PDF()
    {
        // Today
        $userid = session()->get('UserLogin2id');
        // $params = Manifest::where('order_userid',$userid)
        //                     ->where('order_status','Cancel')
        //                     ->get();
        $couriers = CourierNames::all();
        $params = orderdetail::all();
        return view('UserPanel.Reports.Manifest_PDF_Report',['params'=>$params,'couriers'=>$couriers]);
    }
// Manifest





// MIS
    public function MIS(){
        $userid = session()->get('UserLogin2id');
		$tdate0 = date('Y-m-d');
		$tdate1 = date('Y-m-d',strtotime("-1 days"));
		$tdate2 = date('Y-m-d',strtotime("-2 days"));
		$tdate3 = date('Y-m-d',strtotime("-3 days"));
		$tdate4 = date('Y-m-d',strtotime("-4 days"));

		$days0 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate0)->get('uploadtime');
		$days1 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate1)->get('uploadtime');
		$days2 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate2)->get('uploadtime');
		$days3 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate3)->get('uploadtime');
		$days4 = Manifestorders::where('user_id',$userid)->where('uploaddate',$tdate4)->get('uploadtime');
        return view('UserPanel.Reports.MISReport',['days0'=>$days0,'tdate0'=>$tdate0,'days1'=>$days1,'tdate1'=>$tdate1,'days2'=>$days2,'tdate2'=>$tdate2,'days3'=>$days3,'tdate3'=>$tdate3,'days4'=>$days4,'tdate4'=>$tdate4]);
    }


    function MIS_Report(Request $req,$id,$no){
    	$date = $req->id;
    	$time = $req->no;
        return Excel::download(new MISReportExport($date,$time),'Manifest_MIS-Report.xls');
	}
	
	function MIS_ReportD(){
			return Excel::download(new MISReportExportD,'delivered_report.xlsx');
	}
	function MIS_ReportD1(){
			return Excel::download(new MISReportExportD1,'delivered_report1.xlsx');
	}
	function MIS_ReportD2(){
			return Excel::download(new MISReportExportD2,'delivered_report2.xlsx');
	}
	function MIS_ReportD3(){
			return Excel::download(new MISReportExportD3,'delivered_report3.xlsx');
	}
	function MIS_ReportD4(){
			return Excel::download(new MISReportExportD4,'delivered_report4.xlsx');
	}

	function MIS_ReportN(Request $req){
		$date = $req->fromdate;
		$time = $req->todate;
        $pickupdate = $req->pickupdate;
        $pickupaddress = $req->pickupaddress;
        $pickuppincode = $req->pickuppincode;
        $pickupcity = $req->pickupcity;
        $pickupstate = $req->pickupstate;
        $pickupphone = $req->pickupphone;
        $firstattampt = $req->firstattampt;
        $secondattempt = $req->secondattempt;
        $thirdattempt = $req->thirdattempt;
        $lastattampt = $req->lastattampt;
        $truearoundtime = $req->truearoundtime;
        $receivedbypod = $req->receivedbypod;
		
		return Excel::download(new MISReportExportN($date,$time,$pickupdate,$pickupaddress,$pickuppincode,$pickupcity,$pickupstate,$pickupphone,$firstattampt,$secondattempt,$thirdattempt,$lastattampt,$truearoundtime,$receivedbypod),'MIS_report.xls');
	}

    public function MIS_Report_PDF()
    {
        // Today
        $userid = session()->get('UserLogin2id');
        // $params = Manifest::where('order_userid',$userid)
        //                     ->where('order_status','Cancel')
        //                     ->get();
        $couriers = CourierNames::all();
        $params = orderdetail::all();
        return view('UserPanel.Reports.MIS_PDF_Report',['params'=>$params,'couriers'=>$couriers]);
    }
// MIS


// Order Summary
    function Not_Picked_Excel_Orders(){
        return Excel::download(new NotPickedOrders(),'Not-Picked-Orders.xls');
    }
// Order Summary

// Failed & Placed Orders
    // function Failed_Orders_Report(Request $req,$ftype){
    //     $tdate0 = date('Y-m-d');
    //     $fileuplaodtype = $req->ftype;
    //     return Excel::download(new FailedOrdersExport($tdate0,$fileuplaodtype),'Failed-orders.xls');
    // }
    function Failed_Orders_Report(Request $req){
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new FailedOrdersExport($tdate,$tdate1,$fileuplaodtype),'Failed-orders.xls');
    }

    function Placed_Orders_Report(Request $req){
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new PlacedOrdersExport($tdate,$tdate1,$fileuplaodtype),'Upload-orders.xls');
    }
      function Pickup_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new PickupOrdersExport($tdate, $tdate1, $fileuplaodtype), 'pickup-orders.xls');
    }
    function intransit_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new intransitOrdersExport($tdate, $tdate1, $fileuplaodtype), 'intransit-orders.xls');
    }
    function ofd_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new ofdOrdersExport($tdate, $tdate1, $fileuplaodtype), 'ofd-orders.xls');
    }
    function rto_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new rtoOrdersExport($tdate, $tdate1, $fileuplaodtype), 'rto-orders.xls');
    }
    function delivered_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new deliveredOrdersExport($tdate, $tdate1, $fileuplaodtype), 'Delivered-orders.xls');
    }
    function cancel_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new cancelOrdersExport($tdate, $tdate1, $fileuplaodtype), 'cancel-orders.xls');
    }
// Failed & Placed Orders
}





class NotPickedOrders implements WithHeadings,FromCollection{
 use Exportable;
    public function collection(){
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $products = bulkorders::select('Order_Type','orderno','Awb_Number','Name','Address','State','City','Mobile','Pincode','Item_Name','Quantity','Width','Height','Length','Actual_Weight','volumetric_weight','Total_Amount','Cod_Amount','Rec_Time_Date','uploadtype','order_status_show','pickup_id','pickup_name','pickup_mobile','pickup_pincode','pickup_gstin','pickup_address','pickup_state','pickup_city')
                                ->where('User_Id',$userid)
                                ->where('order_status_show','!=','Delivered')
                                ->where('order_status_show','!=','RTO Delivered')
                                ->where('order_status_show','!=','Upload')
                                ->where('Awb_Number','!=','')
                                ->where('order_cancel','!=','1')
                                ->get();
        foreach ($products as $key => $product){
            $products[$key]->pickup_id = "HID00".$product->pickup_id;
        }

        return $products;
    }

    public function headings(): array{

        return['OrderType','OrderNo','AWBNumber','Name','Address','State','City','Mobile','Pincode','ProductName','Quantity','Width(cm)','Height(cm)','Length(cm)','ActualWeight(kg)','VolumetricWeight(Kg)','Amount','COD','Upload','Type','Status','HUB','PickupName','PickupMobile','PickupPincode','PickupGSTIN','PickupAddress','PickupState','PickupCity'];

    }
}





class ProgressOrders implements WithHeadings,FromCollection{
 use Exportable;
    public function collection(){
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $products = bulkorders::select('Order_Type','orderno','Awb_Number','Name','Address','State','City','Mobile','Pincode','Item_Name','Quantity','Width','Height','Length','Actual_Weight','volumetric_weight','Total_Amount','Cod_Amount','Rec_Time_Date','uploadtype','order_status_show','pickup_id','pickup_name','pickup_mobile','pickup_pincode','pickup_gstin','pickup_address','pickup_state','pickup_city')
                                ->where('User_Id',$userid)
                                ->where('order_status_show','!=','Delivered')
                                ->where('order_status_show','!=','RTO Delivered')
                                ->where('order_status_show','!=','Upload')
                                ->where('Awb_Number','!=','')
                                ->where('order_cancel','!=','1')
                                ->get();
        foreach ($products as $key => $product){
            $products[$key]->pickup_id = "HID00".$product->pickup_id;
        }

        return $products;
    }

    public function headings(): array{

        return['OrderType','OrderNo','AWBNumber','Name','Address','State','City','Mobile','Pincode','ProductName','Quantity','Width(cm)','Height(cm)','Length(cm)','ActualWeight(kg)','VolumetricWeight(Kg)','Amount','COD','Upload','Type','Status','HUB','PickupName','PickupMobile','PickupPincode','PickupGSTIN','PickupAddress','PickupState','PickupCity'];

    }
}











// class FailedOrdersExport implements WithHeadings,FromCollection{
//  use Exportable;
//     public function __construct($date,$uplaodtypeare){
//         $this->date = $date;
//         $this->ftype = $uplaodtypeare;
//     }
//     public function collection(){
//         $fetchdata = $this->date;
//         $ftypedata = $this->ftype;
//         $userid = session()->get('UserLogin2id');
//         $today = Carbon::now();
//         $tdate = $today->toDateString();

//         $products = bulkorders::select('Order_Type','orderno','Awb_Number','awb_gen_courier','Name','Address','State','City','Mobile','Pincode','Item_Name','Quantity','Width','Height','Length','Actual_Weight','volumetric_weight','Total_Amount','Invoice_Value','Cod_Amount','Rec_Time_Date','uploadtype','pickup_id','order_status_show','showerrors')
//                                 ->where('Rec_Time_Date',$fetchdata)
//                                 ->where('user_id',$userid)
//                                 ->where('Awb_Number','')
//                                 ->where('apihitornot','1')
//                                 ->where('uploadtype',$ftypedata)
//                                 ->get();
//         foreach ($products as $key => $product){
//                 $products[$key]->pickup_id = "HID00".$product->pickup_id;
//         }
//         return $products;

//     }

//     public function headings(): array{

//         return['Order_Type','Orderno','AWB_Number','Courier','Receiver_Name','Receiver_Address','Receiver_State','Receiver_City','Receiver_Mobile','Receiver_Pincode','Item_Name','Quantity','Width','Height','Length','Actual_Weight','Volumetric_Weight','Total_Amount','Invoice_Value','Cod_Amount','Upload_Date','Upload_Type','HUB_ID','Status','Remark'];

//     }
// }

class FailedOrdersExport implements WithHeadings,FromCollection{
 use Exportable;
     public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('apihitornot', '1')
             ->where('Awb_Number','')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class PlacedOrdersExport implements WithHeadings,FromCollection{
 use Exportable;
     public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno','ordernoapi', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('apihitornot', '1')
            ->where('order_cancel', '!=', '1')
            // ->where('Awb_Number', '!=', '')
            //  ->where('Awb_Number','')
            // ->where('Last_Time_Stamp','2024-06-15 12:18:36')
            //  ->where('awb_gen_by','Ecom')
            // ->where('uploadtype', $ftypedata) 
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno','shipnick_id', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class PickupOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup','AWB Assigned','Pickup Error' ,'Pickup Rescheduled'  ,'Out For Pickup' ,'Pickup Exception' , 'Pickup Booked' , 'Shipment Booked','Pickup Generated']) 
            ->where('apihitornot', '1')
            ->where('order_cancel','!=','1')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class intransitOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['In-Transit', 'in transit','Connected', 'intranit','Ready for Connection' ,'Shipped','In Transit' ,'Delayed' ,'Partial_Delivered' ,'REACHED AT DESTINATION HUB' ,'MISROUTED' ,'PICKED UP' ,'Reached Warehouse' , 'Custom Cleared' , 'In Flight' ,	'Shipment Booked'])
            
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class ofdOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class rtoOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstartObj = Carbon::createFromFormat('d-m-Y', "1-$crtmonth-$crtyear")->startOfMonth();
$currentmonthstendObj = Carbon::createFromFormat('d-m-Y', "$crtmdays-$crtmonth-$crtyear")->endOfMonth();



        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            // ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->whereBetween('Last_Time_Stamp', [$currentmonthstartObj, $currentmonthstendObj])
            ->whereIn('showerrors', ['exception', 'Shipment Redirected','rto', 'Undelivered'])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class deliveredOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class cancelOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('order_cancel',1)
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}









class PODReportExport implements WithHeadings,FromCollection
{
    public function collection()
    {
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = orderdetail::where('order_userid',$userid)
							->where('order_status','Complete')
                            ->where('user_id',$userid)
							->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name')
							->get();

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








class DailyReportExport implements WithHeadings,FromCollection
{
    public function collection()
    {
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = orderdetail::where('order_userid',$userid)->where('order_status','Complete')->where('user_id',$userid)->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name')->get();

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






class NDRReportExport implements WithHeadings,FromCollection{
 use Exportable;
    public function __construct($date,$time){
        $this->date = $date;
        $this->time = $time;
    }
    public function collection(){
    	$fetchdata = $this->date;
        $fetchtime = $this->time;
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();

		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$fetchdata)
                                ->where('uploadtime',$fetchtime)
                                ->where('user_id',$userid)
                                ->get();
		return $products;
    }

    public function headings(): array{

		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];

	}
}






class NDRReportExportD implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExportD1 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-1 days"));
		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExportD2 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-2 days"));
		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExportD3 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-3 days"));
		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExportD4 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-4 days"));
		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}





class NDRReportExportN implements WithHeadings,FromCollection{
 use Exportable;
    public function __construct($date,$time){
        $this->date = $date;
        $this->time = $time;
    }
        public function collection(){
        $fetchdata = $this->date;
        $fetchtime = $this->time;
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = NDRorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$fetchdata)
                                ->where('uploadtime',$fetchtime)
                                ->where('user_id',$userid)
                                // ->where('orderstatus','RTO Delivered')
                                ->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}













































class MISReportExport implements WithHeadings,FromCollection{
 use Exportable;
    public function __construct($date,$time){
        $this->date = $date;
        $this->time = $time;
    }
    public function collection(){
    	$fetchdata = $this->date;
        $fetchtime = $this->time;
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();

		$products = Manifestorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
                                ->where('uploaddate',$fetchdata)
                                ->where('uploadtime',$fetchtime)
                                ->where('user_id',$userid)
                                ->get();
		return $products;
    }

    public function headings(): array{

		return['awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername'];

	}
}






class MISReportExportD implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = Manifestorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername'];
	}
}
class MISReportExportD1 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-1 days"));
		$products = Manifestorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername'];
	}
}
class MISReportExportD2 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-2 days"));
		$products = Manifestorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername'];
	}
}
class MISReportExportD3 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-3 days"));
		$products = Manifestorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername'];
	}
}
class MISReportExportD4 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
			$tdate = date('Y-m-d',strtotime("-4 days"));
		$products = Manifestorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
                                ->where('uploaddate',$tdate)->where('user_id',$userid)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername'];
	}
}



class MISReportExportN implements WithHeadings,FromCollection{
 use Exportable;
    public function __construct($date,$time,$pickupdate,$pickupaddress,$pickuppincode,$pickupcity,$pickupstate,$pickupphone,$firstattampt,$secondattempt,$thirdattempt,$lastattampt,$truearoundtime,$receivedbypod){
        $this->date = $date;
        $this->time = $time;
        $this->pickupdate = $pickupdate;
        $this->pickupaddress = $pickupaddress;
        $this->pickuppincode = $pickuppincode;
        $this->pickupcity = $pickupcity;
        $this->pickupstate = $pickupstate;
        $this->pickupphone = $pickupphone;
        $this->firstattampt = $firstattampt;
        $this->secondattempt = $secondattempt;
        $this->thirdattempt = $thirdattempt;
        $this->lastattampt = $lastattampt;
        $this->truearoundtime = $truearoundtime;
        $this->receivedbypod = $receivedbypod;
    }
    public function collection(){
        $fetchdata = $this->date;
        $fetchtime = $this->time;
    	$userid = session()->get('UserLogin2id');

        
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		// $products = NDRorders::select('awbno','orderno','origincity','originpincode','destinationcity','destinationpincode','paymentmode','couriername')
        //                         ->where('uploaddate',$fetchdata)
        //                         // ->where('uploadtime',$fetchtime)
        //                         ->where('user_id',$userid)
        //                         // ->where('orderstatus','RTO Delivered')
        //                         ->get();
		// return $products;  MIS_Report
        $products = bulkorders::join('mis_report', 'mis_report.awb_number', '=', 'spark_single_order.Awb_Number')
        ->whereBetween('spark_single_order.Rec_Time_Date', [$fetchdata, $fetchtime])
        ->where('spark_single_order.showerrors', 'RTO Delivered')
        ->where('spark_single_order.user_id', $userid)
        ->select('spark_single_order.Awb_Number', 'spark_single_order.orderno', 'spark_single_order.Rec_Time_Date', 'spark_single_order.Name', 'spark_single_order.Address', 'spark_single_order.City', 'spark_single_order.State', 'spark_single_order.Pincode', 'spark_single_order.Order_Type', 'spark_single_order.Cod_Amount', 'spark_single_order.Width', 'spark_single_order.Height', 'spark_single_order.Length', 'spark_single_order.Actual_Weight', 'spark_single_order.volumetric_weight', 'mis_report.current_status', 'mis_report.last_scanned_at', 'mis_report.last_location', 'mis_report.last_scan_remark', 'mis_report.delivery_attempts', 'spark_single_order.awb_gen_courier', 'spark_single_order.pickup_name', 'spark_single_order.Rec_Time_Date as pickup_date', 'spark_single_order.pickup_address', 'spark_single_order.pickup_pincode', 'spark_single_order.pickup_city', 'spark_single_order.pickup_state', 'spark_single_order.pickup_mobile', 'mis_report.last_attempt_date', 'mis_report.turn_around_time')
        ->get();
    
    // Assuming you want to fetch 'Rec_Time_Date' as 'pickup_date' in the select statement
    
       
    }
    public function headings(): array{
        $fetchtime = $this->time;
        $pickupdate = $this->pickupdate;
        $pickupaddress = $this->pickupaddress;
        $pickuppincode = $this->pickuppincode;
        $pickupcity = $this->pickupcity;
        $pickupstate = $this->pickupstate;
        $pickupphone = $this->pickupphone;
        $firstattampt = $this->firstattampt;
        $secondattempt = $this->secondattempt;
        $thirdattempt = $this->thirdattempt;
        $lastattampt = $this->lastattampt;
        $truearoundtime = $this->truearoundtime;
        $receivedbypod = $this->receivedbypod;

        $headings = ['Awb_Number', 'orderno', 'Rec_Time_Date', 'Name', 'Address', 'City', 'State', 'Pincode', 'Order_Type', 'Cod_Amount',
            'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'current_status', 'last_scanned_at', 'last_location',
            'last_scan_remark', 'delivery_attempts', 'awb_gen_courier', 'pickupdate', 'pickupaddress', 'pickuppincode', 'pickupcity',
            'pickupstate', 'pickupphone', 'firstattampt', 'secondattempt', 'thirdattempt', 'lastattampt', 'truearoundtime', 'receivedbypod'];
		return $headings;
	}
}
