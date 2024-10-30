<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ session('UserLogin2name') }} Panel</title>
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<meta name="author" content="Singhaniya">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Lora:ital,wght@1,500&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@1,500&family=Castoro:ital@0;1&display=swap" rel="stylesheet">

</head>
<body>

<div style="width:99%;"><br> <!-- Main Div -->
<!-- <h3> Header </h3> -->





<style>
.leftmargin{
    padding:0px 0px 0px 10px !important;
}
</style>






	<div style="float:left; width:99%;">
		<table width="100%" border="1" style="border-collapse: collapse;">
			<tr>
<td colspan="5" class="text-center">Fulfilled by {{ session('UserLogin2name') }}
@if($params->order_cancel == 1)
	( <b>Canceled</b> )
@endif
</td>
			</tr>
			<tr>
				<td colspan="2" class="leftmargin">
					<!-- Courier : <b>{{ ucwords($params->courier_name) }}</b><br> -->
					<!--AWB 	: <b>{{ $awbno }}</b><br>-->
					Pay Type 	: <b>{{ ucwords($params->Order_Type) }}</b>
				</td>
				<td colspan="3" class="text-center">
					Collect Cash <b><br>
						<span style="font-size:18px">Rs. {{ ucwords($params->Cod_Amount) }}/-</span>
					</b>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<div class="col-md-12 text-center">
{{ ucwords($params->awb_gen_by) }}<br>
<?php
    $awbno = trim($awbno);
    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128',2,33,array(1,2,3)) . '" alt="barcode" style="max-width:99%" />';
?>
 <br>
 AWB Number - {{ $awbno }}
 <!--<br><br>-->
<?php
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" style="max-width:99%" />';
 ?>
 <!--<br><br>-->
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="leftmargin">
					<center><b>Shipping Address</b></center>
					Name :  <b>{{ ucwords($params->Name) }}</b><br>
					<!-- Address : <b>{{ ucwords($params->caddress) }}</b><br>
					City : <b>{{ ucwords($params->ccity) }}</b><br>
					Pincode : <b>{{ ucwords($params->cpin) }}</b><br> -->
					<b>Address :</b> {{ ucwords($params->Address) }}, {{ ucwords($params->City) }}, {{ ucwords($params->Pincode) }}. <br><br>
					Mobile : <b>{{ ucwords($params->Mobile) }}</b><br>
				</td>
				<td colspan="3" class="leftmargin">
					<center><b>Invoice Details</b></center>
					Order No :  <b>{{ ucwords($params->orderno) }}</b><br>
					Order Date : <b>
						<?php
							$date=date_create($params->orderdata);
							echo date_format($date,"d-m-Y");
						?>
					</b><br><br>
					Seller Name :<b>{{ session('UserLogin2name') }}</b><br>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<table class="table">
						<tr>
							<th>Sr No</th>
							<th>Product Name</th>
							<!--<th>SKU</th>-->
							<th>QTY</th>
							<th>Total</th>
						</tr>
						<tr>
							<td>1</td>
							<td>{{ ucwords($params->Item_Name) }}</td>
							<!--<td></td>-->
							<td>{{ ucwords($params->Quantity) }}</td>
							<td>{{ ucwords($params->Cod_Amount) }}</td>
						</tr>
					</table>
				</td>
			</tr>
			<!--<tr>-->
			<!--	<td colspan="2">Net Amount</td>-->
			<!--	<td colspan="3">{{ ucwords($params->Cod_Amount) }}</td>-->
			<!--</tr>-->
			<tr>
				<td colspan="3" class="leftmargin">
				<center><b>Shipped By (If Undelivered, Return to)</b></center>
					{{ ucwords($Hubs['hub_name']) }}, <br>
					{{ ucwords($Hubs['hub_address1']) }},
					{{ ucwords($Hubs['hub_state']) }},
					{{ ucwords($Hubs['hub_city']) }}
					-{{ ucwords($Hubs['hub_pincode']) }}
					<br>
					Phone : <b>{{ ucwords($Hubs['hub_mobile']) }}</b>
				</td>
				<td colspan="2">
				    <center>
				        <img src="{{ asset('HubDetails') }}/{{ $Hubs['hub_folder'] }}/{{ $Hubs['hub_img'] }}" title="Hub Image" style="width:100px;height:100px;">
				    </center>
				</td>
			</tr>
			<tr>
				<td colspan="5" class="leftmargin">
					This is Auto Generated Label And Does Not Need Signature
				</td>
			</tr>
		</table>
	</div>
</div>





















</body>
</html>


<script>
function printpage()
  {
  window.print()
  }
  printpage();
</script>
