@if(empty(session('UserLogin')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminLogin') }}");
    </script>
@endif

@php(error_reporting(1))

<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Shipdart</title>

<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<style>
.fontsizeone{
	font-size: 13px !important;
}

.p_margin{
	margin-top: 0px !important; 
	margin-bottom: 0px !important;
}

}
</style>
<body>

<div class="main-wrapper">

<div class="header">

<div class="header-left">
<a href="{{ asset('/AdminPanel') }}" class="logo">
<img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
</a>
<a href="{{ asset('/AdminPanel') }}" class="logo logo-small">
<img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
</a>
</div>


<a href="javascript:void(0);" id="toggle_btn">
<i class="fas fa-bars"></i>
</a>


<!--<div class="top-nav-search">-->
<!--<form>-->
<!--<input type="text" class="form-control" placeholder="Search here">-->
<!--<button class="btn" type="submit"><i class="fas fa-search"></i></button>-->
<!--</form>-->
<!--</div>-->


<a class="mobile_btn" id="mobile_btn">
<i class="fas fa-bars"></i>
</a>


<ul class="nav nav-tabs user-menu">




<li class="nav-item dropdown">
<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<i data-feather="bell"></i> 
    <!-- <span class="badge rounded-pill">0</span> -->
</a>
<div class="dropdown-menu notifications">
<div class="topnav-dropdown-header">
<span class="notification-title">Notifications</span>
<a href="javascript:void(0)" class="clear-noti"> Clear All</a>
</div>

</div>
</li>


<li class="nav-item dropdown has-arrow main-drop">
<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<span class="user-img">
<img src="{{ asset('/assets/img/profiles/avatar-01.png') }}" alt="">
<span class="status online"></span>
</span>
<span>Admin</span>
</a>
<div class="dropdown-menu">
<!--<a class="dropdown-item" href="{{ asset('/AdminPanel') }}"><i data-feather="user" class="me-1"></i> Profile</a>-->
<!--<a class="dropdown-item" href="{{ asset('/AdminPanel') }}"><i data-feather="settings" class="me-1"></i> Settings</a>-->
<a class="dropdown-item" href="{{ asset('/Logout') }}"><i data-feather="log-out" class="me-1"></i> Logout</a>
</div>
</li>

</ul>

</div>


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="menu-title"><span>Shipdart</span></li>
<li>
<a href="{{ asset('/AdminPanel') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
</li>

<li class="submenu">
<a href=""><i data-feather="package"></i> <span>Order Management</span><span class="menu-arrow"></span></a>
<ul>
    <li><a href="{{ asset('/All_Orders') }}">View Orders</a></li>
    <li><a href="{{ asset('/All_Orders_Pending') }}">Process Orders</a></li>
    <li><a href="{{ asset('/All_Orders_Complete') }}">Delivered Orders</a></li>
    <li><a href="{{ asset('/All_Orders_Cancel') }}">RTO Orders</a></li>
    <li><a href="{{ asset('/All_Orders_Uploaded') }}">Not Picked Orders</a></li>
    <li><a href="{{ asset('/All_Orders_Canceled') }}">Cancelled Orders</a></li>
    <li><a href="{{ asset('/afailed-orders') }}">Failed Orders</a></li>
</ul>
</li>

<li>
    <a href="{{ asset('/courier') }}"><i data-feather="calendar"></i> <span>Courier Manage</span></a>
</li>


<li class="submenu">
<a href=""><i data-feather="package"></i> <span>Merchants Manage</span><span class="menu-arrow"></span></a>
<ul>
    <li><a href="{{ asset('/New_Client') }}">Merchant Registration</a></li>
    <li><a href="{{ asset('/All_Client') }}">All Merchants</a></li>
    <li><a href="{{ asset('/merchant-summary') }}">Merchant Summary</a></li>
</ul>
</li>

<li class="submenu">
<a href=""><i data-feather="pie-chart"></i> <span>Reports</span><span class="menu-arrow"></span></a>
<ul>
    <!--<li><a href="{{ asset('/AComplete_POD_Report') }}">POD</a></li>-->
    <li><a href="{{ asset('/AMIS_Report') }}">MIS Report</a></li>
</ul>
</li>
<!--<li>-->
<!--    <a href=""><i data-feather="map-pin"></i> <span>PIN code service check</span></a>-->
<!--</li>-->
<li>
    <a href="{{ asset('/AReturn_POD_Report') }}"><i data-feather="calendar"></i> <span>Non-Delivery Report</span></a>
</li>
<!-- <li>
    <a href=""><i data-feather="printer"></i> <span>Print Shipping Lable</span></a>
</li> -->
</ul>
</div>
</div>
</div>


<div class="page-wrapper">
<div class="content container-fluid">
<div class="row">
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-file-alt newfadesone"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span>Manifest &nbsp; : </span>0</p>
<p class="p_margin"><span>Picked &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>
<p class="p_margin"><span>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>

</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Today Booking</p>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-2">
<i class="fas fa-file-alt newfadesone"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span>Delivered &nbsp; : </span>0</p>
<p class="p_margin"><span>RTD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>
<p class="p_margin"><span>OFD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>

</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Today Order Status</p>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fas fa-file-alt newfadesone"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span>Delivered &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>
<p class="p_margin"><span>RTO + RTD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>
<p class="p_margin"><span>OFD + Intransit &nbsp; : </span>0</p>

</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Current Month Orders</p>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-4">
<i class="fas fa-file-alt newfadesone"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span>Delivered &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>
<p class="p_margin"><span>RTO + RTD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>0</p>
<p class="p_margin"><span>OFD + Intransit &nbsp; : </span>0</p>

</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Last Month Orders</p>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Last 6 Week Performance</h5>

</div>
</div>
<div class="card-body">
<div class="text-center text-muted">
<div class="row">
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> Invoiced</p>
<h5>$ 2,132</h5>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Received</p>
<h5>$ 1,763</h5>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i> Pending</p>
<h5>$ 973</h5>
</div>
</div>
</div>
</div>
<div id="week6_chart"></div>

</div>
</div>
</div>
<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Last 6 Month Performance</h5>

</div>
</div>
<div class="card-body">
<div class="text-center text-muted">
<div class="row">
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> Invoiced</p>
<h5>$ 2,132</h5>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Received</p>
<h5>$ 1,763</h5>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i> Pending</p>
<h5>$ 973</h5>
</div>
</div>
</div>
</div>
<div id="month6_chart"></div>

</div>
</div>
</div>
</div>

<div class="row">
<div class="col">

</div>
<div class="col-auto">
<a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search" title="Serach Record">
<i class="fas fa-filter"></i>
</a>
</div>
</div>

<div id="filter_inputs" class="card filter-card">
<div class="card-body pb-0">
<div class="row">
<div class="col-sm-6 col-md-3">
<div class="form-group">
<label>From</label>
<div class="cal-icon">
<input class="form-control datetimepicker" type="text">
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="form-group">
<label>To</label>
<div class="cal-icon">
<input class="form-control datetimepicker" type="text">
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="form-group">
<label>&nbsp;</label>
<div>
<button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Search</button>
</div>

</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-xl-2 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-2">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span></span>0</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-2" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total Orders</p>
</div>
</div>
</div>
<div class="col-xl-2 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span></span>0</p>

</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-3" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total Intransit</p>
</div>
</div>
</div>
<div class="col-xl-2 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-4">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span></span>0</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-4" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total OFD</p>
</div>
</div>
</div>
<div class="col-xl-2 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-5">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span></span>0</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-1" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total Delivered</p>
</div>
</div>
</div>
<div class="col-xl-2 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-6">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span></span>0</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total RTO</p>
</div>
</div>
</div>
<div class="col-xl-2 col-sm-4 col-12">
<div class="card">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fas fa-file-alt newfadesone"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p class="p_margin"><span></span>0</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-3" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total RTD</p>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Courier Wise Performance</h5>

</div>
</div>
<div class="card-body">
<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
<div class="w-md-100 d-flex align-items-center mb-3">
<div>
<span>Total Orders</span>
<p class="h3 text-primary me-5">1000</p>
</div>
<div>
<span>Delivered</span>
<p class="h3 text-success me-5">1000</p>
</div>
<div>
<span>Pending</span>
<p class="h3 text-danger me-5" style="color: #fda600 !important;">300</p>
</div>

</div>
</div>
<div id="courier_wise_chart"></div>
</div>
</div>
</div>

<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Delivery Wise Performance</h5>

</div>
</div>
<div class="card-body">
<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
<div class="w-md-100 d-flex align-items-center mb-3">
<div>
<span>Total Orders</span>
<p class="h3 text-primary me-5">1000</p>
</div>
<div>
<span>Delivered</span>
<p class="h3 text-success me-5">1000</p>
</div>
<div>
<span>Pending</span>
<p class="h3 text-danger me-5" style="color: #fda600 !important;">300</p>
</div>
</div>
</div>
<div id="delivery_wise_chart"></div>
</div>
</div>
</div>

<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Zone Wise Performance</h5>

</div>
</div>
<div class="card-body">
<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
<div class="w-md-100 d-flex align-items-center mb-3">
<div>
<span>Total Orders</span>
<p class="h3 text-primary me-5">1000</p>
</div>
<div>
<span>Delivered</span>
<p class="h3 text-success me-5">1000</p>
</div>
<div>
<span>Pending</span>
<p class="h3 text-danger me-5" style="color: #fda600 !important;">300</p>
</div>
</div>
</div>
<div id="zone_wise_chart"></div>
</div>
</div>
</div>

<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">State Wise Performance</h5>

</div>
</div>
<div class="card-body">
<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
<div class="w-md-100 d-flex align-items-center mb-3">
<div>
<span>Total Orders</span>
<p class="h3 text-primary me-5">1000</p>
</div>
<div>
<span>Delivered</span>
<p class="h3 text-success me-5">1000</p>
</div>
<div>
<span>Pending</span>
<p class="h3 text-danger me-5" style="color: #fda600 !important;">300</p>
</div>
</div>
</div>
<div id="state_wise_chart"></div>
</div>
</div>
</div>

</div>

</div>

</div>






</div>
</div>


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/apexcharts.js') }}"></script>


</body>
</html>


<script>
var week6_ctx = document.getElementById("week6_chart"),
	week6_config = {
    chart: {
        height: 350,
        type: 'radialBar',
        toolbar: {
          show: false,
        }
    },
    // colors: ['#4361ee', '#888ea8', '#e3e4eb', '#d3d3d3'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function (w) {
                        return 249
                    }
                }
            }
        }
    },
    series: [44, 55, 67, 83],
    labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],    
};
	var week6_chart = new ApexCharts(week6_ctx, week6_config);
	week6_chart.render();
	
	
