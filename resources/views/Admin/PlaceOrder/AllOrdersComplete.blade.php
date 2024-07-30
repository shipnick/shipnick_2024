<!DOCTYPE html>
<html lang="en">

<head>

    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
    <meta property="og:description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!-- Page Title Here -->
    <title>Shipnick</title>




    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">
    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>
<script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>
<script type="text/javascript">
    function alllorders() {
        $.ajax({
            type: "GET",
            url: "{{ asset('/All_Orders') }}",
            data: {
                crtpage: 'Cancelled'
            },
            success: function(data) {
                $("#allordersshows").html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
    alllorders();

    function processorders() {
        $.ajax({
            type: "GET",
            url: "{{ asset('/All_Orders_Pending') }}",
            data: {
                crtpage: 'Cancelled'
            },
            success: function(data) {
                $("#Pendingordersshows").html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
    processorders();


    function canceledorders() {
        $.ajax({
            type: "GET",
            url: "{{ asset('/All_Orders_Canceled') }}",
            data: {
                crtpage: 'Cancelled'
            },
            success: function(data) {
                $("#Cancelledordersshows").html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
    canceledorders();



  


    function rtoorders() {
        $.ajax({
            type: "GET",
            url: "{{ asset('/All_Orders_Cancel') }}",
            data: {
                crtpage: 'Cancelled'
            },
            success: function(data) {
                $("#rtordersshows").html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
    rtoorders();



    function failedorders() {
        $.ajax({
            type: "GET",
            url: "{{ asset('/afailed-orders') }}",
            data: {
                crtpage: 'Cancelled'
            },
            success: function(data) {
                $("#failedordersshows").html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
    failedorders();

 
</script>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">S</span>
            <span style="--i:2">H</span>
            <span style="--i:3">I</span>
            <span style="--i:4">P</span>
            <span style="--i:5">N</span>
            <span style="--i:6">I</span>
            <span style="--i:7">C</span>
            <span style="--i:8">K</span>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include("Admin/app")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center mb-3">
                    <div class="mb-3 me-auto">
                        <div class="card-tabs style-1 mt-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);" data-bs-toggle="tab" id="transaction-tab" data-bs-target="#AllTransaction" role="tab">All Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Completed-tab" data-bs-target="#Completed" role="tab">Delivered</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Pending-tab" data-bs-target="#Pending" role="tab">Pending</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Canceled-tab" data-bs-target="#Cancelled" role="tab">Cancelled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Not-picked-tab" data-bs-target="#Notpicked" role="tab">Not Picked</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="RTO-tab" data-bs-target="#RTO" role="tab">RTO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Failed-tab" data-bs-target="#Failed" role="tab">Failed</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-outline-primary mb-3"><i class="fa fa-calendar me-3 scale3"></i>Filter Date</a>
                </div>
                <div class="row">
                    <div class="col-xl-12 tab-content">
                        <div class="tab-pane fade show active" id="AllTransaction" role="tabpanel" aria-labelledby="transaction-tab">

                            <div id="allordersshows">
                                <h6>Loading...</h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
                            <div id="Pendingordersshows">
                                <h6>Loading...</h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Cancelled" role="tabpanel" aria-labelledby="Canceled-tab">

                            <div id="Cancelledordersshows">
                                <h6>Loading...</h6>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="RTO" role="tabpanel" aria-labelledby="RTO-tab">

                            <div id="rtordersshows">
                                <h6>Loading...</h6>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="Failed" role="tabpanel" aria-labelledby="Failed-tab">

                            <div id="failedordersshows">
                                <h6>Loading...</h6>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">

            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->




    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

    <!-- Apex Chart -->
    <script src="{{asset('newtheme/vendor/apexchart/apexchart.js')}}"></script>
    <script src="{{asset('newtheme/./vendor/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('newtheme/./vendor/wnumb/wNumb.js')}}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{asset('newtheme/vendor/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('newtheme/vendor/swiper/js/swiper-bundle.min.js')}}"></script>

    <!-- Dashboard 1 -->
    <script src="{{asset('newtheme/js/dashboard/dashboard-5.js')}}"></script>

    <script src="{{asset('newtheme/js/custom.min.js')}}"></script>
    <script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>



    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                var dezSettingsOptions = {
                    typography: "cairo",
                    version: "light",
                    layout: "vertical",
                    primary: "color_10",
                    headerBg: "color_1",
                    navheaderBg: "color_1",
                    sidebarBg: "color_10",
                    sidebarStyle: "mini",
                    sidebarPosition: "fixed",
                    headerPosition: "fixed",
                    containerLayout: "wide",
                };
                new dezSettings(dezSettingsOptions);
                jQuery(window).on('resize', function() {
                    new dezSettings(dezSettingsOptions);
                })
            }, 1000)
        });
    </script>

</body>

</html>