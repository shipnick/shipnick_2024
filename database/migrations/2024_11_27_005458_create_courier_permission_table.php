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
        Schema::create('courier_permission', function (Blueprint $table) {
            $table->integer('cp_id', true);
            $table->string('courier_idno', 100);
            $table->string('courier_code', 5);
            $table->string('courier_by', 25);
            $table->integer('courier_priority')->nullable()->default(0);
            $table->integer('user_id');
            $table->integer('admin_flg');
            $table->integer('user_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier_permission');
    }
};
