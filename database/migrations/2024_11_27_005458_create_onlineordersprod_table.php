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
        Schema::create('onlineordersprod', function (Blueprint $table) {
            $table->integer('orederprod_id', true);
            $table->string('orederprod_master', 250)->nullable();
            $table->string('orederprod_name', 250)->nullable();
            $table->float('orederprod_cost', 10, 0)->nullable();
            $table->integer('orederprod_qlty')->nullable();
            $table->float('orederprod_total', 10, 0)->nullable();
            $table->string('orederprod_status', 100)->nullable();
            $table->string('order_no', 100)->nullable();
            $table->integer('customer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onlineordersprod');
    }
};
