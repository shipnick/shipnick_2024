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
    <title>Dompet - Payment Admin Dashboard Bootstrap Template</title>



    <!-- Custom Stylesheet -->
    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">L</span>
            <span style="--i:2">o</span>
            <span style="--i:3">a</span>
            <span style="--i:4">d</span>
            <span style="--i:5">i</span>
            <span style="--i:6">n</span>
            <span style="--i:7">g</span>
            <span style="--i:8">.</span>
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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Form</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Element</a></li>
                    </ol>
                </div>
                <!-- row -->
                <div class="row">

                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">API Requirement Fields</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Courier Name</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Courier Name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Documentation File</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="file" id="formFile">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Live Secret Key</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Live Secret Key">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Live Token Key</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Live Token Key">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Live Bearear Token</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Live Bearear Token">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Testting Secret key</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Testting Secret key">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">Testting Token Key</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Testting Token Key">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label"> Testting Bearear Token</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" placeholder="Testting Bearear Token">
                                            </div>
                                        </div>



                                        <div class="mb-3 row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">submit</button>
                                            </div>
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

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
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
    <script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

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