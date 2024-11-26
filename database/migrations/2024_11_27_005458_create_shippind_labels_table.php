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
        Schema::create('shippind_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('label_type')->nullable();
            $table->string('Consignee_Number')->nullable();
            $table->text('rtoAddress')->nullable();
            $table->string('order_id')->nullable();
            $table->string('Products_Details')->nullable();
            $table->string('Return_Address')->nullable();
            $table->string('Weight')->nullable();
            $table->string('Dimensions')->nullable();
            $table->string('Support_Mobile')->nullable();
            $table->string('Support_email')->nullable();
            $table->string('display_name')->nullable();
            $table->string('supportnumber')->nullable();
            $table->string('supportemail')->nullable();
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
        Schema::dropIfExists('shippind_labels');
    }
};
