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
        Schema::create('super_admin', function (Blueprint $table) {
            $table->string('usertype', 100)->nullable();
            $table->integer('spid', true);
            $table->string('username', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->string('name', 100)->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->string('profilepic', 250)->nullable();
            $table->string('companyname', 150)->nullable();
            $table->string('brandame', 150)->nullable();
            $table->string('remmitanceday', 150)->nullable();
            $table->string('maxcodvalue', 50)->nullable();
            $table->string('maxliablilitshipment', 50)->nullable();
            $table->string('actype', 50)->nullable();
            $table->string('freighttype', 50)->nullable();
            $table->string('address1', 150)->nullable();
            $table->string('address2', 150)->nullable();
            $table->bigInteger('pincode')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('gstno', 25)->nullable();
            $table->string('panno', 50)->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('report_show')->nullable()->default(0);
            $table->integer('report_mis_show')->nullable()->default(0);
            $table->integer('report_pod_show')->nullable()->default(0);
            $table->integer('report_rpod_show')->nullable()->default(0);
            $table->integer('report_daily_show')->nullable()->default(0);
            $table->integer('billing_show')->nullable()->default(0);
            $table->integer('billing_all_show')->nullable()->default(0);
            $table->integer('billing_download_show')->nullable()->default(0);
            $table->integer('wallet_show')->nullable()->default(0);
            $table->integer('wallet_add_show')->nullable()->default(0);
            $table->integer('wallet_details_show')->nullable()->default(0);
            $table->integer('pincode_show')->nullable()->default(0);
            $table->integer('ndr_show')->nullable()->default(0);
            $table->integer('print_ship_labels')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('super_admin');
    }
};
