<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courierpermission;
use App\Models\Hubs;

class AdminHubs extends Controller
{
    
    
public function IntargosWarehouse(){
    error_reporting(1);
    $hubs = Hubs::get();
    foreach($hubs as $hub){
         $hubcrtid = $hub['hub_id '];
         $userid = $hub['hub_created_by'];
         $hubadded = $hub['intargos_added'];
         $hubupdated = $hub['intargos_updated'];
         $intargoswarehourid = $hub['hub_title'];
         $pkname = $hub['hub_name'];
         $pkaddress = $hub['hub_address1'];
         $pkmobile = $hub['hub_mobile'];
         $pkpincode = $hub['hub_pincode'];
        // echo $hubintargosid = $hub['intargos_hubid'];
        $courierassigns = courierpermission::where('user_id',$userid)->where('courier_code','IN')->first('cp_id');
        if($courierassigns['cp_id']){
            echo " - ";
            echo $courierassigns['cp_id'];
            if($hubadded == '1'){
                // Intargos Hub Create
                    // Add Intargos Warehouse Address Start
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://app.intargos.com/api/AddWarehouse',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>'{
                            "address_title": "'.$intargoswarehourid.'",
                            "addressee": "'.$pkname.'",
                            "full_address": "'.$pkaddress.'",
                            "phone": "'.$pkmobile.'",
                            "pincode": "'.$pkpincode.'"
                        }',
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8 ',
                        'Cookie: ci_session=264268d097507d5f9221e2e8ff1ccf1cdf18451f'
                      ),
                    ));
                    $responseintar = curl_exec($curl);
                    $responseintard = json_decode($responseintar,true);
                    curl_close($curl);
                    if($responseintard['status'] == true){
                        $IntargosHubid = $responseintard['address_id'];
                        Hubs::where('hub_id',$hubcrtid)->update(['intargos_added'=>2,'intargos_hubid'=>$IntargosHubid]);
                    }elseif($responseintard['status'] == false){
                        Hubs::where('hub_id',$hubcrtid)->update(['intargos_added'=>1]);
                    }
                    // Add Intargos Warehouse Address End
                // Intargos Hub Create End //
            }elseif($hubupdated == '1'){
                // Intargos Hub Update
                    // Update Intargos Warehouse Address
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://app.intargos.com/api/UpdateWarehouse',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "address_title": "'.$intargoswarehourid.'",
                        "addressee": "'.$pkname.'",
                        "full_address": "'.$pkaddress.'",
                        "phone": "'.$pkmobile.'",
                        "pincode": "'.$pkpincode.'"
                    }',
                    CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8 ',
                    'Cookie: ci_session=264268d097507d5f9221e2e8ff1ccf1cdf18451f'
                    ),
                    ));
                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    if($responseic['status'] == true){
                        Hubs::where('hub_id',$hubcrtid)->update(['intargos_updated'=>2]);
                    }elseif($responseintard['status'] == false){
                        Hubs::where('hub_id',$hubcrtid)->update(['intargos_updated'=>1]);
                    }
                    // print_r($responseic);
                    // Update Intargos Warehouse Address End
                // Intargos Hub Update End //
            }
        }
    }
}



    public function NewHub()
    {
    	return view('Admin.Hub.HubNew');
    }

    public function AllHub()
    {
    	$params = Hubs::orderby('hub_id','DESC')->get();
    	return view('Admin.Hub.Hub',['params'=>$params]);
    }


    public function NewHubAdd(Request $req)
    {
    	// return $req->input();
        // $qdata = AdminLoginCheck::where('username',$req->email)->first();
        // if(empty($qdata['id']))
        // {
        //      $qdata1 = AdminLoginCheck::where('mobile',$req->mobile)->first();
        //      if(empty($qdata1['id']))
        //      {
                $query = new Hubs();
                $query->hub_name = $req->name;
                $query->hub_gstno = $req->gstno;
                $query->hub_address1 = $req->address1;
                $query->hub_address2 = $req->address2;
                $query->hub_mobile = $req->mobile;
                $query->hub_pincode = $req->pincode;
                $query->hub_state = $req->state;
                $query->hub_city = $req->city;
                $query->hub_deliverytype = $req->deliverytype;
                $query->save();

                $req->session()->flash('status','New Hub Added');
                return redirect('/New_Hub');

        //      }else
        //      {
        //         $req->session()->flash('status','Mobile Number Already Exist');
        //         return redirect('/New_Hub');       
        //      }
        // }else
        // {
        //     $req->session()->flash('status','Email Already Exist');
        //     return redirect('/New_Hub');
        // }
    }

    public function HubEdit(Request $req,$id)
    {
        $params = Hubs::where('hub_id',$id)->first();
        return view('Admin.Hub.HubEdit',['params'=>$params]);
    }

    public function HubUpdate(Request $req)
    {
        // return $req->input();
        Hubs::where('hub_id',$req->hubid)
                        ->update([                      
							'hub_name' => $req->name,
							'hub_gstno' => $req->gstno,
							'hub_address1' => $req->address1,
							'hub_address2' => $req->address2,
							'hub_mobile' => $req->mobile,
							'hub_pincode' => $req->pincode,
							'hub_state' => $req->state,
							'hub_city' => $req->city,
							'hub_deliverytype' => $req->deliverytype
                        ]);
        $req->session()->flash('status','Hub Details Update');
        return redirect("/Hub_Edit/$req->hubid");
        // $params = AdminLoginCheck::where('id',$id)->first();
        // return view('Admin.Hubs.HubEdit',['params'=>$params]);
    }
    

}
