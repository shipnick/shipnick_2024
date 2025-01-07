<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\CourierApiDetail;
use App\Models\Hubs;
use App\Models\OrdersStatus;

use App\Models\orderdetail;
use App\Models\bulkorders;
use App\Models\Manifest;
use App\Models\Manifestorders;
use App\Models\NDRorders;
use App\Models\CourierNames;
use App\Models\Allusers;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\couriers;
use App\Models\courierpermission;


class UserExcels extends Controller
{

    public function skuSummary1(Request $request)
    {
        // Ensure the user ID is correctly retrieved
        $userid = session()->get('UserLogin2id');

        // Validate and parse dates from the request
        $fromDate = Carbon::parse($request->fromdate)->startOfDay(); // Start of the day
        $toDate = Carbon::parse($request->todate)->endOfDay(); // End of the day







        // Extract filter inputs from the request
        $orderType = $request->input('order_type');
        $sku = $request->input('sku');
        $amount = $request->input('amount');
        $courier = $request->input('courier');

        // Build filter array dynamically based on request data
        $filters = array_filter([
            'Order_Type' => $orderType,
            'Item_Name' => $sku,
            'Total_Amount' => $amount,
            'awb_gen_by' => $courier,
        ]);

        // Helper function to get order counts by status
        $getOrderCount = function ($statusArray) use ($userid, $fromDate, $toDate, $filters) {
            $query = bulkorders::where('User_Id', $userid)
                ->where('Awb_Number', '!=', '') // Ensure there is an AWB number
                ->where('order_cancel', '!=', '1') // Exclude canceled orders
                ->whereBetween('Rec_Time_Date', [$fromDate, $toDate]) // Date filter
                ->whereIn('showerrors', $statusArray); // Match order statuses

            // Apply additional filters dynamically
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }

            // Return the count of orders based on the applied filters
            return $query->count('Single_Order_Id');
        };

        // Define status arrays for different order statuses
        $pendingStatus = ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'];
        $intransitStatus = ['out for delivery', 'In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight', 'Shipment Booked'];
        $ndrStatus = ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'];
        $deliveredStatus = ['delivered', 'Delivered'];
        $rtoStatus = ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'];

        // Get order counts by status using the helper function
        $orderno = $getOrderCount([]); // Total orders
        $pending = $getOrderCount($pendingStatus); // Pending orders
        $intransit = $getOrderCount($intransitStatus); // In-transit orders
        $ndr = $getOrderCount($ndrStatus); // NDR orders
        $deliver = $getOrderCount($deliveredStatus); // Delivered orders
        $rto = $getOrderCount($rtoStatus); // RTO orders



        // Calculate delivery percentage
        $deliverdpersentage = 0;
        if ($orderno > 0) {
            $deliveredOrders = $deliver; // Only delivered orders are considered
            $deliverdpersentage = ($deliveredOrders / $orderno) * 100;
        }



        // Retrieve other necessary data (distinct values)
        $sku1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Item_Name');
        $amount1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Total_Amount');
        $courier1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('awb_gen_by');
        $type1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Order_Type');

