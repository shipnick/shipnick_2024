<?php

namespace App\Console\Commands;

use App\Models\Consignment;
use App\Models\ConsignmentStatusUpdate;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ConsignmentStatusUpdate_CMD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spnk:consignment-status-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates shipnick consignment status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment($this->description);

        $consignments = Consignment::where('status', '<>', ConsignmentStatusUpdate::STATUS_DELIVERED)
            ->with(['statusUpdates'])
            ->whereHas('statusUpdates')
            ->get();

        // dd($now->diffInHours($consignments[0]->created_at));
        // dd($consignments[0]->status);

        foreach ($consignments as $consignment) {
            $now = Carbon::now();
            $createAt = Carbon::parse($consignment->created_at);
            $notes = '--';
            $this->info($consignment->id . ' | Time: ' . $now);
            // After 3 pm it should show: “Parcel Picked up”
            if ($now->hour >= rand(4, 10) && $consignment->status == ConsignmentStatusUpdate::STATUS_PICKUP_SCHEDULED) {
                $consignment->updateStatus(ConsignmentStatusUpdate::STATUS_PICKED_UP, $notes);
            }

            // After 6 from then it should show: “In-Transit”
            if ($now->gt($createAt->addHours(rand(10, 20))) && $consignment->status == ConsignmentStatusUpdate::STATUS_PICKED_UP) {
                $consignment->updateStatus(ConsignmentStatusUpdate::STATUS_IN_TRANSIT, $notes);
            }

            if ($now->gt($createAt->addHours(rand(20, 38))) && $consignment->status == ConsignmentStatusUpdate::STATUS_IN_TRANSIT) {
                $consignment->updateStatus(ConsignmentStatusUpdate::STATUS_SEND_TO_HUB, $notes);
            }

            if ($now->gt($createAt->addHours(rand(38, 40))) && $consignment->status == ConsignmentStatusUpdate::STATUS_SEND_TO_HUB) {
                $consignment->updateStatus(ConsignmentStatusUpdate::STATUS_RECEIVED_AT_HUB, $notes);
            }

            // After 6 hours show: “Out for delivery”
            if ($now->gt($createAt->addHours(rand(40, 96))) && $consignment->status == ConsignmentStatusUpdate::STATUS_RECEIVED_AT_HUB) {
                $consignment->updateStatus(ConsignmentStatusUpdate::STATUS_OUT_FOR_DELIVERY, $notes);
            }

            // After 6 hours or at 8 PM show: “Delivered”
            if ($now->gt($createAt->addHours(rand(96,120))) && $consignment->status == ConsignmentStatusUpdate::STATUS_OUT_FOR_DELIVERY) {
                $consignment->updateStatus(ConsignmentStatusUpdate::STATUS_DELIVERED, $notes);
            }

        }
        // $consignments->updateStatus(ConsignmentStatusUpdate::STATUS_PICKED_UP , $notes);
        return 0;
    }
}
