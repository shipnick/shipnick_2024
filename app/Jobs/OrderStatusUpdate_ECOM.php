<?php

namespace App\Jobs;

use App\Models\bulkorders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class OrderStatusUpdate_ECOM implements ShouldQueue
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
        $this->onQueue('o_status_ecom');
        $this->order = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $crtidis = $this->order['Awb_Number']; // Assuming this is the correct AWB number
        // file_put_contents('order_status.txt', "\n\nECom status update for $crtidis : ", FILE_APPEND);
        bulkorders::where('Awb_Number', $crtidis)->update(['order_status' => '1']);

        try {
            $response = Http::withoutVerifying()->get('https://plapi.ecomexpress.in/track_me/api/mawbd/', [
                'username' => 'PROSAVVYLUXURIESPRIVATELIMITED(ECS)130073',
                'password' => 'lnR1C8NkO1',
                'awb' => $crtidis,
            ]);

            $xml = simplexml_load_string($response->body());

            // Convert SimpleXMLElement to JSON
            $json = json_encode($xml);


            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                // print_r($xml);

                if ($xml !== false) {
                    // echo $crtidis;
                    $status = (string)$xml->object->field[11];

                    echo "\n$crtidis : $status\n";

                    $status2 = (string)$xml->object->field[14];
                    $status1 = count($xml->object->field[36]->object);


                    // file_put_contents('order_status.txt', "$status | $status2", FILE_APPEND);
                    $updateData = [
                        'order_status_show' => $status2,
                        'showerrors' => $status,
                    ];

                    bulkorders::where('Awb_Number', $crtidis)->update($updateData);
                    
                        
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
            $this->fail($e);
            // file_put_contents('order_status.txt', "$crtidis Failed", FILE_APPEND);
        }
    }
}
