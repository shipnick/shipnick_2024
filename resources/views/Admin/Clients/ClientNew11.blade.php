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
            <span style="--i:9">.</span>
            <span style="--i:10">.</span>
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
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Merchant Registration</a></li>
                    </ol>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 order-lg-1">
                                        <h4 class="mb-3">Merchant Registration</h4>

                                        <form class="needs-validation" method="post" action="{{ asset('/New_Client') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Company Name*</label>
                                                    <input type="text" name="companyname" class="form-control" id="Companyname" placeholder="" required="">
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Brand Name*</label>
                                                    <input type="text" class="form-control" id="Brandname" placeholder="" name="brand" required="">
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Contact Number*</label>
                                                    <input type="text" class="form-control" id="Contact" placeholder="" required="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">E-mail id / User name</label>
                                                    <input type="text" class="form-control" id="Email" placeholder="" name="email" required="">
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Password*</label>
                                                    <input type="text" class="form-control" id="Password" placeholder="" name="password" required="">
                                                </div>

                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Remittance Time Period*</label>
                                                    <input type="text" class="form-control" id="Remittancetime" placeholder="" name="remmitday" required="">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Max COD value (Per order)*</label>
                                                    <input type="text" class="form-control" id="Maxcod" placeholder="" name="maxcodorder" required="">
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <label for="zip" class="form-label">Max Liability Shipment**</label>
                                                    <input type="text" class="form-control" id="Maxliability" placeholder="" name="maxliability" required="">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <fieldset class="mb-3" style="text-align: center;">
                                                        <label class="col-form-label col-sm-3 pt-0">Account Type*</label>
                                                        <div class="card-body">
                                                            <div class="basic-form">
                                                                <form>
                                                                    <div class="mb-3 mb-0">
                                                                        <label class="radio-inline me-3"><input type="radio" class="form-check-input" name="actuye" value="Prepaid">&nbsp;Prepaid</label>
                                                                        <label class="radio-inline me-3"><input type="radio" class="form-check-input" name="actuye" value="Postpaid">&nbsp;Post-Paid</label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <fieldset class="mb-3" style="text-align: center;">
                                                        <label class="col-form-label col-sm-3 pt-0">Freight Type*</label>
                                                        <div class="card-body">
                                                            <div class="basic-form">
                                                                <form>
                                                                    <div class="mb-3 mb-0">
                                                                        <label class="radio-inline me-3"><input type="radio" class="form-check-input" name="freighttype" value="Fixed Charge">&nbsp;Fixed Charge</label>
                                                                        <label class="radio-inline me-3"><input type="radio" class="form-check-input" name="freighttype" value="Variable Charge">&nbsp;Variable Charge</label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-4">
                                                    <fieldset class="mb-3" style="text-align: center;">
                                                        <label class="col-form-label col-sm-3 pt-0">Status</label>
                                                        <div class="card-body">
                                                            <div class="basic-form">
                                                                <form>
                                                                    <div class="mb-3 mb-0">
                                                                        <label class="radio-inline me-3"><input type="radio" class="form-check-input" name="status" value="1">&nbsp;Active</label>
                                                                        <label class="radio-inline me-3"><input type="radio" class="form-check-input" name="status" value="0">&nbsp;Deactive</label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </div>
                                            </div>



                                            <hr class="mb-4">
                                            <button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
                                            <button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
                                        </form>
                                    </div>
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