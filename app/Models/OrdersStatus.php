<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersStatus extends Model
{
    use HasFactory;
    public $table = "onlinecourierapis";
    public $timestamps = false;
}
