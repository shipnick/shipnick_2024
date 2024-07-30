@extends('Admin.Layout')

@section('bodycontent')
<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">All Clients
	@if(session('status')=="New Client Added")
	<span style="color:green;font-size:14px;">
		{{ session('status') }}
	</span>
	@elseif(session('status'))
	<span style="color:green;font-size:14px;">
		{{ session('status') }}
	</span>
	@endif
</h3>
</div>
<div class="col-auto">
<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">+ New Client</a>
<!--<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">-->
<!--<i class="fas fa-filter"></i>-->
<!--</a>-->
</div>
</div>
</div>



<div id="add_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Create new client account</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
      <form method="POST" action="{{ asset('/New_Client') }}">
        <!-- <center><h3>Item Details</h3></center> -->
        <br>
        	<div class="col-md-12">
        		<input type="text" name="name" class="form-control" placeholder="Name" required="">
        	</div><br>
        	<div class="col-md-12">
        		<input type="email" name="email" class="form-control" placeholder="Email" required="">
        	</div><br>
        	<div class="col-md-12">
        		<input type="number" name="mobile" class="form-control" placeholder="Mobile" required="">
        	</div><br>
        	<!--<div class="col-md-12">-->
        	<!--	<input type="text" name="password" class="form-control" placeholder="Password" required="">-->
        	<!--</div>-->
            <div class="pass-group">
                <input type="password" name="password" class="form-control pass-input" placeholder="Password">
                <span class="fas fa-eye toggle-password"></span>
            </div>
        	<br>
        <div class="col-md-12 text-center"><br>
        	<div class="col-md-12">
        		@csrf
                <button class="btn btn-primary submit-btn">Upload</button>
        	</div>
            <br><br>
        </div>
      </form>

</div>
</div>
</div>
</div>




<div id="filter_inputs" class="card filter-card">
<div class="card-body pb-0">
<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>Search filter</label>
<select class="select">
<option>AWB Number</option>
<option>Customer Name</option>
<option>Order ID</option>
<option>Product Details</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>NDR Status</label>
<select class="select">
<option>Customer Wants Open Delivery Package</option>
<option>Customer Refused</option>
<option>Customer Not Available</option>
<option>Cash Not Available</option>
<option>Customer Out of Station</option>
<option>Door Locked</option>
<option>Door Locked</option>
<option>No Such Customer but Address correct</option>
<option>Out of Delivery Area(ODA)</option>
<option>Requested Delay Delivery</option>
<option>Restricted Entry</option>
<option>Self Collection Requested By Customer</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Delivery By</label>
<select class="select">
<option>InTargos</option>
<option>Nimbus</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Delivery Mode</label>
<select class="select">
<option>COD</option>
<option>Prepaid</option>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-stripped table-hover datatable">
<thead class="thead-light">
<tr>
	<th>S.No.</th>
	<th>Name</th>
	<th>Email</th>
	<th>Mobile</th>
	<!-- <th>Password</th> -->
	<th>Status</th>
	<!--<th>Action</th>-->
</tr>
</thead>
<tbody>
@php($i = 1)
@foreach($params as $param)
<tr class="gradeX">
    <td>{{ $i }}</td>
    <td>{{ $param->name }}</td>
    <td>{{ $param->username }}</td>
    <td>{{ $param->mobile }}</td>
    <!-- <td>{{ $param->password }}</td> -->
    <td>
        @if($param->status)
            <span style="color:green">Active</span>
        @else
            <span style="color:red">Deactive</span>
        @endif
    </td>
    <!--<td>-->
    <!--	<a title="Click here to edit client details" href="{{ asset('/New_Client_Edit/'.$param->id) }}"><i class="far fa-edit me-2"></i></a>-->
    <!--</td>-->
</tr>
@php($i++)
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


@endsection

