@extends("UserPanel/userpanel_layout1")
@section("userpanel")

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.css">
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<!-- row -->

	<div class="container-fluid">
		<div class="row invoice-card-row">
			<div class="col-md-12 mb-5 mt-5 ">
				<form class="rightcol" action="/new">
					<div class="collapsable" id="example4">
						<div class="row">
							<div class="col-4">
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
				</form>

			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-blue-bg ">
					<div class="card-body d-flex">
						<h6 class="text-black invoice-num f-24">{{$callcomplete}}</h6>

					</div>
					<span class="text-black fs-18  mb-4 text-center"><b>Total orders</b> <br> </span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-grey-bg">
					<div class="card-body d-flex">
						
						<h6 class="text-black invoice-num f-24">{{$monthpickup}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>Pending Pickups</b> <br></b></span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-yellow-bg">
					<div class="card-body d-flex">
						
						<h6 class="text-black invoice-num f-24">{{$callintransit}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>In Transit</b> </br></span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-green-bg">
					<div class="card-body d-flex">
						
						<h6 class="text-black invoice-num f-24">{{$calldeliverd}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>Delivered</b> <br></span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-pink-bg">
					<div class="card-body d-flex">
						
						<h6 class="text-black invoice-num f-24">{{$monthndr}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>NDR</b> <br></b></span>
				</div>
			</div>

			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-yellow-bg">
					<div class="card-body d-flex">
						
						<h6 class="text-black invoice-num f-24">{{$callretrun}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b> RTO </b><br></b></span>
				</div>
			</div>


		</div>
		<div class="row">
			<div class="col-xl-9 col-xxl-12">
				<div class="card">
					<div class="card-body">
						<div class="row align-items-center">

							<div class="col-xl-12">
								<div class="row align-items-center  mt-xl-0 mt-4">
									<div class="col-md-6">
										<h4 class="card-title">Today's Overview</h4>
										<!--<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit psu olor</span>-->
										<ul class="card-list mt-4">
											<li><span class="bg-blue circle f-24"></span>COD<span>{{$codPercentage}}%</span></li>
											<li><span class="bg-success circle"></span>Prepaid<span>{{$prepaidPercentage}} %</span></li>
											<!--<li><span class="bg-warning circle"></span>In Transit<span>15%</span></li>-->
											<!--<li><span class="bg-light circle"></span>Others<span>15%</span></li>-->
										</ul>
									</div>
									<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
									<div class="col-md-6" style="height:200px">
										<canvas id="pieChart"></canvas>
									</div>

									<script>
										// Get the canvas element by its id
										var canvas = document.getElementById('pieChart');

										// Create an initial data object for the pie chart
										var data = {
											labels: ['COD', 'Prepaid'],
											datasets: [{
												label: 'Dataset 1',
												data: [{
													{
														$codPercentage
													}
												}, {
													{
														$prepaidPercentage
													}
												}], // Pass percentages directly
												backgroundColor: ['blue', 'green'],
											}]
										};

										// Create configuration options for the pie chart
										var options = {
											responsive: true,
											maintainAspectRatio: false,
										};

										// Create a new pie chart instance
										var pieChart = new Chart(canvas, {
											type: 'pie', // Change chart type to pie
											data: data,
											options: options
										});
									</script>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="container-fluid">
		<div class="row ">

			<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card  invoice-card" style="background-color: #4d81cc">
					<div class="card-body d-flex">
						<div class="icon me-3">
							<svg width="33px" height="32px">
								<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
									d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
							</svg>

						</div>
						<div>
							<h2 class="text-black invoice-num f-24">{{ $talluploaded }}</h2>
							<span class="text-black fs-18">Today's Bookings</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12">

				<div class="card" style="background-color: #4d81cc">
					<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
						<div class="">
							<h4 class="card-title ">Shipment</h4>
						</div>

					</div>
					<div class="card-body tab-content orders-summary pt-3">
						<div class="tab-pane fade show active" id="Monthly">

							<div class="row text-center">
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24  counter ">{{ $talluploaded }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Booked</p>
								</div>
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24  counter">{{$tallpending}}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Pickup Pending</p>

								</div>
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $intransitupload }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">In-transit</p>
								</div>
								<div class="col-sm-2 mb-4">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $tallcomplete }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Delivered</p>
								</div>
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{$tallndr}}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">NDR Pending</p>
								</div>
								<div class="col-sm-2">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $tallcancel }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">RTO</p>
								</div>
							</div>

						</div>

					</div>
				</div>

			</div>


			<div class="row">
				@if ($MonthlyOrder > 0)
				@php
				$percentage_xpressbee = ($xpressbee / $MonthlyOrder) * 100;
				$percentage_ecom = ($Ecom / $MonthlyOrder) * 100;
				$percentage_bluedart = ($Bluedart / $MonthlyOrder) * 100;

				$percentage_xpressbeeFormatted = number_format($percentage_xpressbee, 2);
				$percentage_ecomFormatted = number_format($percentage_ecom, 2);
				$percentage_bluedartFormatted = number_format($percentage_bluedart, 2);
				@endphp
				@endif
				<div class="col-xl-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Courier Split</h4>
        </div>
        <div class="card-body">
            <div id="pie-chart" class="ct-chart ct-golden-section"></div>

            <style>
                /* Custom colors for the pie chart slices */
                .ct-series-a .ct-slice-pie {
                    fill: #FF5733; /* Custom Color 1 (e.g., Orange) */
                }

                .ct-series-b .ct-slice-pie {
                    fill: #ffbe33c9; /* Custom Color 2 (e.g., Lime Green) */
                }

                .ct-series-c .ct-slice-pie {
                    fill: #3357FF; /* Custom Color 3 (e.g., Blue) */
                }
            </style>

            <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script>

            <script>
                // Assuming these values are dynamically passed from your server or pre-set JavaScript variables
                var percentageXpressbee = {{ $percentage_xpressbeeFormatted ?? 0 }};
                var percentageEcom = {{ $percentage_ecomFormatted ?? 0 }};
                var percentageBluedart = {{ $percentage_bluedartFormatted ?? 0 }};

                // Example data for the chart
                var data = {
                    series: [percentageXpressbee, percentageEcom, percentageBluedart] // Numerical values for each series
                };

                // Creating the pie chart
                new Chartist.Pie('#pie-chart', data);
            </script>

            <div class="chart-legend">
                <ul>
                    <li><span style="color: #FF5733;">&#9679;</span> Xpressbees: {{ $percentage_xpressbeeFormatted ?? 0 }}%</li>
                    <li><span style="color: #ffbe33c9;">&#9679;</span> Ecomexpress: {{ $percentage_ecomFormatted ?? 0 }}%</li>
                    <li><span style="color: #3357FF;">&#9679;</span> Bluedart: {{ $percentage_bluedartFormatted ?? 0 }}%</li>
                </ul>
            </div>
        </div>
    </div>
</div>

				<div class="col-xl-4">
					<div class="card">
						<div class="card-body">
							<div class="profile-news">
								<h5 class="text d-inline ">Shipments - Zone Distribution</h5>
								<ul class="list-group mt-4">
									@foreach ($zoneCounts as $zone => $count)

									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mb-3">Zone {{ $zone }}</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted "> {{ $count }}</span>
									</li>

									@endforeach





								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="card">
						<div class="card-body">
							<div class="profile-news">
								<h5 class="text d-inline">Revenue</h5>
								<ul class="list-group mt-4">
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">Last 90 Days</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($last90DaysCount, 2) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">This Week</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($thisWeekCount, 2) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">This Month</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($thisMonthCount, 2) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">This Year</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($thisQuarterCount, 2) }}</span>
									</li>


								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row">

				<div class="col-lg-12">
					<div class="card">
						<div class="card-header light-blue-bg">
							<h4 class="card-title">Courier Wise Summary</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped verticle-middle table-responsive-sm">
									<thead>
										<tr>
											<!-- <th style="width:80px;"><strong>#</strong></th> -->
											<th><strong>Courier Name</strong></th>
											<th><strong>Total Shipments</strong></th>
											<th><strong>Pending Pickups</strong></th>
											<th><strong>In-Transit</strong></th>
											<th><strong>OFD</strong></th>
											<th><strong>Delivered</strong></th>
											<th><strong>RTO</strong></th>
										</tr>
									</thead>
									<tbody>

										<td><strong>Ecom</strong></td>
										@php
										$total1 = $data1['Bluedartcount'];
										$delivered1 = $data1['DeliveredBluedartcount'];
										$percentage1 = $total1 > 0 ? ($delivered1 / $total1) * 100 : 0;
										@endphp

										<td style="color:black">{{ $data1['Bluedartcount'] }}</td>
										<td style="color:black">{{ $data1['pendingBluedartcount'] }}</td>
										<td style="color:black">{{ $data1['inTransitBluedartcount'] }}</td>
										<td style="color:black">{{ $data1['OfdBluedartcount'] }}</td>
										<td style="color:black">{{ $data1['DeliveredBluedartcount'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage1, 2) }}%)</td>
										<td style="color:black">{{ $data1['RtoBluedartcount'] }}</td>
										<!-- Add other status types here in similar fashion -->
										</tr>

										</tr>
										@php
										$total = $data2['Bluedartcount'];
										$delivered = $data2['DeliveredBluedartcount'];
										$percentage = $total > 0 ? ($delivered / $total) * 100 : 0;
										@endphp

										<tr>
											<td><strong>Xpressbee</strong></td>
											<td style="color:black">{{ $data2['Bluedartcount'] }}</td>
											<td style="color:black">{{ $data2['pendingBluedartcount'] }}</td>
											<td style="color:black">{{ $data2['inTransitBluedartcount'] }}</td>
											<td style="color:black">{{ $data2['OfdBluedartcount'] }}</td>
											<td style="color:black">{{ $data2['DeliveredBluedartcount'] }}&nbsp; &nbsp; &nbsp; ({{ number_format($percentage, 2) }}%)</td>
											<td style="color:black">{{ $data2['RtoBluedartcount'] }}</td>




										</tr>
										<!--<tr>-->
										<!--	<td><strong>Shiprocket</strong></td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->

										<!--</tr>-->
										@php
										$total = $data3['Bluedartcount'];
										$delivered = $data3['DeliveredBluedartcount'];
										$percentage3 = $total > 0 ? ($delivered / $total) * 100 : 0;
										@endphp
										<tr>
											<td><strong>Bluedart</strong></td>
											<td style="color:black">{{ $data3['Bluedartcount'] }}</td>
											<td style="color:black">{{ $data3['pendingBluedartcount'] }}</td>
											<td style="color:black">{{ $data3['inTransitBluedartcount'] }}</td>
											<td style="color:black">{{ $data3['OfdBluedartcount'] }}</td>
											<td style="color:black">{{ $data3['DeliveredBluedartcount'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage3, 2) }}%)</td>
											<td style="color:black">{{ $data3['RtoBluedartcount'] }}</td>
										</tr>

									</tbody>
								</table>
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
		// Set default range to Last 7 Days
		var start = moment().subtract(6, 'days'); // 7 days ago
		var end = moment(); // Today

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
			// Show Last 7 Days initially
			cb(start, end);
		}

		// Handle the selection change
		$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
			// Redirect to the URL with the selected dates
			var url = "{{ url('UserPanel') }}?start_date=" + picker.startDate.format('YYYY-MM-DD') + "&end_date=" + picker.endDate.format('YYYY-MM-DD');
			window.location.href = url;
		});
	});
</script>

@endsection()