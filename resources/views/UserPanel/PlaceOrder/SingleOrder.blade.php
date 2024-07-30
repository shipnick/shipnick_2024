@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent') 








<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Single Orders</h3> <span style="font-size:14px;color:#29326A !important">* Today upload only</span>
                        <!-- <p class="card-description">
                    Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.
                  </p> -->
                        @if(session('status')=="File uploaded successfully. Please wait 1min file is
                        processing")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status')=="File uploaded successfully.")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status')=="Order delete please refresh page if not deleted")
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
                        <div class="text-right">


                            <a href="{{ asset('/today-failed-orders') }}/Single" target="_black" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure download Failed orders?')">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Failed Orders
                            </a>

                            <a href="{{ asset('/today-placed-orders') }}/Single" target="_black" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure download placed orders?')">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Placed Orders
                            </a>



                        </div>
                        <form method="post" action="{{ asset('/UPSingle_Product') }}">
                            <div class="row">

                                <div class="colmd-6"></div>


                                <div class="form-group col-md-2">
                                    <label for="exampleFormControlSelect3">Hubs(All) </label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                        <option>ALL</option>
                                        @foreach($Hubs as $Hub)
                                        <option value="{{ $Hub->hub_id  }}">{{ $Hub->hub_code  }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-2">

                                    <label for="exampleFormControlSelect3">Delivery Mode </label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                        <option>ALL</option>
                                        <option>COD</option>
                                        <option>Prepaid</option>

                                    </select>
                                </div>
                                <div class="form-group my-4">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mr-0">Search</button>
                                </div>
                                <!-- <input type="submit" name="" class="btn btn-primary"> -->


                            </div>
                        </form>





                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Label</th>
                            <th>AWB No</th>
                            <th>Courier Name</th>
                            <th>Name</th>
                            <!--<th>Mobile</th>-->
                            <!--<th>Address</th>-->
                            <th>Pincode</th>
                            <th>Product Name</th>
                            <th>COD Amt</th>
                            <!--<th>Last Update</th>-->
                            <th>status</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($params as $param)
                        <tr class="gradeX">
                            <!--<td>{{ $i }}</td>-->
                            <!--<td>{{ $param->Rec_Time_Date }}</td>-->
                            <td>{{ $param->orderno }}</td>
                            <td>
                                <a href="{{ asset('/UPProduct_Receipt/'.$param->Single_Order_Id) }}" target="_black" class="btn" style="border-color:#FF4800;color:#FF4800">Download</a>
                            </td>
                            <td>{{ $param->Awb_Number }}</td>
                            <td>{{ $param->awb_gen_by }}</td>
                            <td>{{ ucwords($param->Name) }}</td>
                            <!--<td>{{ $param->Mobile }}</td>-->
                            <!--<td>{{ $param->Address }}</td>-->
                            <td>{{ $param->Pincode }}</td>
                            <td><span>{{ $param->Item_Name }}</span></td>
                            <td>{{ $param->Cod_Amount }}</td>
                            <!--<td>{{ $param->Last_Stamp_Date }}</td>-->
                            <td>
                                @if($param->Awb_Number != '' && $param->order_status_show == "Upload")
                                Processing
                                @elseif($param->order_status_show == "Cancel")
                                {{ $param->order_status_show }}ed
                                @elseif($param->order_status_show == "Unexpected")
                                Unknown Error
                                @elseif($param->order_status_show == "Upload")
                                Not Picked
                                @else
                                {{ $param->order_status_show }}
                                @endif
                            </td>
                            <td>
                                @if($param->Awb_Number == '')
                                {{ $param->showerrors }}
                                @endif
                            </td>
                            <td>
                                @if($param->Awb_Number)
                                @if($param->order_cancel != 1)
                                <a href="{{ asset('/SingleOrderDeletesmannual') }}/{{ $param->Awb_Number }}" style="color:red;cursor:pointer" onclick="return confirm('Are you sure cancel this order?')">Cancel</a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @php($i++)
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">



    </footer>
    <!-- partial -->
</div>











@endsection