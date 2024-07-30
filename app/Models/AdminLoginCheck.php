<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLoginCheck extends Model
{
    use HasFactory;
    public $table = "admin";
    public $timestamps = false;
}
