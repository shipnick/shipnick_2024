<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Models\bulkorders;
use Exception;

class OrderStatusUpdate_Ekart implements ShouldQueue
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
        $this->onQueue('o_status_ekart');
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

        bulkorders::where('Awb_Number', $awbNumber)->update(['order_status' => 'upload']);

        try {
            $thisgenerateawbno = "";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->post('https://api.nimbuspost.com/v1/users/login', [
                    'email' => 'shipnicknimbus12@gmail.com',
                    'password' => 'Shipnick@123'
                ]);

            $responseic = $response->json(); // Decode JSON response
            $xpressbeetoken = $responseic['data']; // Extract token from response data
            echo $xpressbeetoken;


            $response = Http::withHeaders([
              'Authorization' => 'Bearer ' . $xpressbeetoken,
              'Content-Type' => 'application/json'
          ])->post('https://api.nimbuspost.com/v1/shipments/track/bulk', [
            'awb' => [
                'NBCC3001505963' // Replace with actual AWB numbers
            ]
              
              
          ]);

          $responseData = $response->json();
            // echo "<br><pre>";
            // print_r($responseData);
            // echo "</pre><br>";

            if ($response->successful()) {
              $responseData = $response->json();
              $status = $responseData['data'][0]['status'];

              

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
