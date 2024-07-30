@extends('Admin.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Daily Report</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<!-- <li><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;margin-right:10px">Add New Order</a></li> -->
	<li><a href="{{ asset('/ADailyReport_Export') }}" class="btn btn-success" style="color:white;margin-right:10px">Download Excel</a></li>
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
	<!-- <header class="panel-heading">
		<div class="panel-actions"> -->
			<!-- <a href="#" class="btn btn-success" style="width:100%;padding-bottom:30px !important">Add</a> -->
			<!-- <a href="#" class="fa fa-caret-down"></a> -->
			<!-- <a href="#" class="fa fa-times"></a> -->
		<!-- </div>

		<h2 class="panel-title">Basic</h2>
	</header> -->
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">
			<thead>
				<tr>
					<th>Sr No</th>
					<th>Awb No</th>
					<th>Order No</th>
					<th>PickUp Date</th>
					<th>Order Status</th>
					<th>Courier Remark</th>
					<th>Last Status date</th>
					<th>Delivery Date</th>
					<th>FirstScanDate</th>
					<th>FirstScantime</th>
					<th>FirstAttemptDate</th>
					<th>EDD</th>
					<th>Origin City</th>
					<th>Origin pin code</th>
					<th>Destination City</th>
					<th>Destination Pincode</th>
					<th>Customer Name</th>
					<th>Customer Contact</th>
					<th>Client Name</th>
					<th>Payment Mode</th>
					<th>COD Amount</th>
					<th>Order Ageing</th>
					<th>AttemptCount</th>
					<th>CourierName</th>
					<th>RTO Date</th>
					<th>RTOReason</th>
					<th>ZoneName</th>
					<th>Last OFD Date</th>
					<th>NDR instructions</th>
				</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($params as $param)
					<tr class="gradeX">
						<td>{{ $i }}</td>
						<td>{{ $param->awb_no }}</td>
						<td>{{ $param->orderno }}</td>
						<td>{{ $param->orderdata }}</td>
						<td>{{ $param->order_status }}</td>
						<td>{{ $param->order_rider_status }}</td>
						<td>{{ $param->order_start_date }}</td>
						<td>{{ $param->order_delivery_date }}</td>
		                <td>{{ $param->orderdata }}</td>
		                <td>{{ $param->orderdatetime }}</td>
		                <td>{{ $param->last_status_date }}</td>
		                <td>EDD</td>
		                <td>hub city</td>
		                <td>hub pincode</td>
		                <td>{{ $param->ccity }}</td>
		                <td>{{ $param->cpin }}</td>
		                <td>{{ $param->order_userid }}</td>
		                <td>{{ $param->order_userid }}</td>
		                <td>{{ $param->cname }}</td>
		                <td>{{ $param->order_payment_mode }}</td>
		                <td>{{ $param->ptamt }}</td>
		                <td>{{ $param->courier_name }}</td>
		                <td>{{ $param->order_rider_atmpt }}</td>
		                <td>{{ $param->courier_name }}</td>
		                <td>{{ $param->rto_date }}</td>
		                <td>{{ $param->rto_reason }}</td>
		                <td></td>
		                <td>{{ $param->last_status_date }}</td>
		                <td></td>
				@php($i++)
				@endforeach
			</tbody>
		</table>
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



