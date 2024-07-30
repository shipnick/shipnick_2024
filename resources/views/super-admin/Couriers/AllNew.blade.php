@extends('super-admin.Layout')

@section('bodycontent')



<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manage Courier
                            <center>

                                @if(session('status')=="New Client Added")
                                <span class="text-primary" style="font-size:20px;">
                                    New client added
                                </span>
                                @elseif(session('status'))
                                <span class="text-primary" style="font-size:20px;">
                                    {{ session('status') }}
                                </span>
                                @endif
                            </center>
                        </h4>

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
                                        
                                        <td> <a href="model_new_data/{{ $param ->name }}" class="btn btn-outline-primary">admin</a></td>

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
    
   
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
@endsection