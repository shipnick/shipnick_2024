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
.card-body {
    padding: 0.5rem !important;
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
<span>{{ session('UserLogin2name') }}</span>
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
<li>
    <a href="{{ asset('/Wallet') }}"><i data-feather="credit-card"></i> <span>Wallet</span></a>
</li>
<li>
    <a href="{{ asset('/UPNDR_Report') }}"><i data-feather="calendar"></i> <span>Non-Delivery Report</span></a>
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























<!-- Date Time Data -->
<?php
// Current Month
  $crtmonth = date("m");
  $crtyear = date("Y");
  $crtmdays = cal_days_in_month(CAL_GREGORIAN, $crtmonth, $crtyear);
  $currentmonthstart ="1-$crtmonth-$crtyear";
  $currentmonthstend ="$crtmdays-$crtmonth-$crtyear";
  // echo "<br>Crt Month<br>";
  $currentmonthstart = date('d-m-Y',strtotime($currentmonthstart));
  // echo "&ensp;:&ensp;";
  $currentmonthstend = date('d-m-Y',strtotime($currentmonthstend));
// Current Month
  // echo "&ensp;&ensp;&ensp;&ensp;";
// Last Month
  $lstmonth = date("m",strtotime("-1 Month"));
  $lstyear = date("Y");
  $lstmdays = cal_days_in_month(CAL_GREGORIAN, $lstmonth, $lstyear);
  $lastmonthstart ="1-$lstmonth-$lstyear";
  $lastmonthstend ="$lstmdays-$lstmonth-$lstyear";
  // echo "<br>LAst Month<br>";
  $lastmonthstart = date('d-m-Y',strtotime($lastmonthstart));
  // echo "&ensp;:&ensp;";
  $lastmonthstend = date('d-m-Y',strtotime($lastmonthstend));
// Last Month
// YesterDay
  // echo "<br>Yesterday <br>";
    $yesterdaydate = date('d-m-Y',strtotime("-1 Days"));
// YesterDay

    // echo "<br>Today <br>";
    $stdate = date("d-m-Y");
    // echo "<br>Last 7 <br>";
    $e7days = date('d-m-Y',strtotime("-7 Days"));
    // echo "<br>Last 30 <br>";
    $e30days = date('d-m-Y',strtotime("-30 Days"));
    // echo "<br>Last 90 <br>";
    $e90days = date('d-m-Y',strtotime("-90 Days"));
    // echo "<br>Last 6 month Date<br>";
    $e6months = date('d-m-Y',strtotime("-6 Months"));
 ?>

?>
<!-- Today -->
<input type="hidden" name="todaydatecal" id="todaydatecal" value="<?= $stdate ?>">
<!-- YesterDay -->
<input type="hidden" name="yesterdayfdate" id="yesterdayfdate" value="<?= $yesterdaydate ?>">
<!-- Last 7 Days -->
<input type="hidden" name="last7dayscal" id="last7dayscal" value="<?= $e7days ?>">
<!-- Last 30 Days -->
<input type="hidden" name="last30dayscal" id="last30dayscal" value="<?= $e30days ?>">
<!-- Last 90 Days -->
<input type="hidden" name="last90dayscal" id="last90dayscal" value="<?= $e90days ?>">
<!-- Current Month -->
<input type="hidden" name="crtmonthfstart" id="crtmonthfstart" value="<?= $currentmonthstart ?>">
<input type="hidden" name="crtmonthfend" id="crtmonthfend" value="<?= $currentmonthstend ?>">
<!-- Last Month -->
<input type="hidden" name="lastmonthfstart" id="lastmonthfstart" value="<?= $lastmonthstend ?>">
<input type="hidden" name="lastmonthfend" id="lastmonthfend" value="<?= $lastmonthstart ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Date Time Data -->

<style type="text/css">
.page-wrapper {
    padding-top: 40px !important;
}
</style>


<div class="page-wrapper">
<div class="content container-fluid">

<div class="row">
<div class="col-xl-3 col-sm-6 col-12">
<div class="card" title="Today Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-4">
<i class="far fa-file"></i>
</span>
<div class="dash-count">
<!-- <div class="dash-title">Estimates</div> -->
<div class="dash-counts">
<p><span>COD : </span>{{ $tcodorders }}
<br>
<span>Prepaid : </span>{{ $tprepaid }}</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-8" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Today Orders</p>
</div>
</div>
</div>


<div class="col-xl-3 col-sm-6 col-12">
<div class="card" title="Current Month">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-3">
<i class="fas fa-file-alt"></i>
</span>
<div class="dash-count">
<!-- <div class="dash-title">Invoices</div> -->
<div class="dash-counts">
<p><span>COD : </span>{{ $ccodorders }}
<br>
<span>Prepaid : </span>{{ $cprepaid }}</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-7" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Current Month</p>
</div>
</div>
</div>


<div class="col-xl-3 col-sm-6 col-12">
<div class="card" title="COD Amount">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-1">
<i class="fas fa-rupee-sign"></i>
</span>
<div class="dash-count">
<!-- <div class="dash-title">COD Amount</div> -->
<div class="dash-counts">
<p>0.00</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-5" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">COD Amount</p>
</div>
</div>
</div>


<div class="col-xl-3 col-sm-6 col-12">
<div class="card" title="Outstanding Balance">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon bg-2">
<i class="fas fa-rupee-sign"></i>
</span>
<div class="dash-count">
<!-- <div class="dash-title">Outstanding Bal</div> -->
<div class="dash-counts">
<p>0.00</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Outstanding Balance</p>
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
<!--<div class="text-center text-muted">-->
<!--<div class="row">-->
<!--<div class="col-4">-->
<!--<div class="mt-4">-->
<!--<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> Invoiced</p>-->
<!--<h5>$ 2,132</h5>-->
<!--</div>-->
<!--</div>-->
<!--<div class="col-4">-->
<!--<div class="mt-4">-->
<!--<p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Received</p>-->
<!--<h5>$ 1,763</h5>-->
<!--</div>-->
<!--</div>-->
<!--<div class="col-4">-->
<!--<div class="mt-4">-->
<!--<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i> Pending</p>-->
<!--<h5>$ 973</h5>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
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
<!-- <div class="text-center text-muted">
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
</div> -->
@if(empty($l6total))
    <center><br> Data Not Found </center>
@endif
<div id="month6_chart"></div>

</div>
</div>
</div>
</div>

<div class="row">
<div class="col">

From : <span id="formdateshow"><?= $currentmonthstart ?></span>
&ensp;
To : <span id="todateshow"><?= date('d-m-Y') ?></span>

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
<input class="form-control datetimepicker" id="crtmonthfendfilter" type="text">
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="form-group">
<label>To</label>
<div class="cal-icon">
<input class="form-control datetimepicker" id="crtmonthfstartfilter" type="text">
</div>
</div>
</div>
<div class="col-sm-6 col-md-3">
<div class="form-group">
<label>&nbsp;</label>
<div>
<button type="submit" class="btn btn-success" onclick="ManageOrders()"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Search</button>
</div>

</div>
</div>
</div>
</div>
</div>



<script type="text/javascript">
function ManageOrders(){
    var enddatefrom = $("#crtmonthfendfilter").val();
    var startdatefrom = $("#crtmonthfstartfilter").val();
    // alert(enddatefrom);
    // alert(startdatefrom);
    $("#formdateshow").html(enddatefrom);
    $("#todateshow").html(startdatefrom);
// All Data Showing In a Row
    $.ajax({
    type: "GET",
    url: "{{ asset('/user-data-filter') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DataFilter"},
    success: function (data){
      $("#filterdatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
// All Data Showing In a Row
// Courier Wise Performance
    $.ajax({
    type: "GET",
    url: "{{ asset('/user-courierwise-performance') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DataFilter"},
    success: function (data){
        $("#courier_wise_chart").html(data);
        // console.log(data);
        const myJSON1 = JSON.stringify(data);
        // console.log(myJSON1);
        localStorage.setItem("testJSON", myJSON1);
        let text = localStorage.getItem("testJSON");
        let obj = JSON.parse(text);
        var a = obj.inintransit;
        var b = obj.niintransit;
        var c = obj.inrtd;
        var d = obj.nirtd;
        var e = obj.indelivered;
        var f = obj.nidelivered;
        CourierWisePerformance(a,b,c,d,e,f);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
// Courier Wise Performance
// Zone Wise Performance
$.ajax({
    type: "GET",
    url: "{{ asset('/user-zonewise-performance') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DefaultCurrentMonth"},
    success: function (data){
        // $("#courier_wise_chart").html(data);
        console.log(data);
        const myJSON1 = JSON.stringify(data);
        console.log(myJSON1);
        localStorage.setItem("testJSON", myJSON1);
        let text = localStorage.getItem("testJSON");
        let obj = JSON.parse(text);
            var a0 = obj.adlvd
            var a1 = obj.artd
            var a2 = obj.aintsit

            var b0 = obj.bdlvd
            var b1 = obj.brtd
            var b2 = obj.bintsit

            var c0 = obj.cdlvd
            var c1 = obj.crtd
            var c2 = obj.cintsit

            var d0 = obj.ddlvd
            var d1 = obj.drtd
            var d2 = obj.dintsit

            var e0 = obj.edlvd
            var e1 = obj.ertd
            var e2 = obj.eintsit

            var f0 = obj.fdlvd
            var f1 = obj.frtd
            var f2 = obj.fintsit
            ZoneWisePerformance(a0,a1,a2,b0,b1,b2,c0,c1,c2,d0,d1,d2,e0,e1,e2,f0,f1,f2);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
// Zone Wise Performance
}
</script>










<!-- Detailes Row -->
<script type="text/javascript"> 
$(document).ready(function() {
    var enddatefrom = $("#crtmonthfstart").val();
    var startdatefrom = $("#crtmonthfend").val();
    $.ajax({
    type: "GET",
    url: "{{ asset('/user-data-filter') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DefaultCurrentMonth"},
    success: function (data){
      $("#filterdatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
});
</script>
<!--  -->
<div class="row my-2" id="filterdatashows">
    <center>
        <div class="spinner-border" role="status"></div>    
    </center>
</div>
<!-- Detailes Rows -->















<div class="row">
<div class="col-xl-6 d-flex">
<div class="card flex-fill">

<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Courier Wise Performance</h5>
</div>
</div>

<div class="card-body">
    <div id="courier_wise_chart"></div>
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
    <div id="zone_wise_chart"></div>
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




<script type="text/javascript"> 
$(document).ready(function() {
    var enddatefrom = $("#crtmonthfstart").val();
    var startdatefrom = $("#crtmonthfend").val();
// Default Courier Wise Performance
    $.ajax({
    type: "GET",
    url: "{{ asset('/user-courierwise-performance') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DefaultCurrentMonth"},
    success: function (data){
        // $("#courier_wise_chart").html(data);
        console.log(data);
        const myJSON1 = JSON.stringify(data);
        console.log(myJSON1);
        localStorage.setItem("testJSON", myJSON1);
        let text = localStorage.getItem("testJSON");
        let obj = JSON.parse(text);
        var a = obj.inintransit;
        var b = obj.niintransit;
        var c = obj.inrtd;
        var d = obj.nirtd;
        var e = obj.indelivered;
        var f = obj.nidelivered;
        CourierWisePerformance(a,b,c,d,e,f);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
// Default Courier Wise Performance
// Default Delivery Wise Performance
    $.ajax({
    type: "GET",
    url: "{{ asset('/user-courierwise-performance') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DefaultCurrentMonth"},
    success: function (data){
        // $("#courier_wise_chart").html(data);
        console.log(data);
        const myJSON1 = JSON.stringify(data);
        console.log(myJSON1);
        localStorage.setItem("testJSON", myJSON1);
        let text = localStorage.getItem("testJSON");
        let obj = JSON.parse(text);
        var a = obj.inintransit;
        var b = obj.niintransit;
        var c = obj.inrtd;
        var d = obj.nirtd;
        var e = obj.indelivered;
        var f = obj.nidelivered;
        DelhiveryWisePerformance(e,f);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
// Default Delivery Wise Performance
// Default Zone Wise Performance
    $.ajax({
    type: "GET",
    url: "{{ asset('/user-zonewise-performance') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"DefaultCurrentMonth"},
    success: function (data){
        // $("#courier_wise_chart").html(data);
        console.log('Zone Sie');
        console.log(data);
        const myJSON1 = JSON.stringify(data);
        console.log(myJSON1);
        localStorage.setItem("testJSON", myJSON1);
        let text = localStorage.getItem("testJSON");
        let obj = JSON.parse(text);
            var a0 = obj.adlvd
            var a1 = obj.artd
            var a2 = obj.aintsit

            var b0 = obj.bdlvd
            var b1 = obj.brtd
            var b2 = obj.bintsit

            var c0 = obj.cdlvd
            var c1 = obj.crtd
            var c2 = obj.cintsit

            var d0 = obj.ddlvd
            var d1 = obj.drtd
            var d2 = obj.dintsit

            var e0 = obj.edlvd
            var e1 = obj.ertd
            var e2 = obj.eintsit

            var f0 = obj.fdlvd
            var f1 = obj.frtd
            var f2 = obj.fintsit
            ZoneWisePerformance(a0,a1,a2,b0,b1,b2,c0,c1,c2,d0,d1,d2,e0,e1,e2,f0,f1,f2);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
});
// Default Zone Wise Performance


// Last 6 Week Performance
var week6_ctx = document.getElementById("week6_chart"),
    week6_config = {
    chart: {
        height: 350,
        type: 'radialBar',
        toolbar: {
          show: false,
        }
    },
    colors: ['#7638ff', '#ff737b', '#fda600', '#999', '#1ec1b0'],
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
                        return <?= $w6total ?>
                    }
                }
            }
        }
    },
    series: [<?= $w6intransit ?>,<?= $w6ofd ?>,<?= $w6delivered ?>,<?= $w6rto ?>,<?= $w6rtd ?>],
    labels: ['Intransit', 'OFD', 'Delivered', 'RTO', 'RTD'],
};
    var week6_chart = new ApexCharts(week6_ctx, week6_config);
    week6_chart.render();
// Last 6 Week Performance
    
    

// Last 6 Month Details
var month6_ctx = document.getElementById("month6_chart"),
    month6_config = {
        colors: ['#7638ff', '#ff737b', '#fda600', '#999', '#1ec1b0'],
        series: [<?= $l6intransit ?>,<?= $l6ofd ?>,<?= $l6delivered ?>,<?= $l6rto ?>,<?= $l6rtd ?>],
        chart: {
            fontFamily: 'Poppins, sans-serif',
            height: 350,
            type: 'donut',
            toolbar: {
              show: false,
            }
        },
        labels: ['Intransit', 'OFD', 'Delivered', 'RTO', 'RTD'],
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
// Last 6 Month Details



function CourierWisePerformance(a,b,c,d,e,f){
    var inintransit = parseInt(a);
    var niintransit = parseInt(b);
    var tintransit =  inintransit + niintransit;
    var inrtd = parseInt(c);
    var nirtd = parseInt(d);
    var trtd =  inrtd + nirtd;
    var indelivered = parseInt(e);
    var nidelivered = parseInt(f);
    var tdelivered =  indelivered + nidelivered;
// Courier Wise Performance
var courier_wise_ctx = document.getElementById("courier_wise_chart"),
    courier_wise_config = {
        colors: ['#7638ff', '#22cc62', '#fda600'],
        series: [
            {
            name: "Intransit",
            type: "column",
            data: [tintransit]
            },
            {
            name: "RTD",
            type: "column",
            data: [trtd]
            },
            {
            name: "Delivered",
            type: "column",
            data: [tdelivered]
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
            categories: ['Shipments'],
        },
        yaxis: {
            title: {
                text: 'Orders'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Orders"
                }
            }
        }
    };
    var courier_wise_chart = new ApexCharts(courier_wise_ctx, courier_wise_config);
    courier_wise_chart.render();
// Courier Wise Performance
}




// Delhivery Wise Performance    
function DelhiveryWisePerformance(e,f){
    var indelivered = parseInt(e);
    var nidelivered = parseInt(f);
var delivery_wise_ctx = document.getElementById("delivery_wise_chart"),
    delivery_wise_config = {
        colors: ['#fda600'],
        series: [
            // {
            // name: "Received",
            // type: "column",
            // data: [70, 150]
            // },
            // {
            // name: "Delivered",
            // type: "column",
            // data: [23, 42]
            // },
            {
            name: "Delivered",
            type: "column",
            data: [indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,indelivered,nidelivered]
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
            categories: ['Amazon Logistics','Amazon Logistics 1 KG','Amazon Logistics 10 KG','Amazon Logistics 2 KG','Amazon Logistics 5 KG','Bluedart Express','Delhivery Air','Delhivery Surface','Delhivery Surface 10 K.G','Delhivery Surface 2 K.G','Delhivery Surface 20 K.G','Delhivery Surface 5 K.G','DTDC Air','DTDC Premium','DTDC Surface','DTDC Surface 1 K.G','DTDC Surface 10 K.G','DTDC Surface 5 K.G','Ecom EXP','Ecom ROS','Ekart','Ekart 1 K.G','Ekart 10 K.G','Ekart 2 K.G','Ekart 3 K.G','Ekart 5 K.G','Shadowfax','Shadowfax 1 K.G','Shadowfax 2 K.G','Shadowfax 5 K.G','Smartr','Udaan 10 KG','Udaan 5 KG','Xpressbees 1 K.G','Xpressbees 10 K.G','Xpressbees 2 K.G','Xpressbees 20 K.G','Xpressbees 5 K.G','Xpressbees Air','Xpressbees Surface'],
        },
        yaxis: {
            title: {
                text: 'Orders'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Orders"
                }
            }
        }
    };
    var delivery_wise_chart = new ApexCharts(delivery_wise_ctx, delivery_wise_config);
    delivery_wise_chart.render();
}
// Delhivery Wise Performance    



function ZoneWisePerformance(a0,a1,a2,b0,b1,b2,c0,c1,c2,d0,d1,d2,e0,e1,e2,f0,f1,f2){
    var adlvd = parseInt(a0);
    var artd = parseInt(a1);
    var aintsit = parseInt(a2);

    var bdlvd = parseInt(b0);
    var brtd = parseInt(b1);
    var bintsit = parseInt(b2);

    var cdlvd = parseInt(c0);
    var crtd = parseInt(c1);
    var cintsit = parseInt(c2);

    var ddlvd = parseInt(d0);
    // alert(ddlvd);
    var drtd = parseInt(d1);
    var dintsit = parseInt(d2);

    var edlvd = parseInt(e0);
    var ertd = parseInt(e1);
    var eintsit = parseInt(e2);

    var fdlvd = parseInt(f0);
    var frtd = parseInt(f1);
    var fintsit = parseInt(f2);
// Zone Wise Performance
var zone_wise_ctx = document.getElementById("zone_wise_chart"),
    zone_wise_config = {
        colors: ['#7638ff', '#22cc62', '#fda600'],
        series: [
            {
            name: "Intransit",
            type: "column",
            data: [aintsit,bintsit,cintsit,dintsit,eintsit,fintsit]
            },
            {
            name: "RTD",
            type: "column",
            data: [artd,brtd,crtd,drtd,ertd,frtd]
            },
            {
            name: "Delivered",
            type: "column",
            data: [adlvd,bdlvd,cdlvd,ddlvd,edlvd,fdlvd]
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
            categories: ['Zone-A','Zone-B','Zone-C','Zone-D','Zone-E','Zone-F'],
        },
        yaxis: {
            title: {
                text: 'Orders'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Orders"
                }
            }
        }
    };
    var zone_wise_chart = new ApexCharts(zone_wise_ctx, zone_wise_config);
    zone_wise_chart.render();
// Zone Wise Performance
}


        
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
