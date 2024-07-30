<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusLabel extends Model
{
    use HasFactory;
    public $table = "orderstatus_labels";
    public $timestamps = false;
}
