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
        Schema::create('pickrr_status_code', function (Blueprint $table) {
            $table->integer('pickrr_status_id', true);
            $table->string('short_form', 250)->nullable();
            $table->string('full_form', 250)->nullable();
            $table->string('courier_name', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickrr_status_code');
    }
};
