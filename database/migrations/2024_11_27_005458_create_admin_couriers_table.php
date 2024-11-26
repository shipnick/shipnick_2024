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
        Schema::create('admin_couriers', function (Blueprint $table) {
            $table->bigInteger('courierid', true);
            $table->string('name', 150);
            $table->string('courier_added', 100);
            $table->string('cou_code', 5);
            $table->string('email', 150)->nullable();
            $table->string('logo', 150)->nullable();
            $table->string('bereartoken', 250)->nullable()->default('0');
            $table->dateTime('date')->useCurrent();
            $table->string('fbupto', 50)->nullable();
            $table->float('fbwithcity', 10, 0)->nullable();
            $table->float('fbwithstate', 10, 0)->nullable();
            $table->float('fbwithzone', 10, 0)->nullable();
            $table->float('fbmtetrotometro', 10, 0)->nullable();
            $table->float('fbrestofindia', 10, 0)->nullable();
            $table->float('fbextralocation', 10, 0)->nullable();
            $table->float('fbspecaildestination', 10, 0)->nullable();
            $table->float('fbcodcharge', 10, 0)->nullable();
            $table->float('fbcodchargepersent', 10, 0)->nullable();
            $table->string('faupto', 50)->nullable();
            $table->float('fawithcity', 10, 0)->nullable();
            $table->float('fawithstate', 10, 0)->nullable();
            $table->float('fawihtzone', 10, 0)->nullable();
            $table->float('fametrotometro', 10, 0)->nullable();
            $table->float('faresttoindia', 10, 0)->nullable();
            $table->float('faextralocation', 10, 0)->nullable();
            $table->float('faspecialdestination', 10, 0)->nullable();
            $table->float('facodcharge', 10, 0)->nullable();
            $table->float('facodchargepersent', 10, 0)->nullable();
            $table->string('rbupto', 50)->nullable();
            $table->float('rpwihtcity', 10, 0)->nullable();
            $table->float('rbwithstate', 10, 0)->nullable();
            $table->float('rbwithzone', 10, 0)->nullable();
            $table->float('rbmetrotometro', 10, 0)->nullable();
            $table->float('rbresttoindia', 10, 0)->nullable();
            $table->float('rbextralocation', 10, 0)->nullable();
            $table->float('rbspeciladestination', 10, 0)->nullable();
            $table->float('rbcodcharge', 10, 0)->nullable();
            $table->float('rbcodchargepersent', 10, 0)->nullable();
            $table->string('raupto', 50)->nullable();
            $table->float('rawithcity', 10, 0)->nullable();
            $table->float('rawithstate', 10, 0)->nullable();
            $table->float('rawithzone', 10, 0)->nullable();
            $table->float('rametrotometro', 10, 0)->nullable();
            $table->float('raresttoindia', 10, 0)->nullable();
            $table->float('raextralocation', 10, 0)->nullable();
            $table->float('raspecialdestination', 10, 0)->nullable();
            $table->float('racodcharge', 10, 0)->nullable();
            $table->float('racodchargepersent', 10, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_couriers');
    }
};
