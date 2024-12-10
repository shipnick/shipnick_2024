<?php

namespace App\Helper;

use App\Models\bulkorders;
use App\Models\orderdetail;
use App\Models\price;
use App\Models\WebhookLogs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UtilityHelper
{
    public static function updateBalance($param)
    {
        try {
            $zone = $param->zone;
            $userid = $param->User_Id;
            echo $courier = $param->awb_gen_by;
            $awb = $param->Awb_Number;
            $idnew = $param->Single_Order_Id;
            $date = $param->Rec_Time_Date;
            bulkorders::where('Awb_Number', $awb)->update(['shferrors' => 1]);

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

            $credit1 = 0;
            // Assign credit based on zone
            if ($zone == 'A') {
                $credit1 = $credit->fwda ?? 0;
            }
            if ($zone == 'B') {
                $credit1 = $credit->fwdb ?? 0;
            }
            if ($zone == 'C') {
                $credit1 = $credit->fwdc ?? 0;
            }
            if ($zone == 'D') {
                $credit1 = $credit->fwdd ?? 0;
            }
            if ($zone == 'E') {
                $credit1 = $credit->fwde ?? 0;
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
            $wellet = new orderdetail();
            $wellet->debit = $credit1;
            $wellet->awb_no = $awb;
            $wellet->date = $date;
            $wellet->user_id = $userid;
            $wellet->transaction = $transactionCode;
            $wellet->close_blance = $close_blance;
            $wellet->save();

            bulkorders::where('Awb_Number', $awb)->update(['shferrors' => 1]);
        } catch (\Throwable $th) {
            $msg = __FILE__ . __METHOD__ . ", Line:" . $th->getLine() . ", Msg:" . $th->getMessage();
            Log::error($msg);
            throw $th;
        }
    }

    public static function sanitize($value)
    {
        $value = trim($value);
        $value = str_replace(['�',], '', $value);
        $result = filter_var($value, FILTER_SANITIZE_STRING);
        return $result;
    }


    /**
     * Summary of webHookLog
     * @param mixed $data ["awb_number", "status", "event_time", "request_data", "response_data", "error_log", "created_at", "updated_at",]
     * @param integer | null $log_id
     * @return mixed
     * 
     * 
     * 
     */
    public static function webHookLog($data, $log_id = false)
    {
        if ($log_id) {
            $log = WebhookLogs::where('id', $log_id)->first();
            if ($log) {
                $log->request_data = $data['request_data'] ?? $log->request_data ?? '--';
                $log->response_data = $data['response_data'] ?? $log->response_data ?? '--';
                $log->error_log = $data['error_log'] ?? $log->error_log ?? '--';
                $log->updated_at = Carbon::now();
                $log->save();
            }
            return $log_id;
        }
        $log = WebhookLogs::firstOrCreate([
            "awb_number" => $data['awb_number'] ?? '',
            "status" => $data['status'] ?? '',
            "event_time" => $data['event_time'] ?? '',
            "request_data" => $data['request_data'] ?? '',
            "response_data" => $data['response_data'] ?? '',
            "error_log" => $data['error_log'] ?? '',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        return $log->id;

        # Usage 
        # ========================
        // $log_id = UtilityHelper::webHookLog([
        //     "awb_number" => 'awb',
        //     "status" => 'statuss',
        //     "event_time" => 'event_time',
        //     "request_data" => "webhookData",
        //     "response_data" => 'resp_data',
        //     "error_log" => 'error_log',
        // ]);
        // UtilityHelper::webHookLog([
        //     "error_log" => 'erroee333r_log'
        // ], 2);
    }
}
