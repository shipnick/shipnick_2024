<?php

namespace App\Http\Controllers;

use App\Jobs\OrderStatusUpdate_ECOM;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

use App\Models\Payment;
// use Illuminate\Support\Facades\Log;
// use Exception;
// use App\Models\Payment;
use App\Models\AdminLoginCheck;
use App\Models\bulkorders;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;
use App\Models\MIS_Report;
use Carbon\Carbon;
use App\Models\smartship;
use App\Models\orderdetail;
use Illuminate\Support\Facades\DB;


class UserSearchOrder extends Controller
{
     public function xpressWebhook(Request $request)
    {

        $webhookData = $request->getContent();  // or $request->input('webhook_data_here') depending on your 

        //  webhook secret 
        $secret = 'Rkn7tRpesbyZ0O6mOC6aLkE5';

        // The hash sent by the external service in the request headers or body
        $sentHash = $request->header('X-Signature');  // assuming the hash is sent as a header

        // Compute the HMAC-SHA256 hash of the incoming data
        $computedHash = base64_encode(hash_hmac('sha256', $webhookData, $secret, true));

        // Compare the computed hash with the hash sent in the webhook request
        if (hash_equals($computedHash, $sentHash)) {
            // Valid signature, process the webhook
            $awbNumber = $request->input('awb_number');
            $status = $request->input('status');
            $time = $request->input('event_time');
            // Do something with $webhookData (such as storing it in the database)
            DB::table('spark_single_order')
                ->where('Awb_Number', $awbNumber)  // Ensure this is the correct column
                ->update(['showerrors' => $status, 'delivereddatetime' => $time]);

            // Send a 200 OK response with a JSON payload
            return response()->json(['status' => 'success'], 200);
        } else {
            // Invalid signature, return 400 Bad Request response
            return response()->json(['status' => 'invalid signature'], 400);
        }
    }


    // public function handle(Request $request)
    // {
    //     // Secret key from the environment variable (stored securely)
    //     $secret = env('WEBHOOK_SECRET');

    //     // Get the X-Hmac-SHA256 signature from the request header
    //     $providedSignature = $request->header('X-Hmac-SHA256');

    //     // Get the raw request body (this is the data that was used to create the signature)
    //     $rawBody = $request->getContent();

    //     // Calculate the hash using hash_hmac with SHA256
    //     $calculatedHash = base64_encode(hash_hmac('sha256', $rawBody, $secret, true));

    //     // Compare the calculated hash with the provided signature
    //     if ($providedSignature !== $calculatedHash) {
    //         // If the signatures do not match, reject the request
    //         Log::warning('Invalid webhook signature', ['providedSignature' => $providedSignature]);
    //         return response('Unauthorized', 401);
    //     }

    //     // Log minimal data, only necessary for tracking the webhook
    //     Log::info('Webhook received', [
    //         'awb_number' => $request->input('awb_number'),
    //         'status' => $request->input('status')
    //     ]);

    //     // Extract the AWB number and status from the request
    //     $awbNumber = $request->input('awb_number');
    //     $status = $request->input('status');

    //     // Validate input (if AWB number or status is missing, we still return 200)
    //     if (!$awbNumber || !$status) {
    //         Log::warning('Invalid data received', ['awb_number' => $awbNumber, 'status' => $status]);
    //         return response('Webhook received', 200); // Send a quick 200 response
    //     }

    //     // Perform a minimal check and update (no heavy processing)
    //     $order = BulkOrder::where('Awb_Number', $awbNumber)->first();

    //     if ($order) {
    //         // Update the order status quickly (this doesn't involve heavy processing)
    //         $order->showerrors = $status;
    //         $order->save();
    //     } else {
    //         // Log if the order is not found
    //         Log::warning('Order not found', ['awb_number' => $awbNumber]);
    //     }

    //     // Return the 200 OK response immediately, no further processing
    //     return response('Webhook received', 200);
    // }

    public function Home()
    {
        return view('UserPanel.SearchOrder');
    }

