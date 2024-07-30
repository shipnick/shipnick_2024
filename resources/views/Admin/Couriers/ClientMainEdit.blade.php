@extends('Admin.Layout')
@section('bodycontent')
<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Edit Courier
<span class="text-primary" style="float:right;font-size:18px">{{ session('status') }}</span>
</h3>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<h4 class="card-title">Basic Info</h4>



<form method="post" action="{{ asset('/courier-edit') }}" enctype="multipart/form-data">
<div class="row">
<div class="col-md-6">
    <div class="form-group">
    <label>* Email</label>
    <input type="email" name="email" class="form-control" value="{{ $params->email }}" readonly>
    </div>
    <div class="form-group">
    <label>* Courier Name</label>
    <input type="text" name="couriername" class="form-control" value="{{ $params->name }}" required>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <label>* Company Logo</label><br>
    <img src="{{ asset('/Couriers') }}/{{ $params->email }}/{{ $params->logo }}" style="width:110px">
    <input type="file" name="profilepic" class="form-control">
    </div>
</div>
<div class="row"><br>
<div class="col-md-3"></div>
<div class="col-md-6">
    <div class="form-group">
        @csrf
        <input type="hidden" name="courieridis" value="{{ $params->courierid }}">
        <button type="submit" class="btn btn-primary">Update Courier</button>
    </div>
</div>
<div class="col-md-3"></div>
</div>
</div>

</form>







</div>
</div>
</div>
</div>
</div>


@endsection
