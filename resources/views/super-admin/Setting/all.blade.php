@extends('super-admin.Layout')

@php(error_reporting(1))
@section('bodycontent')





<div class="content container-fluid">
<div class="page-header">
<div class="row">
<div class="col-sm-6">
<h3 class="page-title">Client Details </h3>
</div>
<div class="col-sm-6">
<span style="float:right"><a href="{{ asset('/All_Client') }}" class="btn btn-danger">Back</a></span>
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
<!-- <li class="nav-item">
<a href="{{ asset('/client-change-password/'.$id) }}" class="nav-link">
<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
</a>
</li> -->
</ul>
</div>

</div>
<div class="col-xl-9 col-md-8">

<div class="card">
<div class="card-header">
<h5 class="card-title">Basic information</h5>
</div>
<div class="card-body">

<!-- <form> -->
<div class="row form-group">
<label for="name" class="col-sm-3 col-form-label input-label">Name</label>
<div class="col-sm-9">
<div class="d-flex align-items-center">
<label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">

@if($params->profilepic)
    <img id="avatarImg" class="avatar-img" src="{{ asset('/Profiles') }}/{{ $params['username'] }}/{{ $params['profilepic'] }}" alt="{{ $params['name'] }}">
@else
    <img id="avatarImg" class="avatar-img" src="{{ asset('assets/img/profiles/avatar-01.png') }}" alt="Profile Image">
@endif

<!--<input type="file" id="edit_img">-->
<!--<span class="avatar-edit">-->
<!--<i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>-->
<!--</span>-->
</label>
</div>
</div>
</div>
<div class="row form-group">
<label for="name" class="col-sm-3 col-form-label input-label">Name</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="name" placeholder="Your Name" value="{{ $params['name'] }}">
</div>
</div>
<div class="row form-group">
<label for="email" class="col-sm-3 col-form-label input-label">Email</label>
<div class="col-sm-9">
<input type="email" class="form-control" id="email" placeholder="Email" value="{{ $params['username'] }}">
</div>
</div>
<div class="row form-group">
<label for="phone" class="col-sm-3 col-form-label input-label">Mobile</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="phone" placeholder="+x(xxx)xxx-xx-xx" value="{{ $params['mobile'] }}">
</div>
</div>
<div class="row form-group">
<label for="addressline1" class="col-sm-3 col-form-label input-label">Address</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="addressline1" placeholder="Your address" value="{{ $params['address1'] }}">
</div>
</div>
<!-- <div class="row form-group">
<label for="addressline2" class="col-sm-3 col-form-label input-label">Address 2 <span class="text-muted">(Optional)</span></label>
<div class="col-sm-9">
<input type="text" class="form-control" id="addressline2" placeholder="Your address">
</div>
</div> -->
<div class="row form-group">
<label for="zipcode" class="col-sm-3 col-form-label input-label">Zip code</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="zipcode" placeholder="Your zip code" value="{{ $params['pincode'] }}">
</div>
</div>
<div class="text-end">
<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
</div>
<!-- </form> -->

</div>
</div>
</div>
</div>
</div>


@endsection


