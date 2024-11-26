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
        Schema::create('orderdetail_user', function (Blueprint $table) {
            $table->integer('useru_id', true);
            $table->string('orderno', 100)->nullable();
            $table->string('cname', 250)->nullable();
            $table->string('caddress', 500)->nullable();
            $table->string('cstate', 250)->nullable();
            $table->string('ccity', 250)->nullable();
            $table->bigInteger('cmobile')->nullable();
            $table->bigInteger('cpin')->nullable();
            $table->float('pweight', 10, 0)->nullable();
            $table->float('ptamt', 10, 0)->nullable();
            $table->string('itemname', 500)->nullable();
            $table->integer('itemquantity')->nullable();
            $table->string('itmecodamt', 200)->nullable();
            $table->string('iteminvoicevalue', 200)->nullable();
            $table->string('additionaldetails', 200)->nullable();
            $table->date('orderdate')->nullable();
            $table->time('orderdtime')->nullable();
            $table->dateTime('orderdatetime')->nullable();
            $table->string('order_status', 250)->nullable();
            $table->integer('order_userid')->nullable();
            $table->integer('order_riderid')->nullable();
            $table->string('order_ridername', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetail_user');
    }
};
