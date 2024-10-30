<div style="width:100%;"> <!-- Main Div -->
<h3> Header </h3>
	
	<div style="float:left; width:49%;">
		<table width="100%" border="1" style="border-collapse: collapse;">
			<tr>
				<td colspan="2">{{ session('UserLogin2name') }}</td>
				<td colspan="3">Dispatch Label</td>
			</tr>
			<tr>
				<td colspan="2">
					Courier : <b>{{ ucwords($params->courier_name) }}</b> <br>
					AWB 	: <b>{{ $awbno }}</b> <br>
					Pay Type 	: <b>COD</b> <br><br>

					Collect Cash 	: <b>{{ ucwords($params->itmecodamt) }}</b> <br>
				</td>
				<td colspan="3">
					AWB Barcode <br>
<?php 
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" />';
 ?>
 <br>


					{{ $awbno }} <br>
					Order Barcode <br>
<?php 
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" />';
 ?>
 <br>
					{{ $orderno }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<b>Shipping Address</b> <br>
					Name :  <b>{{ ucwords($params->cname) }}</b><br>
					Address : <b>{{ ucwords($params->caddress) }}</b><br><br>
					City : <b>{{ ucwords($params->ccity) }}</b><br>
					Pincode : <b>{{ ucwords($params->cpin) }}</b><br>
					Mobile : <b>{{ ucwords($params->cmobile) }}</b><br>
				</td>
				<td colspan="3">
					<b>Invoice Details</b> <br>
					Order No :  <b>{{ ucwords($params->orderno) }}</b><br>
					Order Date : <b>
						<?php
							$date=date_create($params->orderdata);
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
							<th>SKU</th>
							<th>QTY</th>
							<th>Total</th>
						</tr>
						<tr>
							<td>1</td>
							<td>{{ ucwords($params->itemname) }}</td>
							<td></td>
							<td>{{ ucwords($params->itemquantity) }}</td>
							<td>{{ ucwords($params->itmecodamt) }}</td>
						</tr>
					</table><br><br><br>
				</td>
			</tr>
			<tr>
				<td colspan="2">Discount</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">COD Charge</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">Net Amount</td>
				<td colspan="3">{{ ucwords($params->itmecodamt) }}</td>
			</tr>
			<tr>
				<td colspan="5">
					<b>Shipped By (If Undelivered, Return to)</b><br>
					Gali No. A1, House A-114, Landmark Near Gurudwara, Delhi-110092 <br>
					Phone : <b>9911554411</b>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					This is Auto Generated Label And Does Not Need Signature
				</td>
			</tr>
		</table>
	</div>
	<div style="float:left; width:49%; margin-left:10px;">
		<table width="100%" border="1" style="border-collapse: collapse;">
		<tr>
				<td colspan="2">{{ session('UserLogin2name') }}</td>
				<td colspan="3">Dispatch Label</td>
			</tr>
			<tr>
				<td colspan="2">
					Courier : <b>{{ ucwords($params->courier_name) }}</b> <br>
					AWB 	: <b>{{ $awbno }}</b> <br>
					Pay Type 	: <b>COD</b> <br><br>

					Collect Cash 	: <b>{{ ucwords($params->itmecodamt) }}</b> <br>
				</td>
				<td colspan="3">
					AWB Barcode <br>
<?php 
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" />';
 ?><br>
					{{ $awbno }} <br>
					Order Barcode <br>
<?php 
echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($orderno, 'C39+',3,33,array(1,1,1)) . '" alt="barcode" />';
 ?><br>
					<br>{{ $orderno }}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<b>Shipping Address</b> <br>
					Name :  <b>{{ ucwords($params->cname) }}</b><br>
					Address : <b>{{ ucwords($params->caddress) }}</b><br><br>
					City : <b>{{ ucwords($params->ccity) }}</b><br>
					Pincode : <b>{{ ucwords($params->cpin) }}</b><br>
					Mobile : <b>{{ ucwords($params->cmobile) }}</b><br>
				</td>
				<td colspan="3">
					<b>Invoice Details</b> <br>
					Order No :  <b>{{ ucwords($params->orderno) }}</b><br>
					Order Date : <b>
						<?php
							$date=date_create($params->orderdata);
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
							<th>SKU</th>
							<th>QTY</th>
							<th>Total</th>
						</tr>
						<tr>
							<td>1</td>
							<td>{{ ucwords($params->itemname) }}</td>
							<td></td>
							<td>{{ ucwords($params->itemquantity) }}</td>
							<td>{{ ucwords($params->itmecodamt) }}</td>
						</tr>
					</table><br><br><br>
				</td>
			</tr>
			<tr>
				<td colspan="2">Discount</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">COD Charge</td>
				<td colspan="3">0</td>
			</tr>
			<tr>
				<td colspan="2">Net Amount</td>
				<td colspan="3">{{ ucwords($params->itmecodamt) }}</td>
			</tr>
			<tr>
				<td colspan="5">
					<b>Shipped By (If Undelivered, Return to)</b><br>
					Gali No. A1, House A-114, Landmark Near Gurudwara, Delhi-110092 <br>
					Phone : <b>9911554411</b>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					This is Auto Generated Label And Does Not Need Signature
				</td>
			</tr>
		</table>
	</div>

<div>Footer</div>
</div>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>ShipXpress</title>
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<meta name="author" content="Singhaniya">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Mobile Metas -->

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/morris/morris.css') }}" />
<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme.css') }}" />
<!-- Skin CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/skins/default.css') }}" />
<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme-custom.css') }}">
<!-- Head Libs -->
<script src="{{ asset('Admin/assets/vendor/modernizr/modernizr.js') }}"></script>


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
<!-- <link href="https://fonts.googleapis.com/css2?family=Castoro:ital@0;1&family=Lora:ital,wght@1,500&display=swap" rel="stylesheet"> -->

<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
<!-- <link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@1,500&family=Castoro:ital@0;1&display=swap" rel="stylesheet"> -->
</head>
<body>





@php(error_reporting(1))
@php(date_default_timezone_set('Asia/Calcutta'))

<style type="text/css">
.bll{
	border-left: 1px solid black;
	border-top: 1px solid black;
	border-right: 1px solid black;
}
.brl{
	border-top: 1px solid black;
	border-right: 1px solid black;
}
.bbtm{
	border-bottom:1px solid black;
}
</style>


<div class="container-fluid">
	<div class="col-md-12">
		<div class="col-md-6">
<!-- Top Left -->
<!--  -->
	<div class="col-md-12">
		<div class="col-md-6 bll">
			<h4>{{ session('UserLogin2name') }}</h4>
		</div>
		<div class="col-md-6 brl">
			<h4>Dispatch Label</h4>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 bll">
			<div class="col-md-12"><br>
				Courier : <b>{{ ucwords($params->courier_name) }}</b> <br>
				AWB 	: <b>{{ $awbno }}</b> <br>
				Pay Type 	: <b>COD</b> <br><br>

				Collect Cash 	: <b>{{ ucwords($params->itmecodamt) }}</b> <br><br>
			</div>
		</div>

		<div class="col-md-8 brl">
			<div class="col-md-12">
			<!-- <img src="{{ asset('images/logo.jpeg') }}" style="width:100px">
				ShipXpress Details
				<br><br><br> -->
				AWB Barcode
				{!! $awbbarcode !!}
				{{ $awbno }} <br>
				Order Barcode
				{!! $orderbarcode !!}
				{{ $orderno }}
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-6 bll">
			<div class="col-md-12"><br>
				<b>Shipping Address</b> <br>
				Name :  <b>{{ ucwords($params->cname) }}</b><br>
				Address : <b>{{ ucwords($params->caddress) }}</b><br><br>
				City : <b>{{ ucwords($params->ccity) }}</b><br>
				Pincode : <b>{{ ucwords($params->cpin) }}</b><br>
				Mobile : <b>{{ ucwords($params->cmobile) }}</b><br>
			</div>
		</div>
		<div class="col-md-6 brl">
			<div class="col-md-12"><br>
				<b>Invoice Details</b> <br>
				Order No :  <b>{{ ucwords($params->orderno) }}</b><br>
				Order Date : <b>
					<?php
						$date=date_create($params->orderdata);
						echo date_format($date,"d-m-Y");
					?>
				</b><br><br>
				<!-- Invoice No : <b>{{ ucwords($params->ccity) }}</b><br> -->
				Seller Name : <b>{{ session('UserLogin2name') }}</b><br><br>
			</div>
		</div>
	</div>

	<div class="col-md-12">
	<div class="col-md-12 bll brl"><br>
		<table class="table">
			<tr>
				<th>Sr No</th>
				<th>Product Name</th>
				<th>SKU</th>
				<th>QTY</th>
				<th>Total</th>
			</tr>
			<tr>
				<td>1</td>
				<td>{{ ucwords($params->itemname) }}</td>
				<td></td>
				<td>{{ ucwords($params->itemquantity) }}</td>
				<td>{{ ucwords($params->itmecodamt) }}</td>
			</tr>
		</table><br><br><br>
	</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-6 bll">Discount</div>
		<div class="col-md-6 brl">0</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 bll">COD Charge</div>
		<div class="col-md-8 brl">0</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 bll">Net Amount</div>
		<div class="col-md-8 brl">{{ ucwords($params->itmecodamt) }}</div>
	</div>

	<div class="col-md-12">
	<div class="col-md-12 bll brl">
		<b>Shipped By (If Undelivered, Return to)</b><br>
		Gali No. A1, House A-114, Landmark Near Gurudwara, Delhi-110092 <br>
		Phone : <b>9911554411</b>
	</div>
	</div>

	<div class="col-md-12">
	<div class="col-md-12 bll brl bbtm">
		This is Auto Generated Label And Does Not Need Signature
	</div>
	</div>

<!--  -->
<!-- //Top Left -->
		</div>
		<div class="col-md-6">
<!-- Top Right -->
<!--  -->
	<div class="col-md-12">
		<div class="col-md-6 bll">
			<h4>{{ session('UserLogin2name') }}</h4>
		</div>
		<div class="col-md-6 brl">
			<h4>Dispatch Label</h4>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 bll">
			<div class="col-md-12"><br>
				Courier : <b>{{ ucwords($params->courier_name) }}</b> <br>
				AWB 	: <b>{{ $awbno }}</b> <br>
				Pay Type 	: <b>COD</b> <br><br>

				Collect Cash 	: <b>{{ ucwords($params->itmecodamt) }}</b> <br><br>
			</div>
		</div>
		<div class="col-md-8 brl">
			<div class="col-md-12">
			<!-- <img src="{{ asset('images/logo.jpeg') }}" style="width:100px">
				ShipXpress Details
				<br><br><br> -->
				AWB Barcode
				{!! $awbbarcode !!}
				{{ $awbno }} <br>
				Order Barcode
				{!! $orderbarcode !!}
				{{ $orderno }}
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-6 bll">
			<div class="col-md-12"><br>
				<b>Shipping Address</b> <br>
				Name :  <b>{{ ucwords($params->cname) }}</b><br>
				Address : <b>{{ ucwords($params->caddress) }}</b><br><br>
				City : <b>{{ ucwords($params->ccity) }}</b><br>
				Pincode : <b>{{ ucwords($params->cpin) }}</b><br>
				Mobile : <b>{{ ucwords($params->cmobile) }}</b><br>
			</div>
		</div>
		<div class="col-md-6 brl">
			<div class="col-md-12"><br>
				<b>Invoice Details</b> <br>
				Order No :  <b>{{ ucwords($params->orderno) }}</b><br>
				Order Date : <b>
					<?php
						$date=date_create($params->orderdata);
						echo date_format($date,"d-m-Y");
					?>
				</b><br><br>
				<!-- Invoice No : <b>{{ ucwords($params->ccity) }}</b><br> -->
				Seller Name : <b>{{ session('UserLogin2name') }}</b><br><br>
			</div>
		</div>
	</div>

	<div class="col-md-12">
	<div class="col-md-12 bll brl"><br>
		<table class="table">
			<tr>
				<th>Sr No</th>
				<th>Product Name</th>
				<th>SKU</th>
				<th>QTY</th>
				<th>Total</th>
			</tr>
			<tr>
				<td>1</td>
				<td>{{ ucwords($params->itemname) }}</td>
				<td></td>
				<td>{{ ucwords($params->itemquantity) }}</td>
				<td>{{ ucwords($params->itmecodamt) }}</td>
			</tr>
		</table><br><br><br>
	</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-6 bll">Discount</div>
		<div class="col-md-6 brl">0</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 bll">COD Charge</div>
		<div class="col-md-8 brl">0</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-4 bll">Net Amount</div>
		<div class="col-md-8 brl">{{ ucwords($params->itmecodamt) }}</div>
	</div>

	<div class="col-md-12">
	<div class="col-md-12 bll brl">
		<b>Shipped By (If Undelivered, Return to)</b><br>
		Gali No. A1, House A-114, Landmark Near Gurudwara, Delhi-110092 <br>
		Phone : <b>9911554411</b>
	</div>
	</div>

	<div class="col-md-12">
	<div class="col-md-12 bll brl bbtm">
		This is Auto Generated Label And Does Not Need Signature
	</div>
	</div>

<!--  -->
<!-- //Top Right -->
		</div>
	</div>
</div>



<br><br>


<!-- <link href="{{ asset('plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/colors/megna.css') }}" id="theme" rel="stylesheet">
<script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
 -->



</body>
</html>


<!-- <script>
function printpage()
  {
  window.print()
  }
  printpage();
</script> -->
