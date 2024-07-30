<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PincodeManage extends Controller
{
	public function Home()
    {
    	return view('Admin.Pincode');
    }

    public function Check(Request $req)
    {
    	error_reporting(1);
    	$pincodeno = $req->input('pincode');
    	$params = Http::get("https://api.postalpincode.in/pincode/$pincodeno")->json();
        // print_r($params);
    	
    	$pindetails = $params[0]['PostOffice'];
    	$totalpins = count($params[0]['PostOffice']);

    	return view('Admin.Pincode',['params'=>$params,'pindetails'=>$pindetails,'totalpins'=>$totalpins]);
    }


}
