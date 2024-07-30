<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdminLoginCheck extends Model
{
    use HasFactory;
    public $table = "super_admin";
    public $timestamps = false;
}
