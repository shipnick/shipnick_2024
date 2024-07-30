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
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">

	<!-- Page Title Here -->
	<title>Shipnick</title>




	<link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css') ?? 0 }}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css') ?? 0 }}">
	<link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css') ?? 0 }}">
	<!-- Style css -->
	 <link href="{{asset('newtheme/css/style.css') ?? 0 }}" rel="stylesheet">

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
			<span style="--i:9">.</span>
			<span style="--i:10">.</span>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->
	@include("UserPanel/app")	
		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-6 col-xxl-12">
						<div class="card">
							<div class="card-header d-block d-sm-flex border-0">
								<div class="me-3">
									<h4 class="card-title mb-2">Courier Summary</h4>
									<!-- <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span> -->
								</div>
								<div class="card-tabs mt-3 mt-sm-0">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#monthly"
												role="tab">Xpress</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#Weekly" role="tab">Ecom</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#Today"
												role="tab">Bluedart</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body tab-content p-0">
								<div class="tab-pane active show fade" id="monthly" role="tabpanel">
									<div class="row">
										<div class="col-xl-12 col-xxl-12 col-lg-6 col-md-6 col-sm-12 col-xs-12">

											<div class="card">
												<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
													<div class="mb-3">
														<h4 class="card-title mb-1">Xpressbees</h4>
													</div>
					
												</div>
												<style>
													.border {
																border: var(--bs-border-width) var(--bs-border-style) #181717 !important;
															}
												</style>
												<div class="card-body tab-content orders-summary pt-3">
													<div class="tab-pane fade show active" id="Monthly">
														<div class="row text-center">
															<div class="col-sm-10">
																<div class="row">
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl" >
																			<h2 class="fs-32 font-w600 counter">{{$xpressbee ?? 0 }}</h2>
																			<p class="fs-16 mb-0">Total Shipment</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$xpressbeePending ?? 0 }}</h2>
																			<p class="fs-16 mb-0">Pickup Pending</p>
																		</div>
																	</div><div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$xpressbeeIntransit ?? 0 }}</h2>
																			<p class="fs-16 mb-0">In-transit</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$xpressbeeOfd ?? 0 }}</h2>
																			<p class="fs-16 mb-0">OFD</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$xpressbeeNDR ?? 0 }}</h2>
																			<p class="fs-16 mb-0">NDR Pending</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$xpressbeeDelivered ?? 0 }}</h2>
																			<p class="fs-16 mb-0">Delivered</p>
																		</div>
																	</div>
																	
																	
					
																</div>
															</div>
															<div class="col-sm-2">
																<div class="row">
																	<div class="col-sm-9 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$xpressbeeRto ?? 0 }}</h2>
																			<p class="fs-16 mb-0">RTO/RTS</p>
																		</div>
																	</div>
																</div>
																
					
															</div>
															
															
															
															
															
															
														</div>
					
													</div>
					
												</div>
											</div>
					
										</div>
										
										<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
											<div class="card">
												<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
													<div class="mb-3">
														<h4 class="card-title mb-1">PREPAID</h4>
													</div>
					
												</div>
												<div class="card-body tab-content orders-summary pt-3">
													<div class="tab-pane fade show active" id="Monthly">
					
														<div class="row text-center" >
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaid ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Total Shipment</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidPending ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Pickup Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidIntransit ?? 0 }}</h2>
																	<p class="fs-16 mb-0">In-transit</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidOfd ?? 0 }}</h2>
																	<p class="fs-16 mb-0">OFD</p>
																</div>
															</div>
															
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidNDR ?? 0 }}</h2>
																	<p class="fs-16 mb-0">NDR Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidDelivered ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Delivered</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidRto ?? 0 }}</h2>
																	<p class="fs-16 mb-0">RTO/RTS</p>
																</div>
															</div>
														</div>
					
													</div>
					
												</div>
											</div>
										</div>
										<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
											<div class="card">
												<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
													<div class="mb-3">
														<h4 class="card-title mb-1">COD</h4>
													</div>
					
												</div>
												<div class="card-body tab-content orders-summary pt-3">
													<div class="tab-pane fade show active" id="Monthly">
					
														<div class="row text-center">
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCod ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Total Shipment</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodPending ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Pickup Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodIntransit ?? 0 }}</h2>
																	<p class="fs-16 mb-0">In-transit</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodOfd ?? 0 }}</h2>
																	<p class="fs-16 mb-0">OFD</p>
																</div>
															</div>
															
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodNDR ?? 0 }}</h2>
																	<p class="fs-16 mb-0">NDR Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodDelivered ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Delivered</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodRto ?? 0 }}</h2>
																	<p class="fs-16 mb-0">RTO/RTS</p>
																</div>
															</div>
														</div>
					
													</div>
					
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="tab-pane" id="Weekly" role="tabpanel">
									<div class="row">
										<div class="col-xl-12 col-xxl-12 col-lg-6 col-md-6 col-sm-12 col-xs-12">

											<div class="card">
												<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
													<div class="mb-3">
														<h4 class="card-title mb-1">Ecom</h4>
													</div>
					
												</div>
												<style>
													.border {
																border: var(--bs-border-width) var(--bs-border-style) #181717 !important;
															}
												</style>
												<div class="card-body tab-content orders-summary pt-3">
													<div class="tab-pane fade show active" id="Monthly">
														<div class="row text-center">
															<div class="col-sm-10">
																<div class="row">
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl" >
																			<h2 class="fs-32 font-w600 counter">{{$Ecom ?? 0 }}</h2>
																			<p class="fs-16 mb-0">Total Shipment</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$EcomPending ?? 0 }}</h2>
																			<p class="fs-16 mb-0">Pickup Pending</p>
																		</div>
																	</div><div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$EcomIntransit ?? 0 }}</h2>
																			<p class="fs-16 mb-0">In-transit</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$EcomOfd ?? 0 }}</h2>
																			<p class="fs-16 mb-0">OFD</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$EcomNdr ?? 0 }}</h2>
																			<p class="fs-16 mb-0">NDR Pending</p>
																		</div>
																	</div>
																	<div class="col-sm-2 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$EcomDeliverd ?? 0 }}</h2>
																			<p class="fs-16 mb-0">Delivered</p>
																		</div>
																	</div>
																	
																	
					
																</div>
															</div>
															<div class="col-sm-2">
																<div class="row">
																	<div class="col-sm-9 mb-4">
																		<div class="border px-1 py-3 rounded-xl">
																			<h2 class="fs-32 font-w600 counter">{{$EcomRto ?? 0 }}</h2>
																			<p class="fs-16 mb-0">RTO/RTS</p>
																		</div>
																	</div>
																</div>
																
					
															</div>
															
															
															
															
															
															
														</div>
					
													</div>
					
												</div>
											</div>
					
										</div>
										
										<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
											<div class="card">
												<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
													<div class="mb-3">
														<h4 class="card-title mb-1">PREPAID</h4>
													</div>
					
												</div>
												<div class="card-body tab-content orders-summary pt-3">
													<div class="tab-pane fade show active" id="Monthly">
					
														<div class="row text-center" >
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaid ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Total Shipment</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidPending ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Pickup Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidIntransit ?? 0 }}</h2>
																	<p class="fs-16 mb-0">In-transit</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidOfd ?? 0 }}</h2>
																	<p class="fs-16 mb-0">OFD</p>
																</div>
															</div>
															
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidNdr ?? 0 }}</h2>
																	<p class="fs-16 mb-0">NDR Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidDelivered ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Delivered</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidRto ?? 0 }}</h2>
																	<p class="fs-16 mb-0">RTO/RTS</p>
																</div>
															</div>
														</div>
					
													</div>
					
												</div>
											</div>
										</div>
										<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
											<div class="card">
												<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
													<div class="mb-3">
														<h4 class="card-title mb-1">COD</h4>
													</div>
					
												</div>
												<div class="card-body tab-content orders-summary pt-3">
													<div class="tab-pane fade show active" id="Monthly">
					
														<div class="row text-center">
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCod ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Total Shipment</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCodPending ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Pickup Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCodIntransit ?? 0 }}</h2>
																	<p class="fs-16 mb-0">In-transit</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCodOfd ?? 0 }}</h2>
																	<p class="fs-16 mb-0">OFD</p>
																</div>
															</div>
															
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCodNdr ?? 0 }}</h2>
																	<p class="fs-16 mb-0">NDR Pending</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCodDelivered ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Delivered</p>
																</div>
															</div>
															<div class="col-sm-3 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomCodRto ?? 0 }}</h2>
																	<p class="fs-16 mb-0">RTO/RTS</p>
																</div>
															</div>
														</div>
					
													</div>
					
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="tab-pane" id="Today" role="tabpanel">
									<div class="table-responsive">
										<div class="row">
											<div class="col-xl-12 col-xxl-12 col-lg-6 col-md-6 col-sm-12 col-xs-12">

												<div class="card">
													<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
														<div class="mb-3">
															<h4 class="card-title mb-1">Bluedart</h4>
														</div>

													</div>
													<style>
														.border {
															border: var(--bs-border-width) var(--bs-border-style) #181717 !important;
														}
													</style>
													<div class="card-body tab-content orders-summary pt-3">
														<div class="tab-pane fade show active" id="Monthly">
															<div class="row text-center">
																<div class="col-sm-10">
																	<div class="row">
																		<div class="col-sm-2 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$Bluedart ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">Total Shipment</p>
																			</div>
																		</div>
																		<div class="col-sm-2 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$BluedartPending ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">Pickup Pending</p>
																			</div>
																		</div>
																		<div class="col-sm-2 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$BluedartIntransit ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">In-transit</p>
																			</div>
																		</div>
																		<div class="col-sm-2 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$BluedartOfd ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">OFD</p>
																			</div>
																		</div>
																		<div class="col-sm-2 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$BluedartNdr ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">NDR Pending</p>
																			</div>
																		</div>
																		<div class="col-sm-2 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$BluedartDeliverd ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">Delivered</p>
																			</div>
																		</div>



																	</div>
																</div>
																<div class="col-sm-2">
																	<div class="row">
																		<div class="col-sm-9 mb-4">
																			<div class="border px-1 py-3 rounded-xl">
																				<h2 class="fs-32 font-w600 counter">{{$BluedartRto ?? 0 }}
																				</h2>
																				<p class="fs-16 mb-0">RTO/RTS</p>
																			</div>
																		</div>
																	</div>


																</div>





 
															</div>

														</div>

													</div>
												</div>

											</div>

											<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
												<div class="card">
													<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
														<div class="mb-3">
															<h4 class="card-title mb-1">PREPAID</h4>
														</div>

													</div>
													<div class="card-body tab-content orders-summary pt-3">
														<div class="tab-pane fade show active" id="Monthly">

															<div class="row text-center">
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaid ?? 0 }}</h2>
																		<p class="fs-16 mb-0">Total Shipment</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidPending ?? 0 }}</h2>
																		<p class="fs-16 mb-0">Pickup Pending</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidIntransit ?? 0 }}</h2>
																		<p class="fs-16 mb-0">In-transit</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidOfd ?? 0 }}</h2>
																		<p class="fs-16 mb-0">OFD</p>
																	</div>
																</div>

																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidNdr ?? 0 }}</h2>
																		<p class="fs-16 mb-0">NDR Pending</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidDelivered ?? 0 }}</h2>
																		<p class="fs-16 mb-0">Delivered</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidRto ?? 0 }}</h2>
																		<p class="fs-16 mb-0">RTO/RTS</p>
																	</div>
																</div>
															</div>

														</div>

													</div>
												</div>
											</div>
											<div class="col-xl-6 col-xxl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
												<div class="card">
													<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
														<div class="mb-3">
															<h4 class="card-title mb-1">COD</h4>
														</div>

													</div>
													<div class="card-body tab-content orders-summary pt-3">
														<div class="tab-pane fade show active" id="Monthly">

															<div class="row text-center">
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCod ?? 0 }}</h2>
																		<p class="fs-16 mb-0">Total Shipment</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCodPending ?? 0 }}</h2>
																		<p class="fs-16 mb-0">Pickup Pending</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCodIntransit ?? 0 }}</h2>
																		<p class="fs-16 mb-0">In-transit</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCodOfd ?? 0 }}</h2>
																		<p class="fs-16 mb-0">OFD</p>
																	</div>
																</div>

																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCodNdr ?? 0 }}</h2>
																		<p class="fs-16 mb-0">NDR Pending</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCodDelivered ?? 0 }}</h2>
																		<p class="fs-16 mb-0">Delivered</p>
																	</div>
																</div>
																<div class="col-sm-3 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartCodRto ?? 0 }}</h2>
																		<p class="fs-16 mb-0">RTO/RTS</p>
																	</div>
																</div>
															</div>

														</div>

													</div>
												</div>
											</div>
										</div>
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
				<p>Copyright © Designed &amp; Developed by <a href="https://shipnick.com/"
						target="_blank">shipnick</a> 2024</p>
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
	<script src="{{asset('newtheme/vendor/global/global.min.js') ?? 0 }}"></script>
	<script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js') ?? 0 }}"></script>
	<script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js') ?? 0 }}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('newtheme/vendor/apexchart/apexchart.js') ?? 0 }}"></script>
	<script src="{{asset('newtheme/./vendor/nouislider/nouislider.min.js') ?? 0 }}"></script>
	<script src="{{asset('newtheme/./vendor/wnumb/wNumb.js') ?? 0 }}"></script>

	<!-- Chart piety plugin files -->
	<script src="{{asset('newtheme/vendor/peity/jquery.peity.min.js') ?? 0 }}"></script>

	<script src="{{asset('newtheme/vendor/swiper/js/swiper-bundle.min.js') ?? 0 }}"></script>

	<!-- Dashboard 1 -->
	<script src="{{asset('newtheme/js/dashboard/dashboard-5.js') ?? 0 }}"></script>

	<script src="{{asset('newtheme/js/custom.min.js') ?? 0 }}"></script>
	<script src="{{asset('newtheme/js/dlabnav-init.js') ?? 0 }}"></script>



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