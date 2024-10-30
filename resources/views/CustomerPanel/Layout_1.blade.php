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
	<span class="text-left" style="margin-right:200px">{{ session('status') }}</span>

<form action="javascript:void(0)" class="search nav-form">
	<div class="input-group input-search">
		<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form>

<span class="separator"></span>


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
				<span>Billing</span>
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

</body>
</html>