        // Return the view with the necessary data
        return view('UserPanel.Reports.SkuSummary', compact(
            'userid',
            'sku',
            'amount',
            'courier',
            'orderType',
            'sku1',
            'amount1',
            'courier1',
            'type1',
            'deliverdpersentage',
            'rto',
            'deliver',
            'ndr',
            'intransit',
            'pending',
            'orderno'
        ));
    }
    public function skuSummary(Request $request)
    {
        // Ensure the user ID is correctly retrieved
        $userid = session()->get('UserLogin2id');

        // Validate and parse dates from the request
        $fromDate = Carbon::parse($request->fromdate)->startOfDay(); // Start of the day
        $toDate = Carbon::parse($request->todate)->endOfDay(); // End of the day

        // Extract filter inputs from the request
        $orderType = $request->input('order_type');
        $sku = $request->input('sku');
        $amount = $request->input('amount');
        $courier = $request->input('courier');

        // Build filter array dynamically based on request data
        $filters = array_filter([
            'Order_Type' => $orderType,
            'Item_Name' => $sku,
            'Total_Amount' => $amount,
            'awb_gen_by' => $courier,
        ]);

        // Helper function to get order counts by status
        $getOrderCount = function ($statusArray) use ($userid, $fromDate, $toDate, $filters) {
            $query = bulkorders::where('User_Id', $userid)
                ->where('Awb_Number', '!=', '') // Ensure there is an AWB number
                ->where('order_cancel', '!=', '1') // Exclude canceled orders
                ->whereBetween('Rec_Time_Date', [$fromDate, $toDate]); // Date filter

            // If status array is not empty, filter by showerrors
            if (!empty($statusArray)) {
                $query->whereIn('showerrors', $statusArray); // Match order statuses
            }

            // Apply additional filters dynamically
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }

            // Return the count of orders based on the applied filters
            return $query->count('Single_Order_Id');
        };

        // Define status arrays for different order statuses
        $pendingStatus = ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'];
        $intransitStatus = ['out for delivery', 'In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight', 'Shipment Booked'];
        $ndrStatus = ['exception', 'Undelivered', 'RTO_NDR', 'QC FAILED'];
        $deliveredStatus = ['delivered', 'Delivered'];
        $rtoStatus = ['Shipment Redirected', 'Undelivered', 'RTO Initiated', 'RTO Delivered', 'RTO Acknowledged', 'RTO_OFD', 'RTO IN INTRANSIT', 'rto'];

        // Get order counts by status using the helper function
        $orderno = $getOrderCount([]); // Total orders (no status filter)
        $pending = $getOrderCount($pendingStatus); // Pending orders
        $intransit = $getOrderCount($intransitStatus); // In-transit orders
        $ndr = $getOrderCount($ndrStatus); // NDR orders
        $deliver = $getOrderCount($deliveredStatus); // Delivered orders
        $rto = $getOrderCount($rtoStatus); // RTO orders

        // Calculate delivery percentage
        $deliverdpersentage = 0;
        if ($orderno > 0) {
            $deliveredOrders = $deliver; // Only delivered orders are considered
            $deliverdpersentage = ($deliveredOrders / $orderno) * 100;
        }

        // Optionally, debug the results (You can comment this out or remove after confirming the query works)
        // dd($orderno, $pending, $intransit, $ndr, $deliver, $rto);

        // Retrieve other necessary data (distinct values)
        $sku1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Item_Name');
        $amount1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Total_Amount');
        $courier1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('awb_gen_by');
        $type1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Order_Type');

        // Return the view with the necessary data
        return view('UserPanel.Reports.SkuSummary', compact(
            'userid',
            'sku',
            'amount',
            'courier',
            'orderType',
            'sku1',
            'amount1',
            'courier1',
            'type1',
            'deliverdpersentage',
            'rto',
            'deliver',
            'ndr',
            'intransit',
            'pending',
            'orderno'
        ));
    }



    public function skuNew(Request $request)
    {
        $userid = session()->get('UserLogin2id');  // Get the user ID

        // Get the selected filters from the AJAX request
        $orderType = $request->input('order_type');
        $sku = $request->input('sku');
        $amount = $request->input('amount');
        $courier = $request->input('courier');

        // Start with the query builder to get orders for the current user
        $query = bulkorders::where('User_Id', $userid);

        // Apply filters based on any non-empty input
        if ($orderType) {
            $query->where('Order_Type', $orderType);
        }
        if ($sku) {
            $query->where('Item_Name', $sku);
        }
        if ($amount) {
            $query->where('Total_Amount', $amount);
        }
        if ($courier) {
            $query->where('awb_gen_by', $courier);
        }

        // Get the distinct options for the other dropdowns based on the current filter
        $sku = $query->distinct()->pluck('Item_Name');
        $amount = $query->distinct()->pluck('Total_Amount');
        $courier = $query->distinct()->pluck('awb_gen_by');

        // Filter out null values
        $courier = $courier->filter(function ($value) {
            return !is_null($value);  // Remove null values from the courier array
        });

        // Return the options as a JSON response
        return response()->json([
            'sku' => $sku,
            'amount' => $amount,
            'courier' => $courier
        ]);
    }


    public function POD()
    {
        $userid = session()->get('UserLogin2id');

        $params = orderdetail::where('order_userid', $userid)
            ->where('order_status', 'Complete')
            ->get();
        return view('UserPanel.Reports.PODReport', ['params' => $params]);
    }
    function POD_Report()
    {
        return Excel::download(new PODReportExport, 'PODReport.xlsx');
    }


    public function Daliy()
    {
        $userid = session()->get('UserLogin2id');
        // Today
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $params = orderdetail::where('order_userid', $userid)
            ->where('order_delivery_date', $tdate)
            ->get();
        return view('UserPanel.Reports.DailyReport', ['params' => $params]);
    }
    function Daliy_Report()
    {
        return Excel::download(new DailyReportExport, 'DailyReport.xlsx');
    }

    // NDR Report
    public function NDR()
    {
        $userid = session()->get('UserLogin2id');
        $tdate0 = date('Y-m-d');
        $tdate1 = date('Y-m-d', strtotime("-1 days"));
        $tdate2 = date('Y-m-d', strtotime("-2 days"));
        $tdate3 = date('Y-m-d', strtotime("-3 days"));
        $tdate4 = date('Y-m-d', strtotime("-4 days"));

        $days0 = NDRorders::where('user_id', $userid)->where('uploaddate', $tdate0)->get('uploadtime');
        $days1 = NDRorders::where('user_id', $userid)->where('uploaddate', $tdate1)->get('uploadtime');
        $days2 = NDRorders::where('user_id', $userid)->where('uploaddate', $tdate2)->get('uploadtime');
        $days3 = NDRorders::where('user_id', $userid)->where('uploaddate', $tdate3)->get('uploadtime');
        $days4 = NDRorders::where('user_id', $userid)->where('uploaddate', $tdate4)->get('uploadtime');
        return view('UserPanel.Reports.NDRReport', ['days0' => $days0, 'tdate0' => $tdate0, 'days1' => $days1, 'tdate1' => $tdate1, 'days2' => $days2, 'tdate2' => $tdate2, 'days3' => $days3, 'tdate3' => $tdate3, 'days4' => $days4, 'tdate4' => $tdate4]);
    }
    function NDR_Report()
    {
        return Excel::download(new NDRReportExport, 'NDRReport.xls');
    }
    // NDR Report


    // Manifest
    public function Manifest()
    {
        $userid = session()->get('UserLogin2id');
        $tdate0 = date('Y-m-d');
        $tdate1 = date('Y-m-d', strtotime("-1 days"));
        $tdate2 = date('Y-m-d', strtotime("-2 days"));
        $tdate3 = date('Y-m-d', strtotime("-3 days"));
        $tdate4 = date('Y-m-d', strtotime("-4 days"));

        $days0 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate0)->get('uploadtime');
        $days1 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate1)->get('uploadtime');
        $days2 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate2)->get('uploadtime');
        $days3 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate3)->get('uploadtime');
        $days4 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate4)->get('uploadtime');
        return view('UserPanel.Reports.ManifestReport', ['days0' => $days0, 'tdate0' => $tdate0, 'days1' => $days1, 'tdate1' => $tdate1, 'days2' => $days2, 'tdate2' => $tdate2, 'days3' => $days3, 'tdate3' => $tdate3, 'days4' => $days4, 'tdate4' => $tdate4]);
    }


    function Manifest_Report(Request $req, $id, $no)
    {
        $date = $req->id;
        $time = $req->no;
        return Excel::download(new NDRReportExport($date, $time), 'Manifest-Report.xls');
    }

    function Manifest_ReportD()
    {
        return Excel::download(new NDRReportExportD, 'delivered_report.xlsx');
    }
    function Manifest_ReportD1()
    {
        return Excel::download(new NDRReportExportD1, 'delivered_report1.xlsx');
    }
    function Manifest_ReportD2()
    {
        return Excel::download(new NDRReportExportD2, 'delivered_report2.xlsx');
    }
    function Manifest_ReportD3()
    {
        return Excel::download(new NDRReportExportD3, 'delivered_report3.xlsx');
    }
    function Manifest_ReportD4()
    {
        return Excel::download(new NDRReportExportD4, 'delivered_report4.xlsx');
    }

    function Manifest_ReportN(Request $req, $id, $no)
    {
        $date = $req->id;
        $time = $req->no;
        return Excel::download(new NDRReportExportN($date, $time), 'Non-Delivery_report.xls');
    }

    public function Manifest_Report_PDF()
    {
        // Today
        $userid = session()->get('UserLogin2id');
        // $params = Manifest::where('order_userid',$userid)
        //                     ->where('order_status','Cancel')
        //                     ->get();
        $couriers = CourierNames::all();
        $params = orderdetail::all();
        return view('UserPanel.Reports.Manifest_PDF_Report', ['params' => $params, 'couriers' => $couriers]);
    }
    // Manifest





    // MIS
    public function MIS()
    {
        $userid = session()->get('UserLogin2id');
        $hubs = Hubs::where('hub_created_by', $userid)->get();
        $Fulfilledby = couriers::where('courier_added', 'Shipnick')->get();
        $tdate0 = date('Y-m-d');
        $tdate1 = date('Y-m-d', strtotime("-1 days"));
        $tdate2 = date('Y-m-d', strtotime("-2 days"));
        $tdate3 = date('Y-m-d', strtotime("-3 days"));
        $tdate4 = date('Y-m-d', strtotime("-4 days"));

        $days0 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate0)->get('uploadtime');
        $days1 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate1)->get('uploadtime');
        $days2 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate2)->get('uploadtime');
        $days3 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate3)->get('uploadtime');
        $days4 = Manifestorders::where('user_id', $userid)->where('uploaddate', $tdate4)->get('uploadtime');
        $sku1 = bulkorders::where('User_Id', $userid)->distinct()->pluck('Item_Name');
        return view('UserPanel.Reports.MISReport', ['days0' => $days0, 'tdate0' => $tdate0, 'days1' => $days1, 'tdate1' => $tdate1, 'days2' => $days2, 'tdate2' => $tdate2, 'days3' => $days3, 'tdate3' => $tdate3, 'days4' => $days4, 'tdate4' => $tdate4, 'hubs' => $hubs, 'Fulfilledby' => $Fulfilledby , 'sku1' => $sku1]);
    }


    function MIS_Report(Request $req, $id, $no)
    {
        $date = $req->id;
        $time = $req->no;
        return Excel::download(new MISReportExport($date, $time), 'Manifest_MIS-Report.xls');
    }

    function MIS_ReportD()
    {
        return Excel::download(new MISReportExportD, 'delivered_report.xlsx');
    }
    function MIS_ReportD1()
    {
        return Excel::download(new MISReportExportD1, 'delivered_report1.xlsx');
    }
    function MIS_ReportD2()
    {
        return Excel::download(new MISReportExportD2, 'delivered_report2.xlsx');
    }
    function MIS_ReportD3()
    {
        return Excel::download(new MISReportExportD3, 'delivered_report3.xlsx');
    }
    function MIS_ReportD4()
    {
        return Excel::download(new MISReportExportD4, 'delivered_report4.xlsx');
    }

    public function MIS_ReportN(Request $req)
    {
        // dd($req->all());
        $validatedData = $req->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date',
            'pickupdate' => 'nullable|date',
            'pickupaddress' => 'nullable|string',
            'pickuppincode' => 'nullable|string',
            'pickupcity' => 'nullable|string', // Changed from 'date' to 'string'
            'pickupstate' => 'nullable|string',
            'pickupphone' => 'nullable|string',
            'firstattempt' => 'nullable|string', // Corrected typo
            'secondattempt' => 'nullable|string',
            'thirdattempt' => 'nullable|string',
            'lastattempt' => 'nullable|string', // Corrected typo
            'truearoundtime' => 'nullable|string',
            'receivedbypod' => 'nullable|string',
            'sku'=>'nullable|string',
            // Add additional validation rules for other fields as necessary
        ]);


        try {
            return Excel::download(new MISReportExportN($validatedData), 'MIS_report.xls');
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to generate report', 'message' => $e->getMessage()], 500);
        }
    }

    public function MIS_Report_PDF()
    {
        // Today
        $userid = session()->get('UserLogin2id');
        // $params = Manifest::where('order_userid',$userid)
        //                     ->where('order_status','Cancel')
        //                     ->get();
        $couriers = CourierNames::all();
        $params = orderdetail::all();
        return view('UserPanel.Reports.MIS_PDF_Report', ['params' => $params, 'couriers' => $couriers]);
    }
    // MIS


    // Order Summary
    function Not_Picked_Excel_Orders()
    {
        return Excel::download(new NotPickedOrders(), 'Not-Picked-Orders.xls');
    }
    // Order Summary

    // Failed & Placed Orders
    // function Failed_Orders_Report(Request $req,$ftype){
    //     $tdate0 = date('Y-m-d');
    //     $fileuplaodtype = $req->ftype;
    //     return Excel::download(new FailedOrdersExport($tdate0,$fileuplaodtype),'Failed-orders.xls');
    // }
    function Failed_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new FailedOrdersExport($tdate, $tdate1, $fileuplaodtype), 'Failed-orders.xls');
    }

    function Placed_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new PlacedOrdersExport($tdate, $tdate1, $fileuplaodtype), 'Upload-orders.xls');
    }
    function Pickup_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new PickupOrdersExport($tdate, $tdate1, $fileuplaodtype), 'pickup-orders.xls');
    }
    function intransit_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new intransitOrdersExport($tdate, $tdate1, $fileuplaodtype), 'intransit-orders.xls');
    }
    function ofd_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new ofdOrdersExport($tdate, $tdate1, $fileuplaodtype), 'ofd-orders.xls');
    }
    function rto_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new rtoOrdersExport($tdate, $tdate1, $fileuplaodtype), 'rto-orders.xls');
    }
    function delivered_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new deliveredOrdersExport($tdate, $tdate1, $fileuplaodtype), 'Delivered-orders.xls');
    }
    function cancel_Orders_Report(Request $req)
    {
        $tdate = Carbon::parse($req->cfromdate)->startOfDay();;
        $tdate1 = Carbon::parse($req->ctodate)->endOfDay();
        // dd($tdate,$tdate1);
        $fileuplaodtype = $req->ftype;
        return Excel::download(new cancelOrdersExport($tdate, $tdate1, $fileuplaodtype), 'cancel-orders.xls');
    }
    // Failed & Placed Orders
}





