<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Manifest;
use App\Models\Manifestorders;
use App\Models\RemmitanceDetails;
use App\Models\NDRorders;
use App\Models\Allusers;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class AdminMIS extends Controller
{
  public function Home()
  {
    $tdate0 = date('Y-m-d');
    $tdate1 = date('Y-m-d', strtotime("-1 days"));
    $tdate2 = date('Y-m-d', strtotime("-2 days"));
    $tdate3 = date('Y-m-d', strtotime("-3 days"));
    $tdate4 = date('Y-m-d', strtotime("-4 days"));

    $days0 = Manifestorders::where('uploaddate', $tdate0)->get('uploadtime');
    $days1 = Manifestorders::where('uploaddate', $tdate1)->get('uploadtime');
    $days2 = Manifestorders::where('uploaddate', $tdate2)->get('uploadtime');
    $days3 = Manifestorders::where('uploaddate', $tdate3)->get('uploadtime');
    $days4 = Manifestorders::where('uploaddate', $tdate4)->get('uploadtime');
    return view('Admin.MIS.MISReport', ['days0' => $days0, 'tdate0' => $tdate0, 'days1' => $days1, 'tdate1' => $tdate1, 'days2' => $days2, 'tdate2' => $tdate2, 'days3' => $days3, 'tdate3' => $tdate3, 'days4' => $days4, 'tdate4' => $tdate4]);
  }
  public function remittance_9(){
    return view('Admin.MIS.remittance');
  }



  public function Add(Request $req)
  {
    error_reporting(1);
    //  File Name
    $status = "0";
    $bulkfilename = date('Y-m-d');
    if (!file_exists("MISExcelFiles/$bulkfilename")) {
      mkdir("MISExcelFiles/$bulkfilename");
    }
    $imgfile = $req->file('bulkorderfile');
    if (is_null($imgfile)) {
      // $query->billimg = "";
      // echo "1";
      $req->session()->flash('status', 'MIS Not Uploaded');
      return redirect('/AMIS_Report');
    } else {
      $fileextention = $imgfile->getClientOriginalExtension();
      $fa = date('dmy');
      $fb = "0";
      $fc = "_";
      $randno1 = rand(1, 499);
      $randno2 = rand(500, 999);
      $img = $fa . $fb . $fc . $randno1 . $randno2 . "." . $fileextention;
      // $img = $imgfile->getClientOriginalName();
      $imgfile->move("MISExcelFiles/$bulkfilename/", $img);
      // echo "2";
      // $query->billimg = $img;

      // Read File
      $fileD = fopen("MISExcelFiles/$bulkfilename/$img", "r");
      // $fileD = fopen('sample.csv',"r");
      $column = fgetcsv($fileD);
      while (!feof($fileD)) {
        $rowData[] = fgetcsv($fileD);
      }

      foreach ($rowData as $key => $value) {
        if ($value[1] == "") {
          continue;
        }

        $awbexittornot = bulkorders::where('Awb_Number', $value[0])->count('Single_Order_Id');
        if ($awbexittornot == 0) {
          $status = '2';
          $awbnonot = $value[0];
          break;
        } else {
          $useridisa = bulkorders::where('Awb_Number', $value[0])->first();
          $user_idare = $useridisa['User_Id'];
          // echo "<pre>";
          // print_r($useridisa);
          $status = '1';
        }
        // exit();




        $querycad = new Manifestorders;
        $querycad->user_id = $user_idare;
        $querycad->awbno = $value[0];
        $querycad->orderno = $value[1];
        $querycad->orderstatus = $value[4];
        $querycad->courierremark = $value[5];

        if (!empty($value[3])) {
          $dated = substr($value[3], 0, 2);
          $datem = substr($value[3], 3, 2);
          $datey = substr($value[3], 6, 4);
          $value[3] = $datey . "-" . $datem . "-" . $dated;
          $querycad->pickupdate = $value[3];
        }
        if (!empty($value[6])) {
          $dated = substr($value[6], 0, 2);
          $datem = substr($value[6], 3, 2);
          $datey = substr($value[6], 6, 4);
          $value[6] = $datey . "-" . $datem . "-" . $dated;
          $querycad->laststatusdate = $value[6];
        }
        if (!empty($value[7])) {
          $dated = substr($value[7], 0, 2);
          $datem = substr($value[7], 3, 2);
          $datey = substr($value[7], 6, 4);
          $value[7] = $datey . "-" . $datem . "-" . $dated;
          $querycad->deliverydate = $value[7];
        }
        if (!empty($value[8])) {
          $dated = substr($value[8], 0, 2);
          $datem = substr($value[8], 3, 2);
          $datey = substr($value[8], 6, 4);
          $value[8] = $datey1 . "-" . $datem1 . "-" . $dated1;
          $querycad->firstscandate = $value[8];
        }
        if (!empty($value[9])) {
          $dated = substr($value[9], 0, 2);
          $datem = substr($value[9], 3, 2);
          $datey = substr($value[9], 6, 4);
          $value[9] = $datey . "-" . $datem . "-" . $dated;
          $querycad->firstattemptdate = $value[9];
        }
        if (!empty($value[10])) {
          $dated = substr($value[10], 0, 2);
          $datem = substr($value[10], 3, 2);
          $datey = substr($value[10], 6, 4);
          $value[10] = $datey . "-" . $datem . "-" . $dated;
          $querycad->edd = $value[10];
        }
        if (!empty($value[23])) {
          $dated = substr($value[23], 0, 2);
          $datem = substr($value[23], 3, 2);
          $datey = substr($value[23], 6, 4);
          $value[23] = $datey . "-" . $datem . "-" . $dated;
          $querycad->rtodate = $value[23];
        }
        if (!empty($value[27])) {
          $dated = substr($value[27], 0, 2);
          $datem = substr($value[27], 3, 2);
          $datey = substr($value[27], 6, 4);
          $value[27] = $datey . "-" . $datem . "-" . $dated;
          $querycad->lastofddate = $value[27];
        }
        if (!empty($value[9])) {
          $dated = substr($value[9], 8, 2);
          $datem = substr($value[9], 5, 2);
          $datey = substr($value[9], 0, 4);
          $value[9] = $datey . "-" . $datem . "-" . $dated;
          $querycad->firstscandate = $value[9];
        }

        $querycad->origincity = $value[11];
        $querycad->originpincode = $value[12];
        $querycad->destinationcity = $value[13];
        $querycad->destinationpincode = $value[14];
        $querycad->customername = $value[15];
        $querycad->customercontact = $value[16];
        $querycad->clientname = $value[17];
        $querycad->paymentmode = $value[18];
        $querycad->codamt = $value[19];
        $querycad->orderageing = $value[20];
        $querycad->attemptcount = $value[21];
        $querycad->couriername = $value[22];

        $querycad->rtoreason = $value[24];
        $querycad->zonename = $value[25];

        $querycad->uploadtimestamp = now();
        $querycad->uploaddate = now();
        $querycad->uploadtime = now();
        $querycad->save();

        // $querycadlast_id = $querycad->id;

      }
    }

    if ($status == "2") {
      $req->session()->flash('status', "Error Encountered Awb no : $awbnonot");
    } elseif ($status == "1") {
      $req->session()->flash('status', 'MIS Upload Successfully');
    } else {
      $req->session()->flash('status', 'No Data Found');
    }
    return redirect('/AMIS_Report');
  }


  public function Manifest_Report(Request $req, $id, $no)
  {
    $date = $req->id;
    $time = $req->no;
    return Excel::download(new NDRReportExport($date, $time), 'manifest_report.xls');
  }
}





class NDRReportExport implements WithHeadings, FromCollection
{
  use Exportable;
  public function __construct($date, $time)
  {
    $this->date = $date;
    $this->time = $time;
  }
  public function collection()
  {
    $fetchdata = $this->date;
    $fetchtime = $this->time;
    $userid = session()->get('UserLogin2id');
    $today = Carbon::now();
    $tdate = $today->toDateString();

    $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
      ->where('uploaddate', $fetchdata)
      ->where('uploadtime', $fetchtime)
      ->get();
    return $products;
  }

  public function headings(): array
  {

    return ['AWB no', 'Order no', 'Pickup date', 'Order status', 'Courier Remark', 'Last status date', 'Delivery date', 'First scan date', 'First attempt date', 'Edd', 'Origin City', 'Origin pincode', 'Destination city', 'Destination pincode', 'Customer name', 'Customer contact', 'Client name', 'Payment mode', 'Cod amt', 'Order ageing', 'Attempt count', 'Courier name', 'Rto date'];
  }
}
