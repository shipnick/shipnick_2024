<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsignmentStatusUpdate extends Model
{
    use HasFactory;

    const STATUS_PICKUP_SCHEDULED = 'PICKUP_SCHEDULED';
    const STATUS_PICKED_UP = 'PICKED_UP';
    const STATUS_IN_TRANSIT = 'IN_TRANSIT';
    const STATUS_SEND_TO_HUB = 'SEND_TO_HUB';
    const STATUS_RECEIVED_AT_HUB = 'RECEIVED_AT_HUB';
    const STATUS_OUT_FOR_DELIVERY = 'OUT_FOR_DELIVERY';
    const STATUS_DELIVERED = 'DELIVERED';

    protected $fillable = [
        'id',
        'consignment_id',
        'status',
    ];
}
