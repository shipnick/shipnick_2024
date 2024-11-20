<!DOCTYPE html>
<html lang="en">

<head>

	<!-- All Meta -->
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Shipnick.com">
	<meta name="robots" content="">
	<meta name="keywords"
		content="Logistics, shipment, shipnick, shipnick.com, courier, xpressbee, ecom, dtdc, bluedart, invoice, modern, money, transaction, Transfer money, user interface, wallet">
	<meta name="description"
		content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
	<meta property="og:title" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
	<meta property="og:description"
		content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
	<meta property="og:image" content="//shipnick.com/Shipnick.jpg">
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">

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

@include("Admin/app")
		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">

				<div class="row">
					<div class="col-xl-12 tab-content">
						<div class="tab-pane fade show active" id="AllTransaction" role="tabpanel"
							aria-labelledby="transaction-tab">
							<div class="table-responsive fs-14">
								<table class="table card-table display mb-4 dataTablesCard text-black" id="example5">
									<thead>
										<tr>

											<th>S. No.</th>
											<th>Courier Name</th>
											<th>Email ID</th>
											<th>Logo</th>
											<th>Date</th>

										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<?php
												$corunamea = $param->name;
												if($admins[$corunamea]){
											?>
										<tr class="gradeX">
											<td>{{ $i }}</td>
											<?php 
													if( $corunamea=="SmartShip")
													{ ?>
											<td>Bluedart</td>
											<?php
													} else{ ?>
											<td>{{ $corunamea }}</td>
											<?php
												   } ?>
											<!-- for email  -->
											<?php 
													if( $param->email=="smartship@gmail.com")
													{ ?>
											<td>info@bluedart.com</td>
											<?php
													} else{ ?>
											<td>{{ $param->email }}</td>
											<?php
												   } ?>
											<td>
												<img src="{{ asset('/Couriers') }}/{{ $param->email }}/{{ $param->logo }}"
													style="width:50px">
											</td>
											<td>{{ $param->date }}</td>
											<!--<td>-->
											<!--<a title="Edit Courier Details" href="{{ asset('/courier-edit/'.$param->courierid) }}"><i class="far fa-edit me-2"></i></a>-->
											<!--<a href="{{ asset('/courier-priceing/'.$param->courierid) }}" class="btn btn-outline-primary btn-sm">Price</a>-->
											<!--</td>-->
										</tr>
										<?php
												}
											?>

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
		<!--**********************************
            Content body end
        ***********************************-->



		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">

			<div class="copyright">
				<p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/"
						target="_blank">DexignLab</a> 2023</p>
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
		jQuery(document).ready(function () {
			setTimeout(function () {
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
				jQuery(window).on('resize', function () {
					new dezSettings(dezSettingsOptions);
				})
			}, 1000)
		});


	</script>

</body>

</html>