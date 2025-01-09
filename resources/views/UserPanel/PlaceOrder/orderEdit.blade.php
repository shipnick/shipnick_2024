@extends("UserPanel/userpanel_layout1")
@section("userpanel")

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Orders</a></li>
            </ol>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="row">
            <div class="col-xl-12">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">

                                <form method="POST" action="{{ asset('/order-editnew') }}">@csrf
                                    <input type="hidden" name="single_order" value="{{$order->Single_Order_Id}}">
                                    <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong> Name</strong><span class="required">*</span></label>
                                                    <input type="text" name="cname" value="{{$order->Name}}" style="border-color: black;" class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Address</strong> <span class="required">*</span></label>
                                                    <input type="text" name="caddress" value="{{$order->Address}}" style="border-color: black;" class="form-control" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Phone Number</strong><span class="required">*</span></label>
                                                    <input type="text" name="cmobile" style="border-color: black;" class="form-control" value="{{$order->Mobile}}" placeholder="" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>PIN</strong><span class="required">*</span></label>
                                                    <input type="text" class="form-control" value="{{$order->Pincode}}" style="border-color: black;" id="pincodeInput" name="cpin" aria-describedby="inputGroupPrepend2" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>City</strong><span class="required">*</span></label>
                                                    <input type="text" name="ccity" id="stateInput" style="border-color: black;" class="form-control" value="{{$order->City}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>State</strong><span class="required">*</span></label>
                                                    <input type="text" class="form-control" style="border-color: black;" id="cityInput" name="cstate" aria-describedby="inputGroupPrepend2" value="{{$order->State}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // pincode.js

                                        $(document).ready(function() {
                                            $('#pincodeInput').on('input', function() {
                                                var pincode = $(this).val();

                                                $.ajax({
                                                    url: 'get-state-city',
                                                    type: 'GET',
                                                    data: {
                                                        pincode: pincode
                                                    },
                                                    success: function(response) {
                                                        if (response.success) {
                                                            $('#stateInput').val(response.city);
                                                            $('#cityInput').val(response.state);
                                                        } else {
                                                            // alert(response.message);
                                                        }
                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.error(error);
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    <div id="wizard_Time" class="tab-pane" role="tabpanel">
                                        <div class="row">
                                            <div class="mt-2">
                                                <h4 class="card-title text-primary">Shipment Details
                                                    <hr>
                                                </h4>

                                            </div>
                                            <div class="col-lg-6 mb-2">

                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Order Number</strong><span class="required">*</span></label>
                                                    <input type="text" name="orderno" style="border-color: black;" class="form-control" value="{{$order->orderno}}" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Product Name</strong><span class="required">*</span></label>
                                                    <input type="text" name="itemName" style="border-color: black;" class="form-control" value="{{$order->Item_Name}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Invoice Value</strong><span class="required">*</span></label>
                                                    <input type="text" name="invoiceValue" style="border-color: black;" class="form-control" value="{{$order->Invoice_Value}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Payment Method</strong><span class="required">*</span></label>

                                                    <select class="default-select form-control wide" id="courierType" name="courierType" style="border-color: black;" required>
                                                        <option value="">--Select method--</option>
                                                        <option value="COD" {{ $order->Order_Type == 'COD' ? 'selected' : '' }}>COD</option>
                                                        <option value="Prepaid" {{ $order->Order_Type == 'Prepaid' ? 'selected' : '' }}>Prepaid</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Quantity</strong><span class="required">*</span></label>
                                                    <input type="text" name="quantity" style="border-color: black;" class="form-control" value="{{$order->Quantity}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>COD Amount</strong><span class="required">*</span></label>
                                                    <input type="text" name="codAmount" style="border-color: black;" class="form-control" value="{{$order->Cod_Amount}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="mb-3">
                                                    <label class="text-label form-label"><strong>Total Amount</strong><span class="required">*</span></label>
                                                    <input type="text" name="totalAmount" style="border-color: black;" class="form-control" value="{{$order->Total_Amount}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                        <div class="mt-2">
                                            <h4 class="card-title text-primary">Package Details
                                                <hr>
                                            </h4>

                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 mb-2">
                                                <span><strong>Weight (in kg)</strong><span class="required">*</span></span>
                                            </div>

                                            <div class="col-6 col-sm-4 mb-2">
                                                <div class="mb-3 input-group">
                                                    <input type="text" class="form-control" name="actualWeight" id="input1" value="{{$order->Actual_Weight}}" style="border-color: black;">
                                                    <span class="input-group-text text-white bg-primary text-white">KG</span>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 mb-2">
                                                <span><strong>Dimension (Length - cm)</strong><span class="required">*</span></span>
                                            </div>
                                            <div class="col-6 col-sm-4 mb-2">

                                                <div class="mb-3 input-group">
                                                    <input type="number" class="form-control" name="lenth" id="input3" value="{{$order->Length}}" style="border-color: black;">
                                                    <span class="input-group-text text-white bg-primary text-white">CM</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 mb-2">
                                                <span><strong>Dimension (Breadth - cm)</strong><span class="required">*</span></span>
                                            </div>
                                            <div class="col-6 col-sm-4 mb-2">

                                                <div class="mb-3 input-group">
                                                    <input type="number" class="form-control" name="breadth" id="input5" value="{{$order->Width}}" style="border-color: black;">
                                                    <span class="input-group-text text-white bg-primary text-white">CM</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 mb-2">
                                                <span><strong>Dimension (Height - cm)</strong><span class="required">*</span></span>
                                            </div>
                                            <div class="col-6 col-sm-4 mb-2">


                                                <div class="mb-3 input-group">
                                                    <input type="number" class="form-control" name="height" id="input8" value="{{$order->Height}}" style="border-color: black;">
                                                    <span class="input-group-text text-white bg-primary text-white">CM</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="skip-email ">
                                                <p>Press proceed to continue or press cancel to exit.</p>
                                                <button type="submit" class="btn btn-primary">Proceed</button>&nbsp;&nbsp;

                                                <button type="reset" class="btn btn-primary">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- row -->
        <!-- <div class="row">
					<div class="col-xs-12 col-sm-12 col-xl-12 col-lg-12">
						<div class="card">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="card-header">
										<h4 class="card-title">Bulk Orders</h4>
									</div>
								</div>



								<form method="POST" action="{{ asset('/UPBulk_Order_Add') }}" enctype="multipart/form-data" class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<div class="card-body">
										<div class="mb-3">
											<label for="formFile" class="form-label">Upload orders excel file (CSV only)</label>

											<input type="file" id="formFile" name="bulkorders" class="form-control" accept=".csv" onchange="checkFileContent()" required />
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<div id="error_msg" style="color:red;"></div>
										</div>
										@csrf
										<button class="btn btn-primary submit-btn" id="btnSubmit">Upload</button>
										<button class="btn btn-primary" type="button">Cancel</button>
										<a href="{{ asset('SampleExcel/vSample_Order_File.cs') }}" class="btn btn-primary" title="Download Sample File">Download sample order file</a>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div> -->



    </div>
</div>




@endsection