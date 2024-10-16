@extends('super-admin.Layout2')

@php(error_reporting(1))
@section('bodycontent')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pincode</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap border-0 pb-0">
                        <div class="me-auto mb-sm-0 mb-3">
                            <h4 class="card-title mb-2">Admins Details</h4>
                            <!-- <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span> -->
                        </div>

                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Email-Id</th>
                                        <th>Mobile</th>
                                        <th>Password</th>
                                        <th>Toatla User</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($params as $param)
                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <td>{{ $param->name }}</td>
                                        <td>{{ $param->username }}</td>
                                        <td>{{ $param->mobile }}</td>
                                        <td>{{ $param->password }}</td>
                                        <td>{{ $userCounts[$param->id] }}</td> <!-- Display user count for the specific admin -->
                                        <td>
                                           <a href="admin-user-list/{{ $param->id }}" class="btn btn-primary">users</a>
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
</div>




@endsection