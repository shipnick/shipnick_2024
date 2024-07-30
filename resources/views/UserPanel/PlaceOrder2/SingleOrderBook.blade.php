<!DOCTYPE html>
<html lang="en">

<head>
	<!-- All Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab">
	<meta name="robots" content="">
	<meta name="keywords"
		content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
	<meta name="description"
		content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
	<meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
	<meta property="og:description"
		content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
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
	<div id="preloader">
		<div class="waviy">
			<span style="--i:1">S</span>
			<span style="--i:2">H</span>
			<span style="--i:3">I</span>
			<span style="--i:4">P</span>
			<span style="--i:5">N</span>
			<span style="--i:6">I</span>
			<span style="--i:7">C</span>
			<span style="--i:8">K</span>
		</div>
	</div>
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
								<h4 class="card-title">Single Order</h4>
							</div>
							<div class="card-body">
								<div id="smartwizard" class="form-wizard order-create">
									<ul class="nav nav-wizard">
										<li><a class="nav-link" href="#wizard_Service">
												<span>1</span>
											</a></li>
										<li><a class="nav-link" href="#wizard_Time">
												<span>2</span>
											</a></li>
										<li><a class="nav-link" href="#wizard_Details">
												<span>3</span>
											</a></li>
										<li><a class="nav-link" href="#wizard_Payment">
												<span>4</span>
											</a></li>
									</ul>
									<form class="tab-content"method="POST" action="{{ asset('/UPSingle_Product_Add') }}">@csrf
										<div id="wizard_Service" class="tab-pane" role="tabpanel">
											<div class="row">
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Name<span
																class="required">*</span></label>
														<input type="text" name="cname" class="form-control"
															placeholder="Enter Name" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Address<span
																class="required">*</span></label>
														<input type="text" name="caddress" class="form-control"
															placeholder="Fill Address" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Phone Number<span
																class="required">*</span></label>
														<input type="text" name="cmobile" class="form-control"
															placeholder="(+91)" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">PIN<span
																class="required">*</span></label>
														<input type="text" class="form-control" id="inputGroupPrepend2" name="cpin"
															aria-describedby="inputGroupPrepend2"
															placeholder="Enter Pin Code" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">City<span
																class="required">*</span></label>
														<input type="text" name="ccity" class="form-control"
															placeholder="Enter City" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">State<span
																class="required">*</span></label>
														<input type="text" class="form-control" id="inputGroupPrepend2" name="cstate"
															aria-describedby="inputGroupPrepend2"
															placeholder="Enter State" required>
													</div>
												</div>
											</div>
										</div>
										<div id="wizard_Time" class="tab-pane" role="tabpanel">
											<div class="row">
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Order Number<span
																class="required">*</span></label>
														<input type="text" name="orderno" class="form-control"
															placeholder="Enter order details" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Product Name<span
																class="required">*</span></label>
														<input type="text" name="itemName" class="form-control"
															placeholder="Enter product name" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Invoice Value<span
																class="required">*</span></label>
														<input type="text" name="invoiceValue" class="form-control"
															placeholder="Enter invoice value" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Payment Method<span
																class="required">*</span></label>
														<select class="default-select form-control wide mb-3"  name="courierType">
															<option>--Select method--</option>
															<option value="COD">COD</option>
															<option value="Prepaid">Prepaid</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Quantity<span
																class="required">*</span></label>
														<input type="text" name="quantity" class="form-control"
															placeholder="Enter quantity" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">COD Amount<span
																class="required">*</span></label>
														<input type="text" name="codAmount" class="form-control" required>
													</div>
												</div>
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Total Amount<span
																class="required">*</span></label>
														<input type="text" name="totalAmount" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
										<div id="wizard_Details" class="tab-pane" role="tabpanel">
											<div class="row align-items-center">
												<div class="col-sm-4 mb-2">
													<span>Weight (in kg)<span class="required">*</span></span>
												</div>
												<div class="col-6 col-sm-4 mb-2">
													<div class="mb-3">
														<input class="form-control" value="0.00" type="number"
                                                        name="actualWeight" id="input1">
													</div>
												</div>

											</div>
											<div class="row align-items-center">
												<div class="col-sm-4 mb-2">
													<span>Dimension (Length - cm)<span class="required">*</span></span>
												</div>
												<div class="col-6 col-sm-4 mb-2">
													<div class="mb-3">
														<input class="form-control" value="0" type="number"
                                                        name="lenth" id="input3">
													</div>
												</div>
											</div>
											<div class="row align-items-center">
												<div class="col-sm-4 mb-2">
													<span>Dimension (Breadth - cm)<span class="required">*</span></span>
												</div>
												<div class="col-6 col-sm-4 mb-2">
													<div class="mb-3">
														<input class="form-control" value="0" type="number"
                                                        name="breadth" id="input5">
													</div>
												</div>
											</div>
											<div class="row align-items-center">
												<div class="col-sm-4 mb-2">
													<span>Dimension (Height - cm)<span class="required">*</span></span>
												</div>
												<div class="col-6 col-sm-4 mb-2">
													<div class="mb-3">
														<input class="form-control" value="0" type="number"
                                                        name="height" id="input8">
													</div>
												</div>
											</div>
										</div>
										<div id="wizard_Payment" class="tab-pane" role="tabpanel">
											<div class="row">
												<div class="col-lg-6 mb-2">
													<div class="mb-3">
														<label class="text-label form-label">Select Pick-up address
															(Hub)<span class="required">*</span></label>
														<select class="default-select form-control wide mb-3" name="hubid" >
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
													<div class="skip-email text-center">
														<p>Press proceed to continue or press cancel to exit.</p>
														<button type="submit"
															class="btn btn-primary">Proceed</button>&nbsp;&nbsp;
                                                            
                                                            <!-- <button
															type="submit" class="btn btn-primary">Cancel</button> -->
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
				<p>Copyright © Designed &amp; Developed by <a href=""
						target="_blank">Smartship</a> 2023</p>
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
		$(document).ready(function () {
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