<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APITest extends Controller
{
    public function test()
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
'Content-Type : application/json',
'Authorization : Bearer xyz'
),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;





// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "http://bunnys-centrepoint.com");
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_POSTFIELDS, '{
// "username":"admin@shipxpress.com",
// "password":"$#Ship@202@",
// "secretkey":"edb29bc63ad48e8c2ff7d318feb25ce38b1d5e5f0d531a168510cbb9bf77f8cf"
// }');
// curl_setopt($ch, CURLOPT_HTTPHEADER, "{
// 'Content-Type: application/json',
// 'Authorization: Bearer xyz'
// }");
// $response = curl_exec($ch);
// curl_close($ch);
// echo $response;















// $url    = 'http://stageusermanagementapi.xbees.in/api/auth/generateToken';
// $agent  = "";
// $cookie = "";
// $Submit[] = 'Authorization: Key ';
// $Submit[] = 'Content-type: application/json'; 

//     $Curl = curl_init();
// curl_setopt($Curl, CURLOPT_URL, $url);
// curl_setopt($Curl, CURLOPT_HTTPHEADER, 0);
// curl_setopt($Curl, CURLOPT_USERAGENT, $agent);
// //curl_setopt($Curl, CURLOPT_SSLVERSION, 3); // SSL 버젼 (https 접속시에 필요)
// curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, true); // 인증서 체크
// curl_setopt($Curl, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($Curl, CURLOPT_COOKIEFILE, $cookie);
// curl_setopt($Curl, CURLOPT_POST, 1);
// curl_setopt($Curl, CURLOPT_POSTFIELDS, $Submit);
// curl_setopt($Curl, CURLOPT_RETURNTRANSFER, 1);
//     $result = curl_exec($Curl);
//     curl_close($Curl);

// echo $result;






// $curl = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => 'http://stageusermanagementapi.xbees.in/api/auth/generateToken',
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_ENCODING => '',
// CURLOPT_MAXREDIRS => 10,
// CURLOPT_TIMEOUT => 0,
// CURLOPT_FOLLOWLOCATION => true,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => 'POST',
// CURLOPT_POSTFIELDS =>'{
// "warehouse_id" : "",
// "volumetric_weight" : ""
// }',
// CURLOPT_HTTPHEADER => array(
// 'token: EAAVqbTIVAYABAJr5WEon5ZB4aOdRhD84Ayibw0r1lhe2Ki07AMeTsRqlzSFCkJ6yvX4ctNUGKg2ulJfplUgHzRw0LoU7WVGzO4nEoJ8k2rCmy0TAAIiYpQQbwHIO4IbcUPwKGh6nGWp7hsZBxas2IuttSUohXX2BPoj3ICQNepTPrHuelxSWfl4fmQ3WYZD',
// 'Content-Type: application/json'
// ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;


  //   	$curl = curl_init();

		// curl_setopt_array($curl, array(
		// CURLOPT_URL => 'https://manage.bigship.in/api/create_orders.php',
		// CURLOPT_RETURNTRANSFER => true,
		// CURLOPT_ENCODING => '',
		// CURLOPT_MAXREDIRS => 10,
		// CURLOPT_TIMEOUT => 0,
		// CURLOPT_FOLLOWLOCATION => true,
		// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// CURLOPT_CUSTOMREQUEST => 'POST',
		// CURLOPT_POSTFIELDS =>'{
		// "warehouse_id" : "",
		// "volumetric_weight" : ""
		// }',
		// CURLOPT_HTTPHEADER => array(
		// 'token: EAAVqbTIVAYABAJr5WEon5ZB4aOdRhD84Ayibw0r1lhe2Ki07AMeTsRqlzSFCkJ6yvX4ctNUGKg2ulJfplUgHzRw0LoU7WVGzO4nEoJ8k2rCmy0TAAIiYpQQbwHIO4IbcUPwKGh6nGWp7hsZBxas2IuttSUohXX2BPoj3ICQNepTPrHuelxSWfl4fmQ3WYZD',
		// 'Content-Type: application/json'
		// ),
		// ));

		// $response = curl_exec($curl);

		// curl_close($curl);
		// echo $response;
    }
}
