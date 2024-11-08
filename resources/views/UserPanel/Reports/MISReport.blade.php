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
								<h4 class="mb-3">MIS Reports</h4>


								<form method="GET" action="{{ asset('/UPMIS_Report_ExcelN') }}">
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



										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Order Type</label>
											<select name="order_type" class="default-select form-control wide w-100">
												<option value="" selected>Select</option>
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
												<option value="">Select</option>
												@foreach($hubs as $hubs)
												<option value="{{$hubs->hub_code}}">{{$hubs->hub_code}}({{$hubs->hub_name}})</option>
												@endforeach
											</select>
										</div>
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
											<label class="form-label">Fulfilled by</label>
											<select class="default-select form-control wide w-100" name="Fulfilled_by">
												<option value="" selected>Select</option>
												@foreach($Fulfilledby as $courier)
												<option value="{{$courier->name}}">{{$courier->name}}</option>
												@endforeach
											</select>
											<div class="invalid-feedback">
												Please provide a valid state.
											</div>
										</div>
									</div>



									<hr class="mb-4">
									<!--<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Download Report</button>-->
									<button type="submit" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Download Report</button>
									<br>

									
									<a id="lastMonthReport" href="#" class="btn btn-secondary ms-sm-auto mt-2 mb-sm-0">Last Month Report</a>
									<a id="currentMonthReport" href="#" class="btn btn-secondary ms-sm-auto mt-2 mb-sm-0">Current Month Report</a>


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

<script>
	// Function to get the first and last day of the current month
function getCurrentMonthDates() {
    const now = new Date();
    const firstDayOfCurrentMonth = new Date(now.getFullYear(), now.getMonth(), 1);
    const lastDayOfCurrentMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    
    return {
        currentMonthStart: formatDate(firstDayOfCurrentMonth),
        currentMonthEnd: formatDate(lastDayOfCurrentMonth)
    };
}

// Function to get the first and last day of the previous month
function getLastMonthDates() {
    const now = new Date();
    const firstDayOfLastMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
    const lastDayOfLastMonth = new Date(now.getFullYear(), now.getMonth(), 0);
    
    return {
        lastMonthStart: formatDate(firstDayOfLastMonth),
        lastMonthEnd: formatDate(lastDayOfLastMonth)
    };
}

// Format the date as YYYY-MM-DD
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Set the href attribute of the report links
function setReportLinks() {
    const currentMonth = getCurrentMonthDates();
    const lastMonth = getLastMonthDates();
    
    // Set the URLs for Last Month Report and Current Month Report
    const baseUrl = "/UPMIS_Report_ExcelN";
    
    // Last Month Report URL
    const lastMonthUrl = `${baseUrl}?fromdate=${lastMonth.lastMonthStart}&todate=${lastMonth.lastMonthEnd}&order_type=&hub_id=&Fulfilled_by=`;
    document.getElementById('lastMonthReport').href = lastMonthUrl;
    
    // Current Month Report URL
    const currentMonthUrl = `${baseUrl}?fromdate=${currentMonth.currentMonthStart}&todate=${currentMonth.currentMonthEnd}&order_type=&hub_id=&Fulfilled_by=`;
    document.getElementById('currentMonthReport').href = currentMonthUrl;
}

// Run the function on page load
window.onload = setReportLinks;

</script>
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