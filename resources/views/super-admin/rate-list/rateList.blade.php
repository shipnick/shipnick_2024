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
                            <li class="breadcrumb-item"><a href="#!">Default Courier Rate List</a></li>
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
                        <h5>Default Courier Rate List</h5>
                        <span class="d-block m-t-5">All Courier list and admin list</span>
                        <div class="card-header-right m-2">
                            
                            <button onclick="window.history.back()" class="btn btn-primary">Back</button>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Courier Name</th>
                                        <th>WITHIN CITY <br><span>(zone A)</span> </th>
                                        <th>WITHIN STATE <br><span>(zone B)</span></th>
                                        <th>METRO TO METRO <br><span>(zone C)</span></th>
                                        <th>REST OF INDIA <br><span>(zone D)</span></th>
                                        <th>NORTH EAST, J&K <br><span>(zone E)</span></th>
                                        <th>COD CHARGES</th>
                                        <th>COD %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($param as $param)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$param->courier_name}}</td>
                                        <td>{{$param->fwda}}</td>
                                        <td>{{$param->fwdb}}</td>
                                        <td>{{$param->fwdd}}</td>
                                        <td>{{$param->fwde}}</td>
                                        <td>{{$param->fwdf}}</td>
                                        <td>{{$param->fwdg}}</td>
                                        <td>{{$param->fwdh}}<span>%</span></td>
                                    </tr>
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