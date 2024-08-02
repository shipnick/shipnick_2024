<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;




class APIBigShip extends Controller
{
    public function OrderPlaceToCourier()
    {
        // Fetch orders that need API interaction
        $orders = bulkorders::where('apihitornot', '0')
            ->orderby('Single_Order_Id', 'DESC')
            ->limit(80)
            ->get();

        // Output the total number of orders
        echo "Working Total Order: " . count($orders) . "<br><br>";

        // Update orders to indicate API hit status
        foreach ($orders as $order) {
            bulkorders::where('Single_Order_Id', $order->Single_Order_Id)
                ->update(['apihitornot' => 1]);

            $response = $this->processOrderWithCouriers($order);

            // Update the order with the response or error
            bulkorders::where('Single_Order_Id', $order->Single_Order_Id)
                ->update([
                    'showerrors' => $response['error'],
                    'order_status_show' => $response['status']
                ]);
        }
    }

    private function processOrderWithCouriers($order)
    {
        $courierPriorityList = courierpermission::where('user_id', $order->User_Id)
            ->where('admin_flg', '1')
            ->where('user_flg', '1')
            ->orderby('courier_priority', 'asc')
            ->pluck('courier_idno');

        $allErrors = []; // Initialize an array to collect all errors

        foreach ($courierPriorityList as $courierId) {
            $response = $this->handleCourier($courierId, $order);

            // Collect error if the courier fails
            if ($response['status'] === 'Error') {
                $allErrors[] =  $response['error'];
            } else {
                // If a courier is successful, return the success response
                return $response;
            }
        }

        // If no courier was successful, return the collected errors
        return ['status' => 'Failed', 'error' => implode('; ', $allErrors)];
    }

    private function handleCourier($courierId, $order)
    {
        switch ($courierId) {
            case "xpressbee02":
                return $this->handleXpressbee1($order);
            case "ecom01":
                return $this->handleEcom($order);
            case "xpressbee0":
                return $this->handleXpressbee($order);
            default:
                return ['status' => 'Error', 'error' => 'Unknown Courier'];
        }
    }

