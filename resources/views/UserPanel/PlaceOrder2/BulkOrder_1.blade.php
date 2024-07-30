@extends('UserPanel.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Bulk Orders</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/UserPanel') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<li><a href="{{ asset('/UPProduct_Receipt_Bulk') }}" target="_black" class="btn btn-warning" style="color:white;margin-right:10px">All Orders Shipping Labels</a></li>

	<li><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;margin-right:10px">Add New Bulk Orders</a></li>
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
        <h4 class="modal-title text-center" style="color:black"><b>Add Bulk Orders Product Details</b></h4>
      <!--  -->
      </div>
      <div class="modal-body">
      <!--  -->
      <form method="POST" action="{{ asset('/UPBulk_Order_Add') }}" enctype="multipart/form-data">
        <div class="row"><br>
        	<div class="col-md-6">
        		<input type="file" name="bulkorders" class="form-control" required="">
        	</div>
        	<div class="col-md-6">
        		@csrf
        		<button class="btn btn-success">Upload Bulk Orders</button>
        	</div>
        </div>
        <div class="row"><br>
        	<center>
                <a href="{{ asset('SampleExcel/SampleBulk_Order_With_Data.csv') }}" download=""><b>Download Sample File With Entry </b></a>
                &ensp;&ensp;
        		<a href="{{ asset('SampleExcel/SampleBulk_Orders_Without_Data.csv') }}" download=""><b>Download Sample File Without Entry</b></a>
        	</center>
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
						<th>AWB No</th>
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
						<!-- <th>Rider</th> -->
						<th>Last_Update</th>
						<th>Shipping Label</th>
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
                        <!-- <td>
@foreach($allriders as $allrider)
    @if($allrider->id==$param->order_riderid)
        {{ ucwords($allrider->name) }}<br>
        {{ ucwords($allrider->mobile) }}
    @endif
@endforeach
                        </td> -->
                        <td>{{ $param->last_status_date }}</td>
						<td>
@if($param->courier_name)

    <!-- @foreach($courierapids as $courierapid)
    @if($param->awb_no==$courierapid->awb_tracking_id)
        <a href="{{ $courierapid->manifest_link_pdf }}" target="_black" class="btn btn-info">Check Label</a>
    @endif
    @endforeach -->
    <a href="{{ asset('/UPProduct_Receipt/'.$param->orderid) }}" target="_black" class="btn btn-info">Check Receipt</a>
@else
    <a href="{{ asset('/UPProduct_Receipt/'.$param->orderid) }}" target="_black" class="btn btn-info">Check Receipt</a>
    <!-- <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{ $param->orderid }}" style="color:white;margin-right:10px">Ship Order</a> -->
@endif
                        </td>
                        <td>

@if($param->order_status1)
    <span style="color:#2a5bb3"><b>{{ $param->order_status1 }}</b></span>
@else
    <span style="color:#2a5bb3"><b>Pending</b></span>
@endif


<!-- @if($param->order_status=="Pending")
<span style="color:blue"><b>{{ $param->order_status }}</b></span>
@elseif($param->order_status=="Progress")
<span style="color:blue"><b>{{ $param->order_status }}</b></span>
@elseif($param->order_status=="Complete")
<span style="color:green"><b>{{ $param->order_status }}</b></span>
@elseif($param->order_status=="Cancel")
<span style="color:orange"><b>{{ $param->order_status }}</b></span>
@else
<span style="color:gray"><b>{{ $param->order_status }}</b></span>
@endif -->
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
    <!-- <a href="{{ asset('/UPAll_Cancel_Orders_Now/'.$param->orderid) }}" title="Cancel">
        <i class="fa fa-times" aria-hidden="true" style="color:red"></i>
    </a> -->
    </form>
@endif
                        </td>
					</tr>
<!-- Ship This Order -->
<div id="myModal{{ $param->orderid }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- <div class="modal-header"> -->
      <!--  -->
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black"><b>Add Single Order Details</b></h4> -->
      <!--  -->
      <!-- </div> -->
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
                    <option value="BigShip">BigShip</option>
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
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
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
