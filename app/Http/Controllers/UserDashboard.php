<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Allusers;
use \PDF;
use Carbon\Carbon;
use DB;
use Hamcrest\Core\IsNull;

class UserDashboard extends Controller
{


  public function pdfchecking()
  {
    $pdf = PDF::loadView('UserPanel.PDF.labels_invoice');
    return $pdf->download('labels_invoice.pdf');
  }
  public function Home()
  {
    // Get the user ID from the session
    $userid = session()->get('UserLogin2id');

    // Get the first and last day of the current month
    $fromDate = Carbon::now()->startOfMonth()->toDateString();
    $toDate = Carbon::now()->endOfMonth()->toDateString();
    // $fromDateto = Carbon::yesterday()->toDateString();  // Start of tomorrow (YYYY-MM-DD)
    // dd($fromDateto,$toDate);

    $callpending = bulkorders::where('User_Id', $userid)
      ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Time_Stamp', [$fromDate, $toDate])
      ->count('Single_Order_Id');


    // Count the orders for the current month
    $MonthlyOrder = BulkOrders::where('User_Id', $userid)
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->count('Single_Order_Id');

    $codamount = bulkorders::where('User_Id', $userid)
      ->where('Order_Type', 'COD')
      ->where('showerrors', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->sum('Cod_Amount');

    $callpending1 = bulkorders::where('User_Id', $userid)
      ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->count('Single_Order_Id');
    $monthndr = bulkorders::where('User_Id', $userid)
      ->whereIn('showerrors', ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'])
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->count('Single_Order_Id');

    $xpressbee = BulkOrders::where('User_Id', $userid)
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_by', 'Xpressbee')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->count('Single_Order_Id');
    $Ecom = BulkOrders::where('User_Id', $userid)
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_by', 'Ecom')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->count('Single_Order_Id');
    $Bluedart = BulkOrders::where('User_Id', $userid)
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_by', 'bluedart')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [$fromDate, $toDate])
      ->count('Single_Order_Id');


    // Pass the count to the view
    return view('UserPanel.home', compact('MonthlyOrder', 'monthndr', 'callpending', 'codamount', 'xpressbee', 'Ecom', 'Bluedart'));
  }


  public function  UserHome(Request $request)
  {
    if (!empty(session('UserLogin'))) {
      return view('Admin.Dashboard');
    }

    if (!empty(session('UserLogin2'))) {
      $userid = session()->get('UserLogin2id');
      // Today Orders UserPanel
      $fromdate = Carbon::parse($request->start_date)->startOfDay(); // Start of the day for $cfromdate
      $todate = Carbon::parse($request->end_date)->endOfDay(); // End of the day for $ctodate
      // $fromdate = date('Y-m-d');
      // $todate = date('Y-m-d');
      $tallNDR = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallcomplete = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallpending = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Upload')
        ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])

        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallrto = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallcanceled = bulkorders::where('User_Id', $userid)
        ->where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $talluploaded = bulkorders::where('User_Id', $userid)
        // ->where('order_status_show','Upload')
        ->where('order_cancel', '!=', '1')
        ->where('Awb_Number', '!=', '')
        ->whereBetween('Last_Time_Stamp', array($fromdate, $todate))
        ->count('Single_Order_Id');
      // Today Orders UserPanel
      $ccodorders = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');

      $cprepaid = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'Prepaid')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      if ($talluploaded > 0) {
        $codPercentage = ($ccodorders / $talluploaded) * 100;
        $prepaidPercentage = ($cprepaid / $talluploaded) * 100;
      } else {
        // Set percentages to 0 if $talluploaded is zero to avoid division by zero error
        $codPercentage = 0;
        $prepaidPercentage = 0;
      }


      // Today COD And Prepaid Orders UserPanel
      $tcodorders = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tprepaid = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'Prepaid')
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

      $cfromdateObj = Carbon::parse($request->start_date)->startOfDay();  // Start of the day for $cfromdate
      $ctodateObj = Carbon::parse($request->end_date)->endOfDay(); // End of the day for $ctodate



      $callcomplete = bulkorders::where('User_Id', $userid)
        //   ->where('order_status_show','Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('showerrors', '!=', 'cancelled')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])

