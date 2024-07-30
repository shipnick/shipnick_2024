<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulkordersfile extends Model
{
    use HasFactory;
    public $table = "spark_single_order_file";
    public $timestamps = false;
}
