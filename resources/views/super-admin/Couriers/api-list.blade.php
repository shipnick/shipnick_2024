@extends('super-admin.Layout')

@section('bodycontent')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Status Switch Code -->
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 17px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(13px);
            -ms-transform: translateX(13px);
            transform: translateX(13px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 17px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .table td img {
            border-radius: 0px;
        }
    </style>
    <!-- Status Switch Code -->

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">API Assign Admin-Wise</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Courier</th>
                                            <th>Active/Deactive Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(['EcomExpress', 'Xpressbees', 'bluedart','Xpressbees2','Bluedart-sc'] as $courier)
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

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rate List Admin-Wise</h4>
                            <a href="{{ url('add-rate', ['id' => $crtusers->id]) }}" class="btn btn-primary">Add Rate List</a>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Courier</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($params1 as $post)
                                            <tr>
                                                <td>{{ $post->courier_name }} {{ $post->weight }}</td>
                                                <td>
                                                    <a href="{{ url('edit-rate', ['id' => $post->id]) }}">Edit</a>
                                                    <a href="{{ url('rate-delete', ['id' => $post->id]) }}">Delete</a>
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