        ->count('Single_Order_Id');
      $calldeliverd = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['delivered', 'Delivered'])
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->count('Single_Order_Id');


      // ->whereIn('showerrors', ['exception', 'Shipment Redirected','Undelivered'])
      $monthndr = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'])
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->count('Single_Order_Id');

      $monthpickup = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->count('Single_Order_Id');

      $callretrun = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])


        ->count('Single_Order_Id');
      $callintransit = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',  'Shipment Booked'])
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->where(function ($query) {
          $query->where('showerrors', 'intranit')

            ->orWhere('showerrors', 'Connected')
            ->orWhere('showerrors', 'in transit')
            ->orWhere('showerrors', 'Ready for Connection')

            ->orWhere('showerrors', 'In-Transit');
        })
        ->count('Single_Order_Id');
      $callpending = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup'])
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $callrto = bulkorders::where('User_Id', $userid)

        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $callcanceled = bulkorders::where('User_Id', $userid)
        ->where('order_cancel', 1)
        ->whereBetween('canceldate', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $calluploaded = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      // Current Month Orders
      // Today COD And Prepaid Orders UserPanel
      $ccodpendingorders = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')

        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');


      $ccodorders = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $cprepaid = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'Prepaid')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      // Today COD And Prepaid Orders UserPanel
      // intransit 
      $intransitupload = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['In Transit', 'intranit', 'In-Transit', 'Connected', 'Ready for Connection'])
        // ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');

      $last90DaysCount = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['delivered', 'Delivered'])
        ->where('Rec_Time_Date', '>=', Carbon::now()->subDays(90))
        ->sum('Total_Amount');

      $thisWeekCount = bulkorders::where('User_Id', $userid)
      ->whereIn('showerrors', ['delivered', 'Delivered'])
      ->where('Rec_Time_Date', '>=', Carbon::now()->subDays(7))
      ->sum('Total_Amount');

      $thisMonthCount = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['delivered', 'Delivered'])
        ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->sum('Total_Amount');

      $thisQuarterCount = bulkorders::where('User_Id', $userid)
        ->whereIn('showerrors', ['delivered', 'Delivered'])
        ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])
        ->sum('Total_Amount');


      $zone = bulkorders::select('zone', \DB::raw('count(Single_Order_Id) as order_count'))
        ->where('User_Id', $userid)

        ->groupBy('zone')
        ->get();

      $counts = bulkorders::select('zone', DB::raw('count(*) as count'))
        ->where('User_Id', $userid)
        ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->groupBy('zone')
        ->get()
        ->pluck('count', 'zone');

      // Initialize counts for zones A, B, C, D, E
      $zoneCounts = [
        'A' => $counts->get('A', 0),
        'B' => $counts->get('B', 0),
        'C' => $counts->get('C', 0),
        'D' => $counts->get('D', 0),
        'E' => $counts->get('E', 0),
      ];





      // cod amount 
      // $codamount = bulkorders::where('User_Id',$userid)
      //                     ->where('order_status_show','!=','Out For Delhivery')
      //                     ->where('order_status_show','!=','RTO-InTransit')
      //                     ->where('Awb_Number','!=','')
      //                     ->where('order_cancel','!=','1')
      //                     ->where('order_status_show','=','Delivered')
      //                     ->whereBetween('Last_Stamp_Date', array($fromdate,$todate))
      //                     ->sum('Cod_Amount');
      // dd($codamount);

      $codamount = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('showerrors', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->sum('Cod_Amount');

        $xpressbee = BulkOrders::where('User_Id', $userid)
        ->where('Awb_Number', '!=', '')
        ->where('awb_gen_by', 'Xpressbee')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->count('Single_Order_Id');
      $Ecom = BulkOrders::where('User_Id', $userid)
        ->where('Awb_Number', '!=', '')
        ->where('awb_gen_by', 'Ecom')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->count('Single_Order_Id');
      $Bluedart = BulkOrders::where('User_Id', $userid)
        ->where('Awb_Number', '!=', '')
        ->where('awb_gen_by', 'bluedart')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->count('Single_Order_Id');

        $MonthlyOrder = BulkOrders::where('User_Id', $userid)
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
      ->count('Single_Order_Id');



      $bluedartCounts = bulkorders::where('User_Id', $userid)
        ->where('awb_gen_by', 'Ecom')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        // ->where('showerrors', '!=', 'cancelled')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->selectRaw(
          '
        COUNT(CASE 
            WHEN showerrors IN ( "Shipment Not Handed over") THEN 1 
            ELSE NULL 
        END) AS pendingBluedartcount,
        COUNT(CASE 
           WHEN showerrors IN ("In-Transit", "Connected","intranit","Ready for Connection") THEN 1 
            ELSE NULL 
        END) AS inTransitBluedartcount,
        COUNT(CASE 
        WHEN showerrors IN ("Out For Delivery") THEN 1 
           
            ELSE NULL 
        END) AS OfdBluedartcount,
        COUNT(CASE 
            WHEN showerrors = "Delivered" THEN 1 
            ELSE NULL 
        END) AS DeliveredBluedartcount,
        COUNT(CASE 
            WHEN showerrors IN ("Undelivered","Shipment Redirected") THEN 1 
            ELSE NULL 
        END) AS RtoBluedartcount,
        COUNT(*) AS Bluedartcount'
        )
        ->first();

      $data1 = [
        'Bluedartcount' => $bluedartCounts->Bluedartcount,
        'pendingBluedartcount' => $bluedartCounts->pendingBluedartcount,
        'inTransitBluedartcount' => $bluedartCounts->inTransitBluedartcount,
        'OfdBluedartcount' => $bluedartCounts->OfdBluedartcount,
        'DeliveredBluedartcount' => $bluedartCounts->DeliveredBluedartcount,
        'RtoBluedartcount' => $bluedartCounts->RtoBluedartcount,
      ];

      $bluedartCounts1 = bulkorders::where('User_Id', $userid)
        ->where('awb_gen_by', 'Xpressbee')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->where('showerrors', '!=', 'cancelled')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->selectRaw(
          '
        COUNT(CASE 
            WHEN showerrors  = "pending pickup" THEN 1
            ELSE NULL 
        END) AS pendingBluedartcount,
        COUNT(CASE 
            WHEN showerrors  = "In Transit" THEN 1
            ELSE NULL 
        END) AS inTransitBluedartcount,
        COUNT(CASE 
            WHEN showerrors = "out for delivery" THEN 1 
            ELSE NULL 
        END) AS OfdBluedartcount,
        COUNT(CASE 
            WHEN showerrors = "delivered" THEN 1 
            ELSE NULL 
        END) AS DeliveredBluedartcount,
        COUNT(CASE 
           WHEN showerrors IN ("rto", "exception") THEN 1
            
            ELSE NULL 
        END) AS RtoBluedartcount,
        
        COUNT(*) AS Bluedartcount'
        )
        ->first();

      $data2 = [
        'Bluedartcount' => $bluedartCounts1->Bluedartcount,
        'pendingBluedartcount' => $bluedartCounts1->pendingBluedartcount,
        'inTransitBluedartcount' => $bluedartCounts1->inTransitBluedartcount,
        'OfdBluedartcount' => $bluedartCounts1->OfdBluedartcount,
        'DeliveredBluedartcount' => $bluedartCounts1->DeliveredBluedartcount,
        'RtoBluedartcount' => $bluedartCounts1->RtoBluedartcount,

      ];

      //   shiprocket order details      
      $shiprocketCounts1 = bulkorders::where('User_Id', $userid)
        ->where('awb_gen_by', 'Bluedart')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->where('showerrors', '!=', 'cancelled')
        ->whereBetween('Last_Time_Stamp', [$cfromdateObj, $ctodateObj])
        ->selectRaw(
          '
        COUNT(CASE 
            WHEN order_status_show IN ("1", "13", "15", "19", "20", "27", "52","3") THEN 1
            ELSE NULL 
        END) AS pendingBluedartcount,
        COUNT(CASE 
            WHEN order_status_show IN ("6","18","22","23","38","39","42","48","49","50","51") THEN 1
            ELSE NULL 
        END) AS inTransitBluedartcount,
        COUNT(CASE 
            WHEN order_status_show = "17" THEN 1 
            ELSE NULL 
        END) AS OfdBluedartcount,
        COUNT(CASE 
            WHEN order_status_show = "7" THEN 1 
            ELSE NULL 
        END) AS DeliveredBluedartcount,
        COUNT(CASE 
            WHEN order_status_show IN ("9","10","14","41","46"    ,"21", "40" ,"47", "8","16","45","12" , "24", "25" , "44","0") THEN 1
            ELSE NULL 
        END) AS RtoBluedartcount,
        COUNT(*) AS Bluedartcount
        '
        )
        ->first();

      $data3 = [
        'Bluedartcount' => $shiprocketCounts1->Bluedartcount,
        'pendingBluedartcount' => $shiprocketCounts1->pendingBluedartcount,
        'inTransitBluedartcount' => $shiprocketCounts1->inTransitBluedartcount,
        'OfdBluedartcount' => $shiprocketCounts1->OfdBluedartcount,
        'DeliveredBluedartcount' => $shiprocketCounts1->DeliveredBluedartcount,
        'RtoBluedartcount' => $shiprocketCounts1->RtoBluedartcount,
      ];





      $startDate = Carbon::now()->subDays(30);
      // Get the date 30 days ago from today

      $statusCounts = [
        'totalOrder' => [],
        'pickup' => [],
        'in_transit' => [],
        'NDR' => [],
        'ofd' => [],
        'Deliverd' => [],
        'RTO' => [],
      ];

      // Get the date range for the last seven days
      $dates = [];
      for ($i = 6; $i >= 0; $i--) {
        $dates[] = Carbon::now()->subDays($i)->toDateString();
      }

      foreach ($dates as $date) {
        $startOfDay = Carbon::parse($date)->startOfDay();
        $endOfDay = Carbon::parse($date)->endOfDay();

        // Fetch counts for each status for the current day
        $statusCounts['totalOrder'][$date] = bulkorders::where('User_Id', $userid)
          ->where('Awb_Number', '!=', '')
          //  ->where('showerrors','!=', 'Pincode not serviceable.')
          ->where('order_cancel', '!=', '1')
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');

        $statusCounts['pickup'][$date] = bulkorders::where('User_Id', $userid)
          ->where('order_cancel', '!=', '1')
          ->whereIn('showerrors', ['Pickup Scheduled', 'Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])

          // ... other conditions 
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');

        $statusCounts['in_transit'][$date] = bulkorders::where('User_Id', $userid)
          // ->whereNotIn('order_status_show', ['Delivered', 'RTO Delivered', 'Out For Delhivery', 'RTO-InTransit', 'Upload'])
          // ->whereIn('showerrors', ['In-Transit', 'in transit','Connected', 'intranit','Ready for Connection'])
          ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',  'Shipment Booked'])

          ->whereNotNull('Awb_Number')
          ->where('order_cancel', '!=', '1')
          // ... other conditions
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');

        $statusCounts['NDR'][$date] = bulkorders::where('User_Id', $userid)
          //   ->whereIn('showerrors', ['exception', 'Shipment Redirected'])

          ->whereIn('showerrors', ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED', 'NDR'])
          //   ->where('order_status_show', '!=', 'Delivered')
          //   ->where('order_status_show', '!=', 'RTO Delivered')
          ->where('order_cancel', '!=', '1')

          // ... other conditions
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');

        $statusCounts['ofd'][$date] = bulkorders::where('User_Id', $userid)
          ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
          //   ->where('order_status_show', 'Out For Delhivery')
          ->where('Awb_Number', '!=', '')
          ->where('order_cancel', '!=', '1')

          // ... other conditions
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');

        $statusCounts['Deliverd'][$date] = bulkorders::where('User_Id', $userid)
          ->whereIn('showerrors', ['delivered', 'Delivered'])
          ->where('Awb_Number', '!=', '')
          ->where('order_cancel', '!=', '1')


          // ... other conditions
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');

        $statusCounts['RTO'][$date] = bulkorders::where('User_Id', $userid)
          //   ->whereIn('showerrors', ['rto', 'Undelivered'])
          ->whereIn('showerrors', ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'])
          ->where('Awb_Number', '!=', '')
          ->where('order_cancel', '!=', '1')

          // ... other conditions
          ->whereBetween('Last_Time_Stamp', [$startOfDay, $endOfDay])
          ->count('Single_Order_Id');


        // Repeat this process for other status types
      }

      // Consolidate the data into the format you need
      $data = [];
      foreach ($statusCounts as $status => $counts) {
        $data[$status] = $counts;
      }

      $data = [
        'ccodpendingorders' => $ccodpendingorders,
        'tallndr' => $tallNDR,
        'tallcomplete' => $tallcomplete,
        'tallpending' => $tallpending,
        'tallcancel' => $tallrto,
        'callrto' => $callrto,
        'talluploaded' => $talluploaded,
        'callintransit' => $callintransit,
        'tallcanceled' => $tallcanceled,
        'calldeliverd' => $calldeliverd,
        'callretrun' => $callretrun,
        'monthndr' => $monthndr,
        'monthpickup' => $monthpickup,
        'tcodorders' => $tcodorders,
        'tprepaid' => $tprepaid,
        'ccodorders' => $ccodorders,
        'cprepaid' => $cprepaid,
        'callcomplete' => $callcomplete,
        'callpending' => $callpending,
        'callcancel' => $callrto,
        'calluploaded' => $calluploaded,
        'intransitupload' => $intransitupload,
        'codamount' => $codamount,
        'prepaidPercentage' => $prepaidPercentage,
        'codPercentage' => $codPercentage,
        'data' => $data,
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3,
        'zone' => $zone,
        'last90DaysCount' => $last90DaysCount,
        'thisWeekCount' => $thisWeekCount,
        'thisMonthCount' => $thisMonthCount,
        'thisQuarterCount' => $thisQuarterCount,
        'zoneCounts'=>$zoneCounts,
        'xpressbee'=>$xpressbee, 
        'Ecom'=>$Ecom, 
        'Bluedart'=>$Bluedart,
        'MonthlyOrder'=>$MonthlyOrder

      ];

      return view('UserPanel.Dashboard1', $data);
    }

    // 	return view('Admin.Login');
    return view('Login.Login');
    // return view('UserPanel.Dashboard');
  }



  // New Dashboard Start
  // New-Dashbaord
  public function NewDashboard(Request $req)
  {

    if (!empty(session('UserLogin'))) {
      return view('Admin.Dashboard');
    }
    if (!empty(session('UserLogin2'))) {

      $userid = session()->get('UserLogin2id');
      // Today Orders UserPanel
      $fromdate = date('Y-m-d');
      $todate = date('Y-m-d');
      $tallcomplete = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallpending = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallrto = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tallcanceled = bulkorders::where('User_Id', $userid)
        ->where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $talluploaded = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      // Today Orders UserPanel
      // Today COD And Prepaid Orders UserPanel
      $tcodorders = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $tprepaid = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'Prepaid')
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
      $callcomplete = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $callpending = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $callrto = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $callcanceled = bulkorders::where('User_Id', $userid)
        ->where('order_cancel', 1)
        ->whereBetween('canceldate', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $calluploaded = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      // Current Month Orders
      // Today COD And Prepaid Orders UserPanel
      $ccodorders = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'COD')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      $cprepaid = bulkorders::where('User_Id', $userid)
        ->where('Order_Type', 'Prepaid')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($cfromdate, $ctodate))
        ->count('Single_Order_Id');
      // Today COD And Prepaid Orders UserPanel

      // Last 6 Month Data
      $fromdate = date('Y-m-d', strtotime("-6 Months"));
      $todate = date('Y-m-d');
      $l6delivered = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6rtd = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6ofd = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Out For Delhivery')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6rto = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO-InTransit')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6intransit = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Out For Delhivery')
        ->where('order_status_show', '!=', 'RTO-InTransit')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6canceled = bulkorders::where('User_Id', $userid)
        ->where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $l6uploaded = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Upload')
        ->where('order_cancel', '!=', '1')
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');

      $l6total = $l6delivered + $l6rtd + $l6ofd + $l6rto + $l6intransit;
      // Last 6 Month Data
      // Last 6 Week Performance
      $fromdate = date('Y-m-d', strtotime("-42 Days"));
      $todate = date('Y-m-d');
      $w6delivered = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('delivereddate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6rtd = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO Delivered')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('rtodate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6ofd = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Out For Delhivery')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6rto = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'RTO-InTransit')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6intransit = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', '!=', 'Delivered')
        ->where('order_status_show', '!=', 'RTO Delivered')
        ->where('order_status_show', '!=', 'Out For Delhivery')
        ->where('order_status_show', '!=', 'RTO-InTransit')
        ->where('order_status_show', '!=', 'Upload')
        ->where('Awb_Number', '!=', '')
        ->where('order_cancel', null)
        ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6canceled = bulkorders::where('User_Id', $userid)
        ->where('order_cancel', 1)
        ->whereBetween('canceldate', array($fromdate, $todate))
        ->count('Single_Order_Id');
      $w6uploaded = bulkorders::where('User_Id', $userid)
        ->where('order_status_show', 'Upload')
        ->where('order_cancel', null)
        ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
        ->count('Single_Order_Id');

      $w6total = $w6delivered + $w6rtd + $w6ofd + $w6rto + $w6intransit;
      // Last 6 Week Performance
      return view('UserPanel.newdashboard', ['tallcomplete' => $tallcomplete, 'tallpending' => $tallpending, 'tallcancel' => $tallrto, 'talluploaded' => $talluploaded, 'tallcanceled' => $tallcanceled, 'tcodorders' => $tcodorders, 'tprepaid' => $tprepaid, 'ccodorders' => $ccodorders, 'cprepaid' => $cprepaid, 'callcomplete' => $callcomplete, 'callpending' => $callpending, 'callcancel' => $callrto, 'calluploaded' => $calluploaded, 'l6delivered' => $l6delivered, 'l6rtd' => $l6rtd, 'l6ofd' => $l6ofd, 'l6rto' => $l6rto, 'l6intransit' => $l6intransit, 'l6total' => $l6total, 'w6delivered' => $w6delivered, 'w6rtd' => $w6rtd, 'w6ofd' => $w6ofd, 'w6rto' => $w6rto, 'w6intransit' => $w6intransit, 'w6total' => $w6total]);
    }
    return view('Login.Login');
  }
  // New-Dashbaord
  // New Dashboard End


  // Dashboard Today Booking
  public function TodayBookingDash(Request $req)
  {
    $userid = session()->get('UserLogin2id');
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $uploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $manifest = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Manifest')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = $uploaded;
    $manifest = $manifest;
    $total = $uploaded + $manifest;
    return view('UserPanel.DashboardData.DashboardTodayBooking', ['total' => $total, 'uploaded' => $uploaded, 'manifest' => $manifest]);
  }
  // Dashboard Today Booking End
  // Dashboard Current Month
  public function CurrentOrdersDash(Request $req)
  {
    $userid = session()->get('UserLogin2id');

    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $rtdo = $rtd + $rto;
    $ofdintrans = $ofd + $intransit;
    $total = $delivered + $rtdo + $ofdintrans;
    return view('UserPanel.DashboardData.DashboardCrtMonth', ['total' => $total, 'delivered' => $delivered, 'ofdintrans' => $ofdintrans, 'rtdo' => $rtdo]);
  }
  // Dashboard Current Month End
  // Dashboard Last Month
  public function LastOrdersDash(Request $req)
  {
    $userid = session()->get('UserLogin2id');
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $rtdo = $rtd + $rto;
    $ofdintrans = $ofd + $intransit;
    $total = $delivered + $rtdo + $ofdintrans;
    return view('UserPanel.DashboardData.DashboardLastMonth', ['total' => $total, 'delivered' => $delivered, 'ofdintrans' => $ofdintrans, 'rtdo' => $rtdo]);
  }
  // Dashboard Last Month End
  // Dashboard Today
  public function TodayOrdersDash(Request $req)
  {
    $userid = session()->get('UserLogin2id');

    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $rtdo = $rtd;
    $ofdintrans = $ofd;
    $total = $delivered + $ofdintrans + $rtdo;
    return view('UserPanel.DashboardData.DashboardToday', ['total' => $total, 'delivered' => $delivered, 'ofdintrans' => $ofdintrans, 'rtdo' => $rtdo]);
  }
  // Dashboard Today End










  // UserPanel Data Filter End
  public function adminDataFilter(Request $req)
  {

    $userid = session()->get('UserLogin2id');
    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    $delivered = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ofd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Out For Delhivery')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $rto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO-InTransit')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $intransit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Out For Delhivery')
      ->where('order_status_show', '!=', 'RTO-InTransit')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Last_Stamp_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $canceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $uploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');

    // $total = $delivered+$rtd+$ofd+$rto+$intransit+$canceled+$uploaded;
    $total = $delivered + $rtd + $ofd + $rto + $intransit;
    return view('UserPanel.DashboardData.adminDataFilter', ['total' => $total, 'delivered' => $delivered, 'rtd' => $rtd, 'ofd' => $ofd, 'rto' => $rto, 'intransit' => $intransit, 'canceled' => $canceled, 'uploaded' => $uploaded]);
  }
  // UserPanel Data Filter End
  // UserPanel Courier Wise Performance
  public function courierWisePerformance(Request $req)
  {

    $userid = session()->get('UserLogin2id');

    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // Intargos
    $indelivered = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Intargos')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $inrtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Intargos')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $inintransit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
    $nidelivered = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Nimbus')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $nirtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('awb_gen_courier', 'Nimbus')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $niintransit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
  }
  // UserPanel Courier Wise Performance
  // UserPanel Zone Wise Performance
  public function zoneWisePerformance(Request $req)
  {


    $userid = session()->get('UserLogin2id');

    $fromdate = $req->enddatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->startdatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // Zone-A
    $adlvd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'A')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $artd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'A')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $aintsit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
    $bdlvd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'B')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $brtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'B')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $bintsit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
    $cdlvd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'C')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $crtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'C')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $cintsit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
    $ddlvd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'D')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $drtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'D')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $dintsit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
    $edlvd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'E')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $ertd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'E')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $eintsit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
    $fdlvd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'F')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $frtd = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('zonename', 'F')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $fintsit = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
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
  // UserPanel Zone Wise Performance






  public function TodayOrders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // echo $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    // $all = bulkorders::where('User_Id',$userid)
    //             ->where('Awb_Number','!=','')
    //             ->where('order_status_show','!=','Upload')
    //             ->where('order_cancel','!=','1')
    //             ->count('Single_Order_Id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Today', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function YesterdayOrders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Yesterday', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function CurrentOrders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.CurrentMonth', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function LastOrders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.LastMonth', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day7Orders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Last7Days', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day30Orders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Last30Days', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day90Orders(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Last90Days', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }







  public function TodayOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    // echo $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    // $all = bulkorders::where('User_Id',$userid)
    //             ->where('Awb_Number','!=','')
    //             ->where('order_status_show','!=','Upload')
    //             ->where('order_cancel','!=','1')
    //             ->count('Single_Order_Id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.TodayGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function YesterdayOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.YesterdayGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function CurrentOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.CurrentMonthGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function LastOrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.LastMonthGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day7OrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Last7DaysGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day30OrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Last30DaysGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function Day90OrdersGraph(Request $req)
  {
    $fromdate = $req->startdatefrom;
    $fromdate = date('Y-m-d', strtotime($fromdate));
    // echo "<br>";
    $todate = $req->enddatefrom;
    $todate = date('Y-m-d', strtotime($todate));
    // echo "<br>";
    $req->val;
    // echo "<br>";
    // return "Today";
    $userid = session()->get('UserLogin2id');
    $allcomplete = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('delivereddate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allpending = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', '!=', 'Delivered')
      ->where('order_status_show', '!=', 'RTO Delivered')
      ->where('order_status_show', '!=', 'Upload')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allrto = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'RTO Delivered')
      ->where('Awb_Number', '!=', '')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('rtodate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $allcanceled = bulkorders::where('User_Id', $userid)
      ->where('order_cancel', 1)
      ->whereBetween('canceldate', array($fromdate, $todate))
      ->count('Single_Order_Id');
    $alluploaded = bulkorders::where('User_Id', $userid)
      ->where('order_status_show', 'Upload')
      ->where('order_cancel', '!=', '1')
      ->whereBetween('Rec_Time_Date', array($fromdate, $todate))
      ->count('Single_Order_Id');
    return view('UserPanel.DashboardData.Last90DaysGraph', ['allcomplete' => $allcomplete, 'allpending' => $allpending, 'allcancel' => $allrto, 'alluploaded' => $alluploaded, 'allcanceled' => $allcanceled]);
  }
  public function showOrderCounts( Request $request)
  {
    // Get the user ID from the session
    $userid = session()->get('UserLogin2id');

    // Get the first and last day of the current month

    $fromDate = Carbon::parse($request->start_date)->startOfDay(); // Start of the day for $cfromdate
      $toDate = Carbon::parse($request->end_date)->endOfDay(); // End of the day for $ctodate
    // $fromDate = Carbon::now()->startOfMonth()->toDateString();
    // $toDate = Carbon::now()->endOfMonth()->toDateString();

    // Define the common conditions
    $commonConditions = [
      ['User_Id', $userid],
      ['Awb_Number', '!=', ''],
      ['order_cancel_reasion', '=', null], // Check for NULL properly
      ['order_cancel', '!=', '1'],
      ['Rec_Time_Date', '>=', $fromDate],
      ['Rec_Time_Date', '<=', $toDate],
  ];
  

    // Define status categories
    $statusCategories = [
      'Pending' => ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'],
      'Intransit' => ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight', 'Shipment Booked'],
      'Ofd' => ['out for delivery', 'Out For Delivery'],
      'NDR' => ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'],
      'Delivered' => ['delivered', 'Delivered'],
      'Rto' => ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'],
    ];

    // Get the count for a specific condition
    $getCount = function ($awbGenBy, $orderType = null, $showErrors = null) use ($commonConditions) {
      $query = bulkOrders::where($commonConditions)->where('awb_gen_by', $awbGenBy);
      if ($orderType) {
        $query->where('Order_Type', $orderType);
      }
      if ($showErrors) {
        $query->whereIn('showerrors', $showErrors);
      }
      return $query->count('Single_Order_Id');
    };

    // Xpressbee orders
    $xpressbee = $getCount('Xpressbee');
    $xpressbeePending = $getCount('Xpressbee', null, $statusCategories['Pending']);
    $xpressbeeIntransit = $getCount('Xpressbee', null, $statusCategories['Intransit']);
    $xpressbeeOfd = $getCount('Xpressbee', null, $statusCategories['Ofd']);
    $xpressbeeNDR = $getCount('Xpressbee', null, $statusCategories['NDR']);
    $xpressbeeDelivered = $getCount('Xpressbee', null, $statusCategories['Delivered']);
    $xpressbeeRto = $getCount('Xpressbee', null, $statusCategories['Rto']);
    $xpressbeeDeliveredPersent = $xpressbee -$xpressbeeIntransit -$xpressbeeOfd -$xpressbeePending;


    // Xpressbee Prepaid orders
    $xpressbeePrepaid = $getCount('Xpressbee', 'Prepaid');
    $xpressbeePrepaidPending = $getCount('Xpressbee', 'Prepaid', $statusCategories['Pending']);
    $xpressbeePrepaidIntransit = $getCount('Xpressbee', 'Prepaid', $statusCategories['Intransit']);
    $xpressbeePrepaidOfd = $getCount('Xpressbee', 'Prepaid', $statusCategories['Ofd']);
    $xpressbeePrepaidNDR = $getCount('Xpressbee', 'Prepaid', $statusCategories['NDR']);
    $xpressbeePrepaidDelivered = $getCount('Xpressbee', 'Prepaid', $statusCategories['Delivered']);
    $xpressbeePrepaidRto = $getCount('Xpressbee', 'Prepaid', $statusCategories['Rto']);
    $xpressbeePrepaidDeliveredPresent  = $xpressbeePrepaid -$xpressbeePrepaidPending -            $xpressbeePrepaidIntransit -$xpressbeePrepaidOfd;

    // Xpressbee COD orders
    $xpressbeeCod = $getCount('Xpressbee', 'COD');
    $xpressbeeCodPending = $getCount('Xpressbee', 'COD', $statusCategories['Pending']);
    $xpressbeeCodIntransit = $getCount('Xpressbee', 'COD', $statusCategories['Intransit']);
    $xpressbeeCodOfd = $getCount('Xpressbee', 'COD', $statusCategories['Ofd']);
    $xpressbeeCodNDR = $getCount('Xpressbee', 'COD', $statusCategories['NDR']);
    $xpressbeeCodDelivered = $getCount('Xpressbee', 'COD', $statusCategories['Delivered']);
    $xpressbeeCodRto = $getCount('Xpressbee', 'COD', $statusCategories['Rto']);
    $xpressbeeCodDeliveredPresent =$xpressbeeCod -$xpressbeeCodPending -  $xpressbeeCodIntransit - $xpressbeeCodOfd;

    // Ecom orders
    $Ecom = $getCount('Ecom');
    $EcomPending = $getCount('Ecom', null, $statusCategories['Pending']);
    $EcomIntransit = $getCount('Ecom', null, $statusCategories['Intransit']);
    $EcomOfd = $getCount('Ecom', null, $statusCategories['Ofd']);
    $EcomNdr = $getCount('Ecom', null, $statusCategories['NDR']);
    $EcomDeliverd = $getCount('Ecom', null, $statusCategories['Delivered']);
    $EcomRto = $getCount('Ecom', null, $statusCategories['Rto']);
    $EcomDeliverdPresent =$Ecom  -$EcomPending - $EcomIntransit - $EcomOfd;

    // Ecom Prepaid orders
    $EcomPrepaid = $getCount('Ecom', 'Prepaid');
    $EcomPrepaidPending = $getCount('Ecom', 'Prepaid', $statusCategories['Pending']);
    $EcomPrepaidIntransit = $getCount('Ecom', 'Prepaid', $statusCategories['Intransit']);
    $EcomPrepaidOfd = $getCount('Ecom', 'Prepaid', $statusCategories['Ofd']);
    $EcomPrepaidNdr = $getCount('Ecom', 'Prepaid', $statusCategories['NDR']);
    $EcomPrepaidDelivered = $getCount('Ecom', 'Prepaid', $statusCategories['Delivered']);
    $EcomPrepaidRto = $getCount('Ecom', 'Prepaid', $statusCategories['Rto']);
    $EcomPrepaidDeliveredPresent= $EcomPrepaid -$EcomPrepaidPending -$EcomPrepaidIntransit -$EcomPrepaidOfd;

    // Ecom COD orders
    $EcomCod = $getCount('Ecom', 'COD');
    $EcomCodPending = $getCount('Ecom', 'COD', $statusCategories['Pending']);
    $EcomCodIntransit = $getCount('Ecom', 'COD', $statusCategories['Intransit']);
    $EcomCodOfd = $getCount('Ecom', 'COD', $statusCategories['Ofd']);
    $EcomCodNdr = $getCount('Ecom', 'COD', $statusCategories['NDR']);
    $EcomCodDelivered = $getCount('Ecom', 'COD', $statusCategories['Delivered']);
    $EcomCodRto = $getCount('Ecom', 'COD', $statusCategories['Rto']);
    $EcomCodDeliveredPresent = $EcomCod -$EcomCodPending -$EcomCodIntransit -$EcomCodOfd;


    // Bluedart orders
    $Bluedart = $getCount('Bluedart');
    $BluedartPending = $getCount('Bluedart', null, $statusCategories['Pending']);
    $BluedartIntransit = $getCount('Bluedart', null, $statusCategories['Intransit']);
    $BluedartOfd = $getCount('Bluedart', null, $statusCategories['Ofd']);
    $BluedartNdr = $getCount('Bluedart', null, $statusCategories['NDR']);
    $BluedartDeliverd = $getCount('Bluedart', null, $statusCategories['Delivered']);
    $BluedartRto = $getCount('Bluedart', null, $statusCategories['Rto']);
    $BluedartDeliverdPresent = $Bluedart -$BluedartPending - $BluedartIntransit - $BluedartOfd;

    // Bluedart Prepaid orders
    $BluedartPrepaid = $getCount('Bluedart', 'Prepaid');
    $BluedartPrepaidPending = $getCount('Bluedart', 'Prepaid', $statusCategories['Pending']);
    $BluedartPrepaidIntransit = $getCount('Bluedart', 'Prepaid', $statusCategories['Intransit']);
    $BluedartPrepaidOfd = $getCount('Bluedart', 'Prepaid', $statusCategories['Ofd']);
    $BluedartPrepaidNdr = $getCount('Bluedart', 'Prepaid', $statusCategories['NDR']);
    $BluedartPrepaidDelivered = $getCount('Bluedart', 'Prepaid', $statusCategories['Delivered']);
    $BluedartPrepaidRto = $getCount('Bluedart', 'Prepaid', $statusCategories['Rto']);
    $BluedartPrepaidDeliveredPresent = $BluedartPrepaid -$BluedartPrepaidPending -$BluedartPrepaidIntransit -$BluedartPrepaidOfd;

    // Bluedart COD orders
    $BluedartCod = $getCount('Bluedart', 'COD');
    $BluedartCodPending = $getCount('Bluedart', 'COD', $statusCategories['Pending']);
    $BluedartCodIntransit = $getCount('Bluedart', 'COD', $statusCategories['Intransit']);
    $BluedartCodOfd = $getCount('Bluedart', 'COD', $statusCategories['Ofd']);
    $BluedartCodNdr = $getCount('Bluedart', 'COD', $statusCategories['NDR']);
    $BluedartCodDelivered = $getCount('Bluedart', 'COD', $statusCategories['Delivered']);
    $BluedartCodRto = $getCount('Bluedart', 'COD', $statusCategories['Rto']);
    $BluedartCodDeliveredPresent = $BluedartCod -$BluedartCodPending -$BluedartCodIntransit -$BluedartCodOfd;

    // Return the counts to the view or as needed
    return view('UserPanel.DashboardData.analytics', compact(
      'xpressbee',
      'xpressbeePending',
      'xpressbeeIntransit',
      'xpressbeeOfd',
      'xpressbeeNDR',
      'xpressbeeDelivered',
      'xpressbeeRto',
      'xpressbeePrepaid',
      'xpressbeePrepaidPending',
      'xpressbeePrepaidIntransit',
      'xpressbeePrepaidOfd',
      'xpressbeePrepaidNDR',
      'xpressbeePrepaidDelivered',
      'xpressbeePrepaidRto',
      'xpressbeeCod',
      'xpressbeeCodPending',
      'xpressbeeCodIntransit',
      'xpressbeeCodOfd',
      'xpressbeeCodNDR',
      'xpressbeeCodDelivered',
      'xpressbeeCodRto',
      'Ecom',
      'EcomPending',
      'EcomIntransit',
      'EcomOfd',
      'EcomNdr',
      'EcomDeliverd',
      'EcomRto',
      'EcomPrepaid',
      'EcomPrepaidPending',
      'EcomPrepaidIntransit',
      'EcomPrepaidOfd',
      'EcomPrepaidNdr',
      'EcomPrepaidDelivered',
      'EcomPrepaidRto',
      'EcomCod',
      'EcomCodPending',
      'EcomCodIntransit',
      'EcomCodOfd',
      'EcomCodNdr',
      'EcomCodDelivered',
      'EcomCodRto',

      'Bluedart',
      'BluedartPending',
      'BluedartIntransit',
      'BluedartOfd',
      'BluedartNdr',
      'BluedartDeliverd',
      'BluedartRto',
      'BluedartPrepaid',
      'BluedartPrepaidPending',
      'BluedartPrepaidIntransit',
      'BluedartPrepaidOfd',
      'BluedartPrepaidNdr',
      'BluedartPrepaidDelivered',
      'BluedartPrepaidRto',
      'BluedartCod',
      'BluedartCodPending',
      'BluedartCodIntransit',
      'BluedartCodOfd',
      'BluedartCodNdr',
      'BluedartCodDelivered',
      'BluedartCodRto'
      ,'xpressbeeDeliveredPersent'
      ,'xpressbeePrepaidDeliveredPresent' 
      ,'xpressbeeCodDeliveredPresent',
      'EcomDeliverdPresent',
      'EcomPrepaidDeliveredPresent',
      'EcomCodDeliveredPresent',
      'BluedartDeliverdPresent',
      'BluedartPrepaidDeliveredPresent',
      'BluedartCodDeliveredPresent'
    ));
  }
}
