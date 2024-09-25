<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\bulkorders; 
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\courierpermission; 
use App\Models\Smartship; 

class UploadOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
             try {
             $orders = bulkorders::where('apihitornot', '0')
            ->orderBy('Single_Order_Id', 'DESC')
            ->get();

        Log::info('Working Total Orders: ' . count($orders));

        // Set token name once before processing orders
        Smartship::where('id', 1)
            ->update(['tokenname' => 'orders']); // Fixed spacing issue in key

        foreach ($orders as $order) {
            $response = $this->processOrderWithCouriers($order);

            bulkorders::where('Single_Order_Id', $order->Single_Order_Id)
                ->update([
                    'showerrors' => $response['error'],
                    'order_status_show' => $response['status'],
                    'apihitornot' => 1 // Mark the order as processed
                ]);
        }
        } catch (\Exception $e) {
            \Log::error('UploadOrder job failed: '.$e->getMessage());
            throw $e; // Re-throw if you want it to be marked as failed
        }
       
    }

    private function processOrderWithCouriers($order)
    {
        // Fetch the courier priority list
        $courierPriorityList = courierpermission::where('user_id', $order->User_Id)
            ->where('admin_flg', '1')
            ->where('user_flg', '1')
            ->orderBy('courier_priority', 'asc')
            ->pluck('courier_idno');

        $allErrors = []; // Initialize an array to collect all errors

        foreach ($courierPriorityList as $courierId) {
            $response = $this->handleCourier($courierId, $order);

            if ($response['status'] === 'Error') {
                $allErrors[] = $response['error'];
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
                    "PICKUP_MOBILE" => $order->pickup_mobile,
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
            'password' => 'Hansi@@2024@@',
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
}