class NotPickedOrders implements WithHeadings, FromCollection
{
    use Exportable;
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $products = bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'order_status_show', 'pickup_id', 'pickup_name', 'pickup_mobile', 'pickup_pincode', 'pickup_gstin', 'pickup_address', 'pickup_state', 'pickup_city')
            ->where('User_Id', $userid)
            ->where('order_status_show', '!=', 'Delivered')
            ->where('order_status_show', '!=', 'RTO Delivered')
            ->where('order_status_show', '!=', 'Upload')
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->get();
        foreach ($products as $key => $product) {
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
        }

        return $products;
    }

    public function headings(): array
    {

        return ['OrderType', 'OrderNo', 'AWBNumber', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'ProductName', 'Quantity', 'Width(cm)', 'Height(cm)', 'Length(cm)', 'ActualWeight(kg)', 'VolumetricWeight(Kg)', 'Amount', 'COD', 'Upload', 'Type', 'Status', 'HUB', 'PickupName', 'PickupMobile', 'PickupPincode', 'PickupGSTIN', 'PickupAddress', 'PickupState', 'PickupCity'];
    }
}





class ProgressOrders implements WithHeadings, FromCollection
{
    use Exportable;
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $products = bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'order_status_show', 'pickup_id', 'pickup_name', 'pickup_mobile', 'pickup_pincode', 'pickup_gstin', 'pickup_address', 'pickup_state', 'pickup_city')
            ->where('User_Id', $userid)
            ->where('order_status_show', '!=', 'Delivered')
            ->where('order_status_show', '!=', 'RTO Delivered')
            ->where('order_status_show', '!=', 'Upload')
            ->where('Awb_Number', '!=', '')
            ->where('order_cancel', '!=', '1')
            ->get();
        foreach ($products as $key => $product) {
            $products[$key]->pickup_id = "HID00" . $product->pickup_id;
        }

        return $products;
    }

    public function headings(): array
    {

        return ['OrderType', 'OrderNo', 'AWBNumber', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'ProductName', 'Quantity', 'Width(cm)', 'Height(cm)', 'Length(cm)', 'ActualWeight(kg)', 'VolumetricWeight(Kg)', 'Amount', 'COD', 'Upload', 'Type', 'Status', 'HUB', 'PickupName', 'PickupMobile', 'PickupPincode', 'PickupGSTIN', 'PickupAddress', 'PickupState', 'PickupCity'];
    }
}











