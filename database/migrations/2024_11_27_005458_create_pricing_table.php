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
        Schema::create('pricing', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('courier_name')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('weight')->nullable();
            $table->string('fwda')->nullable();
            $table->string('fwdb')->nullable();
            $table->string('fwdc')->nullable();
            $table->string('fwdd')->nullable();
            $table->string('fwde')->nullable();
            $table->string('fwdf')->nullable();
            $table->string('fwdg')->nullable();
            $table->string('fwdh')->nullable();
            $table->string('rtoa')->nullable();
            $table->string('rtob')->nullable();
            $table->string('rtoc')->nullable();
            $table->string('rtod')->nullable();
            $table->string('rtoe')->nullable();
            $table->string('rtof')->nullable();
            $table->string('wta')->nullable();
            $table->string('wtb')->nullable();
            $table->string('wtc')->nullable();
            $table->string('wtd')->nullable();
            $table->string('wte')->nullable();
            $table->string('wtf')->nullable();
            $table->string('status')->nullable();
            $table->string('user_id', 25)->nullable();
            $table->string('admin_id', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricing');
    }
};
