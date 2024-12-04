<?php
namespace App\Http\Controllers;

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
// use \PDF;
use App\Models\smartship;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ShippindLabel;

class LabelsPrintOut extends Controller
{
   
  public function shipping_label_setting(Request $request)
    {
        // dd($request->all());
        // dd($request->Consignee_Number);
        $pid = session('UserLogin2id');

        // Assuming $request is an instance of Illuminate\Http\Request
        // You might want to validate the request before processing
        if ($request->Consignee_Number !== null) {
            $Number = 1;
        } else {
            $Number = 0;
        }

        if ($request->order_id !== null) {
            $order = 1;
        } else {
            $order = 0;
        }
        if ($request->Products_Details !== null) {
            $Details = 1;
        } else {
            $Details = 0;
        }
        if ($request->Return_Address !== null) {
            $Address = 1;
        } else {
            $Address = 0;
        }
        if ($request->Weight !== null) {
            $Weight = 1;
        } else {
            $Weight = 0;
        }
        if ($request->Dimensions !== null) {
            $Dimension = 1;
        } else {
            $Dimension = 0;
        }
        if ($request->Support_Mobile !== null) {
            $Mobile = 1;
        } else {
            $Mobile = 0;
        }
        if ($request->Support_email !== null) {
            $email = 1;
        } else {
            $email = 0;
        }
        if ($request->display_name !== null) {
            $name = $request->display_name;
        } else {
            $name = '';
        }
        if ($request->rtoaddress !== null) {
            $rtoAdd = $request->rtoaddress;
        } else {
            $rtoAdd = '';
        }
        if ($request->supportnumber !== null) {
            $snumber = $request->supportnumber;
        } else {
            $snumber = '';
        }
        if ($request->supportemail !== null) {
            $semail = $request->supportemail;
        } else {
            $semail = '';
        }


        try {
            // $label = ShippindLabel::where('user_id', $pid)->first();
            $label = ShippindLabel::where('user_id', $pid)->where('label_type', $request->labbel_type)->first();

            if (isset($label->id)) {
                ShippindLabel::where('user_id', '=', $pid)
                    ->update([
                        'Consignee_Number' => $Number,
                        'order_id' => $order,
                        'Products_Details' => $Details,
                        'Return_Address' => $Address,
                        'Weight' => $Weight,
                        'Dimensions' => $Dimension,
                        'Support_Mobile' => $Mobile,
                        'Support_email' => $email,
                        'display_name' => $name,
                        'supportnumber' => $snumber,
                        'supportemail' => $semail,
                        'rtoAddress' => $rtoAdd
                    ]);
                return redirect()->back()->with('message', 'update success ');
            } else {
                // Create new record
                $labels = new ShippindLabel;
                $labels->user_id = $pid;
                $labels->label_type = $request->labbel_type;

                // Repeat similar checks for other fields

                if ($request->has('Consignee_Number')) {
                    $labels->Consignee_Number = '1';
                } else {
                    $labels->Consignee_Number = '0';
                }

                if ($request->has('order_id')) {
                    $labels->order_id = '1';
                } else {
                    $labels->order_id = '0';
                }
                if ($request->has('Products_Details')) {
                    $labels->Products_Details = '1';
                } else {
                    $labels->Products_Details = '0';
                }
                if ($request->has('Return_Address')) {
                    $labels->Return_Address = '1';
                } else {
                    $labels->Return_Address = '0';
                }
                if ($request->has('Weight')) {
                    $labels->Weight = '1';
                } else {
                    $labels->Weight = '0';
                }
                if ($request->has('Dimensions')) {
                    $labels->Dimensions = '1';
                } else {
                    $labels->Dimensions = '0';
                }
                if ($request->has('Support_Mobile')) {
                    $labels->Support_Mobile = '1';
                } else {
                    $labels->Support_Mobile = '0';
                }
                if ($request->has('Support_email')) {
                    $labels->Support_email = '1';
                } else {
                    $labels->Support_email = '0';
                }



                if ($request->filled('display_name')) {
                    $labels->display_name = $request->input('display_name');
                }

                if ($request->filled('rtoaddress')) {
                    $labels->rtoAddress = $request->input('rtoaddress');
                }

                if ($request->filled('supportnumber')) {
                    $labels->supportnumber = $request->input('supportnumber');
                }

                if ($request->filled('supportemail')) {
                    $labels->supportemail = $request->input('supportemail');
                }



                $labels->save();
                return redirect()->back()->with('message', 'update success ');
            }
        } catch (Exception $e) {
            // Handle exceptions here
            // For example, log the error or return a response indicating failure
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    public function shipping_label_select(Request $request)
    {
        $pid = session('UserLogin2id');
        $label = ShippindLabel::where('user_id', $pid)->pluck('id')->toArray();  // Convert to array for easier comparison
        $label1 = ShippindLabel::where('user_id', $pid)->where('label_type', $request->label)->pluck('id')->toArray();  // Convert to array for easier comparison

        foreach ($label as $individualLabel) {
            // Check if the current label is NOT in $label1
            if (!in_array($individualLabel, $label1)) {
                ShippindLabel::where('id', '=', $individualLabel)
                    ->update([
                        'status' => 0
                    ]);
            }
        }

        $label1 = ShippindLabel::where('user_id', $pid)->where('label_type', $request->label)->first();
        if (($label1)) {
            ShippindLabel::where('user_id', '=', $pid)->where('label_type', $request->label)
                ->update([

                    'status' => 1
                ]);
            return redirect()->back()->with('message', 'update success ');
        }
        $labels = new ShippindLabel;
        $labels->user_id = $pid;
        $labels->label_type = $request->label;
        $labels->status = 1;
        $labels->save();
        return redirect()->back()->with('message', 'update success ');
    }

    public function LabelPrint()
    {
        return view('UserPanel.LabesPrintout.Search');
    }



    public function LabelsPrint(Request $req)
    {
        $pid = session('UserLogin2id');
        $label_setting = ShippindLabel::where('user_id', $pid)->first();
        $check = $req->newcheck;
        $allawbno = $req->awbnoisa;
        $printoutsize = $req->printout;
        $seperateawbno = explode(PHP_EOL, $allawbno);
        $params = [];

        foreach ($seperateawbno as $value) {
            $value = trim($value);
            if (empty($value)) {
                continue;
            }

            $datas = bulkorders::where('Awb_Number', $value)->first();
            if (!empty($datas->orderno)) {
                $Hubs = Hubs::where('hub_id', $datas->pickup_id)->first();
                $smartshiptoken1 = smartship::where('id', 1)->first('token');
                $params[] = [
                    'route' => $datas->dtdcerrors,
                    'cancel' => $datas->order_cancel,
                    'awb' => $datas->Awb_Number,
                    'awbcourier' => $datas->awb_gen_by,
                    'paymode' => $datas->Order_Type,
                    'codamt' => $datas->Total_Amount,
                    'orderno' => $datas->orderno,
                    'date' => $datas->Rec_Time_Date,
                    'seller' => $datas->User_Id,
                    'hid' => $datas->pickup_id,
                    'hname' => $datas->pickup_name,
                    'haddress' => $datas->pickup_address,
                    'hstate' => $datas->pickup_state,
                    'hcity' => $datas->pickup_city,
                    'hpincode' => $datas->pickup_pincode,
                    'hmobile' => $datas->pickup_mobile,
                    'hfolder' => $Hubs->hub_folder,
                    'hlogo' => $Hubs->hub_img,
                    'hubname' => $Hubs->hub_name,
                    'name' => $datas->Name,
                    'address' => $datas->Address,
                    'city' => $datas->City,
                    'pincode' => $datas->Pincode,
                    'mobile' => $datas->Mobile,
                    'mobile2' => $datas->mobile_no2,
                    'pemail' => $datas->order_email,
                    'sku' => $datas->sku,
                    'item' => $datas->Item_Name,
                    'qlty' => $datas->Quantity,
                    'orderunq' => $datas->ordernoapi,
                    'token' => $smartshiptoken1->token,
                    'shipc_no' => $datas->courier_ship_no,
                    'weight' => $datas->Actual_Weight,
                    'h' => $datas->Height,
                    'w' => $datas->Width,
                    'l' => $datas->Length
                ];
            }
        }

        $totalorders = count($params);
        $label = ShippindLabel::where('user_id', $pid)->where('status', 1)->first();
        if (isset($label) && $label->label_type == 'defult') {
            $label_setting = ShippindLabel::where('user_id', $pid)->where('label_type', 'defult')->first();

            // dd($label_setting);
            return view('UserPanel.LabesPrintout.SearchLabels', compact('params', 'totalorders', 'printoutsize', 'label_setting'));
        } elseif (isset($label) && $label->label_type == 'label_first') {
            $label_setting = ShippindLabel::where('user_id', $pid)->where('label_type', 'label_first')->first();
            return view('UserPanel.LabesPrintout.SearchLabels2', compact('params', 'totalorders', 'printoutsize', 'label_setting'));
        } elseif (isset($label) && $label->label_type == 'label_second') {
            $label_setting = ShippindLabel::where('user_id', $pid)->where('label_type', 'label_second')->first();
            return view('UserPanel.LabesPrintout.SearchLabels3', compact('params', 'totalorders', 'printoutsize', 'label_setting'));
        }else{
            $view = ($check == 1) ? 'UserPanel.LabesPrintout.SearchLabels_2' : 'UserPanel.LabesPrintout.SearchLabels';

            return view($view, compact('params', 'totalorders', 'printoutsize', 'label_setting'));
        }
    }



public function ReceiptOrder1(Request $req,$id){
    // return $id;
    $somedatas = bulkorders::where('Single_Order_Id',$id)->first();
    $Hubs = Hubs::where('hub_id',$somedatas['pickup_id'])->first();

    $orderno = $somedatas['orderno'];
    $d = new DNS1D();
    $d->setStorPath(__DIR__.'/cache/');
    $orderbarcode = $d->getBarcodeHTML("$orderno", 'C128');
    $awbno = $somedatas['Awb_Number'];
    $d = new DNS1D();
    $d->setStorPath(__DIR__.'/cache/');
    $awbbarcode = $d->getBarcodeHTML($awbno, 'C128');

    $params = bulkorders::where('Single_Order_Id',$id)->first();
    return view("UserPanel.Receipt.Receipt",['params'=>$params,'orderbarcode'=>$orderbarcode,'orderno'=>$orderno,'awbbarcode'=>$awbbarcode,'awbno'=>$awbno,'Hubs'=>$Hubs]);
}


public function ReceiptOrderBulk1(Request $req){
    // $params = bulkorders::all();
    $tudate = date('Y-m-d');
    $params = bulkorders::where('Rec_Time_Date',$tudate)->where('Awb_Number','!=','')->get();
    $Hubs = Hubs::all();
    return view("UserPanel.Receipt.Receipt_bulk",['params'=>$params,'Hubs'=>$Hubs]);
}











public function todayLabels(Request $req){
    error_reporting(1);
    $tdays = date('Y-m-d');
    $values = bulkorders::where('Rec_Time_Date',$tdays)->where('order_cancel','!=','1')->get('Awb_Number');
    // print_r($values);
    $params = array();
    foreach ($values as $valueare) {
    $value = $valueare->Awb_Number;
    if(empty($value)){      continue;   }
    $value =  trim($value);
    $datas = bulkorders::where('Awb_Number',$value)->first();
        if(!empty($datas->orderno)){
            $Hubs = Hubs::where('hub_id',$datas->pickup_id)->first();
            $params[] = array(
            'cancel'=>$datas->order_cancel,'awb'=>$datas->Awb_Number,'awbcourier'=>$datas->awb_gen_by,'paymode'=>$datas->Order_Type,'codamt'=>$datas->Cod_Amount,'orderno'=>$datas->orderno,'date'=>$datas->Rec_Time_Date,'seller'=>$datas->User_Id,
            'hid'=>$datas->pickup_id,'hname'=>$datas->pickup_name,'haddress'=>$datas->pickup_address,'hstate'=>$datas->pickup_state,'hcity'=>$datas->pickup_city,'hpincode'=>$datas->pickup_pincode,'hmobile'=>$datas->pickup_mobile,'hfolder'=>$Hubs->hub_folder,'hlogo'=>$Hubs->hub_img,
            'name'=>$datas->Name,'address'=>$datas->Address,'city'=>$datas->City,'pincode'=>$datas->Pincode,'mobile'=>$datas->Mobile,
            'item'=>$datas->Item_Name,'qlty'=>$datas->Quantity
            );
        }
    }
    $totalorders = count($params);
    return view("UserPanel.LabesPrintout.SearchLabels",['params'=>$params,'totalorders'=>$totalorders,'printoutsize'=>$printoutsize]);
}




// Thermal Printer 
public function todayThermalLabels(Request $req)
{
    // Disable error reporting for notices and warnings
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

    // Get today's date
    $today = date('Y-m-d');

    // Fetch AWB numbers of orders that are not cancelled and received today
    $awbNumbers = bulkorders::where('Rec_Time_Date', $today)
                            ->where('order_cancel', '!=', '1')
                            ->limit(1)
                            ->pluck('Awb_Number');

    // Initialize an array to hold order parameters
    $params = [];

    foreach ($awbNumbers as $awbNumber) {
        // Trim and skip empty AWB numbers
        $awbNumber = trim($awbNumber);
        if (empty($awbNumber)) {
            continue;
        }

        // Fetch the order details
        $order = bulkorders::where('Awb_Number', $awbNumber)->first();

        // If the order number is present, fetch the hub details and prepare the parameters
        if (!empty($order->orderno)) {
            $hub = Hubs::where('hub_id', $order->pickup_id)->first();
            $params[] = [
                'cancel' => $order->order_cancel,
                'awb' => $order->Awb_Number,
                'awbcourier' => $order->awb_gen_by,
                'paymode' => $order->Order_Type,
                'codamt' => $order->Cod_Amount,
                'orderno' => $order->orderno,
                'date' => $order->Rec_Time_Date,
                'seller' => $order->User_Id,
                'hid' => $order->pickup_id,
                'hname' => $order->pickup_name,
                'haddress' => $order->pickup_address,
                'hstate' => $order->pickup_state,
                'hcity' => $order->pickup_city,
                'hpincode' => $order->pickup_pincode,
                'hmobile' => $order->pickup_mobile,
                'hfolder' => $hub->hub_folder ?? '',
                'hlogo' => $hub->hub_img ?? '',
                'name' => $order->Name,
                'address' => $order->Address,
                'city' => $order->City,
                'pincode' => $order->Pincode,
                'mobile' => $order->Mobile,
                'item' => $order->Item_Name,
                'qlty' => $order->Quantity
            ];
        }
    }

    // Calculate the total number of orders
    $totalOrders = count($params);

    // Load the view and generate the PDF
    $pdf = PDF::loadView('UserPanel.LabesPrintout.downloadlabel', [
        'params' => $params,
        'totalorders' => $totalOrders
    ]);

    // Return the generated PDF as a download
    return $pdf->download('SearchLabels.pdf');
}
// Thermal Printer 




























    public function readcsv()
    {
        $fileD = fopen('expertphp-product.csv',"r");
        $column=fgetcsv($fileD);
        while(!feof($fileD)){
         $rowData[]=fgetcsv($fileD);
        }
        foreach ($rowData as $key => $value) {

            $inserted_data=array('name'=>$value[0],
                                 'details'=>$value[1],
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


    public function ReceiptOrder(Request $req,$id)
    {
        // return $id;
        $somedatas = orderdetail::where('orderid',$id)->first();
        $Hubs = Hubs::where('hub_id',$somedatas['hub_id'])->first();

        $orderno = $somedatas['orderno'];
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $orderbarcode = $d->getBarcodeHTML("$orderno", 'C128');
        $awbno = $somedatas['awb_no'];
        $d = new DNS1D();
        $d->setStorPath(__DIR__.'/cache/');
        $awbbarcode = $d->getBarcodeHTML($awbno, 'C128');

        $params = orderdetail::where('orderid',$id)->first();
        return view("UserPanel.Receipt.Receipt",['params'=>$params,'orderbarcode'=>$orderbarcode,'orderno'=>$orderno,'awbbarcode'=>$awbbarcode,'awbno'=>$awbno,'Hubs'=>$Hubs]);
    }


    public function ReceiptOrderBulk(Request $req)
    {
        $params = orderdetail::all();
        $Hubs = Hubs::all();
        return view("UserPanel.Receipt.Receipt_bulk",['params'=>$params,'Hubs'=>$Hubs]);
    }

}
