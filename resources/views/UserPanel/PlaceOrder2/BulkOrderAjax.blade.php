@extends('UserPanel.Layout_1')
<section>

<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel panel-primary">

    <header class="panel-heading">
    	<div class="panel-actions">
    		<a href="{{ asset('/UPProduct_Receipt_Bulk') }}" title="Click here to download today shipping labels" target="_black" class="btn btn-warning" style="color:white;width:auto;height:35px;background-color:#5BC0DE !important;border-color:#5BC0DE !important"><i class="fa fa-download" aria-hidden="true"></i> Labels</a>
    		<a href="#" title="Click here to upload bulk orders" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="color:white;width:auto;height:35px;background-color:#47A447 !important"><i class="fa fa-plus" aria-hidden="true"></i> Bulk Orders</a>
    	</div>
    	<h2 class="panel-title">Bulk Orders Upload Details</h2>
    </header>

<div class="panel-body">
<div class="row">
<!--  -->
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">
			<thead>
				<tr>
						<th>Date_Time</th>
						<th>Label</th>
						<th>AWB_No</th>
						<th>Order_No</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Address</th>
						<th>City</th>
						<th>State</th>
						<th>Pincode</th>
						<th>Product_Name</th>
						<th>Product_Qlty</th>
						<th>Product_COD</th>
						<th>Product_Value</th>
						<th>Additional</th>
						<th>Weight</th>
						<th>Amount</th>
						<th>Pickup_Address</th>
						<th>Last_Update</th>
						<th>status</th>
						<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php

// print_r($params);

 ?>
@php($i = 1)
@foreach($params as $param)
<tr class="gradeX">
		<td>{{ $param->Rec_Time_Date }}</td>
		<td>
			@if($param->Awb_Number)
				<a href="{{ asset('/UPProduct_Receipt/'.$param->Single_Order_Id) }}" target="_black" class="btn" style="border-color:#FF4800;color:#FF4800">Download</a>
			@endif
		</td>
		<td>{{ $param->Awb_Number }}</td>
		<td>
<?php
			if(!empty($param->orderno)){
				$strtoidis = substr($param->orderno,0,5);
				if($strtoidis=="RPDX0"){
						echo $param->orderno;
				}
			}
?>
		</td>
		<td>{{ ucwords($param->Name) }}</td>
		<td>{{ $param->Mobile }}</td>
		<td>{{ $param->Address }}</td>
		<td>{{ $param->City }}</td>
		<td>{{ $param->State }}</td>
		<td>{{ $param->Pincode }}</td>
		<td><span>{{ $param->Item_Name }}</span></td>
		<td>{{ $param->Quantity }}</td>
		<td>{{ $param->Cod_Amount }}</td>
		<td>{{ $param->Invoice_Value }}</td>
		<td>{{ $param->additionaltype }}</td>
		<td>{{ $param->Actual_Weight }}</td>
		<td><span>{{ $param->Total_Amount }}</span></td>
		<td>
				<!-- @foreach($Hubs as $Hub)
				@if($Hub->hub_id==$param->hub_id)
				{{ ucwords($Hub->hub_name) }}<br>
				{{ ucwords($Hub->hub_address1) }}<br>
				{{ ucwords($Hub->hub_city) }}<br>
				{{ ucwords($Hub->hub_pincode) }}
				@endif
				@endforeach -->
				{{ ucwords($param->pickup_address) }}
    </td>
    <td>{{ $param->Last_Stamp_Date }}</td>
    <td>
	@if($param->order_status_show == "Cancel")
		{{ $param->order_status_show }}ed
	@elseif($param->order_status_show == "Unexpected")
        Unknown Error
	@elseif($param->order_status_show == "Upload")
		Not Picked
	@else
		{{ $param->order_status_show }}
	@endif
</td>
		<td>


@if($param->order_cancel != '1')
	@if($param->Awb_Number)
	<!-- <span style="color:red;cursor:pointer" onclick="cancelorder{{ $param->Awb_Number }}({{ $param->Awb_Number }})">Cancel</span> -->
	<?php
			if(!empty($param->orderno)){
				$strtoidis = substr($param->orderno,0,5);
				if($strtoidis=="RPDX0"){
	?>
		<a href="{{ asset('/BulkOrderDeletesmannual') }}/{{ $param->orderno }}" style="color:red;cursor:pointer">Cancel</a>
	<?php
				}
			}
	?>
	@endif
@endif

			<!-- <script type="text/javascript">
			function cancelorder{{ $param->Awb_Number }}(awbnoi){
					alert(awbnoi);
			    // alert(orderni);
			    $.ajax({
			        type:"GET",
			        url:"{{ asset('/BulkOrderDelete') }}",
			        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			        data:{awbnoi:awbnoi,orderni:orderni},
			        success:function(data){
			            // console.log(data);
			            // alert('data');
			            // $("#updatedlabel{{ $param->orderid }}").html(data);
			            // location.reload();
			            alert('work');
			        }
			    });
			}
			</script> -->
		</td>

    <!-- <td class="text-center">
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
      </td> -->
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