var month6_ctx = document.getElementById("month6_chart"),
	month6_config = {
		colors: ['#7638ff', '#ff737b', '#fda600', '#1ec1b0'],
		series: [55, 40, 20, 10],
		chart: {
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			type: 'donut',
			toolbar: {
              show: false,
            }
		},
		labels: ['Paid', 'Unpaid', 'Overdue', 'Draft'],
		legend: {show: false},
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 200
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var month6_chart = new ApexCharts(month6_ctx, month6_config);
	month6_chart.render();


var courier_wise_ctx = document.getElementById("courier_wise_chart"),
	courier_wise_config = {
		colors: ['#7638ff', '#22cc62', '#fda600'],
		series: [
			{
			name: "Received",
			type: "column",
			data: [70, 150, 80, 180, 150, 175, 201, 60, 200, 120, 190, 160, 50,222,123,234,321,222,143,432]
			},
			{
			name: "Delivered",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80, 23,12,45,23,24,35,56]
			},
			{
			name: "Pending",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80, 34,45,23,34,56,67,78]
			}
		],
		chart: {
			type: 'bar',
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '60%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories: ['01-03-2022', '02-03-2022', '03-03-2022', '04-03-2022', '05-03-2022', '06-03-2022', '07-03-2022', '08-03-2022', '09-03-2022', '10-03-2022', '11-03-2022', '12-03-2022', '13-03-2022', '14-03-2022', '15-03-2022', '16-03-2022', '17-03-2022', '18-03-2022', '19-03-2022', '20-03-2022'],
		},
		yaxis: {
			title: {
				text: '$ (thousands)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "$ " + val + " thousands"
				}
			}
		}
	};
	var courier_wise_chart = new ApexCharts(courier_wise_ctx, courier_wise_config);
	courier_wise_chart.render();
	
	
