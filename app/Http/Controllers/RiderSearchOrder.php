<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;

class RiderSearchOrder extends Controller
{
	public function Home()	
	{
		$riderid = session()->get('UserLogin3id');
        $params = orderdetail::where('order_riderid',$riderid)
                                ->orderby('orderid','desc')
                                ->get();
        return view('RiderPanel.PlaceOrder.SearchOrder',['params'=>$params]);
	}
}
