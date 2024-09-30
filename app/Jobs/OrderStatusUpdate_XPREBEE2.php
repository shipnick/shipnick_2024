<?php

namespace App\Jobs;

use App\Models\bulkorders;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OrderStatusUpdate_XPREBEE2 implements ShouldQueue
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
        $this->onQueue('o_status_xpressbee2');
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

        // bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => '1']);

        try {  

            $xpressbeetoken = Cache::remember('xpressbee_token', 1500, function () {
                $response = Http::withoutVerifying()->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://shipment.xpressbees.com/api/users/login', [
                     'email' => 'glamfuseindia67@gmail.com',
                            'password' => 'shyam104A@',
                ]);

                $responseic = $response->json(); // Decode JSON response
                $xpressbeetoken = $responseic['data']; // Extract token from response data
                return $xpressbeetoken;
            });
            

            // $xpressbeetoken = $this->getXpressbeeToken();

            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $xpressbeetoken,
            ])->get("https://shipment.xpressbees.com/api/shipments2/track/{$awbNumber}");

            if ($response->successful()) {
                $responseData = $response->json();
                $status = $responseData['data']['status'];

                echo "\n$awbNumber : $status\n";

                bulkorders::where('Awb_Number', $awbNumber)->update([
                    'showerrors' => $status,
                    'order_status_show' => $status,
                ]);
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
