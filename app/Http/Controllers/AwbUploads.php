<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\EcomAwbs;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class AwbUploads extends Controller
{


// Super-Admin
    public function SuperHome(){
        $ecomtotals_all = EcomAwbs::count('awbuid');
        $ecomtotals_all_usd = EcomAwbs::where('awbstatus','1')->count('awbuid');
        $ecomtotals_all_left = $ecomtotals_all - $ecomtotals_all_usd;

        $ecomtotals_cod = EcomAwbs::where('awbcate','COD')->count('awbuid');
        $ecomtotals_cod_usd = EcomAwbs::where('awbstatus','1')->where('awbcate','COD')->count('awbuid');
        $ecomtotals_cod_left = $ecomtotals_cod - $ecomtotals_cod_usd;

        $ecomtotals_ppd = EcomAwbs::where('awbcate','PPD')->count('awbuid');
        $ecomtotals_ppd_usd = EcomAwbs::where('awbstatus','1')->where('awbcate','PPD')->count('awbuid');
        $ecomtotals_ppd_left = $ecomtotals_ppd - $ecomtotals_ppd_usd;

        return view('super-admin.awb_upload.awbuploads',['ecomtotal'=>$ecomtotals_all,'ecomused'=>$ecomtotals_all_usd,'ecomleft'=>$ecomtotals_all_left,'ecomtotalcod'=>$ecomtotals_cod,'ecomusedcod'=>$ecomtotals_cod_usd,'ecomleftcod'=>$ecomtotals_cod_left,'ecomtotalppd'=>$ecomtotals_ppd,'ecomusedppd'=>$ecomtotals_ppd_usd,'ecomleftppd'=>$ecomtotals_ppd_left]);
    }


    public function SuperAdd(Request $req){
      error_reporting(1);
        //  File Name
      echo $awbcateisa = $req->awbcate;
      $status = "0";
      $bulkfilename = date('Y-m-d');
      if(!file_exists("awbsexcels/ecomexpress/$bulkfilename")){
        mkdir("awbsexcels/ecomexpress/$bulkfilename");   }
        $imgfile = $req->file('bulkorderfile');
        if(is_null($imgfile))
        {
            // $query->billimg = "";
            // echo "1";
            $req->session()->flash('status','Awbs Not Uploaded');
            return redirect('/super-awb-details');
        }else{
            $fileextention = $imgfile->getClientOriginalExtension();
            $fa = date('dmy');
            $fb = "0";
            $fc = "_";
            $randno1 = rand(1,499);
            $randno2 = rand(500,999);
            $img = $fa.$fb.$fc.$randno1.$randno2.".".$fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("awbsexcels/ecomexpress/$bulkfilename/",$img);
            // echo "2";
            // $query->billimg = $img;

        // Read File
            $fileD = fopen("awbsexcels/ecomexpress/$bulkfilename/$img","r");
            // $fileD = fopen('sample.csv',"r");
            $column=fgetcsv($fileD);
            while(!feof($fileD)){
             $rowData[]=fgetcsv($fileD);
            }

            foreach($rowData as $key => $value){
              if($value[0]==""){      continue;       }

              if(strlen($value[0])==10){;
                  $status = '1';
              }else{
                  $status = '2';
                  $awbnonot = $value[0];
                  break;
              }
              // exit();
                $querycad = new EcomAwbs;
                $querycad->awbs = $value[0];
                $querycad->awbcate = $awbcateisa;
                $querycad->save();
          }

        }
        

        if($status=="2"){
            $req->session()->flash('status',"Error Encountered Awb no : $awbnonot");
        }elseif($status=="1"){
            $req->session()->flash('status','Awb Upload Successfully');
        }else{
            $req->session()->flash('status','No Data Found');
        }
        return redirect('/super-awb-details');  
        
          
    }
// Super-Admin

    public function Home(){
        $ecomtotals_all = EcomAwbs::count('awbuid');
        $ecomtotals_all_usd = EcomAwbs::where('awbstatus','1')->count('awbuid');
        $ecomtotals_all_left = $ecomtotals_all - $ecomtotals_all_usd;

        $ecomtotals_cod = EcomAwbs::where('awbcate','COD')->count('awbuid');
        $ecomtotals_cod_usd = EcomAwbs::where('awbstatus','1')->where('awbcate','COD')->count('awbuid');
        $ecomtotals_cod_left = $ecomtotals_cod - $ecomtotals_cod_usd;

        $ecomtotals_ppd = EcomAwbs::where('awbcate','PPD')->count('awbuid');
        $ecomtotals_ppd_usd = EcomAwbs::where('awbstatus','1')->where('awbcate','PPD')->count('awbuid');
        $ecomtotals_ppd_left = $ecomtotals_ppd - $ecomtotals_ppd_usd;

        return view('Admin.awb_upload.awbuploads',['ecomtotal'=>$ecomtotals_all,'ecomused'=>$ecomtotals_all_usd,'ecomleft'=>$ecomtotals_all_left,'ecomtotalcod'=>$ecomtotals_cod,'ecomusedcod'=>$ecomtotals_cod_usd,'ecomleftcod'=>$ecomtotals_cod_left,'ecomtotalppd'=>$ecomtotals_ppd,'ecomusedppd'=>$ecomtotals_ppd_usd,'ecomleftppd'=>$ecomtotals_ppd_left]);
    }

    public function Add(Request $req){
      error_reporting(1);
        //  File Name
      echo $awbcateisa = $req->awbcate;
      $status = "0";
      $bulkfilename = date('Y-m-d');
      if(!file_exists("awbsexcels/ecomexpress/$bulkfilename")){
        mkdir("awbsexcels/ecomexpress/$bulkfilename");   }
        $imgfile = $req->file('bulkorderfile');
        if(is_null($imgfile))
        {
            // $query->billimg = "";
            // echo "1";
            $req->session()->flash('status','Awbs Not Uploaded');
            return redirect('/awb-details');
        }else{
            $fileextention = $imgfile->getClientOriginalExtension();
            $fa = date('dmy');
            $fb = "0";
            $fc = "_";
            $randno1 = rand(1,499);
            $randno2 = rand(500,999);
            $img = $fa.$fb.$fc.$randno1.$randno2.".".$fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("awbsexcels/ecomexpress/$bulkfilename/",$img);
            // echo "2";
            // $query->billimg = $img;

        // Read File
            $fileD = fopen("awbsexcels/ecomexpress/$bulkfilename/$img","r");
            // $fileD = fopen('sample.csv',"r");
            $column=fgetcsv($fileD);
            while(!feof($fileD)){
             $rowData[]=fgetcsv($fileD);
            }
            

// echo "<pre>";
// print_r($rowData);
// exit();


            foreach($rowData as $key => $value){
              if($value[0]==""){      continue;       }

              if(strlen($value[0])==10){;
                  $status = '1';
              }else{
                  $status = '2';
                  $awbnonot = $value[0];
                  break;
              }
              // exit();
                $querycad = new EcomAwbs;
                $querycad->awbs = $value[0];
                $querycad->awbcate = $awbcateisa;
                $querycad->save();
          }

        }
        

        if($status=="2"){
            $req->session()->flash('status',"Error Encountered Awb no : $awbnonot");
        }elseif($status=="1"){
            $req->session()->flash('status','Awb Upload Successfully');
        }else{
            $req->session()->flash('status','No Data Found');
        }
        return redirect('/awb-details');  
        
          
    }

}

