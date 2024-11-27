<?php

use App\Models\Consignment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignmentStatusUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignment_status_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Consignment::class, 'consignment_id');
            $table->enum('status', [
                'PICKUP_SCHEDULED',
                'PICKED_UP',
                'IN_TRANSIT',
                'SEND_TO_HUB',
                'RECEIVED_AT_HUB',
                'OUT_FOR_DELIVERY',
                'DELIVERED'
            ]);
            $table->text('notes')->nullable()->default(null);
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
        Schema::dropIfExists('consignment_status_updates');
    }
}