var delivery_wise_ctx = document.getElementById("delivery_wise_chart"),
	delivery_wise_config = {
		colors: ['#7638ff', '#22cc62', '#fda600'],
		series: [
			{
			name: "Received",
			type: "column",
			data: [70, 150, 80, 180, 150, 175, 201, 60, 200, 120, 190, 160, 50]
			},
			{
			name: "Delivered",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			},
			{
			name: "Pending",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			}
		],
		chart: {
			type: 'bar',
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '60%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
		},
		yaxis: {
			title: {
				text: '$ (thousands)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "$ " + val + " thousands"
				}
			}
		}
	};
	var delivery_wise_chart = new ApexCharts(delivery_wise_ctx, delivery_wise_config);
	delivery_wise_chart.render();
	
var zone_wise_ctx = document.getElementById("zone_wise_chart"),
	zone_wise_config = {
		colors: ['#7638ff', '#22cc62', '#fda600'],
		series: [
			{
			name: "Total",
			type: "column",
			data: [70, 150, 80, 180, 150, 175, 201, 60, 200, 120, 190, 160, 50]
			},
			{
			name: "Delivered",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			},
			{
			name: "Pending",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			}
		],
		chart: {
			type: 'bar',
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '60%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
		},
		yaxis: {
			title: {
				text: '$ (thousands)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "$ " + val + " thousands"
				}
			}
		}
	};
	var zone_wise_chart = new ApexCharts(zone_wise_ctx, zone_wise_config);
	zone_wise_chart.render();
	
		
var state_wise_ctx = document.getElementById("state_wise_chart"),
	state_wise_config = {
		colors: ['#7638ff', '#22cc62', '#fda600'],
		series: [
			{
			name: "Total",
			type: "column",
			data: [70, 150, 80, 180, 150, 175, 201, 60, 200, 120, 190, 160, 50]
			},
			{
			name: "Delivered",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			},
			{
			name: "Pending",
			type: "column",
			data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16, 80]
			}
		],
		chart: {
			type: 'bar',
			fontFamily: 'Poppins, sans-serif',
			height: 350,
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '60%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
		},
		yaxis: {
			title: {
				text: '$ (thousands)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "$ " + val + " thousands"
				}
			}
		}
	};
	var state_wise_chart = new ApexCharts(state_wise_ctx, state_wise_config);
	state_wise_chart.render();
</script>
