<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;

class RiderDashboard extends Controller
{
    public function Home()
    {
    	if(!empty(session('UserLogin')))
        {
    		return view('Admin.Dashboard');
    	}

    	if(!empty(session('UserLogin2')))
        {
$userid = session()->get('UserLogin2id');
$all = orderdetail::where('order_userid',$userid)->count('orderid');

$allpending = orderdetail::where('order_userid',$userid)
                    ->where('order_status','!=','Complete')
                    ->where('order_status','!=','Cancel')
                    ->count('orderid');

$allcomplete = orderdetail::where('order_userid',$userid)
                    ->where('order_status','Complete')
                    ->count('orderid');

$allcancel = orderdetail::where('order_userid',$userid)
                    ->where('order_status','Cancel')
                    ->count('orderid');
            
            return view('UserPanel.Dashboard',['all'=>$all,'allcomplete'=>$allcomplete,'allpending'=>$allpending,'allcancel'=>$allcancel]);
    		// return view('UserPanel.Dashboard');
    	}
    		
    	if(!empty(session('UserLogin3')))
        {
$riderid = session()->get('UserLogin3id');
$allrecords = orderdetail::where('order_riderid',$riderid)->count('orderid');

$complete = orderdetail::where('order_riderid',$riderid)
                    ->where('order_status','Complete')
                    ->count('orderid');

$pending = orderdetail::where('order_riderid',$riderid)
                    ->where('order_status','!=','Complete')
                    ->where('order_status','!=','Cancel')
                    ->count('orderid');

$cancel = orderdetail::where('order_riderid',$riderid)
                    ->where('order_status','Cancel')
                    ->count('orderid');


            return view('RiderPanel.Dashboard',['allrecords'=>$allrecords,'pending'=>$pending,'complete'=>$complete,'cancel'=>$cancel]);
    		// return view('RiderPanel.Dashboard');
    	}
    	return view('Admin.Login');
    	// return view('UserPanel.Dashboard');
    }
}