// class FailedOrdersExport implements WithHeadings,FromCollection{
//  use Exportable;
//     public function __construct($date,$uplaodtypeare){
//         $this->date = $date;
//         $this->ftype = $uplaodtypeare;
//     }
//     public function collection(){
//         $fetchdata = $this->date;
//         $ftypedata = $this->ftype;
//         $userid = session()->get('UserLogin2id');
//         $today = Carbon::now();
//         $tdate = $today->toDateString();

//         $products = bulkorders::select('Order_Type','orderno','Awb_Number','awb_gen_courier','Name','Address','State','City','Mobile','Pincode','Item_Name','Quantity','Width','Height','Length','Actual_Weight','volumetric_weight','Total_Amount','Invoice_Value','Cod_Amount','Rec_Time_Date','uploadtype','pickup_id','order_status_show','showerrors')
//                                 ->where('Rec_Time_Date',$fetchdata)
//                                 ->where('user_id',$userid)
//                                 ->where('Awb_Number','')
//                                 ->where('apihitornot','1')
//                                 ->where('uploadtype',$ftypedata)
//                                 ->get();
//         foreach ($products as $key => $product){
//                 $products[$key]->pickup_id = "HID00".$product->pickup_id;
//         }
//         return $products;

//     }

//     public function headings(): array{

