@if(empty(session('UserLogin2')))
<script type="text/javascript">
	window.location.assign("{{ asset('/AdminLogin') }}");
</script>
@endif
@php(error_reporting(1))





<!DOCTYPE html>
<html lang="en">



<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ session('UserLogin2name') }} User</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="{{asset('Admin/vendors/feather/feather.css')}}">
	<link rel="stylesheet" href="{{asset('Admin/vendors/ti-icons/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('Admin/vendors/css/vendor.bundle.base.css')}}">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
	<link rel="stylesheet" href="{{asset('Admin/vendors/ti-icons/css/themify-icons.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('Admin/js/select.dataTables.min.css')}}">
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('Admin/css/vertical-layout-light/style.css')}}">
	<!-- endinject -->
	<link rel="shortcut icon" href="{{asset('Admin/images/logo.jpg')}}" />
</head>

<body>
	<div class="container-scroller">

		<!-- partial:partials/_navbar.html -->
		<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
				<a class="navbar-brand brand-logo mr-5" href="{{asset('/UserPanel')}}">
				    <!--<img src="{{asset('Admin/images/logo.png')}}" class="mr-2" alt="logo" /></a>-->
				
				<img src="{{asset('Admin/images/logo.jpg')}}" class="" alt="logo" style="height: 60px;width: 100px;"  />
				<!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> -->
				
				<a class="navbar-brand brand-logo-mini" href="{{asset('/AdminPanel')}}"><img src="{{asset('Admin/images/logo.jpg')}}" alt="logo"/></a> 
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="icon-menu"></span>
				</button>
				<ul class="navbar-nav mr-lg-2">
					<!-- <li class="nav-item nav-search d-none d-lg-block">
						<div class="input-group">
							<div class="input-group-prepend hover-cursor" id="navbar-search-icon">
								<span class="input-group-text" id="search">
									<i class="icon-search"></i>
								</span>
							</div>
							<input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
						</div>
					</li> -->
				</ul>
				<ul class="navbar-nav navbar-nav-right">

					<li class="nav-item nav-profile dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
							<img src="{{asset('/Profiles/')}}/{{ session('UserLoginPic') }}" alt="profile" />
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

							<a class="dropdown-item" href="{{ asset('/Logout') }}">
								<i class="ti-power-off text-primary"></i>
								Logout
							</a>
						</div>
					</li>
                    <li class="nav-item nav-settings d-none d-lg-flex">
        				<span>{{ session('UserLogin2name') }}</span>
        		    </li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
					<span class="icon-menu"></span>
				</button>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">


			<!-- partial -->
			<!-- partial:partials/_sidebar.html -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/UserPanel') }}">
							<i class="icon-grid menu-icon"></i>
							<span class="menu-title">Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
							<i class="icon-layout menu-icon"></i>
							<span class="menu-title">New / Upload orders</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="ui-basic">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="{{ asset('/UPSingle_Productbook') }}">Book Single
										Order</a></li>
								<!-- <li class="nav-item"> <a class="nav-link" href="{{ asset('/UPSingle_Product') }}">Single Order</a> -->
								</li>
								<li class="nav-item"> <a class="nav-link" href="{{ asset('/UPBulk_Order') }}">Bulk Order</a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{asset('UPAll_Complete_Orders')}}">
							<i class="ti-clipboard menu-icon"></i>
							<span class="menu-title">All Orders</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
							<i class="icon-columns menu-icon"></i>
							<span class="menu-title">Reports</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="form-elements">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"><a class="nav-link" href="{{ asset('/UPManifest_Report') }}">MIS Report</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
							<i class="icon-bar-graph menu-icon"></i>
							<span class="menu-title">Hub Details</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="charts">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="{{ asset('/UPAll_Hubs') }}">All Hub</a></li>
								<li class="nav-item"> <a class="nav-link" href="{{ asset('/UPNew_Hub') }}">Add new Hub</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/Remittance') }}">
							<i class="ti-zip menu-icon"></i>
							<span class="menu-title">COD Remittance</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{asset('Wallet')}}">
							<i class="ti-wallet menu-icon"></i>
							<span class="menu-title">Wallet</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/UPNDR_Report') }}">
							<i class="ti-email menu-icon"></i>
							<span class="menu-title">Non-Delivery Report</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/order-tracking') }}">
							<i class="ti-location-pin menu-icon"></i>
							<span class="menu-title">Order Tracking</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/Label_Print') }}">
							<i class="icon-paper menu-icon"></i>
							<span class="menu-title">Print Shipping Label</span>
						</a>
					</li>



					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/setting') }}">
							<i class="icon-head menu-icon"></i>
							<span class="menu-title">Settings</span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- partial -->
			@yield('bodycontent')
			<!-- page-body-wrapper ends -->
		</div>
		<!-- container-scroller -->
		<script>
			setTimeout(function() {
				$('#returnmsgbox').fadeOut('slow');
			}, 3000);
		</script>

		<!-- plugins:js -->
		<script src="{{asset('Admin/vendors/js/vendor.bundle.base.js')}}"></script>
		<!-- endinject -->
		<!-- Plugin js for this page -->
		<script src="{{asset('Admin/vendors/chart.js/Chart.min.js')}}"></script>
		<script src="{{asset('Admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
		<script src="{{asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
		<script src="{{asset('Admin/js/dataTables.select.min.js')}}"></script>

		<!-- End plugin js for this page -->
		<!-- inject:js -->
		<script src="{{asset('Admin/js/off-canvas.js')}}"></script>
		<script src="{{asset('Admin/js/hoverable-collapse.js')}}"></script>
		<script src="{{asset('Admin/js/template.js')}}"></script>
		<script src="{{asset('Admin/js/settings.js')}}"></script>
		<script src="{{asset('Admin/js/todolist.js')}}"></script>
		<!-- endinject -->
		<!-- Custom js for this page-->
		<script src="{{asset('Admin/js/jquery.cookie.js')}}" type="text/javascript"></script>
		<script src="{{asset('Admin/js/dashboard.js')}}"></script>
		<script src="{{asset('Admin/js/Chart.roundedBarCharts.js')}}"></script>
		<!-- End custom js for this page-->
</body>



</html>