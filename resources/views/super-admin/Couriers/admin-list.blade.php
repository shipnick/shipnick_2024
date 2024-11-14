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
                            <li class="breadcrumb-item"><a href="#!">Manage Courier</a></li>
                            <li class="breadcrumb-item"><a href="#!">Admin list</a></li>
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
                        <h5>All Admins</h5>
                        <span class="d-block m-t-5"> Admin list</span>
						
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="50%">
                                            admin Name
                                        </th>
                                        <th>
                                            Mobile No
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($intargos as $post)
                                    <tr>
                                        <td>
                                            {{ $post->name }}
                                        </td>
                                        <td>
                                            {{ $post->mobile }}
                                        </td>

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