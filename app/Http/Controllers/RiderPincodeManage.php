<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RiderPincodeManage extends Controller
{
	public function Home()
    {
    	return view('RiderPanel.Pincode');
    }

    public function Check(Request $req)
    {
    	error_reporting(1);
    	$pincodeno = $req->input('pincode');
    	$params = Http::get("https://api.postalpincode.in/pincode/$pincodeno")->json();
    	
    	$pindetails = $params[0]['PostOffice'];
    	$totalpins = count($params[0]['PostOffice']);

    	return view('RiderPanel.Pincode',['params'=>$params,'pindetails'=>$pindetails,'totalpins'=>$totalpins]);

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
