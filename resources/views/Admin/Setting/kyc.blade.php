@extends('Admin.Layout')

@php(error_reporting(1))
@section('bodycontent')




<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-6">
<h3 class="page-title">Settings</h3>
</div>
</div>
</div>

<div class="row">
<div class="col-xl-3 col-md-4">

<div class="widget settings-menu">
<ul>
<li class="nav-item">
<a href="{{ asset('/client-setting/'.$id) }}" class="nav-link active">
<i class="far fa-user"></i> <span>Profile Settings</span>
</a>
</li>
<li class="nav-item">
<a href="{{ asset('/client-financial-details/'.$id) }}" class="nav-link">
<i class="far fa-list-alt"></i> <span>Financial Details</span>
</a>
</li>
<li class="nav-item">
<a href="{{ asset('/client-billing-information/'.$id) }}" class="nav-link">
<i class="far fa-check-square"></i> <span>Billing Information</span>
</a>
</li>
 <li class="nav-item">
<a href="" class="nav-link">
<i class="far fa-bell"></i> <span>KYC Details</span>
</a>
</li>

<li class="nav-item">
<a href="{{ asset('/client-courier-permissions/'.$id) }}" class="nav-link">
<i class="fa fa-signal"></i> <span>Courier Permissions</span>
</a>
</li>
<li class="nav-item">
<a href="{{ asset('/client-change-password/'.$id) }}" class="nav-link">
<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
</a>
</li>
</ul>
</div>

</div>
<div class="col-xl-9 col-md-8">
<div class="card card-table">
<div class="card-header">
<div class="row">
<div class="col">
<h5 class="card-title">Billing Information</h5>
</div>
<div class="col-auto">
<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Add Billing Information</a>
</div>
</div>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover mb-0">
<thead class="thead-light">
<tr>
<th>Address </th>
<th>City</th>
<th>State</th>
<th>Pin Code</th>
</tr>
</thead>
<tbody>
<tr>
<td>ABC</td>
<td>New Delhi</td>
<td>Delhi</td>
<td>110001</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<div id="add_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Billing Information</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="form-group">
<label>Address<span class="text-danger">*</span></label>
<input class="form-control" type="text">
</div>
<div class="form-group">
<label>City<span class="text-danger">*</span></label>
<input class="form-control" type="text">
</div>
<div class="form-group">
<label>State<span class="text-danger">*</span></label>
<select class="select">
<option>Delhi</option>
<option>Haryana</option>
</select>
</div>
<div class="form-group">
<label>Pincode<span class="text-danger">*</span></label>
<input class="form-control" type="text">
</div>
<div class="submit-section">
<button class="btn btn-primary submit-btn">Submit</button>
 </div>
</form>
</div>
</div>
</div>
</div>


<div id="edit_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Tax</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="form-group">
<label>Tax Name <span class="text-danger">*</span></label>
<input class="form-control" value="VAT" type="text">
</div>
<div class="form-group">
<label>Tax Percentage (%) <span class="text-danger">*</span></label>
<input class="form-control" value="14%" type="text">
</div>
<div class="form-group">
<label>Status <span class="text-danger">*</span></label>
<select class="select">
<option>Active</option>
<option>Inactive</option>
</select>
</div>
<div class="submit-section">
<button class="btn btn-primary submit-btn">Save</button>
</div>
</form>
</div>
</div>
</div>
</div>


<div class="modal custom-modal fade" id="delete_tax" role="dialog">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-body">
<div class="modal-icon text-center mb-3">
<i class="fas fa-trash-alt text-danger"></i>
</div>
<div class="modal-text text-center">
<h2>Delete Tax</h2>
<p>Are you sure want to delete?</p>
</div>
</div>
<div class="modal-footer text-center">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary">Delete</button>
</div>
</div>
</div>
</div>

</div>

@endsection


