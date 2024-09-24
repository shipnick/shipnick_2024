
           
        @extends("UserPanel/Layout2")
@section("order")
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

    @endsection
