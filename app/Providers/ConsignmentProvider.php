<?php

namespace App\Providers;

use App\Models\Consignment;
use App\Models\ConsignmentStatusUpdate;
use Exception;
use Illuminate\Support\ServiceProvider;

class ConsignmentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    public static function createAndGetAWB($data)
    {
        if (empty($data[0])) {
            return false;
        }
        // $awb = 221 . rand(10, 99) . substr(time(), 2, 6);
        $awb = 221 . substr(strtoupper(uniqid()), 5, 8);
        // dd($data);
        $consignment = Consignment::firstOrNew([
            'AWB' => $awb ?? null,
            'Order_ID' => $data[0] ?? null,
            'Customer_Name' => $data[1] ?? null,
            'Address' => $data[2] ?? null,
            'Address2' => $data[3] ?? null,
            'Customer_City' => $data[4] ?? null,
            'Customer_State' => $data[5] ?? null,
            'Pincode' => $data[6] ?? null,
            'Mobile' => $data[7] ?? null,
            'Phone_Mobile_2' => $data[8] ?? null,
            'Consignee_Email' => $data[9] ?? null,
            'Product_Name' => $data[10] ?? null,
            'Product_Quantity' => $data[11] ?? null,
            'Product_Value' => $data[12] ?? null,
            'SKU' => $data[13] ?? null,
            'Order_Type' => $data[14] ?? null,
            'COD_AMOUNT' => $data[15] ?? null,
            'Weight_KG' => $data[16] ?? null,
            'Length' => $data[17] ?? null,
            'Width' => $data[18] ?? null,
            'Height' => $data[19] ?? null,
            'Invoice_Value' => $data[20] ?? null,
            'Total_Amount' => $data[21] ?? null,
            'Hub_Code' => $data[22] ?? null,
            'status' => ConsignmentStatusUpdate::STATUS_PICKUP_SCHEDULED ?? null,
            'admin_id' => auth()->id() ?? null,
        ]);
        // dump($data);
        // dd($consignment);
        if ($consignment->saveOrFail()) {
            $statusEntry = ConsignmentStatusUpdate::firstOrCreate([
                'consignment_id' => $consignment->id,
                'status' => ConsignmentStatusUpdate::STATUS_PICKUP_SCHEDULED,
                'notes' => 'Scheduled pickup from ' . $consignment->Hub_Code,
            ]);
            return $awb;
        }
        return false;
    }

    public static function updateAWBStatus($AWBorConsignmentId, $status = ConsignmentStatusUpdate::STATUS_PICKED_UP)
    {
        try {
            $consignment = Consignment::where('AWB', $AWBorConsignmentId)->orWhere('id', $AWBorConsignmentId)->first();
            if (empty($consignment)) {
                throw new Exception('Consignment not found.');
            }
            $consignment_status = ConsignmentStatusUpdate::firstOrCreate([
                'consignment_id' => $consignment->id,
                'status' => $status,
            ]);
            $consignment->status = $status;
            $consignment->save();
        } catch (\Throwable $th) {
            throw $th;
        }


    }
}
