@extends('Admin.Layout_1')
@php(error_reporting(1))
@section('bodycontent')

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
<input type="hidden" name="crtmonthfstart" id="crtmonthfstart" value="<?= $currentmonthstend ?>">
<input type="hidden" name="crtmonthfend" id="crtmonthfend" value="<?= $currentmonthstart ?>">
<!-- Last Month -->
<input type="hidden" name="lastmonthfstart" id="lastmonthfstart" value="<?= $lastmonthstend ?>">
<input type="hidden" name="lastmonthfend" id="lastmonthfend" value="<?= $lastmonthstart ?>">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <div class="spinner-border" role="status"></div>     -->




<div class="content container-fluid">
<div class="row">


<style type="text/css">
.newcarddesone {
    height: 2rem !important;
    width: 2rem !important;
}
.newfadesone {
    font-size:15px !important;
}
.fontsizeone{
    font-size:13px !important;
}
.cardbodyone{
    padding:0.8rem !important;
}
</style>
    


<!-- Today Booking Details -->
<script type="text/javascript">
$(document).ready(function() {
    // alert("Booking");
    var enddatefrom = $("#todaydatecal").val();
    var startdatefrom = $("#todaydatecal").val();    
    var selectedname = "Today";
    $.ajax({
    type: "GET",
    url: "{{ asset('/AdminTodayBookingDash') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Today "},
    success: function (data){
      $("#todaybookingdatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
});
</script>
<div class="col-xl-3 col-sm-6 col-12" id="todaybookingdatashows">
        <div class="spinner-border" role="status"></div>
</div>
<!-- Today Booking Details -->


<!-- Today Details -->
<script type="text/javascript">
$(document).ready(function() {
    // alert("Last");
    var enddatefrom = $("#todaydatecal").val();
    var startdatefrom = $("#todaydatecal").val();    
    var selectedname = "Today";
    $.ajax({
    type: "GET",
    url: "{{ asset('/AdminTodayOrdersDash') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Today "},
    success: function (data){
      $("#todaydatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
});
</script>
<div class="col-xl-3 col-sm-6 col-12" id="todaydatashows">
        <div class="spinner-border" role="status"></div>
</div>
<!-- Today Details -->

<!-- Current Month -->
<script type="text/javascript">
$(document).ready(function() {
    // alert("crt");
    var enddatefrom = $("#crtmonthfend").val();
    var startdatefrom = $("#crtmonthfstart").val();
    var selectedname = "CurrentMonth";
    $.ajax({
    type: "GET",
    url: "{{ asset('/AdminCurrentMonthOrdersDash') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
    success: function (data){
      $("#currentmonthdatashow").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
});
</script>
<div class="col-xl-3 col-sm-6 col-12" id="currentmonthdatashow">
        <div class="spinner-border" role="status"></div>
</div>
<!-- Current Month -->

<!-- Last Month Details -->
<script type="text/javascript">
$(document).ready(function() {
    // alert("Last");
    var enddatefrom = $("#lastmonthfend").val();
    var startdatefrom = $("#lastmonthfstart").val();
    var selectedname = "LastMonth";
    $.ajax({
    type: "GET",
    url: "{{ asset('/AdminLastMonthOrdersDash') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last Month "},
    success: function (data){
      $("#lastmonthdatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
});
</script>
<div class="col-xl-3 col-sm-6 col-12" id="lastmonthdatashows">
        <div class="spinner-border" role="status"></div>
</div>
<!-- Last Month Details -->

<!-- <div class="col-xl-3 col-sm-6 col-12">
<div class="card" title="Outstanding Balance">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddesone bg-2">
<i class="fas fa-rupee-sign newfadesone"></i>
</span>
<div class="dash-count fontsizeone">
<div class="dash-counts">
<p>0.00</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0 fontsizeone">Outstanding Balance</p>
</div>
</div>
</div> -->

</div>

























<!--  -->
<div class="row" style="margin-top:-20px;">
    <div class="col-md-9"></div> 
    <div class="col-md-3">
<select class="form-control" onchange="ManageOrders(this.value)" style="height: 25px;padding: 0px;padding-left: 8px;">
    <option value="crtmonth">Current Month</option>
    <option value="lastmonth">Last Month</option>
    <option value="last30days">Last 30 Days</option>
    <option value="last90days">Last 90 Days</option>
</select>
    </div> 
</div>

<script type="text/javascript">
$(document).ready(function() {
    var enddatefrom = $("#crtmonthfend").val();
    var startdatefrom = $("#crtmonthfstart").val();
    var selectedname = "CurrentMonth";
    $.ajax({
    type: "GET",
    url: "{{ asset('/AdminCurrentMonthOrders') }}",
    data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
    success: function (data){
      $("#filterdatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });


// Courier Details
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierOrders') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
success: function (data){
// 
// alert(data);
document.getElementById("invoice_chartlm").style.display = "none";
document.getElementById("invoice_chartl30").style.display = "none";
document.getElementById("invoice_chartl90").style.display = "none";
document.getElementById("invoice_chartcm").style.display = "block";
var xb = data['dl'];
var dl = data['xb'];
var pieCtx1 = document.getElementById("invoice_chartcm"),
pieConfig1 = {
colors: ['#22cc62', '#ff737b'],
series: [dl, xb],
chart: {
    fontFamily: 'Poppins, sans-serif',
    height: 350,
    type: 'donut',
},
labels: ['Delhivery Orders', 'Xpressbees Orders'],
legend: {show: false},
responsive: [{
    // breakpoint: 480,
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
var pieChart1 = new ApexCharts(pieCtx1, pieConfig1);
pieChart1.render();
// 
},
error: function (data) {
console.log('Error:', data);
}
});
// Courier Details
// Courier Performance
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierPerformance') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
success: function (data){
// 
// alert(data);
document.getElementById("courier_wise_90d").style.display = "none";
document.getElementById("courier_wise_30d").style.display = "none";
document.getElementById("courier_wise_lst").style.display = "none";
document.getElementById("courier_wise_crt").style.display = "block";

var ddld = data['dldelivered'];
var drtd = data['dlrtd'];
var ditd = data['dlintransit'];
var xdld = data['xbdelivered'];
var xrtd = data['xbrtd'];
var xitd = data['xbintransit'];
var columnCtx1 = document.getElementById("courier_wise_crt"),
columnConfig1 = {
colors: ['#7638ff','#999','#fda600'],
series: [
    {
    name: "Delivered",
    type: "column",
    data: [ddld,xdld]
    },
    {
    name: "RTD",
    type: "column",
    data: [drtd,xrtd]
    },
    {
    name: "Intransit",
    type: "column",
    data: [ditd,xitd]
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
    categories: ['Delhivery','Xpressbees'],
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
var columnChart1 = new ApexCharts(columnCtx1, columnConfig1);
columnChart1.render();
// 
    },
        error: function (data) {
          console.log('Error:', data);
        }
        });
// Courier Performance
// Current Weekly Order Performance
$.ajax({
type: "GET",
url: "{{ asset('/AdminWeeklyPerformanceDash') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
success: function (data){
// 
// alert(data['ab']);
// console.log(data['abc']);
var mocod = 0;
var mopre = 0;
var tucod = 0;
var tupre = 0;
var wecod = data['cod'];
var wepre = data['prepaid'];
var thcod = 0;
var thpre = 0;
var frcod = 0;
var frpre = 0;
var sacod = 0;
var sapre = 0;
var sucod = 0;
var supre = 0;

var columnCtxcm28 = document.getElementById("weekly_performance"),
columnConfigcm28 = {
colors: ['#7638ff', '#fda600'],
series: [
    {
    name: "COD",
    type: "column",
    data: [mocod,tucod,wecod,thcod,frcod,sacod,sucod]
    },
    {
    name: "Prepaid",
    type: "column",
    data: [mopre,tupre,wepre,thpre,frpre,sapre,supre]
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
    categories: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
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
var columnChartcm28 = new ApexCharts(columnCtxcm28, columnConfigcm28);
columnChartcm28.render();
// 
},
error: function (data) {
  console.log('Error:', data);
}
});
// Current Weekly Order Performance

});

function ManageOrders(val){
    if(val == "crtmonth"){
    var enddatefrom = $("#crtmonthfend").val();
    var startdatefrom = $("#crtmonthfstart").val();
    var selectedname = "CurrentMonth";
        $.ajax({
        type: "GET",
        url: "{{ asset('/AdminCurrentMonthOrders') }}",
        data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
        success: function (data){
          $("#filterdatashows").html(data);
        },
        error: function (data) {
          console.log('Error:', data);
        }
        });

// Courier Details
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierOrders') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
success: function (data){
// 
document.getElementById("invoice_chartlm").style.display = "none";
document.getElementById("invoice_chartl30").style.display = "none";
document.getElementById("invoice_chartl90").style.display = "none";
document.getElementById("invoice_chartcm").style.display = "block";
var xb = data['dl'];
var dl = data['xb'];
var pieCtx1 = document.getElementById("invoice_chartcm"),
pieConfig1 = {
colors: ['#22cc62', '#ff737b'],
series: [dl, xb],
chart: {
    fontFamily: 'Poppins, sans-serif',
    height: 350,
    type: 'donut',
},
labels: ['Delhivery Orders', 'Xpressbees Orders'],
legend: {show: false},
responsive: [{
    // breakpoint: 480,
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
var pieChart1 = new ApexCharts(pieCtx1, pieConfig1);
pieChart1.render();
// 
},
error: function (data) {
console.log('Error:', data);
}
});
// Courier Details
// Courier Details
// Courier Performance
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierPerformance') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Current Month "},
success: function (data){
// 
    document.getElementById("courier_wise_90d").style.display = "none";
    document.getElementById("courier_wise_30d").style.display = "none";
    document.getElementById("courier_wise_lst").style.display = "none";
    document.getElementById("courier_wise_crt").style.display = "block";

var ddld = data['dldelivered'];
var drtd = data['dlrtd'];
var ditd = data['dlintransit'];
var xdld = data['xbdelivered'];
var xrtd = data['xbrtd'];
var xitd = data['xbintransit'];
var columnCtx1 = document.getElementById("courier_wise_crt"),
columnConfig1 = {
    colors: ['#7638ff','#999','#fda600'],
series: [
    {
    name: "Delivered",
    type: "column",
    data: [ddld,xdld]
    },
    {
    name: "RTD",
    type: "column",
    data: [drtd,xrtd]
    },
    {
    name: "Intransit",
    type: "column",
    data: [ditd,xitd]
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
        categories: ['Delhivery','Xpressbees'],
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
var columnChart1 = new ApexCharts(columnCtx1, columnConfig1);
columnChart1.render();
// 
},
error: function (data) {
  console.log('Error:', data);
}
});
// Courier Performance

    }










    if(val == "lastmonth"){
    var enddatefrom = $("#lastmonthfend").val();
    var startdatefrom = $("#lastmonthfstart").val();
    var selectedname = "Lastmonth";
        $.ajax({
        type: "GET",
        url: "{{ asset('/AdminLastMonthOrders') }}",
        data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last Month "},
        success: function (data){
          $("#filterdatashows").html(data);
        },
        error: function (data) {
          console.log('Error:', data);
        }
        });


// Courier Details
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierOrders') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last Month "},
success: function (data){
// 
document.getElementById("invoice_chartl30").style.display = "none";
document.getElementById("invoice_chartl90").style.display = "none";
document.getElementById("invoice_chartcm").style.display = "none";
document.getElementById("invoice_chartlm").style.display = "block";
var xb = data['dl'];
var dl = data['xb'];
var pieCtx1 = document.getElementById("invoice_chartlm"),
pieConfig1 = {
colors: ['#22cc62', '#ff737b'],
series: [dl, xb],
chart: {
    fontFamily: 'Poppins, sans-serif',
    height: 350,
    type: 'donut',
},
labels: ['Delhivery Orders', 'Xpressbees Orders'],
legend: {show: false},
responsive: [{
    // breakpoint: 480,
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
var pieChart1 = new ApexCharts(pieCtx1, pieConfig1);
pieChart1.render();
// 
},
error: function (data) {
console.log('Error:', data);
}
});
// Courier Details
// Courier Performance
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierPerformance') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last Month "},
success: function (data){
// 
    document.getElementById("courier_wise_90d").style.display = "none";
    document.getElementById("courier_wise_30d").style.display = "none";
    document.getElementById("courier_wise_crt").style.display = "none";
    document.getElementById("courier_wise_lst").style.display = "block";

var ddld = data['dldelivered'];
var drtd = data['dlrtd'];
var ditd = data['dlintransit'];
var xdld = data['xbdelivered'];
var xrtd = data['xbrtd'];
var xitd = data['xbintransit'];
var columnCtx1 = document.getElementById("courier_wise_lst"),
columnConfig1 = {
    colors: ['#7638ff','#999','#fda600'],
series: [
    {
    name: "Delivered",
    type: "column",
    data: [ddld,xdld]
    },
    {
    name: "RTD",
    type: "column",
    data: [drtd,xrtd]
    },
    {
    name: "Intransit",
    type: "column",
    data: [ditd,xitd]
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
        categories: ['Delhivery','Xpressbees'],
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
var columnChart1 = new ApexCharts(columnCtx1, columnConfig1);
columnChart1.render();
// 
},
error: function (data) {
  console.log('Error:', data);
}
});
// Courier Performance

    }






    if(val == "last30days"){
    var enddatefrom = $("#last30dayscal").val();
    var startdatefrom = $("#todaydatecal").val();
    var selectedname = "Last30days";
        $.ajax({
        type: "GET",
        url: "{{ asset('/Admin30DaysOrders') }}",
        data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last 30 "},
        success: function (data){
          $("#filterdatashows").html(data);
        },
        error: function (data) {
          console.log('Error:', data);
        }
        });


// Courier Details
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierOrders') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last 30 "},
success: function (data){
// 
document.getElementById("invoice_chartl90").style.display = "none";
document.getElementById("invoice_chartcm").style.display = "none";
document.getElementById("invoice_chartlm").style.display = "none";
document.getElementById("invoice_chartl30").style.display = "block";
var xb = data['dl'];
var dl = data['xb'];
var pieCtx1 = document.getElementById("invoice_chartl30"),
pieConfig1 = {
colors: ['#22cc62','#ff737b'],
series: [dl, xb],
chart: {
    fontFamily: 'Poppins, sans-serif',
    height: 350,
    type: 'donut',
},
labels: ['Delhivery Orders', 'Xpressbees Orders'],
legend: {show: false},
responsive: [{
    // breakpoint: 480,
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
var pieChart1 = new ApexCharts(pieCtx1, pieConfig1);
pieChart1.render();
// 
},
error: function (data) {
console.log('Error:', data);
}
});
// Courier Details
// Courier Performance
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierPerformance') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last 30 "},
success: function (data){
// 
    document.getElementById("courier_wise_90d").style.display = "none";
    document.getElementById("courier_wise_lst").style.display = "none";
    document.getElementById("courier_wise_crt").style.display = "none";
    document.getElementById("courier_wise_30d").style.display = "block";
var ddld = data['dldelivered'];
var drtd = data['dlrtd'];
var ditd = data['dlintransit'];
var xdld = data['xbdelivered'];
var xrtd = data['xbrtd'];
var xitd = data['xbintransit'];
var columnCtx1 = document.getElementById("courier_wise_30d"),
columnConfig1 = {
colors: ['#7638ff','#999','#fda600'],
series: [
    {
    name: "Delivered",
    type: "column",
    data: [ddld,xdld]
    },
    {
    name: "RTD",
    type: "column",
    data: [drtd,xrtd]
    },
    {
    name: "Intransit",
    type: "column",
    data: [ditd,xitd]
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
    categories: ['Delhivery','Xpressbees'],
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
var columnChart1 = new ApexCharts(columnCtx1, columnConfig1);
columnChart1.render();
// 
},
error: function (data) {
  console.log('Error:', data);
}
});
// Courier Performance


    }





    if(val == "last90days"){
    var enddatefrom = $("#last90dayscal").val();
    var startdatefrom = $("#todaydatecal").val();
    var selectedname = "Last90days";
        $.ajax({
        type: "GET",
        url: "{{ asset('/Admin90DaysOrders') }}",
        data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last 90 "},
        success: function (data){
          $("#filterdatashows").html(data);
        },
        error: function (data) {
          console.log('Error:', data);
        }
        });



// Courier Details
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierOrders') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last 90 "},
success: function (data){
// 
document.getElementById("invoice_chartcm").style.display = "none";
document.getElementById("invoice_chartlm").style.display = "none";
document.getElementById("invoice_chartl30").style.display = "none";
document.getElementById("invoice_chartl90").style.display = "block";
var xb = data['dl'];
var dl = data['xb'];
var pieCtx1 = document.getElementById("invoice_chartl90"),
pieConfig1 = {
colors: ['#22cc62','#ff737b'],
series: [dl, xb],
chart: {
    fontFamily: 'Poppins, sans-serif',
    height: 350,
    type: 'donut',
},
labels: ['Delhivery Orders', 'Xpressbees Orders'],
legend: {show: false},
responsive: [{
    // breakpoint: 480,
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
var pieChart1 = new ApexCharts(pieCtx1, pieConfig1);
pieChart1.render();
// 
},
error: function (data) {
console.log('Error:', data);
}
});
// Courier Details
// Courier Performance
$.ajax({
type: "GET",
url: "{{ asset('/Admin90DaysCourierPerformance') }}",
data:{startdatefrom:startdatefrom,enddatefrom:enddatefrom,val:"Last 90 "},
success: function (data){
// 
    document.getElementById("courier_wise_30d").style.display = "none";
    document.getElementById("courier_wise_lst").style.display = "none";
    document.getElementById("courier_wise_crt").style.display = "none";
    document.getElementById("courier_wise_90d").style.display = "block";
var ddld = data['dldelivered'];
var drtd = data['dlrtd'];
var ditd = data['dlintransit'];
var xdld = data['xbdelivered'];
var xrtd = data['xbrtd'];
var xitd = data['xbintransit'];
var columnCtx1 = document.getElementById("courier_wise_90d"),
columnConfig1 = {
colors: ['#7638ff','#999','#fda600'],
series: [
    {
    name: "Delivered",
    type: "column",
    data: [ddld,xdld]
    },
    {
    name: "RTD",
    type: "column",
    data: [drtd,xrtd]
    },
    {
    name: "Intransit",
    type: "column",
    data: [ditd,xitd]
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
    categories: ['Delhivery','Xpressbees'],
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
            return "" + val + " Orders"
        }
    }
}
};
var columnChart1 = new ApexCharts(columnCtx1, columnConfig1);
columnChart1.render();
// 
},
error: function (data) {
console.log('Error:', data);
}
});
// Courier Performance


    }


}



</script>


<!-- Test -->
<!--<div id="testshows">Test Data</div>-->
<!-- Test -->


<style type="text/css">
.newcarddes {
    height: 2rem !important;
    width: 2rem !important;
}
.newfades {
    font-size:15px !important;
}
</style>





































<div class="row my-2" id="filterdatashows">
    <center>
        <div class="spinner-border" role="status"></div>    
    </center>
</div>
<!--  -->



<!-- Courier Wise And Zone Wise Performance -->
<div class="row">
<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Courier Wise Performance</h5>
</div>
</div>
<div class="card-body">
    <div id="courier_wise_crt"></div>
    <div id="courier_wise_lst"></div>
    <div id="courier_wise_30d"></div>
    <div id="courier_wise_90d"></div>
    <!-- <div id="courier_wise"></div> -->
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
    <input type="hidden" id="febcod" value="{{ $ccodorders }}">
    <input type="hidden" id="febpre" value="{{ $cprepaid }}">
    <div id="zone_wise"></div>
</div>
</div>
</div>
</div>
<!-- Courier Wise And Zone Wise Performance -->











<!-- State Performance And Courier Details -->
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css">
<div class="row">
<div class="col-lg-7">

<div class="card bg-white">
<div class="card-header">
<h5 class="card-title">State Performance</h5>
</div>
<div class="card-body">
<div id="india" style="height: 400px"></div>
</div>
</div>

</div>

<div class="col-lg-5">
<!--  -->
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Courier Details Orders</h5>
</div>
</div>
<div class="card-body">
    <div id="invoice_chartcm"></div>
    <div id="invoice_chartlm"></div>
    <div id="invoice_chartl30"></div>
    <div id="invoice_chartl90"></div>
    <!-- <div id="invoice_chartall"></div> -->
<div class="text-center text-muted">
<div class="row">
    <div class="col-6">
    <div class="mt-4">
    <p class="mb-2 text-truncate"><i class="fas fa-circle me-1" style="color:#22cc62"></i> Delhivery</p>
    </div>
    </div>
    <div class="col-6">
    <div class="mt-4">
    <p class="mb-2 text-truncate"><i class="fas fa-circle me-1" style="color:#ff737b;"></i> Xpressbees</p>
    </div>
    </div>
</div>
</div>
</div>
</div>
<!--  -->
</div>
</div>
<!-- State Performance And Courier Details -->









<!-- Current Weekly Order Performance And Today Orders -->
<div class="row">
<div class="col-xl-7 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Current Week Order Performance</h5>
</div>
</div>
<div class="card-body">
    <div id="weekly_performance"></div>
</div>
</div>
<!--  -->
</div>
<div class="col-xl-5 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Today Orders</h5>
</div>
</div>
<div class="card-body">
  <input type="hidden" id="codorders" value="{{ $tcodorders }}">
  <input type="hidden" id="prepaidorders" value="{{ $tprepaid }}">
    <div id="invoice_chart"></div>
<div class="text-center text-muted">
<div class="row">
    <div class="col-6">
    <div class="mt-4">
    <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> COD</p>
    </div>
    </div>
    <div class="col-6">
    <div class="mt-4">
    <p class="mb-2 text-truncate"><i class="fas fa-circle me-1" style="color:#fda600"></i> Prepaid</p>
    </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Current Weekly Order Performance And Today Orders -->






<script src="assets/js/jquery-3.6.0.min.js"></script>
<!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
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
<!--  -->


</div>
@endsection
