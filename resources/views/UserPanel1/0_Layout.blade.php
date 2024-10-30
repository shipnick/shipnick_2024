@if(empty(session('UserLogin2')))
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
<a href="{{ asset('/UserPanel') }}" class="logo">
<img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
</a>
<a href="{{ asset('/UserPanel') }}" class="logo logo-small">
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
    
<img id="avatarImg" class="avatar-img" src="{{ asset('assets/img/profiles/avatar-01.png') }}" alt="{{ session('UserLogin2name') }}">

<span class="status online"></span>
</span>
<span>{{ session('UserLogin2name') }}</span>
</a>
<div class="dropdown-menu">
<!--<a class="dropdown-item" href="{{ asset('/UserPanel') }}"><i data-feather="user" class="me-1"></i> Profile</a>-->
<!--<a class="dropdown-item" href="{{ asset('/UserPanel') }}"><i data-feather="settings" class="me-1"></i> Settings</a>-->
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
<a href="{{ asset('/UserPanel') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
</li>
<li class="submenu">
<a href=""><i data-feather="upload"></i> <span>New / Upload orders</span><span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ asset('/UPSingle_Productbook') }}">Book Single Order</a></li>
<li><a href="{{ asset('/UPSingle_Product') }}">Single Order</a></li>
<li><a href="{{ asset('/UPBulk_Order') }}">Bulk Order</a></li>
</ul>
</li>
<li class="submenu">
<a href=""><i data-feather="package"></i> <span>Order Management</span><span class="menu-arrow"></span></a>
<ul>
    <!--<li><a href="{{ asset('/UPAll_Orders') }}">View Orders</a></li>-->
    <!--<li><a href="{{ asset('/UPAll_Pending_Orders') }}">Process Orders</a></li>-->
    <li><a href="{{ asset('/UPAll_Complete_Orders') }}">Delivered Orders</a></li>
    <li><a href="{{ asset('/UPAll_Cancel_Orders') }}">RTO Orders</a></li>
    <li><a href="{{ asset('/UPAll_Uploaded_Orders') }}">Not Picked Orders</a></li>
    <li><a href="{{ asset('/UPAll_Canceled_Orders') }}">Cancelled Orders</a></li>
    <li><a href="{{ asset('/failed-orders') }}">Failed Orders</a></li>
</ul>
</li>
<li class="submenu">
<a href=""><i data-feather="pie-chart"></i> <span>Reports</span><span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ asset('/UPManifest_Report') }}">MIS Report</a></li>
</ul>
</li>
<li class="submenu">
<a href=""><i data-feather="home"></i> <span>Hub Details</span><span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ asset('/UPAll_Hubs') }}">All Hub</a></li>
<li><a href="{{ asset('/UPNew_Hub') }}">Add new Hub</a></li>
</ul>
</li>
<!--<li>-->
<!--<a href=""><i data-feather="map-pin"></i> <span>PIN code service check</span></a>-->
<!--</li>-->
<li>
<a href=""><i data-feather="clipboard"></i> <span>Invoices</span></a>
</li>
<li>
    <a href="{{ asset('/Remittance') }}"><i data-feather="grid"></i> <span>COD Remittance</span></a>
</li>

<!-- @if(empty(session('UserLogin2actype'))) -->
    <!-- <li>
        <a href="{{ asset('/Wallet') }}"><i data-feather="credit-card"></i> <span>Wallet-1 {{ session('UserLogin2actype') }}</span></a>
    </li> -->
<!-- @endif -->


<li>
    <a href="{{ asset('/UPNDR_Report') }}"><i data-feather="calendar"></i> <span>Non-Delivery Report</span></a>
</li>
<li>
    <a href="{{ asset('/order-tracking') }}"><i data-feather="map-pin"></i> <span>Order Tracking</span></a>
</li>
<li>
    <a href="{{ asset('/Label_Print') }}"><i data-feather="printer"></i> <span>Print Shipping Label</span></a>
</li>
<li>
    <a class="dropdown-item" href="{{ asset('/setting') }}"><i data-feather="settings" class="me-1"></i> Settings</a>
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
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>


</body>
</html>