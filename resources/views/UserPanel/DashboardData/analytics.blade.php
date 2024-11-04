@extends("UserPanel/userpanel_layout1")
@section("userpanel")
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
							<div class="col-12 mt-4">
								<!-- <label>Produces:</label> -->
								<div id="reportrange" class="pull-right"
									style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
									<i class="fa fa-calendar"></i>&nbsp;
									<span></span> <i class="fa fa-caret-down"></i>
								</div>

								<input type="hidden" id="start_date" name="start_date" />
								<input type="hidden" id="end_date" name="end_date" />


							</div>
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
													<div class="col-sm-12">
														<div class="row">
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbee ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Total Shipment</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeePending ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Pickup Pending</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
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
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$xpressbeeRto ?? 0 }}</h2>
																	<p class="fs-16 mb-0">RTO/RTS</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
																@php
																// Calculate the delivery percentage
																$deliveryxpressPercentage = ($xpressbeeDelivered > 0) ? ($xpressbeeDelivered * 100 / $xpressbeeDeliveredPersent) : 0;
																@endphp
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{ $deliveryxpressPercentage }}</h2>
																	<p class="fs-16 mb-0">Delivered %</p>
																</div>
															</div>

															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">0</h2>
																	<p class="fs-16 mb-0">Lost / Damaged</p>
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
															<p class="fs-16 mb-0"><br>In-transit </p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidOfd ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br>OFD</p>
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
															<p class="fs-16 mb-0"><br> Delivered</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidRto ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> RTO/RTS</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
													@php
																// Calculate the delivery percentage
																$xpressbeePrepaidPercentage = ($xpressbeePrepaidDelivered > 0) ? ($xpressbeePrepaidDelivered * 100 / $xpressbeePrepaidDeliveredPresent) : 0;
																@endphp
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeePrepaidPercentage ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> Delivered %</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">0</h2>
															<p class="fs-16 mb-0">Lost / Damaged</p>
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
															<p class="fs-16 mb-0"><br> In-transit</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodOfd ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> OFD</p>
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
															<p class="fs-16 mb-0"><br> Delivered</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodRto ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> RTO/RTS</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">

													@php
																// Calculate the delivery percentage
																$xpressbeeCodPercentag1 = ($xpressbeeCodDelivered > 0) ? ($xpressbeeCodDelivered * 100 / $xpressbeeCodDeliveredPresent) : 0;
																@endphp
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodPercentag1 ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> Delivered %</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$xpressbeeCodRto ?? 0 }}</h2>
															<p class="fs-16 mb-0">Lost / Damaged</p>
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
													<div class="col-sm-12">
														<div class="row">
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$Ecom ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Total Shipment</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPending ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Pickup Pending</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
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
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomRto ?? 0 }}</h2>
																	<p class="fs-16 mb-0">RTO/RTS</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
															@php
																// Calculate the delivery percentage
																$EcomPercentage = ($EcomDeliverd > 0) ? ($EcomDeliverd * 100 / $EcomDeliverdPresent) : 0;
																@endphp
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">{{$EcomPercentage ?? 0 }}</h2>
																	<p class="fs-16 mb-0">Delivered %</p>
																</div>
															</div>
															<div class="col-sm-2 mb-4">
																<div class="border px-1 py-3 rounded-xl">
																	<h2 class="fs-32 font-w600 counter">0</h2>
																	<p class="fs-16 mb-0">Lost / Damaged</p>
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
															<p class="fs-16 mb-0"><br> In-transit</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidOfd ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> OFD</p>
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
															<p class="fs-16 mb-0"><br> Delivered</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidRto ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> RTO/RTS</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
													@php
																// Calculate the delivery percentage
																$EcomPrepaidPercentage = ($EcomPrepaidDelivered > 0) ? ($EcomPrepaidDelivered * 100 / $EcomPrepaidDeliveredPresent) : 0;
																@endphp
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$EcomPrepaidPercentage ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> Delivered %</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">0</h2>
															<p class="fs-16 mb-0">Lost / Damaged</p>
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
															<p class="fs-16 mb-0"><br> In-transit</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$EcomCodOfd ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> OFD</p>
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
															<p class="fs-16 mb-0"><br> Delivered</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$EcomCodRto ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> RTO/RTS</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
													@php
																// Calculate the delivery percentage
																$EcomCodPercentage = ($EcomCodDelivered > 0) ? ($EcomCodDelivered * 100 / $EcomCodDeliveredPresent) : 0;
																@endphp
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">{{$EcomCodPercentage ?? 0 }}</h2>
															<p class="fs-16 mb-0"><br> Delivered %</p>
														</div>
													</div>
													<div class="col-sm-3 mb-4">
														<div class="border px-1 py-3 rounded-xl">
															<h2 class="fs-32 font-w600 counter">0</h2>
															<p class="fs-16 mb-0">Lost / Damaged</p>
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
														<div class="col-sm-12">
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

																<div class="col-sm-2 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$BluedartRto ?? 0 }}
																		</h2>
																		<p class="fs-16 mb-0">RTO/RTS</p>
																	</div>
																</div>
																<div class="col-sm-2 mb-4">
																@php
																// Calculate the delivery percentage
																$Bluedartpersentage = ($BluedartDeliverd > 0) ? ($BluedartDeliverdPresent * 100 / $xpressbeePrepaidDeliveredPresent) : 0;
																@endphp
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">{{$Bluedartpersentage ?? 0 }}
																		</h2>
																		<p class="fs-16 mb-0">Delivered %</p>
																	</div>
																</div>
																<div class="col-sm-2 mb-4">
																	<div class="border px-1 py-3 rounded-xl">
																		<h2 class="fs-32 font-w600 counter">0
																		</h2>
																		<p class="fs-16 mb-0">Lost / Damaged</p>
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
																<p class="fs-16 mb-0"><br> In-transit</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidOfd ?? 0 }}</h2>
																<p class="fs-16 mb-0"><br> OFD</p>
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
																<p class="fs-16 mb-0"><br> Delivered</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidRto ?? 0 }}</h2>
																<p class="fs-16 mb-0"><br> RTO/RTS</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
														@php
																// Calculate the delivery percentage
																$BluedartPrepaidPercentage = ($BluedartPrepaidDelivered > 0) ? ($BluedartPrepaidDelivered * 100 / $BluedartPrepaidDeliveredPresent) : 0;
																@endphp
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">{{$BluedartPrepaidPercentage ?? 0 }}</h2>
																<p class="fs-16 mb-0"><br> Delivered %</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">0</h2>
																<p class="fs-16 mb-0">Lost / Damaged</p>
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
																<p class="fs-16 mb-0"><br> In-transit</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">{{$BluedartCodOfd ?? 0 }}</h2>
																<p class="fs-16 mb-0"><br> OFD</p>
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
																<p class="fs-16 mb-0"><br> Delivered</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">{{$BluedartCodRto ?? 0 }}</h2>
																<p class="fs-16 mb-0"><br> RTO/RTS</p>
															</div>
														</div>

														<div class="col-sm-3 mb-4">
														@php
																// Calculate the delivery percentage
																$BluedartCodPercentage = ($BluedartCodDelivered > 0) ? ($BluedartCodDelivered * 100 / $BluedartCodDeliveredPresent) : 0;
																@endphp
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">{{$BluedartCodRto ?? 0 }}</h2>
																<p class="fs-16 mb-0"><br> Delivered %</p>
															</div>
														</div>
														<div class="col-sm-3 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-32 font-w600 counter">0</h2>
																<p class="fs-16 mb-0">Lost / Damaged</p>
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

<!-- daterangepicker  -->
<script type="text/javascript">
	$(function() {
		var start = moment();
		var end = moment();

		// Function to update the display
		function cb(start, end) {
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$('#start_date').val(start.format('YYYY-MM-DD'));
			$('#end_date').val(end.format('YYYY-MM-DD'));
		}

		// Initialize the date range picker
		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		// Handle URL parameters
		const urlParams = new URLSearchParams(window.location.search);
		const startDateParam = urlParams.get('start_date');
		const endDateParam = urlParams.get('end_date');

		if (startDateParam && endDateParam) {
			const startDate = moment(startDateParam);
			const endDate = moment(endDateParam);
			cb(startDate, endDate); // Update display with the URL parameters
			$('#reportrange').data('daterangepicker').setStartDate(startDate);
			$('#reportrange').data('daterangepicker').setEndDate(endDate);
		} else {
			// Show today's date initially
			cb(start, end);
		}

		// Handle the selection change
		$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
			// Redirect to the URL with the selected dates
			var url = "{{ url('showordercounts') }}?start_date=" + picker.startDate.format('YYYY-MM-DD') + "&end_date=" + picker.endDate.format('YYYY-MM-DD');
			window.location.href = url;
		});
	});
</script>

@endsection