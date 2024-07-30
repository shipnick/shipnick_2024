@extends('RiderPanel.Layout')
@php(error_reporting(1))
@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
	<h2>Dashboard</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="{{ asset('/UserPanel') }}"><i class="fa fa-home"></i></a></li>
			<li><span>Dashboard</span></li>
		</ol>
		<a class="sidebar-right-toggle">
		</a>
	</div>
</header>
<!-- Heading -->

<!-- start: page -->
<!-- <div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel">
<div class="panel-body">
<div class="row">
	<div class="col-lg-8">
		<div class="chart-data-selector" id="salesSelectorWrapper">
			<h2>
				Sales:
				<strong>
					<select class="form-control" id="salesSelector">
						<option value="Porto Admin" selected>This Year</option>
						<option value="Porto Drupal" >Import</option>
						<option value="Porto Wordpress" >Export</option>
					</select>
				</strong>
			</h2>

			<div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
				<div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active"></div>
				<script>

					var flotDashSales1Data = [{
					    data: [
					        ["Jan", 140],
					        ["Feb", 240],
					        ["Mar", 190],
					        ["Apr", 140],
					        ["May", 180],
					        ["Jun", 320],
					        ["Jul", 270],
					        ["Aug", 180]
					    ],
					    color: "#0088cc"
					}];


				</script>

				<div class="chart chart-sm" data-sales-rel="Porto Drupal" id="flotDashSales2" class="chart-hidden"></div>
				<script>

					var flotDashSales2Data = [{
					    data: [
					        ["Jan", 240],
					        ["Feb", 240],
					        ["Mar", 290],
					        ["Apr", 540],
					        ["May", 480],
					        ["Jun", 220],
					        ["Jul", 170],
					        ["Aug", 190]
					    ],
					    color: "#2baab1"
					}];


				</script>

				<div class="chart chart-sm" data-sales-rel="Porto Wordpress" id="flotDashSales3" class="chart-hidden"></div>
				<script>

					var flotDashSales3Data = [{
					    data: [
					        ["Jan", 840],
					        ["Feb", 740],
					        ["Mar", 690],
					        ["Apr", 940],
					        ["May", 1180],
					        ["Jun", 820],
					        ["Jul", 570],
					        ["Aug", 780]
					    ],
					    color: "#734ba9"
					}];


				</script>
			</div>

		</div>
	</div>
	<div class="col-lg-4 text-center">
		<h2 class="panel-title mt-md">Sales Goal</h2>
		<div class="liquid-meter-wrapper liquid-meter-sm mt-lg">
			<div class="liquid-meter">
				<meter min="0" max="100" value="35" id="meterSales"></meter>
			</div>
			<div class="liquid-meter-selector" id="meterSalesSel">
				<a href="#" data-val="35" class="active">Monthly Goal</a>
				<a href="#" data-val="28">Annual Goal</a>
			</div>
		</div>
	</div>
</div>
</div>
</section>
</div>

</div>
 -->

<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel">
<div class="panel-body">
<div class="row">

 <h2 class="text-center">Welcome {{ session('UserLogin3name') }}</h2>

</div>
</div>
</section>
</div>
</div>







<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<div class="row">


	<div class="col-md-12 col-lg-6 col-xl-6">
		<section class="panel panel-featured-left panel-featured-primary">
			<div class="panel-body">
				<div class="widget-summary">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-primary">
							<i class="fa fa-globe" aria-hidden="true"></i>
							
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Total Orders</h4>
							<div class="info">
								<strong class="amount">{{ $allrecords }}</strong>
								<!-- <span class="text-primary">(14 unread)</span> -->
							</div>
						</div>
						<div class="summary-footer">
							<a class="text-muted text-uppercase" href="{{ asset('/RPAll_Order') }}">(view all)</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>


	<div class="col-md-12 col-lg-6 col-xl-6">
		<section class="panel panel-featured-left panel-featured-secondary">
			<div class="panel-body">
				<div class="widget-summary">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-secondary">
							<i class="fa fa-laptop" aria-hidden="true"></i>
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Complete Orders</h4>
							<div class="info">
								<strong class="amount">{{ $complete }}</strong>
							</div>
						</div>
						<div class="summary-footer">
							<a class="text-muted text-uppercase" href="{{ asset('/RPComplete_Order') }}">(View All)</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-12 col-lg-6 col-xl-6">
		<section class="panel panel-featured-left panel-featured-tertiary">
			<div class="panel-body">
				<div class="widget-summary">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-tertiary">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Pending Orders</h4>
							<div class="info">
								<strong class="amount">{{ $pending }}</strong>
							</div>
						</div>
						<div class="summary-footer">
							<a class="text-muted text-uppercase" href="{{ asset('/RPPending_Order') }}">(View All)</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-12 col-lg-6 col-xl-6">
		<section class="panel panel-featured-left panel-featured-quartenary">
			<div class="panel-body">
				<div class="widget-summary">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-quartenary">
							<i class="fa fa-ban" aria-hidden="true"></i>
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title">Cancel Orders</h4>
							<div class="info">
								<strong class="amount">{{ $cancel }}</strong>
							</div>
						</div>
						<div class="summary-footer">
							<a class="text-muted text-uppercase" href="{{ asset('/RPCancel_Order') }}">(View All)</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
</div>
</div>



<!-- end: page -->
</section>


@endsection