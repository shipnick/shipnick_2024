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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->integer('orderid', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('awb_no', 100)->nullable();
            $table->string('transaction', 250)->nullable();
            $table->integer('debit')->nullable();
            $table->string('credit', 220)->nullable();
            $table->string('close_blance', 250)->nullable();
            $table->string('applied_wet', 250)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('date', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
};
