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
        Schema::create('courier_list', function (Blueprint $table) {
            $table->integer('cl_pid', true);
            $table->string('name', 20);
            $table->string('courier_code', 10);
            $table->string('cl_name', 50);
            $table->string('courier_by', 20);
            $table->string('cl_id', 20);
            $table->integer('active_flg');
            $table->string('display_courier_by', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier_list');
    }
};
