<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class APIXpressBee extends Controller
{
	// This API Work As After Upload Order Action
	public function TokenGenerate(Request $req)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://stageusermanagementapi.xbees.in/api/auth/generateToken',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"username":"admin@shipxpress.com",
			"password":"$#Ship@202@",
			"secretkey":"edb29bc63ad48e8c2ff7d318feb25ce38b1d5e5f0d531a168510cbb9bf77f8cf"
		}',
		CURLOPT_HTTPHEADER => array(
		'Content-Type:application/json',
		'Authorization:Bearer xyz'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;

	}



    public function Check(Request $req)
    {
error_reporting(1);
// $pincodeno = 110091;
// $params = Http::get("http://stageusermanagementapi.xbees.in/api/auth/generateToken")->json();
// print_r($params);


        // $client = new Client();
// $api_response = $client->get('http://api.staging.shipmentmanifestation.xbees.in/shipmentmanifestation/forward');
// return $response = json_decode($api_response);

// $response = $client->request('POST', '/api/user', [
//     'headers' => [
//         'Accept' => 'application/json',
//     ],
//     'form_params' => [
//         'api_token' => $token,
//     ],
// ]);


// $token = "xyz";
// $response = $client->request('POST', 'http://stageusermanagementapi.xbees.in/api/auth/generateToken', [
//     'headers' => [
//         'Authorization' => 'Bearer '.$token,
//         'Content-Type' => 'application/json',
//     ],
// ]);
// return $response;


    }

    public function test()
    {
    	$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => ': http://stageusermanagementapi.xbees.in/api/auth/generateToken',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
		"user_id" : "",
		"order_id" : "",
		"delivery_name" : "",
		"delivery_contactno" : "",
		"alt_no" : "",
		"email_id" : "",
		"delivery_address1" : "",
		"delivery_city" : "",
		"delivery_state" : "",
		"delivery_pincode" : "",
		"product_name" : "",
		"price" : "",
		"qty" : "",
		"payment_mode" : "",
		"cod_amount" : "",
		"actual_weight" : "",
		"hsn_code" : "",
		"length" : "",
		"breadth" : "",
		"height" : "",
		"website_name" : "",
		"warehouse_id" : "",
		"volumetric_weight" : ""
		}',
		CURLOPT_HTTPHEADER => array(
		'token: EAAVqbTIVAYABAJr5WEon5ZB4aOdRhD84Ayibw0r1lhe2Ki07AMeTsRqlzSFCkJ6yvX4ctNUGKg2ulJfplUgHzRw0LoU7WVGzO4nEoJ8k2rCmy0TAAIiYpQQbwHIO4IbcUPwKGh6nGWp7hsZBxas2IuttSUohXX2BPoj3ICQNepTPrHuelxSWfl4fmQ3WYZD',
		'Content-Type: application/json'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
    }

}
