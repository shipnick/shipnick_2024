<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLoginCheck;

class AdminRiders extends Controller
{
    public function NewRider()
    {
    	$params = AdminLoginCheck::where('usertype','rider')
    								->orderby('id','DESC')
    								->get();
    	return view('Admin.Riders.RiderNew',['params'=>$params]);
    }

    public function AllRider()
    {
    	return view('Admin.Riders.RiderAll');
    }

    public function NewRiderAdd(Request $req)
    {
        $qdata = AdminLoginCheck::where('username',$req->email)->first();
        if(empty($qdata['id']))
        {
             $qdata1 = AdminLoginCheck::where('mobile',$req->mobile)->first();
             if(empty($qdata1['id']))
             {
                $query = new AdminLoginCheck();
                $query->username = $req->email;
                $query->password = $req->password;
                $query->name = $req->name;
                $query->mobile = $req->mobile;
                $query->usertype = "rider";
                $query->save();

                $req->session()->flash('status','New Rider Added');
                return redirect('/New_Rider');

             }else
             {
                $req->session()->flash('status','Mobile Number Already Exist');
                return redirect('/New_Rider');       
             }
        }else
        {
            $req->session()->flash('status','Email Already Exist');
            return redirect('/New_Rider');
        }

		// return $req->input();
		// $query = new AdminLoginCheck();
		// $query->username = $req->email;
		// $query->password = $req->password;
		// $query->name = $req->name;
		// $query->mobile = $req->mobile;
		// $query->usertype = "rider";
		// $query->save();

		// $req->session()->flash('status','New Rider Added');
		// return redirect('/New_Rider');

    }

     public function RiderEdit(Request $req,$id)
    {
        $params = AdminLoginCheck::where('id',$id)->first();
        return view('Admin.Riders.RiderEdit',['params'=>$params]);
    }

    public function RiderUpdate(Request $req)
    {
        // return $req->input();
$mis = 0;
$pod = 0;
$rpod = 0;
$drpt = 0;
if($req->mis){  $mis = 1;   }
if($req->pod){  $pod = 1;   }
if($req->rpod){ $rpod = 1;  }
if($req->drpt){ $drpt = 1;  }
        AdminLoginCheck::where('id',$req->customerid)
                        ->update([
                            'name'=>$req->name,
                            'status'=>$req->userstatus,
                            'report_mis_show'=>$mis,
                            'report_pod_show'=>$pod,
                            'report_rpod_show'=>$rpod,
                            'report_daily_show'=>$drpt
                        ]);

        $req->session()->flash('status','Rider Details Update');
        return redirect("/New_Rider_Edit/$req->customerid");
        // $params = AdminLoginCheck::where('id',$id)->first();
        // return view('Admin.Clients.ClientEdit',['params'=>$params]);
    }
    


}
