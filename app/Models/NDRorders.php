<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NDRorders extends Model
{
    use HasFactory;
    public $table = "spark_ndr_report";
    public $timestamps = false;
}
