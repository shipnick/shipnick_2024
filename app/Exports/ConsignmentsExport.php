<?php

namespace App\Exports;
use App\Models\Consignment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ConsignmentsExport implements FromQuery
{

    use Exportable;

    public function __construct(int $limit = 1000)
    {
        $this->limit = $limit;
    }

    public function query()
    {
        return Consignment::query()->select([
            "id",
            "AWB",
            "Order_ID",
            "Customer_Name",
            "Address",
            "Address2",
            "Customer_City",
            "Customer_State",
            "Pincode",
            "Mobile",
            "Phone_Mobile_2",
            "Consignee_Email",
            "Product_Name",
            "Product_Quantity",
            "Product_Value",
            "SKU",
            "Order_Type",
            "COD_AMOUNT",
            "Weight_KG",
            "Length",
            "Width",
            "Height",
            "Invoice_Value",
            "Total_Amount",
            "Hub_Code",
            "status",
            "admin_id",
            "created_at",
            // "updated_at",
        ])->orderBy('id', 'desc')->limit($this->limit);
    }
    // public function collection()
    // {
    //     return Consignment::all();
    // }
}