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
						<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Single Order</a></li>
					</ol>
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title text-primary">Consignee Details</h4>
							</div>
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>        
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
																$('#stateInput').val(response.state);
																$('#cityInput').val(response.city);
															} else {
																// alert(response.message);
															}
														},
														error: function(xhr, status, error) {
												// 			console.error(error);
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
														<select class="default-select form-control wide mb-3" name="courierType" style="border-color: black;">
															<option>--Select method--</option>
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
												<!-- <div class="input-group">
													<input type="text" class="form-control">
													<span class="input-group-text">KG</span>
													
												</div> -->
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
		<!--**********************************
            Content body end
        ***********************************-->


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
	<script>
		jQuery(document).ready(function() {
			setTimeout(function() {
				var dezSettingsOptions = {
					typography: "cairo",
					version: "light",
					layout: "vertical",
					primary: "color_10",
					headerBg: "color_1",
					navheaderBg: "color_1",
					sidebarBg: "color_10",
					sidebarStyle: "mini",
					sidebarPosition: "fixed",
					headerPosition: "fixed",
					containerLayout: "wide",
				};
				new dezSettings(dezSettingsOptions);
				jQuery(window).on('resize', function() {
					new dezSettings(dezSettingsOptions);
				})
			}, 1000)
		});
	</script>

</body>

</html> 