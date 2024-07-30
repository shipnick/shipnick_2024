@extends('RiderPanel.Layout_1')

@section('bodycontent')
@php(error_reporting(1))
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>All Pending Order</h2>
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
					<th>Order Status</th>
					<th>PickUp Date</th>
					<th>Product Name</th>
					<th>Client Name</th>
					<th>Client Mobile</th>
					<th>Destination City</th>
					<th>Destination Pincode</th>
					<th>COD Amt</th>
					<th>Payment Mode</th>
					<th>Delivery Date</th>
					<th>Attempt Count</th>
					<th>Courier Name</th>
					<th>Courier Remark</th>
					<th>Last Status Date</th>
					<th>RTO Date</th>
					<th>RTO Reason</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($params as $param)
					<tr class="gradeX">
						<td>{{ $param->awb_no }}</td>
						<td>{{ $param->orderno }}</td>
						<td>
<a onclick="showModal{{ $param->orderid }}({{ $param->orderid }})">
	{{ $param->order_status }}
</a>
						</td>
						<td>
							<?php
								$date=date_create("$param->order_start_date");
								echo date_format($date,"d-m-Y");
							?>
						</td>
						<td>{{ $param->itemname }}</td>
						<td>{{ $param->cname }}</td>
						<td>{{ $param->cmobile }}</td>
						<td>{{ $param->ccity }}</td>
						<td>{{ $param->cpin }}</td>
						<td>{{ $param->itmecodamt }}</td>
						<td>{{ $param->order_payment_mode }}</td>
						<td>{{ $param->order_delivery_date }}</td>
						<td>{{ $param->order_rider_atmpt }}</td>
						<td>{{ $param->courier_name }}</td>
						<td>{{ $param->order_status_remark }}</td>
						<td>
							<?php
								$date=date_create("$param->last_status_date");
								echo date_format($date,"d-m-Y H:i a");
							?>
						</td>
						<td>
							<?php
								if($param->rto_date)
								{
									$date=date_create("$param->rto_date");
									echo date_format($date,"d-m-Y");
								}
							?>
						</td>
						<td>{{ $param->order_cancel_reasion }}</td>
						<td>
<a onclick="showModal{{ $param->orderid }}({{ $param->orderid }})" class="btn btn-primary">Update Status</a>
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
          		Update Delivery Report
          </b></h4>
        </div>
<div class="modal-body">
<div class="container-fluid">
<style type="text/css">
.modelwith{	width: inherit;	}
#remarkpanel{{ $param->orderid }} {  display: none;	}
#completemark{{ $param->orderid }} {  display: none;	}
#cancelremark{{ $param->orderid }} {  display: none;	}
#pendingremark{{ $param->orderid }} {  display: none;	}
#rtoreason{{ $param->orderid }} {  display: none;	}
#orderremarkcancel{{ $param->orderid }} {  display: none;	}
#orderremarkcomplete{{ $param->orderid }} {  display: none;	}
#orderremarkpending{{ $param->orderid }} {  display: none;	}
</style>
<form method="post" action="{{ asset('/RPPending_Order_Update') }}">
          <div class="col-md-12">
        	<div class="col-md-6">
        		<label><b>AWB No</b></label> : {{ $param->awb_no }} <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          	<div class="col-md-6">
        		<label><b>Order No</b></label> : {{ $param->orderno }} <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          </div>
          <div class="col-md-12">
        	<div class="col-md-6">
        		<label><b>Client Name</b></label> : {{ ucwords($param->cname) }}<br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          	<div class="col-md-6">
        		<label><b>Client Mobile</b></label> : {{ $param->cmobile }} <br>
        		<!-- <input type="text" name="awbno" class="form-control modelwith" value=""> -->
        	</div>
          </div>
         <!--  <div class="col-md-12">
        	<div class="col-md-6">
        		<label><b>Delivery Date</b></label> : {{ date('d-m-Y') }} 
        		<b>(If Status Complete)</b><br>
        	</div>
          	<div class="col-md-6">
        		<label><b>Attempt Count</b></label> : {{ $param->order_rider_atmpt }} <br>
        	</div>
          </div> -->
          <div class="col-md-12">
        	<div class="col-md-6">
        		<select class="form-control" name="orderstatus" id="orderstatus{{ $param->orderid }}"  onchange="showorderstatus{{ $param->orderid }}({{ $param->orderid }})" required="">
        			<option value="">Order Status</option>
        			<option value="Complete">Complete</option>
        			<option value="Cancel">Return/ Cancel/ Undelivered</option>
        			<option value="Pending">Pending/ Progress</option>
        			<!-- <option value="Progress">Progress</option> -->
        		</select>

        	</div>
          	<div class="col-md-6">
