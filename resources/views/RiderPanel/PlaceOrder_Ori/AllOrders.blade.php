@extends('RiderPanel.Layout_1')

@section('bodycontent')
@php(error_reporting(1))
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>All Order</h2>
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

<!-- <select class="form-control" id="crtorder" onchange="orderstatus{{ $param->orderid }}({{ $param->orderid }})" style="width:100px"> -->
<a onclick="showModal{{ $param->orderid }}({{ $param->orderid }})" class="btn btn-primary">Update Status
	
</a>
<!-- <select class="form-control" id="crtorder" onchange="showModal{{ $param->orderid }}({{ $param->orderid }})" style="width:100px">

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
</select> -->
						</td>
					</tr>
<script type="text/javascript">
function showModal{{ $param->orderid }}(param) {
  // $('#myModal').modal('show');
  $("#myModal{{ $param->orderid }}").modal('show');
}

function orderstatus{{ $param->orderid }}(param)
{
	// alert(param);
	var paramval = $("#crtorder").val();
	// $("#myModal{{ $param->orderid }}").modal('show');
	// alert(a);
	$.ajax({
		type:"POST",
		url:"/RPPending_Order_Change",
	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data:{param:param,paramval:paramval},
		success:function(data){
			// console.log(data);
			// location.reload();
			// alert('work');
		}
	});
}
</script>
<!-- Action PopUp -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
  <div class="modal fade" id="myModal{{ $param->orderid }}" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center" style="color:black"><b>
          		Update Delivery Report {{ $param->orderid }}
          </b></h4>
        </div>
<div class="modal-body">
<div class="container-fluid">
<style type="text/css">
.modelwith{	width: inherit;	}
#remarkpanel{{ $param->orderid }} {  display: none;	}
</style>
<form method="post" action="{{ asset('/RPPending_Order_Update') }}">
          <div class="col-md-12">
        	<div class="col-md-6">
        		<label><b>AWB No</b></label> : 0 <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          	<div class="col-md-6">
        		<label><b>Order No</b></label> : 0 <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          </div>
          <div class="col-md-12">
        	<div class="col-md-6">
        		<label><b>Customer Name</b></label> :  {{ $param->cname }}<br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          	<div class="col-md-6">
        		<label><b>Customer Mobile</b></label> : {{ $param->cmobile }} <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          </div>
          <div class="col-md-12">
        	<div class="col-md-6">
        		<label><b>Delivery Date</b></label> : {{ $param->orderdata }} <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          	<div class="col-md-6">
        		<label><b>Attempt Count</b></label> : {{ $param->order_rider_atmpt }} <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          </div>
          <div class="col-md-12">
        	<div class="col-md-6">
        		<select class="form-control" name="orderstatus" required="">
        			<option value="">Order Status</option>
        			<option value="Complete">Complete</option>
        			<option value="Cancel">Return/Cancel</option>
        			<option value="Pending">Pending</option>
        			<option value="Progress">Progress</option>
        		</select>
        	</div>
          	<div class="col-md-6">
        		<select class="form-control" id="orderremark{{ $param->orderid }}" name="orderremark" onchange="showremarkpage{{ $param->orderid }}({{ $param->orderid }})">
<option value="">Order Remark</option>
<option value="Defective Product">Defective Product</option>
<option value="Duplicate Product">Duplicate Product</option>
<option value="Other Issues">Other Issues</option>
        		</select>
        	</div>
          </div>
<!--  -->
          <div class="col-md-12" id="remarkpanel{{ $param->orderid }}"><br>
          <div class="col-md-12">
          	<input type="text" name="remarkpanelifany" class="form-control" placeholder="Remark If Any">
		  </div>
		  </div>
<!--  -->
          <div class="col-md-12 text-center"> <br>
          	<input type="hidden" name="orderid" value="{{ $param->orderid }}">
          	@csrf
        	<button type="submit" class="btn btn-success">Update Delivery Details</button>
          </div>
</form>
</div>
</div>

<!-- <div class="modal-footer">
</div> -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>

      </div>
      <!--  -->
    </div>
  </div>
<script type="text/javascript">
function  showremarkpage{{ $param->orderid }}(param)
{
	var a = $("#orderremark{{ $param->orderid }}").val();
	if(a=="Other Issues")
	{
		document.getElementById("remarkpanel{{ $param->orderid }}").style.display = "block";
	}else
	{
		document.getElementById("remarkpanel{{ $param->orderid }}").style.display = "none";
	}
	// alert(a);
}
</script>
<!-- Action PopUp -->
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



