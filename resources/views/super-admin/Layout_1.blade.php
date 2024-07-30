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
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Artu Logistic</title>

<link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body>

<div class="main-wrapper">

<div class="header">

<div class="header-left">
<a href="{{ asset('/AdminPanel') }}" class="logo">
<img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
</a>
<a href="{{ asset('/AdminPanel') }}" class="logo logo-small">
<img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo">
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
<span>Super-Admin</span>
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
<li class="menu-title"><span>Artu Logistic</span></li>
<li>
<a href="{{ asset('/superpanel') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
</li>

<li>
    <a href="{{ asset('/super-courier') }}"><i data-feather="calendar"></i> <span>Courier Manage</span></a>
</li>


<li class="submenu">
<a href=""><i data-feather="package"></i> <span>Admin Manage</span><span class="menu-arrow"></span></a>
<ul>
    <li><a href="{{ asset('/super-new-admin') }}">Admin Registration</a></li>
    <li><a href="{{ asset('/super-all-admin') }}">All Admins</a></li>
    <!-- <li><a href="{{ asset('/merchant-summary') }}">Admins Summary</a></li> -->
</ul>
</li>

<li>
    <a href="{{ asset('/super-order-tracking-no') }}"><i data-feather="map-pin"></i> <span>Order Tracking</span></a>
</li>


</ul>


</div>
</div>
</div>






















<div class="page-wrapper">






@yield('bodycontent')









</div>






</div>
</div>

<!-- Success OR Message Box Hide Automatically in few seconds -->
<script>
setTimeout(function() {
    $('#returnmsgbox').fadeOut('slow');
}, 3000); 
</script>
<!-- Success OR Message Box Hide Automatically in few seconds -->


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/apexcharts.js') }}"></script>


</body>
</html>