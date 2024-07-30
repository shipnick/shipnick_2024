@extends('Admin.Layout_1')

@section('bodycontent')
<?php 
	error_reporting(1);
 ?>
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Track Your : {{ $tracking_number }}</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<!-- <li><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;margin-right:10px">Add New Order</a></li> -->
	</ol>
	<!-- <a class="sidebar-right-toggle">	</a> -->
</div>
</header>
<!-- Heading -->


<!-- start: page -->
<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel">
<div class="panel-body">
<div class="row">
<!--  -->


<section class="panel">
	<div class="panel-body">

		<div class="col-md-12"><hr>
			<div class="col-md-6">
				<center><b style="font-size:21px">Current Status</b></center>
<h4><span style="color:black">Received By :</span>
 {{ $json['status']['received_by'] }}</h4>

<h4><span style="color:black">Status :</span>
 {{ $json['status']['current_status_body'] }}
({{ $json['status']['current_status_type'] }})</h4>

<h4><span style="color:black">Location :</span>
 {{ $json['status']['current_status_location'] }}</h4>

<h4><span style="color:black">Date/Time :</span>
 {{ $json['status']['current_status_time'] }}</h4>

			</div>
			<div class="col-md-6">
				<center><b style="font-size:21px">Order Details</b></center>
	
<h4><span style="color:black">Order Name :</span>
{{ ucwords($params['itemname']) }}</h4>
<h4><span style="color:black">Order Number :</span>
{{ $params['orderno'] }}</h4>
<h4><span style="color:black">Order AWB No :</span>
{{ $params['awb_no'] }}</h4>
<h4><span style="color:black">COD Amt :</span>
{{ $json['info']['cod_amount'] }}</h4>
			</div>
		</div>
		
<!-- <div class="col-md-12"><hr>
	<div class="col-md-6">
		<center><b style="font-size:21px">Order Start From</b> &ensp;&ensp; : 
		{{ $json['info']['from_city'] }} ({{ $json['info']['from_pincode'] }})</center>
	</div>
	<div class="col-md-6">
		<center><b style="font-size:21px">Order End To</b>&ensp;&ensp; : 
		{{ $json['info']['to_city'] }} ({{ $json['info']['to_pincode'] }})</center>
	</div>
</div> -->

<div class="col-md-12"><hr>
	<center><b style="font-size:21px">Order Process Details</b></center>
<?php 
$i=1;
foreach ($json['track_arr'][0]['status_array'] as $key) {
	// echo $key['status_time'];
	// echo $key['status_body'];
	// echo $key['status_location'];
	// echo "<br>";
?>
	<div class="col-md-6" style="border:1px solid black;border-radius:20px">
		<center><b style="font-size:18px">Process/Step <?= $i ?></b></center>
		<h5><span style="color:black">Status Date/Time :</span>
			<?= $key['status_time'] ?></h5>
		<h5><span style="color:black">Status :</span>
			<?= $key['status_body'] ?></h5>
		<h5><span style="color:black">Location :</span>
			<?= $key['status_location'] ?></h5>
	</div>
<?php
$i++;
}
?>
</div>


		<!-- <div class="col-md-12">
			<div class="col-md-6">Current
			</div>
			<div class="col-md-6">1</div>
		</div> -->
		
	<?php 
// foreach ($json['track_arr'][0] as $key => $value) {
// 	// foreach ($key[$value] as $key1 => $value1) {
// 	// 	echo $key1;
// 	// }
// }
// foreach ($json['track_arr'][0]['status_array'] as $key) {
// 	echo $key['status_time'];
// 	echo $key['status_body'];
// 	echo $key['status_location'];
// 	echo "<br>";
// }
// echo "<br>";

// print_r($json['track_arr'][0]['status_array']);


// print_r($json['track_arr'][0]);


// print_r($json);	

// print_r($result);
	 ?>

		

	</div>
</section>




<!--  -->
</div>
</div>
</section>
</div>


</div>




<!-- end: page -->
</section>
@endsection


<!-- Header -->
@section('HeaderExtraFiles')

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/select2/select2.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('Admin/assets/vendor/modernizr/modernizr.js') }}"></script>
@endsection
<!-- Header -->

<!-- Footer -->
@section('FooterExtraFiles')
			<!-- Vendor -->
		<script src="{{ asset('Admin/assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
		
		<!-- Specific Page Vendor -->
		<script src="{{ asset('Admin/assets/vendor/select2/select2.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('Admin/assets/javascripts/theme.js') }}"></script>
		
		<!-- Theme Custom -->
		<script src="{{ asset('Admin/assets/javascripts/theme.custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('Admin/assets/javascripts/theme.init.js') }}"></script>


		<!-- Examples -->
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.default.js') }}"></script>
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
@endsection
<!-- Footer -->



