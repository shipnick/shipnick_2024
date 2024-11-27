<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    use HasFactory;
    protected $table = 'consignments';
    protected $fillable = [
        'AWB',
        'Order_ID',
        'Customer_Name',
        'Address',
        'Address2',
        'Customer_City',
        'Customer_State',
        'Pincode',
        'Mobile',
        'Phone_Mobile_2',
        'Consignee_Email',
        'Product_Name',
        'Product_Quantity',
        'Product_Value',
        'SKU',
        'Order_Type',
        'COD_AMOUNT',
        'Weight_KG',
        'Length',
        'Width',
        'Height',
        'Invoice_Value',
        'Total_Amount',
        'Hub_Code',
    ];

    public function statusUpdates() {
        return $this->hasMany(ConsignmentStatusUpdate::class, 'consignment_id')->orderBy('updated_at', 'DESC');
    }

    public static function boot(){
        parent::boot();
        // $creationCallback = function ($model) {
        //     if (empty($model->{$model->getKeyName()}))
        //         $model->{$model->getKeyName()} = Constants::getUniqueId(new self());
        // };
        // static::creating($creationCallback);
    }
}
