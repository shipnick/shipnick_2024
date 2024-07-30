@extends('super-admin.Layout')

@section('bodycontent')



<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Admin  list 
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