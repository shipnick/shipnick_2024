<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLoginCheck;
use App\Models\SuperAdminLoginCheck;
use App\Models\Allusers;
use App\Models\financial;
use App\Models\billing;
use App\Models\couriers;
use App\Models\courierlist;
use App\Models\bulkorders;
use App\Models\courierpermission;
use App\Models\Pincode; 
use App\Models\ShippindLabel;


class LoginCheck extends Controller
{
    public function Home()
    {
        // return view('Admin.Login');
        return view('Login.Login');
    }





// Super
    public function SuperLoginCheck(){
        return view('Login.super-login');
    }
    public function SuperLoginCheckIt(Request $req){
        $qdata = SuperAdminLoginCheck::where('username',$req->email)
                            ->where('password',$req->pass)
                            ->first();
        if(!empty($qdata['spid'])){
            if($qdata['usertype']=="sadmin"){
                $req->session()->put('UserLogin',$qdata['username']);
                $req->session()->put('UserLoginid',$qdata['spid']);
                $req->session()->put('UserLogin1name',$qdata['name']);
                return redirect('/superpanel');
            }
        }else{
            // echo "ele";
            $req->session()->flash('status','Invalid Login Details');
            return redirect('/superpanel');
        }
    }
// Super





    public function LoginCheckIt(Request $req)
    {
    	// return $req->input();
    	$qdata = AdminLoginCheck::where('username',$req->email)
    						->where('password',$req->pass)
    						->first();
    	if(!empty($qdata['id']))
    	{
            if($qdata['usertype']=="sadmin")
            {
                // echo "1";
                $req->session()->put('UserLogin',$qdata['username']);
        		$req->session()->put('UserLoginid',$qdata['id']);
                $req->session()->put('UserLogin1name',$qdata['name']);
                $req->session()->put('UserLogin1Pic',$qdata['profilepic']);
        		return redirect('/AdminPanel');
            }elseif($qdata['usertype']=="admin")
            {
                // echo "1";
                $req->session()->put('UserLogin',$qdata['username']);
                $req->session()->put('UserLoginid',$qdata['id']);
                $req->session()->put('UserLogin1name',$qdata['name']);
                
                    $propic = "profilepic.jpg";
                    $propicrfs = trim($qdata['profilepic']);
                    if($propicrfs){     
                        $propic = $qdata['username'].'/'.$propicrfs;       
                    }
                    $req->session()->put('UserLogin1Pic',$propic);
                    
                return redirect('/AdminPanel');
            }elseif($qdata['usertype']=="user"){
                // echo "2";
if(empty($qdata['status']))
{
$req->session()->flash('status','Your Login Block || Please Contact Shipedia');
return redirect('/AdminLogin');
}
                $req->session()->put('UserLogin2',$qdata['username']);
                $req->session()->put('UserLogin2name',$qdata['name']);
                
                        $propic = "profilepic.jpg";
                        $propicrfs = trim($qdata['profilepic']);
                        if($propicrfs){     
                            $propic = $qdata['username'].'/'.$propicrfs;       
                        }
                        $req->session()->put('UserLoginPic',$propic);
                        

                $req->session()->put('UserLogin2id',$qdata['id']);
$req->session()->put('UserLogin2reportshow',$qdata['report_show']);
$req->session()->put('UserLogin2pod',$qdata['report_pod_show']);
$req->session()->put('UserLogin2rpod',$qdata['report_rpod_show']);
$req->session()->put('UserLogin2mis',$qdata['report_mis_show']);
$req->session()->put('UserLogin2drpt',$qdata['report_daily_show']);

$req->session()->put('UserLogin2billshow',$qdata['billing_show']);
$req->session()->put('UserLogin2billingshow',$qdata['billing_all_show']);
$req->session()->put('UserLogin2billingdownload',$qdata['billing_download_show']);

$req->session()->put('UserLogin2walletshow',$qdata['wallet_show']);
$req->session()->put('UserLogin2walletadd',$qdata['wallet_add_show']);
$req->session()->put('UserLogin2walletdetails',$qdata['wallet_details_show']);

$req->session()->put('UserLogin2pincodeshow',$qdata['pincode_show']);

$req->session()->put('UserLogin2actype',$qdata['actype']);

$req->session()->put('UserLogin2ndrshow',$qdata['ndr_show']);

$req->session()->put('UserLogin2printshiplabel',$qdata['print_ship_labels']);
$req->session()->put('UserLogin2ridershow',$qdata['rider_show']);


                return redirect('/UserPanel');
            }elseif($qdata['usertype']=="rider")
            {
                // echo "3";
if(empty($qdata['status']))
{
$req->session()->flash('status','Your Login Block || Please Contact Shipedia');
return redirect('/AdminLogin');
}
                $req->session()->put('UserLogin3',$qdata['username']);
                $req->session()->put('UserLogin3name',$qdata['name']);
                $req->session()->put('UserLogin3id',$qdata['id']);
                return redirect('/RiderPanel');
            // }elseif($qdata['usertype']=="rider")
            // {
            //     // echo "3";
            //     $req->session()->put('UserLogin3',$qdata['username']);
            //     return redirect('/CustomerPanel');
            }
    	}else
    	{
            // echo "ele";
    		$req->session()->flash('status','Invalid Login Details');
    		return redirect('/login');
    	}
    }




