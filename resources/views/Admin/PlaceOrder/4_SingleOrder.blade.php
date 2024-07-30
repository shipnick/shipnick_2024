@extends('Admin.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Single Order</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<li><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;margin-right:10px">Add New Order</a></li>
	</ol>
	<!-- <a class="sidebar-right-toggle">	</a> -->
</div>
</header>
<!-- Heading -->

<!-- Add New Record Through Model -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <!--  -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Single Order Product Details</h4>
      <!--  -->
      </div>
      <div class="modal-body">
      <!--  -->
      <form method="POST" action="{{ asset('/Single_Product_Add') }}">
        <div class="row">
        	<div class="col-md-6">
        		Customer Name <br>
        		<input type="text" name="cname" class="form-control">
        	</div>
        	<div class="col-md-6">
        		Customer Address <br>
        		<input type="text" name="caddress" class="form-control">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-6">
        		Customer State  <br>
        		<input type="text" name="cstate" class="form-control">
        	</div>
        	<div class="col-md-6">
        		Customer City  <br>
        		<input type="text" name="ccity" class="form-control">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-6">
        		Customer Mobile  <br>
        		<input type="number" maxlength="12" minlength="10" name="cmobile" class="form-control">
        	</div>
        	<div class="col-md-6">
        		Customer Pin  <br>
        		<input type="number" name="cpin" class="form-control">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-6">
        		Actual Weight <br>
        		<input type="number" name="ActualWeight" class="form-control">
        	</div>
        	<div class="col-md-6">
        		Total Amount <br>
        		<input type="number" name="TotalAmount" class="form-control">
        	</div>
        </div>
        <hr>
        <center><h3>Item Details</h3></center>
        <br>
        <div class="row">
        	<div class="col-md-6">
        		<input type="text" name="ItemName" class="form-control" placeholder="Item Name">
        	</div>
        	<div class="col-md-6">
        		<input type="number" name="Quantity" class="form-control" placeholder="Quantity">
        	</div>
        </div>
        <div class="row"><br>
        	<div class="col-md-6">
        		<input type="number" name="CODAmount" class="form-control" placeholder="COD Amount">
        	</div>
        	<div class="col-md-6">
        		<input type="text" name="InvoiceValue" class="form-control" placeholder="Invoice Value">
        	</div>
        </div>
        <div class="row"><br>
        	<div class="col-md-6">
        		<select class="form-control" name="AdditionalDetails">
        			<option value="">Additional Details</option>
        			<option value="Dengerous Good">Dengerous Good</option>
        			<option value="Extra Care">Extra Care</option>
        		</select>
        	</div>
        	<div class="col-md-6">
        		@csrf
        		<button class="btn btn-success">Add This Order Details</button>
        	</div>
        </div>
      </form>
      <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- //Add New Record Through Model -->


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
					<th>Sr.No.</th>
					<th>Name</th>
					<th>Mobile</th>
					<th>Pincode</th>
					<th>Address</th>
					<th>Weight</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($params as $param)
					<tr class="gradeX">
						<td>{{ $i }}</td>
						<td>{{ $param->cname }}</td>
						<td>{{ $param->cmobile }}</td>
						<td>{{ $param->cpin }}</td>
						<td>{{ $param->caddress }}</td>
						<td>{{ $param->pweight }}</td>
						<td>{{ $param->ptamt }}</td>
					</tr>
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



