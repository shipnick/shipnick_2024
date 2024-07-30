@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Invoices</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
<!-- <li><span>Dashboard</span></li> -->
	<!-- <li><a href="{{ asset('/UPNew_Hub') }}" class="btn btn-success" style="color:white;margin-right:10px">Add New Hub</a></li> -->
	</ol>
	<!-- <a class="sidebar-right-toggle">	</a> -->
</div>
</header>
<!-- Heading -->


@if(session('status')=="Hub Details Delete Successfully")
<div class="alert alert-danger success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>{{ session('status') }}</strong>
</div>
@elseif(session('status'))
<div class="alert alert-success success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>{{ session('status') }}</strong>
</div>
@endif


<!-- start: page -->
<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel panel-primary">
	<header class="panel-heading">
		<h2 class="panel-title">View Invoice Details</h2>
	</header>
<div class="panel-body">
<div class="row">
<!--  -->


<section class="panel">
	<div class="panel-body">

<table class="table table-bordered table-striped mb-none" id="datatable-default">
<thead>
	<tr>
		<th>Invoice_ID</th>
		<th>Due_Date</th>
		<th>Expected_Amt</th>
		<th>Transaction_ID</th>
		<!-- <th>Download_Report</th> -->
		<th>Status</th>
	</tr>
</thead>
<tbody>

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
