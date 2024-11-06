@extends("UserPanel/userpanel_layout1")
@section("userpanel")


<!--**********************************
Content body start
***********************************-->
<div class="content-body">
	<div class="container-fluid">
		<div class="row page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">SKU </a></li>
			</ol>
		</div>

		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<div class="col-lg-12 order-lg-1">
								<h4 class="mb-3">SKU filter </h4>


								<form method="GET" action="{{ asset('/sku_summary') }}">
									<div class="row">

										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-3">
											<div class="example">

												<div class="example">
													<p class="mb-1">Date Range</p>
													<div id="reportrange" class="pull-right"
														style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
														<i class="fa fa-calendar"></i>&nbsp;
														<span></span> <i class="fa fa-caret-down"></i>
													</div>

													<input type="hidden" name="fromdate" id="start_date" value="{{ request()->get('fromdate') }}">
													<input type="hidden" name="todate" id="end_date" value="{{ request()->get('todate') }}">
												</div>
											</div>
										</div>


									</div>

									<div class="row">
										<!-- Order Type Dropdown -->
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Order Type</label>
											<select name="order_type" id="order_type" class="default-select form-control wide w-100">
												<option value="">Select</option>
												@foreach($type1 as $orderType)
												<option value="{{ $orderType }}">{{ $orderType }}</option>
												@endforeach
											</select>
										</div>

										<!-- SKU Dropdown -->
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">SKU</label>
											<select id="sku" class="default-select form-control wide w-100" name="sku">
												<option value="">Select</option>
												@foreach($sku1 as $skuItem)
												<option value="{{ $skuItem }}">{{ $skuItem }}</option>
												@endforeach
											</select>
										</div>

										<!-- Amount Dropdown -->
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Amount</label>
											<select id="amount" class="default-select form-control wide w-100" name="amount">
												<option value="">Select</option>
												@foreach($amount1 as $amt)
												<option value="{{ $amt }}">{{ $amt }}</option>
												@endforeach
											</select>
										</div>

										<!-- Courier Dropdown -->
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Courier</label>
											<select id="courier" class="default-select form-control wide w-100" name="courier">
												<option value="">Select...</option>
												@foreach($courier1 as $courierItem)
												<option value="{{ $courierItem }}">{{ $courierItem }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<!-- jQuery Script -->
									<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

									<script>
										$(document).ready(function() {
											// Function to update dropdowns based on selected filters
											function updateDropdowns() {
												var orderType = $('#order_type').val(); // Get the selected order type
												var sku = $('#sku').val(); // Get the selected SKU
												var amount = $('#amount').val(); // Get the selected amount
												var courier = $('#courier').val(); // Get the selected courier

												// Debugging: Log the selected values
												console.log("Selected values - orderType:", orderType, "sku:", sku, "amount:", amount, "courier:", courier);

												$.ajax({
													url: '/skunew', // Backend route to fetch data
													method: 'GET',
													data: {
														order_type: orderType,
														sku: sku,
														amount: amount,
														courier: courier
													},
													success: function(response) {
														// Debugging: Log the response data to check if it's correct
														console.log("Response data:", response);

														// Update each dropdown according to the response data
														updateDropdown('#sku', response.sku, sku); // Set selected SKU
														updateDropdown('#amount', response.amount, amount); // Set selected Amount
														updateDropdown('#courier', response.courier, courier); // Set selected Courier
													},
													error: function(xhr, status, error) {
														console.error("AJAX Request failed. Status: " + status + ", Error: " + error);
													}
												});
											}

											// Function to update the dropdown with new options and set the selected value
											function updateDropdown(selector, options, selectedValue) {
												var $dropdown = $(selector);
												$dropdown.empty(); // Remove all existing options
												$dropdown.append('<option value="">Select</option>'); // Add a default "Select" option

												// Debugging: Log the options and selected value
												console.log("Updating dropdown - Selector:", selector, "Options:", options, "Selected value:", selectedValue);

												// Check if the options are not empty or null
												if (Array.isArray(options) && options.length > 0) {
													// Loop through the options and append them to the dropdown
													$.each(options, function(index, value) {
														if (value !== null && value !== "") { // Ensure the value is not null or empty
															// Check if the current value is selected, and mark it as "selected"
															var isSelected = (value == selectedValue) ? 'selected' : '';
															$dropdown.append('<option value="' + value + '" ' + isSelected + '>' + value + '</option>');
														}
													});
												} else {
													$dropdown.append('<option value="">No options available</option>'); // If no options are available
												}

												// After the options have been added, explicitly set the selected option (important for updating UI)
												if (selectedValue) {
													$dropdown.val(selectedValue); // Set the selected value
												}
											}

											// Trigger the update when any dropdown value changes
											$('#order_type, #sku, #amount, #courier').on('change', function() {
												updateDropdowns(); // Trigger update on any dropdown change
											});

											// Optional: Initially populate the dropdowns when the page loads
											updateDropdowns();
										});
									</script>









									<hr class="mb-4">
									<!--<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Download Report</button>-->
									<button type="submit" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>

									<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Clear</button>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12 col-xxl-12 col-lg-6 col-md-6 col-sm-12 col-xs-12">

						<div class="card">
							<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
								<div class="mb-3">
									<h4 class="card-title mb-1">SKU wise summary </h4>
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
												<div class="col-md-12">
													<div class="row">
														<div class="col-sm-2 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-18 font-w600 counter">
																	{{$orderno ?? 0 }}
																</h2>
																<p class="fs-8 mb-0">No of orders </p>
															</div>
														</div>

														<div class="col-sm-2 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-18 font-w600 counter">{{$intransit ?? 0 }}</h2>
																<p class="fs-8 mb-0"> In-transit</p>
															</div>
														</div>

														<div class="col-sm-2 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-18 font-w600 counter">{{$ndr ?? 0 }}</h2>
																<p class="fs-8 mb-0">NDR Pending</p>
															</div>
														</div>
														<div class="col-sm-2 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-18 font-w600 counter">{{$deliver ?? 0 }}</h2>
																<p class="fs-8 mb-0"> Delivered</p>
															</div>
														</div>
														<div class="col-sm-2 mb-4">
															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-18 font-w600 counter">{{$rto ?? 0 }}</h2>
																<p class="fs-8 mb-0">RTO/RTS</p>
															</div>
														</div>
														<div class="col-sm-2 mb-4">
															@php
															// Calculate the delivery percentage
															$deliverPercentage = ($deliver > 0) ? ($deliver * 100 / $deliverdpersentage) : 0;
															@endphp

															<div class="border px-1 py-3 rounded-xl">
																<h2 class="fs-18 font-w600 counter">{{ round($deliverPercentage) }}</h2>
																<p class="fs-8 mb-0">Delivered%</p>
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
			// Set the hidden input values without redirecting
			$('#start_date').val(picker.startDate.format('YYYY-MM-DD'));
			$('#end_date').val(picker.endDate.format('YYYY-MM-DD'));
		});

		// Set the hidden fields if values are present on page load
		$('#start_date').val('{{ request()->get('
			from ') }}');
		$('#end_date').val('{{ request()->get('
			to ') }}');
	});
</script>


@endsection()