//         return['Order_Type','Orderno','AWB_Number','Courier','Receiver_Name','Receiver_Address','Receiver_State','Receiver_City','Receiver_Mobile','Receiver_Pincode','Item_Name','Quantity','Width','Height','Length','Actual_Weight','Volumetric_Weight','Total_Amount','Invoice_Value','Cod_Amount','Upload_Date','Upload_Type','HUB_ID','Status','Remark'];

//     }
// }

class FailedOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('apihitornot', '1')
            ->where('Awb_Number', '')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class PlacedOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'ordernoapi', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
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
        return ['Order_Type', 'Orderno', 'shipnick_id', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class PickupOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['Shipment Not Handed over', 'pending pickup', 'AWB Assigned', 'Pickup Error', 'Pickup Rescheduled', 'Out For Pickup', 'Pickup Exception', 'Pickup Booked', 'Shipment Booked', 'Pickup Generated'])
            ->where('apihitornot', '1')
            ->where('order_cancel', '!=', '1')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class intransitOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection', 'Shipped', 'In Transit', 'Delayed', 'Partial_Delivered', 'REACHED AT DESTINATION HUB', 'MISROUTED', 'PICKED UP', 'Reached Warehouse', 'Custom Cleared', 'In Flight',    'Shipment Booked'])

            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class ofdOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['out for delivery', 'Out For Delivery'])
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class rtoOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $crtmonth = date("m");
        $crtyear = date("Y");
        $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
        $currentmonthstartObj = Carbon::createFromFormat('d-m-Y', "1-$crtmonth-$crtyear")->startOfMonth();
        $currentmonthstendObj = Carbon::createFromFormat('d-m-Y', "$crtmdays-$crtmonth-$crtyear")->endOfMonth();



        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            // ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->whereBetween('Last_Time_Stamp', [$currentmonthstartObj, $currentmonthstendObj])
            ->whereIn('showerrors', ['exception', 'Shipment Redirected', 'rto', 'Undelivered'])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class deliveredOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->whereIn('showerrors', ['delivered', 'Delivered'])
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}

class cancelOrdersExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $date1, $uploadtype)
    {
        $this->date = $date;
        $this->date1 = $date1;
        $this->uploadtype = $uploadtype;
    }

    public function collection()
    {
        $fetchdata = $this->date;
        $fetchdata1 = $this->date1;
        $ftypedata = $this->uploadtype;

        $products = Bulkorders::select('Order_Type', 'orderno', 'Awb_Number', 'awb_gen_courier', 'Name', 'Address', 'State', 'City', 'Mobile', 'Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'volumetric_weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Rec_Time_Date', 'uploadtype', 'pickup_id', 'order_status_show', 'showerrors')
            ->whereBetween('Last_Time_Stamp', [$fetchdata, $fetchdata1])
            ->where('user_id', session()->has('UserLogin2id') ? session()->get('UserLogin2id') : null)
            ->where('order_cancel', 1)
            ->where('apihitornot', '1')
            ->where('uploadtype', $ftypedata)
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
        return ['Order_Type', 'Orderno', 'AWB_Number', 'Courier', 'Receiver_Name', 'Receiver_Address', 'Receiver_State', 'Receiver_City', 'Receiver_Mobile', 'Receiver_Pincode', 'Item_Name', 'Quantity', 'Width', 'Height', 'Length', 'Actual_Weight', 'Volumetric_Weight', 'Total_Amount', 'Invoice_Value', 'Cod_Amount', 'Upload_Date', 'Upload_Type', 'HUB_ID', 'Status', 'Remark'];
    }
}









class PODReportExport implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();
        $products = orderdetail::where('order_userid', $userid)
            ->where('order_status', 'Complete')
            ->where('user_id', $userid)
            ->select('awb_no', 'orderno', 'cname', 'cmobile', 'cpin', 'itmecodamt', 'orderdata', 'order_status', 'order_userid', 'courier_name')
            ->get();

        foreach ($products as $key => $product) {
            $catName = Allusers::select('name')->where('id', $product->order_userid)->first();
            $products[$key]->order_userid = $catName->name;
        }
        return $products;
    }

    public function headings(): array
    {

        return ["AWB No", 'Order No', 'Client Name', 'Client Mobile', 'Destination Pincode', 'COD Amount', 'Upload Date', 'Current Status', 'Customer Name', 'Courier Name'];
    }
}








class DailyReportExport implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();
        $products = orderdetail::where('order_userid', $userid)->where('order_status', 'Complete')->where('user_id', $userid)->select('awb_no', 'orderno', 'cname', 'cmobile', 'cpin', 'itmecodamt', 'orderdata', 'order_status', 'order_userid', 'courier_name')->get();

        foreach ($products as $key => $product) {
            $catName = Allusers::select('name')->where('id', $product->order_userid)->first();
            $products[$key]->order_userid = $catName->name;
        }
        return $products;
    }

    public function headings(): array
    {

        return ["AWB No", 'Order No', 'Client Name', 'Client Mobile', 'Destination Pincode', 'COD Amount', 'Upload Date', 'Current Status', 'Customer Name', 'Courier Name'];
    }
}






class NDRReportExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $time)
    {
        $this->date = $date;
        $this->time = $time;
    }
    public function collection()
    {
        $fetchdata = $this->date;
        $fetchtime = $this->time;
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $fetchdata)
            ->where('uploadtime', $fetchtime)
            ->where('user_id', $userid)
            ->get();
        return $products;
    }

    public function headings(): array
    {

        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}






class NDRReportExportD implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();
        $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}
class NDRReportExportD1 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-1 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}
class NDRReportExportD2 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-2 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}
class NDRReportExportD3 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-3 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}
class NDRReportExportD4 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-4 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}





class NDRReportExportN implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $time)
    {
        $this->date = $date;
        $this->time = $time;
    }
    public function collection()
    {
        $fetchdata = $this->date;
        $fetchtime = $this->time;
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();
        $products = NDRorders::select('awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate')
            ->where('uploaddate', $fetchdata)
            ->where('uploadtime', $fetchtime)
            ->where('user_id', $userid)
            // ->where('orderstatus','RTO Delivered')
            ->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'pickupdate', 'orderstatus', 'courierremark', 'laststatusdate', 'deliverydate', 'firstscandate', 'firstattemptdate', 'edd', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'customername', 'customercontact', 'clientname', 'paymentmode', 'codamt', 'orderageing', 'attemptcount', 'couriername', 'rtodate'];
    }
}













































class MISReportExport implements WithHeadings, FromCollection
{
    use Exportable;
    public function __construct($date, $time)
    {
        $this->date = $date;
        $this->time = $time;
    }
    public function collection()
    {
        $fetchdata = $this->date;
        $fetchtime = $this->time;
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();

        $products = Manifestorders::select('awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername')
            ->where('uploaddate', $fetchdata)
            ->where('uploadtime', $fetchtime)
            ->where('user_id', $userid)
            ->get();
        return $products;
    }

    public function headings(): array
    {

        return ['awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername'];
    }
}






class MISReportExportD implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $today = Carbon::now();
        $tdate = $today->toDateString();
        $products = Manifestorders::select('awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername'];
    }
}
class MISReportExportD1 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-1 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername'];
    }
}
class MISReportExportD2 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-2 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername'];
    }
}
class MISReportExportD3 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-3 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername'];
    }
}
class MISReportExportD4 implements WithHeadings, FromCollection
{
    public function collection()
    {
        $userid = session()->get('UserLogin2id');
        $tdate = date('Y-m-d', strtotime("-4 days"));
        $products = Manifestorders::select('awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername')
            ->where('uploaddate', $tdate)->where('user_id', $userid)->where('orderstatus', 'Delivered')->get();
        return $products;
    }
    public function headings(): array
    {
        return ['awbno', 'orderno', 'origincity', 'originpincode', 'destinationcity', 'destinationpincode', 'paymentmode', 'couriername'];
    }
}



class MISReportExportN implements WithHeadings, FromCollection
{
    use Exportable;

    protected $data;

    const HEADINGS = [
        'Awb Number',
        'Order No',
        'Order Date',
        'Name',
        'Address',
        'City',
        'State',
        'Pincode',
        'Order Type',
        'Cod Amount',
        'Width',
        'Height',
        'Length',
        'Actual Weight',
        'Volumetric Weight',
        'Current Status',

        'Fulfilled By',
        'Pickup Date',
        'Pickup Address',
        'Pickup Pincode',
        'Pickup City',
        'Pickup State',
        'Pickup Mobile',

        'Zone',
        'Total Amount'
    ];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $userid = session()->get('UserLogin2id');

        $query = bulkorders::where('user_id', $userid)
            ->whereBetween('Rec_Time_Date', [$this->data['fromdate'], $this->data['todate']]);

        // Apply optional filters if provided
        if (!empty($this->data['pickupaddress'])) {
            $query->where('pickup_address', 'like', '%' . $this->data['pickupaddress'] . '%');
        }
        if (!empty($this->data['pickuppincode'])) {
            $query->where('pickup_pincode', 'like', '%' . $this->data['pickuppincode'] . '%');
        }
        if (!empty($this->data['pickupcity'])) {
            $query->where('pickup_city', 'like', '%' . $this->data['pickupcity'] . '%');
        }
        if (!empty($this->data['pickupstate'])) {
            $query->where('pickup_state', 'like', '%' . $this->data['pickupstate'] . '%');
        }
        if (!empty($this->data['sku'])) {
            $query->where('Item_Name', 'like', '%' . $this->data['sku'] . '%');
        }




        // return bulkorders::join('mis_report', 'mis_report.awb_number', '=', 'spark_single_order.Awb_Number')
        //     ->whereBetween('spark_single_order.Rec_Time_Date', [$this->data['fromdate'], $this->data['todate']])
        //     ->where('spark_single_order.showerrors', 'RTO Delivered')
        //     ->where('spark_single_order.user_id', $userid)
        // ->select([
        //         'spark_single_order.Awb_Number',
        //         'spark_single_order.orderno',
        //         'spark_single_order.Rec_Time_Date',
        //         'spark_single_order.Name',
        //         'spark_single_order.Address',
        //         'spark_single_order.City',
        //         'spark_single_order.State',
        //         'spark_single_order.Pincode',
        //         'spark_single_order.Order_Type',
        //         'spark_single_order.Cod_Amount',
        //         'spark_single_order.Width',
        //         'spark_single_order.Height',
        //         'spark_single_order.Length',
        //         'spark_single_order.Actual_Weight',
        //         'spark_single_order.volumetric_weight',
        //         'mis_report.current_status',
        //         'mis_report.last_scanned_at',
        //         'mis_report.last_location',
        //         'mis_report.last_scan_remark',
        //         'mis_report.delivery_attempts',
        //         'spark_single_order.awb_gen_courier',
        //         'spark_single_order.Rec_Time_Date as pickup_date',
        //         'spark_single_order.pickup_address',
        //         'spark_single_order.pickup_pincode',
        //         'spark_single_order.pickup_city',
        //         'spark_single_order.pickup_state',
        //         'spark_single_order.pickup_mobile',
        //         'mis_report.last_attempt_date',
        //         'mis_report.turn_around_time'
        //     ])->get();

        // return bulkorders::join('orderdetails', 'orderdetails.awb_no', '=', 'spark_single_order.Awb_Number')
        //     ->whereBetween('spark_single_order.Rec_Time_Date', [$this->data['fromdate'], $this->data['todate']])
        //     // ->where('spark_single_order.showerrors', 'RTO Delivered')
        //     ->where('spark_single_order.user_id', $userid)
        // ->select([
        //         'spark_single_order.Awb_Number',
        //         'spark_single_order.orderno',
        //         'spark_single_order.Rec_Time_Date',
        //         'spark_single_order.Name',
        //         'spark_single_order.Address',
        //         'spark_single_order.City',
        //         'spark_single_order.State',
        //         'spark_single_order.Pincode',
        //         'spark_single_order.Order_Type',
        //         'spark_single_order.Cod_Amount',
        //         'spark_single_order.Width',
        //         'spark_single_order.Height',
        //         'spark_single_order.Length',
        //         'spark_single_order.Actual_Weight',
        //         'spark_single_order.volumetric_weight',
        //         'spark_single_order.showerrors',
        //         // 'mis_report.current_status',
        //         // 'mis_report.last_scanned_at',
        //         // 'mis_report.last_location',
        //         // 'mis_report.last_scan_remark',
        //         // 'mis_report.delivery_attempts',
        //         'spark_single_order.awb_gen_courier',
        //         'spark_single_order.Rec_Time_Date as pickup_date',
        //         'spark_single_order.pickup_address',
        //         'spark_single_order.pickup_pincode',
        //         'spark_single_order.pickup_city',
        //         'spark_single_order.pickup_state',
        //         'spark_single_order.pickup_mobile',
        //         // 'mis_report.last_attempt_date',
        //         // 'mis_report.turn_around_time'
        //          'spark_single_order.zone',
        //         'orderdetails.debit'
        //     ])->get();



        return bulkorders::where('user_id', $userid)->where('order_cancel_reasion', '!=', 'canceled')->whereBetween('Rec_Time_Date', [$this->data['fromdate'], $this->data['todate']])
            ->select([
                'Awb_Number',
                'orderno',
                'Rec_Time_Date',
                'Name',
                'Address',
                'City',
                'State',
                'Pincode',
                'Order_Type',
                'Cod_Amount',
                'Width',
                'Height',
                'Length',
                'Actual_Weight',
                'volumetric_weight',
                'showerrors',
                'awb_gen_courier',

                'Rec_Time_Date as pickup_date',
                'pickup_address',
                'pickup_pincode',
                'pickup_city',
                'pickup_state',
                'pickup_mobile',
                'zone'

            ])->get();
    }

    public function headings(): array
    {
        return self::HEADINGS;
    }
}
