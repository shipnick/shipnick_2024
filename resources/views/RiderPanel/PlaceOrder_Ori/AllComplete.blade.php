@extends('RiderPanel.Layout_1')

@section('bodycontent')
@php(error_reporting(1))
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>All Complete Order</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/UserPanel') }}"><i class="fa fa-home"></i></a></li> -->
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
					<th>AWB No</th>
					<th>Order No</th>
					<th>PickUp Date</th>
					<th>Order Status</th>
					<th>Courier Remark</th>
					<th>Last Status Date</th>
					<th>Delivery Date</th>
					<th>Destination City</th>
					<th>Destination Pincode</th>
					<th>Customer Name</th>
					<th>Customer Mobile</th>
					<th>Payment Mode</th>
					<th>COD Amt</th>
					<th>Attempt Count</th>
					<th>Courier Name</th>
					<th>RTO Date</th>
					<th>RTO Reason</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($params as $param)
					<tr class="gradeX">
						<td>{{ $i }}</td>
						<td>{{ $param->orderno }}</td>
						<td>{{ $param->orderdata }}</td>
						<td>{{ $param->order_status }}</td>
						<td></td>
						<td>{{ $param->orderdata }}</td>
						<td>{{ $param->orderdata }}</td>
						<td>{{ $param->ccity }}</td>
						<td>{{ $param->cpin }}</td>
						<td>{{ $param->cname }}</td>
						<td>{{ $param->cmobile }}</td>
						<td></td>
						<td>{{ $param->itmecodamt }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>
<select class="form-control" id="crtorder" onchange="orderstatus{{ $param->orderid }}({{ $param->orderid }})">
<?php
	if($param->order_status == "Progress")
	{
?>
	<option value="Pending">Pending</option>
	<option value="Progress" selected="">Progress</option>
	<option value="Complete">Complete</option>
	<option value="Cancel">Cancel</option>
<?php
	}
	elseif($param->order_status == "Pending")
	{
?>	
	<option value="Pending" selected="">Pending</option>
	<option value="Progress">Progress</option>
	<option value="Complete">Complete</option>
	<option value="Cancel">Cancel</option>
<?php
	}
	elseif($param->order_status == "Complete")
	{
?>
	<option value="Pending">Pending</option>
	<option value="Progress">Progress</option>
	<option value="Complete" selected="">Complete</option>
	<option value="Cancel">Cancel</option>
<?php
	}
	elseif($param->order_status == "Cancel")
	{
?>
	<option value="Pending">Pending</option>
	<option value="Progress">Progress</option>
	<option value="Complete">Complete</option>
	<option value="Cancel" selected="">Cancel</option>
<?php
	}
?>
</select>
						</td>
					</tr>
<script type="text/javascript">
function orderstatus{{ $param->orderid }}(param)
{
	// alert(param);
	var paramval = $("#crtorder").val();
	// alert(a);
	$.ajax({
		type:"POST",
		url:"/RPPending_Order_Change",
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data:{param:param,paramval:paramval},
		success:function(data){
			// console.log(data);
			location.reload();
			// alert('work');
		}
	});
}
</script>
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



