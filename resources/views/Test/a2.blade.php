<?php

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://manage.bigship.in/api/create_orders.php',
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