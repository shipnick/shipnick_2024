<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignments', function (Blueprint $table) {
            $table->id();
            $table->string('AWB', 250);
            $table->unique('AWB');
            
            $table->string('Order_ID',250)->nullable()->default(null);
            $table->string('Customer_Name',250)->nullable()->default(null);
            $table->string('Address',250)->nullable()->default(null);
            $table->string('Address2',250)->nullable()->default(null);
            $table->string('Customer_City',250)->nullable()->default(null);
            $table->string('Customer_State',250)->nullable()->default(null);
            $table->string('Pincode',250)->nullable()->default(null);
            $table->string('Mobile',250)->nullable()->default(null);
            $table->string('Phone_Mobile_2',250)->nullable()->default(null);
            $table->string('Consignee_Email',250)->nullable()->default(null);
            $table->string('Product_Name',250)->nullable()->default(null);
            $table->string('Product_Quantity',250)->nullable()->default(null);
            $table->string('Product_Value',250)->nullable()->default(null);
            $table->string('SKU',250)->nullable()->default(null);
            $table->string('Order_Type',250)->nullable()->default(null);
            $table->string('COD_AMOUNT',250)->nullable()->default(null);
            $table->string('Weight_KG',250)->nullable()->default(null);
            $table->string('Length',250)->nullable()->default(null);
            $table->string('Width',250)->nullable()->default(null);
            $table->string('Height',250)->nullable()->default(null);
            $table->string('Invoice_Value',250)->nullable()->default(null);
            $table->string('Total_Amount',250)->nullable()->default(null);
            $table->string('Hub_Code',250)->nullable()->default(null);

            $table->string('status', 250)->nullable()->default(null);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consignments');
    }
}
