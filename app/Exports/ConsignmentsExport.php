<?php

namespace App\Exports;
use App\Models\Consignment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsignmentsExport implements FromQuery, WithHeadings
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

    public function headings(): array
    {
        return [
            'ID',
            "AWB",
            "Order_ID",
            "Customer Name",
            "Address",
            "Address2",
            "Customer City",
            "Customer State",
            "Pincode",
            "Mobile",
            "Phone Mobile",
            "Consignee Email",
            "Product Name",
            "Product Quantity",
            "Product Value",
            "SKU",
            "Order Type",
            "COD AMOUNT",
            "Weight KG",
            "Length",
            "Width",
            "Height",
            "Invoice Value",
            "Total Amount",
            "Hub Code",
            "Status",
            "Admin ID",
            "Dated",
        ];
    }


    // public function collection()
    // {
    //     return Consignment::all();
    // }
}