<!-- Cancel Reason -->
        		<select class="form-control" name="orderstatus11" id="orderremarkcancel{{ $param->orderid }}">
<option value="">Select Undelivered Remarks</option>

<option value="Danger Goods (danger goods)">
Danger Goods (danger goods)</option>
<option value="Undelivered (consignee shifted)">
Undelivered (consignee shifted)</option>
<option value="Undelivered (Consignee refused to accept)">
Undelivered (Consignee refused to accept)</option>
<option value="Undelivered (no such consignee at given address)">
Undelivered (no such consignee at given address)</option>
<option value="Undelivered (Shipment misroute)">
Undelivered (Shipment misroute)</option>
<option value="Undelivered (Consignee requested for future delivery)">
Undelivered (Consignee requested for future delivery)</option>
<option value="Undelivered (cod amount not ready)">
Undelivered (cod amount not ready)</option>
<option value="Undelivered (delivery area not accessible)">
Undelivered (delivery area not accessible)</option>
<option value="Undelivered (residence/office closed)">
Undelivered (residence/office closed)</option>
<option value="Lost (shipment lost)">
Lost (shipment lost)</option>
<option value="RTO Initiated (rto initiated)">
RTO Initiated (rto initiated)</option>
<option value="Shipment Damage (shipment damage)">
Shipment Damage (shipment damage)</option>
<option value="Undelivered (consignee out of station)">
Undelivered (consignee out of station)</option>
<option value="Undelivered (entry restricted)">
Undelivered (entry restricted)</option>
<option value="Undelivered (shipment lost)">
Undelivered (shipment lost)</option>
<option value="Pickup Cancel By Client (pickup cancel by client)">
Pickup Cancel By Client (pickup cancel by client)</option>
<option value="Undelivered (shipment snatch by customer)">
Undelivered (shipment snatch by customer)</option>
<option value="Undelivered (Shipment damaged)">
Undelivered (Shipment damaged)</option>
<option value="Undelivered (dangerous goods)">
Undelivered (dangerous goods)</option>
<option value="Undelivered (consignee not responding)">
Undelivered (consignee not responding)</option>
<option value="Undelivered (consignee wants open delivery)">
Undelivered (consignee wants open delivery)</option>
        		</select>
<!-- Cancel Reason -->
<!-- Complete Reason -->
        		<select class="form-control" name="orderstatus12" id="orderremarkcomplete{{ $param->orderid }}">
<option value="">Select Complete Remarks</option>

<option value="Delivered (Shipment delivered)">
Delivered (Shipment delivered)</option>
<option value="Out For Delivery (out for delivery)">
Out For Delivery (out for delivery)</option>
In-Transit (in-transit)</option>
<option value="RTO Delivered (rto delivered)">
RTO Delivered (rto delivered)</option>
<option value="Order Placed (order)">
Order Placed (order)</option>

        		</select>
<!-- Complete Reason -->
<!-- Pending/Progress Reason -->
        		<select class="form-control" name="orderstatus13" id="orderremarkpending{{ $param->orderid }}">
<option value="">Select Pending Remarks</option>

<option value="Pickup Done (pickup done)">
Pickup Done (pickup done)</option>
<option value="RTO Initiated (rto initiated)">
RTO Initiated (rto initiated)</option>
<option value="Out For Delivery (out for delivery)">
Out For Delivery (out for delivery)</option>
<option value="In-Transit (in-transit)">
In-Transit (in-transit)</option>
<option value="RTO Delivered (rto delivered)">
RTO Delivered (rto delivered)</option>
        		</select>
<!-- Pending/Progress Reason -->
        	</div>
          </div>
