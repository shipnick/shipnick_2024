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
        Schema::create('mis_report', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('order_id', 150)->nullable();
            $table->string('awb_number')->nullable();
            $table->string('current_status')->nullable();
            $table->string('last_scanned_at')->nullable();
            $table->string('last_location')->nullable();
            $table->string('last_scan_remark')->nullable();
            $table->string('delivery_attempts')->nullable();
            $table->string('first_attempt_on')->nullable();
            $table->string('second_attempt_on')->nullable();
            $table->string('third_attempt_on')->nullable();
            $table->string('last_attempt_date')->nullable();
            $table->string('turn_around_time')->nullable();
            $table->string('forward_charges')->default('0');
            $table->string('rto_charges')->default('0');
            $table->string('cod_charges')->default('0');
            $table->string('fov_charges')->default('0');
            $table->string('fsc_charges')->default('0');
            $table->string('reverse_charges')->default('0');
            $table->string('surcharge 2')->default('0');
            $table->string('surcharge 3')->default('0');
            $table->string('ndr_charges')->default('0');
            $table->string('awb_Charges')->default('0');
            $table->string('charges_total')->default('0');
            $table->string('GST Charges')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mis_report');
    }
};
