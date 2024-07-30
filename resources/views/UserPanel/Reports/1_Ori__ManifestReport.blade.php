@extends('UserPanel.Layout')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Manifest Report</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<!-- <li><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;margin-right:10px">Add New Order</a></li> -->
	<li><a href="{{ asset('/UPManifest_Report_PDF') }}" target="_blank" class="btn btn-warning" style="color:white;margin-right:10px">Download PDF</a></li>

	<!-- <li><a href="{{ asset('/UPManifest_Report_Excel') }}" class="btn btn-success" style="color:white;margin-right:10px">Download Excel</a></li> -->

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
                    <th>MIS Report</th>	
					<th>Order No</th>
                    <th>Name</th>
                    <th>Email</th>
					<th>Mobile</th>
                    <th>Address</th>
					<th>City</th>
                    <th>State</th>
					<th>Pincode</th>
                    <th>Product Name</th>
                    <th>Product Qlty</th>
                    <th>Product COD</th>
                    <th>Product Value</th>
                    <th>Product Additional</th>
					<th>Weight</th>
                    <th>Amount</th>
                    <th>Shop Address</th>
                    <th>Courier Name</th>
                    <th>Rider</th>
                    <!-- <th>Shipping Label</th> -->
                    <th>status</th>
				</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($params as $param)
					<tr class="gradeX">
                        <td>{{ $param->awb_no }}</td>

						<td>
    @foreach($courierapids as $courierapid)
    @if($param->awb_no==$courierapid->awb_tracking_id)
        <a href="{{ $courierapid->manifest_link }}" target="_black" class="btn btn-info" download="">MIS Report</a>
    @endif
    @endforeach
                        </td>

                        <td>{{ $param->orderno }}</td>
                        <td>{{ ucwords($param->cname) }}</td>
						<td>{{ $param->cemail }}</td>
                        <td>{{ $param->cmobile }}</td>
                        <td>{{ $param->caddress }}</td>
                        <td>{{ $param->ccity }}</td>
                        <td>{{ $param->cstate }}</td>
						<td>{{ $param->cpin }}</td>
                        <td><span>{{ $param->itemname }}</span></td>
                        <td>{{ $param->itemquantity }}</td>
                        <td>{{ $param->itmecodamt }}</td>
                        <td>{{ $param->iteminvoicevalue }}</td>
                        <td>{{ $param->additionaldetails }}</td>
						<td>{{ $param->pweight }}</td>
                        <td><span>{{ $param->ptamt }}</span></td>
						<td>
@foreach($Hubs as $Hub)
    @if($Hub->hub_id==$param->hub_id)
        {{ ucwords($Hub->hub_name) }}<br>
        {{ ucwords($Hub->hub_address1) }}<br>
        {{ ucwords($Hub->hub_city) }}<br>
        {{ ucwords($Hub->hub_pincode) }}
    @endif
@endforeach                  
                        </td>
                        <td>{{ ucwords($param->courier_name) }}</td>
                        <td>
@foreach($allriders as $allrider)
    @if($allrider->id==$param->order_riderid)
        {{ ucwords($allrider->name) }}<br>
        {{ ucwords($allrider->mobile) }}
    @endif
@endforeach
                        </td>
						<!-- <td>
						    @foreach($courierapids as $courierapid)
						    @if($param->awb_no==$courierapid->awb_tracking_id)
						        <a href="{{ $courierapid->manifest_link_pdf }}" target="_black" class="btn btn-info">Check Label</a>
						    @endif
						    @endforeach
                        </td> -->
                        <td>
						    @foreach($courierapids as $courierapid)
						        @if($param->awb_no==$courierapid->awb_tracking_id)
						            {{ $courierapid->current_status_type }}
						        @endif
						    @endforeach
                        </td>

                       
					</tr>
				@php($i++)
				@endforeach
			</tbody>
		</table>
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



