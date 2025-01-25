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

class OrderCancel_BluedartJob implements ShouldQueue
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
        $awb = $this->order['Awb_Number'];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'JWTToken' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzdWJqZWN0LXN1YmplY3QiLCJhdWQiOlsiYXVkaWVuY2UxIiwiYXVkaWVuY2UyIl0sImlzcyI6InVybjpcL1wvYXBpZ2VlLWVkZ2UtSldULXBvbGljeS10ZXN0IiwiZXhwIjoxNzM3ODk0NDIzLCJpYXQiOjE3Mzc4MDgwMjMsImp0aSI6ImJiNjM0MDBlLWEzZmItNDA5Yy1hNmM1LTY0OTdiODljYjU5MSJ9.vmNkp3gCeEKPYglv6u6jJXLxiGbt-9wsYGx_8ps6e1U',
            'Cookie' => 'BIGipServerpl_netconnect-bluedart.dhl.com_443=!+6q63SyHCEbqTrHfR3BsqrvQUUbjCKtA6Y6Ec3z//8GKEutwQ6+cvlddVu4mayM844XL4+GsCC532oM=',
        ])
            ->post('https://apigateway.bluedart.com/in/transportation/waybill/v1/CancelWaybill', [
                'Request' => [
                    'AWBNo' => $awb,
                ],
                'Profile' => [
                    'LoginID' => 'HNS49193',
                    'LicenceKey' => 'wgo4jwpyhopkqigtjepsqmme1tngess2',
                    'Api_type' => 'S',
                ]
            ]);
        
        echo $response->body();
    }
}