    public function Registration()
    {
        // return view('Admin.Login');
        return view('Login.Registration');
    }



    public function RegistrationAdd(Request $req)
    {
        // return $req->input();

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
                $query->usertype = "user";
                $query->save();

                return redirect('/AdminPanel');

             }else
             {
                $req->session()->flash('status','Mobile Number Already Exist');
                return redirect('/AdminPanelRegistration');
             }
        }else
        {
            $req->session()->flash('status','Email Already Exist');
            return redirect('/AdminPanelRegistration');
        }
    }

 public function RegistrationAddNew(Request $req){
        // return $req->input();

        $qdata = AdminLoginCheck::where('username',$req->email)->first();

        if(empty($qdata['id']))
        {
             $qdata1 = AdminLoginCheck::where('mobile',$req->mobile)->first();
             if(empty($qdata1['id']))
             {
                $query = new AdminLoginCheck();
                $query->name = $req->name;
                $query->brandame = $req->bname;
                $query->username = $req->email;
                $query->mobile = $req->mobile;
                $query->address1 = $req->address;
                $query->gstno = $req->gstno;
                $query->panno = $req->panno;
                $query->password = $req->password;
                $query->state = $req->statename;
                $query->city = $req->cityname;
                $query->pincode = $req->pincode;
                $query->usertype = "user";
                 $query->crtuid = 88;
                $query->status = 1;
                $query->save();

                return redirect('/login');

             }else
             {
                $req->session()->flash('status','Mobile Number Already Exist');
                return redirect('/registration');
             }
        }else
        {
            $req->session()->flash('status','Email Already Exist');
            return redirect('/registration');
        }
    }




    public function setting(){
        $userid = session()->get('UserLogin2id');
        $label_setting = ShippindLabel::where('user_id', $userid)->first();
        $couriers = courierlist::where('active_flg',1)->get();
        $param = courierpermission::where('user_id',$userid)
                                    ->where('admin_flg',1)
                                    ->orderby('courier_code','ASC')->orderby('courier_by','ASC')->get();
        
        $params = Allusers::where('id',$userid)->first();
        return view('UserPanel.Setting.profile',["params"=>$params ,"param"=>$param ,'couriers'=>$couriers,'id'=>$userid ,'label_setting'=>$label_setting]);
    }
    
    public function settingupt(Request $req){
        echo "Loading...";
        $userid = session()->get('UserLogin2id');
        $usernameemail = $req->email;
        if(!file_exists("Profiles/$usernameemail")){
            mkdir("Profiles/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if(!is_null($profilepic)){
            $img = $profilepic->getClientOriginalName();
            $profilepic->move("Profiles/$usernameemail/",$img);
            Allusers::where('id',$userid)->update(['profilepic' => $img]);
                $propic = $usernameemail.'/'.$img;
                $req->session()->put('UserLoginPic',$propic);
        }
        Allusers::where('id',$userid)->update([
                            'username' => $req->email,
                            'name' => $req->name,
                            'mobile' => $req->phone,
                            'address1' => $req->addressline1,
                            'address2' => $req->addressline2,
                            'pincode' => $req->zipcode
                        ]);
        $statusmsg = "Profile update successfully";

        $req->session()->flash('status',$statusmsg);
        return redirect("/setting");
    }


    public function financialDetails(){
        $userid = session()->get('UserLogin2id');
        $params = financial::where('adminid',$userid)->get();
        return view('UserPanel.Setting.financial',["params"=>$params]);
    }
    public function financialDetailsadd(Request $req){
        $userid = session()->get('UserLogin2id');
        $query = new financial();
        $query->adminid = $userid;
        $query->bankbenificiaryname = $req->bname;
        $query->bankname = $req->bankname;
        $query->bankacno = $req->acno;
        $query->bankifsc = $req->ifsc;
        $query->bankbranch = $req->branch;
        $query->bankactype = $req->banktype;
        $query->save();

        $statusmsg = "Financial detail add successfully";
        $req->session()->flash('status',$statusmsg);
        $params = financial::where('adminid',$userid)->get();
        // return view('UserPanel.Setting.financial',["params"=>$params]);
        return redirect("/financial-details");
    }

    public function billingInformation(){
        $userid = session()->get('UserLogin2id');
        $params = billing::where('adminid',$userid)->get();
        return view('UserPanel.Setting.billing',["params"=>$params]);
    }
    public function billingInformationadd(Request $req){
        $userid = session()->get('UserLogin2id');
        $query = new billing();
        $query->adminid = $userid;
        $query->billaddress = $req->address;
        $query->billcity = $req->city;
        $query->billstate = $req->state;
        $query->billpincode = $req->pincode;
        $query->save();

        $statusmsg = "Billing detail add successfully";
        $req->session()->flash('status',$statusmsg);
        $params = billing::where('adminid',$userid)->get();
        return redirect("/billing-information");
        // return view('UserPanel.Setting.billing',["params"=>$params]);
    }


    public function kycdetails(){
        echo "Working";
        exit();
        return view('UserPanel.Setting.kyc');
    }
    public function CourierPermissions(){
        $userid = session()->get('UserLogin2id');
        $couriers = courierlist::where('active_flg',1)->get();
        $params = courierpermission::where('user_id',$userid)
                                    ->where('admin_flg',1)
                                    ->orderby('courier_code','ASC')->orderby('courier_by','ASC')->get();

        return view('UserPanel.Setting.couriers',['params'=>$params,'couriers'=>$couriers,'id'=>$userid]);
    }
    public function changePassword(){
        return view('UserPanel.Setting.changepass');
    }
    public function changePasswordupt(Request $req){
        $userid = session()->get('UserLogin2id');
        $req->current_password;
        $req->new_password;
        $req->confirm_password;

        if($req->new_password === $req->confirm_password){
          $checkoldpass = Allusers::where('id',$userid)->where('password',$req->current_password)->count('id');
          if($checkoldpass){
            Allusers::where('id',$userid)->update(['password' => $req->confirm_password]);
            $statusmsg = "Password update successfully";
          }else{
            $statusmsg = "Current password not match";
          }
        }else{
          $statusmsg = "Confirm password not match";
        }
        $req->session()->flash('status',$statusmsg);
        return redirect("/change-password");
    }


// Courier Assign
public function CourierPermissionsUpdate(Request $req){
    $code = $req->code;
    $courier = $req->courier;
    $userid = $req->userid;
    $value = $req->value;
    courierpermission::where('courier_code',$code)
                            ->where('courier_by',$courier)
                            ->where('user_id',$userid)
                            ->update(['user_flg'=>$value]);
}
// Courier Assign
// Courier Priority
public function CourierPriorityUpdate(Request $req){
    $code = $req->code;
    $courier = $req->courier;
    $userid = $req->userid;
    $value = $req->value;
    courierpermission::where('courier_code',$code)
                            ->where('courier_by',$courier)
                            ->where('user_id',$userid)
                            ->update(['courier_priority'=>$value]);
}
// Courier Priority

 public function getStateCity(Request $request)
    {
        $pincode = $request->input('pincode');
        $pincodeData = Pincode::where('pincode', $pincode)->first();
        
        if ($pincodeData) {
            return response()->json([
                'success' => true,
                'state' => $pincodeData->state,
                'city' => $pincodeData->city,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pincode not found.',
            ]);
        }
    }






}