<!-- Complete -->
<div class="col-md-12" id="completemark{{ $param->orderid }}"><br>
<div class="col-md-12">
	<div class="col-md-6">
		<label><b>Delivery Date</b></label> : <b>{{ date('d-m-Y') }}</b> <br>
	</div>
	<div class="col-md-6">
		<select name="paymentmode" class="form-control">
			<option value="">Select Method</option>
			<option value="Online">Online</option>
			<option value="COD">COD</option>
			<option value="Card">Card</option>
			<option value="UPI">UPI</option>
		</select>
	</div>
	<input type="text" name="completemark" class="form-control" placeholder="Complete (If Any Notes)">
</div>
</div>
<div class="col-md-12" id="cancelremark{{ $param->orderid }}"><br>
<div class="col-md-12">
	<input type="text" name="cancelremark" class="form-control" placeholder="Cancel /Return /Undelivered (If Any Notes)">
</div>
</div>
<div class="col-md-12" id="pendingremark{{ $param->orderid }}"><br>
<div class="col-md-12">
	<input type="text" name="pendingremark" class="form-control" placeholder="Pending/ Progress (If Any Notes)">
</div>
</div>

<div class="col-md-12" id="rtoreason{{ $param->orderid }}">
<!-- <br><div class="col-md-12">
	<label><b>Return/Cancel Date</b></label> : {{ date('d-m-Y') }} <br>
	<input type="text" name="rtoreason" class="form-control" placeholder="RTO Reason">
</div> -->
</div>
<!-- Complete -->
<!-- Cancel -->
          <div class="col-md-12" id="remarkpanel{{ $param->orderid }}"><br>
          <div class="col-md-12">
          	<input type="text" name="remarkpanelifany" class="form-control" placeholder="Remark If Any">
		  </div>
		  </div>
<!-- Cancel -->

          <div class="col-md-12 text-center"> <br>
          	<input type="hidden" name="orderid" value="{{ $param->orderid }}">
          	@csrf
        	<button type="submit" class="btn btn-success"> Update Delivery Details</button>
        	<!-- {{ $param->order_rider_atmpt }} -->
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
function  showorderstatus{{ $param->orderid }}(param)
{
	var a = $("#orderstatus{{ $param->orderid }}").val();
	if(a=="Complete")
	{
document.getElementById("completemark{{ $param->orderid }}").style.display = "block";
document.getElementById("cancelremark{{ $param->orderid }}").style.display = "none";
document.getElementById("pendingremark{{ $param->orderid }}").style.display = "none";
document.getElementById("rtoreason{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkcomplete{{ $param->orderid }}").style.display = "block";
document.getElementById("orderremarkcancel{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkpending{{ $param->orderid }}").style.display = "none";
	}else if(a=="Cancel")
	{
document.getElementById("completemark{{ $param->orderid }}").style.display = "none";
document.getElementById("cancelremark{{ $param->orderid }}").style.display = "block";
document.getElementById("pendingremark{{ $param->orderid }}").style.display = "none";
document.getElementById("rtoreason{{ $param->orderid }}").style.display = "block";
document.getElementById("orderremarkcomplete{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkcancel{{ $param->orderid }}").style.display = "block";
document.getElementById("orderremarkpending{{ $param->orderid }}").style.display = "none";
	}else if(a=="Pending")
	{
document.getElementById("completemark{{ $param->orderid }}").style.display = "none";
document.getElementById("cancelremark{{ $param->orderid }}").style.display = "none";
document.getElementById("pendingremark{{ $param->orderid }}").style.display = "block";
document.getElementById("rtoreason{{ $param->orderid }}").style.display = "block";
document.getElementById("orderremarkcomplete{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkcancel{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkpending{{ $param->orderid }}").style.display = "block";
	}else
	{
document.getElementById("completemark{{ $param->orderid }}").style.display = "none";
document.getElementById("cancelremark{{ $param->orderid }}").style.display = "none";
document.getElementById("pendingremark{{ $param->orderid }}").style.display = "none";
document.getElementById("rtoreason{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkcomplete{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkcancel{{ $param->orderid }}").style.display = "none";
document.getElementById("orderremarkpending{{ $param->orderid }}").style.display = "none";
	}
	// alert(a);
}
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



