@extends('Admin.Layout')
@section('bodycontent')
<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">New Courier
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



<form method="post" action="{{ asset('/courier-new') }}" enctype="multipart/form-data">
<div class="row">
<div class="col-md-3">
    <div class="form-group">
    <label>* Courier Name</label>
    <input type="text" name="couriername" class="form-control" required>
    </div>
 </div>
<div class="col-md-3">
    <div class="form-group">
    <label>* Email</label>
    <input type="email" name="email" class="form-control" required>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
    <label>* Company Logo</label>
    <input type="file" name="profilepic" class="form-control" required>
    </div>
</div>
<div class="col-md-3"><br>
    <div class="form-group">
        @csrf
        <button type="submit" class="btn btn-primary">Add Courier</button>
    </div>
</div>
</div>

</form>







</div>
</div>
</div>
</div>
</div>


@endsection
