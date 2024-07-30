@extends('UserPanel.Layout')
@php(error_reporting(1))
@section('bodycontent')





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


<!--  -->
<div class="row">
    <div class="col-md-9"></div> 
    <div class="col-md-3">
<select class="form-control" style="height: 25px;padding: 0px;padding-left: 8px;">
    <option value="crtmonth">Today</option>
    <option value="crtmonth" selected>Current Month</option>
    <option value="crtmonth">Last Month</option>
    <option value="crtmonth">Last 30 Days</option>
    <option value="crtmonth">Last 90 Days</option>
</select>
    </div> 
</div> 
<div class="row my-2">

<style type="text/css">
.newcarddes {
    height: 2rem !important;
    width: 2rem !important;
}
.newfades {
    font-size:15px !important;
}
</style>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Total Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-5">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">00</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-5" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total Orders</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Intransit Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-6">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">00</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Intransit</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Out for delivery Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-7">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">00</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-7" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">OFD</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Delivered Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-8">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">00</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-8" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Delivered</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Return to origin Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-6">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">00</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">RTO</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Return to delivered Orders">
<div class="card-body">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-8">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">00</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-8" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">RTD</p>
</div>
</div>
</div>

</div>
<!--  -->



<div class="row">
<div class="col-xl-7 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Order Details</h5>
<!--<div class="dropdown">-->
<!--<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--Current Month-->
<!--</button>-->
<!--<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
<!--<li>-->
<!--<a href="javascript:void(0);" class="dropdown-item">Current Month</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="javascript:void(0);" class="dropdown-item">Last Month</a>-->
<!--</li>-->
<!--<li>-->
<!--<a href="javascript:void(0);" class="dropdown-item">Last 90 Days</a>-->
<!--</li>-->
<!--</ul>-->
<!--</div>-->
</div>
</div>
<div class="card-body">

<!--<div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">-->
<!--<div class="w-md-100 d-flex align-items-center mb-3">-->
<!--<div class="mx-2" title="Delivered">-->
<!--<span>Delivered</span>-->
<!--<p class="h3 text-success me-5">0</p>-->
<!--</div>-->
<!--<div class="mx-3" title="Return to delivered">-->
<!--<span>RTD</span>-->
<!--<p class="h3 text-danger me-5">0</p>-->
<!--</div>-->
<!--<div class="mx-2" title="Out for delivery">-->
<!--<span>OFD</span>-->
<!--<p class="h3 text-dark me-5">0</p>-->
<!--</div>-->
<!--<div class="mx-2" title="Return to origin">-->
<!--<span>RTO</span>-->
<!--<p class="h3 text-primary me-5">0</p>-->
<!--</div>-->
<!--<div class="mx-2" title="Intransit">-->
<!--<span>Intransit</span>-->
<!--<p class="h3 text-primary me-5">0</p>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

    <input type="hidden" id="febcod" value="{{ $ccodorders }}">
    <input type="hidden" id="febpre" value="{{ $cprepaid }}">
    <div id="sales_chart" class="text-center"></div>
</div>
</div>
</div>
<div class="col-xl-5 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Today Orders</h5>
<!-- <div class="dropdown">
    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Monthly
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li>
    <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
    </li>
    <li>
    <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
    </li>
    <li>
    <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
    </li>
    </ul>
</div> -->
</div>
</div>
<div class="card-body">
    <input type="hidden" id="codorders" value="{{ $tcodorders }}">
    <input type="hidden" id="prepaidorders" value="{{ $tprepaid }}">
 
    <div id="invoice_chart" class="text-center"></div>
    
<div class="text-center text-muted">
<div class="row">
    <div class="col-6">
    <div class="mt-4">
    <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> COD</p>
    <h5>{{ $tcodorders }}</h5>
    </div>
    </div>
    <div class="col-6">
    <div class="mt-4">
    <p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Prepaid</p>
    <h5>{{ $tprepaid }}</h5>
    </div>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>


<!--  -->
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css">
<div class="row">
<div class="col-lg-6">

<div class="card bg-white">
<div class="card-header">
<h5 class="card-title">India Map</h5>
</div>
<div class="card-body">
<div id="india" style="height: 400px"></div>
</div>
</div>

</div>
<div class="col-lg-6">
<div class="card bg-white">
<div class="card-header">
<h5 class="card-title">COD Remittance</h5>
</div>
<div class="card-body">
<!--  -->
<div class="row">
<div class="col-xl-4 col-sm-6 col-4">
<div class="card-body">
<div class="dash-widget-header">
<div class="dash-counts">
<?php 
    echo date("d-m-Y");
 ?>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-2" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Due Date</p>
</div>
</div>

<div class="col-xl-4 col-sm-6 col-4">
<div class="card-body">
<div class="dash-widget-header">
<div class="dash-counts">0</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-2" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total Orders</p>
</div>
</div>

<div class="col-xl-4 col-sm-6 col-4">
<div class="card-body">
<div class="dash-widget-header">
<div class="dash-counts">0</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-2" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Total Amt</p>
</div>
</div>
</div>
<!--  -->
</div>
</div>

</div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<!--<script src="assets/js/bootstrap.bundle.min.js"></script>-->
<script src="assets/js/feather.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-ru-mill.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-uk_countries-mill.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-in-mill.js"></script>
<script src="assets/js/jvectormap.js"></script>



@endsection
