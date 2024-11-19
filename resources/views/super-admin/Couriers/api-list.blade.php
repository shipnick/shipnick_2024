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
                            <h5 class="m-b-10">Bootstrap Basic Tables</h5>
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
						
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Courier</th>
                                        <th>Active/Deactive Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(['EcomExpress', 'Xpressbees', 'bluedart','Xpressbees2','Xpressbees3','Bluedart-sc','DTDC'] as $courier)
                                        <tr class="gradeX">
                                            <td>
                                                <img src="{{ asset('Couriers/' . strtolower($courier) . '@gmail.com/' . strtolower($courier) . '.png') }}" style="width:50px;height:50px">
                                                <b style="color: {{ $crtusers->$courier ? 'green' : 'red' }}"> - {{ $courier }}</b>
                                            </td>
                                            <td>
                                                <form action="{{ asset('super-courier-assign-updated') }}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="courname" value="{{ $courier }}">
                                                    <input type="hidden" name="clientidisause" value="{{ $crtusers->id }}">
                                                    <button class="btn btn-{{ $crtusers->$courier ? 'warning' : 'success' }}">
                                                        {{ $crtusers->$courier ? 'Deactive' : 'Active' }}
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
