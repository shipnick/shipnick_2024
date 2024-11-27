<?php

namespace App\Http\Controllers\V1;

use App\Models\Consignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsignmentController extends V1BaseController
{
    public function getTrackConsignments()
    {
        try {
            return view('V1.track-consignments')->with([
                'consignments' => []
            ]);
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }
    public function postTrackConsignments(){
        try {
            $data = request()->all();
            $awb_nos = explode("\r\n", trim($data['awb_nos']));
            $consignments = Consignment::whereIn('AWB', $awb_nos)->with(['statusUpdates'])->get();
            // dd($consignments->toArray());
            // return redirect()->back()->with([
            //     'consignments' => $consignments
            // ]);
            return view('V1.track-consignments')->with([
                'awb_nos' => $awb_nos,
                'consignments' => $consignments
            ]);

            dump($consignments);
            dump($awb_nos);
            dd($data);
        } catch (\Exception $e) {
            $msg = __METHOD__ . '|Line: ' . $e->getLine() . '|Message: ' . $e->getMessage();
            Log::error($msg);
            return $this->errorJSON($msg, [
                $e->getTraceAsString()
            ]);
        }
    }

    public function getUploadConsignments()
    {
    }
    public function postUploadConsignments()
    {
        $data = request()->all();
        dd($data);
    }
}
