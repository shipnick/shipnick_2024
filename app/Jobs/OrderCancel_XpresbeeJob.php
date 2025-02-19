<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\bulkorders;
use Illuminate\Support\Facades\Log;

class OrderCancel_XpresbeeJob implements ShouldQueue
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
        $this->order = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $awbNumber = $this->order['ordernoapi'];
        $awb = $this->order['Awb_Number'];


        $response = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://shipment.xpressbees.com/api/users/login', [
              'email' => 'Ballyfashion77@gmail.com',
              'password' => 'shyam104A@',
        ]); 

        $responseic = $response->json(); // Decode JSON response
        $xpressbeetoken = $responseic['data']; // Extract token from response data
        return $xpressbeetoken;


        $response = Http::withHeaders([
           'Authorization' => 'Bearer ' . $xpressbeetoken,
        ])
            ->post('https://shipment.xpressbees.com/api/shipments2/cancel', [
                'awb' => $awb,
            ]);

        // You can now use $response for further processing
        echo $response->body(); // Output the response content
        $responseDatanew = $response->json();
       
        $responseDataString = "<br><pre>" . print_r($responseDatanew, true) . "</pre><br>";

        // Log the response data
        Log::error('bluedart API error response: ' . $responseDataString);
        $remark = $responseDatanew['remarks'];

        $cancelstatus = "Cancel";
       
        $alertmsg = "Order delete please refresh page if not deleted";
        bulkorders::where('Awb_Number', $awb)
            ->update([

                'canceldate' => $tdateis,
                'order_status_show' => $cancelstatus,
                'order_cancel_reasion' => $remark
            ]);

    }
}
