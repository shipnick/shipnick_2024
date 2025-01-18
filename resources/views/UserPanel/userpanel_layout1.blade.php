<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipnick</title>




    <link href="{{asset('newtheme/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">

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
                <p>Copyright © Shipnick.com. Designed &amp; Developed by <a href="https://www.shipnick.com/" target="_blank">Shipnick Technologies Pvt. Ltd.</a> <span id="current-year"></span></p>
            </div>

            <script>
                // Get the current year and set it dynamically
                document.getElementById('current-year').textContent = new Date().getFullYear();
            </script>
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