    private function handleEcom($order)
    {
        // Step 1: Fetch AWB Number from Ecom API
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shipment.ecomexpress.in/services/shipment/products/v2/fetch_awb/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                'password' => 'lnR1C8NkO1',
                'count' => '1',
                'type' => 'EXPP'
            )),
        ));

        $response = curl_exec($curl);
        $responseData = json_decode($response, true);
        curl_close($curl);

        // Check if AWB number is retrieved successfully
        $ecomawbnois = $responseData['awb'][0] ?? '';
        if (empty($ecomawbnois)) {
            return ['status' => 'Error', 'error' => 'Failed to fetch AWB number from Ecom'];
        }

        // Format date
        $ecomdate = date_create($order->Rec_Time_Date);
        $invicedateecom = date_format($ecomdate, "d-m-Y");

        // Prepare data for the Ecom manifest API
        $paymentmode = $order->Order_Type === 'Prepaid' ? 'PPD' : 'COD';
        $damob = strlen($order->Mobile) > 10 && substr($order->Mobile, 0, 2) === '91'
            ? substr($order->Mobile, 2)
            : $order->Mobile;

        $postData = array(
            'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
            'password' => 'lnR1C8NkO1',
            'json_input' => json_encode(array(
                array(
                    "AWB_NUMBER" => $ecomawbnois,
                    "ORDER_NUMBER" => $order->ordernoapi,
                    "PRODUCT" => $paymentmode,
                    "CONSIGNEE" => $order->Name,
                    "CONSIGNEE_ADDRESS1" => $order->Address,
                    "DESTINATION_CITY" => $order->City,
                    "PINCODE" => $order->Pincode,
                    "STATE" => $order->State,
                    "MOBILE" => $damob,
                    "TELEPHONE" => $damob,
                    "ITEM_DESCRIPTION" => $order->Item_Name,
                    "PIECES" => $order->Quantity,
                    "COLLECTABLE_VALUE" => $order->Cod_Amount,
                    "DECLARED_VALUE" => $order->Total_Amount,
                    "ACTUAL_WEIGHT" => $order->Actual_Weight,
                    "VOLUMETRIC_WEIGHT" => $order->volumetric_weight,
                    "LENGTH" => $order->Length,
                    "BREADTH" => $order->Width,
                    "HEIGHT" => $order->Height,
                    "PICKUP_NAME" => $order->pickup_name,
                    "PICKUP_ADDRESS_LINE1" => $order->pickup_address,
                    "PICKUP_PINCODE" => $order->pickup_pincode,
                    "PICKUP_PHONE" => $order->pickup_mobile,
                    "RETURN_NAME" => $order->pickup_name,
                    "RETURN_ADDRESS_LINE1" => $order->pickup_address,
                    "RETURN_PINCODE" => $order->pickup_pincode,
                    "RETURN_PHONE" => $order->pickup_mobile,
                    "DG_SHIPMENT" => "false",
                    "ADDITIONAL_INFORMATION" => array(
                        "GST_TAX_CGSTN" => 0,
                        "GST_TAX_IGSTN" => 0,
                        "GST_TAX_SGSTN" => 0,
                        "SELLER_GSTIN" => "",
                        "INVOICE_DATE" => $order->ordernoapi,
                        "INVOICE_NUMBER" => $invicedateecom,
                        "GST_TAX_RATE_SGSTN" => 0,
                        "GST_TAX_RATE_IGSTN" => 0,
                        "GST_TAX_RATE_CGSTN" => 0,
                        "GST_HSN" => "",
                        "GST_TAX_BASE" => 0,
                        "GST_ERN" => "",
                        "ESUGAM_NUMBER" => "",
                        "ITEM_CATEGORY" => "",
                        "GST_TAX_NAME" => "",
                        "ESSENTIALPRODUCT" => "Y",
                        "PICKUP_TYPE" => "",
                        "OTP_REQUIRED_FOR_DELIVERY" => "Y",
                        "RETURN_TYPE" => "WH",
                        "GST_TAX_TOTAL" => 0,
                        "SELLER_TIN" => "",
                        "CONSIGNEE_ADDRESS_TYPE" => "",
                        "CONSIGNEE_LONG" => "1.4434",
                        "CONSIGNEE_LAT" => "2.987"
                    )
                )
            ))
        );

        // Step 2: Create Manifest with Ecom API
        $curl = curl_init('https://shipment.ecomexpress.in/services/expp/manifest/v2/expplus/');
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
        ));

        $response = curl_exec($curl);
        $responseecom = json_decode($response, true);
        curl_close($curl);

        // Check the response and update database
        if (isset($responseecom['shipments'][0]['success']) && $responseecom['shipments'][0]['success']) {
            $ecomorderid = $responseecom['shipments'][0]['order_number'];
            $carrierby = "Ecom";

            bulkorders::where('Single_Order_Id', $order->Single_Order_Id)->update([
                'courier_ship_no' => $ecomorderid,
                'Awb_Number' => $ecomawbnois,
                'awb_gen_by' => $carrierby,
                'awb_gen_courier' => 'Ecom'
            ]);

            return ['status' => 'Success', 'error' => ''];
        } else {
            
           echo $error = $responseecom['shipments'][0]['reason'] ?? 'Unknown error';
            return ['status' => 'Error', 'error' => $error];
        }
    }

    private function handleXpressbee($order)
    {
        // Login to get Xpressbee token
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'shipnick11@gmail.com',
            'password' => 'Xpress@5200',
        ]);

        $responseData = $response->json();
        $xpressbeeToken = $responseData['data'] ?? '';

        if (empty($xpressbeeToken)) {
            return ['status' => 'Error', 'error' => 'Failed to obtain Xpressbee token'];
        }

        // Prepare data for the Xpressbee shipment API
        $paymentmode = $order->Order_Type == 'Prepaid' ? 'prepaid' : 'cod';
        $damob = strlen($order->Mobile) > 10 && substr($order->Mobile, 0, 2) === '91'
            ? substr($order->Mobile, 2)
            : $order->Mobile;

        $weightInGrams = 0.3 * $order->Actual_Weight; // Convert weight
        $weightInInteger = (int) $weightInGrams; // Convert to integer

        // Make the request to Xpressbee shipment API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $xpressbeeToken,
        ])->post('https://shipment.xpressbees.com/api/shipments2', [
            'order_number' => $order->ordernoapi,
            'shipping_charges' => 0,
            'discount' => 0,
            'cod_charges' => 0,
            'payment_type' => $paymentmode,
            'order_amount' => $order->Total_Amount,
            'package_weight' => $weightInInteger,
            'package_length' => $order->Length,
            'package_breadth' => $order->Width,
            'package_height' => $order->Height,
            'request_auto_pickup' => 'yes',
            'consignee' => [
                'name' => $order->Name,
                'address' => $order->Address,
                'address_2' => $order->Address,
                'city' => $order->City,
                'state' => $order->State,
                'pincode' => $order->Pincode,
                'phone' => $damob,
            ],
            'pickup' => [
                'warehouse_name' => $order->pickup_name,
                'name' => $order->pickup_name,
                'address' => $order->pickup_address,
                'address_2' => $order->pickup_address,
                'city' => $order->pickup_city,
                'state' => $order->pickup_state,
                'pincode' => $order->pickup_pincode,
                'phone' => $order->pickup_mobile,
            ],
            'order_items' => [
                [
                    'name' => $order->Item_Name,
                    'qty' => $order->Quantity,
                    'price' => $order->Total_Amount,
                    'sku' => $order->Invoice_Value,
                ],
            ],
            'courier_id' => '1',
            'collectable_amount' => $order->Cod_Amount,
        ]);

        // Handle the response
        $responseData = $response->json();
        if (isset($responseData['status']) && $responseData['status'] == '1') {
            $awb = $responseData['data']['awb_number'] ?? '';
            $shipno = $responseData['data']['shipment_id'] ?? '';
            $orderno = $responseData['data']['order_id'] ?? '';

            bulkorders::where('Single_Order_Id', $order->Single_Order_Id)->update([
                'courier_ship_no' => $shipno,
                'Awb_Number' => $awb,
                'awb_gen_by' => 'Xpressbee',
                'awb_gen_courier' => 'Xpressbee'
            ]);

            return ['status' => 'Success', 'error' => ''];
        } else {
            $error = $responseData['message'] ?? 'Unknown error';
            return ['status' => 'Error', 'error' => $error];
        }
    }
     private function handleXpressbee1($order)
    {
        // Login to get Xpressbee token
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
            'email' => 'glamfuseindia67@gmail.com',
            'password' => 'shyam104A@',
        ]);

        $responseData = $response->json();
        $xpressbeeToken = $responseData['data'] ?? '';

        if (empty($xpressbeeToken)) {
            return ['status' => 'Error', 'error' => 'Failed to obtain Xpressbee token'];
        }

        // Prepare data for the Xpressbee shipment API
        $paymentmode = $order->Order_Type == 'Prepaid' ? 'prepaid' : 'cod';
        $damob = strlen($order->Mobile) > 10 && substr($order->Mobile, 0, 2) === '91'
            ? substr($order->Mobile, 2)
            : $order->Mobile;

        $weightInGrams = 0.3 * $order->Actual_Weight; // Convert weight
        $weightInInteger = (int) $weightInGrams; // Convert to integer

        // Make the request to Xpressbee shipment API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $xpressbeeToken,
        ])->post('https://shipment.xpressbees.com/api/shipments2', [
            'order_number' => $order->ordernoapi,
            'shipping_charges' => 0,
            'discount' => 0,
            'cod_charges' => 0,
            'payment_type' => $paymentmode,
            'order_amount' => $order->Total_Amount,
            'package_weight' => $weightInInteger,
            'package_length' => $order->Length,
            'package_breadth' => $order->Width,
            'package_height' => $order->Height,
            'request_auto_pickup' => 'yes',
            'consignee' => [
                'name' => $order->Name,
                'address' => $order->Address,
                'address_2' => $order->Address,
                'city' => $order->City,
                'state' => $order->State,
                'pincode' => $order->Pincode,
                'phone' => $damob,
            ],
            'pickup' => [
                'warehouse_name' => $order->pickup_name,
                'name' => $order->pickup_name,
                'address' => $order->pickup_address,
                'address_2' => $order->pickup_address,
                'city' => $order->pickup_city,
                'state' => $order->pickup_state,
                'pincode' => $order->pickup_pincode,
                'phone' => $order->pickup_mobile,
            ],
            'order_items' => [
                [
                    'name' => $order->Item_Name,
                    'qty' => $order->Quantity,
                    'price' => $order->Total_Amount,
                    'sku' => $order->Invoice_Value,
                ],
            ],
            'courier_id' => '1',
            'collectable_amount' => $order->Cod_Amount,
        ]);

        // Handle the response
        $responseData = $response->json();
        if (isset($responseData['status']) && $responseData['status'] == '1') {
            $awb = $responseData['data']['awb_number'] ?? '';
            $shipno = $responseData['data']['shipment_id'] ?? '';
            $orderno = $responseData['data']['order_id'] ?? '';

            bulkorders::where('Single_Order_Id', $order->Single_Order_Id)->update([
                'courier_ship_no' => $shipno,
                'Awb_Number' => $awb,
                'awb_gen_by' => 'Xpressbee',
                'awb_gen_courier' => 'Xpressbee'
            ]);

            return ['status' => 'Success', 'error' => ''];
        } else {
            $error = $responseData['message'] ?? 'Unknown error';
            return ['status' => 'Error', 'error' => $error];
        }
    }

   
      public function OrderPlaceToCourier121()
    {
        
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        Http::get('https://shipnick.com/UPBulk_Order_API');
        //  Http::get('https://shipnick.com/order-update-ecom');
        //  Http::get('https://shipnick.com/order-update-intransit-ecom');
        //  Http::get('https://shipnick.com/order-update-ofd-ecom');
        //  Http::get('https://www.shipnick.com/UPBulk_cancel_Order_API');
       
        
       
       
        

    }
     
