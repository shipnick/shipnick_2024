@extends('Admin.Layout')

@section('bodycontent')

<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Not Picked Orders</h3>
</div>
<div class="col-auto">
<!-- <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Upload NDR</a>
<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Download NDR</a> -->
<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
<i class="fas fa-filter"></i>
</a>
</div>
</div>
</div>
<div id="add_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Upload Orders</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="form-group">
<label>Upload orders via excel file<span class="text-danger">*</span></label>
</div>
<div class="form-group">
<label>Sample file is available for download<span class="text-danger">*</span></label>
</div>
<div class="form-group">
<label>Please remove sample data before proceed<span class="text-danger">*</span></label>
</div>
<div class="form-group">
<label>Upload (Excel file) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">Click below</a></label>
<label class="custom-file-container__custom-file">
<input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<span class="custom-file-container__custom-file__custom-file-control"></span>
</label>
</div>
<div class="submit-section">
<button class="btn btn-primary submit-btn">Upload</button>
 </div>
</form>
</div>
</div>
</div>
</div>
<div id="filter_inputs" class="card filter-card" style="display:block;">
<div class="card-body pb-0">

<form method="post" action="{{ asset('/All_Orders_Uploaded') }}">
<div class="row">
<!-- <div class="col-md-2">
<div class="form-group">
<label>Search filter</label>
<select class="select">
<option>Order ID</option>
<option>Customer Name</option>
<option>Delivery Company</option>
<option>Status</option>
</select>
</div>
</div> -->

<div class="col-md-2">
<div class="form-group">
<label>Delivery Mode</label>
<select class="select" name="mode">
<option value="0">All</option>
<option value="cod">COD</option>
<option value="prepaid">Prepaid</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Couriers(All)</label>
<select class="select" name="courier">
<option value="0">All</option>
<option value="Delhivery">Delhivery</option>
<option value="Xpressbees">Xpressbees</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>From</label>
<div class="cal-icon">
<input class="form-control datetimepicker" name="from" type="text">
</div>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>To</label>
<div class="cal-icon">
<input class="form-control datetimepicker" name="to" type="text">
</div>
</div>
</div>
<div class="col-md-2"><br>
<div class="form-group">
    @csrf
    <button class="btn btn-primary">Search</button>
</div>
</div>

</div>
</form>

</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table id="custom_datatable">
<thead class="thead-light">
  <tr>
      <th>AWB No</th>
      <th>Order No</th>
      <th>Courier Name</th>
      <th>Customer Name</th>
      <th>Client Name</th>
      <th>Client Mobile</th>
      <th>Client Address</th>
      <th>Destination Pincode</th>
      <th>COD Amt</th>
      <th>Upload Date</th>
      <th>Current Status</th>
      <!-- <th>Change Status</th> -->
  </tr>
</thead>
<tbody>
  @php($i = 1)
  @foreach($params as $param)
		<tr class="gradeX">
		  <td>{{ $param->Awb_Number }}</td>
		  <td>{{ $param->orderno }}</td>
		  <td>{{ $param->awb_gen_by }}</td>
		  <td>
		      @foreach($allusers as $alluser)
		          @if($alluser->id == $param->User_Id)
		              {{ $alluser->name }}
		          @endif
		      @endforeach
		  </td>
		  <td>{{ $param->Name }}</td>
		  <td>{{ $param->Mobile }}</td>
		  <td>{{ $param->Address }}</td>
		  <td>{{ $param->Pincode }}</td>
		  <td>{{ $param->Cod_Amount }}</td>
		  <td>{{ $param->Rec_Time_Date }}</td>
		  <td>
@if($param->Awb_Number != '' && $param->order_status_show == "Upload")
Picking Soon
@elseif($param->order_status_show == "Cancel")
{{ $param->order_status_show }}ed
@elseif($param->order_status_show == "Unexpected")
Unknown Error
@elseif($param->order_status_show == "Upload")
Not Picked
@else
{{ $param->order_status_show }}
@endif


</td>
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
