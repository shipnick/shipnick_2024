<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Models\bulkorders;
use App\Models\price;
use App\Models\orderdetail;
use Exception;

class OrderStatusUpdate_Bluedart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->onQueue('o_status_Bluedart');
        $this->order = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //
        $awbNumber = $this->order['Awb_Number'];

        $response = Http::withHeaders([
			'Authorization' => 'ikDrMmbuAgPw5vilOJDOA1J7TPznOewZ',
			'Custom-Header' => 'sDkumz6IyTi59DUL',
		])
			->withCookies([
				'BIGipServerpl_api-bluedart.dhl.com_443' => '!+qROtIlTwL4EzNXfR3BsqrvQUUbjCMFJTRccm/49Tv2syimWTKt7aQLtY4DBhAjrrmMbwgDF5BrV4Ik=',
				'JSESSIONID' => 'a_MuDi_XbaOhGgrKtNs2oB6Sf9SAsusJZGdQ2NKa.mykullspc000960',
				'TS01f29a10' => '01914b743d3990cd4b301434ff43c9587d6314c7afbc1e9c7e9dc04a989238f74fffa7ab81a287f127a1ee8795372edb17a5fccb25',
			], 'bluedart.com')  // Assuming the domain for cookies is 'bluedart.com'
			->get('https://apigateway.bluedart.com/in/transportation/token/v1/login');

		// echo $response->body();

		$jsonContent = json_decode($response, true);


		echo $token = $jsonContent['JWTToken'];

        // BlueDart API endpoint
		$url = 'https://apigateway.bluedart.com/in/transportation/tracking/v1/shipment';

		// Query parameters
		$params = [
			'handler' => 'tnt',
			'loginid' => 'HNS49193',
			'numbers' => $awbNumber,
			'format' => 'JSON', // expecting XML format response
			'lickey' => 'rslmg4ljt5emrmeosirjtmjkoehfhpuo',
			'scan' => 1,
			'action' => 'custawbquery',
			'verno' => 1,
			'awb' => 'awb',
		];

		// Request headers
		$headers = [
			'JWTToken' => $token,
			'Cookie' => 'BIGipServerpl_api-bluedart.dhl.com_443=!+qROtIlTwL4EzNXfR3BsqrvQUUbjCMFJTRccm/49Tv2syimWTKt7aQLtY4DBhAjrrmMbwgDF5BrV4Ik=; JSESSIONID=a_MuDi_XbaOhGgrKtNs2oB6Sf9SAsusJZGdQ2NKa.mykullspc000960; TS01f29a10=01914b743d3990cd4b301434ff43c9587d6314c7afbc1e9c7e9dc04a989238f74fffa7ab81a287f127a1ee8795372edb17a5fccb25'
		];

		// Sending GET request using Laravel's HTTP Client
		$response = Http::withHeaders($headers)->get($url, $params);
		$jsonContent = json_decode($response, true);
        if ($jsonContent['ShipmentData']['Shipment'][0]['Status']) {

			$jsonContent = json_decode($response, true);

			echo $status = $jsonContent['ShipmentData']['Shipment'][0]['Status'];
			
			

			bulkorders::where('Awb_Number', $awbNumber)->update([
				'showerrors' => $status,
				'order_status_show' => $status
			]);

			foreach ($jsonContent['ShipmentData']['Shipment'][0]['Scans'] as $scan) {


				$date = $scan['ScanDetail']['ScanTime'];
				$time = $scan['ScanDetail']['ScanTime'];
				$scan_datetime = $date . $time;
				$scan_value = $scan['ScanDetail']['Scan'];
				$scan_location = $scan['ScanDetail']['ScannedLocation'];
				$status_code = $scan['ScanDetail']['ScanCode'];
				$courier = 'Bluedart';


				$existingScan = DB::table('trak_orders_details')
					->where('scan_datetime', $scan_datetime)
					->where('courier', $courier)
					->exists();

				// If it exists, skip the insert
				if (!$existingScan) {
					// Insert new record if not exists
					DB::table('trak_orders_details')->insert([
						'scan_datetime' => $scan_datetime,
						'scan' => $scan_value,
						'scan_location' => $scan_location,
						'status_code' => $status_code,
						'awb' => $awbNumber,
						// 'order_id' => $order_id,
						'courier' => $courier,

					]);
				}
			}

		} else {
			// Handle failure response (if the request was not successful)
			return response()->json(['error' => 'Failed to retrieve shipment data'], 500);
		}

    }
}
