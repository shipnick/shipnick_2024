@extends('UserPanel.Layout_1')

@section('bodycontent')

<?php
    error_reporting(1);
?>
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Single Order</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/UserPanel') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<li><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;margin-right:10px">Add New Single Order</a></li>
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
        <h4 class="modal-title" style="color:black"><b>Add Single Order Details</b></h4>
      <!--  -->
      </div>
      <div class="modal-body">
      <!--  -->
      <form method="POST" action="{{ asset('/UPSingle_Product_Add') }}">
        <center><h4 style="color:black"><b>Client Details</b></h4></center>
        <div class="row">
        	<div class="col-md-6">
        		<input type="text" name="cname" class="form-control" placeholder="Client Name *" required="">
        	</div>
        	<div class="col-md-6">
        		<input type="text" maxlength="12" minlength="10" name="cmobile" class="form-control" placeholder="Client Mobile *" required="">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-6"><br>
                <input type="text" name="cemail" class="form-control" placeholder="Client Email"><br>
        		<input type="text" name="cstate" class="form-control" placeholder="Client State">
        	</div>
        	<div class="col-md-6"><br>
        		<!-- <input type="text" name="caddress" class="form-control" placeholder="Client Address"> -->
                <textarea name="caddress" placeholder="Client Address *" class="form-control" rows="4" required=""></textarea>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-6"><br>
                <input type="text" name="ccity" class="form-control" placeholder="Client City">
        	</div>
        	<div class="col-md-6"><br>
        		<input type="number" name="cpin" class="form-control" placeholder="Client Pin *" min="1" minlength="6" required="">
        	</div>
        </div>
        <!--  -->
        <hr>
        <center><h4 style="color:black"><b>Order Details</b></h4></center>
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="ItemName" class="form-control" placeholder="Product/Order Name *" required="">
            </div>
            <!-- <div class="col-md-6">
                <input type="text" name="orderno" class="form-control" placeholder="Product/Order ID *" required="">
            </div> -->
        </div>
        <div class="row"><br>
            <div class="col-md-6">
                 <input type="text" list="browsers" name="hubid" placeholder="Hub ID *" class="form-control" autocomplete="off" required="">
                <datalist id="browsers">
                    @foreach($Hubs as $Hub)
                        <option value="{{ ucwords($Hub->hub_id) }}">
                    @endforeach
                </datalist>
            </div>
            <div class="col-md-6">
                <input type="number" name="Quantity" class="form-control" placeholder="Quantity *" min="1" required="">
            </div>
        </div>
        <div class="row"><br>
        	<div class="col-md-6">
        		<input type="number" name="CODAmount" class="form-control" placeholder="COD Amount *" min="1" required="">
        	</div>
        	<div class="col-md-6">
        		<input type="text" name="InvoiceValue" class="form-control" placeholder="Invoice Value * " required="">
        	</div>
        </div>
        <div class="row"><br>
            <div class="col-md-6">
                <input type="number" name="ActualWeight" class="form-control" placeholder="Actual Weight (In KG)" min="1" required="">
            </div>
            <div class="col-md-6">
                <input type="number" name="TotalAmount" class="form-control" placeholder="Total Amount" min="1" required="">
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
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="lenth" class="form-control" pattern="[0-9]+" placeholder="Lenth">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="breadth" class="form-control" pattern="[0-9]+" placeholder="Breadth">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="height" class="form-control" pattern="[0-9]+" placeholder="Height">
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <hr>
        <center><h4 style="color:black"><b>Order Delivery Type</b></h4></center>
        <div class="row">
@if(session('UserLogin2ridershow'))
            <div class="col-md-6">
                <input list="browsers1" name="ridername" id="ridername" class="form-control" autocomplete="off" placeholder="Select Rider To Delivery">
                <datalist id="browsers1">
                @foreach($allriders as $allrider)
                    <option value="{{ $allrider->name }}">
                @endforeach
                </datalist>
            </div>
@endif

            <div class="col-md-6">
                <select class="form-control" name="couriertype" placeholder="Courier Type">

                    <option value="">Select Courier Type</option>
                    <!-- <option value="BigShip">BigShip</option> -->
@if($crtuserdetails->Pickrr)
    <option value="Pickrr">ShipXpress(P)</option>
@endif
@if($crtuserdetails->XpressBee)
    <option value="XpressBee">ShipXpress(X)</option>
@endif
@if($crtuserdetails->BigShip)
    <option value="BigShip">ShipXpress(B)</option>
@endif
@if($crtuserdetails->SmartShip)
    <option value="SmartShip">ShipXpress(S)</option>
