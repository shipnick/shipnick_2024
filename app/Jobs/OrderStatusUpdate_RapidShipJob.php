<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use Exception;

class OrderStatusUpdate_RapidShipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->onQueue('o_status_rapidship');
        $this->order = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $awbNumber = $this->order['Awb_Number'];



        try {

            $url = 'https://api.rapidshyp.com/rapidshyp/apis/v1/track_order';
            $headers = [
                'Content-Type' => 'application/json',
                'rapidshyp-token' => '57731822281d866169a9563742c0b806bbce5d34916c66eacfe41e00965924ca',
            ];

            // Data to send in the POST request
            $data = [
                'seller_order_id' => '',
                'contact' => '',
                'email' => '',
                'awb' => $awbNumber,
            ];
            $response = Http::withHeaders($headers)
                ->post($url, $data);
            if ($response->successful()) {
                $responseData = $response->json();
                $status = $responseData['records'][0]['order_status'];
                $order_id = $responseData['records'][0]['seller_order_id'];
                $awb = $responseData['records'][0]['shipment_details'][0]['awb'];
                $courier = "EkartRS";

                echo "\n$awbNumber : $status\n";

                bulkorders::where('Awb_Number', $awbNumber)->update([
                    'showerrors' => $status,
                    'order_status_show' => $status,
                ]);

                foreach ($responseData['records'][0]['shipment_details'][0]['track_scans'] as $scan) {
                    $scan_datetime = $scan['scan_datetime'];
                    $scan_value = $scan['scan'];
                    $scan_location = $scan['scan_location'];
                    $status_code = $scan['rapidshyp_status_code'];

                    // Check if scan_datetime already exists in the database
                    $existingScan = DB::table('trak_orders_details')
                        ->where('scan_datetime', $scan_datetime)
                        ->where('courier', $courier)
                        ->exists();

                    // If it exists, skip the insert
                    if (!$existingScan) {
                        // Insert new record if not exists
                        DB::table('trak_orders_details')->insert([
                            'scan_datetime' => $scan_datetime,
                            'scan' => $scan_value,
                            'scan_location' => $scan_location,
                            'status_code' => $status_code,
                            'awb' => $awb,
                            'order_id' => $order_id,
                            'courier' => $courier,

                        ]);
                    }
                }
            } else {
                // Handle HTTP request failure
                // file_put_contents('order_status.txt', "$awbNumber Failed | " . print_r($response, true), FILE_APPEND);
                return response()->json(['error' => 'HTTP request failed'], $response->status());
            }
        } catch (Exception $e) {
            $this->fail($e);
            // file_put_contents('order_status.txt', "$awbNumber Failed", FILE_APPEND);
        }
    }
}
