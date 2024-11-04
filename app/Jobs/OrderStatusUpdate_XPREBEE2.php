<?php

namespace App\Jobs;

use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
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

            $xpressbeetoken = Cache::remember('xpressbee2_token', 1500, function () {
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
                $param = bulkorders::where('Awb_Number', $awbNumber)->first();

                        $zone = $param->zone;
                        $userid = $param->User_Id;
                        $courier = $param->awb_gen_by;
                        $awb = $awbNumber;
                        $idnew = $param->Single_Order_Id;
                        $date = $param->Rec_Time_Date;
                        

                        // Fetch credit details
                        $credit = price::where('user_id', $userid)
                            ->where('name', $courier)
                            ->first();

                        if (!$credit) {
                            $credit = price::where('status', 'defult')
                                ->where('name', $courier)
                                ->first();
                            // Handle the case where no credit record is found
                            // Log an error, skip this record, etc.
                            // continue;
                        }

                        // Assign credit based on zone
                        if ($zone == 'A') {
                            $credit1 = $credit->fwda;
                        }
                        if ($zone == 'B') {
                            $credit1 = $credit->fwdb;
                        }
                        if ($zone == 'C') {
                            $credit1 = $credit->fwdc;
                        }
                        if ($zone == 'D') {
                            $credit1 = $credit->fwdd;
                        }
                        if ($zone == 'E') {
                            $credit1 = $credit->fwde;
                        }

                        $transactionCode = "TR00" . $idnew;


                        // Fetch the most recent balance record for the given user
                        $blance = orderdetail::where('user_id', $userid)
                            ->orderBy('orderid', 'DESC')
                            ->first();

                        // Initialize $close_blance with $credit1
                        $close_blance = -$credit1;

                        // Check if a balance record exists and update $close_blance accordingly
                        if ($blance && isset($blance->close_blance)) {
                            // Ensure close_blance is a number, default to 0 if null
                            $previous_blance = $blance->close_blance ?? 0;
                            $close_blance = $previous_blance - $credit1;
                        }
                        // dd($transactionCode,$credit1,$awb , $close_blance,$date);
                        // Create a new order detail record
                        $wellet = new orderdetail;
                        $wellet->debit = $credit1;
                        $wellet->awb_no = $awb;
                        $wellet->date = $date;
                        $wellet->user_id =  $userid;
                        $wellet->transaction = $transactionCode;
                        $wellet->close_blance = $close_blance;
                        $wellet->save();

                        bulkorders::where('Awb_Number', $awb)->update(['shferrors' => 1]);
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
