<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class financial extends Model
{
    use HasFactory;
    public $table = "admin_financial";
    public $timestamps = false;
}
