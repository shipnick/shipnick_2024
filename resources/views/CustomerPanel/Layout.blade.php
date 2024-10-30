@if(empty(session('UserLogin')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminLogin') }}");
    </script>
@endif


<!doctype html>
<html class="fixed">
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>ShipXpress Panel</title>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="author" content="Singhaniya">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/morris/morris.css') }}" />
<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme.css') }}" />
<!-- Skin CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/skins/default.css') }}" />
<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme-custom.css') }}">
<!-- Head Libs -->
<script src="{{ asset('Admin/assets/vendor/modernizr/modernizr.js') }}"></script>

@yield('HeaderExtraFiles')

</head>
<body>
<section class="body">

<!-- start: header -->
<header class="header">
<div class="logo-container">
<a href="#" class="logo">
	<!-- <img src="{{ asset('Admin/assets/images/logo.png') }}" height="35" alt="Porto Admin" /> -->
	<h4>User Panel</h4>
</a>
<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
	<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
</div>
</div>

<!-- start: search & user box -->
<div class="header-right">

<form action="javascript:void(0)" class="search nav-form">
	<div class="input-group input-search">
		<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form>

<span class="separator"></span>

<!-- <ul class="notifications">
<li>
	<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
		<i class="fa fa-tasks"></i>
		<span class="badge">3</span>
	</a>

	<div class="dropdown-menu notification-menu large">
		<div class="notification-title">
			<span class="pull-right label label-default">3</span>
			Tasks
		</div>

		<div class="content">
			<ul>
				<li>
					<p class="clearfix mb-xs">
						<span class="message pull-left">Generating Sales Report</span>
						<span class="message pull-right text-dark">60%</span>
					</p>
					<div class="progress progress-xs light">
						<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
					</div>
				</li>

				<li>
					<p class="clearfix mb-xs">
						<span class="message pull-left">Importing Contacts</span>
						<span class="message pull-right text-dark">98%</span>
					</p>
					<div class="progress progress-xs light">
						<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
					</div>
				</li>

				<li>
					<p class="clearfix mb-xs">
						<span class="message pull-left">Uploading something big</span>
						<span class="message pull-right text-dark">33%</span>
					</p>
					<div class="progress progress-xs light mb-xs">
						<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</li>
<li>
	<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
		<i class="fa fa-envelope"></i>
		<span class="badge">4</span>
	</a>

	<div class="dropdown-menu notification-menu">
		<div class="notification-title">
			<span class="pull-right label label-default">230</span>
			Messages
		</div>

		<div class="content">
			<ul>
				<li>
					<a href="#" class="clearfix">
						<figure class="image">
							<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Doe Junior" class="img-circle" />
						</figure>
						<span class="title">Joseph Doe</span>
						<span class="message">Lorem ipsum dolor sit.</span>
					</a>
				</li>
				<li>
					<a href="#" class="clearfix">
						<figure class="image">
							<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Junior" class="img-circle" />
						</figure>
						<span class="title">Joseph Junior</span>
						<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
					</a>
				</li>
				<li>
					<a href="#" class="clearfix">
						<figure class="image">
							<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joe Junior" class="img-circle" />
						</figure>
						<span class="title">Joe Junior</span>
						<span class="message">Lorem ipsum dolor sit.</span>
					</a>
				</li>
				<li>
					<a href="#" class="clearfix">
						<figure class="image">
							<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Junior" class="img-circle" />
						</figure>
						<span class="title">Joseph Junior</span>
						<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
					</a>
				</li>
			</ul>

			<hr />

			<div class="text-right">
				<a href="#" class="view-more">View All</a>
			</div>
		</div>
	</div>
</li>
<li>
	<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
		<i class="fa fa-bell"></i>
		<span class="badge">3</span>
	</a>

	<div class="dropdown-menu notification-menu">
		<div class="notification-title">
			<span class="pull-right label label-default">3</span>
			Alerts
		</div>

		<div class="content">
			<ul>
				<li>
					<a href="#" class="clearfix">
						<div class="image">
							<i class="fa fa-thumbs-down bg-danger"></i>
						</div>
						<span class="title">Server is Down!</span>
						<span class="message">Just now</span>
					</a>
				</li>
				<li>
					<a href="#" class="clearfix">
						<div class="image">
							<i class="fa fa-lock bg-warning"></i>
						</div>
						<span class="title">User Locked</span>
						<span class="message">15 minutes ago</span>
					</a>
				</li>
				<li>
					<a href="#" class="clearfix">
						<div class="image">
							<i class="fa fa-signal bg-success"></i>
						</div>
						<span class="title">Connection Restaured</span>
						<span class="message">10/10/2014</span>
					</a>
				</li>
			</ul>

			<hr />

			<div class="text-right">
				<a href="#" class="view-more">View All</a>
			</div>
		</div>
	</div>
</li>
</ul> -->

<!-- <span class="separator"></span> -->

<div id="userbox" class="userbox">
	<a href="#" data-toggle="dropdown">
		<figure class="profile-picture">
			<img src="{{ asset('Admin/assets/images/!logged-user.jpg') }}" alt="Joseph Doe" class="img-circle" data-lock-picture="{{ asset('Admin/assets/images/!logged-user.jpg') }}" />
		</figure>
		<div class="profile-info" data-lock-name="Admin Panel" data-lock-email="johndoe@okler.com">
			<span class="name">User Panel</span>
			<!-- <span class="role">administrator</span> -->
		</div>

		<i class="fa custom-caret"></i>
	</a>

	<div class="dropdown-menu">
		<ul class="list-unstyled">
			<li class="divider"></li>
			<!-- <li>
				<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
			</li> -->
			<li>
				<!-- <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Change Password</a> -->
			</li>
			<li>
				<a role="menuitem" tabindex="-1" href="{{ asset('/Logout') }}"><i class="fa fa-power-off"></i> Logout</a>
			</li>
		</ul>
	</div>
</div>
</div>
<!-- end: search & user box -->
</header>
<!-- end: header -->

<div class="inner-wrapper">
<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

<div class="sidebar-header">
<div class="sidebar-title">
ShipXpress
</div>
<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
</div>
</div>

<div class="nano">
<div class="nano-content">
<nav id="menu" class="nav-main" role="navigation">
	<ul class="nav nav-main">
		<li class="nav-active">
			<a href="{{ asset('/') }}">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Order Management</span>
			</a>
			<ul class="nav nav-children">
				<!-- <li><a href="{{ asset('/Search_Order') }}">Search order</a></li> -->
				<li><a href="javascript:void(0)">Search order</a></li>
				<li><a href="javascript:void(0)">Filter Order</a></li>
				<li><a href="javascript:void(0)">Order Status</a></li>
			</ul>
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Place Order</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="{{ asset('/Single_Product') }}">Single Product</a></li>
				<li><a href="{{ asset('/Bulk_Order') }}">Bulk Order</a></li>
				<li><a href="javascript:void(0)">Reverse Order</a></li>
				<li><a href="javascript:void(0)">Bulk Reverse Order</a></li>
				<!-- <li><a href="{{ asset('/Reverse_Order') }}">Reverse Order</a></li>
				<li><a href="{{ asset('/Bulk_Reverse_Order') }}">Bulk Reverse Order</a></li> -->
			</ul>
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Reports</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="javascript:void(0)">POD</a></li>
				<li><a href="javascript:void(0)">MIS</a></li>
				<li><a href="javascript:void(0)">Return POD</a></li>
				<li><a href="javascript:void(0)">Daily Summary</a></li>
			</ul>
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Billings</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="javascript:void(0)">All Bills</a></li>
				<li><a href="javascript:void(0)">Download Bills</a></li>
				<!-- <li><a href="javascript:void(0)">Option 3</a></li> -->
			</ul>
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Wallet</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="javascript:void(0)">Add Balance</a></li>
				<li><a href="javascript:void(0)">Wallet Details</a></li>
				<!-- <li><a href="javascript:void(0)">Option 3</a></li> -->
			</ul>
		</li>
		<li class="">
			<a href="{{ asset('/PincodeCheck') }}">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Pin Code Service Check</span>
			</a>
			<!-- <ul class="nav nav-children">
				<li><a href="{{ asset('/PincodeCheck') }}">Check Pincode</a></li>
				<li><a href="javascript:void(0)">Option 2</a></li>
				<li><a href="javascript:void(0)">Option 3</a></li>
			</ul> -->
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>NDR Management</span>
			</a>
			<!-- <ul class="nav nav-children">
				<li><a href="javascript:void(0)">Option 1</a></li>
				<li><a href="javascript:void(0)">Option 2</a></li>
				<li><a href="javascript:void(0)">Option 3</a></li>
			</ul> -->
		</li>
		<li class="nav-parent">
			<a>
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<span>Ticket Management</span>
			</a>
			<!-- <ul class="nav nav-children">
				<li><a href="javascript:void(0)">Option 1</a></li>
				<li><a href="javascript:void(0)">Option 2</a></li>
				<li><a href="javascript:void(0)">Option 3</a></li>
			</ul> -->
		</li>
	</ul>
</nav>

</div>

</div>

</aside>
<!-- end: sidebar -->























@yield('bodycontent')















</div>





<aside id="sidebar-right" class="sidebar-right">
<div class="nano">
<div class="nano-content">
	<a href="#" class="mobile-close visible-xs">
		Collapse <i class="fa fa-chevron-right"></i>
	</a>

	<div class="sidebar-right-wrapper">

		<div class="sidebar-widget widget-calendar">
			<h6>Upcoming Tasks</h6>
			<div data-plugin-datepicker data-plugin-skin="dark" ></div>

			<ul>
				<li>
					<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
					<span>Company Meeting</span>
				</li>
			</ul>
		</div>

		<div class="sidebar-widget widget-friends">
			<h6>Friends</h6>
			<ul>
				<li class="status-online">
					<figure class="profile-picture">
						<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
					</figure>
					<div class="profile-info">
						<span class="name">Joseph Doe Junior</span>
						<span class="title">Hey, how are you?</span>
					</div>
				</li>
				<li class="status-online">
					<figure class="profile-picture">
						<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
					</figure>
					<div class="profile-info">
						<span class="name">Joseph Doe Junior</span>
						<span class="title">Hey, how are you?</span>
					</div>
				</li>
				<li class="status-offline">
					<figure class="profile-picture">
						<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
					</figure>
					<div class="profile-info">
						<span class="name">Joseph Doe Junior</span>
						<span class="title">Hey, how are you?</span>
					</div>
				</li>
				<li class="status-offline">
					<figure class="profile-picture">
						<img src="{{ asset('Admin/assets/images/!sample-user.jpg') }}" alt="Joseph Doe" class="img-circle">
					</figure>
					<div class="profile-info">
						<span class="name">Joseph Doe Junior</span>
						<span class="title">Hey, how are you?</span>
					</div>
				</li>
			</ul>
		</div>

	</div>
</div>
</div>
</aside>
</section>









@yield('FooterExtraFiles')
<!-- Vendor -->
<script src="{{ asset('Admin/assets/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

<!-- Specific Page Vendor -->
<script src="{{ asset('Admin/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-appear/jquery.appear.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-easypiechart/jquery.easypiechart.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/raphael/raphael.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/morris/morris.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/gauge/gauge.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/snap-svg/snap.svg.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/jquery.vmap.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('Admin/assets/javascripts/theme.js') }}"></script>

<!-- Theme Custom -->
<script src="{{ asset('Admin/assets/javascripts/theme.custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('Admin/assets/javascripts/theme.init.js') }}"></script>


<!-- Examples -->
<script src="{{ asset('Admin/assets/javascripts/dashboard/examples.dashboard.js') }}"></script>
</body>
</html>