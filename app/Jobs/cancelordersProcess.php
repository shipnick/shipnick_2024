<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\orderdetail;
use App\Models\Allusers;
use App\Models\CourierApiDetail;
use App\Models\courierlist;
use App\Models\courierpermission;
use App\Models\Hubs;
use App\Models\OrdersStatus;
use App\Models\CourierNames;
use App\Models\bulkorders;
use App\Models\bulkordersfile;
use App\Models\EcomAwbs;
use App\Models\smartship;
use App\Models\BulkPincode;

class cancelordersProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $loopno = 0;
    $tdateare = date('Y-m-d H:i:s'); // Assuming this is the current date/time

    $params = bulkorders::where('order_cancel', '1')
        // ->where('order_cancel_reasion', ' ')
        ->where('awb_gen_by', '!=', '') 
          ->where('order_status_show', '!=', ['Cancel']) 
        //   ->where('awb_gen_by','Ecom')
        //   ->where('User_Id', '109')
        //   ->where('order_status_show', '0011')
       
        ->orderByDesc('Single_Order_Id')
        // ->limit(80)
        ->get();
// dd($params);
    $totalOrders = $params->count();
    echo "Working Total Order: $totalOrders<br><br>";

    foreach ($params as $param) {
        $loopno++;
        
        
        
      echo  $shipment_id = $param->shferrors;
      echo  $Awb = $param->Awb_Number;
      echo  $courierare = $param->awb_gen_by;
      echo  $courierare1 = $param->awb_gen_courier;
      $courier_ship_no= $param->courier_ship_no;

        if ($courierare == "Ecom") {
            // Handle Ecom courier cancellation
            $response = $this->cancelEcomOrder($Awb);

            // Process response and update status accordingly
        } elseif ($courierare1 == "Xpressbee") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelXpressbeeOrder($Awb);

            // Process response and update status accordingly
        }elseif ($courierare1 == "Xpressbee2") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelXpressbee2Order($Awb);

            // Process response and update status accordingly
        }
        elseif ($courierare1 == "Xpressbee3") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelXpressbee3Order($Awb);

            // Process response and update status accordingly
        }
        elseif ($courierare == "Bluedart") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelBluedartOrder( $shipment_id);

            // Process response and update status accordingly
        }
        
        elseif ($courierare == "Bluedart-sc") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelbluedart_scOrder( $courier_ship_no);

            // Process response and update status accordingly
        }

        // Additional processing or logging can be done here
    }
    }
    private function cancelEcomOrder($awb)
{
    try {
       $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://shipment.ecomexpress.in/apiv2/cancel_awb/',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073', 'password' => 'lnR1C8NkO1', 'awbs' => $awb),
                        CURLOPT_HTTPHEADER => array(
                            'Cookie: AWSALB=AeNFVNg5YazTNZT3iTzkFmP1DGxIXjSwm802sL2a8MKv8RVIoTkF9rBYh4EHXvqxTESwcYY4wb9WEom5iKNafMRefor3n6z/O2JmkKZgr/xyYUr1u9kfyCr2hc/1; AWSALBCORS=AeNFVNg5YazTNZT3iTzkFmP1DGxIXjSwm802sL2a8MKv8RVIoTkF9rBYh4EHXvqxTESwcYY4wb9WEom5iKNafMRefor3n6z/O2JmkKZgr/xyYUr1u9kfyCr2hc/1'
                        ),
                    ));


                    $response = curl_exec($curl);
                    $responseic = json_decode($response, true);
                    curl_close($curl);
                    
                    
       
        

                  
    //   echo $statuscheck = $responseic['status'];
        echo "<br>";
        echo $statuscheck = $responseic['0']['success'];
        
        $tdateis = date('Y-m-d'); // Assuming this is the current date

        if ($responseic['0']['success']) {
            $cancelint = 1;
            $cancelstatus = "Cancel";
            $cancelreason = "Client Cancel";
            $alertmsg = "Order delete please refresh page if not deleted";

            bulkorders::where('Awb_Number', $awb)->update([
                'canceldate' => $tdateis,
                'order_status_show' => "Cancel",
                'order_cancel_reasion' => $cancelreason
            ]);
        } 
        if (!$responseic['0']['success']) {
            $cancelstatus = "Cancel";
            
            echo  $alertmsg = $responseic['0']['reason'];
            bulkorders::where('Awb_Number', $awb)->update([
                'canceldate' => $tdateis,
                'order_status_show' => "Cancel",
                'order_cancel_reasion' => $alertmsg
            ]);
        }
    } catch (\Exception $e) {
        // Log the exception or handle it as needed
        \Log::error('Exception occurred during cancelEcomOrder: ' . $e->getMessage());
        // You may want to throw the exception again to propagate it up
        // throw $e;
    }
}

