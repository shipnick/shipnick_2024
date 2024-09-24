           
        @extends("UserPanel/Layout2")
@section("order")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add a Hub</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add a Hub</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="needs-validation" method="post" action="{{ asset('/UPNew_Hub') }}" enctype="multipart/form-data" novalidate >@csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                 <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom01">Hub Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 input-success-o">
														<input type="text" class="form-control " name="name" id="validationCustom01"   required>
														<div class="invalid-feedback">
															Please enter a Hub Name.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom02">PIN Code<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="pincode" id="validationCustom02"   required>
														<div class="invalid-feedback">
															Please enter a PIN Code.
														</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom02">Contact Number<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="mobile" id="validationCustom02"   required>
														<div class="invalid-feedback">
															Please enter a Contact Number.
														</div>
                                                    </div>
                                                </div>
												
              <!--                                  <div class="mb-3 row">-->
              <!--                                      <label class="col-lg-4 col-form-label text-black" for="validationCustom09">house/flat no.<span-->
              <!--                                              class="text-danger">*</span>-->
              <!--                                      </label>-->
              <!--                                      <div class="col-lg-6">-->
              <!--                                          <input type="text" class="form-control text-black" name="address2" id="validationCustom09"   required>-->
														<!--<div class="invalid-feedback">-->
														<!--	Please enter a house/flat no.-->
														<!--</div>-->
              <!--                                      </div>-->
              <!--                                  </div>-->
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom04">to Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control"  name="address1" id="validationCustom04"  rows="5"  required></textarea>
														<div class="invalid-feedback">
															Please enter a address.
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                
                                                
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom06">City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="city" id="validationCustom06" required>
														<div class="invalid-feedback">
															Please enter city.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom07">State
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"  name="state" id="validationCustom07"   required>
														<div class="invalid-feedback">
															Please enter state.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom08">GSTIN
                                                        <!--<span class="text-danger">*</span>-->
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="gstno" id="validationCustom08" value="0000"  required>
														<div class="invalid-feedback">
															Please enter GSTIN
														</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom05">Hub Pickup type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="default-select wide form-control" name="deliverytype"  id="validationCustom05">
                                                            <option  data-display="Select">Select a hub type</option>
                                                            <option value="2">Economy</option>
                                                            <option value="1">Express</option>
                                                        </select>
														<div class="invalid-feedback">
															Please select hub type.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-lg-8 ms-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
														
                                                    </div>
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
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
