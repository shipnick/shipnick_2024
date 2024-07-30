@extends('super-admin.Layout')
@section('bodycontent')

<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Merchant Summary
<center>
    
    @if(session('status')=="New Client Added")
    <span class="text-primary" style="font-size:20px;">
        New client added
    </span>
    @elseif(session('status'))
    <span class="text-primary" style="font-size:20px;">
        {{ session('status') }}
    </span>
    @endif
</center>
</h3>
</div>
<div class="col-auto">
<!-- <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">+ New Client</a> -->

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
<!--            <div class="col-md-12">
                <input type="text" name="password" class="form-control" placeholder="Password" required="">
            </div> -->
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




<div id="filter_inputs" class="card filter-card" style="display:block;">
<div class="card-body pb-0">

<form method="post" action="{{ asset('/merchant-summary') }}">
<div class="row">

<div class="col-md-2"></div>
<div class="col-md-2"></div>
<div class="col-md-2"></div>

<div class="col-md-2">
<div class="form-group">
<label>From</label>
<div class="cal-icon">
<input class="form-control datetimepicker" name="startdatefrom" type="text">
</div>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label>To</label>
<div class="cal-icon">
<input class="form-control datetimepicker" name="enddatefrom" type="text">
</div>
</div>
</div>

<div class="col-md-2">
<div class="form-group"><br>
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
<table class="table table-stripped table-hover datatable">
<thead class="thead-light">
<tr>
    <th>Merchant Name</th>
    <th>Total Orders</th>
</tr>
</thead>
<tbody>
@php($totalno=0)
@for($i=0; $i < $totalusers; $i++) 
    <tr class="gradeX">
        <td>{{ ucwords($params[$i]['username']) }}</td>
        <td>{{ ucwords($params[$i]['totalno']) }}</td>
    </tr>
    @php($totalno = $totalno+$params[$i]['totalno'])
@endfor
</tbody>
<tfoot>
    <tr>
        <th>Total Orders</th>
        <th>{{ $totalno }}</th>
    </tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


@endsection
