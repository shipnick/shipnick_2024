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
            'ClientID' => '9JdKNQXv45xuI2mCzFFVSGDdPh4in1ku',
            'clientSecret' => 'JdzNoBQLokmGU6VO',
            'Cookie' => 'BIGipServerpl_netconnect-bluedart.dhl.com_443=!+fTysYqXKJd2sXXfR3BsqrvQUUbjCCBOfXLGrfoTQlQpURtCxgFF1NmiMtHVF5+Xekt82FCu9qga4J8='
        ])->get('https://apigateway.bluedart.com/in/transportation/token/v1/login');

        $responseData1 = $response->json();

        // echo "<br><pre>";
        // print_r($responseData1);
        // echo "</pre><br>";

        echo $token = $responseData1['JWTToken'];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'JWTToken' =>  $token,
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
        $responseDatanew = $response->json();
        $responseDataString = "<br><pre>" . print_r($responseDatanew, true) . "</pre><br>";

        // Log the response data
        Log::error('bluedart API error response: ' . $responseDataString);


        $errmessage = $responseDatanew['awb_response']['error'][0];
        bulkorders::where('Awb_Number', $awb)->update([
            'showerrors' => $errmessage,
            'order_status_show' => $errmessage
        ]);
    }
}
