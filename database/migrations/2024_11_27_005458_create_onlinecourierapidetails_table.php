<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlinecourierapidetails', function (Blueprint $table) {
            $table->integer('apidetailsid', true);
            $table->string('courier_id', 250)->nullable();
            $table->string('courier_name', 100)->nullable();
            $table->string('item_orderno', 250)->nullable();
            $table->string('success', 250)->nullable();
            $table->string('order_id', 250)->nullable();
            $table->string('order_pk', 250)->nullable();
            $table->string('awb_tracking_id', 250)->nullable();
            $table->string('manifest_link', 250)->nullable();
            $table->string('routing_code', 250)->nullable();
            $table->string('client_order_id', 250)->nullable();
            $table->string('courier_by', 250)->nullable();
            $table->string('dispatch_mode', 250)->nullable();
            $table->string('child_waybill_list', 250)->nullable();
            $table->string('ip_string', 250)->nullable();
            $table->string('manifest_link_pdf', 250)->nullable();
            $table->string('manifest_img_link', 250)->nullable();
            $table->string('received_by', 250)->nullable();
            $table->string('current_status_type', 250)->nullable();
            $table->string('current_status_body', 250)->nullable();
            $table->string('current_status_location', 250)->nullable();
            $table->string('current_status_time', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onlinecourierapidetails');
    }
};
