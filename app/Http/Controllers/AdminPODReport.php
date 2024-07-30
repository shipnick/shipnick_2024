<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Manifest;
use App\Models\Manifestorders;
use App\Models\NDRorders;
use App\Models\Allusers;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class AdminPODReport extends Controller
{

    public function PODReturn(){
        $tdate0 = date('Y-m-d');
        $tdate1 = date('Y-m-d',strtotime("-1 days"));
        $tdate2 = date('Y-m-d',strtotime("-2 days"));
        $tdate3 = date('Y-m-d',strtotime("-3 days"));
        $tdate4 = date('Y-m-d',strtotime("-4 days"));
        
        $days0 = NDRorders::where('uploaddate',$tdate0)->get('uploadtime');
        $days1 = NDRorders::where('uploaddate',$tdate1)->get('uploadtime');
        $days2 = NDRorders::where('uploaddate',$tdate2)->get('uploadtime');
        $days3 = NDRorders::where('uploaddate',$tdate3)->get('uploadtime');
        $days4 = NDRorders::where('uploaddate',$tdate4)->get('uploadtime');
        return view('Admin.PODReport.ReturnPOD',['days0'=>$days0,'tdate0'=>$tdate0,'days1'=>$days1,'tdate1'=>$tdate1,'days2'=>$days2,'tdate2'=>$tdate2,'days3'=>$days3,'tdate3'=>$tdate3,'days4'=>$days4,'tdate4'=>$tdate4]);
    }

    public function Add(Request $req){
        error_reporting(1);
        //  File Name
        $status = "0";
        $bulkfilename = date('Y-m-d');
        if(!file_exists("MISExcelFiles/$bulkfilename")){
            mkdir("MISExcelFiles/$bulkfilename");   }
            $imgfile = $req->file('bulkorderfile');
            if(is_null($imgfile)){
            
                $req->session()->flash('status','MIS Not Uploaded');
                return redirect('/AMIS_Report');
            } else {
                $fileextention = $imgfile->getClientOriginalExtension();
                $fa = date('dmy');
                $fb = "0";
                $fc = "_";
                $randno1 = rand(1,499);
                $randno2 = rand(500,999);
                $img = $fa.$fb.$fc.$randno1.$randno2.".".$fileextention;
                // $img = $imgfile->getClientOriginalName();
                $imgfile->move("MISExcelFiles/$bulkfilename/",$img);
            
                // Read File
                $fileD = fopen("MISExcelFiles/$bulkfilename/$img","r");
                $column=fgetcsv($fileD);
                while(!feof($fileD)){
                    $rowData[]=fgetcsv($fileD);
                }
            
            $line_no=1;
            foreach($rowData as $key => $value){
                $line_no++;
                $awbno = trim($value[0]," ");
                $orderno = trim($value[1]," ");
                
                
                $order_row = bulkorders::where('Awb_Number',$awbno)->get();
                if(count($order_row)==0){
                    $status = '2';
                    
                    break;
                }
                if($order_row['orderno'] != $orderno){
                    $status = '3';
                    break;
                }
               
          }
          $cnt=0;
          if($status == "0"){
              foreach($rowData as $key => $value){
              
                 $awbno = trim($value[0]);
                 $orderno = trim($value[1]);
                 $orderstatus = trim($value[4]);
                 $courierremark = trim($value[5]);
                 $pickupdate = trim($value[3]);
                 $pickupdate =date('Y-m-d',strtotime($pickupdate));
                 $laststatusdate = trim($value[6]);
                 $laststatusdate =date('Y-m-d',strtotime($laststatusdate));
                 $deliverydate = trim($value[7]);
                 $deliverydate =date('Y-m-d',strtotime($deliverydate));
                 $firstscandate = trim($value[8]);
                 $firstscandate =date('Y-m-d',strtotime($firstscandate));
                 $firstattemptdate = trim($value[9]);
                 $firstattemptdate =date('Y-m-d',strtotime($firstattemptdate));
                 $edd = trim($value[10]);
                 $edd =date('Y-m-d',strtotime($edd));
                 $rtodate = trim($value[23]);
                 $rtodate =date('Y-m-d',strtotime($rtodate));
                 $lastofddate = trim($value[27]);
                 $pickupdate =date('Y-m-d',strtotime($lastofddate));
                 $firstscandate = trim($value[9]);
                 $firstscandate =date('Y-m-d',strtotime($firstscandate));
                 $origincity = trim($value[11]);
                 $originpincode = trim($value[12]);
                 $destinationcity = trim($value[13]);
                 $destinationpincode = trim($value[14]);
                 $customername = trim($value[15]);
                 $customercontact = trim($value[16]);
                 $clientname = trim($value[17]);
                 $paymentmode = trim($value[18]);
                 $codamt = trim($value[19]);
                 $orderageing = trim($value[20]);
                 $attemptcount = trim($value[21]);
                 $couriername = trim($value[22]);
                 $rtoreason = trim($value[24]);
                 $zonename = trim($value[25]);

                $useridisa = bulkorders::where('Awb_Number',$awbno)->first();
                $user_idare = $useridisa['User_Id'];
              
                $status = '1';      
    
                $querycad = new NDRorders;
                $querycad->user_id = $user_idare;
                $querycad->awbno = $awbno;
                $querycad->orderno = $orderno;
                $querycad->orderstatus = $orderstatus;
                $querycad->courierremark = $courierremark;
                $querycad->pickupdate = $pickupdate;
                $querycad->laststatusdate = $laststatusdate;
                $querycad->deliverydate = $deliverydate;
                $querycad->firstscandate = $firstscandate;
                $querycad->firstattemptdate = $firstattemptdate;
                $querycad->edd = $edd;
                $querycad->rtodate = $rtodate;
                $querycad->lastofddate = $lastofddate;
                $querycad->origincity = $origincity;
                $querycad->originpincode = $originpincode;
                $querycad->destinationcity = $destinationcity;
                $querycad->destinationpincode = $destinationpincode;
                $querycad->customername = $customername;
                $querycad->customercontact = $customercontact;
                $querycad->clientname = $clientname;
                $querycad->paymentmode = $paymentmode;
                $querycad->codamt = $codamt;
                $querycad->orderageing = $orderageing;
                $querycad->attemptcount = $attemptcount;
                $querycad->couriername = $couriername;
                $querycad->rtoreason = $rtoreason;
                $querycad->zonename = $zonename;
                $querycad->uploadtimestamp = now();
                $querycad->uploaddate = now();
                $querycad->uploadtime = now();
                $saved = $querycad->save();
                
                if($saved){
                    $cnt++;
                }
                
              }
          }
          

        }
        
        if($status=="3"){
            $req->session()->flash('status',"Line No $line_no error encountered awb no and order number mismatch:");
        }elseif($status=="2"){
            $req->session()->flash('status',"Error encountered awb no.");
        }elseif($status=="1"){
            $req->session()->flash('status','NDR report successfully uploaded');
            $req->session()->flash('status_msg',"NDR report successfully uploaded $cnt records.");
        }else{
            $req->session()->flash('status','No data found');
        }
        return redirect('/AReturn_POD_Report');  
        
          
    }
    

    public function PODComplete()
    {
        $params = orderdetail::where('order_status','Complete')->get();
        return view('Admin.PODReport.CompletePOD',['params'=>$params]);
    }

    function PODReturnReport()
    {
    	$xyz = 2;
    	return Excel::download(new PODReportExport($xyz),'PODReturn.xlsx');
    }

    function PODCompleteReport()
    {
    	return Excel::download(new PODCompleteExport,'PODComplete.xlsx');
    }



    public function Manifest_Report(){
        return Excel::download(new NDRReportExport,'delivered_report.xlsx');
    }

    public function Manifest_Report1(){
        return Excel::download(new NDRReportExport1,'delivered_report1.xlsx');
    }

    public function Manifest_Report2(){
        return Excel::download(new NDRReportExport2,'delivered_report2.xlsx');
    }

    public function Manifest_Report3(){
        return Excel::download(new NDRReportExport3,'delivered_report3.xlsx');
    }

    public function Manifest_Report4(){
        return Excel::download(new NDRReportExport4,'delivered_report4.xlsx');
    }


    public function Manifest_ReportN(Request $req,$id,$no){
        $date = $req->id;
        $time = $req->no;
        return Excel::download(new NDRReportExportN($date,$time),'rto_report.xls');
    }


}

