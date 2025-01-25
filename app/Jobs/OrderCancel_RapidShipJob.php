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

class OrderCancel_RapidShipJob implements ShouldQueue
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
        $awbNumber = $this->order['ordernoapi'];
        $awb = $this->order['Awb_Number'];
        
        $tdateis = date('Y-m-d');

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'rapidshyp-token' => '57731822281d866169a9563742c0b806bbce5d34916c66eacfe41e00965924ca',
        ])->post('https://api.rapidshyp.com/rapidshyp/apis/v1/cancel_order', [
            'orderId' => $awbNumber,
            'storeName' => 'DEFAULT',
        ]);
        $responseDatanew = $response->json();
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
