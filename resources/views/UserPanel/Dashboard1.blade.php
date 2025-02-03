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
			<div class="col-xl-6 col-xxl-6">
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




								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-xxl-6">
				<div class="card">
					<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
						<div class="">
							<h4 class="card-title ">Today's Shipment</h4>
						</div>

					</div>
					<div class="card-body tab-content orders-summary pt-3">
						<div class="tab-pane fade show active" id="Monthly">

							<div class="row text-center">
								<div class="col-sm-4 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24  counter ">{{ $talluploaded }}</h2>

									</div>
									<p class="fs-16 mb-0 text-black">Booked</p>
								</div>
								<div class="col-sm-4 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24  counter">{{$tallpending}}</h2>

									</div>
									<p class="fs-16 mb-0 text-black">Pickup Pending</p>

								</div>
								<div class="col-sm-4 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $intransitupload }}</h2>

									</div>
									<p class="fs-16 mb-0 text-black">In-transit</p>
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
									fill: #FF5733;
									/* Custom Color 1 (e.g., Orange) */
								}

								.ct-series-b .ct-slice-pie {
									fill: #ffbe33c9;
									/* Custom Color 2 (e.g., Lime Green) */
								}

								.ct-series-c .ct-slice-pie {
									fill: #3357FF;
									/* Custom Color 3 (e.g., Blue) */
								}

								/* Optional: Responsive Chart */
								#pie-chart {
									width: 100%;
									height: auto;
								}
							</style>

							<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script>

							<script>
								var percentageXpressbee = <?php echo isset($percentage_xpressbeeFormatted) ? $percentage_xpressbeeFormatted : 0; ?>;
								var percentageEcom = <?php echo isset($percentage_ecomFormatted) ? $percentage_ecomFormatted : 0; ?>;
								var percentageBluedart = <?php echo isset($percentage_bluedartFormatted) ? $percentage_bluedartFormatted : 0; ?>;

								// Ensure the percentages total 100 or adjust values if necessary
								var total = percentageXpressbee + percentageEcom + percentageBluedart;
								if (total !== 100) {
									console.warn('Percentages do not sum to 100, adjusting values.');
									// percentageXpressbee = (percentageXpressbee / total) * 100;
									percentageXpressbee = (percentageXpressbee / total) * 100;
									percentageEcom = (percentageEcom / total) * 100;
									percentageBluedart = (percentageBluedart / total) * 100;
								}

								// Data for the pie chart
								var data = {
									series: [percentageXpressbee, percentageEcom, percentageBluedart]
								};

								var options = {
									showLabel: true,
									chartPadding: 10,
									animation: {
										draw: function(data) {
											data.element.animate({
												d: {
													begin: 1000 * data.index,
													dur: 1000,
													from: data.path.clone().stringify(),
													to: data.path.clone().stringify()
												}
											});
										}
									}
								};

								// Create the pie chart
								new Chartist.Pie('#pie-chart', data, options);
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
											<th>Pending Pickups</th>
											<th>In-Transit</th>
											<th>OFD</th>
											<th>Delivered</th>
											<th>NDR</th>
											<th>RTO</th>
										</tr>
									</thead>

									<tbody>
										@foreach ($orderDetails as $courier => $details)

										@php
										$total = $details['totalOrders'] ;
										$delivered = $details['orderDelivered'] ;
										$percentage3 = $total > 0 ? ($delivered / $total) * 100 : 0;
										@endphp
										<tr>
											<td>{{ $courier }}</td>
											<td>{{ $details['totalOrders'] }}</td>
											<td>{{ $details['orderPending'] }}</td>
											<td>{{ $details['orderInTransit'] }}</td>
											<td>{{ $details['orderInOfd'] }}</td>
											<td>{{ $details['orderDelivered'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage3, 2) }}%)</td>
											<td>{{ $details['orderNdr'] }}</td>
											<td>{{ $details['orderRto'] }}</td>
										</tr>
										@endforeach
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