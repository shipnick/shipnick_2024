<?php

namespace App\Http\Controllers\V1;

use App\Models\Consignment;
use App\Providers\ConsignmentProvider;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsignmentController extends V1BaseController
{
    /**
     * * Tracking page for AWB nos
     * @return mixed|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function getTrackConsignments()
    {
        try {
            return view('V1.track-consignments')->with([
                'consignments' => []
            ]);
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }
    /**
     * After AWB nos Tracking
     * @return mixed|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function postTrackConsignments()
    {
        try {
            $data = request()->all();
            $awb_nos = explode("\r\n", trim($data['awb_nos']));
            $consignments = Consignment::whereIn('AWB', $awb_nos)->with(['statusUpdates'])->get();
            // dd($consignments->toArray());
            // return redirect()->back()->with([
            //     'consignments' => $consignments
            // ]);
            return view('V1.track-consignments')->with([
                'awb_nos' => $awb_nos,
                'consignments' => $consignments
            ]);
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }

    /**
     * OpenAPI of Track Consignments using AWB numbers
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function openApiTrackConsignments()
    {
        try {
            $data = request()->all();
            if (empty($data['awb_nos'])) {
                return $this->errorJSON("Please provide AWB numbers.", [], 422);
            }
            $awb_nos = explode(",", trim($data['awb_nos']));
            if (empty($data['details'] ?? "")) {
                $consignments = Consignment::select([
                    "id",
                    "AWB",
                    "Order_ID",
                    "Customer_Name",
                    "Pincode",
                    "Total_Amount",
                    "Hub_Code",
                    "status",
                ])
                    ->whereIn('AWB', $awb_nos)
                    ->with([
                        'statusUpdates' => fn($q) => $q->select([
                            "status",
                            "notes",
                            "updated_at",
                            "consignment_id"
                        ])
                    ])
                    ->get();
            } else {
                $consignments = Consignment::whereIn('AWB', $awb_nos)->with(['statusUpdates'])->get();
            }
            // dd($consignments->toArray());
            // return redirect()->back()->with([
            //     'consignments' => $consignments
            // ]);
            return $this->successJSON($consignments);
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Upload page for Consignments
     * @url /v1/upload
     * @method GET
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function getUploadConsignments()
    {
        try {
            // dd(auth()->user());
            return view("V1.upload-consignment-orders");
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }
    /**
     * Uploads Consignments and creates a status entry
     * @url /v1/upload
     * @method POST
     * @return mixed|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function postUploadConsignments()
    {
        try {
            $file = request()->file('orders');
            $file_path = $file->store('shipnick_orders', 'public');
            $file_path = storage_path($file_path);
            // dd(storage_path($file_path));

            $total_no_of_orders = 0;
            // Read File
            $fileD = fopen($file, "r");
            // $fileD = fopen('sample.csv',"r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }

            $total_no_of_orders = count($rowData);
            $awb_nos = [];
            foreach ($rowData as $key => $value) {
                if (empty($value) || empty($value[0])) {
                    continue;
                }
                $awb_nos[] = [
                    "awb" => ConsignmentProvider::createAndGetAWB($value),
                    "order_id" => $value[0]
                ];
            }
            // dd($awb_nos);
            return view("V1.upload-consignment-orders", [
                'awb_nos' => $awb_nos
            ]);
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }
}