private function cancelXpressbee2Order($awb)
{
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://shipment.xpressbees.com/api/users/login', [
       'email' => 'glamfuseindia67@gmail.com',
        'password' => 'shyam104A@',
    ]);

    $responseData = $response->json();
    $xpressbeetoken = $responseData['data'];

    // Make the cancel shipment API call using the token
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $xpressbeetoken,
    ])->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
        'awb' => $awb,
    ]);
    $responseData1 = $response->json();
    
    echo "<br><pre>";
                    print_r($responseData1);
                    echo "</pre><br>";

    // return $response->json();
    $tdateis = date('Y-m-d'); // Assuming this is the current date
    $statuscheck = $responseData1['status'];
                    if ($statuscheck == true) {
                        // echo $responseic['message'];
                        $tdateis =  $tdateis;
                        $cancelint = 1;
                        $cancelstatus = "Cancel";
                        $cancelreason = "Client Cancel";
                        $alertmsg = "Order delete please refresh page if not deleted";
                        bulkorders::where('Awb_Number', $awb)
                    ->update([
                        
                        'canceldate'=>$tdateis,
                        'order_status_show' => $cancelstatus,
                        'order_cancel_reasion' => $cancelreason
                    ]);
                    }  elseif ($statuscheck == false) {
                        // echo $responseic['message'];
                        $alertmsg = "Order not delete please try again";
                        bulkorders::where('Awb_Number',$awb)
                        ->update([
                            
                            'canceldate'=>$tdateis,
                            'order_status_show' => "Cancel",
                            'order_cancel_reasion' => $alertmsg
                        ]);
                    }
}
private function cancelXpressbee3Order($awb)
{
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://shipment.xpressbees.com/api/users/login', [
       'email' => 'Ballyfashion77@gmail.com',
        'password' => 'shyam104A@',
    ]);

    $responseData = $response->json();
    $xpressbeetoken = $responseData['data'];

    // Make the cancel shipment API call using the token
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $xpressbeetoken,
    ])->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
        'awb' => $awb,
    ]);
    $responseData1 = $response->json();
    
    echo "<br><pre>";
                    print_r($responseData1);
                    echo "</pre><br>";

    // return $response->json();
    $tdateis = date('Y-m-d'); // Assuming this is the current date
    $statuscheck = $responseData1['status'];
                    if ($statuscheck == true) {
                        // echo $responseic['message'];
                        $tdateis =  $tdateis;
                        $cancelint = 1;
                        $cancelstatus = "Cancel";
                        $cancelreason = "Client Cancel";
                        $alertmsg = "Order delete please refresh page if not deleted";
                        bulkorders::where('Awb_Number', $awb)
                    ->update([
                        
                        'canceldate'=>$tdateis,
                        'order_status_show' => $cancelstatus,
                        'order_cancel_reasion' => $cancelreason
                    ]);
                    }  elseif ($statuscheck == false) {
                        // echo $responseic['message'];
                        $alertmsg = "Order not delete please try again";
                        bulkorders::where('Awb_Number',$awb)
                        ->update([
                            
                            'canceldate'=>$tdateis,
                            'order_status_show' => "Cancel",
                            'order_cancel_reasion' => $alertmsg
                        ]);
                    }
}
private function cancelXpressbeeOrder($awb)
{
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://shipment.xpressbees.com/api/users/login', [
        'email' => 'glamfuseindia67@gmail.com',
            'password' => 'shyam104A@',
    ]);

    $responseData = $response->json();
    $xpressbeetoken = $responseData['data'];

    // Make the cancel shipment API call using the token
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $xpressbeetoken,
    ])->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
        'awb' => $awb,
    ]);
    $responseData1 = $response->json();
    
    echo "<br><pre>";
                    print_r($responseData1);
                    echo "</pre><br>";

    // return $response->json();
    $tdateis = date('Y-m-d'); // Assuming this is the current date
    $statuscheck = $responseData1['status'];
                    if ($statuscheck == true) {
                        // echo $responseic['message'];
                        $tdateis =  $tdateis;
                        $cancelint = 1;
                        $cancelstatus = "Cancel";
                        $cancelreason = "Client Cancel";
                        $alertmsg = "Order delete please refresh page if not deleted";
                        bulkorders::where('Awb_Number', $awb)
                    ->update([
                        
                        'canceldate'=>$tdateis,
                        'order_status_show' => $cancelstatus,
                        'order_cancel_reasion' => $cancelreason
                    ]);
                    }  elseif ($statuscheck == false) {
                        // echo $responseic['message'];
                        $alertmsg = "Order not delete please try again";
                        bulkorders::where('Awb_Number',$awb)
                        ->update([
                            
                            'canceldate'=>$tdateis,
                            'order_status_show' => "Cancel",
                            'order_cancel_reasion' => $alertmsg
                        ]);
                    }
}
private function cancelBluedartOrder($shipment_id) 
{
    // Authenticate and get the token
    $authResponse = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
        "email" => "info@shipnick.com",
        "password" => "8mVxTvH)6g8v"
    ]);

    $authData = $authResponse->json();

    // Check if authentication was successful and token is received
    if (isset($authData['token'])) {
        $token = $authData['token'];
    } else {
        echo "Authentication failed!";
        return;
    }

    // Cancel the order using the received token
    $cancelResponse = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $token
    ])->post('https://apiv2.shiprocket.in/v1/external/orders/cancel', [
        'ids' => [$shipment_id]
    ]);

    $cancelData = $cancelResponse->json();

    echo "<br><pre>";
    print_r($cancelData);
    echo "</pre><br>";
    echo $shipment_id;

    $currentDate = date('Y-m-d'); // Current date

    // Check if the 'status' key exists in the response data
    if (isset($cancelData['status']) && $cancelData['status'] == 200) {
        $cancelStatus = "Cancel";
        $cancelReason = "Client Cancel";
        $alertMsg = "Order deleted. Please refresh the page if not deleted.";

        bulkorders::where('shferrors', $shipment_id)
            ->update([
                'canceldate' => $currentDate,
                'order_status_show' => $cancelStatus,
                'order_cancel_reasion' => $cancelReason
            ]);
    } else {
        $alertMsg = "Order not deleted. Please try again.";

        // Check for error messages in the response data
        // $errorMessage = isset($cancelData['message']) ? $cancelData['message'] : $alertMsg;
        

        bulkorders::where('shferrors', $shipment_id)
            ->update([
                'canceldate' => $currentDate,
                'order_cancel_reasion' => 'canceled',
                'order_status_show' => 'Cancel'
            ]);
    }
}
private function cancelbluedart_scOrder($courier_ship_no)
{
    $response = Http::post('https://www.shipclues.com/api/order-cancel', [
    'ApiKey' => 'TdRxkE0nJd4R78hfEGSz2P5CAIeqzUtZ84EFDUX9',
    'OrderID' => $courier_ship_no,
    ]);
    
    

    $responseData1 = $response->json();
    $tdateis = date('Y-m-d'); // Assuming this is the current date
    $statuscheck = $responseData1['status'];
                    if ($statuscheck == true) {
                        // echo $responseic['message'];
                        $tdateis =  $tdateis;
                        
                        $alertmsg = "Order delete please refresh page if not deleted";
                        bulkorders::where('courier_ship_no', $courier_ship_no)
                    ->update([
                        
                        'canceldate'=>$tdateis,
                        'order_status_show' =>  "Cancel",
                        'order_cancel_reasion' =>"Client Cancel"
                    ]);
                    }  else {
                        // echo $responseic['message'];
                        $alertmsg = "Order not delete please try again";
                        bulkorders::where('Awb_Number',$awb)
                        ->update([
                            
                            'canceldate'=>$tdateis,
                            'order_status_show' => "Cancel",
                            'order_cancel_reasion' => $alertmsg
                        ]);
                    }
}

}
