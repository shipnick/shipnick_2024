<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hubs;

class UserHubs extends Controller
{


    public function AllInvoice(){
        // $userid = session()->get('UserLogin2id');
        // $params = Hubs::where('hub_created_by',$userid)->orderby('hub_id','DESC')->get();
        return view('UserPanel.Invoices.All');
    }
    public function AllRemittance(){
        // $userid = session()->get('UserLogin2id');
        // $params = Hubs::where('hub_created_by',$userid)->orderby('hub_id','DESC')->get();
        // return view('UserPanel.Remmitance.All',['params'=>$params]);
        return view('UserPanel.Remmitance.All');
    }
    public function WalletDetails(){
        $userid = session()->get('UserLogin2id');
        $params = Hubs::where('hub_created_by',$userid)->orderby('hub_id','DESC')->get();
        return view('UserPanel.Wallet.All',['params'=>$params]);
    }


    public function NewHub(){
    	return view('UserPanel.Hub.HubNew');
    }

    public function AllHub(){
        $userid = session()->get('UserLogin2id');
    	$params = Hubs::where('hub_created_by',$userid)->orderby('hub_id','DESC')->get();
    	return view('UserPanel.Hub.Hub',['params'=>$params]);
    }


    public function NewHubAdd(Request $req){
        error_reporting(1);
        $useridis = session()->get('UserLogin2id');
        if($req->deliverytype=="Express"){       $deliverytypeval = 1;     
        }elseif($req->deliverytype=="Economy"){  $deliverytypeval = 2;
        }elseif($req->deliverytype=="Bulk"){     $deliverytypeval = 3;        }

        $bulkfilename = date('Y-m-d');
        if(!file_exists("HubDetails/$bulkfilename")){
            mkdir("HubDetails/$bulkfilename");
        }
            
        $hub_alternate_id = "";
        $query = new Hubs();
        $query->hub_alternate_id = $hub_alternate_id;
        $query->hub_name = $req->name;
        $query->hub_gstno = $req->gstno;
        $query->hub_address1 = $req->address1;
        $query->hub_address2 = $req->address2;
        $query->hub_mobile = $req->mobile;
        $query->hub_pincode = $req->pincode;
        $query->hub_state = $req->state;
        $query->hub_city = $req->city;
        $query->hub_deliverytype = $req->deliverytype;
        $query->intargos_hubid ='';
        $query->hub_created_by = $useridis;
        $query->hub_folder = $bulkfilename;
        // $query->hub_img = $img;
        $query->save();

        $last_id = $query->id;
        $hubcode = "HID00".$last_id;
        
        $wareuid = rand(11,99);
        $hubtitleis = $req->name."_".$hubcode.$wareuid;
        $hubtitle = ucwords($hubtitleis);
        
        Hubs::where('hub_id',$last_id)->update(['hub_code'=>$hubcode,'hub_title'=>$hubtitle]);

        //  File Name
        $imgfile = $req->file('hubimage');
        if(!is_null($imgfile)){
            $fileextention = $imgfile->getClientOriginalExtension();;
            $fa = date('dmy');
            $fb = $last_id;
            $randno1 = rand(1,499);
            $randno2 = rand(500,999);
            $img = $fa.$fb.$randno1.$randno2.".".$fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("HubDetails/$bulkfilename/",$img);
            if(empty($img)){   $img = "";  }
            Hubs::where('hub_id',$last_id)->update(['hub_img'=>$img]);
        }
        //  File Name


// Add Intargos Warehouse Address Start
$wareuid = rand(11,99);
$intargoswarehourid = $req->name."_".$hubcode.$wareuid;
$pkname = $req->name;
$pkaddress = $req->address1;
$pkmobile = $req->mobile;
$pkpincode = $req->pincode;

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
    'signature: SW8EBDO64AZYQKPTU15FZRGV0IWVH7'
  ),
));

$responseintar = curl_exec($curl);
$responseintard = json_decode($responseintar,true);
curl_close($curl);

$IntargosHubid = $responseintard['address_id'];
Hubs::where('hub_id',$last_id)->update(['intargos_hubid'=>$IntargosHubid]);
// Add Intargos Warehouse Address End


        $req->session()->flash('status','New Hub Added');
        return redirect('/UPNew_Hub');
    }

    public function HubEdit(Request $req,$id)
    {
        $params = Hubs::where('hub_id',$id)->first();
        return view('UserPanel.Hub.HubEdit',['params'=>$params]);
    }

    public function HubUpdate(Request $req){

        //  File Name
        $imgfile = $req->file('hubimage');
        if(!is_null($imgfile)){
            $bulkfilename = $req->hubfolder;
            
            $fileextention = $imgfile->getClientOriginalExtension();
            $fa = date('dmy');
            $fb = "_";
            $randno1 = rand(1,499);
            $randno2 = rand(500,999);
            $img = $fa.$fb.$randno1.$randno2.".".$fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("HubDetails/$bulkfilename/",$img);
            if(empty($img)){   $img = "";  }
            Hubs::where('hub_id',$req->hubid)->update(['hub_img' => $img]);
        }
        //  File Name
        Hubs::where('hub_id',$req->hubid)
                        ->update([                      
							'hub_name' => $req->name,
							'hub_gstno' => $req->gstno,
							'hub_address1' => $req->address1,
							'hub_mobile' => $req->mobile,
							'hub_pincode' => $req->pincode,
							'hub_state' => $req->state,
							'hub_city' => $req->city,
							'hub_deliverytype' => $req->deliverytype
                        ]);
        $req->session()->flash('status','Hub Details Update');
        return redirect("/UPHub_Edit/$req->hubid");
        // $params = AdminLoginCheck::where('id',$id)->first();
        // return view('UserPanel.Hubs.HubEdit',['params'=>$params]);
    }



    public function HubDelete(Request $req)
    {
        $localhubid = $req->hubid;
        $apihubid = $req->hubaltid;

        Hubs::where('hub_id',$req->hubid)->delete();
        $req->session()->flash('status','Hub Details Delete Successfully');
        return redirect("/UPAll_Hubs");
    }
    

}
