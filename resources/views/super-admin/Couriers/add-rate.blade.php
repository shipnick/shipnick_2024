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

        @include("super-admin/app")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pricing</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="default-tab">

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active  " id="home" role="tabpanel">
                                            <div class="col-md-12 mt-3">
                                                <div class=" " style="background-color: #12263f;">
                                                    <h5 class=" text-white " style="text-align:center;padding: 2%;">
                                                        Add Pricing Plans
                                                        <br>
                                                    </h5>
                                                </div>
                                            </div>
                                            <form method="post" action="{{ asset('/super-admin-rate-add') }}" enctype="multipart/form-data">
                                            
                                                <div class="col-xl-4 col-lg-6">
                                                    <div class="card">

                                                        <div class="card-body">
                                                            <div class="basic-form">

                                                                <div class="mb-3">
                                                                    <label class="form-label">Select list (select one)</label>
                                                                    <select class="default-select  form-control wide" name="courier">
                                                                        <option value="Bluedart-sc">Bluedart-sc</option>
                                                                         <option value="Bluedart-sr">Bluedart-sr</option>
                                                                        <option value="bluedart">Bluedart</option>
                                                                        <option value="xpressbees_surface">XpressBees Surface</option>
                                                                        <option value="xpressbees">Xpressbees</option>
                                                                        <option value="xpressbees_Shipnick"> XpressBees Shipnick</option>
                                                                        <option value="ecom">Ecom </option>

                                                                    </select>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md mt-1  table table-bordered table-sm text-left  table-hover text-center align-td-middle">
                                                        <thead>
                                                            <tr>

                                                                <th><strong>COURIER</strong></th>
                                                                <th><strong>TYPE</strong></th>
                                                                <th><strong>WITHIN CITY</strong></th>
                                                                <th><strong>WITHIN STATE</strong></th>

                                                                <th><strong>REGIONAL</strong></th>
                                                                <th><strong>METRO TO METRO</strong></th>
                                                                <th><strong>NE, J&K, KL, AN</strong></th>
                                                                <th><strong>REST OF INDIA</strong></th>
                                                                <th><strong>COD CHARGES</strong></th>
                                                                <th><strong>COD %</strong></th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align:center;" rowspan="3"><input type="text" class="form-control" placeholder="weight" name="weight" required></td>
                                                                <td style="text-align:center;">
                                                                    FWD
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <input type="text" name="fwd1" class="form-control" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <input type="text" name="fwd2" class="form-control" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <input type="text" name="fwd3" class="form-control" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <input type="text" name="fwd4" class="form-control" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <input type="text" name="fwd5" class="form-control" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;"><input type="text" name="fwd6" class="form-control" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;" rowspan="3">
                                                                    <input type="text" class="form-control" name="fwd7" placeholder="" required>
                                                                </td>
                                                                <td style="text-align:center;" rowspan="3">
                                                                    <input type="text" class="form-control" name="fwd8" placeholder="" required>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:center;">RTO</td>
                                                                <td style="text-align:center;"><input type="text" name="rto1"  class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="rto2" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="rto3" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="rto4" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="rto5" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="rto6" class="form-control" placeholder="" required></td>

                                                            </tr>
                                                            <tr>
                                                                <td style="text-align:center;">Add Wt.</td>
                                                                <td style="text-align:center;"><input type="text" name="add1" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="add2" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="add3" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="add4" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="add5" class="form-control" placeholder="" required></td>
                                                                <td style="text-align:center;"><input type="text" name="add6" class="form-control" placeholder="" required></td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <input type="hidden" name="admin_id" value="{{ request()->id }}">
                                                <button type="submit" class="btn btn-primary"> submit </button>@csrf

                                            </form>


                                        </div>

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