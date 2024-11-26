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
        Schema::create('hub_address', function (Blueprint $table) {
            $table->integer('hub_id', true);
            $table->bigInteger('hub_created_by')->nullable();
            $table->integer('intargos_added')->default(2);
            $table->integer('intargos_updated')->default(1);
            $table->string('hub_alternate_id', 250)->nullable();
            $table->string('hub_code', 20)->nullable();
            $table->string('nimbus_hubid', 20)->nullable();
            $table->string('intargos_hubid', 20)->nullable();
            $table->string('hub_title', 50)->default('');
            $table->string('hub_name', 250)->nullable();
            $table->string('hub_gstno', 250)->nullable();
            $table->string('hub_address1', 250)->nullable();
            $table->string('hub_address2', 250)->nullable();
            $table->string('hub_mobile', 20)->nullable();
            $table->string('hub_pincode', 20)->nullable();
            $table->string('hub_state', 250)->nullable();
            $table->string('hub_city', 250)->nullable();
            $table->string('hub_deliverytype', 250)->nullable();
            $table->string('hub_folder', 250)->nullable();
            $table->string('hub_img', 250)->nullable();
            $table->string('smartship_hubid', 150)->nullable();
            $table->string('Shiprocket_hub_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hub_address');
    }
};
