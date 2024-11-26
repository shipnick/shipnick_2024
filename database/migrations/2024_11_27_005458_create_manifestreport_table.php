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
        Schema::create('manifestreport', function (Blueprint $table) {
            $table->bigInteger('manifest_id', true);
            $table->string('hub_name', 250)->nullable();
            $table->bigInteger('hub_id')->nullable();
            $table->string('customer_name', 250)->nullable();
            $table->string('courier_name', 250)->nullable();
            $table->string('dispatch_name', 250)->nullable();
            $table->string('total_shipment', 250)->nullable();
            $table->string('manifest_type', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('awb_no', 250)->nullable();
            $table->string('order_id', 250)->nullable();
            $table->string('tracking_id', 250)->nullable();
            $table->string('cname', 250)->nullable();
            $table->integer('client_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manifestreport');
    }
};