// class PODReportExport implements WithHeadings,FromCollection
// {
// 	use Exportable;

//     public function __construct($riderid)
//     {
//         $this->abc = $riderid;
//     }

//     public function collection()
//     {
//     	$today = Carbon::now();
// 		$tdate = $today->toDateString();
// 		$products = orderdetail::where('order_riderid',$this->abc)
// 								->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name',)->get();

// 		foreach ($products as $key => $product){
// 		     	$catName = Allusers::select('name')->where('id',$product->order_userid)->first();
// 		    	$products[$key]->order_userid = $catName->name;
// 		}
// 		return $products;
//     }

//     public function headings(): array{

// 		return["AWB No",'Order No','Client Name','Client Mobile','Destination Pincode','COD Amount','Upload Date','Current Status','Customer Name','Courier Name'];

// 	}
// }

class PODReportExport implements WithHeadings,FromCollection
{
    public function collection()
    {
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = orderdetail::where('order_status','Cancel')->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name')->get();

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



class PODCompleteExport implements WithHeadings,FromCollection
{
    public function collection()
    {
    	$today = Carbon::now();
		$tdate = $today->toDateString();
		$products = orderdetail::where('order_status','Complete')->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name')->get();

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
    public function collection(){
    	$userid = session()->get('UserLogin2id');
    	$today = Carbon::now();
		  $tdate = $today->toDateString();
		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExport1 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
		  $tdate = date('Y-m-d',strtotime("-1 days"));

		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExport2 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
		  $tdate = date('Y-m-d',strtotime("-2 days"));

		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExport3 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
		  $tdate = date('Y-m-d',strtotime("-3 days"));

		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('orderstatus','Delivered')->get();
		return $products;
    }
    public function headings(): array{
		return['awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate'];
	}
}
class NDRReportExport4 implements WithHeadings,FromCollection{
    public function collection(){
    	$userid = session()->get('UserLogin2id');
		  $tdate = date('Y-m-d',strtotime("-4 days"));

		$products = Manifestorders::select('awbno','orderno','pickupdate','orderstatus','courierremark','laststatusdate','deliverydate','firstscandate','firstattemptdate','edd','origincity','originpincode','destinationcity','destinationpincode','customername','customercontact','clientname','paymentmode','codamt','orderageing','attemptcount','couriername','rtodate')
                                ->where('uploaddate',$tdate)->where('orderstatus','Delivered')->get();
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
                                // ->where('orderstatus','RTO Delivered')
                                ->get();
		return $products;
    }
    public function headings(): array{
		return['Awbno','Orderno','Pickupdate','Orderstatus','Courierremark','Laststatusdate','Deliverydate','Firstscandate','Firstattemptdate','Edd','Origincity','Originpincode','Destinationcity','Destinationpincode','Customername','Customercontact','Clientname','Paymentmode','Codamt','Orderageing','Attemptcount','Couriername','Rtodate'];
	}
}