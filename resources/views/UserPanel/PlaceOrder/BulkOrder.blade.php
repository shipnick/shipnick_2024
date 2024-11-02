<!DOCTYPE html>
<html lang="en">

<head>
	<!-- All Meta -->
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab">
	<meta name="robots" content="">
	<meta name="keywords" content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
	<meta name="description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
	<meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
	<meta property="og:description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
	<meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="{{asset('Admin/images/logo.jpg')}}" />

	<!-- Page Title Here -->
	<title>Shipnick</title>



	<!-- Form step -->
	<link href="{{asset('newtheme/./vendor/jquery-smartwizard/dist/css/smart_wizard.min.css')}}" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	@include("UserPanel/preloader")
	<!--*******************
        Preloader end
    ********************-->


	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		@include("UserPanel/app")

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Create Orders</a></li>
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
										<ul class="nav nav-tabs">
											<li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">Single Order</a>
											</li>
											<li class="nav-item"><a href="#Bulk-Upload" data-bs-toggle="tab" class="nav-link active show">Bulk Upload</a>
											</li>




										</ul>


										<div class="tab-content">
											<div id="Bulk-Upload" class="tab-pane fade active show">
												<div class="row">

													<div class="col-md-6">
														
															<form method="POST" action="{{ asset('/UPBulk_Order_Add') }}" enctype="multipart/form-data" class="col-xs-12 col-sm-12 col-md-12 col-lg-10 mt-5">
																
																	<div class="mb-3">
																		<label for="formFile" class="form-label">Upload orders excel file (CSV only)</label>

																		<input type="file" id="formFile" name="bulkorders" class="form-control" accept=".csv" onchange="checkFileContent()" required />
																		<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
																		<div id="error_msg" style="color:red;"></div>
																	</div>
																	@csrf
																	<button class="btn btn-primary submit-btn mt-2" id="btnSubmit">Upload</button>
																	<button class="btn btn-primary mt-2" type="button">Cancel</button>

																	<a href="{{ asset('SampleExcel/NEW UPLOAD FILE - SHIPNICK.csv') }}" class="btn btn-primary mt-2" title="Download Sample File">Download sample order file</a>

																
															</form>
														
													</div>
													<div class="col-md-6">
														<div class="profile-uoloaded-post pb-3">
															<img src="images/profile/8.jpg" alt="" class="img-fluid w-100 rounded">
															<a class="post-title" href="#">
																<h3 class="text-black">Bulk Upload Instructions</h3>
															</a>
															<p><b>Step 1:</b>Add warehouse by inputing the pickup details to generate warehouse ID</p>
															<p><b>Step 2:</b>Star marked are mandatory field & Non-Star marked are non mandatory field</p>
															<p><b>Step 3:</b>Fill all the relavent fields reqiuired in the appropiate format and upload the file in csv format</p>

														</div>
													</div>
												</div>
											</div>
											<div id="about-me" class="tab-pane fade">
												<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
												<div class="card-header">
													<h4 class="card-title text-primary">Consignee Details</h4>
												</div>
												<div class="card-body">
													<div id="smartwizard" class="form-wizard order-create">

														<form method="POST" action="{{ asset('/UPSingle_Product_Add') }}">@csrf
															<div id="wizard_Service" class="tab-pane" role="tabpanel">
																<div class="row">
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong> Name</strong><span class="required">*</span></label>
																			<input type="text" name="cname" style="border-color: black;" class="form-control" placeholder="Enter Name" required>
																			<p class="text-sm text-red-600 ">@error('cname'){{$message}}@enderror</p>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Address</strong> <span class="required">*</span></label>
																			<input type="text" name="caddress" style="border-color: black;" class="form-control" placeholder="Fill Address" required>
																			<p class="text-sm text-red-600 ">@error('cname'){{$message}}@enderror</p>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Phone Number</strong><span class="required">*</span></label>
																			<input type="text" name="cmobile" style="border-color: black;" class="form-control" placeholder="(+91)" required>
																			<p class="text-sm text-red-600 ">@error('cmobile'){{$message}}@enderror</p>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>PIN</strong><span class="required">*</span></label>
																			<input type="text" class="form-control" style="border-color: black;" id="pincodeInput" name="cpin" aria-describedby="inputGroupPrepend2" placeholder="Enter Pin Code" required>
																			<p class="text-sm text-red-600 ">@error('cpin'){{$message}}@enderror</p>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>City</strong><span class="required">*</span></label>
																			<input type="text" name="ccity" id="stateInput" style="border-color: black;" class="form-control" placeholder="Enter City" required>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>State</strong><span class="required">*</span></label>
																			<input type="text" class="form-control" style="border-color: black;" id="cityInput" name="cstate" aria-describedby="inputGroupPrepend2" placeholder="Enter State" required>
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
																			<input type="text" name="orderno" style="border-color: black;" class="form-control" placeholder="Enter order details" required>
																			<p class="text-sm text-red-600 ">@error('orderno'){{$message}}@enderror</p>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Product Name</strong><span class="required">*</span></label>
																			<input type="text" name="itemName" style="border-color: black;" class="form-control" placeholder="Enter product name" required>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Invoice Value</strong><span class="required">*</span></label>
																			<input type="text" name="invoiceValue" style="border-color: black;" class="form-control" placeholder="Enter invoice value" required>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Payment Method</strong><span class="required">*</span></label>

																			<select class="default-select form-control wide" id="courierType" name="courierType" style="border-color: black;" required>
																				<option value="">--Select method--</option>
																				<option value="COD">COD</option>
																				<option value="Prepaid">Prepaid</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Quantity</strong><span class="required">*</span></label>
																			<input type="text" name="quantity" style="border-color: black;" class="form-control" placeholder="Enter quantity" required>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>COD Amount</strong><span class="required">*</span></label>
																			<input type="text" name="codAmount" style="border-color: black;" class="form-control" required>
																		</div>
																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Total Amount</strong><span class="required">*</span></label>
																			<input type="text" name="totalAmount" style="border-color: black;" class="form-control" required>
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
																			<input type="text" class="form-control" value="0.00" name="actualWeight" id="input1" style="border-color: black;">
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
																			<input type="number" class="form-control" value="0" name="lenth" id="input3" style="border-color: black;">
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
																			<input type="number" class="form-control" value="0" name="breadth" id="input5" style="border-color: black;">
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
																			<input type="number" class="form-control" value="0" name="height" id="input8" style="border-color: black;">
																			<span class="input-group-text text-white bg-primary text-white">CM</span>

																		</div>
																	</div>
																</div>
															</div>
															<div id="wizard_Payment" class="tab-pane" role="tabpanel">
																<div class="row">
																	<div class="mt-2">
																		<h4 class="card-title text-primary">Pickup Details
																			<hr>
																		</h4>

																	</div>
																	<div class="col-lg-6 mb-2">
																		<div class="mb-3">
																			<label class="text-label form-label"><strong>Select Pick-up address
																					(Hub)</strong><span class="required">*</span></label>
																			<select class="default-select form-control wide mb-3" name="hubid">
																				<option value="">- * - Select Pickup Hub Addresss - * -</option>
																				@foreach($Hubs as $Hub)
																				<option value="{{ ucwords($Hub->hub_id) }}">{{ ucwords($Hub->hub_name) }} ({{ ucwords($Hub->hub_code) }})</option>
																				@endforeach
																			</select>
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
															</div>
														</form>
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header d-flex flex-wrap border-0 pb-0">
								<div class="me-auto mb-sm-0 mb-3">
									<h4 class="card-title mb-2">Hub Details</h4>
									<!-- <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span> -->
								</div>
								<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Hub</button>

							</div>
							<hr>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-responsive-md">
										<thead>
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
												<?php if ($param->smartship_hubid == "" && $param->smartship_hubid == "R") { ?>
													<td class="text-danger">invalid details</td>
												<?php } elseif ($param->smartship_hubid == "R") { ?>
													<td>invalid details</td>
												<?php  } else { ?>
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
				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add A Hub</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal">
								</button>
							</div>
							<div class="modal-body">
								<div class="form-validation">
									<form class="needs-validation" method="post" action="{{ asset('/UPNew_Hub') }}" enctype="multipart/form-data" novalidate>@csrf
										<div class="row">
											<div class="col-xl-6">
												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom01">Hub Name
														<span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<input type="text" class="form-control" name="name" id="validationCustom01" required>
														<div class="invalid-feedback">
															Please enter a Hub Name.
														</div>
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom02">Contact Number<span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<input type="text" class="form-control" name="mobile" id="validationCustom02" required>
														<div class="invalid-feedback">
															Please enter a Contact Number.
														</div>
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom02">PIN Code<span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<input type="text" class="form-control" name="pincode" id="validationCustom02" required>
														<div class="invalid-feedback">
															Please enter a PIN Code.
														</div>
													</div>
												</div>

												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom04">Address <span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<textarea class="form-control" name="address1" id="validationCustom04" rows="5" required></textarea>
														<div class="invalid-feedback">
															Please enter a address.
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-6">

												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom06">City
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
													<label class="col-lg-4 col-form-label" for="validationCustom07">State
														<span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<input type="text" class="form-control" name="state" id="validationCustom07" required>
														<div class="invalid-feedback">
															Please enter state.
														</div>
													</div>
												</div>
												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom08">GSTIN
														<span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<input type="text" class="form-control" name="gstno" id="validationCustom08" required>
														<div class="invalid-feedback">
															Please enter GSTIN
														</div>
													</div>
												</div>

												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="validationCustom05">Hub Pickup type
														<span class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<select class="default-select wide form-control" name="deliverytype" id="validationCustom05">
															<option data-display="Select" value="">Select a hub type</option>
															<option value="2">Economy</option>
															<option value="1">Express</option>
														</select>
														<div class="invalid-feedback">
															Please select hub type.
														</div>
													</div>
												</div>

											</div>

											<div class=" row">
												<div class=" ms-auto">
													<button type="submit" class="btn btn-primary">Submit</button>

												</div>
											</div>
										</div>
									</form>
								</div>
							</div>

							<!-- <div class="modal-footer">
																<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
																<button type="button" class="btn btn-primary">Save changes</button>
															</div> -->
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
		<!--**********************************
            Content body end
        ***********************************-->
		<!-- script  -->
		<script>
			var hubs = <?php echo json_encode($Hubs); ?>;

			function hubrExists(hub_code) {
				return hubs.some(function(el) {
					return el.hub_code === hub_code;
				});
			}

			function checkFileContent() {
				const csvFile = document.getElementById("csvFile");
				const input = csvFile.files[0];
				const reader = new FileReader();
				$("#btnSubmit").prop('disabled', true);

				$('#error_msg').hide();
				$('#error_msg').html('');

				reader.onload = function(e) {

					const text = e.target.result;

					const data = csvToArray(text);
					var totallen = data.length - 1;

					var totallenhub = hubs.length - 1;

					const hubsstatus = 0;
					// Hub Details

					var Order_ID;
					var Address;
					var Address2;
					var Customer_City;
					var Weight;
					var Length;
					var Breadth;
					var Height;
					var Customer_Name;
					var Customer_State;
					var Pincode;
					var Mobile;
					var Product_Name;
					var Quantity;
					var Order_Type;
					var COD_AMOUNT;
					var Invoice_Value;
					var Total_Amount;
					var Hub_Code;
					var Hub_Code_Check;
					var Mobilelen;
					var Pincodelen;
					var statetype;
					var Pincodetype;


					var message = '';
					var cnt = 0;
					var crtno = 2;
					var checkString = 'Order_ID*,Customer_Name*,Address*,Address2*,Customer_City*,Customer_State*,Pincode*,Mobile*,Product_Name*,Quantity*,Order_Type*,COD_AMOUNT*,Weight(gm)*,Length(Cm)*,Breadth(Cm)*,Height(Cm)*,Invoice_Value*,Total_Amount*,Hub_Code*';

					if (text.indexOf(checkString) == 0) {
						if (totallen > 5000) {
							message = 'Total Orders must be less than 5000.';
						} else {
							for (var i = 0; i < totallen; i++) {
								Order_ID = data[i]['Order_ID*'].trim();
								Customer_Name = data[i]['Customer_Name*'].trim();
								Address = data[i]['Address*'].trim();
								Address2 = data[i]['Address2*'].trim();
								Customer_City = data[i]['Customer_City*'].trim();
								Customer_State = data[i]['Customer_State*'].trim();
								Pincode = data[i]['Pincode*'].trim();
								// alert(Pincode);
								Mobile = data[i]['Mobile*'].trim();
								Product_Name = data[i]['Product_Name*'].trim();
								Quantity = data[i]['Quantity*'].trim();
								Order_Type = data[i]['Order_Type*'].trim();
								COD_AMOUNT = data[i]['COD_AMOUNT*'].trim();
								Weight = data[i]['Weight(gm)*'].trim();
								Length = data[i]['Length(Cm)*'].trim();
								Breadth = data[i]['Breadth(Cm)*'].trim();
								Height = data[i]['Height(Cm)*'].trim();
								Invoice_Value = data[i]['Invoice_Value*'].trim();
								Total_Amount = data[i]['Total_Amount*'].trim();


								Hub_Code = data[i]['Hub_Code*\r'].replace("\r", "").trim();
								Hub_Code = Hub_Code.toUpperCase();
								//pickup_city = data[i]['pickup_city\r'].replace("\r", "").trim();   //  last column should be used with \r

								if (Order_ID == '' || Order_ID == '0') {
									message = 'Line no ' + crtno + ', Order ID can not be blank....!';
									break;
								}
								if (Customer_Name == '' || Customer_Name == '0') {
									message = 'Line no ' + crtno + ', Customer Name can not be blank....!';
									break;
								}
								if (!isNaN(Customer_Name)) {
									message = 'Line no ' + crtno + ', Customer Name can not be numeric only....!';
									break;
								}
								if (Address == '' || Address == '0') {
									message = 'Line no ' + crtno + ', Address can not be blank....!';
									break;
								}
								if (!isNaN(Address)) {
									message = 'Line no ' + crtno + ', Address can not be numeric only....!';
									break;
								}
								/*
								if(!/^[a-zA-Z0-9 /]+$/.test(Address)){
								    message='Line no '+crtno+', Address special characters can not be accepted....!';
								    break;  
								}
								*/
								if (Customer_City == '' || Customer_City == '0') {
									message = 'Line no ' + crtno + ', Customer City can not be blank....!';
									break;
								}
								if (!isNaN(Customer_City)) {
									message = 'Line no ' + crtno + ', Customer City can not be numeric....!';
									break;
								}
								if (Customer_State == '' || Customer_State == '0') {
									message = 'Line no ' + crtno + ', Customer State can not be blank....!';
									break;
								}
								if (!isNaN(Customer_State)) {
									message = 'Line no ' + crtno + ', Customer State can not be numeric....!';
									break;
								}
								if (Pincode == '' || Pincode == '0') {
									message = 'Line no ' + crtno + ', Customer Pincode can not be blank....!';
									break;
								}
								if (!/^[0-9]+$/.test(Pincode)) {
									message = 'Line no ' + crtno + ', Customer Pincode enter only numeric characters....!';
									break;
								}
								if (Mobile == '' || Mobile == '0') {
									message = 'Line no ' + crtno + ', Customer Mobile can not be blank....!';
									break;
								}
								if (!/^[0-9]+$/.test(Mobile)) {
									message = 'Line no ' + crtno + ', Customer Mobile enter only numeric characters....!';
									break;
								}
								if (Product_Name == '' || Product_Name == '0') {
									message = 'Line no ' + crtno + ', Product Name can not be blank....!';
									break;
								}
								if (Quantity == '' || Quantity == '0') {
									message = 'Line no ' + crtno + ', Product Quantity can not be blank....!';
									break;
								}
								if (isNaN(Quantity)) {
									message = 'Line no ' + crtno + ', Product Quantity must be numberic....!';
									break;
								}
								if (Order_Type == '' || Order_Type == '0') {
									message = 'Line no ' + crtno + ', Order Type can not be blank....!';
									break;
								}
								//  if(Order_Type !='COD' && Order_Type !='prepaid'){              
								//     message='Line no '+crtno+', Order Type must be either COD or prepaid ....!';
								//      break;  
								//  }
								if (COD_AMOUNT == '' || COD_AMOUNT == '0') {
									if (Order_Type == 'COD') {
										message = 'Line no ' + crtno + ', Product COD Amount can not be blank....!';
										break;
									}
									// message='Line no '+crtno+', Product COD Amount can not be blank....!';
									// break;  
								}
								if (isNaN(COD_AMOUNT)) {
									message = 'Line no ' + crtno + ', Product COD Amount must be numberic....!';
									break;
								}
								if (Weight == '' || Weight == '0') {
									message = 'Line no ' + crtno + ', Product Weight can not be blank....!';
									break;
								}
								if (isNaN(Weight)) {
									message = 'Line no ' + crtno + ', Product Weight must be numberic....!';
									break;
								}
								if (Length == '' || Length == '0') {
									message = 'Line no ' + crtno + ', Product Length can not be blank....!';
									break;
								}
								if (isNaN(Length)) {
									message = 'Line no ' + crtno + ', Product Length must be numberic....!';
									break;
								}
								if (Breadth == '' || Breadth == '0') {
									message = 'Line no ' + crtno + ', Product Breadth can not be blank....!';
									break;
								}
								if (isNaN(Breadth)) {
									message = 'Line no ' + crtno + ', Product Breadth must be numberic....!';
									break;
								}
								if (Height == '' || Height == '0') {
									message = 'Line no ' + crtno + ', Product Height can not be blank....!';
									break;
								}
								if (isNaN(Height)) {
									message = 'Line no ' + crtno + ', Product Height must be numberic....!';
									break;
								}
								if (Invoice_Value == '' || Invoice_Value == '0') {
									message = 'Line no ' + crtno + ', Product Invoice Value can not be blank....!';
									break;
								}
								if (isNaN(Invoice_Value)) {
									message = 'Line no ' + (cnt + 2) + ', Product Invoice_Value must be numberic....!';
									break;
								}
								if (Total_Amount == '' || Total_Amount == '0') {
									message = 'Line no ' + crtno + ', Product Total Amount can not be blank....!';
									break;
								}
								if (isNaN(Total_Amount)) {
									message = 'Line no ' + crtno + ', Product Total_Amount must be numberic....!';
									break;
								}

								if (Hub_Code == '' || Hub_Code == '0') {
									message = 'Line no ' + crtno + ', Hub Code can not be blank....!';
									break;
								}

								if (!hubrExists(Hub_Code)) {
									message = 'Line no ' + crtno + ', Hub code not available, Please use available hub codes.....!';
									break;
								}

								cnt++;
								crtno++;
							}
						}

					} else {
						message = 'Please download the sample file and use that formated file........!';
					}





					if (message == '') {
						if (cnt == totallen) {
							$("#btnSubmit").prop('disabled', false);
						}
					} else {
						$('#error_msg').show();
						$('#error_msg').html(message);

						document.getElementById("csvFile").value = "";
						$("#btnSubmit").prop('disabled', true);
					}


				}

				reader.readAsText(input);

			}


			function csvToArray(str, delimiter = ",") {

				const headers = str.slice(0, str.indexOf("\n")).split(delimiter);

				const rows = str.slice(str.indexOf("\n") + 1).split("\n");



				const arr = rows.map(function(row) {
					var refine_row = row.split('\"');

					var newrow = '';
					for (var ii = 0; ii < refine_row.length; ii++) {
						if (ii % 2 == 0) {
							newrow = newrow + refine_row[ii];
						} else {
							var temp = refine_row[ii].replace(/,/gi, "___");
							newrow = newrow + temp;
						}

					}
					const values = newrow.split(delimiter);
					const el = headers.reduce(function(object, header, index) {
						object[header] = values[index];
						return object;
					}, {});
					return el;
				});
				return arr;
			}
		</script>


		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">
			<div class="copyright">
				<p>Copyright © Designed &amp; Developed by <a href="" target="_blank">Smartship</a> 2023</p>
			</div>
		</div>
		<!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

		<!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->



	<!-- Required vendors -->
	<script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>

	<script src="{{asset('newtheme/vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
	<script src="{{asset('newtheme/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
	<!-- Form validate init -->
	<script src="{{asset('newtheme/./js/plugins-init/jquery.validate-init.js')}}"></script>


	<!-- Form Steps -->
	<script src="{{asset('newtheme/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>
	<script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	<script src="{{asset('newtheme/js/custom.min.js')}}"></script>
	<script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>


	<script>
		$(document).ready(function() {
			// SmartWizard initialize
			$('#smartwizard').smartWizard();
		});
	</script>
	<!--<script>-->
	<!--	jQuery(document).ready(function() {-->
	<!--		setTimeout(function() {-->
	<!--			var dezSettingsOptions = {-->
	<!--				typography: "cairo",-->
	<!--				version: "light",-->
	<!--				layout: "vertical",-->
	<!--				primary: "color_10",-->
	<!--				headerBg: "color_1",-->
	<!--				navheaderBg: "color_1",-->
	<!--				sidebarBg: "color_10",-->
	<!--				sidebarStyle: "mini",-->
	<!--				sidebarPosition: "fixed",-->
	<!--				headerPosition: "fixed",-->
	<!--				containerLayout: "wide",-->
	<!--			};-->
	<!--			new dezSettings(dezSettingsOptions);-->
	<!--			jQuery(window).on('resize', function() {-->
	<!--				new dezSettings(dezSettingsOptions);-->
	<!--			})-->
	<!--		}, 1000)-->
	<!--	});-->
	<!--</script>-->

</body>

</html>