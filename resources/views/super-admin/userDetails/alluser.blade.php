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
                            <li class="breadcrumb-item"><a href="#!"> All Clients Details</a></li>
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
                        <h5>Clients Details</h5>

                        <span class="d-block m-t-5"> Clients Details</span>
                        <div class="card-header-right m-2">
                            <a class="btn btn-primary" href="">Back</a>
                        </div>

                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Email-Id</th>
                                        


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($user as $param)
                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <td>{{ $param->name }}</td>
                                        <td>{{ $param->username }}</td>
                                        
                                        

                                        <td>
                                            <a href="{{url('user-details')}}/{{ $param->id }}" class="btn btn-primary">user Details</a>
                                            
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
            <!-- [ stiped-table ] end -->

        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>

@endsection