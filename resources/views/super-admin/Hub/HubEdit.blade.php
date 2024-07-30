@extends('super-admin.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Hub Edit {{ $params->hub_id }}</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<li>
        <a href="{{ asset('/All_Hubs') }}" class="btn btn-warning" style="color:white;margin-right:10px">Back</a>
    </li>
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
		<div class="panel-actions">
			<a href="#" class="btn btn-success" style="width:100%;padding-bottom:30px !important">Add</a>
			<a href="#" class="fa fa-caret-down"></a>
			<a href="#" class="fa fa-times"></a>
		</div>
		<h2 class="panel-title" style="color:black"><b>Hub Edit details</b></h2>
	</header> -->

<div class="panel-body">
<div class="container-fluid">
<form method="post" action="{{ asset('/Hub_Edit_Update') }}">
    <div class="row"><br>
        <div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Hub Name *" value="{{ $params->hub_name }}" required="">
        </div>
        <div class="col-md-6">
            <input type="text" name="gstno" class="form-control" placeholder="GST No" value="{{ $params->hub_gstno }}">
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <input type="text" name="mobile" class="form-control" placeholder="Mobile No *" pattern="[0-9]+" minlength="10" maxlength="12" value="{{ $params->hub_mobile }}" required="">
        </div>
        <div class="col-md-6">
            <input type="text" name="city" class="form-control" placeholder="City *" value="{{ $params->hub_city }}" required="">
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <input type="text" name="state" class="form-control" placeholder="State *" value="{{ $params->hub_state }}" required="">
        </div>
        <div class="col-md-6">
            <input type="text" name="pincode" class="form-control" placeholder="Pincode *" pattern="[0-9]+" value="{{ $params->hub_pincode }}" required="">
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <textarea class="form-control" name="address1" rows="5" placeholder="Address 1 *" required="">{{ $params->hub_address1 }}</textarea>
        </div>
        <div class="col-md-6">
            <textarea class="form-control" name="address2" rows="5" placeholder="Address 2">{{ $params->hub_address2 }}</textarea>
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <select class="form-control" name="deliverytype">
@if($params->hub_deliverytype=="Economy")
    <option>Delivery Type</option>
    <option value="Economy" selected="">Economy</option>
    <option value="Bulk">Bulk</option>
@elseif($params->hub_deliverytype=="Bulk")
    <option>Delivery Type</option>
    <option value="Economy">Economy</option>
    <option value="Bulk" selected="">Bulk</option>
@else
    <option>Delivery Type</option>
    <option value="Economy">Economy</option>
    <option value="Bulk">Bulk</option>
@endif
            </select>
        </div>
        <div class="col-md-6">
            <input type="hidden" name="hubid" value="{{ $params->hub_id }}">
            @csrf
            <button type="submit" class="btn btn-success" style="width:100%">Add New Hub Detail</button>
        </div>
    </div>
</form>
</div>
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



