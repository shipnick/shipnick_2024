<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLoginCheck;
use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Allusers;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class Dashboard extends Controller
{

  // super
  public function SuperHome(Request $req)
  {
    if (!empty(session('UserLogin'))) {
      $userid = session()->get('UserLogin2id');
      $username1 = session()->get('UserLogin1name');
      // Today Orders UserPanel
      $fromdate = date('Y-m-d');
      $todate = date('Y-m-d');

      $totalOrder = bulkorders::count();
      $totalCod1 = bulkorders::where('Order_Type', 'COD')->count();
      $totalPrepaid1 = bulkorders::where('Order_Type', 'Prepaid')->count();

      // today 
      $todayOders = bulkorders::where('Rec_Time_Date', today())->count();
      $todayCod = bulkorders::where('Order_Type', 'COD')->where('Rec_Time_Date', today())->count();
      $todayPrepaid = bulkorders::where('Order_Type', 'Prepaid')->where('Rec_Time_Date', today())->count();

      // this month 
      $monthOders = bulkorders::whereMonth('Rec_Time_Date', now()->month)->count();
      $monthCod = bulkorders::where('Order_Type', 'COD')->whereMonth('Rec_Time_Date', now()->month)->count();
      $monthPrepaid = bulkorders::where('Order_Type', 'Prepaid')->whereMonth('Rec_Time_Date', now()->month)->count();

      


      $totalAdmin = Allusers::where('usertype', 'user')->take(10)->get(); // Get all admins

      $adminOrdersData = [];

      foreach ($totalAdmin as $admin) {
        // Calculate total orders for this admin
        $totalOrders = bulkorders::where('User_Id', $admin->id)->count();

        // Calculate total COD orders for this admin
        $totalCod = bulkorders::where('Order_Type', 'COD')->where('User_Id', $admin->id)->count();

        // Calculate total Prepaid orders for this admin
        $totalPrepaid = bulkorders::where('Order_Type', 'Prepaid')->where('User_Id', $admin->id)->count();

        // Store the results in an array or collection
        $adminOrdersData[] = [
          'username' => $admin->name,
          'admin_id' => $admin->crtuid,
          'total_orders' => $totalOrders,
          'total_cod' => $totalCod,
          'total_prepaid' => $totalPrepaid,
        ];
      }



      $adminOrdersData1 = [];
      foreach ($totalAdmin as $admin) {
        // Calculate total orders for this admin
        $totalOrders = bulkorders::where('User_Id', $admin->id)->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])->count();

        // Calculate total COD orders for this admin
        $totalCod = bulkorders::where('Order_Type', 'COD')->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])->where('User_Id', $admin->id)->count();

        // Calculate total Prepaid orders for this admin
        $totalPrepaid = bulkorders::where('Order_Type', 'Prepaid')->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])->where('User_Id', $admin->id)->count();

        // Store the results in an array or collection
        $adminOrdersData1[] = [
          'username' => $admin->name,
          'admin_id' => $admin->crtuid,
          'total_orders' => $totalOrders,
          'total_cod' => $totalCod,
          'total_prepaid' => $totalPrepaid,
        ];
      }
