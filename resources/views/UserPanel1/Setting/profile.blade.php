@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')




<style>
    .profile-cover-avatar input[type="file"] {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: -1;
    opacity: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(19,33,68,.25);
    border-radius: 50%;
    transition: .2s;
}
</style>
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="page-title">Settings</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2 col-md-4">

            <div class="widget settings-menu">
                <ul >
                    <li class="nav-item">
                        <a href="{{ asset('/setting') }}" class="nav-link active btn btn-primary">
                            <i class="far fa-user"></i> <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ asset('/financial-details') }}" class="nav-link  btn btn-primary">
                            <i class="far fa-list-alt"></i> <span>Financial Details</span>
                        </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ asset('/billing-information') }}" class="nav-link  btn btn-primary">
                            <i class="far fa-check-square"></i> <span>Billing Information</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item my-2">
                        <a href="" class="nav-link  btn btn-primary">
                            <i class="far fa-bell"></i> <span>KYC Details</span>
                        </a>
                    </li> -->

                    <li class="nav-item my-2">
                        <a href="{{ asset('/courier-permissions') }}" class="nav-link  btn btn-primary">
                            <i class="fa fa-signal"></i> <span>Courier Permissions</span>
                        </a>
                    </li>


                    <li class="nav-item my-2">
                        <a href="{{ asset('/change-password') }}" class="nav-link  btn btn-primary">
                            <i class="fas fa-unlock-alt"></i> <span>Change Password</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-9 col-md-8">


            @if(session('status')=="Profile update successfully")
            <section class="comp-section" id="returnmsgbox">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </section>
            @elseif(session('status'))
            <section class="comp-section" id="returnmsgbox">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </section>
            @endif


            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basic information</h5>
                </div>

                <div class="card-body">


                    <form method="post" action="{{ asset('/setting') }}" enctype="multipart/form-data">
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 col-form-label input-label">Profile Pic</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <label class="avatar avatar-xxl profile-cover-avatar m-0" for="edit_img">
                                        @if($params->profilepic)
                                        <img id="avatarImg" class="avatar-img" src="{{ asset('/Profiles') }}/{{ $params->username }}/{{ $params->profilepic }}" alt="{{ $params->name }}" height="100px">
                                        @else
                                        <img id="avatarImg" class="avatar-img" src="assets/img/profiles/avatar-01.png" alt="{{ $params->name }}" height="100px" style="border-radius:20px">
                                        @endif

                                        <!-- <input type="file" name="profilepic"> -->
                                        <!-- <input type="file" id="edit_img" name="profilepic">
                                        <span class="avatar-edit">
                                            <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                        </span> -->
                                        <input type="file" id="edit_img" name="profilepic" >
                                        <span class="avatar-edit"  >
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 avatar-uploader-icon shadow-soft">
    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" ></path></svg>
</span>
                                        
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 col-form-label input-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ $params->name }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="email" class="col-sm-3 col-form-label input-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $params->username }}" readonly="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="phone" class="col-sm-3 col-form-label input-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" placeholder="+x(xxx)xxx-xx-xx" value="{{ $params->mobile }}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="addressline1" class="col-sm-3 col-form-label input-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addressline1" placeholder="Your address" value="{{ $params->address1 }}">
                            </div>
                        </div>
                        <!--<div class="row form-group">-->
                        <!--<label for="addressline2" class="col-sm-3 col-form-label input-label">Address 2 <span class="text-muted">(Optional)</span></label>-->
                        <!--<div class="col-sm-9">-->
                        <!--<input type="text" class="form-control" name="addressline2" placeholder="Your address" value="{{ $params->address2 }}">-->
                        <!--</div>-->
                        <!--</div>-->
                        <div class="row form-group">
                            <label for="zipcode" class="col-sm-3 col-form-label input-label">Zip code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="zipcode" placeholder="Your zip code" value="{{ $params->pincode }}">
                            </div>
                        </div>
                        <div class="text-end">
                            @csrf
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection