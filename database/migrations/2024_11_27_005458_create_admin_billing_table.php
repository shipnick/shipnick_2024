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
        Schema::create('admin_billing', function (Blueprint $table) {
            $table->bigInteger('adbid', true);
            $table->bigInteger('adminid')->nullable();
            $table->string('billaddress', 150)->nullable();
            $table->string('billcity', 50)->nullable();
            $table->string('billstate', 50)->nullable();
            $table->bigInteger('billpincode')->nullable();
            $table->dateTime('billcreate')->useCurrent();
            $table->dateTime('billupdate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_billing');
    }
};
