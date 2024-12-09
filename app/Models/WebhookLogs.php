<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @property integer $id
 * @property mixed $awb_number
 * @property mixed $status
 * @property mixed $event_time
 * @property mixed $request_data
 * @property mixed $response_data
 * @property mixed $error_log
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class WebhookLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "awb_number",
        "status",
        "event_time",
        "request_data",
        "response_data",
        "error_log",
        "created_at",
        "updated_at",
    ];

}