public function OrdercancelToCourier()
{
    // Initialize variables
    $loopno = 0;
    $tdateare = date('Y-m-d H:i:s'); // Assuming this is the current date/time

    $params = bulkorders::where('order_cancel', '1')
        // ->where('order_cancel_reasion', ' ')
        ->where('awb_gen_by', '!=', '') 
          ->where('order_status_show', '!=', ['Cancel']) 
        //   ->where('User_Id', '109')
        //   ->where('order_status_show', '0011')
       
        ->orderByDesc('Single_Order_Id')
        ->limit(80)
        ->get();
// dd($params);
    $totalOrders = $params->count();
    echo "Working Total Order: $totalOrders<br><br>";

    foreach ($params as $param) {
        $loopno++;
        
        
        
      echo  $shipment_id = $param->shferrors;
      echo  $Awb = $param->Awb_Number;
      echo  $courierare = $param->awb_gen_by;

        if ($courierare == "Ecom") {
            // Handle Ecom courier cancellation
            $response = $this->cancelEcomOrder($Awb);

            // Process response and update status accordingly
        } elseif ($courierare == "Xpressbee") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelXpressbeeOrder($Awb);

            // Process response and update status accordingly
        }
        elseif ($courierare == "Bluedart") {
            // Handle Xpressbee courier cancellation
            $response = $this->cancelBluedartOrder( $shipment_id);

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
                'order_status_show' => $cancelstatus,
                'order_cancel_reasion' => $cancelreason
            ]);
        } 
        if (!$responseic['0']['success']) {
            $cancelstatus = "Cancel";
            
            echo  $alertmsg = $responseic['0']['reason'];
            bulkorders::where('Awb_Number', $awb)->update([
                'canceldate' => $tdateis,
                'order_status_show' => $cancelstatus,
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



private function cancelXpressbeeOrder($awb)
{
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://shipment.xpressbees.com/api/users/login', [
        'email' => 'shipnick11@gmail.com',
        'password' => 'Xpress@5200',
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

}




