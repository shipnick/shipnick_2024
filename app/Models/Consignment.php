<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Consignment
 * @property int $id
 * @property mixed $AWB
 * @property mixed $Order_ID
 * @property mixed $Customer_Name
 * @property mixed $Address
 * @property mixed $Address2
 * @property mixed $Customer_City
 * @property mixed $Customer_State
 * @property mixed $Pincode
 * @property mixed $Mobile
 * @property mixed $Phone_Mobile_2
 * @property mixed $Consignee_Email
 * @property mixed $Product_Name
 * @property mixed $Product_Quantity
 * @property mixed $Product_Value
 * @property mixed $SKU
 * @property mixed $Order_Type
 * @property mixed $COD_AMOUNT
 * @property mixed $Weight_KG
 * @property mixed $Length
 * @property mixed $Width
 * @property mixed $Height
 * @property mixed $Invoice_Value
 * @property mixed $Total_Amount
 * @property mixed $Hub_Code
 * @property mixed $status
 * @property int $admin_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property ConsignmentStatusUpdate $statusUpdates
 */
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
        'status',
        'admin_id',
    ];

    public function statusUpdates()
    {
        return $this->hasMany(ConsignmentStatusUpdate::class, 'consignment_id')->orderBy('updated_at', 'DESC');
    }

    public function admin()
    {
        return $this->belongsTo(Allusers::class, 'admin_id', 'id');
    }

    /**
     * Creates ConsignmentStatusUpdate entry and updates the status of Consignment
     * @param mixed $consignment_status
     * @param mixed $notes
     * @return ConsignmentStatusUpdate|Model
     */
    public function updateStatus($consignment_status, $notes = '')
    {
        try {
            $status = ConsignmentStatusUpdate::firstOrCreate([
                'consignment_id' => $this->id,
                'status' => $consignment_status,
                'notes' => $notes,
            ]);
            $this->status = $consignment_status;
            $this->save();
            return $status;
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public static function boot()
    {
        parent::boot();
        // $creationCallback = function ($model) {
        //     if (empty($model->{$model->getKeyName()}))
        //         $model->{$model->getKeyName()} = Constants::getUniqueId(new self());
        // };
        // static::creating($creationCallback);
    }
}
