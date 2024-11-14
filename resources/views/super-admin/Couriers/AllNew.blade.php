@extends('super-admin.Layout')

@section('bodycontent')


<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <!-- <h5 class="m-b-10">Bootstrap Basic Tables</h5> -->
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Super-Admin</a></li>
                            <li class="breadcrumb-item"><a href="#!">Manage Courier</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            
            <!-- [ stiped-table ] start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Courier</h5>
                        <span class="d-block m-t-5">All Courier list and admin list</span>

                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            S. No.
                                        </th>
                                        <th>
                                            Courier Name
                                        </th>
                                        <th>
                                            Email ID
                                        </th>
                                        <th>
                                            Logo
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Admins
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($params as $param)
                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <td>{{ $param->name }}</td>
                                        <td>{{ $param->email }}</td>
                                        <td>
                                            <img src="{{ asset('/Couriers') }}/{{ $param->email }}/{{ $param->logo }}" style="width:50px">
                                        </td>
                                        <td>{{ $param->date }}</td>
                                        
                                        <td> <a href="model_new_data/{{ $param ->name }}" class="btn btn-primary">admin</a></td>

                                    </tr>
                                    @php($i++)
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ stiped-table ] end -->
           
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
@endsection