    public function makeOrder(Request $request)
    {
        // dd($request->all());


        $puserid = session()->get('UserLogin2id');
        $userdata = AdminLoginCheck::where('id', $puserid)->first();
        $amount = $request->get('plan_id');
        // $userer= $userdata->name;
        // dd($userer);
        // $this->validate($request, [
        //     'amount' => 'required|numeric',
        // ]);
        $paymentnew = new Payment();
        $paymentnew->user_id = $puserid;
        $paymentnew->currency = "INR";
        // $payment->user_email = $status->email;
        $paymentnew->amount = $amount;
        $paymentnew->save();

        $api = new Api(env('rzr_key'), env('rzr_secret'));

        $order_id = rand(111111, 999999);
        $orderData = [
            'receipt'    => 'reciprt_11',
            'amount'    => $amount * 100,
            'currency'   => 'INR',
            'notes' => [
                'order_id' => $order_id,
            ],
        ];

        $payment = $api->order->create($orderData);

        Payment::where('id', $paymentnew->id)->update(['payment_id' => $payment->id]);



        return response()->json([
            "success" => true,
            "order_id" => $order_id,
            "amount" => $amount,
            "rzp_order" => $payment->id
        ]);



        // return view('UserPanel/Wallet/payment', compact('payment', 'userdata'));
    }
    public function succes(Request $request)
    {
        // dd($request->all());
        $tdate = date('Y-m-d');
        $userid = session()->get('UserLogin2id');
        $orderId = $request->razorpay_order_id;
        $api = new Api(env('rzr_key'), env('rzr_secret'));

        $status = $api->order->fetch($orderId);


        $orders = Payment::where('payment_id', $request->razorpay_order_id)->first();
        if ($orders) {


            $orders->status = '1';
            $orders->r_payment_id = $request->razorpay_payment_id;
            $orders->amount = $status->amount / 100;
            $orders->status = $status->status;
            $orders->update();



            $blance = orderdetail::where('user_id', $userid)
                ->orderBy('orderid', 'DESC')
                ->first();

            // Initialize $close_blance with $credit1
            $close_blance = $status->amount / 100;
            $credit1 = $status->amount / 100;
            // Check if a balance record exists and update $close_blance accordingly
            if ($blance && isset($blance->close_blance)) {
                // Ensure close_blance is a number, default to 0 if null
                $previous_blance = $blance->close_blance ?? 0;
                $close_blance = $previous_blance + $credit1;
            }

            // Create a new order detail record
            $wellet = new orderdetail;
            $wellet->credit = $status->amount / 100;
            $wellet->awb_no = $request->razorpay_payment_id;
            $wellet->transaction = $request->razorpay_order_id;
            $wellet->close_blance = $close_blance;
            $wellet->date = $tdate;
            $wellet->user_id = $userid;
            $wellet->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }





        // // $request->razorpay_order_id;
        // // $request->razorpay_signature;
        // $payment = new Payment();
        // $payment->user_id = $userid;
        // $payment->r_payment_id = $request->razorpay_payment_id;
        // $payment->currency = "INR";
        // $payment->user_email = $status->email;
        // $payment->amount = $status->amount / 100;
        // $payment->status = $status->status;

        // $payment->save();
        // if ($status->status == 'captured') {
        //     return redirect('/Wallet')->with("success", "payment successsfully");
        // } else {
        //     return redirect('/Wallet')->with("fail ','payment fail");
        // }
    }
    public function orderStatus1()
    {
        try {
            $params = bulkorders::where('apihitornot', '1')
                ->orderBy('Single_Order_Id', 'DESC')
                ->limit(10)
                ->get();

            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number
                $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                    'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                    'password' => 'Hansi@@2024@@',
                    'awb' => $crtidis,
                ]);

                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body());

                    if ($xml !== false) {
                        $status = (string)$xml->object->field[11];
                        $status1 = count($xml->object->field[36]->object);

                        $updateData = [
                            'order_status_show' => $status,
                            'showerrors' => $status,
                        ];

                        if ($status == 'Connected') {
                            $updateData['order_status_show'] = $status1 > 10 ? 'intranit' : 'manifested';
                            $updateData['showerrors'] = $updateData['order_status_show'];
                        }

                        bulkorders::where('Awb_Number', $crtidis)->update($updateData);
                    } else {
                        return response()->json(['error' => 'Failed to parse XML'], 500);
                    }
                } else {
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orderStatus2()
    {


        try {
            $params = bulkorders::where('Awb_Number', '!=', '') // Check if Awb_Number is not null
                ->where('showerrors', '!=', 'Delivered')
                ->orderBy('awb_gen_by') // Assuming you want to order by this column
                ->orderBy('Single_Order_Id', 'desc')
                // ->limit(100)
                ->get();
            dd($params);

            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0; // Counter for completed orders
            foreach ($params as $param) {
                if ($completedOrders >= 100) {
                    break; // Exit loop if 100 completed orders are found
                }

                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());

                        if ($xml !== false) {
                            $status = (string)$xml->object->field[11];
                            $status2 = (string)$xml->object->field[14];
                            $status1 = count($xml->object->field[36]->object);

                            $updateData = [
                                'order_status_show' => $status2,
                                'showerrors' => $status,
                            ];

                            bulkorders::where('Awb_Number', $crtidis)->update($updateData);

                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            return response()->json(['error' => 'Failed to parse XML'], 500);
                        }
                    } else {
                        return response()->json(['error' => 'HTTP request failed'], $response->status());
                    }
                } catch (\Exception $e) {
                    // Log the error or handle it as needed
                    if (strpos($e->getMessage(), 'EntityRef: expecting') !== false) {
                        // XML parsing error occurred, set specific values for showerrors and order_status_show
                        $updateData = [
                            'order_status_show' => '777',
                            'showerrors' => 'Return To Shipper RTS',
                        ];
                        bulkorders::where('Awb_Number', $crtidis)->update($updateData);
                    }
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function orderStatusBluedart()
    {

        try {
            $orders = bulkorders::where('awb_gen_courier', 'BlueDart')
                //   ->where('awb_gen_courier', 'BlueDart')
                ->whereNotIn('showerrors', ['Delivered', 'cancelled'])
                // ->whereNotIn('showerrors', ['delivered', 'exception', 'rto', 'cancelled'])
                // ->whereIn('showerrors', ['pending pickup'])
                ->where('order_status', '1')
                ->where('order_cancel', '!=', '1')
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(80)
                ->get();
            //   dd($orders)  ;

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            set_time_limit(300);
            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => 'upload']);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Cookie' => 'shipclues_session=iZ4dgCGTk45lE8pE9sdawi4Bp1dwAJ7rEi8iJqBL',
                ])->post('https://www.shipclues.com/api/order-track', [
                    'ApiKey' => 'TdRxkE0nJd4R78hfEGSz2P5CAIeqzUtZ84EFDUX9',
                    'AWBNumber' => $awbNumber
                ]);

                //     $responseData = $response->json();
                //     echo "<br><pre>";
                //     print_r($responseData);
                //     echo "</pre><br>";

                //  echo  $status = $responseData['CurrentStatus'];

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['CurrentStatus'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);






                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Updates order Status (Xpressbee)
     * @api_method GET
     * @api_url /order-update-status3
     */
    public function orderStatus3()
    {

        try {
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
                //   ->where('User_Id', '109')
                //   ->where('User_Id', '!=', '109')
                //   ->where('Rec_Time_Date', '2024-07-24')
                // ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                // ->whereIn('showerrors', ['pending pickup'])
                ->where('order_status', '1')
                ->where('order_cancel', '!=', '1')
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(80)
                ->select('Awb_Number')
                ->get();

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            set_time_limit(300);
            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => 'upload']);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'shipnick11@gmail.com',
                    'password' => 'Xpress@5200',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);






                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function orderStatus311()
    {

        try {
            $orders = bulkorders::where('awb_gen_courier', 'Xpressbee2')
                ->where('User_Id', '171')
                //   ->where('User_Id', '!=', '109')
                //   ->where('Rec_Time_Date', '	2024-09-23')
                // ->whereNotIn('showerrors', ['delivered', 'cancelled','in transit'])
                // ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                // ->whereIn('showerrors', ['pending pickup'])
                ->where('order_status', 'upload')
                ->where('order_cancel', '!=', '1')
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(80)
                ->select('Awb_Number')
                ->get();

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            set_time_limit(300);
            $completedOrders = 0;
            bulkorders::whereIn('Awb_Number', $orders)
                ->update(['order_status' => '1']);

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;



                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'glamfuseindia67@gmail.com',
                    'password' => 'shyam104A@',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);






                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orderStatus31()
    {

        try {
            $orders = bulkorders::where('awb_gen_courier', 'Xpressbee3')
                //   ->where('awb_gen_courier', 'Xpressbee3')
                ->where('User_Id', '122')
                //   ->where('Rec_Time_Date', '	2024-08-26')
                // ->whereNotIn('showerrors', ['delivered', 'cancelled'])
                // ->whereNotIn('showerrors', ['delivered', 'exception', 'rto', 'cancelled'])
                ->whereIn('showerrors', ['pending pickup'])
                ->where('order_status', 'upload')
                ->where('order_cancel', '!=', '1')
                ->whereNotNull('Awb_Number')
                ->orderBy('Single_Order_Id', 'ASC')
                ->limit(100)
                ->get();
            //   dd($orders)  ;

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }
            set_time_limit(300);
            $completedOrders = 0;
            bulkorders::whereIn('Awb_Number', $orders)
                ->update(['order_status' => '1']);

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;



                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'Ballyfashion77@gmail.com',
                    'password' => 'shyam104A@',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);
                    // $awbnew = $responseData['data']['awb_number'];
                    // $order_id = $responseData['data']['order_number'];
                    // $current_status = $responseData['data']['status'];
                    // $last_location = $responseData['data']['history'][0]['location'];
                    // $last_scanned = $responseData['data']['history'][0]['event_time'];
                    // $last_remark = $responseData['data']['status'];
                    // $lastattempt_date = $responseData['data']['history'][0]['event_time'];

                    // $pickup_date = $responseData['data']['created'];
                    // $new = date('Y-m-d', strtotime($last_scanned));
                    // $newDate = \DateTime::createFromFormat('Y-m-d', $new);
                    // $pickupDate = \DateTime::createFromFormat('Y-m-d', $pickup_date);

                    // if ($newDate !== false && $pickupDate !== false) {
                    //     // Proceed with calculating the difference if both dates are valid DateTime objects
                    //     $daysDifference =  $pickupDate->diff($newDate)->days;
                    // } else {
                    //     // Handle the case where date creation failed
                    //     $daysDifference = null; // or set a default value or handle the error as needed
                    // }


                    // $newawb = MIS_Report::where('Awb_Number', $awbnew)->first();

                    // if (isset($newawb->id)) {
                    //     MIS_Report::where('Awb_Number', '=', $awbnew)
                    //         ->update([
                    //             'order_id' => $order_id,
                    //             'awb_number' => $awbnew,
                    //             'current_status' => $current_status,
                    //             'last_scanned_at' => $last_scanned,
                    //             'last_location' => $last_location,
                    //             'last_scan_remark' => $last_remark,
                    //             'last_attempt_date' => $lastattempt_date,
                    //             'turn_around_time' => $daysDifference,

                    //         ]);
                    // } else {
                    //     // Create new record
                    //     $misreport = new MIS_Report;

                    //     $misreport->order_id = $order_id;
                    //     $misreport->awb_number = $awbnew;
                    //     $misreport->current_status = $current_status;
                    //     $misreport->last_scanned_at = $last_scanned;
                    //     $misreport->last_location = $last_location;
                    //     $misreport->last_scan_remark = $last_remark;
                    //     $misreport->delivery_attempts = "1";
                    //     $misreport->last_attempt_date = $lastattempt_date;
                    //     $misreport->turn_around_time = $daysDifference;
                    //     $misreport->charges_total = "0";
                    //     $misreport->save();
                    // }


                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Updates order Status (eCOM)
     * @api_method GET
     * @api_url /order-update-status
     */
    public function orderStatus()
    {
        $userid = session()->get('UserLogin2id');
        try {
            $params = bulkorders::where('awb_gen_by', 'Ecom') // Check if Awb_Number is not null
                ->whereNotIn('showerrors', ['Delivered'])
                //   ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection','Shipment Not Handed over'])
                // ->whereIn('showerrors', ['Shipment Not Handed over'])
                ->where('Rec_Time_Date', '2024-08-26')
                ->where('User_Id', '165')
                // ->where('User_Id', '122')
                ->where('order_status', '1')
                ->where('order_cancel', '!=', '1')
                ->where('Awb_Number', '!=', '') // Assuming you want to order by this column
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(80)
                ->get();


            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            // Increase PHP script execution time
            set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)

            $completedOrders = 0; // Counter for completed orders
            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                bulkorders::where('Awb_Number', $crtidis)->update(['order_status' => 'upload']);

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    $xml = simplexml_load_string($response->body());

                    // Convert SimpleXMLElement to JSON
                    $json = json_encode($xml);


                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());
                        // print_r($xml);

                        if ($xml !== false) {
                            echo $crtidis;
                            echo  $status = (string)$xml->object->field[11];
                            $status2 = (string)$xml->object->field[14];
                            $status1 = count($xml->object->field[36]->object);

                            $updateData = [
                                'order_status_show' => $status2,
                                'showerrors' => $status,
                            ];

                            bulkorders::where('Awb_Number', $crtidis)->update($updateData);



                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            return response()->json(['error' => 'Failed to parse XML'], 500);
                        }
                    } else {
                        return response()->json(['error' => 'HTTP request failed'], $response->status());
                    }
                } catch (\Exception $e) {
                    // Log the error or handle it as needed
                    if (strpos($e->getMessage(), 'EntityRef: expecting') !== false) {
                        // XML parsing error occurred, set specific values for showerrors and order_status_show
                        $updateData = [
                            'order_status_show' => '777',
                            'showerrors' => 'Return To Shipper RTS',
                        ];
                        bulkorders::where('Awb_Number', $crtidis)->update($updateData);
                    }
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


        //     try {
        //     $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
        //         ->where('showerrors', '!=', 'Delivered')
        //         ->where('order_status', 'Upload')
        //         ->whereNotNull('Awb_Number')
        //         ->orderBy('Single_Order_Id', 'desc')
        //         ->limit(100)
        //         ->get();

        //     if ($orders->isEmpty()) {
        //         return response()->json(['error' => 'No orders found'], 404);
        //     }

        //     $completedOrders = 0;

        //     foreach ($orders as $order) {
        //         $awbNumber = $order->Awb_Number;

        //         bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

        //          $response = Http::withHeaders([
        //                 'Content-Type' => 'application/json',
        //             ])->post('https://shipment.xpressbees.com/api/users/login', [
        //                 'email' => 'shipnick11@gmail.com',
        //                 'password' => 'Xpress@5200',
        //             ]);

        //             $responseic = $response->json(); // Decode JSON response
        //             $xpressbeetoken = $responseic['data']; // Extract token from response data
        //             $xpressbeetoken;

        //         // $xpressbeetoken = $this->getXpressbeeToken();

        //         $response = Http::withHeaders([
        //             'Authorization' => 'Bearer ' . $xpressbeetoken,
        //         ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

        //         if ($response->successful()) {
        //             $responseData = $response->json();
        //           echo $status = $responseData['data']['status'];
        //           echo $awbNumber;

        //             bulkorders::where('Awb_Number', $awbNumber)->update([
        //                 'showerrors' => $status,
        //                 'order_status_show' => $status,

        //             ]);

        //             $completedOrders++;
        //         } else {
        //             // Handle HTTP request failure
        //             return response()->json(['error' => 'HTTP request failed'], $response->status());
        //         }
        //     }

        //     return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        // } catch (\Exception $e) {
        //     // Log the error or handle it as needed
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }
    public function orderStatusnewupadate()
    {
        $userid = session()->get('UserLogin2id');
        try {
            $params = bulkorders::where('awb_gen_by', 'Ecom') // Check if Awb_Number is not null
                //   ->whereNotIn('showerrors', ['Delivered', 'Shipment Redirected','Undelivered'])
                //   ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection','Shipment Not Handed over'])
                // ->whereIn('showerrors', ['Shipment Not Handed over'])
                ->where('Rec_Time_Date', '2024-05-30')
                // ->where('User_Id', '109')
                ->where('User_Id', '109')
                ->where('order_status', '1')
                ->where('order_cancel', '!=', '1')
                ->where('Awb_Number', '!=', '') // Assuming you want to order by this column
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(40)
                ->get();
            // dd($params);


            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            // Increase PHP script execution time
            set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)

            $completedOrders = 0; // Counter for completed orders
            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                bulkorders::where('Awb_Number', $crtidis)->update(['order_status' => 'Upload']);

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    $xml = simplexml_load_string($response->body());

                    // Convert SimpleXMLElement to JSON
                    $json = json_encode($xml);

                    // Decode JSON to PHP array
                    $data = json_decode($json, true);
                    $awbnew = $data['object']['field'][0];
                    $order_id = $data['object']['field'][1];
                    $current_status = $data['object']['field'][10];
                    $last_location = $data['object']['field'][5];
                    $last_scanned = $data['object']['field'][19];
                    $last_remark = $data['object']['field'][11];
                    $lastattempt_date = $data['object']['field'][19];
                    if (!is_array($data['object']['field'][9])) {
                        $pickup_date = $data['object']['field'][9];
                        $daysDifference = \DateTime::createFromFormat('d-M-Y', $pickup_date)->diff(\DateTime::createFromFormat('d-M-Y', $last_scanned))->days;
                    } else {

                        $daysDifference = " "; // Set $daysDifference to an empty string or handle the error as needed
                    }

                    $newawb = MIS_Report::where('Awb_Number', $awbnew)->first();

                    if (isset($newawb->id)) {
                        MIS_Report::where('Awb_Number', '=', $awbnew)
                            ->update([
                                'order_id' => $order_id,
                                'awb_number' => $awbnew,
                                'current_status' => $current_status,
                                'last_scanned_at' => $last_scanned,
                                'last_location' => $last_location,
                                'last_scan_remark' => $last_remark,
                                'last_attempt_date' => $lastattempt_date,
                                'turn_around_time' => $daysDifference,

                            ]);
                    } else {
                        // Create new record
                        $misreport = new MIS_Report;

                        $misreport->order_id = $order_id;
                        $misreport->awb_number = $awbnew;
                        $misreport->current_status = $current_status;
                        $misreport->last_scanned_at = $last_scanned;
                        $misreport->last_location = $last_location;
                        $misreport->last_scan_remark = $last_remark;
                        $misreport->delivery_attempts = "1";
                        $misreport->last_attempt_date = $lastattempt_date;
                        $misreport->turn_around_time = $daysDifference;
                        $misreport->charges_total = "0";
                        $misreport->save();
                    }

                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());

                        if ($xml !== false) {
                            echo  $status = (string)$xml->object->field[11];
                            $status2 = (string)$xml->object->field[14];
                            $status1 = count($xml->object->field[36]->object);

                            $updateData = [
                                'order_status_show' => $status2,
                                'showerrors' => $status,
                            ];

                            bulkorders::where('Awb_Number', $crtidis)->update($updateData);



                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            return response()->json(['error' => 'Failed to parse XML'], 500);
                        }
                    } else {
                        return response()->json(['error' => 'HTTP request failed'], $response->status());
                    }
                } catch (\Exception $e) {
                    // Log the error or handle it as needed
                    if (strpos($e->getMessage(), 'EntityRef: expecting') !== false) {
                        // XML parsing error occurred, set specific values for showerrors and order_status_show
                        $updateData = [
                            'order_status_show' => '777',
                            'showerrors' => 'Return To Shipper RTS',
                        ];
                        bulkorders::where('Awb_Number', $crtidis)->update($updateData);
                    }
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


        //     try {
        //     $orders = bulkorders::where('awb_gen_by', 'Xpressbee')
        //         ->where('showerrors', '!=', 'Delivered')
        //         ->where('order_status', 'Upload')
        //         ->whereNotNull('Awb_Number')
        //         ->orderBy('Single_Order_Id', 'desc')
        //         ->limit(100)
        //         ->get();

        //     if ($orders->isEmpty()) {
        //         return response()->json(['error' => 'No orders found'], 404);
        //     }

        //     $completedOrders = 0;

        //     foreach ($orders as $order) {
        //         $awbNumber = $order->Awb_Number;

        //         bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

        //          $response = Http::withHeaders([
        //                 'Content-Type' => 'application/json',
        //             ])->post('https://shipment.xpressbees.com/api/users/login', [
        //                 'email' => 'shipnick11@gmail.com',
        //                 'password' => 'Xpress@5200',
        //             ]);

        //             $responseic = $response->json(); // Decode JSON response
        //             $xpressbeetoken = $responseic['data']; // Extract token from response data
        //             $xpressbeetoken;

        //         // $xpressbeetoken = $this->getXpressbeeToken();

        //         $response = Http::withHeaders([
        //             'Authorization' => 'Bearer ' . $xpressbeetoken,
        //         ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

        //         if ($response->successful()) {
        //             $responseData = $response->json();
        //           echo $status = $responseData['data']['status'];
        //           echo $awbNumber;

        //             bulkorders::where('Awb_Number', $awbNumber)->update([
        //                 'showerrors' => $status,
        //                 'order_status_show' => $status,

        //             ]);

        //             $completedOrders++;
        //         } else {
        //             // Handle HTTP request failure
        //             return response()->json(['error' => 'HTTP request failed'], $response->status());
        //         }
        //     }

        //     return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        // } catch (\Exception $e) {
        //     // Log the error or handle it as needed
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }

    // public function orderStatus()
    // {
    //     try {
    //       $params = bulkorders::where('awb_gen_by', 'Ecom') // Check if Awb_Number is not null
    //     ->where('showerrors', '!=', 'Delivered')
    //     ->where('order_status', '1')
    //     ->where('Awb_Number', '!=', '') // Assuming you want to order by this column
    //     ->orderBy('Single_Order_Id', 'desc')
    //     ->limit(100)
    //     ->get();
    //             // dd($params);


    //         if ($params->isEmpty()) {
    //             return response()->json(['error' => 'No orders found'], 404);
    //         }

    //         // Increase PHP script execution time
    //         set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)

    //         $completedOrders = 0; // Counter for completed orders
    //         foreach ($params as $param) {
    //             $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

    //             bulkorders::where('Awb_Number', $crtidis)->update(['order_status' => 'Upload']);

    //             try {
    //                 $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
    //                     'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
    //                     'password' => 'Hansi@@2024@@',
    //                     'awb' => $crtidis,
    //                 ]);

    //                 if ($response->successful()) {
    //                     $xml = simplexml_load_string($response->body());

    //                     if ($xml !== false) {
    //                         $status = (string)$xml->object->field[11];
    //                         $status2 = (string)$xml->object->field[14];
    //                         $status1 = count($xml->object->field[36]->object);

    //                         $updateData = [
    //                             'order_status_show' => $status2,
    //                             'showerrors' => $status,
    //                         ];

    //                         bulkorders::where('Awb_Number', $crtidis)->update($updateData);

    //                         $completedOrders++; // Increment counter for completed orders
    //                     } else {
    //                         return response()->json(['error' => 'Failed to parse XML'], 500);
    //                     }
    //                 } else {
    //                     return response()->json(['error' => 'HTTP request failed'], $response->status());
    //                 }
    //             } catch (\Exception $e) {
    //                 // Log the error or handle it as needed
    //                 if (strpos($e->getMessage(), 'EntityRef: expecting') !== false) {
    //                     // XML parsing error occurred, set specific values for showerrors and order_status_show
    //                     $updateData = [
    //                         'order_status_show' => '777',
    //                         'showerrors' => 'Return To Shipper RTS',
    //                     ];
    //                     bulkorders::where('Awb_Number', $crtidis)->update($updateData);
    //                 }
    //                 continue; // Skip to the next iteration if an error occurs
    //             }
    //         }

    //         return response()->json(['message' => 'Order statuses updated successfully'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function orderStatuspickup()
    {
        set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)

        try {
            $params = bulkorders::where('awb_gen_by', 'Ecom')
                ->whereIn('showerrors', ['Upload', 'booked'])
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->get();
            // dd($params);
            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0; // Counter for completed orders
            $updateData = []; // Array to batch update data
            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());

                        if ($xml !== false) {
                            echo  $status = (string)$xml->object->field[11];
                            echo  $status2 = (string)$xml->object->field[14];

                            // $updateData[] = [
                            //   'order_status_show' => $status2,
                            // 'showerrors' => $status,
                            // ];
                            bulkorders::where('Awb_Number', $crtidis)->update(['showerrors' => $status, 'order_status_show' => $status2]);


                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            // Log the XML parsing error
                            Log::error('Failed to parse XML for AWB: ' . $crtidis);
                        }
                    } else {
                        // Log the HTTP request failure
                        Log::error('HTTP request failed for AWB: ' . $crtidis);
                    }
                } catch (\Exception $e) {
                    // Log the exception
                    Log::error('Exception for AWB ' . $crtidis . ': ' . $e->getMessage());
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            // Batch update data
            if (!empty($updateData)) {

                bulkorders::where('Awb_Number', $crtidis)->update($updateData);
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completed_orders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log and return error message
            Log::error('Exception in orderStatuspickup: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orderStatusecompickup()
    {
        set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)
        $userid = session()->get('UserLogin2id');
        try {
            $params = Bulkorders::where('awb_gen_by', 'Ecom')
                ->where('User_Id', $userid)
                ->whereNotIn('showerrors', ['Delivered'])
                ->where('showerrors', 'Shipment Not Handed over')
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->get();

            // dd($params);
            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0; // Counter for completed orders
            $updateData = []; // Array to batch update data
            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());

                        if ($xml !== false) {
                            echo  $status = (string)$xml->object->field[11];
                            echo  $status2 = (string)$xml->object->field[14];

                            // $updateData[] = [
                            //   'order_status_show' => $status2,
                            // 'showerrors' => $status,
                            // ];
                            bulkorders::where('Awb_Number', $crtidis)->update(['showerrors' => $status, 'order_status_show' => $status2]);


                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            // Log the XML parsing error
                            Log::error('Failed to parse XML for AWB: ' . $crtidis);
                        }
                    } else {
                        // Log the HTTP request failure
                        Log::error('HTTP request failed for AWB: ' . $crtidis);
                    }
                } catch (\Exception $e) {
                    // Log the exception
                    Log::error('Exception for AWB ' . $crtidis . ': ' . $e->getMessage());
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            // Batch update data
            if (!empty($updateData)) {

                bulkorders::where('Awb_Number', $crtidis)->update($updateData);
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completed_orders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log and return error message
            Log::error('Exception in orderStatuspickup: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function orderStatusecomintranit()
    {
        set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)
        $userid = session()->get('UserLogin2id');
        try {
            $params = Bulkorders::where('awb_gen_by', 'Ecom')
                ->where('User_Id', $userid)
                ->whereIn('showerrors', ['In-Transit', 'in transit', 'Connected', 'intranit', 'Ready for Connection'])
                ->whereNotNull('Awb_Number')
                // ->whereNotIn('showerrors', ['Delivered'])
                ->where('order_cancel', '!=', '1')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->get();

            // dd($params);
            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0; // Counter for completed orders
            $updateData = []; // Array to batch update data
            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());

                        if ($xml !== false) {
                            echo  $status = (string)$xml->object->field[11];
                            echo  $status2 = (string)$xml->object->field[14];

                            // $updateData[] = [
                            //   'order_status_show' => $status2,
                            // 'showerrors' => $status,
                            // ];
                            bulkorders::where('Awb_Number', $crtidis)->update(['showerrors' => $status, 'order_status_show' => $status2]);


                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            // Log the XML parsing error
                            Log::error('Failed to parse XML for AWB: ' . $crtidis);
                        }
                    } else {
                        // Log the HTTP request failure
                        Log::error('HTTP request failed for AWB: ' . $crtidis);
                    }
                } catch (\Exception $e) {
                    // Log the exception
                    Log::error('Exception for AWB ' . $crtidis . ': ' . $e->getMessage());
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            // Batch update data
            if (!empty($updateData)) {

                bulkorders::where('Awb_Number', $crtidis)->update($updateData);
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completed_orders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log and return error message
            Log::error('Exception in orderStatuspickup: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // public function orderStatus(){
    //         set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)

    //         try {
    //             $params = bulkorders::where('awb_gen_by', 'Ecom')
    //                 ->whereIn('showerrors', ['In-Transit', 'in transit','Connected', 'intranit','Ready for Connection'])
    //                 ->whereNotNull('Awb_Number')
    //                 ->orderBy('Single_Order_Id', 'desc')
    //                 ->limit(100)
    //                 ->get();
    //             // dd($params);
    //             if ($params->isEmpty()) {
    //                 return response()->json(['error' => 'No orders found'], 404);
    //             }

    //             $completedOrders = 0; // Counter for completed orders
    //             $updateData = []; // Array to batch update data
    //             foreach ($params as $param) {
    //                 $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

    //                 try {
    //                     $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
    //                         'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
    //                         'password' => 'Hansi@@2024@@',
    //                         'awb' => $crtidis,
    //                     ]);

    //                     if ($response->successful()) {
    //                         $xml = simplexml_load_string($response->body());

    //                         if ($xml !== false) {
    //                           echo  $status = (string)$xml->object->field[11];
    //                           echo  $status2 = (string)$xml->object->field[14];

    //                             // $updateData[] = [
    //                             //   'order_status_show' => $status2,
    //                             // 'showerrors' => $status,
    //                             // ];
    //                                 bulkorders::where('Awb_Number', $crtidis)->update(['showerrors' => $status,'order_status_show' => $status2]);


    //                             $completedOrders++; // Increment counter for completed orders
    //                         } else {
    //                             // Log the XML parsing error
    //                             Log::error('Failed to parse XML for AWB: ' . $crtidis);
    //                         }
    //                     } else {
    //                         // Log the HTTP request failure
    //                         Log::error('HTTP request failed for AWB: ' . $crtidis);
    //                     }
    //                 } catch (\Exception $e) {
    //                     // Log the exception
    //                     Log::error('Exception for AWB ' . $crtidis . ': ' . $e->getMessage());
    //                     continue; // Skip to the next iteration if an error occurs
    //                 }
    //             }

    //             // Batch update data
    //             if (!empty($updateData)) {

    //                 bulkorders::where('Awb_Number', $crtidis)->update($updateData);
    //             }

    //             return response()->json(['message' => 'Order statuses updated successfully', 'completed_orders' => $completedOrders], 200);
    //         } catch (\Exception $e) {
    //             // Log and return error message
    //             Log::error('Exception in orderStatuspickup: ' . $e->getMessage());
    //             return response()->json(['error' => $e->getMessage()], 500);
    //         }
    //     } 

    public function orderStatusofd()
    {
        set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)
        $userid = session()->get('UserLogin2id');

        try {
            $params = bulkorders::where('awb_gen_by', 'Ecom')
                ->whereIn('showerrors', ['Out For Delivery'])
                // ->whereNotIn('showerrors', ['Delivered'])
                ->where('User_Id', $userid)
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->get();
            // dd($params);
            if ($params->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0; // Counter for completed orders
            $updateData = []; // Array to batch update data
            foreach ($params as $param) {
                $crtidis = $param->Awb_Number; // Assuming this is the correct AWB number

                try {
                    $response = Http::get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                        'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                        'password' => 'Hansi@@2024@@',
                        'awb' => $crtidis,
                    ]);

                    if ($response->successful()) {
                        $xml = simplexml_load_string($response->body());

                        if ($xml !== false) {
                            echo  $status = (string)$xml->object->field[11];
                            echo  $status2 = (string)$xml->object->field[14];

                            // $updateData[] = [
                            //   'order_status_show' => $status2,
                            // 'showerrors' => $status,
                            // ];
                            bulkorders::where('Awb_Number', $crtidis)->update(['showerrors' => $status, 'order_status_show' => $status2]);


                            $completedOrders++; // Increment counter for completed orders
                        } else {
                            // Log the XML parsing error
                            Log::error('Failed to parse XML for AWB: ' . $crtidis);
                        }
                    } else {
                        // Log the HTTP request failure
                        Log::error('HTTP request failed for AWB: ' . $crtidis);
                    }
                } catch (\Exception $e) {
                    // Log the exception
                    Log::error('Exception for AWB ' . $crtidis . ': ' . $e->getMessage());
                    continue; // Skip to the next iteration if an error occurs
                }
            }

            // Batch update data
            if (!empty($updateData)) {

                bulkorders::where('Awb_Number', $crtidis)->update($updateData);
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completed_orders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log and return error message
            Log::error('Exception in orderStatuspickup: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orderStatuspickupxpres()
    {

        try {
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')

                ->where('showerrors', ['Upload', 'booked', ''])
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                ->where('order_status', 'Upload')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->get();


            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'shipnick11@gmail.com',
                    'password' => 'Xpress@5200',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);

                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function orderStatusxpressofd()
    {

        try {
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')

                ->whereIn('showerrors', ['out for delivery'])
                ->whereNotNull('Awb_Number')
                ->where('User_Id', '109')
                ->where('order_cancel', '!=', '1')
                // ->where('order_status', 'intransit')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(80)
                ->get();


            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'shipnick11@gmail.com',
                    'password' => 'Xpress@5200',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);

                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function orderStatusxpresstransit()
    {

        try {
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')

                ->whereIn('showerrors', ['In-Transit', 'in transit'])
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                ->orderBy('Single_Order_Id', 'desc')
                ->where('order_status', 'pickup')
                ->limit(100)
                ->get();


            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'shipnick11@gmail.com',
                    'password' => 'Xpress@5200',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);

                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // check and update status of pickup of xpressbees
    public function orderStatusxpresspickup()
    {

        try {
            $orders = bulkorders::where('awb_gen_by', 'Xpressbee')

                ->whereIn('showerrors', ['pending pickup'])
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                // ->where('order_status', '1')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->get();


            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                    'email' => 'shipnick11@gmail.com',
                    'password' => 'Xpress@5200',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                $xpressbeetoken;

                // $xpressbeetoken = $this->getXpressbeeToken();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $xpressbeetoken,
                ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

                if ($response->successful()) {
                    $responseData = $response->json();
                    echo $status = $responseData['data']['status'];
                    echo $awbNumber;

                    bulkorders::where('Awb_Number', $awbNumber)->update([
                        'showerrors' => $status,
                        'order_status_show' => $status,

                    ]);

                    $completedOrders++;
                } else {
                    // Handle HTTP request failure
                    return response()->json(['error' => 'HTTP request failed'], $response->status());
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function shiproketstatusupdate()
    {
        try {
            $orders = bulkorders::where('awb_gen_by', 'bluedart')
                ->whereNotNull('Awb_Number')
                ->where('order_cancel', '!=', '1')
                ->where('order_status', 'upload')
                //   ->where('Rec_Time_Date', '2024-06-15')
                ->where('User_Id', '133')
                ->orderBy('Single_Order_Id', 'desc')
                ->limit(100)
                ->select('Awb_Number')
                ->get();
            // dd( $orders);

            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No orders found'], 404);
            }

            // Authenticate and get the token
            $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
                "email" => "info@shipnick.com",
                "password" => "8mVxTvH)6g8v"
            ]);

            if (!$response->successful()) {
                return response()->json(['error' => 'Authentication failed'], $response->status());
            }

            $responseData = $response->json();
            $token = $responseData['token'];

            $completedOrders = 0;

            foreach ($orders as $order) {
                $awbNumber = $order->Awb_Number;

                bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

                $response = Http::withToken($token)
                    ->post('https://apiv2.shiprocket.in/v1/external/courier/track/awbs', [
                        'awbs' => [$awbNumber],
                    ]);

                if ($response->successful()) {
                    $showdata = $response->json();

                    echo "<br><pre>";
                    print_r(($showdata));
                    echo "</pre><br>";

                    // Ensure data is available in the response
                    if (isset($showdata[$awbNumber]['tracking_data'])) {
                        $trackingData = $showdata[$awbNumber]['tracking_data'];
                        $status = $trackingData['shipment_status'] ?? null;
                        echo $status1 = $trackingData['shipment_track'][0]['current_status'] ?? null;

                        bulkorders::where('Awb_Number', $awbNumber)->update([
                            'showerrors' => $status1,
                            'order_status_show' => $status,
                        ]);

                        $completedOrders++;
                    }
                } else {
                    // Log the failed request or handle it accordingly
                }
            }

            return response()->json(['message' => 'Order statuses updated successfully', 'completedOrders' => $completedOrders], 200);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
