@extends("UserPanel/userpanel_layout1")
@section("userpanel")

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.css">
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script>
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
									<style>
										select {
											padding: 3px 12px;
											outline: none;
											width: 250px;
											margin-bottom: 20px;
										}

										select.widthHeight::-webkit-scrollbar {
											width: 14px;
											height: 14px;
										}

										select.style::-webkit-scrollbar-track {
											border: rgb(180, 180, 180);
											background-color: #ff6536;
										}

										select.style::-webkit-scrollbar-thumb {
											background-color: #3677ef;
											border: 1px solid rgb(193, 193, 193);
										}

										div {
											margin-bottom: 5px;
										}
									</style>


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
											<select name="sku" id="sku" class="form-control wide w-100">
												<option value="">Select</option>
												@foreach($sku1 as $skuItem)
												<option value="{{ $skuItem }}">{{ $skuItem }}</option>
												@endforeach
											</select>
										</div>

										<!-- Amount Dropdown -->
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Amount</label>
											<select name="amount" id="amount" class="form-control wide w-100">
												<option value="">Select</option>
												@foreach($amount1 as $amt)
												<option value="{{ $amt }}">{{ $amt }}</option>
												@endforeach
											</select>
										</div>

										<!-- Include jQuery -->
										<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

										<script>
											$(document).ready(function() {
												// When SKU dropdown changes, update the Amount dropdown
												$('#sku').on('change', function() {
													var selectedSku = $(this).val(); // Get the selected SKU value

													if (selectedSku) {
														// If SKU is selected, make an AJAX request to update the Amount options
														$.ajax({
															url: '/skunew', // This should be your backend route
															method: 'GET',
															data: {
																sku: selectedSku
															}, // Send the selected SKU as part of the request
															success: function(response) {
																// Update the Amount dropdown with new options based on the response
																updateAmountDropdown(response.amount);
															},
															error: function(xhr, status, error) {
																console.error("AJAX Request failed. Status: " + status + ", Error: " + error);
															}
														});
													} else {
														// If no SKU is selected, clear the Amount dropdown
														$('#amount').empty();
														$('#amount').append('<option value="">Select</option>');
													}
												});

												// Function to update the Amount dropdown based on the response from AJAX
												function updateAmountDropdown(amounts) {
													var $amountDropdown = $('#amount');
													$amountDropdown.empty(); // Clear existing options
													$amountDropdown.append('<option value="">Select</option>'); // Add default "Select" option

													if (Array.isArray(amounts) && amounts.length > 0) {
														// If there are valid amounts, loop through them and append to the dropdown
														$.each(amounts, function(index, amount) {
															$amountDropdown.append('<option value="' + amount + '">' + amount + '</option>');
														});
													} else {
														// If no amounts are available, display a "No options available" message
														$amountDropdown.append('<option value="">No options available</option>');
													}
												}
											});
										</script>

										<!-- Courier Dropdown -->
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Courier</label>


											<select name="courier" class=" form-control wide w-100 ">
												<option value="">Select</option>
												@foreach($courier1 as $courierItem)
												<option value="{{ $courierItem }}">{{ $courierItem }}</option>
												@endforeach
											</select>
										</div>
									</div>











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
														<!-- Half donut chart -->
														<div id="half-donut-chart" class="ct-chart ct-golden-section"></div>

														<div class="" style="margin-top: -12%;">
															<!-- Delivered percentage display -->
															<h2 class="fs-32 font-w600 counter">{{ round($deliverdpersentage) }}</h2>
															<p class="fs-16 mb-0">Delivered %</p>
														</div>

														<script>
															// Get the dynamic value of the delivery percentage from PHP
															var deliverdPercentage = {
																{
																	round($deliverdpersentage)
																}
															}
															/2;  / / Assuming this is a valid number from PHP

															// Half donut chart data
															var data = {
																series: [deliverdPercentage] // One slice for the percentage, the other for the remaining part
															};

															// Half donut chart options
															var options = {
																donut: true, // Make it a donut chart
																donutWidth: 60, // Width of the donut ring
																startAngle: 270, // Start the chart from the bottom (270°)
																total: 100, // Total value (100%)
																showLabel: false, // Hide the center label
																chartPadding: 10, // Padding around the chart
															};

															// Create the half donut chart
															new Chartist.Pie('#half-donut-chart', data, options);
														</script>


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