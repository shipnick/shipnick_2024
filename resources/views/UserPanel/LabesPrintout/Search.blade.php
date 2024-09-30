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
    <link rel="shortcut icon" href="{{asset('Admin/images/logo.jpg')}}" />

    <!-- Page Title Here -->
    <title>Shipnick</title>




    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">
    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    @include("UserPanel/preloader")
    <!--*******************
        Preloader end
    ********************-->
    @php(error_reporting(1))
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include("UserPanel/app")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Shipping Label</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shipping Label</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="form-valide-with-icon needs-validation" method="post" action="{{ asset('/Labels_Print') }}" target="_black" novalidate>
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="dlab-password">Enter AWB details<span class="required">*</span></label>
                                            <div class="input-group transparent-append">
                                                <span class="input-group-text"> <i class="fa fa-print"></i> </span>
                                                <textarea class="form-control" rows="4" name="awbnoisa" placeholder="Write AWB Number Line By Line [Max 100]">
                                                    <?php
                                        foreach ($params as $param){
                                            echo $param."\n";
                                        }
                                    ?>
                                    </textarea>@csrf
                                                <div class="invalid-feedback">
                                                    Please enter valid AWB number.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="invalidCheck2" name="newcheck">
                                                <label class="form-check-label mt-1" for="invalidCheck2">
                                                    Print shipping label without return details
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <button class="btn btn-primary" type="submit" title="Print A4 Size" value="a4size" name="printout"><i class="las la-print me-3 scale5"></i> Print A4 size shipping label</button>&nbsp;&nbsp;

                                            <button class="btn btn-primary" type="submit" title="Print A6 Size" value="a6size" name="printout"><i class="las la-print me-3 scale6"></i>Print A6 size shipping label</button>&nbsp;&nbsp;

                                            <button class="btn btn-primary" type="submit" title="Thermal Print Size" value="thermalsize" name="printout"><i class="las la-print me-3 scale7"></i>Print Thermal shipping label</button>





                                        </div>
                                    </form>
                                </div>
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



    <!--<script>-->
    <!--    jQuery(document).ready(function() {-->
    <!--        setTimeout(function() {-->
    <!--            var dezSettingsOptions = {-->
    <!--                typography: "cairo",-->
    <!--                version: "light",-->
    <!--                layout: "vertical",-->
    <!--                primary: "color_10",-->
    <!--                headerBg: "color_1",-->
    <!--                navheaderBg: "color_1",-->
    <!--                sidebarBg: "color_10",-->
    <!--                sidebarStyle: "mini",-->
    <!--                sidebarPosition: "fixed",-->
    <!--                headerPosition: "fixed",-->
    <!--                containerLayout: "wide",-->
    <!--            };-->
    <!--            new dezSettings(dezSettingsOptions);-->
    <!--            jQuery(window).on('resize', function() {-->
    <!--                new dezSettings(dezSettingsOptions);-->
    <!--            })-->
    <!--        }, 1000)-->
    <!--    });-->
    <!--</script>-->

</body>

</html>