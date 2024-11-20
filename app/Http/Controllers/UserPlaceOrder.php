<?php

namespace App\Http\Controllers;

use App\Helper\UtilityHelper;
use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\Allusers;
use App\Models\CourierApiDetail;
use App\Models\Hubs;
use App\Models\OrdersStatus;
use App\Models\CourierNames;
use App\Models\bulkorders;
use App\Models\bulkordersfile;
use DB;
use Excel;
use \Milon\Barcode\DNS1D;
use App\Models\smartship;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Pincode;
use App\Models\price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Jobs\UploadOrder;
use App\Jobs\cancelordersProcess;
use Illuminate\Support\Facades\Artisan;

class UserPlaceOrder extends Controller
{

    public function updateZone()
    {
        // Fetch bulk orders with the necessary details
        $orders = bulkorders::whereNull('zone')
            ->orderBy('Single_Order_Id', 'DESC')
            //  ->where('zone','!=','')
            ->limit(2000)
            // ->select('Awb_Number', 'Pincode', 'pickup_pincode')
            ->get();

        // dd($orders);

        // Initialize an array for bulk updates
        $updates = [];

        foreach ($orders as $order) {
            $custmpincode = $order->Pincode;
            $pickuppincode = $order->pickup_pincode;
            $awb = $order->Awb_Number;

            // Fetch pincode details with a single query if possible
            $pincode1 = Pincode::where('pincode', $custmpincode)->first();
            $pincode2 = Pincode::where('pincode', $pickuppincode)->first();

            if ($pincode1 && $pincode2) {
                // Determine the zone
                $zone = $this->determineZone($pincode1, $pincode2);
            } else {
                $zone = "D"; // Default zone if pincode details are missing
            }

            // Store update information
            $updates[] = [
                'Awb_Number' => $awb,
                'zone' => $zone,
            ];
        }

        // Bulk update the zones
        foreach ($updates as $update) {
            bulkorders::where('Awb_Number', $update['Awb_Number'])
                ->update(['zone' => $update['zone']]);
        }

        echo "Zones updated successfully.";
    }


    private function determineZone($pincode1, $pincode2)
    {
        $cities = ["DELHI", "Mumbai", "BANGALORE", "AHMEDABAD"];
        $specialStates = ["JAMMU AND KASHMIR", "LADAKH", "HIMACHAL PRADESH", "KERALA", "ANDAMAN AND NICOBAR"];

        if (in_array($pincode1->city, $cities) && in_array($pincode2->city, $cities)) {
            return "C";
        }

        if ($pincode1->city == $pincode2->city) {
            return "A";
        }

        if (in_array($pincode1->state, $specialStates) && in_array($pincode2->state, $specialStates)) {
            return "E";
        }

        if ($pincode1->state == $pincode2->state) {
            return "B";
        }

        return "D";
    }

    public function wallterTranstion()
    {
        // $cfromdateObj1 = Carbon::now()->startOfMonth();
        // $ctodateObj1 = Carbon::now()->endOfMonth();

        $params = bulkorders::whereNotNull('zone')
            // ->where('User_Id', '122')
            // ->whereNull('shferrors')
            ->where('shferrors', '!=', '1')
            ->where('order_cancel', '!=', '1')
            // ->whereBetween('Last_Time_Stamp', [$cfromdateObj1, $ctodateObj1])
            ->orderBy('Single_Order_Id', 'ASC')
            ->limit(1000)
            ->select('Awb_Number', 'zone', 'awb_gen_by', 'User_Id', 'Single_Order_Id', 'Rec_Time_Date')
            ->get();

        // Debugging output (consider removing or commenting out in production)
        // dd($params);

        foreach ($params as $param) {
            $zone = $param->zone;
            $userid = $param->User_Id;
            echo $courier = $param->awb_gen_by;
            $awb = $param->Awb_Number;
            $idnew = $param->Single_Order_Id;
            $date = $param->Rec_Time_Date;
            bulkorders::where('Awb_Number', $awb)->update(['shferrors' => 1]);

            // Fetch credit details
            $credit = price::where('user_id', $userid)
                ->where('name', $courier)
                ->first();

            if (!$credit) {
                $credit = price::where('status', 'defult')
                    ->where('name', $courier)
                    ->first();
                // Handle the case where no credit record is found
                // Log an error, skip this record, etc.
                // continue;
            }
            $credit1 = 0;
            // Assign credit based on zone
            if ($zone == 'A') {
                $credit1 = $credit->fwda;
            }
            if ($zone == 'B') {
                $credit1 = $credit->fwdb;
            }
            if ($zone == 'C') {
                $credit1 = $credit->fwdc;
            }
            if ($zone == 'D') {
                $credit1 = $credit->fwdd;
            }
            if ($zone == 'E') {
                $credit1 = $credit->fwde;
            }

            $transactionCode = "TR00" . $idnew;


            // Fetch the most recent balance record for the given user
            $blance = orderdetail::where('user_id', $userid)
                ->orderBy('orderid', 'DESC')
                ->first();

            // Initialize $close_blance with $credit1
            $close_blance = -$credit1;

            // Check if a balance record exists and update $close_blance accordingly
            if ($blance && isset($blance->close_blance)) {
                // Ensure close_blance is a number, default to 0 if null
                $previous_blance = $blance->close_blance ?? 0;
                $close_blance = $previous_blance - $credit1;
            }
            // dd($transactionCode,$credit1,$awb , $close_blance,$date);
            // Create a new order detail record
            $wellet = new orderdetail;
            $wellet->debit = $credit1;
            $wellet->awb_no = $awb;
            $wellet->date = $date;
            $wellet->user_id =  $userid;
            $wellet->transaction = $transactionCode;
            $wellet->close_blance = $close_blance;
            $wellet->save();

            bulkorders::where('Awb_Number', $awb)->update(['shferrors' => 1]);
        }

        // Consider adding logging or additional actions after processing
    }


    // Single Orders
    public function SingleOrder()
    {
        $userid = session()->get('UserLogin2id');
        $allriders = Allusers::where('usertype', 'rider')->where('status', '1')->get();
        $tdate = date('Y-m-d');
        $Hubs = Hubs::where('hub_created_by', $userid)->get();
        $params = bulkorders::where('User_Id', $userid)
            ->where('uploadtype', 'Single')
            ->where('Rec_Time_Date', $tdate)
            ->orderby('Single_Order_Id', 'desc')
            ->get();
        $courierapids = CourierApiDetail::all();
        return view('UserPanel.PlaceOrder.SingleOrderBook', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }
    public function Transit_orders()
    {
        $userid = session()->get('UserLogin2id');
        // $allriders = Allusers::where('usertype','rider')->where('status','1')->get();
        $cfromdate = date('Y-m-d');
        $ctodate = date('Y-m-d');
        $tdate = date('Y-m-d');
        $Hubs = Hubs::where('hub_created_by', $userid)->get();
        $params = bulkorders::where('User_Id', $userid)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->orderBy('Single_Order_Id', 'DESC')
            ->select('Awb_Number', 'ordernoapi', 'Last_Time_Stamp', 'Name', 'Mobile', 'Address', 'awb_gen_by', 'showerrors', 'Order_Type')
            ->paginate(50);
        // dd($params);
        $courierapids = CourierApiDetail::all();
        return view('UserPanel.PlaceOrder.Intargosorders', ['params' => $params, 'Hubs' => $Hubs, 'courierapids' => $courierapids, 'cfromdate' => $cfromdate, 'ctodate' => $ctodate]);
    }
    public function Transit_ordersFilter(Request $req)
    {
        // dd($req->all());
        $userid = session()->get('UserLogin2id');

        // Convert date range inputs to Carbon objects
        $cfromdateObj = Carbon::parse($req->from)->startOfDay(); // Start of the day for $cfromdate
        $ctodateObj = Carbon::parse($req->to)->endOfDay(); // End of the day for $ctodate

        // Query using Laravel Eloquent
        $params = bulkorders::where('User_Id', $userid)
            ->where('order_cancel', '!=', '1')
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            // ->where('showerrors',['in transit','Connected','Ready for Connection','In-Transit','intranit'])
            ->orderBy('Single_Order_Id', 'desc')
            ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj]);

        // Apply additional filters based on request parameters
        if (!empty($req->order_type)) {
            $params->where('Order_Type', 'like', '%' . $req->order_type . '%');
        }
        if (!empty($req->product_name)) {
            $params->where('Item_Name', $req->product_name);
        }
        if (!empty($req->awb)) {
            $params->Where('Awb_Number',  $req->awb);
        }
        if (!empty($req->courier)) {
            $params->Where('awb_gen_by', 'like', '%' . $req->courier . '%');
        }
        $params = $params->paginate(3000);

        // Debugging: Output the params
        // dd($params); 