@endif
                    <!-- <option value="Pickrr">Pickrr</option> -->
                </select>
            </div>
        </div>
        <!--  -->
        <div class="row"><br>
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                @csrf
                <button class="btn btn-success">Add This Order Details</button>
            </div>
            <div class="col-md-3"></div>
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
        <th>Date_Time</th>
        <th>AWB_No</th>
		<th>Order_No</th>
        <th>Name</th>
        <th>Email</th>
		<th>Mobile</th>
        <th>Address</th>
		<th>City</th>
        <th>State</th>
		<th>Pincode</th>
        <th>Product_Name</th>
        <th>Product_Qlty</th>
        <th>Product_COD</th>
        <th>Product_Value</th>
        <th>Product_Additional</th>
		<th>Weight</th>
        <th>Amount</th>
        <th>Shop_Address</th>
        <th>Courier_Name</th>
        <th>Last_Update</th>
        <th>Shipping_Label</th>
        <th>status</th>
        <th>Action</th>
	</tr>
</thead>
<tbody>
	@php($i = 1)
	@foreach($params as $param)
		<tr class="gradeX">
            <td>{{ $param->orderdata }}</td>
            <td>
                @if($param->awb_no)
                    <a href="{{ asset('/TrackOrder1/'.$param->awb_no) }}" target="_blank">{{ $param->awb_no }}</a>
                @endif
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
            <td>{{ ucwords($param->courier_name_show) }}</td>

            <td>{{ $param->last_status_date }}</td>
			<td>
@if($param->courier_name)


<a href="{{ asset('/UPProduct_Receipt/'.$param->orderid) }}" target="_black" class="btn btn-info">Check Receipt</a>
@else
<a href="{{ asset('/UPProduct_Receipt/'.$param->orderid) }}" target="_black" class="btn btn-info">Check Receipt</a>
@endif
            </td>
            <td>

@if($param->order_status1)
<span style="color:#3f7cc7"><b>{{ $param->order_status1 }}</b></span>
@else
<span style="color:#3f7cc7"><b>Pending</b></span>
@endif


            </td>
            <td class="text-center">
@if($param->order_status=="Upload")
<a href="{{ asset('/UPAll_Delete_Orders/'.$param->orderid) }}" title="Delete">
<i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i>
</a>
@else
<form method="post" action="{{ asset('/UPAll_Cancel_Orders_Now_API') }}">
<input type="hidden" name="awbtrackid" value="{{ $param->awb_no }}">
<input type="hidden" name="orderid" value="{{ $param->orderid }}">
<input type="hidden" name="orderno" value="{{ $param->orderno }}">
<input type="hidden" name="couriernameshow" value="{{ $param->courier_name_show }}">
<input type="hidden" name="couriername" value="{{ $param->courier_name }}">
@csrf
<button class="btn btn-danger">Cancel</button>

</form>
@endif
            </td>
		</tr>
<!-- Ship This Order -->
<div id="myModal{{ $param->orderid }}" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-body">
<!--  -->
<form method="POST" action="{{ asset('/UPSingle_Product_Add_ShipOrder') }}">
<center><h4 style="color:black"><b>Shipping Order #{{ $param->orderid }} </b></h4></center>
<div class="row text-center">
    
@if(session('UserLogin2ridershow'))
<div class="col-md-6">
    <input list="browsers1" name="ridername" id="ridername" class="form-control" autocomplete="off" placeholder="Select Rider To Delivery">
    <datalist id="browsers1">
    @foreach($allriders as $allrider)
        <option value="{{ $allrider->name }}">
    @endforeach
    </datalist>
</div>
@endif

<div class="col-md-6">
    <select class="form-control" name="couriertype" placeholder="Courier Type">
        <option value="">Select Courier Type</option>
@if($crtuserdetails->Pickrr)
<option value="Pickrr">ShipXpress(P)</option>
@endif
@if($crtuserdetails->XpressBee)
<option value="XpressBee">ShipXpress(X)</option>
@endif
@if($crtuserdetails->BigShip)
<option value="BigShip">ShipXpress(B)</option>
@endif
    </select>
</div>
</div>
<!--  -->
<div class="row"><br>
<div class="col-md-3"></div>
<div class="col-md-6 text-center">
    <input type="hidden" name="crtid" value="{{ $param->orderid }}">
    @csrf
    <button class="btn btn-success">Ship This Order</button>
</div>
<div class="col-md-3"></div>
</div>
</form>
<!--  -->
</div>

</div>
</div>
</div>
<!-- Ship This Order -->
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





<!-- Extra -->
<style type="text/css">
/*body{
    color:black !important;
}*/
</style>
<!-- Extra -->