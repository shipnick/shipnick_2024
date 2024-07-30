<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippindLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label_type',
        'Consignee_Number', // Add this line to allow mass assignment for Consignee_Number
        // Add other fields here as needed
    ];
}
