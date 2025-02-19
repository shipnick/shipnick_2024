<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hubs;
use App\Models\smartship;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Http;
use App\Models\price;
use App\Models\orderdetail;
use App\Models\bulkorders;
use Illuminate\Support\Str;

use App\Models\Payment;

class UserHubs extends Controller
{


    public function AllInvoice()
    {
        // $userid = session()->get('UserLogin2id');
        // $params = Hubs::where('hub_created_by',$userid)->orderby('hub_id','DESC')->get();
        return view('UserPanel.Invoices.All');
    }
    public function AllRemittance()
    {
        // $userid = session()->get('UserLogin2id');
        // $params = Hubs::where('hub_created_by',$userid)->orderby('hub_id','DESC')->get();
        // return view('UserPanel.Remmitance.All',['params'=>$params]);
        return view('UserPanel.Remmitance.All');
    }
    public function WalletDetails()
    {
        $userid = session()->get('UserLogin2id');
        $reharge = Payment::where('user_id', $userid)->where('status', 'PAYMENT_SUCCESS')->get();



        $billing_data = orderdetail::join('spark_single_order', 'orderdetails.awb_no', '=', 'spark_single_order.Awb_Number')
            ->where('orderdetails.user_id', $userid)
            ->orderby('orderdetails.orderid', 'DESC')
            ->select('orderdetails.*', 'spark_single_order.*')  // Select all columns from both tables
            ->paginate(50);  // Paginate with 50 items per page


        $billing_data_total = orderdetail::where('user_id', $userid)->orderby('orderid', 'DESC')->first();
        $params = price::where('user_id', $userid)->orderBy('id', 'DESC')->get();
        $param1 = price::where('status', 'defult')->orderBy('id', 'DESC')->get();


        // Create a mapping of params by name for easy lookup
        $paramsMap = [];
        foreach ($params as $param) {
            $paramsMap[$param->name] = $param; // Use name as the key
        }

        // Prepare an array to hold the final values
        $finalParams = [];

        // Iterate through param1 and replace with values from params if they match
        foreach ($param1 as $defaultParam) {
            if (isset($paramsMap[$defaultParam->name])) {
                // Replace with the matching $params value
                $finalParams[] = $paramsMap[$defaultParam->name];
            } else {
                // Otherwise, use the default param
                $finalParams[] = $defaultParam;
            }
        }

        return view('UserPanel.Wallet.All', ['finalParams' => $finalParams, 'params' => $params], compact('params', 'billing_data', 'billing_data_total', 'reharge'));
    }

    public function NewHub()
    {
        return view('UserPanel.Hub.HubNew');
    }

    public function AllHub()
    {
        $userid = session()->get('UserLogin2id');
        $params = Hubs::where('hub_created_by', $userid)->orderby('hub_id', 'DESC')->get();
        return view('UserPanel.Hub.Hub', ['params' => $params]);
    }

   
    public function NewHubAdd(Request $req)
    {
        
        $randomnew = Str::random(5);
        $randomString = $randomnew;

        // error_reporting(1);
        $useridis = session()->get('UserLogin2id');
        if ($req->deliverytype == "Express") {
            $deliverytypeval = 1;
        } elseif ($req->deliverytype == "Economy") {
            $deliverytypeval = 2;
        } elseif ($req->deliverytype == "Bulk") {
            $deliverytypeval = 3;
        }

        $bulkfilename = date('Y-m-d');
        if (!file_exists("HubDetails/$bulkfilename")) {
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
        $query->intargos_hubid = $req->email_id;
        $query->nimbus_hubid = $req->alt_mobile;
        $query->smartship_hubid = $req->C_name;
        $query->hub_pincode = $req->pincode;
        $query->hub_state = $req->state;
        $query->hub_city = $req->city;
        $query->hub_deliverytype = $req->deliverytype;
        $query->intargos_hubid = '';
        $query->hub_created_by = $useridis;
        $query->hub_folder = $bulkfilename;
        // $query->hub_img = $img;
        $query->save();

        $last_id = $query->id;
        $hubcode = "HID00" . $last_id;

        $wareuid = rand(11, 99);
        $hubtitleis = $hubcode . $wareuid;
        $hubtitle = ucwords($hubtitleis);

        $address = $req->address2 . ' ' . $req->address1;

        Hubs::where('hub_id', $last_id)->update(['hub_code' => $hubcode, 'hub_title' => $hubtitle]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'rapidshyp-token' => '57731822281d866169a9563742c0b806bbce5d34916c66eacfe41e00965924ca',
        ])
            ->post('https://api.rapidshyp.com/rapidshyp/apis/v1/create/pickup_location', [
                'address_name' => $req->name.$randomString,
                'contact_name' => $req->name,
                'contact_number' => $req->mobile,
                'email' => 'john.doe@example.com',
                'address_line' => $address,
                'address_line2' => '',
                'pincode' => $req->pincode,
                'gstin' => $req->gstno,
                'dropship_location' => true,
                'use_alt_rto_address' => true,
                'rto_address' => '',
                'create_rto_address' => [
                    'rto_address_name' => $req->name .$randomString. 'new',
                    'rto_contact_name' => $req->name . 'new',
                    'rto_contact_number' => $req->mobile,
                    'rto_email' => 'jane.smith@example.com',
                    'rto_address_line' => $address,
                    'rto_address_line2' => '',
                    'rto_pincode' => $req->pincode,
                    'rto_gstin' => $req->gstno,
                ]
            ]);

        $responseDatanew = $response->json();
        echo "<br><pre>";
        print_r(($responseDatanew));
        echo "</pre><br>";
        if ($responseDatanew['status'] == 'success') {
            $PickupName = $responseDatanew['pickup_location_name'];
            $RtoName = $responseDatanew['rto_location_name'];

            $hunname = new smartship();
            $hunname->token = $PickupName;
            $hunname->courier = 'RapidShip';
            $hunname->expire_in = $last_id;
            $hunname->save();
        }

        $response = Http::withHeaders([
            'Authorization' => 'Basic R3RoYWtyYWw0ODBAZ21haWwuY29tOms0OTJYMzFsUUwzNXFUUTd3NWwzNlNuZFkwdjExMjQy',
            'Content-Type' => 'application/json',
            'Cookie' => 'AWSALB=XIZowALK43Iz+hniAdKm8R+jdQrfN00xU6grRW9ApqmiT15928/qNupgLNajhmejHCfZ/mxXZ2YEmbkMwTDFlJzx8NzbW5VarPRtVg8/tVY1o+o3z+YPZAGkfBQi; AWSALBCORS=XIZowALK43Iz+hniAdKm8R+jdQrfN00xU6grRW9ApqmiT15928/qNupgLNajhmejHCfZ/mxXZ2YEmbkMwTDFlJzx8NzbW5VarPRtVg8/tVY1o+o3z+YPZAGkfBQi'
        ])
            ->post('https://app.shipway.com/api/warehouse/', [
                'title' => $req->name,
                'company' => $req->name,
                'contact_person_name' => $req->name,
                'email' => 'contact@ezyslips.com',
                'phone' => '+91-' . $req->mobile,
                'phone_print' => '',
                'address_1' => $address,
                'address_2' => '',
                'city' => strtolower($req->city),  // Convert city to lowercase
                'state' => strtolower($req->state),  // Convert state to lowercase
                'country' => 'IN',
                'pincode' => $req->pincode,
                'longitude' => '',
                'latitude' => '',
                'gst_no' => $req->gstno,
                'fssai_code' => ''
            ]);
        $responseDatanew = $response->json();
        echo "<br><pre>";
        print_r(($responseDatanew));
        echo "</pre><br>";







        if ($responseDatanew['success']) {
            echo  $PickupName = $responseDatanew['warehouse_response']['warehouse_id'];


            $hunname = new smartship();
            $hunname->token = $PickupName;
            $hunname->courier = 'shipway';
            $hunname->expire_in = $last_id;
            $hunname->save();
        }




        Hubs::where('hub_id', $last_id);


        $req->session()->flash('message', 'New Hub Added');
        return redirect('/UPNew_Hub');
    }

    public function HubEdit(Request $req, $id)
    {
        $params = Hubs::where('hub_id', $id)->first();
        return view('UserPanel.Hub.HubEdit', ['params' => $params]);
    }

    public function HubUpdate(Request $req)
    {

        //  File Name
        $imgfile = $req->file('hubimage');
        if (!is_null($imgfile)) {
            $bulkfilename = $req->hubfolder;

            $fileextention = $imgfile->getClientOriginalExtension();
            $fa = date('dmy');
            $fb = "_";
            $randno1 = rand(1, 499);
            $randno2 = rand(500, 999);
            $img = $fa . $fb . $randno1 . $randno2 . "." . $fileextention;
            // $img = $imgfile->getClientOriginalName();
            $imgfile->move("HubDetails/$bulkfilename/", $img);
            if (empty($img)) {
                $img = "";
            }
            Hubs::where('hub_id', $req->hubid)->update(['hub_img' => $img]);
        }
        //  File Name
        Hubs::where('hub_id', $req->hubid)
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
        $req->session()->flash('status', 'Hub Details Update');
        return redirect("/UPHub_Edit/$req->hubid");
        // $params = AdminLoginCheck::where('id',$id)->first();
        // return view('UserPanel.Hubs.HubEdit',['params'=>$params]);
    }



    public function HubDelete(Request $req, $id)
    {
        $localhubid = $req->hubid;
        $apihubid = $req->hubaltid;

        Hubs::where('hub_id', $id)->delete();
        $req->session()->flash('status', 'Hub Details Delete Successfully');
        return redirect("/UPAll_Hubs");
    }
}
