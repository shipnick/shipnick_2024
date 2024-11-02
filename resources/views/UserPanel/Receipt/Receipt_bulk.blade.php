<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Artu Logistic</title>
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

<style>
.leftmargin{
    padding:0px 0px 0px 10px !important;
}
</style>

@foreach($params as $param)

<div style="width:100%;"><br><br> <!-- Main Div -->
<!-- <h3> Header </h3> -->

	<div style="float:left; width:49%;">
		<table width="100%" border="1" style="border-collapse: collapse;">
			<!-- <tr> -->
				<!-- <td colspan="5">{{ session('UserLogin2name') }}</td> -->
				<!-- <td colspan="3">Dispatch Label</td> -->
			<!-- </tr> -->
			<tr>
					<td colspan="5" class="text-center">Fulfilled by Artu Logistic
@if($param->order_cancel == 1)
	( <b>Canceled</b> )
@endif
					</td>
			</tr>
			<tr>
				<td colspan="2" class="leftmargin">
					<!--AWB 	: <b>{{ $param->Awb_Number }}</b> <br>-->
					Pay Type 	: <b>{{ ucwords($param->Order_Type) }}</b>
				</td>
				<td colspan="3" class="text-center">
					Collect Cash <b><br>
						<span style="font-size:18px">Rs. {{ ucwords($param->Cod_Amount) }}/-</span>
					</b>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<div class="col-md-12 text-center">
{{ ucwords($params->awb_gen_by) }}<br>
<?php
$awbno = trim($awbno);
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($param->Awb_Number, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" style="max-width:99%" />';
 ?>
<br>
 AWB Number - {{ $awbno }}
 <!--<br><br>-->
<?php
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($param->orderno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" style="max-width:99%" />';
 ?>
 <!--<br><br>-->
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="leftmargin">
					<b>Shipping Address</b> <br>
					Name :  <b>{{ ucwords($param->Name) }}</b><br>
					Address : <b>{{ ucwords($param->Address) }}</b><br><br>
					City : <b>{{ ucwords($param->City) }}</b><br>
					Pincode : <b>{{ ucwords($param->Pincode) }}</b><br>
					Mobile : <b>{{ ucwords($param->Mobile) }}</b><br>
				</td>
				<td colspan="3" class="leftmargin">
					<b>Invoice Details</b> <br>
					Order No :  <b>{{ ucwords($param->orderno) }}</b><br>
					Order Date : <b>
						<?php
							$date=date_create($param->orderdata);
							echo date_format($date,"d-m-Y");
						?>
					</b><br><br>
					Seller Name : <b>{{ session('UserLogin2name') }}</b><br><br>
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
							<td>{{ ucwords($param->Item_Name) }}</td>
							<!--<td></td>-->
							<td>{{ ucwords($param->Quantity) }}</td>
							<td>{{ ucwords($param->Cod_Amount) }}</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- <tr>
				<td colspan="2">Discount</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">COD Charge</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">Net Amount</td>
				<td colspan="3">{{ ucwords($param->itmecodamt) }}</td>
			</tr>
			<tr> -->
				<td colspan="5" class="leftmargin">
					<b>Shipped By (If Undelivered, Return to)</b><br>
					@foreach($Hubs as $Hub)
						@if($param->pickup_id==$Hub->hub_id)
							{{ ucwords($Hub->hub_name) }}, <br>
							{{ ucwords($Hub->hub_address1) }},
							{{ ucwords($Hub->hub_state) }},
							{{ ucwords($Hub->hub_city) }}
							-{{ ucwords($Hub->hub_pincode) }}
							<br>
							Phone : <b>{{ ucwords($Hub->hub_mobile) }}</b>
						@endif
					@endforeach
				</td>
			</tr>
			<tr>
				<td colspan="5" class="leftmargin">
					This is Auto Generated Label And Does Not Need Signature
				</td>
			</tr>
		</table>
		<br>&ensp;<br>
	</div>
	<div style="float:left; width:49%; margin-left:10px;">
		<table width="100%" border="1" style="border-collapse: collapse;">
			<!-- <tr> -->
				<!-- <td colspan="5">{{ session('UserLogin2name') }}</td> -->
				<!-- <td colspan="3">Dispatch Label</td> -->
			<!-- </tr> -->
			<tr>
					<td colspan="5" class="text-center">Fulfilled by Artu Logistic
@if($param->order_cancel == 1)
	( <b>Canceled</b> )
@endif
					</td>
			</tr>
			<tr>
				<td colspan="2" class="leftmargin">
					<!--AWB 	: <b>{{ $param->Awb_Number }}</b> <br>-->
					Pay Type 	: <b>{{ ucwords($param->Order_Type) }}</b>
				</td>
				<td colspan="3" class="text-center">
					Collect Cash <b><br>
						<span style="font-size:18px">Rs. {{ ucwords($param->Cod_Amount) }}/-</span>
					</b>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<div class="col-md-12 text-center">
 {{ ucwords($params->awb_gen_by) }}<br>
<?php
$awbno = trim($awbno);
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($param->Awb_Number, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" style="max-width:99%" />';
 ?>
<br>
 AWB Number - {{ $awbno }}
 <!--<br><br>-->
<?php
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($param->orderno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" style="max-width:99$" />';
 ?>
 <!--<br><br>-->
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="leftmargin">
					<b>Shipping Address</b> <br>
					Name :  <b>{{ ucwords($param->Name) }}</b><br>
					Address : <b>{{ ucwords($param->Address) }}</b><br><br>
					City : <b>{{ ucwords($param->City) }}</b><br>
					Pincode : <b>{{ ucwords($param->Pincode) }}</b><br>
					Mobile : <b>{{ ucwords($param->Mobile) }}</b><br>
				</td>
				<td colspan="3" class="leftmargin">
					<b>Invoice Details</b> <br>
					Order No :  <b>{{ ucwords($param->orderno) }}</b><br>
					Order Date : <b>
						<?php
							$date=date_create($param->orderdata);
							echo date_format($date,"d-m-Y");
						?>
					</b><br><br>
					Seller Name : <b>{{ session('UserLogin2name') }}</b><br><br>
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
							<td>{{ ucwords($param->Item_Name) }}</td>
							<!--<td></td>-->
							<td>{{ ucwords($param->Quantity) }}</td>
							<td>{{ ucwords($param->Cod_Amount) }}</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- <tr>
				<td colspan="2">Discount</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">COD Charge</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">Net Amount</td>
				<td colspan="3">{{ ucwords($param->itmecodamt) }}</td>
			</tr>
			<tr> -->
				<td colspan="5" class="leftmargin">
					<b>Shipped By (If Undelivered, Return to)</b><br>
					@foreach($Hubs as $Hub)
						@if($param->pickup_id==$Hub->hub_id)
							{{ ucwords($Hub->hub_name) }}, <br>
							{{ ucwords($Hub->hub_address1) }},
							{{ ucwords($Hub->hub_state) }},
							{{ ucwords($Hub->hub_city) }}
							-{{ ucwords($Hub->hub_pincode) }}
							<br>
							Phone : <b>{{ ucwords($Hub->hub_mobile) }}</b>
						@endif
					@endforeach
				</td>
			</tr>
			<tr>
				<td colspan="5" class="leftmargin">
					This is Auto Generated Label And Does Not Need Signature
				</td>
			</tr>
		</table>
		<br>&ensp;<br>
	</div>

<!-- <div>Footer</div> -->
</div>
<div style="page-break-after:always;"></div>


@endforeach


















</body>
</html>


<script>
function printpage()
  {
  window.print()
  }
  printpage();
</script>
