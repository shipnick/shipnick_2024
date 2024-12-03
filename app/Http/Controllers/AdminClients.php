<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLoginCheck;
use App\Models\financial;
use App\Models\billing;
use App\Models\couriers;
use App\Models\courierlist;
use App\Models\bulkorders;
use App\Models\courierpermission;
use App\Models\Allusers;
use App\Models\price;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminClients extends Controller
{
    public function AllClient()
    {
        $userid = session()->get('UserLoginid');
        $params = AdminLoginCheck::where('usertype', 'user')
            ->where('crtuid', $userid)
            ->orderby('id', 'DESC')
            ->get();
        return view('Admin.Clients.AllNew', ['params' => $params]);
    }

    // Courier Assign
    public function CourierAssign(Request $req)
    {
        $couriername = $req->currentcourierno;
        $userid = $req->userid;
        // $couriername = couriers::where('courierid',$courierid)->first();
        // $details = Allusers::where('id',$userid)->first();
        if ($couriername == "intargos") {
            $a = Allusers::where('id', $userid)->update(['Intargos' => 1, 'intargos_active' => 1, 'Nimbus' => 0, 'nimbus_active' => 0]);
        }

        if ($couriername == "nimbus") {
            $a = Allusers::where('id', $userid)->update(['Intargos' => 0, 'intargos_active' => 0, 'Nimbus' => 1, 'nimbus_active' => 1]);
        }

        if ($couriername == "0") {
            $a = Allusers::where('id', $userid)->update(['Intargos' => 0, 'intargos_active' => 0, 'Nimbus' => 0, 'nimbus_active' => 0]);
        }
    }
    // Coureir Assign 
    public function Newrequest()
    {
        return view('Admin.Clients.add-api');
    }
    public function NewClient()
    {
        return view('Admin.Clients.ClientNew');
    }
    public function NewClientAdd(Request $req)
    {
        $userid = session()->get('UserLoginid');
        $qdata = AdminLoginCheck::where('username', $req->email)->first();
        if (empty($qdata['id'])) {
            // 
            $usernameemail = $req->email;
            if (!file_exists("Profiles/$usernameemail")) {
                mkdir("Profiles/$usernameemail");
            }
            $profilepic = $req->file('profilepic');
            if (!is_null($profilepic)) {
                $img = $profilepic->getClientOriginalName();
                $profilepic->move("Profiles/$usernameemail/", $img);
            } else {
                $img = "";
            }

            $query = new AdminLoginCheck();
            $query->crtuid = $userid;
            $query->username = $req->email;
            $query->password = $req->password;
            $query->name = $req->companyname;
            $query->mobile = $req->mobile;
            $query->companyname = $req->companyname;
            $query->brandame = $req->brand;
            $query->remmitanceday = $req->remmitday;
            $query->maxcodvalue = $req->maxcodorder;
            $query->maxliablilitshipment = $req->maxliability;
            $query->actype = $req->actuye;
            $query->freighttype = $req->freighttype;
            $query->profilepic = $img;
            $query->status = "1";
            $query->usertype = "user";
            $query->save();

            $req->session()->flash('status', 'New merchant added');
            return redirect('/New_Client');
            // 
        } else {
            $req->session()->flash('status', 'Email already exist');
            return redirect('/New_Client');
        }
    }
    public function ClientDashboard(Request $req, $id)
    {


        // Retrieve user parameters
        $params = AdminLoginCheck::find($id);

        // Define start and end of the day
        $startOfMonth = Carbon::today()->startOfMonth()->startOfDay();
        $endOfMonth = Carbon::today()->endOfMonth()->endOfDay();


        $codAmount = bulkorders::where('User_Id', $id)
            ->where('Order_Type', 'COD')
            ->where('showerrors', 'Delivered')
            ->whereNotNull('Awb_Number')
            ->where('order_cancel', '!=', '1')
            ->whereBetween('Rec_Time_Date', [$startOfMonth, $endOfMonth])
            ->sum('Cod_Amount');

        // Define common query conditions
        $commonConditions = [
            ['User_Id', '=', $id],
            ['Awb_Number', '!=', ''],
            ['order_cancel', '!=', '1'],
        ];

        // Count total orders
        $totalOrders = bulkorders::where($commonConditions)
            ->whereBetween('Last_Time_Stamp', [$startOfMonth, $endOfMonth])
            ->count('Single_Order_Id');

        // Count pending orders
        $pendingStatuses = [
            'Shipment Not Handed over',
            'pending pickup',
            'AWB Assigned',
            'Pickup Error',
            'Pickup Rescheduled',
            'Out For Pickup',
            'Pickup Exception',
            'Pickup Booked',
            'Shipment Booked',
            'Pickup Generated'
        ];
        $orderPending = bulkorders::where($commonConditions)
            ->whereIn('showerrors', $pendingStatuses)
            ->whereBetween('Last_Time_Stamp', [$startOfMonth, $endOfMonth])
            ->count('Single_Order_Id');

        // Count in-transit orders
        $inTransitStatuses = [
            'In-Transit',
            'in transit',
            'Connected',
            'intranit',
            'Ready for Connection',
            'Shipped',
            'In Transit',
            'Delayed',
            'Partial_Delivered',
            'REACHED AT DESTINATION HUB',
            'MISROUTED',
            'PICKED UP',
            'Reached Warehouse',
            'Custom Cleared',
            'In Flight',
            'Shipment Booked'
        ];
        $orderInTransit = bulkorders::where($commonConditions)
            ->whereIn('showerrors', $inTransitStatuses)
            ->whereBetween('Last_Time_Stamp', [$startOfMonth, $endOfMonth])
            ->count('Single_Order_Id');

        // Count delivered orders
        $deliveredStatuses = ['delivered', 'Delivered'];
        $orderDelivered = bulkorders::where($commonConditions)
            ->whereIn('showerrors', $deliveredStatuses)
            ->whereBetween('Last_Time_Stamp', [$startOfMonth, $endOfMonth])
            ->count('Single_Order_Id');

        // Count NDR (Non-Delivery Report) orders
        $ndrStatuses = ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'];
        $orderNdr = bulkorders::where($commonConditions)
            ->whereIn('showerrors', $ndrStatuses)
            ->whereBetween('Last_Time_Stamp', [$startOfMonth, $endOfMonth])
            ->count('Single_Order_Id');

        // Count RTO (Return to Origin) orders
        $rtoStatuses = [
            'Shipment Redirected',
            'Undelivered',
            'RTO Initiated',
            'RTO Delivered',
            'RTO Acknowledged',
            'RTO_OFD',
            'RTO IN INTRANSIT',
            'rto'
        ];
        $orderRto = bulkorders::where($commonConditions)
            ->whereIn('showerrors', $rtoStatuses)
            ->whereBetween('Last_Time_Stamp', [$startOfMonth, $endOfMonth])
            ->count('Single_Order_Id');



        // Define status counts array
        $statusCounts = [
            'totalOrder' => [],
            'pickup' => [],
            'in_transit' => [],
            'NDR' => [],
            'ofd' => [],
            'Deliverd' => [],
            'RTO' => [],
        ];

        // Get the date range for the last 30 days
        $dates = [];
        for ($i = 29; $i >= 0; $i--) {
            $dates[] = Carbon::now()->subDays($i)->toDateString();
        }

        // Define common query conditions
        $commonConditions = [
            ['User_Id', '=', $id],
            ['Awb_Number', '!=', ''],
            ['order_cancel', '!=', '1'],
        ];

        // Loop through each date and count the orders for each status
        foreach ($dates as $date) {
            $startDate = Carbon::parse($date)->startOfDay();
            $endDate = Carbon::parse($date)->endOfDay();

            $statusCounts['totalOrder'][$date] = bulkorders::where($commonConditions)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');

            $pendingStatuses = [
                'Shipment Not Handed over',
                'pending pickup',
                'AWB Assigned',
                'Pickup Error',
                'Pickup Rescheduled',
                'Out For Pickup',
                'Pickup Exception',
                'Pickup Booked',
                'Shipment Booked',
                'Pickup Generated'
            ];
            $statusCounts['pickup'][$date] = bulkorders::where($commonConditions)
                ->whereIn('showerrors', $pendingStatuses)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');

            $inTransitStatuses = [
                'In-Transit',
                'in transit',
                'Connected',
                'intranit',
                'Ready for Connection',
                'Shipped',
                'In Transit',
                'Delayed',
                'Partial_Delivered',
                'REACHED AT DESTINATION HUB',
                'MISROUTED',
                'PICKED UP',
                'Reached Warehouse',
                'Custom Cleared',
                'In Flight',
                'Shipment Booked'
            ];
            $statusCounts['in_transit'][$date] = bulkorders::where($commonConditions)
                ->whereIn('showerrors', $inTransitStatuses)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');

            $deliveredStatuses = ['delivered', 'Delivered'];
            $statusCounts['Deliverd'][$date] = bulkorders::where($commonConditions)
                ->whereIn('showerrors', $deliveredStatuses)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');

            $ofdStatuses = ['out for delivery', 'Out For Delivery'];
            $statusCounts['ofd'][$date] = bulkorders::where($commonConditions)
                ->whereIn('showerrors', $ofdStatuses)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');



            $ndrStatuses = ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'];
            $statusCounts['NDR'][$date] = bulkorders::where($commonConditions)
                ->whereIn('showerrors', $ndrStatuses)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');

            $rtoStatuses = [
                'Shipment Redirected',
                'Undelivered',
                'RTO Initiated',
                'RTO Delivered',
                'RTO Acknowledged',
                'RTO_OFD',
                'RTO IN INTRANSIT',
                'rto'
            ];
            $statusCounts['RTO'][$date] = bulkorders::where($commonConditions)
                ->whereIn('showerrors', $rtoStatuses)
                ->whereBetween('Last_Time_Stamp', [$startDate, $endDate])
                ->count('Single_Order_Id');
        }
        function getOrderCounts($id, $awbGenBy, $conditions)
        {
            return DB::table('spark_single_order')
                ->where('User_Id', $id)
                ->where('awb_gen_by', $awbGenBy)
                ->where('Awb_Number', '!=', '')
                ->where('order_cancel', '!=', '1')
                ->where('showerrors', '!=', 'cancelled')
                ->selectRaw("
            COUNT(CASE WHEN $conditions[pending] THEN 1 ELSE NULL END) AS pendingCount,
            COUNT(CASE WHEN $conditions[inTransit] THEN 1 ELSE NULL END) AS inTransitCount,
            COUNT(CASE WHEN $conditions[ofd] THEN 1 ELSE NULL END) AS ofdCount,
            COUNT(CASE WHEN $conditions[delivered] THEN 1 ELSE NULL END) AS deliveredCount,
            COUNT(CASE WHEN $conditions[rto] THEN 1 ELSE NULL END) AS rtoCount,
            COUNT(*) AS totalCount
        ")
                ->first();
        }

        $conditionsEcom = [
            'pending' => 'showerrors IN ("Shipment Not Handed over")',
            'inTransit' => 'showerrors IN ("In-Transit", "Connected","intranit","Ready for Connection")',
            'ofd' => 'showerrors IN ("Out For Delivery")',
            'delivered' => 'showerrors = "Delivered"',
            'rto' => 'showerrors IN ("Undelivered","Shipment Redirected")'
        ];

        $conditionsXpressbee = [
            'pending' => 'showerrors = "pending pickup"',
            'inTransit' => 'showerrors = "In Transit"',
            'ofd' => 'showerrors = "out for delivery"',
            'delivered' => 'showerrors = "delivered"',
            'rto' => 'showerrors IN ("rto", "exception")'
        ];

        $conditionsBluedart = [
            'pending' => 'order_status_show IN ("1", "13", "15", "19", "20", "27", "52","3")',
            'inTransit' => 'order_status_show IN ("6","18","22","23","38","39","42","48","49","50","51")',
            'ofd' => 'order_status_show = "17"',
            'delivered' => 'order_status_show = "7"',
            'rto' => 'order_status_show IN ("9","10","14","41","46","21", "40" ,"47", "8","16","45","12" , "24", "25" , "44","0")'
        ];

        $data1 = getOrderCounts($id, 'Ecom', $conditionsEcom);
        $data2 = getOrderCounts($id, 'Xpressbee', $conditionsXpressbee);
        $data3 = getOrderCounts($id, 'Bluedart', $conditionsBluedart);

        $result = [
            'Ecom' => [
                'totalCount' => $data1->totalCount,
                'pendingCount' => $data1->pendingCount,
                'inTransitCount' => $data1->inTransitCount,
                'ofdCount' => $data1->ofdCount,
                'deliveredCount' => $data1->deliveredCount,
                'rtoCount' => $data1->rtoCount,
            ],
            'Xpressbee' => [
                'totalCount' => $data2->totalCount,
                'pendingCount' => $data2->pendingCount,
                'inTransitCount' => $data2->inTransitCount,
                'ofdCount' => $data2->ofdCount,
                'deliveredCount' => $data2->deliveredCount,
                'rtoCount' => $data2->rtoCount,
            ],
            'Bluedart' => [
                'totalCount' => $data3->totalCount,
                'pendingCount' => $data3->pendingCount,
                'inTransitCount' => $data3->inTransitCount,
                'ofdCount' => $data3->ofdCount,
                'deliveredCount' => $data3->deliveredCount,
                'rtoCount' => $data3->rtoCount,
            ]
        ];


        // Return data to the view
        return view('Admin.Clients.client-dashboard', [
            'params' => $params,
            'id' => $id,
            'totalOrders' => $totalOrders,
            'orderPending' => $orderPending,
            'orderInTransit' => $orderInTransit,
            'orderDelivered' => $orderDelivered,
            'orderNdr' => $orderNdr,
            'orderRto' => $orderRto,
            'statusCounts' => $statusCounts,
            'dates' => $dates,
            'result' => $result,
            'codAmount' => $codAmount
        ]);
    }

    public function ClientEdit(Request $req, $id)
    {
        $params = AdminLoginCheck::where('id', $id)->first();
        return view('Admin.Clients.ClientEdit', ['params' => $params]);
    }

    public function ClientUpdate(Request $req)
    {
        echo "Loading...";
        $usernameemail = $req->email;
        if (!file_exists("Profiles/$usernameemail")) {
            mkdir("Profiles/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if (!is_null($profilepic)) {
            echo $img = $profilepic->getClientOriginalName();
            $profilepic->move("Profiles/$usernameemail/", $img);
            AdminLoginCheck::where('id', $req->customerid)->update(['profilepic' => $img]);
        }


        AdminLoginCheck::where('id', $req->customerid)
            ->update([

                'password' => $req->password,
                'name' => $req->companyname,
                'mobile' => $req->mobile,
                'companyname' => $req->companyname,
                'brandame' => $req->brand,
                'remmitanceday' => $req->remmitday,
                'maxcodvalue' => $req->maxcodorder,
                'maxliablilitshipment' => $req->maxliability,
                'actype' => $req->actuye,
                'freighttype' => $req->freighttype,
                'status' => $req->status
            ]);
        $req->session()->flash('status', 'Merchant details updated');
        return redirect("/New_Client_Edit/$req->customerid");
    }


    // Client Details
    public function ClientSetting(Request $req, $id)
    {
        $params = AdminLoginCheck::where('id', $id)->first();
        return view('Admin.Setting.all', ['params' => $params, 'id' => $id]);
    }
    public function ClientFinancial(Request $req, $id)
    {
        $params = financial::where('adminid', $id)->get();
        return view('Admin.Setting.financial', ['params' => $params, 'id' => $id]);
    }
    public function ClientBilling(Request $req, $id)
    {
        $params = billing::where('adminid', $id)->get();
        return view('Admin.Setting.billing', ['params' => $params, 'id' => $id]);
    }
    public function ClientCouriers(Request $req, $id)
    {

        $userid = session()->get('UserLoginid');
        $admins = AdminLoginCheck::where('usertype', 'admin')
            ->where('id', $userid)
            ->orderby('id', 'DESC')
            ->first();

        $lists = couriers::get();
        $params = courierlist::where('active_flg', 1)
            ->orderby('name', 'ASC')->orderby('cl_name', 'ASC')->get();
        $couriers = courierpermission::get();
        $permissions = courierpermission::where('user_id', $id)->get();
        return view('Admin.Setting.couriers', ['params' => $params, 'couriers' => $couriers, 'permissions' => $permissions, 'id' => $id, 'lists' => $lists, 'admins' => $admins]);
    }
    public function ClientPassword(Request $req, $id)
    {
        $params = AdminLoginCheck::where('id', $id)->first();
        return view('Admin.Setting.changepass', ['params' => $params, 'id' => $id]);
    }
    // Client Details
    // Courier Assign
    public function ClientCourierPermissions(Request $req)
    {
        $code = $req->code;
        $courier = $req->courier;
        $userid = $req->userid;
        $value = $req->value;
        $courieridno = $req->courieridno;


        $courierexistsornot = courierpermission::where('courier_code', $code)
            ->where('courier_by', $courier)
            ->where('user_id', $userid)
            ->get();
        if (count($courierexistsornot)) {
            courierpermission::where('courier_code', $code)
                ->where('courier_by', $courier)
                ->where('user_id', $userid)
                ->update(['admin_flg' => $value]);
        } else {
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
    public function MerchantSummary()
    {
        return view('Admin.Clients.summary');
    }
    public function MerchantSummarySearch(Request $req)
    {
        $fromdate = $req->startdatefrom;
        $fromdate = date('Y-m-d', strtotime($fromdate));
        // echo "<br>";
        $todate = $req->enddatefrom;
        $todate = date('Y-m-d', strtotime($todate));
        // exit();
        $params = bulkorders::where('Awb_Number', '!=', '')
            ->where('order_cancel', null)
            ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
            ->distinct()
            ->get('User_Id');

        $userwiseorder = array();
        foreach ($params as $param) {
            // echo "<br>";
            // echo "User Id : ";
            $userid = $param->User_Id;
            // echo " Total NO : ";
            $totalorders = bulkorders::where('User_Id', $userid)
                ->where('Awb_Number', '!=', '')
                ->where('order_cancel', null)
                ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
                ->count('Single_Order_Id');
            $usernameis = Allusers::where('id', $userid)->distinct()->get('name');
            foreach ($usernameis as $usernamei) {
                $username = $usernamei->name;
            }
            $userwiseorder[] = array("userid" => $userid, "username" => $username, "totalno" => $totalorders);
        }

        // echo "<pre>";
        // print_r($userwiseorder);
        // echo "</pre>";
        // exit();
        $totalusers = count($userwiseorder);
        $alltotalno = count($params);
        return view('Admin.Clients.summarysearch', ['params' => $userwiseorder, 'alltotalno' => $alltotalno, "totalusers" => $totalusers]);
    }
    // Merchant Summary
    // Courier Edit
    public function CourierEdit(Request $req, $id)
    {
        $params = couriers::orderby('courierid', 'DESC')->get();
        $users = Allusers::where('id', $id)->first();
        return view('Admin.Clients.ClientCourierUpdat', ['params' => $params, "Userid" => $id, 'users' => $users]);
    }

    public function CourierEditupt(Request $req)
    {
        $courierid = $req->currentcourierno;
        $userid = $req->userid;
        $couriername = couriers::where('courierid', $courierid)->first();
        $details = Allusers::where('id', $userid)->first();
        // echo "In : ";
        // echo $details['Intargos'];
        // echo "Ni : ";
        // echo $details['Nimbus'];
        // echo " : ";
        if ($couriername['name'] == "Intargos") {
            // echo "<br> Intargos <br> ";
            if ($details['Intargos'] == 1) {
                $a = Allusers::where('id', $userid)->update(['Intargos' => 0, 'intargos_active' => 0]);
                // echo " :Yes : ";
                // print_r($a);
            } else {
                $a = Allusers::where('id', $userid)->update(['Intargos' => 1, 'intargos_active' => 1]);
                // echo " | No : ";
                // print_r($a);
                // echo " : ";
            }
        }

        if ($couriername['name'] == "Nimbus") {
            // echo "<br> Nimbus <br> ";
            if ($details['Nimbus'] == 1) {
                $a = Allusers::where('id', $userid)->update(['Nimbus' => 0, 'nimbus_active' => 0]);
                // echo " :Yes : ";
                // print_r($a);
            } else {
                $a = Allusers::where('id', $userid)->update(['Nimbus' => 1, 'nimbus_active' => 1]);
                // echo " | No : ";
                // print_r($a);
                // echo " : ";
            }
        }
        // return "updated";
    }
    // Courier Edit




    public function Couriers()
    {
        $params = couriers::orderby('courierid', 'DESC')->get();

        $userid = session()->get('UserLoginid');
        $admins = AdminLoginCheck::where('usertype', 'admin')
            ->where('id', $userid)
            ->orderby('id', 'DESC')
            ->first();
        return view('Admin.Couriers.AllNew', ['params' => $params, 'admins' => $admins]);
    }

    public function CouriersAdd()
    {
        return view('Admin.Couriers.ClientNew');
    }
    public function CouriersAddupt(Request $req)
    {
        $qdata = couriers::where('email', $req->email)->first();
        if (empty($qdata['courierid'])) {
            // 
            $usernameemail = $req->email;
            if (!file_exists("Couriers/$usernameemail")) {
                mkdir("Couriers/$usernameemail");
            }
            $profilepic = $req->file('profilepic');
            if (!is_null($profilepic)) {
                $img = $profilepic->getClientOriginalName();
                $profilepic->move("Couriers/$usernameemail/", $img);
            } else {
                $img = "";
            }

            $query = new couriers();
            $query->name = $req->couriername;
            $query->email = $req->email;
            $query->logo = $img;
            $query->save();

            $req->session()->flash('status', 'New courier added');
            return redirect('/courier-new');
            // 
        } else {
            $req->session()->flash('status', 'Email already exist');
            return redirect('/courier-new');
        }
    }



    public function CouriersEdit(Request $req, $id)
    {
        $params = couriers::where('courierid', $id)->first();
        return view('Admin.Couriers.ClientMainEdit', ['params' => $params]);
    }

    public function CouriersEditupt(Request $req)
    {

        $usernameemail = $req->email;
        if (!file_exists("Couriers/$usernameemail")) {
            mkdir("Couriers/$usernameemail");
        }
        $profilepic = $req->file('profilepic');
        if (!is_null($profilepic)) {
            $img = $profilepic->getClientOriginalName();
            $profilepic->move("Couriers/$usernameemail/", $img);
            couriers::where('courierid', $req->courieridis)->update(['logo' => $img]);
        }

        couriers::where('courierid', $req->courieridis)
            ->update([
                'name' => $req->couriername,
                'email' => $req->email
            ]);
        $req->session()->flash('status', 'Courier details updated');
        return redirect("/courier-edit/$req->courieridis");
    }


    public function CourierPrice(Request $req, $id)
    {
        $params = couriers::where('courierid', $id)->first();
        return view('Admin.Couriers.ClientEdit', ['params' => $params]);
    }

    public function CourierPriceupt(Request $req)
    {
        couriers::where('courierid', $req->courieridis)
            ->update([
                'fbupto' => $req->weightslap,
                'fbwithcity' => "0",
                'fbwithstate' => $req->withstate,
                'fbwithzone' => $req->withzone,
                'fbmtetrotometro' => $req->metrotometro,
                'fbrestofindia' => $req->restofindia,
                'fbextralocation' => $req->extralocation,
                'fbspecaildestination' => $req->special,
                'fbcodcharge' => $req->codcharge,
                'fbcodchargepersent' => $req->codpersent,
                'faupto' => $req->aweightslap,
                'fawithcity' => "0",
                'fawithstate' => $req->awithstate,
                'fawihtzone' => $req->awithzone,
                'fametrotometro' => $req->ametrotometro,
                'faresttoindia' => $req->arestofindia,
                'faextralocation' => $req->aextralocation,
                'faspecialdestination' => $req->aspecial,
                'facodcharge' => $req->acodcharge,
                'facodchargepersent' => $req->acodpersent,
                'rbupto' => $req->rweightslap,
                'rpwihtcity' => "0",
                'rbwithstate' => $req->rwithstate,
                'rbwithzone' => $req->rwithzone,
                'rbmetrotometro' => $req->rmetrotometro,
                'rbresttoindia' => $req->rrestofindia,
                'rbextralocation' => $req->rextralocation,
                'rbspeciladestination' => $req->rspecial,
                'rbcodcharge' => $req->rcodcharge,
                'rbcodchargepersent' => $req->rcodpersent,
                'raupto' => $req->raweightslap,
                'rawithcity' => "0",
                'rawithstate' => $req->rawithstate,
                'rawithzone' => $req->rawithzone,
                'rametrotometro' => $req->rametrotometro,
                'raresttoindia' => $req->rarestofindia,
                'raextralocation' => $req->raextralocation,
                'raspecialdestination' => $req->raspecial,
                'racodcharge' => $req->racodcharge,
                'racodchargepersent' => $req->racodpersent
            ]);
        $req->session()->flash('status', 'Courier price update');
        return redirect("/courier-priceing/$req->courieridis");
    }
    public function RateListPermissions(Request $req, $id)
    {

        $paramsnew = price::where('user_id', $id)->get();
        // dd($paramsnew);
        return view('Admin.Setting.rate-list', ['id' => $id], compact('paramsnew'));
    }
    public function rateListEdit($id)
    {
        $price = Price::find($id);

        if (!$price) {
            // Handle the case where the price is not found (optional)
            return redirect()->route('Admin.RateManage.rate-edit')->with('error', 'Price not found.');
        }

        return view('Admin.RateManage.rate-edit', compact('price'));
    }
    public function rateListUpdate(Request $request)
    {
        // dd($request->all());

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
    public function AdminUserList()
    {
        $userid = session()->get('UserLoginid');

        $courier = price::where('admin_id', $userid)->get();
        return view('Admin.Setting.add-rate-list', compact('courier'));
    }
    public function AddUserList(Request $request)
    {

        // dd($request->all());
        $couriername = price::where('id', $request->courier)->first();
        $couriernew = $couriername->courier_name . $couriername->weight;
        // dd($couriernew);

        $query = new price();
        $query->courier_name = $couriernew;
        $query->name = $couriername->courier_name ?? $couriername->name;
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
        $query->user_id = $request->admin_id;

        $query->save();

        return redirect()->back();
    }
    public function RateManage()
    {
        $userid = session()->get('UserLoginid');


        $courier = price::where('admin_id', $userid)->get();
        // dd($courier);
        return view('Admin.RateManage.rate_manage', compact('courier'));
    }
}
