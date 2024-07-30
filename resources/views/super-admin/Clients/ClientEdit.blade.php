@extends('super-admin.Layout')
@section('bodycontent')
<div class="content container-fluid">

    <div class="page-header">
        <div class="row my-5">
            <div class="col-sm-12">
                <h3 class="page-title">Edit Admin Details
                    <span style="float:right;margin-right:5%;"><a href="{{ asset('/super-all-admin') }}" class="btn btn-danger">Back</a></span>
                </h3>
            </div>
        </div>
    </div>

    @if(session('status')=="Admin details updated")
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Information</h4>



                    <form method="post" action="{{ asset('/super-new-admin-edit-update') }}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* Company Name</label>
                                    <input type="text" name="companyname" value="{{ $params->name }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>* Mobile</label>
                                    <input type="number" name="mobile" value="{{ $params->mobile }}" class="form-control" required>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* Email / Username</label>
                                    <input type="email" name="email" value="{{ $params->username }}" class="form-control" readonly>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company Logo</label>
                                    <input type="file" name="profilepic" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>* Password</label>
                                    <!-- <input type="password" name="password" value="{{ $params->companyname }}" class="form-control" required> -->
                                    <div class="pass-group">
                                        <input type="password" name="password" value="{{ $params->password }}" class="form-control pass-input" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="text-end mt-4">
                                    @csrf
                                    <input type="hidden" name="customerid" value="{{ $params->id }}">
                                    <button type="submit" class="btn btn-primary" style="width:100%">Update Admin Details</button>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                    </form>







                </div>
            </div>
        </div>
    </div>
</div>


@endsection