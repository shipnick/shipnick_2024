@extends('UserPanel.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Edit Hub</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<!-- <li><a href="{{ asset('/UPAll_Hubs') }}" class="btn btn-warning" style="color:white;margin-right:10px">Back</a></li> -->
	</ol>
	<!-- <a class="sidebar-right-toggle">	</a> -->
</div>
</header>
<!-- Heading -->


@if(session('status')=="Hub Details Update")
<div class="alert alert-success success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>{{ session('status') }}</strong>
</div>
@elseif(session('status'))
<div class="alert alert-danger success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>{{ session('status') }}</strong>
</div>
@endif

<!-- start: page -->
<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel panel-primary">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="{{ asset('/UPAll_Hubs') }}" class="btn btn-warning" style="color:white;width:auto;height:35px;background-color:#ED9C28 !important"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
		</div>
		<h2 class="panel-title">Edit Details</h2>
	</header>
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
<form method="post" action="{{ asset('/UPHub_Edit_Update') }}">
    <div class="row"><br>
        <div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Hub Name" value="{{ $params->hub_name }}" required="" title="Hub Name *">
        </div>
        <div class="col-md-6">
            <input type="text" name="gstno" class="form-control" placeholder="GST No" value="{{ $params->hub_gstno }}" title="Gst No">
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <input type="text" name="mobile" class="form-control" placeholder="Mobile No *" pattern="[0-9]+" minlength="10" maxlength="12" value="{{ $params->hub_mobile }}" required="" title="Mobile No">
        </div>
        <div class="col-md-6">
            <input type="text" name="city" class="form-control" placeholder="City *" value="{{ $params->hub_city }}" required="" title="City">
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <input type="text" name="state" class="form-control" placeholder="State *" value="{{ $params->hub_state }}" required="" title="State">
        </div>
        <div class="col-md-6">
            <input type="text" name="pincode" class="form-control" placeholder="Pincode *" pattern="[0-9]+" value="{{ $params->hub_pincode }}" required="" title="Pincode">
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <textarea class="form-control" name="address1" rows="5" placeholder="Address 1 *" required="" title="Address 1">{{ $params->hub_address1 }}</textarea>
        </div>
        <div class="col-md-6">
            <textarea class="form-control" name="address2" rows="5" placeholder="Address 2" title="Address 2">{{ $params->hub_address2 }}</textarea>
        </div>
    </div>

    <div class="row"><br>
        <div class="col-md-6">
            <select class="form-control" name="deliverytype" title="Delhivery Type">
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
        <div class="col-md-3">
            <input type="hidden" name="hubid" value="{{ $params->hub_id }}">
            @csrf
            <button type="submit" class="btn btn-success" style="width:100%">Update Hub</button>
        </div>
</form>
        <div class="col-md-3">
<form method="post" action="{{ asset('/UPHub_Delete') }}">
    <input type="hidden" name="hubid" value="{{ $params->hub_id }}">
    <input type="hidden" name="hubaltid" value="{{ $params->hub_alternate_id }}">
    @csrf
    <button type="submit" class="btn btn-danger" style="width:100%">Delete Hub</button>
</form>
        </div>
    </div>
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
