@if(empty(session('UserLogin3')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminLogin') }}");
    </script>
@endif

@php(error_reporting(1))

<!doctype html>
<html class="fixed">
<head>
<!-- Basic -->
<meta charset="UTF-8">
<title>ShipXpress </title>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="author" content="Singhaniya">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!--  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--  -->

@yield('HeaderExtraFiles')

</head>
<body>
<section class="body">

<!-- start: header -->
<header class="header">
<div class="logo-container">
<a href="#" class="logo">
	<!-- <img src="{{ asset('Admin/assets/images/logo.png') }}" height="35" alt="Porto Admin" /> -->
	<h3 style="background-color: #000000ab;color: white;border-radius: 10px; margin-top: inherit;">
		&ensp;{{ session('UserLogin3name') }}&ensp;
	</h3>
</a>
<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
	<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
</div>
</div>

<!-- start: search & user box -->
<div class="header-right">
<span class="text-left" style="margin-right:200px;font-size: 18px;color: #e91e63;"><b>{{ session('status') }}</b></span>

<!-- <form action="javascript:void(0)" class="search nav-form">
	<div class="input-group input-search">
		<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form> -->

<span class="separator"></span>


<!-- <span class="separator"></span> -->

<div id="userbox" class="userbox">
	<a href="#" data-toggle="dropdown">
		<figure class="profile-picture">
			<img src="{{ asset('Admin/assets/images/!logged-user.jpg') }}" alt="Joseph Doe" class="img-circle" data-lock-picture="{{ asset('Admin/assets/images/!logged-user.jpg') }}" />
		</figure>
		<div class="profile-info" data-lock-name="Rider" data-lock-email="">
			<span class="name" style="background-color: #000000ab;color: white;border-radius: 10px; margin-top: inherit;font-size:18px">&ensp;{{ session('UserLogin3name') }}&ensp;</span>
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
<div class="sidebar-title"><a href="{{ asset('/AdminPanel') }}" style="color:white">ShipXpress</a></div>
<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
</div>
</div>

<div class="nano">
<div class="nano-content" style="background:#009688;">
<nav id="menu" class="nav-main" role="navigation">
	<ul class="nav nav-main">
		<li class="nav-active">
			<a href="{{ asset('/RiderPanel') }}">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<!-- <li class="nav-parent">
			<a>
				<i class="fa fa-folder-open" aria-hidden="true"></i>
				<span>Order Management</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="javascript:void(0)">
<i class="fa fa-search" aria-hidden="true" style="font-size:11px"></i>
					Search order</a></li>
				<li><a href="javascript:void(0)">
<i class="fa fa-filter" aria-hidden="true" style="font-size:11px"></i>
					Filter Order</a></li>
				<li><a href="javascript:void(0)">
<i class="fa fa-certificate" aria-hidden="true" style="font-size:11px"></i>
					Order Status</a></li>
			</ul>
		</li> -->
		<li class="nav-parent">
			<a>
				<i class="fa fa-folder-open" aria-hidden="true"></i>
				<span>Orders Management</span>
			</a>
			<ul class="nav nav-children">
				<li><a href="{{ asset('/RPSearch_Order') }}">
<i class="fa fa-search" aria-hidden="true" style="font-size:11px"></i>
					Search order</a></li>
				<li><a href="{{ asset('/RPPending_Order') }}">
<i class="fa fa-exclamation" aria-hidden="true" style="font-size:11px"></i>
					Pending</a></li>
				<li><a href="{{ asset('/RPComplete_Order') }}">
<i class="fa fa-cloud-download" aria-hidden="true" style="font-size:11px"></i>
					Complete</a></li>
				<li><a href="{{ asset('/RPCancel_Order') }}">
<i class="fa fa-ban" aria-hidden="true" style="font-size:11px"></i>
					Cancel</a></li>
				<!-- <li><a href="{{ asset('/RPAll_Order') }}">
<i class="fa fa-plus" aria-hidden="true" style="font-size:11px"></i>
					All Orders</a></li> -->
			</ul>
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

</body>
</html>


<style type="text/css">
	
.page-header {
    background: #e91e63;
}

ul.nav-main li .nav-children {
    background: #009688;
}

ul.nav-main > li.nav-expanded > a {
    background: #009688;
}

.sidebar-left {
    background: #009688;
    color: white;
}

.header {
    background: #ff9800;
}
.sidebar-left .sidebar-header .sidebar-toggle {
    background: #009688;
}
ul.nav-main > li > a:hover, ul.nav-main > li > a:focus {
    background-color: white;
}
ul.nav-main li a {
	color: black
	}
ul.nav-main li .nav-children li a:hover, ul.nav-main li .nav-children li a:focus {
    background: white;
}
ul.nav-main > li.nav-active > a:hover {
    color: black;
}
</style>