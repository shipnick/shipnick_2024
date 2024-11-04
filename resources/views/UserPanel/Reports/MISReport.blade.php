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

										

										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Order Type</label>
											<select name="order_type" class="default-select form-control wide w-100">
												<option value="" selected>Select...</option>
												<option value="cod">COD</option>
												<option value="prepaid">Prepaid</option>
												<option value="Reverse">Reverse </option>
											</select>
										</div>
										<!-- <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
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
										</div> -->

										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Hub</label>
											<select class="default-select form-control wide w-100" name="hub_id">
												<option value="">Select...</option>
												@foreach($hubs as $hubs)
												<option value="{{$hubs->hub_code}}">{{$hubs->hub_code}}({{$hubs->hub_name}})</option>
												@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Fulfilled by</label>
											<select class="default-select form-control wide w-100" name="Fulfilled_by">
												<option value="" selected>Select...</option>
												@foreach($Fulfilledby as $courier)
												<option value="{{$courier->name}}">{{$courier->name}}</option>
												@endforeach
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
<!-- <script>
	$(function() {
		// Initialize the date range picker
		$('#daterange').daterangepicker({
			opens: 'left',
			startDate: '{{ request()->get('
			from ', date("Y-m-d", strtotime("-30 days"))) }}',
			endDate: '{{ request()->get('
			to ', date("Y-m-d")) }}',
			locale: {
				format: 'YYYY-MM-DD'
			}
		}, function(start, end) {
			// Set the input value to the selected date range
			$('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
			// Update hidden input fields with selected dates
			$('#start_date').val(start.format('YYYY-MM-DD'));
			$('#end_date').val(end.format('YYYY-MM-DD'));
		});

		// Set the hidden fields if values are present on page load
		if ($('#daterange').val() === '') {
			$('#start_date').val('{{ request()->get('
				from ') }}');
			$('#end_date').val('{{ request()->get('
				to ') }}');
		}
	});
</script> -->
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