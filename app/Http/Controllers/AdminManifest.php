<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manifest;
use App\Models\orderdetail;
use App\Models\Allusers;

class AdminManifest extends Controller
{


    public function NewManifest()
    {
    	return view('Admin.Manifest.ManifestNew');
    }

    public function AllManifest()
    {
    	$allusers = Allusers::where('usertype','user')->get();
    	// $params = orderdetail::orderby('Manifest_id','DESC')->get();
    	$params = orderdetail::all();
    	return view('Admin.Manifest.Manifest',['params'=>$params,'allusers'=>$allusers]);
    }


    public function NewManifestAdd(Request $req)
    {
    	// return $req->input();
        // $qdata = AdminLoginCheck::where('username',$req->email)->first();
        // if(empty($qdata['id']))
        // {
        //      $qdata1 = AdminLoginCheck::where('mobile',$req->mobile)->first();
        //      if(empty($qdata1['id']))
        //      {
                $query = new Manifest();
                $query->Manifest_name = $req->name;
                $query->Manifest_gstno = $req->gstno;
                $query->Manifest_address1 = $req->address1;
                $query->Manifest_address2 = $req->address2;
                $query->Manifest_mobile = $req->mobile;
                $query->Manifest_pincode = $req->pincode;
                $query->Manifest_state = $req->state;
                $query->Manifest_city = $req->city;
                $query->Manifest_deliverytype = $req->deliverytype;
                $query->save();

                $req->session()->flash('status','New Manifest Added');
                return redirect('/New_Manifest');

        //      }else
        //      {
        //         $req->session()->flash('status','Mobile Number Already Exist');
        //         return redirect('/New_Manifest');       
        //      }
        // }else
        // {
        //     $req->session()->flash('status','Email Already Exist');
        //     return redirect('/New_Manifest');
        // }
    }

    public function ManifestEdit(Request $req,$id)
    {
        $params = Manifest::where('Manifest_id',$id)->first();
        return view('Admin.Manifest.ManifestEdit',['params'=>$params]);
    }

    public function ManifestUpdate(Request $req)
    {
        // return $req->input();
        Manifest::where('Manifest_id',$req->Manifestid)
                        ->update([                      
							'Manifest_name' => $req->name,
							'Manifest_gstno' => $req->gstno,
							'Manifest_address1' => $req->address1,
							'Manifest_address2' => $req->address2,
							'Manifest_mobile' => $req->mobile,
							'Manifest_pincode' => $req->pincode,
							'Manifest_state' => $req->state,
							'Manifest_city' => $req->city,
							'Manifest_deliverytype' => $req->deliverytype
                        ]);
        $req->session()->flash('status','Manifest Details Update');
        return redirect("/Manifest_Edit/$req->Manifestid");
        // $params = AdminLoginCheck::where('id',$id)->first();
        // return view('Admin.Manifests.ManifestEdit',['params'=>$params]);
    }
    


}
