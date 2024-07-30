<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MIS_Report extends Model
{
    use HasFactory;
    public $table = "mis_report";
    public $timestamps = false;

    public function awb()
    {
        return $this->belongsTo(bulkorders::class,'awb_number','Awb_Number');
    }


}
