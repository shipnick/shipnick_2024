<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\orderdetail;
use App\Models\smartship;
use App\Models\Allusers;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;

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
    
    
    
//  Smarship token 
	
    public function smartshiptoken()
    {
        // // Token Generate 
        // $nimbustoken = "";
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://oauth.smartship.in/loginToken.php',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //             "username": "info@shipnick.com",
        //             "password": "c48f3ed0835f9fa74b0f8b62025ccfc8",
        //             "client_id": "ICIFAAXT1E8ILA22TUGZ0ZPPJ97VURWKRRUW6ZAB",
        //             "client_secret": "&^7_BD(5SVLACL64#Y_V^6@H#W8+GVE%51DX2PCHTCD$*QA1OZ",
        //             "grant_type": "password"
        //         }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json'
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $responseic = json_decode($response, true);
        // curl_close($curl);

        // $statuscheck = $responseic['access_token'];
        // $expireintime = $responseic['expires_in'];

        // if ($statuscheck) {
        //     $smartshiptoken = $responseic['access_token'];
        //     $smartshiptoken = trim($smartshiptoken);
        //     smartship::where('id', 1)->update(['token' => $smartshiptoken, 'expire_in' => $expireintime]);
        // } else {
        //     $smartshiptoken = "0";
        // }

                
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'shipnick11@gmail.com',
            'password' => 'Xpress@5200',
        ]);
        
        // $responseData = $response->json();
        
        $responseic = json_decode($response, true); 
        // $xpressbeetoken = $responseic['data'];

         if ($responseic['status'] == 1) {
            $xpressbeetoken = $responseic['data'];
            $smartshiptoken = trim($xpressbeetoken);
            smartship::where('id', 2)->update(['token' => $smartshiptoken, 'expire_in' => '3600']);
        } else {
            $smartshiptoken = "0";
        }

            echo "<pre>";
            print_r($responseic) ;
            echo "<pre>";
            echo $xpressbeetoken;

    }
    
//  Shiprocket Token 
	public function shiprockettoken()
    {
        // Token Generate 
        $nimbustoken = "";
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "email": "sumitgosai777@gmail.com",
            "password": "Shipnick@2023"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        $responseic = json_decode($response, true);
        curl_close($curl);

        $statuscheck = $responseic['token'];
        $expireintime = 3600;

        if ($statuscheck) {
            $smartshiptoken = $responseic['token'];
            $smartshiptoken = trim($smartshiptoken);
            smartship::where('id', 2)->update(['token' => $smartshiptoken, 'expire_in' => $expireintime]);
        } else {
            $smartshiptoken = "0";
        }

        echo "<br>";
        echo $smartshiptoken;
        echo "<br>";
    }


// Class End
}
// Class End
















class DailyReportExport implements WithHeadings,FromCollection
{
    public function collection()
    {
    	$today = Carbon::now();
		$tdate = $today->toDateString();  
		$products = orderdetail::where('order_delivery_date',$tdate)->select('awb_no','orderno','cname','cmobile','cpin','itmecodamt','orderdata','order_status','order_userid','courier_name')->get();

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

