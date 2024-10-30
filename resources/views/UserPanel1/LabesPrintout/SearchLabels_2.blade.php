
<?php 
    error_reporting(1);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ session('UserLogin2name') }} Panel</title>
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Lora:ital,wght@1,500&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@1,500&family=Castoro:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>


	@if(empty($totalorders))
	<center>
		<h3>Order Not Found</h3>
	</center>
	@endif

	<style>
		.leftmargin {
			padding: 0px 0px 0px 10px !important;
		}
	</style>
	
	<br> <br>

	@for($i=0; $i<$totalorders; $i++) <div class="col-md-12">
<?php
 $orderq =$params[$i]['orderunq'];
 "<br>";
$shipingno =$params[$i]['shipc_no'];

?>
<?php

$token =$params[$i]['token'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.smartship.in/v2/app/Fulfillmentservice/orderDetails',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
 "filters":{
 "filter_type":{
 "and":{
 "status":{
 "status_code":"",
 "check_type":""
 },
 "request_order_id":"",
 "client_order_reference_id":"'.$orderq.'",
 "payment_type":"cod",
 "created_date":{
 "from":"",
 "to":""
 },
 "updated_date":{
 "from":"",
 "to":""
 }
 }
 }
 },
 "sort_by":{
 "fields":"request_order_id",
 "type":"desc"
 },
 "limit":{
 "offset":0,
 "limit":1
 }
}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    "Authorization: Bearer $token"
  ),
));

$response = curl_exec($curl);
$response = json_decode($response, true);
curl_close($curl);
echo "<br>";
 $hubsortcode = $response['data']['orders_details'][$shipingno]['order_details']['route_code'];

                //     echo "<br><pre>";
                //     print_r($response);
                //     echo "</pre><br>";
                //   echo     $newvalh = $response['status'];
  
//   die();                
  ?>
		@if($printoutsize == "a4size")
		<div style="float:left; width:99%;">
			@elseif($printoutsize == "a6size")
			<div style="float:left; width:435px;">
				@endif


				<table width="100%" border="1" style="border-collapse: collapse;">
				
				<tr>
					<td colspan="2" class="leftmargin">
                    Fulfilled by  {{ ucwords($params[$i]['awbcourier']) }}
                    	<?php
                    	echo "</br>" ;
                    	
								echo $hubsortcode;
								?>
							

					</td>
					<td colspan="3" class="text-center" style="padding: 2%;">
						<center>
                        <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}" title="Hub Image" style="width:100px;height:100px;">
						</center>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div class="col-md-12 text-center">
                        {{ ucwords($params[$i]['awbcourier']) }}<br>
								<?php
								$awbno = trim($params[$i]['awb']);
								echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="max-width:99%" />';
								?>
								<br>
								AWB - {{ $params[$i]['awb'] }} <br>
							<!--<br><br>-->
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="leftmargin">

						<b>Deliver To:</b><br>
						Name : <b>{{ ucwords($params[$i]['name']) }}</b><br>
							Address : <b>{{ ucwords($params[$i]['address']) }}</b><br><br>
							City : <b>{{ ucwords($params[$i]['city']) }}</b><br>
							Pincode : <b>{{ ucwords($params[$i]['pincode']) }}</b><br>
							Mobile : <b>{{ ucwords($params[$i]['mobile']) }}</b><br>
					</td>
					<td colspan="3" class="leftmargin">
						<!-- <center><b>Invoice Details</b></center> --><center>
						<b>{{ $params[$i]['paymode'] }}</b><br>
							<span style="font-size:18px">{{ ucwords($params[$i]['codamt']) }}</span></center>
						</b>
					</td>
				</tr>
				
				
				
				<tr>
					<td colspan="5" class="leftmargin">
                    <?php
								$date = date_create($params[$i]['date']);
								echo date_format($date, "d-m-Y");
								?>

					</td>
				</tr>
			</table>
			</div>
		</div>
		<div style="page-break-after:always;">&ensp;</div>
		@endfor



</body>

</html>





<script>
	function printpage() {
		window.print()
	}
	printpage();
</script>