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
                            <!-- <h5 class="m-b-10">API Assign Admin-Wise</h5> -->
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Admin list</a></li>
                            <li class="breadcrumb-item"><a href="#!">API Assign Admin-Wise</a></li>
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
                        <h5>API Assign Admin-Wise</h5>
                        <span class="d-block m-t-5"> Admin list</span>
						<div class="card-header-right m-2">
                            <a href="/super-all-admin" class="btn btn-primary">back</a>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                    <h6> {{$crtusers->name}}</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Courier</th>
                                        <th>Active/Deactive Status</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach($params as $courier)
                                    <tr class="gradeX">
                                        <td>
                                            
                                            <img src="/logo/courier/{{$courier->logo}}" alt="" style="width:70px;">
                                            <b style="color: {{ $crtusers[$courier->name] ? 'green' : 'red' }}"> - <b>{{ $courier->name }}
                                               
                                               
                                        </td>
                                        <td>
                                            <form action="{{ asset('super-courier-assign-updated') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="courname" value="{{ $courier->name }}">
                                                <input type="hidden" name="clientidisause" value="{{ $crtusers->id }}">
                                                <button class="btn btn-{{  $crtusers[$courier->name]  ? 'warning' : 'success' }}">
                                                    {{  $crtusers[$courier->name] ? 'Deactive' : 'Active' }}
                                                </button>
                                            </form>
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
