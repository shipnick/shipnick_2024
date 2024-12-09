<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhookLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string("awb_number", 250)->nullable()->default(null);
            $table->string("status", 250)->nullable()->default(null);
            $table->string("event_time", 250)->nullable()->default(null);
            $table->longText("request_data")->nullable()->default('--');
            $table->longText("response_data")->nullable()->default('--');
            $table->longText("error_log")->nullable()->default('--');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webhook_logs');
    }
}