        // Retrieve additional data and return the view
        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allusers = Allusers::where('usertype', 'user')->get();
        return view('UserPanel.PlaceOrder.Intargosorders', [
            'params' => $params,
            'Hubs' => $Hubs,
            'allusers' => $allusers,
            'courierapids' => $courierapids,
            'cfromdate' => $req->from, // Pass original date inputs for display
            'ctodate' => $req->to
        ]);
    }

    public function SingleOrderFilter(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        // if(!empty($req->from)){     $cfromdate = date('Y-m-d',strtotime($req->from));         }
        // if(!empty($req->to)){       $ctodate = date('Y-m-d',strtotime($req->to));             }
        $tdate = date('Y-m-d');
        $paramsone = bulkorders::where('User_Id', $userid)
            ->where('uploadtype', 'Single')
            ->where('Rec_Time_Date', $tdate);
        if ($req->mode) {
            $paramsone->where('Order_Type', $req->mode);
        }
        if ($req->hubid) {
            $paramsone->where('pickup_id', $req->hubid);
        }
        // if(!empty($cfromdate) AND !empty($ctodate)){    
        // $paramsone->whereBetween('Rec_Time_Date', array($cfromdate,$ctodate));  }

        $paramsone->orderby('Single_Order_Id', 'desc');
        $params = $paramsone->get();

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allriders = Allusers::where('usertype', 'rider')->get();
        return view('UserPanel.PlaceOrder.SingleOrderBook', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }


    public function SingleOrderBook()
    {
        $userid = session()->get('UserLogin2id');
        $allriders = Allusers::where('usertype', 'rider')->where('status', '1')->get();
        $tdate = date('Y-m-d');
        $Hubs = Hubs::where('hub_created_by', $userid)->get();
        $params = bulkorders::where('User_Id', $userid)
            ->where('uploadtype', 'Single')
            ->where('Rec_Time_Date', $tdate)
            ->orderby('Single_Order_Id', 'desc')
            ->get();
        $courierapids = CourierApiDetail::all();
        return view('UserPanel.PlaceOrder.SingleOrderBook', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }
    public function Hubdetails(Request $req)
    {
        // echo "abc";
        $details = Hubs::where('hub_id', $req->hubid)->first();
        return view('UserPanel.PlaceOrder.SelectedHubShow', ['details' => $details]);
    }



    public function SingleOrderAdd(Request $req)
    {
        // error_reporting(1);
        // return $req->input();
        $username = session()->get('UserLogin2name');
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d');

        $errorstatus = "Upload";
        $apistatus = 0;

        // echo $userid;
        try {
            // Hub id
            $Hubs = Hubs::where('hub_id', $req->hubid)->first();
            $hubalternateid = $Hubs['hub_id'];
            $hubname = $Hubs['hub_name'];
            $hubmobile = $Hubs['hub_mobile'];
            $hubpincode = $Hubs['hub_pincode'];
            $hubgstno = $Hubs['hub_gstno'];
            $hubaddress = $Hubs['hub_address1'];
            $hubstate = $Hubs['hub_state'];
            $hubcity = $Hubs['hub_city'];
            // Hub id

            /*
    // Check API Active Or Not
    $checkuser = Allusers::where('id',$userid)->first();
    if($checkuser->Nimbus==0 AND $checkuser->Intargos==0){
        $errorstatus = "Contact Shipdart";
        $apistatus = 1;
    }
    // Check API Active Or Not
*/

            $query = new bulkorders;
            $query->orderno = $req->orderno;
            $query->Order_Type = $req->courierType;
            $query->User_Id = $userid;
            $query->Awb_Number = '';
            $query->Name = $req->cname;
            $query->Address = $req->caddress;
            $query->State = $req->cstate;
            $query->City = $req->ccity;
            $query->Mobile = $req->cmobile;
            $query->Pincode = $req->cpin;



            $query->Item_Name = $req->itemName;
            $query->Quantity = $req->quantity;
            $query->Width = $req->breadth;
            $query->Height = $req->height;
            $query->Length = $req->lenth;
            $query->Actual_Weight = $req->actualWeight;
            $brthcm = $req->breadth;
            $hethcm = $req->height;
            $lnthcm = $req->lenth;
            $volwt = ($brthcm * $hethcm * $lnthcm) / 5000;
            $query->volumetric_weight = $volwt;
            $query->Total_Amount = $req->totalAmount;
            $query->Invoice_Value = $req->invoiceValue;
            $query->Cod_Amount = $req->codAmount;
            $query->additionaltype = $req->additionalDetails;

            $query->Rec_Time_Stamp = $tdate;
            $query->Rec_Time_Date = $tdate;
            $query->uploadtype = 'Single';

            $query->pickup_id = $req->hubid;
            $query->Address_Id = $hubalternateid;
            $query->pickup_name = $hubname;
            $query->pickup_mobile = $hubmobile;
            $query->pickup_pincode = $hubpincode;
            $query->pickup_gstin = $hubgstno;
            $query->pickup_address = $hubaddress;
            $query->pickup_state = $hubstate;
            $query->pickup_city = $hubcity;

            $query->order_status = 'Upload';
            $query->order_status1 = 'Upload';
            $query->order_status_show = 'Upload';
            $query->apihitornot = $apistatus;
            $query->showerrors = $errorstatus;
            $query->save();
            $last_id = $query->id;

            $ordernois = "SDRT00" . $last_id;
            bulkorders::where('Single_Order_Id', $last_id)->update(['ordernoapi' => $ordernois]);



            /*
        $query = new orderdetail;
        // $query->orderno = $req->orderno;
        $query->hub_id = $req->hubid;
        $query->hub_name = $hubname;
        $query->lenth = $req->lenth;
        $query->breadth = $req->breadth;
        $query->height = $req->height;

        $query->cname = $req->cname;
        $query->cmobile = $req->cmobile;
        $query->cemail = $req->cemail;
        $query->caddress = $req->caddress;
        $query->cstate = $req->cstate;
        $query->ccity = $req->ccity;
        $query->cpin = $req->cpin;

        $query->itemname = $req->ItemName;
        $query->itemquantity = $req->Quantity;
        $query->itmecodamt = $req->CODAmount;
        $query->iteminvoicevalue = $req->InvoiceValue;
        $query->pweight = $req->ActualWeight;
        $query->ptamt = $req->TotalAmount;
        $query->additionaldetails = $req->AdditionalDetails;

        $query->orderdata = date('Y-m-d');
        $query->order_status = "Upload";
        $query->order_upload_type = "Single Type";
        $query->order_userid = $userid;
        $query->order_username = $username;
        $query->save();
        $last_id = $query->id;
        $ordernois = "LGST0".$last_id;
        orderdetail::where('orderid',$last_id)->update(['orderno'=>$ordernois]);
        */
            $req->session()->flash('status', 'Order Details Added');
            // Perform background URL hit
            Artisan::call('spnk:place-order');
            return redirect('/UPSingle_Product');
        } catch (\Exception $e) {
            $req->session()->flash('status', 'Not Added');
            return redirect('/UPSingle_Product');
        }
    }





























    public function SingleOrderUpdate(Request $req)
    {
        // return $req->input();
        $username = session()->get('UserLogin2name');
        $userid = session()->get('UserLogin2id');
        // echo $userid;
        try {
            // $crtorderdetails = orderdetail::where('orderid',$req->)->first();
            $last_id = $req->crtid;

            if ($req->couriertype) {  // IF Courier Selected
                $defaultno = 1000;
                $orderuid = $defaultno + $last_id;
                $d1 = date("d");
                $m1 = date("m");
                $y1 = date("y");
                $awbno = "SL" . $y1 . $m1 . $d1 . $orderuid;
                $params = orderdetail::where('orderid', $last_id)
                    ->update([
                        'awb_no' => $awbno,
                        'order_status' => "Progress",
                        'courier_name' => $req->couriertype,
                        'order_start_date' => date('Y-m-d'),
                    ]);
            }   // IF Courier Selected
            $req->session()->flash('status', 'Order Shipped Successfully');
            // return redirect('/UPSingle_Product');
            return redirect()->back();
        } catch (\Exception $e) {
            $req->session()->flash('status', 'Order Not Shipped');
            // return redirect('/UPSingle_Product');
            return redirect()->back();
        }
    }


    public function SingleOrderDelete1(Request $req, $id)
    {
        // error_reporting(1);
        echo $tdateare = date('Y-m-d');
        $tdateis = "";
        $cancelint = "";
        $cancelstatus = "";
        $cancelreason = "";



        $couriername = bulkorders::where('Awb_Number', $id)->first();
        $courierare = $couriername['awb_gen_courier'];
        if ($courierare == "Nimbus") {
            // Nimbus Cancel API
            // Token Generate
            $nimbustoken = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
                CURLOPT_HTTPHEADER => array(
                    'content-type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            $responseic = json_decode($response, true);
            curl_close($curl);
            // print_r($responseic);
            $statuscheck = $responseic['status'];
            if ($statuscheck == true) {
                $nimbustoken = $responseic['data'];
                $nimbustoken = trim($nimbustoken);
            }
            // Token Generate
            // Cancel Order
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments/cancel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "awb" : "' . $id . '"
        }',
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $nimbustoken"
                ),
            ));

            $response = curl_exec($curl);
            $responseic = json_decode($response, true);
            curl_close($curl);
            $statuscheck = $responseic['status'];
            if ($statuscheck == true) {
                // echo $responseic['message'];
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order delete please refresh page if not deleted";
            } elseif ($statuscheck == false) {
                // echo $responseic['message'];
                $alertmsg = "Order Not Delete Please Try Again";
            }
            // Cancel Order
            // Nimbus Cancel API    
        } elseif ($courierare == "Intargos") {
            // Intartos Cancel API
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.intargos.com/api/CancelOrder',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "waybill": "' . $id . '",
        "reason": "Order Cancelled by user"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
                    'Cookie: ci_session=178044942b4923fe165418b8cd3ec1c9b5acf6e1'
                ),
            ));

            $responseic = curl_exec($curl);
            $responseic = json_decode($responseic, true);
            curl_close($curl);

            // print_r($responseic);
            // echo "<br><br>";
            $status = $responseic['status'];
            // echo "<br>";
            // echo $responsemsg = $responseic['response'];
            if ($status == "true") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
            } else {
                $alertmsg = "Order Not Delete Please Try Again";
            }
            // Intartos Cancel API
        } elseif ($courierare == "Ecom") {
            // Ecom Cancel API


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/cancel_awb/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('username' => 'ARTUINFOTECH898811', 'password' => '8y1LK5ileM', 'awbs' => $id),
            ));
            $responseecom = curl_exec($curl);
            $responseecom = json_decode($responseecom, true);
            curl_close($curl);
            // echo $response;


            $status = $responseecom[0]['success'];

            if ($status == "true") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
            } else {
                $alertmsg = "Order Not Delete Please Try Again";
            }
            // Ecom Cancel API

        } elseif ($courierare == "Shadowfax") {
            // Shadowfax Cancel API

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://dale.shadowfax.in/api/v3/clients/orders/cancel/?format=json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{ 
    "request_id": "' . $id . '",
    "cancel_remarks ": "Request cancelled by customer"
  }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Token f44802ba6296dacd9c548887f621debd7d5091cd'
                ),
            ));


            $responsesfx = curl_exec($curl);
            $responsesfx = json_decode($responsesfx, true);
            curl_close($curl);
            // echo $response;

            if ($responsesfx['responseCode'] == "200") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
            } else {
                $alertmsg = "Order Not Delete Please Try Again";
            }
            // Shadowfax Cancel API
        }





        /*
    // Temperory Only
        $tdateis = $tdateare;
        $cancelint = 1;
        $cancelstatus = "Cancel";
        $cancelreason = "Client Cancel";
        $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
    // Temperory Only
*/

        bulkorders::where('Awb_Number', $id)
            ->update([
                'order_cancel' => $cancelint,
                // 'canceldate'=>$tdateis,
                'order_status_show' => $cancelstatus,
                'order_cancel_reasion' => $cancelreason
            ]);
        $req->session()->flash('status', $alertmsg);
        return redirect('/UPSingle_Product');
    }

    // Single Orders











































    // Bulk Orders
    public function BulkOrder()
    {
        $Hubs = Hubs::all();
        $userid = session()->get('UserLogin2id');
        $allriders = Allusers::where('usertype', 'rider')->where('status', '1')->get();
        $params = orderdetail::where('order_userid', $userid)
            ->where('order_upload_type', 'Bulk Type')
            ->where('order_status', '!=', 'Cancel')
            ->orderby('orderid', 'desc')
            ->get();
        $courierapids = CourierApiDetail::all();
        return view('UserPanel.PlaceOrder.BulkOrder', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }















    public function BulkOrder1()
    {
        $userid = session()->get('UserLogin2id');
        $allriders = Allusers::where('usertype', 'rider')->where('status', '1')->get();
        $tdate = date('Y-m-d');
        $Hubs = Hubs::where('hub_created_by', $userid)->get();
        $params = Hubs::where('hub_created_by', $userid)->orderby('hub_id', 'DESC')->get();
        $courierapids = CourierApiDetail::all();
        return view('UserPanel.PlaceOrder.BulkOrder', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }
    public function BulkOrder1Filter(Request $req)
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d');
        $paramsone = bulkorders::where('User_Id', $userid)
            ->where('uploadtype', 'Excel')
            ->where('Rec_Time_Date', $tdate);
        if ($req->mode) {
            $paramsone->where('Order_Type', $req->mode);
        }
        if ($req->courier) {
            $paramsone->where('pickup_id', $req->courier);
        }

        $paramsone->orderby('Single_Order_Id', 'desc');
        $params = $paramsone->get();

        $Hubs = Hubs::all();
        $courierapids = CourierApiDetail::all();
        $allriders = Allusers::where('usertype', 'rider')->get();
        return view('UserPanel.PlaceOrder.BulkOrder', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }



    public function BulkOrderAjax1()
    {
        $Hubs = Hubs::all();
        $userid = session()->get('UserLogin2id');
        $allriders = Allusers::where('usertype', 'rider')->where('status', '1')->get();
        $tdate = date('Y-m-d');
        $params = bulkorders::where('User_Id', $userid)
            ->where('uploadtype', 'Excel')
            ->where('Rec_Time_Date', $tdate)
            ->orderby('Single_Order_Id', 'desc')
            ->get();
        $courierapids = CourierApiDetail::all();
        return view('UserPanel.PlaceOrder.BulkOrderAjax', ['params' => $params, 'allriders' => $allriders, 'Hubs' => $Hubs, 'courierapids' => $courierapids]);
    }





    public function BulkOrderAdd1(Request $req)
    {
        error_reporting(1);
        $filestatus = 0;
        $errorlineno = 0;
        $userid = session()->get('UserLogin2id');
        $username = session()->get('UserLogin2name');
        //  File Name
        $bulkfilename = date('Y-m-d');
        $tdate = date('Y-m-d');
        if (!file_exists("BulkExcelFiles/$bulkfilename")) {
            mkdir("BulkExcelFiles/$bulkfilename");
        }
        $imgfile = $req->file('bulkorders');
        if (is_null($imgfile)) {
            // echo "1";
            $req->session()->flash('status', 'Bulk Order Not Uploaded');
            return redirect('/UPBulk_Order');
        } else {

            $fileextention = $imgfile->getClientOriginalExtension();
            $fa = date('dmy');
            $fb = $userid;
            $fc = "_";
            $randno1 = rand(1, 499);
            $randno2 = rand(500, 999);
            $img = $fa . $fb . $fc . $randno1 . $randno2 . "." . $fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("BulkExcelFiles/$bulkfilename/", $img);
            // echo "2";


            $totalnooforders = 0;
            // Read File
            $fileD = fopen("BulkExcelFiles/$bulkfilename/$img", "r");
            // $fileD = fopen('sample.csv',"r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }

            $totalnooforders = count($rowData);
            $query1 = new bulkordersfile;
            $query1->foldername = $bulkfilename;
            $query1->filename = $img;
            $query1->uploaddate = $tdate;
            $query1->uploaddatetime = $tdate;
            $query1->uploadby = $userid;
            $query1->uploadid = $userid;
            $query1->uploadusercate = "User";
            $query1->totalnooforders = $totalnooforders;
            $query1->apihitornot = 1;
            $query1->save();
            $singleuploadorderd = $query1->id;


            // -    *   -   *   -*  -   *   -   *   -   *
            $sidno = 1;
            $endsidno = 0;
            $status = "0";


            foreach ($rowData as $key => $value) {




                $endsidno = $sidno;


                $orderid = preg_replace('/[^A-Za-z0-9 .]/', '', $value[0]);
                // $custmname =  trim($value[1]);
                $custmname = preg_replace('/[^A-Za-z0-9 .]/', '', $value[1]);
                // $custmaddress = trim($value[2]);
                $custmaddress = preg_replace('/[^A-Za-z0-9 .\/]/', '', $value[2]);
                $custmaddress2 = preg_replace('/[^A-Za-z0-9 ]/', '', $value[3]);


                // $custmaddress2 = trim($value[3]);
                $custmcity = preg_replace('/[^A-Za-z0-9 ]/', '', $value[4]);
                $custmstate = preg_replace('/[^A-Za-z0-9 ]/', '', $value[5]);
                // $custmcity = trim($value[4]);
                // $custmstate = trim($value[5]);
                // echo $custmaddress = preg_replace('/[^A-Za-z0-9 ]/', '', $value[5]);
                $custmpincode = preg_replace('/[^0-9]/', '', $value[6]);

                $cleanMobile = Str::of($value[7])->replace([' ', '-', '_', '+', '+91'], '');

                $cleanMobile2 = Str::of($value[8])->replace([' ', '-', '_', '+', '+91'], '');
                $cleanemail = trim($value[9]);

                $custmmobile = trim($cleanMobile);
                $prodname = trim($value[10]);
                $prodqlty = trim($value[11]);
                $productvalue = trim($value[12]);
                $Productsku = preg_replace('/[^A-Za-z0-9 ]/', '', $value[13]);
                $paymentmode = (strtolower($value[14]) === 'cod') ? 'COD' : 'Prepaid';
                // $paymentmode = strtoupper(trim($value[10]));



                $prodcodamt = trim($value[15]);
                $prodweight = trim($value[16]);
                $prodlength = trim($value[17]);
                $prodbreadth = trim($value[18]);
                $prodheight = trim($value[19]);
                $prodinvoiceamt = trim($value[20]);
                $prodtotalamt = trim($value[21]);
                $hub_code = trim($value[22]);
                $errorstatus = "Upload";
                $apistatus = 0;

                $pickupid = '0';
                $pickuphubname = '';
                $pickupmobile = '';
                $pickuppincode = '';
                $pickupaddress = '';
                $pickupstate = '';
                $pickupcity = '';

                // Check API Active Or Not
                $checkuser = Allusers::where('id', $userid)->first();


                // Check API Active Or Not

                if ($custmname == "") {
                    continue;
                }
                //   if($sidno==16){
                //     $endsidno = 16;
                //     $status = "2";
                //     break;
                //   }

                // if ($custmmobile == 0) {
                //     $errorlineno = $sidno;
                //     $filestatus = 1;
                //     break;
                // }

                // if ($custmpincode == 0) {
                //     $errorlineno = $sidno;
                //     $filestatus = 1;
                //     break;
                // }

                // if ($prodtotalamt == 0) {
                //     $errorlineno = $sidno;
                //     $filestatus = 1;
                //     break;
                // } 

                $hubexists = Hubs::where('hub_code', $hub_code)->where('hub_created_by', $userid)->orderby('hub_id', 'desc')->count();
                if ($hubexists > 0) {
                    $hubdetails = Hubs::where('hub_code', $hub_code)->orderby('hub_id', 'desc')->first();

                    $pickupid = $hubdetails['hub_id'];
                    $pickuphubname = $hubdetails['hub_name'];
                    $pickupmobile = $hubdetails['hub_mobile'];
                    $pickuppincode = $hubdetails['hub_pincode'];
                    $pickupaddress = $hubdetails['hub_address1'];
                    $pickupstate = $hubdetails['hub_state'];
                    $pickupcity = $hubdetails['hub_city'];
                } else {
                    $errorstatus = "Invalid Hub ID";
                    $apistatus = 1;
                }
                // find a zone to pincode start
                $pincode1 = Pincode::where('pincode', $custmpincode)->first();
                $pincode2 = Pincode::where('pincode', $pickuppincode)->first();

                if ($pincode1 && $pincode2) {
                    // Determine the zone
                    $zone = $this->determineZone($pincode1, $pincode2);
                } else {
                    $zone = "D"; // Default zone if pincode details are missing
                }
                // end find zone 

                $query = new bulkorders;
                $query->orderno = UtilityHelper::sanitize($orderid);
                $query->Order_Type = UtilityHelper::sanitize($paymentmode);
                $query->User_Id = $userid;
                $query->Awb_Number = '';
                $query->Name = UtilityHelper::sanitize($custmname);
                $query->Address = UtilityHelper::sanitize($custmaddress);
                $query->Address2 = UtilityHelper::sanitize($custmaddress2);
                $query->State = UtilityHelper::sanitize($custmstate);
                $query->City = UtilityHelper::sanitize($custmcity);
                $query->Mobile = UtilityHelper::sanitize($custmmobile);
                $query->Pincode = UtilityHelper::sanitize($custmpincode);
                $query->sku = UtilityHelper::sanitize($Productsku);
                $query->Item_Name = UtilityHelper::sanitize($prodname);
                $query->Quantity = UtilityHelper::sanitize($prodqlty);
                $query->Width = $prodbreadth;
                $query->Height = $prodheight;
                $query->Length = $prodlength;
                $query->Actual_Weight = $prodweight;

                $volwt = ($prodbreadth * $prodheight * $prodlength) / 5000;
                $query->volumetric_weight = UtilityHelper::sanitize($volwt);

                $query->Total_Amount = UtilityHelper::sanitize($prodtotalamt);
                $query->Invoice_Value = UtilityHelper::sanitize($prodinvoiceamt);
                $query->Cod_Amount = UtilityHelper::sanitize($prodcodamt);
                $query->Rec_Time_Stamp = UtilityHelper::sanitize($tdate);
                $query->Rec_Time_Date = UtilityHelper::sanitize($tdate);
                $query->uploadtype = 'Excel';
                $query->pickup_id = UtilityHelper::sanitize($pickupid);
                $query->Address_Id = UtilityHelper::sanitize($pickupid);
                $query->pickup_name = UtilityHelper::sanitize($pickuphubname);
                $query->pickup_mobile = UtilityHelper::sanitize($pickupmobile);
                $query->pickup_pincode = UtilityHelper::sanitize($pickuppincode);
                $query->pickup_address = UtilityHelper::sanitize($pickupaddress);
                $query->pickup_state = UtilityHelper::sanitize($pickupstate);
                $query->pickup_city = UtilityHelper::sanitize($pickupcity);
                $query->order_status = 'Upload';
                $query->order_status1 = 'Upload';
                $query->order_status_show = 'Upload';
                $query->apihitornot = UtilityHelper::sanitize($apistatus);
                $query->showerrors = UtilityHelper::sanitize($errorstatus);
                $query->zone = UtilityHelper::sanitize($zone);
                $query->save();
                $last_id = $query->id;

                $ordernois = "SDRT00" . $last_id;
                bulkorders::where('Single_Order_Id', $last_id)->update(['ordernoapi' => $ordernois]);
                // echo $response;
                $sidno++;
            }

            $noof_order = $sidno - 1;




            // $apihitornotcheck = 1;
            // if($endsidno > 15){
            //   $apihitornotcheck = 0;
            // }
            // bulkordersfile::where('sparkorderid',$singleuploadorderd)->update(['startingpoint'=>0,'endingpoint'=>$endsidno,'nextstartpoint'=>$endsidno,'apihitornot'=>$apihitornotcheck]);
            //   echo $sidno;
            //  -   *   -   *   -   /*  -   /   -   /   -   
            Artisan::queue("spnk:place-order");
            if ($filestatus == 1) {
                $req->session()->flash('status', "Upto Line no " . ($errorlineno - 1) . " data saved , Error Occure Line No. : $errorlineno");
            } elseif ($status == "2") {
                $req->session()->flash('status', 'File uploaded successfully. Please wait 1min file is processing');
            } else {
                $req->session()->flash('status', 'File uploaded successfully.');
            }



            // Redirect with message
            // return redirect('/UPAll_All_Orders')->with('message', 'order upload success ' . $noof_order);

            // // Perform background URL hit
            // Http::get('https://shipnick.com/UPBulk_Order_API');

            // dispatch(function () {
            //     Http::get('https://shipnick.com/UPBulk_Order_API');


            // });

            // Redirect with success message
            // return redirect('/UPAll_Complete_Orders')->with('message', 'Order upload success ' . $noof_order);

            // Dispatch the job
            // UploadOrder::dispatch();

            // // Optionally, provide feedback or redirect
            return redirect('/booked-order')->with('message', 'Order upload success ' . $noof_order);



            // Read File
        }
        //  File Name
        $req->session()->flash('status', 'Please try again unexpected error...');
        return redirect('/UPBulk_Order');
    }
















    public function BulkOrderUpload(Request $req)
    {
        error_reporting(1);

        $bulkfilename = date('Y-m-d');
        $tdate = date('Y-m-d');


        $params = bulkordersfile::where('apihitornot', '=', '0')
            ->orderby('sparkorderid', 'asc')
            ->first();

        $sparkorderid = $params['sparkorderid'];
        $userid = $params['uploadid'];
        $bulkfilename = $params['foldername'];
        $img = $params['filename'];
        $nextstartpoint = $params['nextstartpoint'];
        $nextstartpoint = $nextstartpoint - 1;
        bulkordersfile::where('sparkorderid', $sparkorderid)->update(['apihitornot' => 1]);
        $fileD = fopen("BulkExcelFiles/$bulkfilename/$img", "r");
        // $fileD = fopen('sample.csv',"r");
        $column = fgetcsv($fileD);
        while (!feof($fileD)) {
            $rowData[] = fgetcsv($fileD);
        }

        $sidno = 0;
        $errorlineno = 0;
        $filestatus = 0;

        foreach ($rowData as $key => $value) {
            $sidno++;


            if ($nextstartpoint < $sidno) {
                $orderid = trim($value[0]);
                $custmname = trim($value[1]);
                $custmaddress = trim($value[2]);
                $custmcity = trim($value[3]);
                $custmstate = trim($value[4]);
                $custmpincode = trim($value[5]);
                $custmmobile = trim($value[6]);
                $prodname = trim($value[7]);
                $prodqlty = trim($value[8]);
                $paymentmode = trim($value[9]);
                if ($paymentmode == "PP") {
                    $paymentmode = "Prepaid";
                } else {
                    $paymentmode = "COD";
                }
                $prodcodamt = trim($value[10]);
                $prodweight = trim($value[11]);
                $prodlength = trim($value[12]);
                $prodbreadth = trim($value[13]);
                $prodheight = trim($value[14]);
                $prodinvoiceamt = trim($value[15]);
                $prodtotalamt = trim($value[16]);
                $hub_code = trim($value[17]);
                $errorstatus = "Upload";
                $apistatus = 0;


                $pickupid = '0';
                $pickuphubname = '';
                $pickupmobile = '';
                $pickuppincode = '';
                $pickupaddress = '';
                $pickupstate = '';
                $pickupcity = '';

                /*
    // Check API Active Or Not
    $checkuser = Allusers::where('id',$userid)->first();
    if($checkuser->Nimbus==0 AND $checkuser->Intargos==0){
        $errorstatus = "Contact Shipdart";
        $apistatus = 1;
    }
    // Check API Active Or Not
*/

                if ($custmmobile == 0) {
                    $errorstatus = "Invalid Mobile Number";
                    $apistatus = 1;
                }
                if ($custmpincode == 0) {
                    $errorstatus = "Invalid Pincode";
                    $apistatus = 1;
                }
                if ($prodtotalamt == 0) {
                    $errorstatus = "Invalid Total Amount";
                    $apistatus = 1;
                }

                $hubexists = Hubs::where('hub_code', $hub_code)->orderby('hub_id', 'desc')->count();
                if ($hubexists > 0) {
                    $hubdetails = Hubs::where('hub_code', $hub_code)->orderby('hub_id', 'desc')->first();

                    $pickupid = $hubdetails['hub_id'];
                    $pickuphubname = $hubdetails['hub_name'];
                    $pickupmobile = $hubdetails['hub_mobile'];
                    $pickuppincode = $hubdetails['hub_pincode'];
                    $pickupaddress = $hubdetails['hub_address1'];
                    $pickupstate = $hubdetails['hub_state'];
                    $pickupcity = $hubdetails['hub_city'];
                } else {
                    $errorstatus = "Invalid Hub ID";
                    $apistatus = 1;
                }

                if ($filestatus == 1) {
                } else {
                    $query = new bulkorders;
                    $query->orderno = $orderid;
                    $query->Order_Type = $paymentmode;
                    $query->Awb_Number = '';
                    $query->User_Id = $userid;
                    $query->Name = $custmname;
                    $query->Address = $custmaddress;
                    $query->State = $custmstate;
                    $query->City = $custmcity;
                    $query->Mobile = $custmmobile;
                    $query->Pincode = $custmpincode;
                    $query->Item_Name = $prodname;
                    $query->Quantity = $prodqlty;
                    $query->Width = $prodbreadth;
                    $query->Height = $prodheight;
                    $query->Length = $prodlength;
                    $query->Actual_Weight = $prodweight;
                    $query->Total_Amount = $prodtotalamt;
                    $query->Invoice_Value = $prodinvoiceamt;
                    $query->Cod_Amount = $prodcodamt;
                    //   $query->additionaltype = $value[14];
                    $query->Rec_Time_Stamp = $tdate;
                    $query->Rec_Time_Date = $tdate;
                    $query->uploadtype = 'Excel';
                    $query->pickup_id = $pickupid;
                    $query->Address_Id = $pickupid;
                    $query->pickup_name = $pickuphubname;
                    $query->pickup_mobile = $pickupmobile;
                    $query->pickup_pincode = $pickuppincode;
                    //   $query->pickup_gstin = $value[21];
                    $query->pickup_address = $pickupaddress;
                    $query->pickup_state = $pickupstate;
                    $query->pickup_city = $pickupcity;
                    $query->order_status = 'Upload';
                    $query->order_status1 = 'Upload';
                    $query->order_status_show = 'Upload';
                    $query->apihitornot = $apistatus;
                    $query->showerrors = $errorstatus;
                    $query->save();

                    $last_id = $query->id;
                    $ordernois = "SDRT00" . $last_id;
                    bulkorders::where('Single_Order_Id', $last_id)->update(['ordernoapi' => $ordernois]);
                }
            }
        }
        echo $sidno;
    }















    public function BulkOrderDelete1(Request $req, $id)
    {
        error_reporting(1);
        $tdateare = date('Y-m-d');
        $tdateis = "";
        $cancelint = "";
        $cancelstatus = "";
        $cancelreason = "";

        /*
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://app.intargos.com/api/CancelOrder',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "waybill": "'.$id.'",
    "reason": "Order Cancelled by user"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
    'Cookie: ci_session=178044942b4923fe165418b8cd3ec1c9b5acf6e1'
  ),
));

$responseic = curl_exec($curl);
$responseic = json_decode($responseic, true);
curl_close($curl);

// print_r($responseic);
// echo "<br><br>";
$status = $responseic['status'];
// echo "<br>";
// echo $responsemsg = $responseic['response'];
if($status == "true"){
    $tdateis = $tdateare;
    $cancelint = 1;
    $cancelstatus = "Cancel";
    $cancelreason = "Client Cancel";
    $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
}else{
    $alertmsg = "Order Not Delete Please Try Again";
}
*/

        $couriername = bulkorders::where('Awb_Number', $id)->first();
        // echo "<br>";
        $courierare = $couriername['awb_gen_courier'];
        // echo "<br>";

        if ($courierare == "Nimbus") {
            // Nimbus Cancel API
            // Token Generate
            $nimbustoken = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.nimbuspost.com/v1/users/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "email": "shipdart27@gmail.com",
                "password": "Shipd@rt123"
            }',
                CURLOPT_HTTPHEADER => array(
                    'content-type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            $responseic = json_decode($response, true);
            curl_close($curl);
            // print_r($responseic);
            $statuscheck = $responseic['status'];
            if ($statuscheck == true) {
                $nimbustoken = $responseic['data'];
                $nimbustoken = trim($nimbustoken);
            }
            // Token Generate
            // echo "<br>";
            //     print_r($nimbustoken);
            // echo "<br>";
            // Cancel Order
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.nimbuspost.com/v1/shipments/cancel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "awb" : "' . $id . '"
        }',
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $nimbustoken"
                ),
            ));

            $response = curl_exec($curl);
            $responseic = json_decode($response, true);
            curl_close($curl);

            // echo "<br> 2. : ";
            //     print_r($responseic);
            // echo "<br>";

            $statuscheck = $responseic['status'];
            if ($statuscheck == true) {
                // echo $responseic['message'];
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order delete please refresh page if not deleted";
            } elseif ($statuscheck == false) {
                // echo $responseic['message'];
                $alertmsg = "Order not delete please try again";
            }
            // Cancel Order
            // Nimbus Cancel API    
        } elseif ($courierare == "Intargos") {
            // Intartos Cancel API
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.intargos.com/api/CancelOrder',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "waybill": "' . $id . '",
        "reason": "Order Cancelled by user"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'signature: I5XLHC1DOEZNUBMZ7GQ2FAIXB9FVY8',
                    'Cookie: ci_session=178044942b4923fe165418b8cd3ec1c9b5acf6e1'
                ),
            ));

            $responseic = curl_exec($curl);
            $responseic = json_decode($responseic, true);
            curl_close($curl);

            // print_r($responseic);
            // echo "<br><br>";
            $status = $responseic['status'];
            // echo "<br>";
            // echo $responsemsg = $responseic['response'];
            if ($status == "true") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order delete please refresh page if not deleted";
            } else {
                $alertmsg = "Order not delete please try again";
            }
            // Intartos Cancel API
        } elseif ($courierare == "Intargos1") {
            // Intartos1 Cancel API
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://app.intargos.com/api/CancelOrder',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
        "waybill": "' . $id . '",
        "reason": "Order Cancelled by user"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'signature: SW8EBDO64AZYQKPTU15FZRGV0IWVH7'
                ),
            ));

            $responseic = curl_exec($curl);
            $responseic = json_decode($responseic, true);
            curl_close($curl);

            // print_r($responseic);
            // echo "<br><br>";
            $status = $responseic['status'];
            // echo "<br>";
            // echo $responsemsg = $responseic['response'];
            if ($status == "true") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order delete please refresh page if not deleted";
            } else {
                $alertmsg = "Order not delete please try again";
            }
            // Intartos1 Cancel API
        } elseif ($courierare == "Ecom") {
            // Ecom Cancel API


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.ecomexpress.in/apiv2/cancel_awb/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('username' => 'ARTUINFOTECH898811', 'password' => '8y1LK5ileM', 'awbs' => $id),
            ));
            $responseecom = curl_exec($curl);
            $responseecom = json_decode($responseecom, true);
            curl_close($curl);
            // echo $response;


            $status = $responseecom[0]['success'];

            if ($status == "true") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
            } else {
                $alertmsg = "Order Not Delete Please Try Again";
            }
            // Ecom Cancel API
        } elseif ($courierare == "Shadowfax") {
            // Shadowfax Cancel API

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://dale.shadowfax.in/api/v3/clients/orders/cancel/?format=json',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{ 
    "request_id": "' . $id . '",
    "cancel_remarks ": "Request cancelled by customer"
  }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Token f44802ba6296dacd9c548887f621debd7d5091cd'
                ),
            ));


            $responsesfx = curl_exec($curl);
            $responsesfx = json_decode($responsesfx, true);
            curl_close($curl);
            // echo $response;

            if ($responsesfx['responseCode'] == "200") {
                $tdateis = $tdateare;
                $cancelint = 1;
                $cancelstatus = "Cancel";
                $cancelreason = "Client Cancel";
                $alertmsg = "Order Delete Please Refresh Page If Not Deleted";
            } else {
                $alertmsg = "Order Not Delete Please Try Again";
            }
            // Shadowfax Cancel API
        }





        // 

        // 


        /*
// Temperay only
    $tdateis = $tdateare;
    $cancelint = 1;
    $cancelstatus = "Cancel";
    $cancelreason = "Client Cancel";
    $alertmsg = "Order delete please refresh page if not deleted";
// Temperay only
*/

        // exit();

        bulkorders::where('Awb_Number', $id)
            ->update([
                'order_cancel' => $cancelint,
                // 'canceldate'=>$tdateis,
                'order_status_show' => $cancelstatus,
                'order_cancel_reasion' => $cancelreason
            ]);
        $req->session()->flash('status', $alertmsg);
        return redirect('/UPBulk_Order');



        /*
      }elseif($response['status']=='2'){
        $req->session()->flash('status','Unexpected Error | Please Try Again');
        return redirect('/UPBulk_Order');
      }else{
        $req->session()->flash('status','Please Try Again');
        return redirect('/UPBulk_Order');
      }
      // echo $response;
      */
    }














    // Multiple Checkbox Select Orders
    public function MultipleOrderDelete(Request $req)
    {
        error_reporting(1); // Consider removing or handling errors more gracefully
        $selectorders = $req->selectedorder;
        $currentbtnname = $req->currentbtnname;

        // Validate the request
        $req->validate([
            'selectedorder' => 'required|array',
            'currentbtnname' => 'required|string'
        ]);

        switch ($currentbtnname) {
            case "shippinglabel":
                return response()->view("UserPanel.LabesPrintout.Search", ['params' => $selectorders]);

            case "cancelorders":
                // Update orders to be canceled
                bulkorders::whereIn('Awb_Number', $selectorders)->update(['order_cancel' => 1]);
                foreach ($selectorders as $selectorders) {
                    $awb = $selectorders;

                    $credit1 = orderdetail::where('awb_no', $awb)->first()->debit;

                    $transactionCode = "TR" . $selectorders;


                    // Fetch the most recent balance record for the given user
                    $blance = orderdetail::where('user_id', $userid)
                        ->orderBy('orderid', 'DESC')
                        ->first();


                    // Initialize $close_blance with $credit1
                    $close_blance = $credit1;

                    // Check if a balance record exists and update $close_blance accordingly
                    if ($blance && isset($blance->close_blance)) {
                        // Ensure close_blance is a number, default to 0 if null
                        $previous_blance = $blance->close_blance ?? 0;
                        $close_blance = $previous_blance + $credit1;
                    }


                    $wellet = new orderdetail;
                    $wellet->credit = $credit1;
                    $wellet->awb_no = $awb;
                    $wellet->date = $date;
                    $wellet->user_id =  $userid;
                    $wellet->transaction = $transactionCode;
                    $wellet->close_blance = $close_blance;
                    $wellet->save();
                }



                // Flash message and redirect back
                return redirect()->back()->with('message', 'Orders successfully canceled.');

            case "exportorderdetails":
                return Excel::download(new PlacedOrdersExport($selectorders), 'Upload-orders.xls');

            default:
                return redirect()->back()->with('error', 'Invalid action.');
        }
    }

    // Multiple Checkbox Select Orders































    // New Receipt Format
    public function ReceiptOrderNew(Request $req, $id)
    {
        // return $id;
        $somedatas = bulkorders::where('Single_Order_Id', $id)->first();
        $Hubs = Hubs::where('hub_id', $somedatas['pickup_id'])->first();

        $orderno = $somedatas['orderno'];
        // $d = new DNS1D();
        // $d->setStorPath(__DIR__.'/cache/');
        // $orderbarcode = $d->getBarcodeHTML("$orderno", 'C128');
        $orderbarcode = $orderno;
        $awbno = $somedatas['Awb_Number'];
        // $d = new DNS1D();
        // $d->setStorPath(__DIR__.'/cache/');
        // $awbbarcode = $d->getBarcodeHTML($awbno, 'C128');
        $awbbarcode = $awbno;

        $params = bulkorders::where('Single_Order_Id', $id)->first();
        return view("UserPanel.Receipt.Receipt_new", ['params' => $params, 'orderbarcode' => $orderbarcode, 'orderno' => $orderno, 'awbbarcode' => $awbbarcode, 'awbno' => $awbno, 'Hubs' => $Hubs]);
    }
    // New Receipt Format


    public function ReceiptOrder1(Request $req, $id)
    {
        // return $id;
        $somedatas = bulkorders::where('Single_Order_Id', $id)->first();
        $Hubs = Hubs::where('hub_id', $somedatas['pickup_id'])->first();

        $orderno = $somedatas['orderno'];
        // $d = new DNS1D();
        // $d->setStorPath(__DIR__.'/cache/');
        // $orderbarcode = $d->getBarcodeHTML("$orderno", 'C128');
        $orderbarcode = $orderno;
        $awbno = $somedatas['Awb_Number'];
        // $d = new DNS1D();
        // $d->setStorPath(__DIR__.'/cache/');
        // $awbbarcode = $d->getBarcodeHTML($awbno, 'C128');
        $awbbarcode = $awbno;

        $params = bulkorders::where('Single_Order_Id', $id)->first();
        return view("UserPanel.Receipt.Receipt", ['params' => $params, 'orderbarcode' => $orderbarcode, 'orderno' => $orderno, 'awbbarcode' => $awbbarcode, 'awbno' => $awbno, 'Hubs' => $Hubs]);
    }


    public function ReceiptOrderBulk1(Request $req)
    {
        // $params = bulkorders::all();
        $tudate = date('Y-m-d');
        $params = bulkorders::where('Rec_Time_Date', $tudate)->where('Awb_Number', '!=', '')->get();
        $Hubs = Hubs::all();
        return view("UserPanel.Receipt.Receipt_bulk", ['params' => $params, 'Hubs' => $Hubs]);
    }




    public function OrderLiveStatus(Request $req)
    {

        print_r("hello");
        die();

        /*
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rappidx.com/Admin_1/API/Check_All_Data.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);

$response = $response['data'];

// print_r($response);
// die();

    // foreach ($response as $key => $value) {

    // }

  for ($i=0; $i < count($response); $i++) {
    $orderno = $response[$i]['orderno'];
    $ordernoapi = $response[$i]['ordernoapi'];
    $Awb_Number = $response[$i]['Awb_Number'];
    $awb_gen_by = $response[$i]['awb_gen_by'];
    $order_status = $response[$i]['order_status'];
    $order_status1 = $response[$i]['order_status1'];
    $order_status_show = $response[$i]['order_status_show'];
    bulkorders::where('ordernoapi',$ordernoapi)
                ->update([
                    'orderno'=>$orderno,
                    'ordernoapi'=>$ordernoapi,
                    'Awb_Number'=>$Awb_Number,
                    'awb_gen_by'=>$awb_gen_by,
                    'order_status'=>$order_status,
                    'order_status1'=>$order_status1,
                    'order_status_show'=>$order_status_show
                  ]);
  }
    echo $i;
    echo "<pre>";
    print_r($response);
    echo "</pre>";

*/
    }














































    public function BulkOrderAdd(Request $req)
    {
        error_reporting(1);
        $userid = session()->get('UserLogin2id');
        $username = session()->get('UserLogin2name');
        //  File Name
        $bulkfilename = date('Y-m-d');
        if (!file_exists("BulkExcelFiles/$bulkfilename")) {
            mkdir("BulkExcelFiles/$bulkfilename");
        }
        $imgfile = $req->file('bulkorders');
        if (is_null($imgfile)) {
            // $query->billimg = "";
            // echo "1";
            $req->session()->flash('status', 'Bulk Order Not Uploaded');
            return redirect('/UPBulk_Order');
        } else {
            $fileextention = $imgfile->getClientOriginalExtension();
            $fa = date('dmy');
            $fb = $userid;
            $fc = "_";
            $randno1 = rand(1, 499);
            $randno2 = rand(500, 999);
            $img = $fa . $fb . $fc . $randno1 . $randno2 . "." . $fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("BulkExcelFiles/$bulkfilename/", $img);
            // echo "2";
            // $query->billimg = $img;

            // Read File
            $fileD = fopen("BulkExcelFiles/$bulkfilename/$img", "r");
            // $fileD = fopen('sample.csv',"r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }
            foreach ($rowData as $key => $value) {
                // echo $value[0]."<br>";
                $Hubs = Hubs::where('hub_id', $value[1])->first();
                $hubname = $Hubs['hub_name'];
                $hubaddress = $Hubs['hub_address1'];
                $hubgstno = $Hubs['hub_gstno'];
                $hubmobile = $Hubs['hub_mobile'];
                $hubpincode = $Hubs['hub_pincode'];
                $hubalternateid = $Hubs['hub_id'];
                // Default Courier Name
                $couriernameconfirm = 0;
                $couriernameconfirmshow = 0;
                // Default Courier Name

                if ($value[1] == "") {
                    continue;
                }

                // Check Rider
                // $ridername = $value[19];
                // $riderids = Allusers::where('name',$ridername)->first();
                // $riderid = $riderids['id'];
                // Check Rider
                // Check Courier Name
                // echo "<br>Cn1 <br>";

                // $courierpriority = array(1,2);
                // $checkallcourierdetails = orderdetail::all();

                $params = orderdetail::where('order_userid', $userid)->first();
                // $params['XpressBee'];
                // $params['BigShip'];
                if (!empty($params['Pickrr'])) {
                    $pickrpriorityno = $params['api_priority_Pickrr'];
                } else {
                    $pickrpriorityno = 0;
                }
                if (!empty($params['SmartShip'])) {
                    $smartshippriorityno = $params['api_priority_SmartShip'];
                } else {
                    $smartshippriorityno = 0;
                }




                // if($pickrpriorityno<$smartshippriorityno){
                //     $couriername = "ShipXpress(P)";
                // }else{
                //     $couriername = "ShipXpress(S)";
                // }
                $couriername = "ShipXpress(P)";
                // $couriername = "ShipXpress(S)";
                // echo "<br>Cn2 <br>";
                $couriersexists = CourierNames::where('courier_name_show', $couriername)->where('courier_status', '1')->count('courier_name');

                // echo "<br>l <br>";
                // foreach ($couriers as $courier){
                //     if($courier->courier_name==$couriername)
                //     {
                //         $couriernameconfirm = $courier->courier_name;
                //     }
                // }
                // Check Courier Name

                // IF Rider OR Courier Selected
                // if($riderid)
                // {
                //     $defaultno = 1000;
                //     $orderuid = $defaultno+$last_id;
                //     $d1 = date("d");
                //     $m1 = date("m");
                //     $y1 = date("y");
                //     $awbno = "SL".$y1.$m1.$d1.$orderuid;
                //     $params = orderdetail::where('orderid',$last_id)
                //                     ->update([
                //                         'awb_no'=>$awbno,
                //                         'order_status'=>"Progress",
                //                         'courier_name'=>"ShipXpress",
                //                         'order_start_date'=>date('Y-m-d'),
                //                         'order_riderid'=>$riderid,
                //                         'order_ridername'=>$ridername
                //                     ]);
                // }else



                if ($couriersexists) {

                    echo "<pre>";

                    // If Courier Exists Then Upload In DataBase
                    $query = new orderdetail;

                    // $query->orderno = $value[0];
                    $query->hub_id = $value[1];
                    $query->hub_name = $hubname;

                    $query->cname = $value[2];
                    $query->cmobile = $value[3];
                    $query->cemail = $value[4];
                    $query->caddress = $value[5];
                    $query->cstate = $value[6];
                    $query->ccity = $value[7];
                    $query->cpin = $value[8];

                    $query->itemname = $value[9];
                    $query->itemquantity = $value[10];
                    $query->itmecodamt = $value[11];
                    $query->iteminvoicevalue = $value[12];
                    $query->pweight = $value[13];
                    $query->lenth = $value[14];
                    $query->breadth = $value[15];
                    $query->height = $value[16];
                    $query->ptamt = $value[17];
                    $query->additionaldetails = $value[18];

                    $query->orderdata = date('Y-m-d');
                    $query->order_status = "Upload";
                    $query->order_upload_type = "Bulk Type";
                    $query->order_userid = $userid;
                    $query->order_username = $username;

                    $query->save();
                    $last_id = $query->id;

                    $ordernois = "SDRT00" . $last_id;
                    $value[0] = $ordernois;
                    orderdetail::where('orderid', $last_id)->update(['orderno' => $ordernois]);
                    // If Courier Exists Then Upload In DataBase

                    // $couriername = "ShipXpress(P)";
                    // $couriername = "ShipXpress(S)";
                    $courieridis = CourierNames::where('courier_name_show', $couriername)->first();
                    $courieridisa = $courieridis['courier_id'];
                    $couriernameisa = $courieridis['courier_name'];
                    $couriernameconfirmshow = $courieridis['courier_name_show'];



                    // -    -   -   -   -   Pickrr  *   *   Bulk *  *   *   *
                    if ($couriernameisa == "Pickrr") {

                        $couriernameconfirm = $couriernameisa;
                        $pickrparams = array(
                            'auth_token' => '42e094b5daec3b715ab96cbb248839dd141263',
                            'item_name' => "$value[9]",

                            'from_name' => "$hubname",
                            'from_phone_number' => "$hubmobile",
                            'from_address' => "$hubaddress",
                            'from_pincode' => "$hubpincode",
                            'pickup_gstin' => "$hubgstno",

                            'to_name' => "$value[2]",
                            'to_phone_number' => "$value[3]",
                            'to_pincode' => "$value[8]",
                            'to_address' => "$value[5]",
                            'to_email' => "$value[4]",

                            'quantity' => "$value[10]",
                            'invoice_value' => "$value[12]",
                            'cod_amount' => "$value[11]",
                            'client_order_id' => "$ordernois",
                            'item_breadth' => "$value[15]",
                            'item_length' => "$value[14]",
                            'item_height' => "$value[16]",
                            'item_weight' => "$value[13]",

                            'item_tax_percentage' => 12,
                            'is_reverse' => False
                        );

                        print_r($pickrparams);

                        try {
                            $json_params = json_encode($pickrparams);
                            $url = 'https://www.pickrr.com/api/place-order/';
                            //open connection
                            $ch = curl_init();
                            //set the url, number of POST vars, POST data
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            //execute post
                            $result = curl_exec($ch);
                            $result = json_decode($result, true);
                            //close connection
                            curl_close($ch);

                            // if(gettype($result)!="array")
                            //   throw new \Exception( print_r($result, true) . "Problem in connecting with Pickrr");
                            // if($result['err']!="")
                            //   throw new \Exception($result['err']);
                            // // return $result['tracking_id'];

                            // print_r($result);
                            // exit();

                            $success = $result['success'];
                            $order_id = $result['order_id'];
                            $item_orderno = $value[0];
                            $order_pk = $result['order_pk'];
                            $tracking_id = $result['tracking_id'];
                            $manifest_link = $result['manifest_link'];
                            $routing_code = $result['routing_code'];
                            $client_order_id = $result['client_order_id'];
                            $courier = $result['courier'];
                            $dispatch_mode = $result['dispatch_mode'];
                            $ip_string = $result['ip_string'];
                            $manifest_link_pdf = $result['manifest_link_pdf'];
                            $manifest_img_link = $result['manifest_img_link'];

                            $querycad = new CourierApiDetail;
                            $querycad->courier_id = $courieridisa;
                            $querycad->courier_name = $couriernameisa;
                            $querycad->item_orderno = $item_orderno;
                            $querycad->success = $success;
                            $querycad->order_id = $order_id;
                            $querycad->order_pk = $order_pk;
                            $querycad->awb_tracking_id = $tracking_id;
                            $querycad->manifest_link = $manifest_link;
                            $querycad->routing_code = $routing_code;
                            $querycad->client_order_id = $client_order_id;
                            $querycad->courier_by = $courier;
                            $querycad->dispatch_mode = $dispatch_mode;
                            $querycad->ip_string = $ip_string;
                            $querycad->manifest_link_pdf = $manifest_link_pdf;
                            $querycad->manifest_img_link = $manifest_img_link;
                            $querycad->save();
                            $querycadlast_id = $querycad->id;

                            // echo "<pre>A1<br>";
                            // print_r($result);
                            // echo "</pre>";
                            // echo "<br>";

                            // Order  Tracking Details In Pickrr
                            $url = "http://www.pickrr.com/api/tracking-json/?auth_token=42e094b5daec3b715ab96cbb248839dd141263&tracking_id=$tracking_id";

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url); //Url together with parameters
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7); //Timeout after 7 seconds
                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            $result = curl_exec($ch);
                            curl_close($ch);
                            $json = json_decode($result, true);



                            $received_by =  $json['status']['received_by'];
                            $current_status_type =  $json['status']['current_status_type'];
                            $current_status_body =  $json['status']['current_status_body'];
                            $current_status_location =  $json['status']['current_status_location'];
                            $current_status_time =  $json['status']['current_status_time'];


                            CourierApiDetail::where('apidetailsid', $querycadlast_id)
                                ->update([
                                    'received_by' => $received_by,
                                    'current_status_type' => $current_status_type,
                                    'current_status_body' => $current_status_body,
                                    'current_status_location' => $current_status_location,
                                    'current_status_time' => $current_status_time
                                ]);
                            // Order  Tracking Details In Pickrr

                        } catch (\Exception $e) {
                            // echo $e;
                        }

                        // Call Pickrr API
                        // createShipment($params);
                        // Call Pickrr API


                        // -    -   -   -   -   Pickrr *    *   * Bulk  *   *   *   *
                    } elseif ($couriernameisa == "SmartShip") {
                        // -    -   -   -   -   SmartShip * *   *   * Bulk *    *   *

                        // Token Generate SmartShip     *   *   *   *   *   Bulk   *   *   *   *   *   *
                        $params = array(
                            "username" => "info@shipxpress.in",
                            "password" => "55963d6247d3aacb019bc15204c3bd4d",
                            "client_id" => "67SWU5YMPWX8KV0DOM3P0ZF",
                            "client_secret" => "A@)3#X98TLR)FBPZ6(X_Z",
                            "grant_type" => "password"
                            // "username"=>"vivek.sankhyan@shopclues.com",
                            // "password"=>"e10adc3949ba59abbe56e057f20f883e",
                            // "client_id"=>"1ZT6T60OPZ6LGOHOS99IV0ES5UA4",
                            // "client_secret"=>"!K3V@Y_7LSD(MUG44ZG4ZTJLZ7FE8)_XI2*_D^5QL9MYGT",
                            // "grant_type"=>"password"
                        );
                        // $clientiddeclare = "1ZT6T60OPZ6LGOHOS99IV0ES5UA4";
                        $clientiddeclare = "67SWU5YMPWX8KV0DOM3P0ZF";

                        $json_params = json_encode($params);
                        $url = "http://oauth.smartship.in/loginToken.php";
                        //open connection
                        $ch = curl_init();
                        //set the url, number of POST vars, POST data
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_params);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        //execute post
                        $result = curl_exec($ch);
                        $result = json_decode($result, true);
                        //close connection
                        curl_close($ch);
                        $tokengenerateis = $result['access_token'];
                        // Token Generate SmartShip     *   *   *   *   *  Bulk   *   *   *   *   *

                        // Single Order Book Through API    *   *   *   *  Bulk   *   *   *   *   *
                        $bearerkey = $tokengenerateis;
                        $clientidis = $clientiddeclare;


                        $orderid = $value[0];
                        // $orderamt = $req->CODAmount;
                        $orderamt = 0;
                        $torderamt = $value[17];
                        $Prepaidtype = "Prepaid";
                        $weight = $value[13];
                        $length = $value[14];
                        $height = $value[16];
                        $width = $value[15];
                        $hubid = $hubalternateid;
                        $shipgstno = "07ABFCS1421E1ZS";
                        // $shipgstno = "342323";
                        $orderdate = date('Y-m-d h:i:s');
                        $invoideno = $value[0];
                        $ewaybillno = "";
                        $ewaybillexpdate = "";

                        $prodname = $value[9];
                        $prodcate = "";
                        $prodhascode = "FLOUR, MEAL AND POWDER OF THE DRIED LEGUMINOUS VEGETABLES OF HEADING 0713, OF SAGO OR OF ROOTS OR TU";
                        $prodquantity = $value[10];
                        $prodinvoiceval = $value[12];
                        $prodtaxableval = "1.00";
                        $prodsgstamt = "2";
                        $prodcsgtamt = "2";
                        $prodgsttaxrate = "2";
                        $prodcgsttaxrate = "2";
                        $prodsgsttaxrate = "2";

                        $consigneename = $value[2];
                        $consigneephone = $value[3];
                        $consigneeemail = $value[4];
                        $consigneecmpaddress = $value[5];
                        $consigneepincode = $value[8];


                        $paramsdata = '{
"orders": [
    {
        "client_order_reference_id": "' . $orderid . '",
        "order_collectable_amount": "' . $orderamt . '",
        "total_order_value": "' . $torderamt . '",
        "payment_type": "' . $Prepaidtype . '",
        "package_order_weight": "' . $weight . '",
        "package_order_length": "' . $length . '",
        "package_order_height": "' . $height . '",
        "package_order_width": "' . $width . '",
        "shipper_hub_id": "' . $hubid . '",
        "shipper_gst_no": "' . $shipgstno . '",
        "order_invoice_date": "' . $orderdate . '",
        "order_invoice_number": "' . $invoideno . '",
        "order_ewaybill_number": "' . $ewaybillno . '",
        "order_ewaybill_expiry_date": "' . $ewaybillexpdate . '",
        "product_details": [
            {
                "product_name": "' . $prodname . '",
                "product_category": "' . $prodcate . '",
                "product_hsn_code": "' . $prodhascode . '",
                "product_quantity": "' . $prodquantity . '",
                "product_invoice_value": "' . $prodinvoiceval . '",
                "product_taxable_value": "' . $prodtaxableval . '",
                "product_sgst_amount": "' . $prodsgstamt . '",
                "product_cgst_amount": "' . $prodcsgtamt . '",
                "product_gst_tax_rate": "' . $prodgsttaxrate . '",
                "product_cgst_tax_rate": "' . $prodcgsttaxrate . '",
                "product_sgst_tax_rate": "' . $prodsgsttaxrate . '"
            }
        ],
        "consignee_details": {
            "consignee_name": "' . $consigneename . '",
            "consignee_phone": "' . $consigneephone . '",
            "consignee_email": "' . $consigneeemail . '",
            "consignee_complete_address": "' . $consigneecmpaddress . '",
            "consignee_pincode": "' . $consigneepincode . '"
        }
    }
],
"request_info": {
    "client_id": "' . $clientidis . '",
    "run_type": "create"
}
}';

                        // echo "<pre>";
                        // print_r($paramsdata);
                        // echo "</pre>";

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'http://api.smartship.in/v2/app/Fulfillmentservice/orderRegistrationOneStep',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => $paramsdata,
                            CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/json",
                                "Authorization: Bearer $bearerkey"
                            ),
                        ));

                        $response = curl_exec($curl);
                        // $response = json_decode($response, true);
                        $response = json_decode($response, true);
                        curl_close($curl);


                        try {
                            $requestid = $response['data']['request_id'];
                            $orderrefid = $response['data']['success_order_details']['orders']['0']['client_order_reference_id'];
                            $requestorderid = $response['data']['success_order_details']['orders']['0']['request_order_id'];

                            $forwardfreigcharge = $response['data']['success_order_details']['orders']['0']['cost_estimation']['forward']['freight_charges'];
                            $forwardfuelcharge = $response['data']['success_order_details']['orders']['0']['cost_estimation']['forward']['fuel_surcharge'];
                            $forwardfuelsurcharge = $response['data']['success_order_details']['orders']['0']['cost_estimation']['forward']['fuel_surcharge_percentage'];
                            $forwardshippingcost = $response['data']['success_order_details']['orders']['0']['cost_estimation']['forward']['shipping_cost'];
                            $forwardshippingcosttaxamt = $response['data']['success_order_details']['orders']['0']['cost_estimation']['forward']['shipping_cost_tax_amount'];
                            $forwardtotalshippingcost = $response['data']['success_order_details']['orders']['0']['cost_estimation']['forward']['total_shipping_cost'];

                            $rtofreightcharge = $response['data']['success_order_details']['orders']['0']['cost_estimation']['rto']['freight_charges'];
                            $rtofuelcharge = $response['data']['success_order_details']['orders']['0']['cost_estimation']['rto']['fuel_surcharge'];
                            $rtofuelsurcharge = $response['data']['success_order_details']['orders']['0']['cost_estimation']['rto']['fuel_surcharge_percentage'];
                            $rtoshippingcost = $response['data']['success_order_details']['orders']['0']['cost_estimation']['rto']['shipping_cost'];
                            $rtoshippingcosttaxamt = $response['data']['success_order_details']['orders']['0']['cost_estimation']['rto']['shipping_cost_tax_amount'];
                            $rtototalshippingcost = $response['data']['success_order_details']['orders']['0']['cost_estimation']['rto']['total_shipping_cost'];

                            $couriername = $response['data']['success_order_details']['orders']['0']['carrier_name'];
                            $tracking_id = $response['data']['success_order_details']['orders']['0']['awb_number'];
                            $awbcode = $response['data']['success_order_details']['orders']['0']['code'];
                            $courierid = $response['data']['success_order_details']['orders']['0']['carrier_id'];
                            $couriercode = $response['data']['success_order_details']['orders']['0']['carrier_code'];
                            $courierroutecode = $response['data']['success_order_details']['orders']['0']['route_code'];

                            $shippinglabelurl = $response['data']['success_order_details']['shipping_info']['label_url'];
                        } catch (\Exception $e) {

                            $requestorderid = "";
                        }

                        // echo "<pre>";
                        // print_r($response);
                        // echo "</pre>";
                        // Single Order Book Through API

                        // Update Order Reference ID
                        orderdetail::where('orderid', $last_id)->update(['orderno_reference' => $requestorderid]);
                        // Update Order Reference ID

                        echo "SmartShip Panel Work";
                    }
                    // -    -   -   -   -   SmartShip   *   *   *   *   Bulk   *   *   *   *   *   *


                    // $defaultno = 1000;
                    // $orderuid = $defaultno+$last_id;
                    // $awbno = "SL".$y1.$m1.$d1.$orderuid;
                    // $d1 = date("d");
                    // $m1 = date("m");
                    // $y1 = date("y");
                    // $awbno = $tracking_id;
                    // $params = orderdetail::where('orderid',$last_id)
                    //             ->update([
                    //                 'awb_no'=>$awbno,
                    //                 'order_status'=>"Progress",
                    //                 'courier_name'=>$req->couriertype,
                    //                 'order_start_date'=>date('Y-m-d'),
                    //             ]);

                    // $defaultno = 1000;
                    // $orderuid = $defaultno+$last_id;
                    // $d1 = date("d");
                    // $m1 = date("m");
                    // $y1 = date("y");
                    // $awbno = "SL".$y1.$m1.$d1.$orderuid;
                    // $current_status_type = "Progress";

                    if (empty($current_status_type)) {
                        $current_status_type = "Progress";
                    }

                    $awbno = $tracking_id;
                    $params = orderdetail::where('orderid', $last_id)
                        ->update([
                            'awb_no' => $awbno,
                            'order_status' => $current_status_type,
                            'courier_name' => $couriernameconfirm,
                            'courier_name_show' => $couriernameconfirmshow,
                            'order_start_date' => date('Y-m-d'),
                        ]);
                }
                // IF Rider OR Courier Selected

            }
            // echo "<pre>";
            // print_r($rowData);
            $req->session()->flash('status', 'Bulk Order Uploaded');
            return redirect('/UPBulk_Order');
            // Read File
        }
        //  File Name
        return redirect('/UPBulk_Order');
    }







    public function readcsv()
    {
        $fileD = fopen('expertphp-product.csv', "r");
        $column = fgetcsv($fileD);
        while (!feof($fileD)) {
            $rowData[] = fgetcsv($fileD);
        }
        foreach ($rowData as $key => $value) {

            $inserted_data = array(
                'name' => $value[0],
                'details' => $value[1],
            );

            Product::create($inserted_data);
        }
        print_r($rowData);
    }

    public function SingleReverse()
    {
        return view('UserPanel.PlaceOrder.SingleReverse');
    }

    public function BulkReverse()
    {
        return view('UserPanel.PlaceOrder.BulkReverse');
    }


    public function ReceiptOrder(Request $req, $id)
    {
        // return $id;
        $somedatas = orderdetail::where('orderid', $id)->first();
        $Hubs = Hubs::where('hub_id', $somedatas['hub_id'])->first();

        $orderno = $somedatas['orderno'];
        // $d = new DNS1D();
        // $d->setStorPath(__DIR__.'/cache/');
        // $orderbarcode = $d->getBarcodeHTML("$orderno", 'C128');
        $orderbarcode = $orderno;
        $awbno = $somedatas['awb_no'];
        // $d = new DNS1D();
        // $d->setStorPath(__DIR__.'/cache/');
        // $awbbarcode = $d->getBarcodeHTML($awbno, 'C128');
        $awbbarcode = $awbno;

        $params = orderdetail::where('orderid', $id)->first();
        return view("UserPanel.Receipt.Receipt", ['params' => $params, 'orderbarcode' => $orderbarcode, 'orderno' => $orderno, 'awbbarcode' => $awbbarcode, 'awbno' => $awbno, 'Hubs' => $Hubs]);
    }


    public function ReceiptOrderBulk(Request $req)
    {
        $params = orderdetail::all();
        $Hubs = Hubs::all();
        return view("UserPanel.Receipt.Receipt_bulk", ['params' => $params, 'Hubs' => $Hubs]);
    }
}

class PlacedOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($awbno)
    {

        $this->awbno = $awbno;
    }

    public function collection()
    {

        $awbno = $this->awbno;

        $products = Bulkorders::select('Order_Type', 'orderno', 'ordernoapi', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereIn('Awb_Number', $awbno)
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('apihitornot', '1')
            ->where('order_cancel', '!=', '1')
            // ->where('Awb_Number', '!=', '')
            //  ->where('Awb_Number','')
            // ->where('Last_Time_Stamp','2024-06-15 12:18:36')
            //  ->where('awb_gen_by','Ecom')
            // ->where('uploadtype', $ftypedata) 
            ->get();

        foreach ($products as $key => $product) {
            if ($products[$key]->awb_gen_courier == "Smartship") {
                $products[$key]->awb_gen_courier = "Bluedart";
            } elseif ($products[$key]->awb_gen_courier == "Intargos") {
                $products[$key]->awb_gen_courier = "Shipedia";
            } elseif ($products[$key]->awb_gen_courier == "Intargos1") {
                $products[$key]->awb_gen_courier = "Shipedia1";
            }
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
            $products[$key]->Address =  $product->Address;
        }

        return $products;
    }

    public function headings(): array
    {
        return ['Order_Type', 'Orderno', 'shipnick_id', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice#', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}
