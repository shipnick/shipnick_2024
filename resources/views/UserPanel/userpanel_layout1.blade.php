<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipnick</title>





    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">

    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

    <!--datepicker css -->
    <link rel="stylesheet" type="text/css" href="{{asset('newtheme/cssnew/DateRangePicker.css')}}" />
    <!--datepicker css end -->

    <!-- scrollbar on page start -->
    <link rel="stylesheet" type="text/css" href="{{asset('newtheme/cssnew/scrollbar.css')}}" />
    <!-- scrollbar on page end -->

    <!-- dashboard on page start -->
    <link rel="stylesheet" type="text/css" href="{{asset('newtheme/cssnew/dashboard.css')}}" />
    <!-- dashboard on page end -->


    <!-- <script type="text/javascript" src="daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="daterangepicker.css" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
        integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- progressbar css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/blue/pace-theme-minimal.css" />
    <!-- progressbar css  -->

</head>




<body>
    <!--*******************
        Preloader start
    ********************-->

    <div id="preloader"></div>
        <div class="progress-bar">
            <div class="bar" id="progress"></div>
        </div>
    </div>

    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        @include("UserPanel/app")


        <!--**********************************
			  Header end ti-comment-alt
		  ***********************************-->

        <!--**********************************
			  Sidebar start
		  ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <img src="{{asset('/Profiles/')}}/{{ session('UserLoginPic') }}" width="20" alt="">
                            <div class="header-info ms-3">
                                <span class="font-w600 ">Hi,<b>{{ session('UserLogin2name') }}</b></span>
                                <!--<small class="text-end font-w400">{{ session('UserLogin2name') }}</small>-->
                            </div>
                        </a>

                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-025-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <ul aria-expanded="false">

                            <li><a href="{{ asset('/user-Home') }}">Dashboard</a></li>


                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-043-menu"></i>
                            <span class="nav-text">Orders</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ asset('/UPBulk_Order') }}">Create order</a></li>
                            <li><a href="{{asset('/booked-order')}}">Shipment</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-022-copy"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{asset('/UPMIS_Report')}}">MIS</a></li>
                            <!--<li><a href="{{asset('/page-error-503')}}">Menifest<span class="badge badge-xs badge-success ms-3">Update</span></a></li>-->
                            <li><a href="{{asset('/page-error-503')}}">NDR</a></li>
                            <li><a href="{{ asset('/showordercounts') }}">Courier Wise Detail</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa-solid fa-house fw-bold"></i>
                            <span class="nav-text">Hub</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ asset('/UPNew_Hub') }}">Add a hub</a></li>
                            <li><a href="{{ asset('/UPAll_Hubs') }}">All hub</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="mdi mdi-file-document-box font-18 align-middle me-2"></i>
                            <span class="nav-text">Billing</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ asset('/Wallet') }}">Billing</a></li>
                            <!-- <li><a href="{{ asset('/UPAll_Hubs') }}">All hub</a></li> -->
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-072-printer"></i>
                            <span class="nav-text">Print</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ asset('/Label_Print') }}">Print shipping label</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-locations"></i>
                            <span class="nav-text">Location</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="#">Order Tracking</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa-solid fa-gear fw-bold"></i>
                            <span class="nav-text">Settings</span>
                            <!-- <span class="badge badge-xs badge-danger ms-3">New</span> -->
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ asset('/setting') }}">Setting</a></li>

                        </ul>

                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-turn-off"></i>
                            <span class="nav-text">Power</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ asset('/Logout') }}">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="copyright">
                    <!-- <p><strong>Shipnick</strong> © 2023 All Rights Reserved</p>
			  <p class="fs-12">Made with <span class="heart"></span> by Philon Technologies Pvt. Ltd.</p> -->
                </div>
            </div>

        </div>

        <!--**********************************
			  Sidebar end
		  ***********************************-->
        @section("userpanel")

        @show()

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">

            <div class="copyright">
                <p>Copyright © Shipnick.com. Designed &amp; Developed by <a href="https://philontechnologies.com/" target="_blank">Philon Technologies Pvt. Ltd.</a> 2023</p>
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





    <!--datepicker js -->
    <script src="{{asset('newtheme/jsnew/DashboardDatePicker.js')}}"></script>
    <!--datepiker js end -->
    <!-- proloader js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
    <!-- proloader js  -->



</body>

</html>