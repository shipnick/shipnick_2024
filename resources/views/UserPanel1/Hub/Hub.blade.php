@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')





<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Hub Details
                        </h4>
                        <div class="text-right">
                            <a href="{{ asset('/UPNew_Hub') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add Hub
                            </a>

                        </div>
                        @if(session('status')=="Hub Details Delete Successfully")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status'))
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @endif

                        <div class="table-responsive my-2" >
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sno</th>
                                        <th>Hub Code</th>
                                        <th>Logo</th>
                                        <th>Hub Name</th>
                                        <th>GST No.</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Pincode</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Delivery Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($params as $param)
                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                       <?php if($param->smartship_hubid==""){ ?>
                                            <td class="text-danger">Invalid Details</td>
                                            <?php }elseif($param->smartship_hubid=="R"){ ?>
                                                <td class="text-danger">Invalid Details</td>
                                                <?php  }else{ ?>
                                        <td>{{ $param->hub_code }}</td>
                                        <?php }  ?>
                                        <td><img src="{{ asset('HubDetails') }}/{{ $param->hub_folder }}/{{ $param->hub_img }}" title="Hub Image" alt="Not Available" style="width:50px;height:50px;"></td>
                                        <td>{{ $param->hub_name }}</td>
                                        <td>{{ $param->hub_gstno }}</td>
                                        <td>{{ $param->hub_address1 }}</td>
                                        <td>{{ $param->hub_mobile }}</td>
                                        <td>{{ $param->hub_pincode }}</td>
                                        <td>{{ $param->hub_state }}</td>
                                        <td>{{ $param->hub_city }}</td>
                                        <td>{{ $param->hub_deliverytype }}</td>
                                        <td>
                                            <a href="{{ asset('/UPHub_Edit/'.$param->hub_id) }}" title="Click here to edit hub detail"><i class="far fa-edit me-2"></i>Edit</a>
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


    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
        </div>
    </footer>

</div>

@endsection