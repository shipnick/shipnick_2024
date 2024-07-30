@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


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
                <ul>
                    <li class="nav-item">
                        <a href="{{ asset('/setting') }}" class="nav-link  btn btn-primary">
                            <i class="far fa-user"></i> <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ asset('/financial-details') }}" class="nav-link  btn btn-primary">
                            <i class="far fa-list-alt"></i> <span>Financial Details</span>
                        </a>
                    </li>
                    <li class="nav-item my-2">
                        <a href="{{ asset('/billing-information') }}" class="nav-link active  btn btn-primary">
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

            @if(session('status')=="Billing detail add successfully")
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
                                @foreach($params as $param)
                                <tr>
                                    <td>{{ $param->billaddress }}</td>
                                    <td>{{ $param->billcity }}</td>
                                    <td>{{ $param->billstate }}</td>
                                    <td>{{ $param->billpincode }}</td>
                                </tr>
                                @endforeach
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ asset('/billing-information') }}">
                        <div class="form-group">
                            <label>Address<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="address" required="">
                        </div>
                        <div class="form-group">
                            <label>City<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="city" required="">
                        </div>
                        <div class="form-group">
                            <label>State<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="state" required="">
                        </div>
                        <div class="form-group">
                            <label>Pincode<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="pincode" required="">
                        </div>
                        <div class="submit-section">
                            @csrf
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