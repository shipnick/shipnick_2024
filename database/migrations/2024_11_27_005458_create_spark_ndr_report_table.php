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
        Schema::create('spark_ndr_report', function (Blueprint $table) {
            $table->bigInteger('mis_id', true);
            $table->integer('user_id')->nullable();
            $table->string('client_name', 250)->nullable();
            $table->string('awbno', 250)->nullable();
            $table->string('orderno', 250)->nullable();
            $table->date('pickupdate')->nullable();
            $table->time('pickuptime')->nullable();
            $table->string('orderstatus', 250)->nullable();
            $table->string('courierremark', 250)->nullable();
            $table->date('laststatusdate')->nullable();
            $table->time('laststatustime')->nullable();
            $table->date('deliverydate')->nullable();
            $table->date('firstscandate')->nullable();
            $table->time('firstscantime')->nullable();
            $table->date('firstattemptdate')->nullable();
            $table->date('edd')->nullable();
            $table->string('origincity', 250)->nullable();
            $table->string('originpincode', 250)->nullable();
            $table->string('destinationcity', 250)->nullable();
            $table->string('destinationpincode', 250)->nullable();
            $table->string('customername', 250)->nullable();
            $table->string('customercontact', 250)->nullable();
            $table->string('clientname', 250)->nullable();
            $table->string('paymentmode', 250)->nullable();
            $table->string('codamt', 250)->nullable();
            $table->string('orderageing', 250)->nullable();
            $table->string('attemptcount', 250)->nullable();
            $table->string('couriername', 250)->nullable();
            $table->date('rtodate')->nullable();
            $table->string('rtoreason', 250)->nullable();
            $table->string('zonename', 250)->nullable();
            $table->date('lastofddate')->nullable();
            $table->string('ndrinstructions', 250)->nullable();
            $table->dateTime('uploadtimestamp')->nullable()->useCurrent();
            $table->date('uploaddate')->nullable();
            $table->time('uploadtime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spark_ndr_report');
    }
};
