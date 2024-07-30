@extends('super-admin.Layout')
@section('bodycontent')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admin Registration</h4>
                        @if(session('status')=="New Admin added")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
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
                        <p class="card-description">
                            New Admin Minimum Informations
                        </p>
                        <form class="forms-sample" action="{{ asset('/super-new-admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">* Company Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" name="companyname">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">* Email / Username</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                            </div>
                            <div class="form-group">
                                <label>Company Logo</label>
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info"  name="profilepic" disabled>
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">* Mobile</label>
                                <input type="number" class="form-control" id="exampleInputConfirmPassword1" name="mobile">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">* Password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                            </div>
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <!-- <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div> -->
    </footer>
    <!-- partial -->
</div>


@endsection
