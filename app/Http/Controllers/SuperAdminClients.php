<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLoginCheck;
use App\Models\SuperAdminLoginCheck;
use App\Models\financial;
use App\Models\billing;
use App\Models\couriers;
use App\Models\courierlist;
use App\Models\bulkorders;
use App\Models\courierpermission;
use App\Models\Allusers;
use App\Models\price;
use App\Models\BulkPincode;
use App\Models\PincodeFile;
use App\model\orderdetail;
use App\Models\OrderStatusLabel;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class SuperAdminClients extends Controller
{
    public function AllClient(){
        $userid = session()->get('UserLoginid');
        $params = AdminLoginCheck::where('usertype','admin')
                                    ->where('spid',$userid)
                                    ->orderby('id','DESC')
                                    ->get();
        return view('super-admin.Clients.AllNew',['params'=>$params]);
    }

// Courier Assign
    public function CourierAssign(Request $req){        
    $couriername = $req->currentcourierno;
    $userid = $req->userid;
    // $couriername = couriers::where('courierid',$courierid)->first();
    // $details = Allusers::where('id',$userid)->first();
    if($couriername == "intargos"){
            $a = Allusers::where('id',$userid)->update(['Intargos'=>1,'intargos_active'=>1,'Nimbus'=>0,'nimbus_active'=>0]);
        }

    if($couriername == "nimbus"){
            $a = Allusers::where('id',$userid)->update(['Intargos'=>0,'intargos_active'=>0,'Nimbus'=>1,'nimbus_active'=>1]);
        }

    if($couriername == "0"){
            $a = Allusers::where('id',$userid)->update(['Intargos'=>0,'intargos_active'=>0,'Nimbus'=>0,'nimbus_active'=>0]);
        }
}
// Coureir Assign 

    public function NewClient(){
    	return view('super-admin.Clients.ClientNew');
    }
    public function NewClientAdd(Request $req){ 
        $userid = session()->get('UserLoginid');
        $qdata = AdminLoginCheck::where('username',$req->email)->first();
        if(empty($qdata['id'])){
   // 
        $usernameemail = $req->email;
        if(!file_exists("Profiles/$usernameemail")){
            mkdir("Profiles/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if(!is_null($profilepic)){
            $img = $profilepic->getClientOriginalName();
            $profilepic->move("Profiles/$usernameemail/",$img);
        }else{
            $img = "";
        }

        $query = new AdminLoginCheck();
        $query->spid = $userid;
        $query->username = $req->email;
        $query->password = $req->password;
        $query->name = $req->companyname;
        $query->mobile = $req->mobile;
        $query->companyname = $req->companyname;
        $query->profilepic = $img;
        $query->status = 1;
        $query->usertype = "admin";
        $query->save();

        $req->session()->flash('status','New Admin added');
        return redirect('/super-new-admin');
// 
        }else
        {
            $req->session()->flash('status','Email already exist');
            return redirect('/super-new-admin');
        }
    }

    public function ClientEdit(Request $req,$id){
        $params = AdminLoginCheck::where('id',$id)->first();
        return view('super-admin.Clients.ClientEdit',['params'=>$params]);
    }

    public function ClientUpdate(Request $req){
        $usernameemail = $req->email;
        if(!file_exists("Profiles/$usernameemail")){
            mkdir("Profiles/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if(!is_null($profilepic)){
            echo $img = $profilepic->getClientOriginalName();
            $profilepic->move("Profiles/$usernameemail/",$img);
            AdminLoginCheck::where('id',$req->customerid)->update(['profilepic' => $img]);
        }

        AdminLoginCheck::where('id',$req->customerid)
            ->update([
                'username'=>$req->email,
                'password'=>$req->password,
                'name'=>$req->companyname,
                'mobile'=>$req->mobile,
                'companyname'=>$req->companyname,
                'status'=>'1'
            ]);
        $req->session()->flash('status','Admin details updated');
        return redirect("/super-new-admin-edit/$req->customerid");
    }


// Client Details
public function ClientSetting(Request $req,$id){
    $params = AdminLoginCheck::where('id',$id)->first();
    return view('super-admin.Setting.all',['params'=>$params,'id'=>$id]);
}
public function ClientFinancial(Request $req,$id){
    $params = financial::where('adminid',$id)->get();
    return view('super-admin.Setting.financial',['params'=>$params,'id'=>$id]);
}
public function ClientBilling(Request $req,$id){
    $params = billing::where('adminid',$id)->get();
    return view('super-admin.Setting.billing',['params'=>$params,'id'=>$id]);
}
public function ClientCouriers(Request $req,$id){
    $lists = couriers::get();
    $params = courierlist::where('active_flg',1)
                            ->orderby('name','ASC')->orderby('cl_name','ASC')->get();
    $couriers = courierpermission::get();
    $permissions = courierpermission::where('user_id',$id)->get();
    return view('super-admin.Setting.couriers',['params'=>$params,'couriers'=>$couriers,'permissions'=>$permissions,'id'=>$id,'lists'=>$lists]);
}
public function ClientPassword(Request $req,$id){
    $params = AdminLoginCheck::where('id',$id)->first();
    return view('super-admin.Setting.changepass',['params'=>$params,'id'=>$id]);
}
// Client Details
// Courier Assign
public function ClientCourierPermissions(Request $req){        
    $code = $req->code;
    $courier = $req->courier;
    $userid = $req->userid;
    $value = $req->value;
    $courieridno = $req->courieridno;
    
    
    $courierexistsornot = courierpermission::where('courier_code',$code)
                                    ->where('courier_by',$courier)
                                    ->where('user_id',$userid)
                                    ->get();
    if(count($courierexistsornot)){
        courierpermission::where('courier_code',$code)
                                ->where('courier_by',$courier)
                                ->where('user_id',$userid)
                                ->update(['admin_flg'=>$value]);
    }else{
        $query = new courierpermission();
        $query->courier_idno = $courieridno;
        $query->courier_code = $code;
        $query->courier_by = $courier;
        $query->user_id = $userid;
        $query->admin_flg = $value;
        $query->user_flg = "0";
        $query->save();
    }
}
// Courier Assign



// Merchant Summary
    public function MerchantSummary(){
        return view('super-admin.Clients.summary');
    }
    public function MerchantSummarySearch(Request $req){
        $fromdate = $req->startdatefrom;
        $fromdate = date('Y-m-d',strtotime($fromdate));
        // echo "<br>";
        $todate = $req->enddatefrom;
        $todate = date('Y-m-d',strtotime($todate));
        // exit();
        $params = bulkorders::where('Awb_Number','!=','')
                            ->where('order_cancel',null)
                            ->whereBetween('Rec_Time_Date', array($fromdate,$todate))
                            ->distinct()
                            ->get('User_Id');

        $userwiseorder = array();
        foreach($params as $param){
            // echo "<br>";
            // echo "User Id : ";
            $userid = $param->User_Id;
            // echo " Total NO : ";
            $totalorders = bulkorders::where('User_Id',$userid)
                            ->where('Awb_Number','!=','')
                            ->where('order_cancel',null)
                            ->whereBetween('Rec_Time_Date', array($fromdate,$todate))
                            ->count('Single_Order_Id');
            $usernameis = Allusers::where('id',$userid)->distinct()->get('name');
            foreach($usernameis as $usernamei){
                $username = $usernamei->name;
            }
            $userwiseorder[] = array("userid"=>$userid,"username"=>$username,"totalno"=>$totalorders);
        }

        // echo "<pre>";
        // print_r($userwiseorder);
        // echo "</pre>";
        // exit();
        $totalusers = count($userwiseorder);
        $alltotalno = count($params);
        return view('super-admin.Clients.summarysearch',['params'=>$userwiseorder,'alltotalno'=>$alltotalno,"totalusers"=>$totalusers]);
    }
// Merchant Summary
// Courier Edit
    public function CourierEdit(Request $req,$id){
        $params = couriers::orderby('courierid','DESC')->get();
        $users = Allusers::where('id',$id)->first();
        return view('super-admin.Clients.ClientCourierUpdat',['params'=>$params,"Userid"=>$id,'users'=>$users]);
    }

    public function CourierEditupt(Request $req){        
        $courierid = $req->currentcourierno;
        $userid = $req->userid;
        $couriername = couriers::where('courierid',$courierid)->first();
        $details = Allusers::where('id',$userid)->first();
        // echo "In : ";
        // echo $details['Intargos'];
        // echo "Ni : ";
        // echo $details['Nimbus'];
        // echo " : ";
        if($couriername['name'] == "Intargos"){
            // echo "<br> Intargos <br> ";
            if($details['Intargos']==1){
                $a = Allusers::where('id',$userid)->update(['Intargos'=>0,'intargos_active'=>0]);
                // echo " :Yes : ";
                // print_r($a);
            }else{
                $a = Allusers::where('id',$userid)->update(['Intargos'=>1,'intargos_active'=>1]);
                // echo " | No : ";
                // print_r($a);
                // echo " : ";
            }
        }

        if($couriername['name'] == "Nimbus"){
            // echo "<br> Nimbus <br> ";
            if($details['Nimbus']==1){
                $a = Allusers::where('id',$userid)->update(['Nimbus'=>0,'nimbus_active'=>0]);
                // echo " :Yes : ";
                // print_r($a);
            }else{
                $a = Allusers::where('id',$userid)->update(['Nimbus'=>1,'nimbus_active'=>1]);
                // echo " | No : ";
                // print_r($a);
                // echo " : ";
            }
        }
        // return "updated";
    }
// Courier Edit




    public function Couriers(){ 
        
        
         $params = couriers::orderby('courierid','DESC')->where('courier_added','Shipnick')->get();
        return view('super-admin.Couriers.AllNew',['params'=>$params]);
    }
   
    public function model($name)
    {
        $admin = DB::table('admin')->where($name,  1)->get();
        
      
        return view("super-admin.Couriers.admin-list",['intargos'=>$admin]);
    }
    public function rate_assing(Request $req){  
        $userida = $req->id;
        $crtusers = AdminLoginCheck::where('usertype','admin')
                                    ->where('id',$userida)
                                    ->first();
                                    
        
        $params =  price::where('admin_id',$userida)->get();
        return view('super-admin.Couriers.rate-list', ['params' => $params, 'crtusers' => $crtusers]);
    }
    public function api_assing(Request $req){

        
        $userida = $req->id;
        $crtusers = AdminLoginCheck::where('usertype','admin')
                                    ->where('id',$userida)
                                    ->first();
                                    
        $params = couriers::orderby('courierid','DESC')->get();
        $params1 =  price::where('admin_id',$userida)->get();
        return view('super-admin.Couriers.api-list', ['params' => $params, 'crtusers' => $crtusers,],compact('params1'));
    }
    
    
    public function api_assing_update(Request $req){
        
        $courname = $req->courname;
        $userida = $req->clientidisause;
        
        $crtusers = AdminLoginCheck::where('usertype','admin')
                                    ->where('id',$userida)
                                    ->first();
        if(empty($crtusers[$courname])){
            $crtusers = AdminLoginCheck::where('usertype','admin')
                                    ->where('id',$userida)
                                    ->update([$courname=>1]);
        }elseif($crtusers[$courname]==0){
            $crtusers = AdminLoginCheck::where('usertype','admin')
                                    ->where('id',$userida)
                                    ->update([$courname=>1]);
        }elseif($crtusers[$courname]==1){
            $crtusers = AdminLoginCheck::where('usertype','admin')
                                    ->where('id',$userida)
                                    ->update([$courname=>0]);
        }
                         
                         
                                    
            //                         ->update([
            //     'name'=>$req->couriername,
            //     'email'=> $req->email
            // ]);

        // return view('super-admin.Couriers.api-list',['params'=>$params,'crtusers'=>$crtusers]);
        
        return redirect("/super-courier-assign/$userida");
    }

    public function CouriersAdd(){
        return view('super-admin.Couriers.ClientNew');
    }
    public function CouriersAddupt(Request $req){
        $qdata = couriers::where('email',$req->email)->first();
        if(empty($qdata['courierid'])){
   // 
        $usernameemail = $req->email;
        if(!file_exists("Couriers/$usernameemail")){
            mkdir("Couriers/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if(!is_null($profilepic)){
            $img = $profilepic->getClientOriginalName();
            $profilepic->move("Couriers/$usernameemail/",$img);
        }else{
            $img = "";
        }

        $query = new couriers();
        $query->name = $req->couriername;
        $query->email = $req->email;
        $query->logo = $img;
        $query->save();

        $req->session()->flash('status','New courier added');
        return redirect('/courier-new');
// 
        }else
        {
            $req->session()->flash('status','Email already exist');
            return redirect('/courier-new');
        }
    }

    

    public function CouriersEdit(Request $req,$id){
        $params = couriers::where('courierid',$id)->first();
        return view('super-admin.Couriers.ClientMainEdit',['params'=>$params]);
    }

    public function CouriersEditupt(Request $req){

        $usernameemail = $req->email;
        if(!file_exists("Couriers/$usernameemail")){
            mkdir("Couriers/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if(!is_null($profilepic)){
            $img = $profilepic->getClientOriginalName();
            $profilepic->move("Couriers/$usernameemail/",$img);
            couriers::where('courierid',$req->courieridis)->update(['logo'=> $img]);
        }

        couriers::where('courierid',$req->courieridis)
            ->update([
                'name'=>$req->couriername,
                'email'=> $req->email
            ]);
        $req->session()->flash('status','Courier details updated');
        return redirect("/courier-edit/$req->courieridis");
    }

    
    public function CourierPrice(Request $req,$id){
        $params = couriers::where('courierid',$id)->first();
        return view('super-admin.Couriers.ClientEdit',['params'=>$params]);
    }

    public function CourierPriceupt(Request $req){
        couriers::where('courierid',$req->courieridis)
            ->update([
                'fbupto'=>$req->weightslap,
                'fbwithcity'=>"0",
                'fbwithstate'=>$req->withstate,
                'fbwithzone'=>$req->withzone,
                'fbmtetrotometro'=>$req->metrotometro,
                'fbrestofindia'=>$req->restofindia,
                'fbextralocation'=>$req->extralocation,
                'fbspecaildestination'=>$req->special,
                'fbcodcharge'=>$req->codcharge,
                'fbcodchargepersent'=>$req->codpersent,
                'faupto'=>$req->aweightslap,
                'fawithcity'=>"0",
                'fawithstate'=>$req->awithstate,
                'fawihtzone'=>$req->awithzone,
                'fametrotometro'=>$req->ametrotometro,
                'faresttoindia'=>$req->arestofindia,
                'faextralocation'=>$req->aextralocation,
                'faspecialdestination'=>$req->aspecial,
                'facodcharge'=>$req->acodcharge,
                'facodchargepersent'=>$req->acodpersent,
                'rbupto'=>$req->rweightslap,
                'rpwihtcity'=>"0",
                'rbwithstate'=>$req->rwithstate,
                'rbwithzone'=>$req->rwithzone,
                'rbmetrotometro'=>$req->rmetrotometro,
                'rbresttoindia'=>$req->rrestofindia,
                'rbextralocation'=>$req->rextralocation,
                'rbspeciladestination'=>$req->rspecial,
                'rbcodcharge'=>$req->rcodcharge,
                'rbcodchargepersent'=>$req->rcodpersent,
                'raupto'=>$req->raweightslap,
                'rawithcity'=>"0",
                'rawithstate'=>$req->rawithstate,
                'rawithzone'=>$req->rawithzone,
                'rametrotometro'=>$req->rametrotometro,
                'raresttoindia'=>$req->rarestofindia,
                'raextralocation'=>$req->raextralocation,
                'raspecialdestination'=>$req->raspecial,
                'racodcharge'=>$req->racodcharge,
                'racodchargepersent'=>$req->racodpersent
            ]);
        $req->session()->flash('status','Courier price update');
        return redirect("/courier-priceing/$req->courieridis");
    }
    public function add_rate_list()
    {
        return view('super-admin.Couriers.add-rate');
    }
    
    public function superRateList()
    {
        $param = price::where('status','defult')->get();
        return view('super-admin.rate-list.rateList',compact('param'));
    }
    public function super_admin_rate_add(Request $request)
    {
       
        // dd($request->all());
        if($request->courier == 'xpressbees_surface'){ $c_name='xpressbee0';}
        if($request->courier == 'xpressbees_Shipnick'){ $c_name='xpressbee03';}
        if($request->courier == 'xpressbees'){ $c_name='xpressbee02';}

        $query = new price();
            $query->courier_name = $request->courier;
             $query->name = $c_name;
            $query->weight = $request->weight;
            $query->fwda = $request->fwd1;
            $query->fwdb = $request->fwd2;
            $query->fwdc = $request->fwd3;
            $query->fwdd = $request->fwd4;
            $query->fwde = $request->fwd5;
            $query->fwdf = $request->fwd6;
            $query->fwdg = $request->fwd7;
            $query->fwdh = $request->fwd8;
            $query->rtoa = $request->rto1;
            $query->rtob = $request->rto2;
            $query->rtoc = $request->rto3;
            $query->rtod = $request->rto4;
            $query->rtoe = $request->rto5;
            $query->rtof = $request->rto6;
            $query->wta = $request->add1;
            $query->wtb = $request->add2;
            $query->wtc = $request->add3;
            $query->wtd = $request->add4;
            $query->wte = $request->add5;
            $query->wtf = $request->add6;
            $query->admin_id = $request->admin_id;
            
            $query->save();

            return redirect('/super-all-admin');

    }
     public function editRate($id)
    {
        $price = Price::find($id);

        if (!$price) {
            // Handle the case where the price is not found (optional)
            return redirect()->route('rate-list.index')->with('error', 'Price not found.');
        }

        return view('super-admin.rate-list.rate-edit', compact('price'));
    }
    public function updateEditRate(Request $request)
    {
        

            // dd($request->all());
            $query = price::find($request->admin_id);
            $query->fwda = $request->fwd1;
            $query->fwdb = $request->fwd2;
            $query->fwdc = $request->fwd3;
            $query->fwdd = $request->fwd4;
            $query->fwde = $request->fwd5;
            $query->fwdf = $request->fwd6;
            $query->fwdg = $request->fwd7;
            $query->fwdh = $request->fwd8;
            $query->rtoa = $request->rto1;
            $query->rtob = $request->rto2;
            $query->rtoc = $request->rto3;
            $query->rtod = $request->rto4;
            $query->rtoe = $request->rto5;
            $query->rtof = $request->rto6;
            $query->wta = $request->add1;
            $query->wtb = $request->add2;
            $query->wtc = $request->add3;
            $query->wtd = $request->add4;
            $query->wte = $request->add5;
            $query->wtf = $request->add6;
            
    
            $query->save();
    
            return redirect()->back();
        

    }
    public function RateDelete($id) 
    {
        
        
        $data = price::where('id',  $id)->delete();

        if ($data) {
            return redirect()->back()->with("success", "Delete  successsfully");
        } else {
            return redirect()->back()->with("success", "not delete  successsfully");
        }
        
    }
     public function superAdminPincode()
    {
        $pincode = PincodeFile::all();
        return view('super-admin.Pincode.pincode-all',compact('pincode')); 
    }
    public function superPicodeAdd(Request $req)
{
    $userid = session()->get('UserLogin2id');
    $username = session()->get('UserLogin2name');

    $bulkfilename = date('Y-m-d');
    $tdate = date('Y-m-d');

    if (!file_exists("PincodeExcelFiles/$bulkfilename")) {
        mkdir("PincodeExcelFiles/$bulkfilename", 0755, true);
    }

    $imgfile = $req->file('bulkpincode');

    if (is_null($imgfile) || $imgfile->getClientOriginalExtension() !== 'csv') {
        $req->session()->flash('status', 'Invalid file type. Please upload a CSV file.');
        return redirect('/UPBulk_Order');
    }

    if ($imgfile->getSize() > 10485760) { // 10 MB limit
        $req->session()->flash('status', 'File size exceeds the maximum limit of 10 MB.');
        return redirect('/UPBulk_Order');
    }

    $filename = date('dmy') . $userid . "_" . rand(1, 499) . rand(500, 999) . "." . $imgfile->getClientOriginalExtension();
    $imgfile->move("PincodeExcelFiles/$bulkfilename/", $filename);

    $filePath = "PincodeExcelFiles/$bulkfilename/$filename";
    $fileD = fopen($filePath, "r");

    $totalnooforders = 0;
    $rowData = [];

    while (($data = fgetcsv($fileD)) !== false) {
        $rowData[] = $data;
    }
    fclose($fileD);

    $totalnooforders = count($rowData);
    
    $query1 = new PincodeFile;
    $query1->folder_name = $bulkfilename;
    $query1->date = $tdate;
    $query1->total_count = $totalnooforders;
    $query1->courier = $req->courier;
    $query1->save();

    $folder_id = $query1->id;

    DB::beginTransaction();
    try {
        $sidno = 1;
        foreach ($rowData as $value) {
            $Pincode = trim($value[0]);

            $query = new BulkPincode;
            $query->pincode = $Pincode;
            $query->courier = $req->courier;
            $query->folder_id = $folder_id;
            $query->save();

            $sidno++;
        }
        DB::commit();
        $req->session()->flash('status', 'Bulk order successfully uploaded.');
    } catch (\Exception $e) {
        DB::rollback();
        // Log the error or handle it as needed
        $req->session()->flash('status', 'An error occurred while processing the bulk order.');
    }

    return redirect('super-admin-pincode');
}
    public function superAdminPincodeDelete($id)
    {
        // Find the PincodeFile record by ID
        $data = PincodeFile::find($id);
    
        // Check if the PincodeFile record exists
        if (!$data) {
            // Handle the case where the PincodeFile record does not exist
            return redirect('super-admin-pincode')->with('error', 'Pincode file not found.');
        }
    
        // Find related BulkPincode records
        $data1 = BulkPincode::where('folder_id', $id)->get();
    
        // Delete related BulkPincode records if they exist
        if ($data1->isNotEmpty()) {
            foreach ($data1 as $item) {
                $item->delete();
            }
        }
    
        // Delete the PincodeFile record
        $data->delete();
    
        // Redirect with a success message
        return redirect('super-admin-pincode')->with('success', 'Pincode file and related data deleted successfully.');
    }

     // all admin details 
     public function allAdmin()
     {
         $userid = session()->get('UserLoginid');
         $params = AdminLoginCheck::where('usertype', 'admin')
             ->where('spid', $userid)
             ->orderby('id', 'DESC')
             ->get();
 
         // Create an associative array to hold the user counts per admin
         $userCounts = [];
         foreach ($params as $param) {
             $userCounts[$param->id] = AdminLoginCheck::where('usertype', 'user')
                 ->where('crtuid', $param->id) // Filter based on the current admin's ID
                 ->count();
         }
 
         return view('super-admin.userDetails.adminList', [
             'params' => $params,
             'userCounts' => $userCounts, // Pass the user counts to the view
         ]);
     }
     // admin to user details 
     public function allAdminUser($id)
     {
         // Retrieve the current user ID from the session
         $userid = session()->get('UserLoginid');
     
         // Fetch parameters for users of type 'user' associated with the given ID
         $params = AdminLoginCheck::where('usertype', 'user')
             ->where('crtuid', $id)
             ->orderBy('id', 'DESC')
             ->get();
     
         // Initialize an empty array for limits
         $limit = [];
     
         // Populate the limit array with labelcate values indexed by param id
         foreach ($params as $param) {
             // Fetch label records based on the appropriate criterion
             $labelRecord = OrderStatusLabel::where('labelname', $param->id)->first();
     
             // Set the labelcate or default to 0
             $limit[$param->id] = $labelRecord ? $labelRecord->labelcate : 0;
         }
     
         // Return the view with the retrieved parameters and limits
         return view('super-admin.userDetails.userList', [
             'params' => $params,
             'limit' => $limit
         ]);
     }
     
 
 
 
     // super-admin add amount user to cod remmitance 
     public function userWalletLimit($id)
     {
         $userid = session()->get('UserLoginid');
 
         // Check if user is logged in
         if (!$userid) {
             return redirect()->route('login')->with('error', 'Please log in to access this page.');
         }
 
         // Retrieve user details
         $params = AdminLoginCheck::find($id);
 
         // Check if user exists
         if (!$params) {
             return redirect()->back()->with('error', 'User not found.');
         }
 
         return view('super-admin.userDetails.addUserLimit', ['params' => $params]);
     }
     public function userAddWalletLimit(Request $request, $id)
     {
 
         $limit =  OrderStatusLabel::where('labelname', $id)->first();
 
         if (isset($limit)) {
             OrderStatusLabel::where('labelname', $id)->update(['labelcate' => $request->amount]);
             return redirect()->back();
         }
 
         $wellet = new OrderStatusLabel;
         $wellet->labelname = $id;
         $wellet->labelcate = $request->amount;
         $wellet->save();
         return redirect()->back();
     }
 
     public function addUserBlance($id)
     {
         $userid = session()->get('UserLoginid');
 
         // Check if user is logged in
         if (!$userid) {
             return redirect()->route('login')->with('error', 'Please log in to access this page.');
         }
 
         // Retrieve user details
         $params = AdminLoginCheck::find($id);
 
         // Check if user exists
         if (!$params) {
             return redirect()->back()->with('error', 'User not found.');
         }
 
         return view('super-admin.userDetails.addUserBlance', ['params' => $params]);
     }
 
     public function addNewUserBlance(Request $request, $id)
     {
         $date = date('Y-m-d');
         $transactionCode = "TR00" . $request->amount;
 
         // Fetch the most recent balance record for the given user
         $blance = orderdetail::where('user_id', $id)
             ->orderBy('orderid', 'DESC')
             ->first();
 
         $close_blance = $request->amount;
 
         // Check if a balance record exists and update $close_blance accordingly
         if ($blance && isset($blance->close_blance)) {
             // Ensure close_blance is a number, default to 0 if null
             $previous_blance = $blance->close_blance ?? 0;
             $close_blance = $previous_blance + $request->amount;
         }
 
 
         // dd($transactionCode,$credit1,$awb , $close_blance,$date);
         // Create a new order detail record
         $wellet = new orderdetail;
         $wellet->credit = $request->amount;
         $wellet->awb_no = $request->Type;
         $wellet->date = $date;
         $wellet->user_id =  $id;
         $wellet->transaction = $transactionCode;
         $wellet->close_blance = $close_blance;
         $wellet->description = $request->description;
 
         $wellet->save();
         return redirect()->back();
     }



}