//  dd($adminOrdersData1);
      // $adminOrdersData now contains all the data you need for each admin
      


      return view('super-admin.Dashboard', compact('admin','adminOrdersData','adminOrdersData1','totalOrder','totalCod1','totalPrepaid1','todayOders','todayCod','todayPrepaid','monthOders','monthCod','monthPrepaid'));
    }

    return view('Login.super-login');
  }
  // Super









  public function Home(Request $req)
  {

    // dd($tallcomplete);




    if (!empty(session('UserLogin'))) {
      $userid = session()->get('UserLoginid');
      $TotalUser = AdminLoginCheck::where('crtuid', $userid)->count();

      // Get all user IDs for the given crtuid
      $user_ids = AdminLoginCheck::where('crtuid', $userid)->pluck('id');

      // Get the total count of completed orders for all user IDs
      $TotalUsersOrdders = bulkorders::whereIn('User_Id', $user_ids)
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->count('Single_Order_Id');


      $TotalUserlist = AdminLoginCheck::where('crtuid', $userid)->get();
      return view('Admin.Dashboard', compact('TotalUsersOrdders', 'TotalUser', 'TotalUserlist'));
    }


    return view('Login.Login');
  }

  public function Home1(Request $req)
  {
    $userid = session()->get('UserLoginid');
    //   dd($qdata);

    // Get all user IDs for the given crtuid
    $user_ids = AdminLoginCheck::where('crtuid', $userid)->pluck('id');

    // Get the total count of completed orders for all user IDs
    $tallcomplete = bulkorders::whereIn('User_Id', $user_ids)
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->count('Single_Order_Id');
    // dd($tallcomplete);




    if (!empty(session('UserLogin'))) {
      $userid = session()->get('UserLogin2id');
      //   dd($userid);
      $username1 = session()->get('UserLogin1name');
      // Today Orders UserPanel
      $fromdate = date('Y-m-d');
      $todate = date('Y-m-d');
      $tallcomplete = bulkorders::where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallpending = bulkorders::where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallrto = bulkorders::where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallcanceled = bulkorders::where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $talluploaded = bulkorders::where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      // Today Orders UserPanel
      // Today COD And Prepaid Orders UserPanel
      $tcodorders = bulkorders::where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tprepaid = bulkorders::where('Order_Type', 'Prepaid')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      // Today COD And Prepaid Orders UserPanel
      // Current Month Orders
      // Current Month
      $crtmonth = date("m");
      $crtyear = date("Y");
      $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
      $currentmonthstart = "1-$crtmonth-$crtyear";
      $currentmonthstend = "$crtmdays-$crtmonth-$crtyear";
      $currentmonthstart = date('d-m-Y', strtotime($currentmonthstart));
      $currentmonthstend = date('d-m-Y', strtotime($currentmonthstend));
      // Current Month
      $cfromdate = date('Y-m-d', strtotime($currentmonthstart));
      $ctodate = date('Y-m-d', strtotime($currentmonthstend));
      $callcomplete = bulkorders::where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $callpending = bulkorders::where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $callrto = bulkorders::where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $callcanceled = bulkorders::where('order_cancel', 1)
        ->whereBetween('canceldate', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $calluploaded = bulkorders::where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      // Current Month Orders
      // Today COD And Prepaid Orders UserPanel
      $ccodorders = bulkorders::where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $cprepaid = bulkorders::where('Order_Type', 'Prepaid')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      // Today COD And Prepaid Orders UserPanel

      return view('Admin.Dashboard', ['tallcomplete' => $tallcomplete, 'tallpending' => $tallpending, 'tallcancel' => $tallrto, 'talluploaded' => $talluploaded, 'tallcanceled' => $tallcanceled, 'tcodorders' => $tcodorders, 'tprepaid' => $tprepaid, 'ccodorders' => $ccodorders, 'cprepaid' => $cprepaid, 'callcomplete' => $callcomplete, 'callpending' => $callpending, 'callcancel' => $callrto, 'calluploaded' => $calluploaded]);
    }

    if (!empty(session('UserLogin2'))) {
      $userid = session()->get('UserLogin2id');

      $all = bulkorders::where('User_Id', $userid)->where('order_cancel', '!=', '1')->count('Single_Order_Id');

      $allcomplete = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->count('Single_Order_Id');

      $allpending = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_cancel', '!=', '1')
        ->count('Single_Order_Id');

      $allcancel = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->count('Single_Order_Id');

      return view('UserPanel.Dashboard', ['all' => $all, 'allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allcancel]);
      // return view('UserPanel.Dashboard');
    }

    //     	if(!empty(session('UserLogin3')))
    //         {
    // $riderid = session()->get('UserLogin3id');
    // $allrecords = bulkorders::where('order_riderid',$riderid)->count('Single_Order_Id');
    //
    // $pending = bulkorders::where('order_riderid',$riderid)
    //                     ->where('order_status_show','!=','Delivered')
    //                     ->where('order_status_show','!=','RTO Delivered')
    //                     ->where('order_status_show','!=','1')
    //                     ->count('Single_Order_Id');
    //
    // $complete = bulkorders::where('order_riderid',$riderid)
    //                     ->where('order_status_show','Delivered')
    //                     ->count('Single_Order_Id');
    //
    // $cancel = bulkorders::where('order_riderid',$riderid)
    //                     ->where('order_status_show','1')
    //                     ->count('Single_Order_Id');
    //
    //
    //             return view('RiderPanel.Dashboard',['allrecords'=>$allrecords,'pending'=>$pending,'complete'=>$complete,'cancel'=>$cancel]);
    //     		// return view('RiderPanel.Dashboard');
    //     	}
    // return view('Admin.Login');
    return view('Login.Login');
  }








  // New-Dashbaord
  public function NewDashboard(Request $req)
  {
    if (!empty(session('UserLogin'))) {
      $userid = session()->get('UserLogin2id');


      // Last 6 Month Data
      $fromdate = date('Y-m-d', strtotime("-6 Months"));
      $todate = date('Y-m-d');
      $l6delivered = bulkorders::where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6rtd = bulkorders::where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6rto = bulkorders::where('order_status_show', 'RTO-InTransit')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Out For Delhivery')
        ->where('order_status_show', '!=', 'RTO-InTransit')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6canceled = bulkorders::where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6uploaded = bulkorders::where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');

      $l6total = $l6delivered + $l6rtd + $l6ofd + $l6rto + $l6intransit;
      // Last 6 Month Data
      // Last 6 Week Performance
      $fromdate = date('Y-m-d', strtotime("-42 Days"));
      $todate = date('Y-m-d');
      $w6delivered = bulkorders::where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6rtd = bulkorders::where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6rto = bulkorders::where('order_status_show', 'RTO-InTransit')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Out For Delhivery')
        ->where('order_status_show', '!=', 'RTO-InTransit')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6canceled = bulkorders::where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6uploaded = bulkorders::where('order_status_show', 'Upload')
        ->where('order_cancel', null)
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');

      $w6total = $w6delivered + $w6rtd + $w6ofd + $w6rto + $w6intransit;
      // Last 6 Week Performance
      return view('Admin.newdashboard', ['l6delivered' => $l6delivered, 'l6rtd' => $l6rtd, 'l6ofd' => $l6ofd, 'l6rto' => $l6rto, 'l6intransit' => $l6intransit, 'l6total' => $l6total, 'w6delivered' => $w6delivered, 'w6rtd' => $w6rtd, 'w6ofd' => $w6ofd, 'w6rto' => $w6rto, 'w6intransit' => $w6intransit, 'w6total' => $w6total]);
    }

    if (!empty(session('UserLogin2'))) {
      $userid = session()->get('UserLogin2id');
      $all = bulkorders::where('User_Id', $userid)->where('order_cancel', '!=', '1')->count('Single_Order_Id');

      $allcomplete = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->count('Single_Order_Id');

      $allpending = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_cancel', '!=', '1')
        ->count('Single_Order_Id');

      $allcancel = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->count('Single_Order_Id');

      return view('UserPanel.Dashboard', ['all' => $all, 'allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allcancel]);
      // return view('UserPanel.Dashboard');
    }
    return view('Login.Login');
  }
  // New-Dashbaord





  // Dashboard Today Booking
  public function TodayBookingDash(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $manifest = bulkorders::where('order_status_show', 'Manifest')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = $uploaded;
    $manifest = $manifest;
    $total = $uploaded + $manifest;
    return view('Admin.DashboardData.DashboardTodayBooking', ['total' => $total, 'uploaded' => $uploaded, 'manifest' => $manifest]);
  }
  // Dashboard Today Booking End
  // Dashboard Current Month
  public function CurrentOrdersDash(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $rtdo = $rtd + $rto;
    $ofdintrans = $ofd + $intransit;
    $total = $delivered + $rtdo + $ofdintrans;
    return view('Admin.DashboardData.DashboardCrtMonth', ['total' => $total, 'delivered' => $delivered, 'ofdintrans' => $ofdintrans, 'rtdo' => $rtdo]);
  }
  // Dashboard Current Month End
  // Dashboard Last Month
  public function LastOrdersDash(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $rtdo = $rtd + $rto;
    $ofdintrans = $ofd + $intransit;
    $total = $delivered + $rtdo + $ofdintrans;
    return view('Admin.DashboardData.DashboardLastMonth', ['total' => $total, 'delivered' => $delivered, 'ofdintrans' => $ofdintrans, 'rtdo' => $rtdo]);
  }
  // Dashboard Last Month End
  // Dashboard Today
  public function TodayOrdersDash(Request $req)
  {
    // $stdate = date("d-m-Y");
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $rtdo = $rtd;
    $ofdintrans = $ofd;
    $total = $delivered + $ofdintrans + $rtdo;
    return view('Admin.DashboardData.DashboardToday', ['total' => $total, 'delivered' => $delivered, 'ofdintrans' => $ofdintrans, 'rtdo' => $rtdo]);
  }
  // Dashboard Today End
  // Order Performance  // 
  public function OrderPerformanceDash(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // Today COD And Prepaid Orders UserPanel
    $tcodorders = bulkorders::where('Order_Type', 'COD')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $tprepaid = bulkorders::where('Order_Type', 'Prepaid')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Today COD And Prepaid Orders UserPanel

    return $monday = array("cod" => $tcodorders, "prepaid" => $tprepaid);
  }
  // Order Performance  // 




  // Coureir Details
  public function CourierDay90Orders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // exit(); 
    $dlorders = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xborders = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return $courierdata = array('dl' => $dlorders, 'xb' => $xborders);
    // $courierdata = json_encode($courierdata);
    // $courierdata;
    echo "90";
    // return print_r($courierdata);
  }
  // Coureir Details
  // Coureir Performance Details
  public function CourierDay90Performance(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // exit(); 
    $dldelivered = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $dlrtd = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $dlintransit = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xbdelivered = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xbrtd = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xbintransit = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return $courierdata = array('dldelivered' => $dldelivered, 'dlrtd' => $dlrtd, 'dlintransit' => $dlintransit, 'xbdelivered' => $xbdelivered, 'xbrtd' => $xbrtd, 'xbintransit' => $xbintransit);
    // $courierdata = json_encode($courierdata);
    // echo "90";
  }
  // Coureir Performance Details
  // Order Performance Details
  public function CourierOrder90Performance(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // exit(); 
    $dldelivered = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $dlrtd = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $dlintransit = bulkorders::where('awb_gen_by', 'Delhivery')
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xbdelivered = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xbrtd = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $xbintransit = bulkorders::where('awb_gen_by', 'Xpressbees')
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $courierdata = array('dldelivered' => $dldelivered, 'dlrtd' => $dlrtd, 'dlintransit' => $dlintransit, 'xbdelivered' => $xbdelivered, 'xbrtd' => $xbrtd, 'xbintransit' => $xbintransit);
    $courierdata = json_encode($courierdata);
    echo "90";
  }
  // Order Performance Details





  public function TodayOrders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "Today";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.Today', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function YesterdayOrders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "YesterDay";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.Yesterday', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }





  // Admin Data Filter End
  public function adminDataFilter(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $total = $delivered + $rtd + $ofd + $rto + $intransit;
    return view('Admin.DashboardData.adminDataFilter', ['total' => $total, 'delivered' => $delivered, 'rtd' => $rtd, 'ofd' => $ofd, 'rto' => $rto, 'intransit' => $intransit, 'canceled' => $canceled, 'uploaded' => $uploaded]);
  }
  // Admin Data Filter End
  // Admin Courier Wise Performance
  public function courierWisePerformance(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // Intargos
    $indelivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Intargos')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $inrtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Intargos')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $inintransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Intargos')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Intargos
    // Nimbus
    $nidelivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Nimbus')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $nirtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Nimbus')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $niintransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Nimbus')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Nimbus

    // $total = $indelivered+$inrtd+$inintransit
    // $total = $nidelivered+$nirtd+$niintransit
    return $arrayName = array('indelivered' => $indelivered, 'inrtd' => $inrtd, 'inintransit' => $inintransit, 'nidelivered' => $nidelivered, 'nirtd' => $nirtd, 'niintransit' => $niintransit);
    // return view('Admin.DashboardData.courierWisePerformance',['indelivered'=>$indelivered,'inrtd'=>$inrtd,'inintransit'=>$inintransit,'nidelivered'=>$nidelivered,'nirtd'=>$nirtd,'niintransit'=>$niintransit]);
  }
  // Admin Courier Wise Performance
  // Admin Zone Wise Performance
  public function zoneWisePerformance(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // Zone-A
    $adlvd = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'A')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $artd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'A')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $aintsit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'A')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Zone-A
    // Zone-B
    $bdlvd = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'B')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $brtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'B')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $bintsit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'B')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Zone-B
    // Zone-C
    $cdlvd = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'C')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $crtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'C')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $cintsit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'C')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Zone-C
    // Zone-D
    $ddlvd = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'D')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $drtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'D')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $dintsit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'D')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Zone-D
    // Zone-E
    $edlvd = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'E')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ertd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'E')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $eintsit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'E')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Zone-E
    // Zone-F
    $fdlvd = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'F')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $frtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'F')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $fintsit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'F')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // Zone-F
    // $Zone_A = 'adlvd'=>$adlvd,'artd'=>$artd,'aintsit'=>$aintsit
    // $Zone_B = 'bdlvd'=>$bdlvd,'brtd'=>$brtd,'bintsit'=>$bintsit
    // $Zone_C = 'cdlvd'=>$ddlvd,'crtd'=>$crtd,'cintsit'=>$cintsit
    // $Zone_D = 'ddlvd'=>$ddlvd,'drtd'=>$drtd,'dintsit'=>$dintsit
    // $Zone_E = 'edlvd'=>$edlvd,'ertd'=>$ertd,'eintsit'=>$eintsit
    // $Zone_F = 'fdlvd'=>$fdlvd,'frtd'=>$frtd,'fintsit'=>$fintsit

    return $arrayName = array('adlvd' => $adlvd, 'artd' => $artd, 'aintsit' => $aintsit, 'bdlvd' => $bdlvd, 'brtd' => $brtd, 'bintsit' => $bintsit, 'cdlvd' => $ddlvd, 'crtd' => $crtd, 'cintsit' => $cintsit, 'ddlvd' => $ddlvd, 'drtd' => $drtd, 'dintsit' => $dintsit, 'edlvd' => $edlvd, 'ertd' => $ertd, 'eintsit' => $eintsit, 'fdlvd' => $fdlvd, 'frtd' => $frtd, 'fintsit' => $fintsit);
  }
  // Admin Zone Wise Performance





  public function CurrentOrders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $total = $delivered + $rtd + $ofd + $rto + $intransit;
    return view('Admin.DashboardData.CurrentMonth', ['total' => $total, 'delivered' => $delivered, 'rtd' => $rtd, 'ofd' => $ofd, 'rto' => $rto, 'intransit' => $intransit, 'canceled' => $canceled, 'uploaded' => $uploaded]);
  }


  public function LastOrders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $total = $delivered + $rtd + $ofd + $rto + $intransit;
    return view('Admin.DashboardData.LastMonth', ['total' => $total, 'delivered' => $delivered, 'rtd' => $rtd, 'ofd' => $ofd, 'rto' => $rto, 'intransit' => $intransit, 'canceled' => $canceled, 'uploaded' => $uploaded]);
  }

  public function Day7Orders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "7 Days";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.Last7Days', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day30Orders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $total = $delivered + $rtd + $ofd + $rto + $intransit;
    return view('Admin.DashboardData.Last30Days', ['total' => $total, 'delivered' => $delivered, 'rtd' => $rtd, 'ofd' => $ofd, 'rto' => $rto, 'intransit' => $intransit, 'canceled' => $canceled, 'uploaded' => $uploaded]);
  }


  public function Day90Orders(Request $req)
  {
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // exit();
    $delivered = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $total = $delivered + $rtd + $ofd + $rto + $intransit;
    return view('Admin.DashboardData.Last90Days', ['total' => $total, 'delivered' => $delivered, 'rtd' => $rtd, 'ofd' => $ofd, 'rto' => $rto, 'intransit' => $intransit, 'canceled' => $canceled, 'uploaded' => $uploaded]);
  }




  public function TodayOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "Today";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.TodayGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function YesterdayOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "YesterDay";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.YesterdayGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }


  public function CurrentOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "Current";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.CurrentMonthGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function LastOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "Last";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.LastMonthGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day7OrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "7 Days";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.Last7DaysGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day30OrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "30 Days";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.Last30DaysGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day90OrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // $req->val;
    // echo "90 Days";
    // return "Today";
    $allcomplete = bulkorders::where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('Admin.DashboardData.Last90DaysGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
}
