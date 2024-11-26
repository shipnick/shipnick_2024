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
        Schema::create('onlinecourierapis', function (Blueprint $table) {
            $table->integer('courier_id', true);
            $table->string('courier_name', 250)->nullable();
            $table->string('courier_name_show', 100)->nullable();
            $table->integer('courier_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onlinecourierapis');
    }
};
