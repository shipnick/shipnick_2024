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
        Schema::create('admin_financial', function (Blueprint $table) {
            $table->bigInteger('afid', true);
            $table->bigInteger('adminid')->nullable();
            $table->string('bankbenificiaryname', 150)->nullable();
            $table->string('bankname', 150)->nullable();
            $table->string('bankacno', 50)->nullable();
            $table->string('bankifsc', 50)->nullable();
            $table->string('bankbranch', 150)->nullable();
            $table->string('bankactype', 50)->nullable();
            $table->dateTime('createdate')->useCurrent();
            $table->dateTime('updatedate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_financial');
    }
};
