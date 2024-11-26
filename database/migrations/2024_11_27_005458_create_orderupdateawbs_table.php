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
        Schema::create('orderupdateawbs', function (Blueprint $table) {
            $table->bigInteger('autoupdateid', true);
            $table->string('awbno', 50)->default('0');
            $table->string('courier_ship_no', 20)->nullable();
            $table->string('courier_company', 20)->nullable();
            $table->integer('hitornot')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderupdateawbs');
    }
};
