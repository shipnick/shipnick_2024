<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserPincodeManage extends Controller
{
	public function Home()
    {
    	return view('UserPanel.Pincode');
    }

    public function Check(Request $req)
    {
    	error_reporting(1);
        $pincodeno = $req->input('pincode');
    	$params = Http::get("https://api.postalpincode.in/pincode/$pincodeno")->json();
    	
    	$pindetails = $params[0]['PostOffice'];
    	$totalpins = count($params[0]['PostOffice']);



//         $fpincodeno = $req->input('fpincode');
//     	$tpincodeno = $req->input('tpincode');
// // 
// // $from_pincode = "110091";
// // $to_pincode = "841226";
// $from_pincode = $fpincodeno;
// $to_pincode = $tpincodeno;

//     $url = 'https://pickrr.com/api/check-pincode-service/';
//     $data = array (
//         'from_pincode' => $from_pincode,
//         'to_pincode' => $to_pincode,
//         'auth_token' => '42e094b5daec3b715ab96cbb248839dd141263',
//         );
//         $params = '';
//     foreach($data as $key=>$value)
//                 $params .= $key.'='.$value.'&';
//         $params = trim($params, '&');
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
//     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
//     curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
//     curl_setopt($ch, CURLOPT_HEADER, 0);

//     $result = curl_exec($ch);
//     curl_close($ch);
//     echo "<pre>";
//     print_r($result);

// 

    	return view('UserPanel.Pincode',['params'=>$params,'pindetails'=>$pindetails,'totalpins'=>$totalpins]);

    	// echo $params[0]['Status'];
    	// echo "<br>";
    	// $totalpins = count($params[0]['PostOffice']);
    	// print_r($totalpins);
    	// echo "<br>";
    	// $pindetails = $params[0]['PostOffice'];
    	// foreach ($pindetails as $pindetail){
    	// 	echo $pindetail['Name']."<br>";
    	// 	echo $pindetail['Circle']."<br>";
    	// 	echo $pindetail['District']."<br>";
    	// 	echo $pindetail['Division']."<br>";
    	// 	echo $pindetail['Region']."<br>";
    	// 	echo $pindetail['State']."<br>";
    	// 	echo $pindetail['Country']."<br>";
    	// 	echo $pindetail['Pincode']."<br>";
    	// }
    	// return $req->input();
    }
}
