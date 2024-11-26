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
        Schema::create('spark_single_order_file', function (Blueprint $table) {
            $table->integer('sparkorderid', true);
            $table->string('foldername', 250)->nullable();
            $table->string('filename', 250)->nullable();
            $table->date('uploaddate')->nullable();
            $table->time('uploadtime')->nullable();
            $table->dateTime('uploaddatetime')->nullable();
            $table->string('uploadby', 250)->nullable();
            $table->string('uploadid', 250)->nullable();
            $table->string('uploadusercate', 250)->nullable();
            $table->string('totalnooforders', 250)->nullable();
            $table->integer('apihitornot')->nullable()->default(1);
            $table->integer('startingpoint')->nullable();
            $table->integer('endingpoint')->nullable();
            $table->integer('nextstartpoint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spark_single_order_file');
    }
};
