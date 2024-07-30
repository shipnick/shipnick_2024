<!DOCTYPE html>
<html lang="en">

<head>

	<!-- All Meta -->
	<meta charset="utf-8">
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




	<link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
	<link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">
	<!-- Style css -->
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">MIS</a></li>
					</ol>
				</div>

				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body">
								<div class="row">

									<div class="col-lg-12 order-lg-1">
										<h4 class="mb-3">MIS Reports (Search)</h4>


										<form method="GET" action="{{ asset('/UPMIS_Report_ExcelN') }}">
										<div class="row">
												
												<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-3">
													<div class="example">
														<p class="mb-1">From date - To date</p>
														<!--<input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/12/2023 - 01/12/2023">-->
														<div class="row">
															<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
																<input type="date" class="form-control" name="fromdate" value="01/12/2023">
															</div>
															<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
																<input type="date" class="form-control" name="todate" value="31/12/2023">
															</div>
														</div>
													</div>
												</div>
												
											</div>
											<div class="row">
												
												<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
													<label for="zip" class="form-label">Waybill Number</label>
													
													<input type="text" class="form-control" id="waybill"
													name="awb_number" placeholder="AWB Number">
												</div>
												
												<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
													<label class="form-label">Order Type</label>
													<select name="order_type" class="default-select form-control wide w-100">
														<option value="" selected>Select...</option>
														<option value="cod">COD</option>
														<option value="prepaid">Prepaid</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
													<label class="form-label">Status</label>
													<select class="default-select form-control wide w-100" name="status">
														<option value="" selected>Select...</option>
														<option value="1">Booked</option>
														<option value="2">Ready for pickup</option>
														<option value="3">In Transit</option>
														<option value="4">RTS</option>
														<option value="5">RTO</option>
														<option value="6">Delivered</option>
														<option value="7">Cancelled</option>
														<option value="8">Out for delivery</option>
														<option value="9">Delivery attempted(NDR)</option>
														<option value="10">Lost/Missed</option>
														<option value="11">Damaged/Destroyed</option>
													</select>
												</div>
												
												<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
													<label class="form-label">Hub</label>
													<select class="default-select form-control wide w-100" name="hub_id">
														<option selected>Select...</option>
														<option>pickup address</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
													<label class="form-label">Fulfilled by</label>
													<select class="default-select form-control wide w-100" name="Fulfilled_by">
														<option value="" selected>Select...</option>
														<option value="ecom">Ecom</option>
														<option value="xpressbees">xpressbees</option>
													</select>
													<div class="invalid-feedback">
														Please provide a valid state.
													</div>
												</div>
											</div>
											<div class="row">
												
											</div>
											
											<div class="row">
												<h6 class="mb-3">Additional Fields you might require in MIS report</h6>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check mb-sm-3 mb-1">
														<input class="form-check-input" type="checkbox" name="pickupdate" value="Picked Date" id="flexCheckDefault-1">
														<label class="form-check-label mb-0 text-nowrap" for="flexCheckDefault-1">
															Picked Date
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="pickupaddress" value="Pickup Address" id="flexCheckDefault-2">
														<label class="form-check-label mb-0 text-nowrap" for="flexCheckDefault-2">
															Pickup Address
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="pickuppincode" value="Pickup Pincode" id="flexCheckDefault-4">
														<label class="form-check-label mb-0 text-nowrap" for="flexCheckDefault-4">
															Pickup Pincode
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="pickupcity" value="Pickup City" id="flexCheckDefault-5">
														<label class="form-check-label mb-0 text-nowrap" for="flexCheckDefault-5">
															Pickup City
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="pickupstate" value="Pickup State" id="flexCheckDefault-6">
														<label class="form-check-label mb-0 text-nowrap" for="flexCheckDefault-6">
															Pickup State
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="pickupphone" value="Pickup Phone" id="flexCheckDefault-3">
														<label class="form-check-label mb-0" for="flexCheckDefault-3">
															Pickup Phone
														</label>
													</div>
												</div>
												<!-- <div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="firstattampt" value="1st Attempt Date" id="flexCheckDefault-7">
														<label class="form-check-label mb-0" for="flexCheckDefault-7">
															1st Attempt Date
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="secondattempt" value="2nd Attempt Date" id="flexCheckDefault-8">
														<label class="form-check-label mb-0" for="flexCheckDefault-8">
															2nd Attempt Date
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="thirdattempt" value="3rd Attempt Date" id="flexCheckDefault-9">
														<label class="form-check-label mb-0" for="flexCheckDefault-9">
															3rd Attempt Date
														</label>
													</div>
												</div> -->
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="lastattampt" value="Last Attempt Date" id="flexCheckDefault-7">
														<label class="form-check-label mb-0" for="flexCheckDefault-7">
															Last Attempt Date
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="truearoundtime" value="Turn Around Time" id="flexCheckDefault-8">
														<label class="form-check-label mb-0" for="flexCheckDefault-8">
															Turn Around Time
														</label>
													</div>
												</div>
												<div class="col-xl-2 col-lg-3 col-sm-4">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="receivedbypod" value="Received By (POD)" id="flexCheckDefault-9">
														<label class="form-check-label mb-0" for="flexCheckDefault-9">
															Received By (POD)
														</label>
													</div>
												</div>
											</div>
											<hr class="mb-4">
											<!--<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Download Report</button>-->
											<button type="submit" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Download Report</button>
											@csrf
											<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Clear</button>
										</form>

									</div>
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
				<p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2023</p>
			</div>
		</div>
		<!--**********************************
            Footer end
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
	<script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js')}}"></script>
	<script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('newtheme/vendor/apexchart/apexchart.js')}}"></script>
	<script src="{{asset('newtheme/./vendor/nouislider/nouislider.min.js')}}"></script>
	<script src="{{asset('newtheme/./vendor/wnumb/wNumb.js')}}"></script>

	<!-- Chart piety plugin files -->
	<script src="{{asset('newtheme/vendor/peity/jquery.peity.min.js')}}"></script>

	<script src="{{asset('newtheme/vendor/swiper/js/swiper-bundle.min.js')}}"></script>

	<!-- Dashboard 1 -->
	<script src="{{asset('newtheme/js/dashboard/dashboard-5.js')}}"></script>

	<script src="{{asset('newtheme/js/custom.min.js')}}"></script>
	<script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>



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