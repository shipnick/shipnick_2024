<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulkorders extends Model
{
    use HasFactory;
    public $table = "spark_single_order";
    public $timestamps = false;
}
