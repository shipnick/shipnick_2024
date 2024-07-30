@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')





<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pick-up & Delivery Management</h4>
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
                        <form class="form-sample" method="POST" action="{{ asset('/UPSingle_Product_Add') }}">


                            <p class="card-description">
                                <strong>*Pick-up Details*</strong>
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Select Pick-up Area</label>
                                        <div class="col-sm-9">
                                            <select class="select" name="hubid" onchange="pickuphubdetails(this.value)" required>
                                                <option value="">- * - Select Pickup Hub Addresss - * -</option>
                                                @foreach($Hubs as $Hub)
                                                <option value="{{ ucwords($Hub->hub_id) }}">{{ ucwords($Hub->hub_name) }} ({{ ucwords($Hub->hub_code) }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Delivery Type</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="courierType" value="COD" id="membershipRadios1" checked>
                                                    COD
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="courierType" value="Prepaid" id="membershipRadios2" value="option2">
                                                    Prepaid
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function pickuphubdetails(val) {
                                    // alert(val);
                                    $.ajax({
                                        type: "GET",
                                        url: "{{ asset('/hub-details') }}",
                                        data: {
                                            hubid: val
                                        },
                                        success: function(data) {
                                            // alert(data);
                                            // alert(data['hub_name']);
                                            $("#pickuphubdetailsshows").html(data);
                                        },
                                        error: function(data) {
                                            console.log('Error:', data);
                                        }
                                    });
                                }
                            </script>
                            <div id="pickuphubdetailsshows">
                                <h6>Pick-up Location (Address)</h6>
                                <h7 class="card-title">Please select an location</h7>
                            </div>
                            <div class="card-description">
                                <strong>*Delivery Details*</strong>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cname" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="caddress" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contact Detail*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cmobile" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">City*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="ccity" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PIN Code*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cpin" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">State*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="cstate" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Package Details</h4>
                        <form class="form-sample">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Order Number*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="orderno" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dimension* (Length - cm)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lenth" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Product Name*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="itemName" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dimension* (Breadth - cm)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="breadth" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quantity*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="quantity" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dimension* (Height - cm)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="height" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Invoice Value*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="invoiceValue" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">COD Amount*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="codAmount" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Weight*(In Kg.)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="actualWeight" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total Amount*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="totalAmount" />
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Book a Shipment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. All rights
                reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
@endsection