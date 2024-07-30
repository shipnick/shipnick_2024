<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class couriers extends Model
{
    use HasFactory;
    public $table = "admin_couriers";
    public $timestamps = false;
}
