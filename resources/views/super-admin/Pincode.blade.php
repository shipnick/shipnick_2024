@extends('super-admin.Layout')

@section('bodycontent')
@php(error_reporting(1))
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Check PinCode Service </h2>
<div class="right-wrapper pull-right">
<!-- <ol class="breadcrumbs">
<li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li>
<li><span>Dashboard</span></li>
</ol>
<a class="sidebar-right-toggle">
</a> -->
</div>
</header>
<!-- Heading -->
<!-- start: page -->


<div class="row">

<div class="col-md-12 col-lg-6 col-xl-6">
	<section class="panel panel-featured-left panel-featured-primary">
		<div class="panel-body">
			<div class="widget-summary">
				<!-- <div class="widget-summary-col widget-summary-col-icon">
					<div class="summary-icon bg-primary">
						<i class="fa fa-life-ring"></i>
					</div>
				</div> -->
				<div class="widget-summary-col">
					<div class="summary">
						<h4 class="title">Check Pincode Availability</h4>
						<!-- <div class="info">
							<strong class="amount">1281</strong>
							<span class="text-primary">(14 unread)</span>
						</div> -->
<!-- <div class="panel-footer"> -->
<form method="post" action="{{ asset('/PincodeCheck') }}">
	<div class="input-group input-search">
		<input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode...">
		
		<span class="input-group-btn">
			@csrf
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
			</button>
		</span>
	</div>
</form>
<!-- </div> -->
					</div>
					<!-- <div class="summary-footer">
						<a class="text-muted text-uppercase">(view all)</a>
					</div> -->
				</div>
			</div>
		</div>
	</section>
</div>



<div class="col-md-12 col-lg-6 col-xl-6">
<section class="panel panel-featured-left panel-featured-primary">
	<div class="panel-body">
		<div class="widget-summary">
			
			<div class="widget-summary-col">
				<div class="summary"><br>
					<h4 class="title">Availability Result : {{ $totalpins }}</h4>
				</div>
			</div>
			
		</div>
	</div>
</section>
</div>




@if($params[0]['Status']=="Success")
	@foreach($pindetails as $pindetail)
<!--  -->
<div class="col-md-12 col-lg-6 col-xl-6">
	<section class="panel panel-featured-left panel-featured-secondary">
		<div class="panel-body">
			<div class="widget-summary">
<div class="widget-summary-col">
<div class="summary">
	<!-- <h4 class="title">Availability Result : {{ $totalpins }}</h4> -->
	<div class="info">
<!--  -->
		<div class="row" style="border-bottom:solid">
			<div class="col-md-6"><b>Name</b></div>
			<div class="col-md-6">{{ $pindetail['Name'] }}</div>
			<div class="col-md-6"><b>Circle</b></div>
			<div class="col-md-6">{{ $pindetail['Circle'] }}</div>
			<div class="col-md-6"><b>District</b></div>
			<div class="col-md-6">{{ $pindetail['District'] }}</div>
			<div class="col-md-6"><b>Division</b></div>
			<div class="col-md-6">{{ $pindetail['Division'] }}</div>
			<div class="col-md-6"><b>Region</b></div>
			<div class="col-md-6">{{ $pindetail['Region'] }}</div>
			<div class="col-md-6"><b>State</b></div>
			<div class="col-md-6">{{ $pindetail['State'] }}</div>
			<div class="col-md-6"><b>Country</b></div>
			<div class="col-md-6">{{ $pindetail['Country'] }}</div>
			<div class="col-md-6"><b>Pincode</b></div>
			<div class="col-md-6">{{ $pindetail['Pincode'] }}</div>
		</div>
<!--  -->
	</div>
</div>
</div>
			</div>
		</div>
	</section>
</div>
<!--  -->
			@endforeach
		@else
			<div class="row text-center">
				<strong>Result Not Found</strong>
			</div>
		@endif




</div>


<!-- end: page -->
</section>
@endsection