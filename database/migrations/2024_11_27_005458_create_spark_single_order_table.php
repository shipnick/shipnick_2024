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
        Schema::create('spark_single_order', function (Blueprint $table) {
            $table->bigInteger('Single_Order_Id', true);
            $table->string('Order_Type', 200)->nullable()->index('Order_Type');
            $table->integer('User_Id')->nullable()->index('User_Id');
            $table->string('orderno', 250)->nullable();
            $table->string('ordernoapi', 250)->nullable();
            $table->string('courier_ship_no', 20)->default('');
            $table->string('Awb_Number', 300)->default('')->index('Awb_Number');
            $table->string('awb_gen_by', 150)->nullable();
            $table->string('awb_gen_courier', 20)->default('');
            $table->string('Name', 300)->nullable();
            $table->text('Address')->nullable();
            $table->string('State', 300)->nullable();
            $table->string('City', 300)->nullable();
            $table->string('Mobile', 100)->nullable();
            $table->string('mobile_no2', 20)->nullable();
            $table->string('order_email', 250)->nullable();
            $table->string('Pincode', 20)->nullable();
            $table->string('Item_Name', 300)->nullable();
            $table->text('sku')->nullable();
            $table->integer('Quantity')->nullable();
            $table->string('Width', 100)->nullable();
            $table->string('Height', 100)->nullable();
            $table->string('Length', 100)->nullable();
            $table->float('Actual_Weight', 10, 0)->nullable();
            $table->float('volumetric_weight', 10, 0)->nullable();
            $table->string('courier_actual_weight', 100)->nullable();
            $table->float('Total_Amount', 10, 0)->nullable();
            $table->float('Invoice_Value', 10, 0)->nullable();
            $table->float('Cod_Amount', 10, 0)->nullable();
            $table->string('zonename', 10)->default('');
            $table->string('Clinet_Order_Id', 200)->nullable();
            $table->string('additionaltype', 250)->nullable();
            $table->dateTime('Rec_Time_Stamp')->nullable()->useCurrent();
            $table->date('Rec_Time_Date')->nullable()->index('Rec_Time_Date');
            $table->dateTime('Last_Time_Stamp')->nullable()->useCurrent();
            $table->date('Last_Stamp_Date')->nullable();
            $table->date('pickupdate')->nullable();
            $table->dateTime('pickupdatetime')->nullable();
            $table->date('delivereddate')->nullable();
            $table->dateTime('delivereddatetime')->nullable();
            $table->date('rtodate')->nullable();
            $table->dateTime('rtodatetime')->nullable();
            $table->date('canceldate')->nullable();
            $table->dateTime('canceldatetime')->nullable();
            $table->string('uploadtype', 100)->nullable();
            $table->tinyInteger('Active')->default(1);
            $table->string('order_status', 250)->nullable();
            $table->string('order_status1', 250)->nullable();
            $table->string('order_status_show', 250)->nullable();
            $table->string('pickup_id', 250)->nullable();
            $table->string('Address_Id', 50)->nullable();
            $table->string('pickup_name', 250)->nullable();
            $table->string('pickup_mobile', 130)->nullable();
            $table->string('pickup_pincode', 20)->nullable();
            $table->string('pickup_gstin', 100)->nullable();
            $table->string('pickup_address', 400)->nullable();
            $table->string('pickup_state', 100)->nullable();
            $table->string('pickup_city', 100)->nullable();
            $table->string('order_cancel', 11)->nullable()->default('')->index('order_cancel');
            $table->string('order_cancel_reasion', 250)->nullable();
            $table->string('xberrors', 800)->nullable();
            $table->string('dhlerrors', 800)->nullable();
            $table->string('shferrors', 800)->nullable();
            $table->string('dtdcerrors', 800)->nullable();
            $table->string('showerrors', 800)->nullable();
            $table->integer('apihitornot')->default(0);
            $table->text('Address2')->nullable();
            $table->string('zone', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spark_single_order');
    }
};
