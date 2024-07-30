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
    <link rel="{{asset('newtheme/stylesheet" href="vendor/nouislider/nouislider.min.css')}}">
    <link rel="{{asset('newtheme/stylesheet" href="./vendor/swiper/css/swiper-bundle.min.css')}}">
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

        @include("Admin/app")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="">
                    <h2>{{$params->name}}

                    </h2>
                </div>
                <div class="row invoice-card-row">
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card overflow-hidden invoice-card position-unset">
                            <div class="card-header border-0">
                                <div class="d-flex">
                                    <span class="icon bg-card-loan me-3">
                                        <svg width="32" height="32" viewBox="0 0 32 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.812 34.64L3.2 39.6C2.594 40.054 1.784 40.128 1.106 39.788C0.428 39.45 0 38.758 0 38V2C0 0.896 0.896 0 2 0H30C31.104 0 32 0.896 32 2V38C32 38.758 31.572 39.45 30.894 39.788C30.216 40.128 29.406 40.054 28.8 39.6L22.188 34.64L17.414 39.414C16.634 40.196 15.366 40.196 14.586 39.414L9.812 34.64ZM28 34V4H4V34L8.8 30.4C9.596 29.802 10.71 29.882 11.414 30.586L16 35.172L20.586 30.586C21.29 29.882 22.404 29.802 23.2 30.4L28 34ZM14 20H18C19.104 20 20 19.104 20 18C20 16.896 19.104 16 18 16H14C12.896 16 12 16.896 12 18C12 19.104 12.896 20 14 20ZM10 12H22C23.104 12 24 11.104 24 10C24 8.896 23.104 8 22 8H10C8.896 8 8 8.896 8 10C8 11.104 8.896 12 10 12Z" fill="#717579" />
                                        </svg>
                                    </span>
                                    <div class="invoices">
                                        <h4 class="invoice-num">{{$totalOrders}}</h4>
                                        <span class="fs-18">Total orders</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <svg id="SvgjsSvg1983" width="600" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG1985" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1984">
                                            <clipPath id="gridRectMaskp23azq33i">
                                                <rect id="SvgjsRect1988" width="610" height="76" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskp23azq33i">
                                                <rect id="SvgjsRect1989" width="604" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG1996" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1997" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG2014" class="apexcharts-grid">
                                            <g id="SvgjsG2015" class="apexcharts-gridlines-horizontal" style="display: none;">
                                                <line id="SvgjsLine2017" x1="0" y1="0" x2="600" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2018" x1="0" y1="14" x2="600" y2="14" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2019" x1="0" y1="28" x2="600" y2="28" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2020" x1="0" y1="42" x2="600" y2="42" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2021" x1="0" y1="56" x2="600" y2="56" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2022" x1="0" y1="70" x2="600" y2="70" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG2016" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                            <line id="SvgjsLine2024" x1="0" y1="70" x2="600" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine2023" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1990" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1991" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1994" d="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" fill="rgba(113, 117, 121, 0.14)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp23azq33i)" pathTo="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <path id="SvgjsPath1993" d="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" fill="none" fill-opacity="1" stroke="green" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp23azq33i)" pathTo="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                            </g>
                                        </g>
                                </svg>

                            </div>



                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card overflow-hidden invoice-card position-unset">
                            <div class="card-header border-0">
                                <div class="d-flex">
                                    <span class="icon bg-card-loan-1 me-3">
                                        <svg width="40" height="40" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.812 48.64L11.2 53.6C10.594 54.054 9.78401 54.128 9.10602 53.788C8.42802 53.45 8.00002 52.758 8.00002 52V16C8.00002 14.896 8.89602 14 10 14H38C39.104 14 40 14.896 40 16V52C40 52.758 39.572 53.45 38.894 53.788C38.216 54.128 37.406 54.054 36.8 53.6L30.188 48.64L25.414 53.414C24.634 54.196 23.366 54.196 22.586 53.414L17.812 48.64ZM36 48V18H12V48L16.8 44.4C17.596 43.802 18.71 43.882 19.414 44.586L24 49.172L28.586 44.586C29.29 43.882 30.404 43.802 31.2 44.4L36 48ZM22 34H26C27.104 34 28 33.104 28 32C28 30.896 27.104 30 26 30H22C20.896 30 20 30.896 20 32C20 33.104 20.896 34 22 34ZM18 26H30C31.104 26 32 25.104 32 24C32 22.896 31.104 22 30 22H18C16.896 22 16 22.896 16 24C16 25.104 16.896 26 18 26Z" fill="#44814E" />
                                            <circle cx="40.5" cy="11.5" r="8.5" fill="var(--primary)" stroke="white" stroke-width="3" />
                                        </svg>
                                    </span>
                                    <div class="invoices">
                                        <h4 class="invoice-num">{{$orderPending}}</h4>
                                        <span class="fs-18">Pending Pickups</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <svg id="SvgjsSvg2078" width="600" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG1985" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1984">
                                            <clipPath id="gridRectMaskp23azq33i">
                                                <rect id="SvgjsSvg2078" width="610" height="76" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskp23azq33i">
                                                <rect id="SvgjsRect1989" width="604" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsSvg2078" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1997" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsSvg2078" class="apexcharts-grid">
                                            <g id="SvgjsG2015" class="apexcharts-gridlines-horizontal" style="display: none;">
                                                <line id="SvgjsLine2017" x1="0" y1="0" x2="600" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2018" x1="0" y1="14" x2="600" y2="14" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2019" x1="0" y1="28" x2="600" y2="28" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2020" x1="0" y1="42" x2="600" y2="42" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2021" x1="0" y1="56" x2="600" y2="56" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2022" x1="0" y1="70" x2="600" y2="70" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsSvg2078" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                            <line id="SvgjsSvg2078" x1="0" y1="70" x2="600" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsSvg2078" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsSvg2078" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsSvg2078" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsSvg2078" d="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" fill="rgba(113, 117, 121, 0.14)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp23azq33i)" pathTo="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <path id="SvgjsSvg2078" d="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" fill="none" fill-opacity="1" stroke="#0000FF" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp23azq33i)" pathTo="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <g id="SvgjsSvg2078" class="apexcharts-series-markers-wrap"></g>
                                            </g>
                                        </g>
                                        <g id="SvgjsSvg2078" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)">
                                            <g id="SvgjsG2004" class="apexcharts-yaxis-texts-g"></g>
                                        </g>
                                        <g id="SvgjsSvg2078" class="apexcharts-annotations"></g>
                                    </g>
                                    <rect id="SvgjsSvg2078" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsSvg2078" class="apexcharts-zoom-rect"></g>
                                    <rect id="SvgjsSvg2078" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                </svg>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card overflow-hidden invoice-card position-unset">
                            <div class="card-header border-0">
                                <div class="d-flex">
                                    <span class="icon bg-card-loan-2 me-3">
                                        <svg width="40" height="40" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.812 48.64L11.2 53.6C10.594 54.054 9.78401 54.128 9.10602 53.788C8.42802 53.45 8.00002 52.758 8.00002 52V16C8.00002 14.896 8.89602 14 10 14H38C39.104 14 40 14.896 40 16V52C40 52.758 39.572 53.45 38.894 53.788C38.216 54.128 37.406 54.054 36.8 53.6L30.188 48.64L25.414 53.414C24.634 54.196 23.366 54.196 22.586 53.414L17.812 48.64ZM36 48V18H12V48L16.8 44.4C17.596 43.802 18.71 43.882 19.414 44.586L24 49.172L28.586 44.586C29.29 43.882 30.404 43.802 31.2 44.4L36 48ZM22 34H26C27.104 34 28 33.104 28 32C28 30.896 27.104 30 26 30H22C20.896 30 20 30.896 20 32C20 33.104 20.896 34 22 34ZM18 26H30C31.104 26 32 25.104 32 24C32 22.896 31.104 22 30 22H18C16.896 22 16 22.896 16 24C16 25.104 16.896 26 18 26Z" fill="#44814E" />
                                            <circle cx="40.5" cy="11.5" r="8.5" fill="#09BD3C" stroke="white" stroke-width="3" />
                                        </svg>

                                    </span>
                                    <div class="invoices">
                                        <h4 class="invoice-num">{{$orderInTransit}}</h4>
                                        <span class="fs-18">In Transit</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <svg id="SvgjsSvg1658" width="600" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG1660" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1659">
                                            <clipPath id="gridRectMaskqdds8vy">
                                                <rect id="SvgjsRect1663" width="610" height="76" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskqdds8vy">
                                                <rect id="SvgjsRect1664" width="604" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG1671" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1672" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG1689" class="apexcharts-grid">
                                            <g id="SvgjsG1690" class="apexcharts-gridlines-horizontal" style="display: none;">
                                                <line id="SvgjsLine1692" x1="0" y1="0" x2="600" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1693" x1="0" y1="14" x2="600" y2="14" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1694" x1="0" y1="28" x2="600" y2="28" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1695" x1="0" y1="42" x2="600" y2="42" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1696" x1="0" y1="56" x2="600" y2="56" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1697" x1="0" y1="70" x2="600" y2="70" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1691" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                            <line id="SvgjsLine1699" x1="0" y1="70" x2="600" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine1698" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1665" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1666" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1669" d="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 66.5 557.1428571428571 66.5C 572.1428571428571 66.5 585 14 600 14C 600 14 600 14 600 70M 600 14z" fill="rgba(255, 170, 43, 0.14)	" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqdds8vy)" pathTo="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 66.5 557.1428571428571 66.5C 572.1428571428571 66.5 585 14 600 14C 600 14 600 14 600 70M 600 14z" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <path id="SvgjsPath1670" d="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 66.5 557.1428571428571 66.5C 572.1428571428571 66.5 585 14 600 14" fill="none" fill-opacity="1" stroke="#ffaa2b" stroke-opacity="1" stroke-linecap="butt" stroke-width="6" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqdds8vy)" pathTo="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 66.5 557.1428571428571 66.5C 572.1428571428571 66.5 585 14 600 14" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <g id="SvgjsG1667" class="apexcharts-series-markers-wrap" data:realIndex="0"></g>
                                            </g>
                                            <g id="SvgjsG1668" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1700" x1="0" y1="0" x2="600" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1701" x1="0" y1="0" x2="600" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1702" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1703" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1704" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <g id="SvgjsG1688" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1661" class="apexcharts-annotations"></g>
                                </svg>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card overflow-hidden invoice-card position-unset">
                            <div class="card-header border-0">
                                <div class="d-flex">
                                    <span class="icon bg-card-loan-3 me-3">
                                        <svg width="40" height="40" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.812 48.64L11.2 53.6C10.594 54.054 9.784 54.128 9.106 53.788C8.428 53.45 8 52.758 8 52V16C8 14.896 8.896 14 10 14H38C39.104 14 40 14.896 40 16V52C40 52.758 39.572 53.45 38.894 53.788C38.216 54.128 37.406 54.054 36.8 53.6L30.188 48.64L25.414 53.414C24.634 54.196 23.366 54.196 22.586 53.414L17.812 48.64ZM36 48V18H12V48L16.8 44.4C17.596 43.802 18.71 43.882 19.414 44.586L24 49.172L28.586 44.586C29.29 43.882 30.404 43.802 31.2 44.4L36 48ZM22 34H26C27.104 34 28 33.104 28 32C28 30.896 27.104 30 26 30H22C20.896 30 20 30.896 20 32C20 33.104 20.896 34 22 34ZM18 26H30C31.104 26 32 25.104 32 24C32 22.896 31.104 22 30 22H18C16.896 22 16 22.896 16 24C16 25.104 16.896 26 18 26Z" fill="#44814E" />
                                            <circle cx="40.5" cy="11.5" r="8.5" fill="#44814E" stroke="white" stroke-width="3" />
                                        </svg>


                                    </span>
                                    <div class="invoices">
                                        <h4 class="invoice-num">{{$orderDelivered}}</h4>
                                        <span class="fs-18">Delivered</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <svg id="SvgjsSvg1611" width="600" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG1613" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1612">
                                            <clipPath id="gridRectMaskgskd4op1">
                                                <rect id="SvgjsRect1616" width="610" height="76" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskgskd4op1">
                                                <rect id="SvgjsRect1617" width="604" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG1624" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1625" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG1642" class="apexcharts-grid">
                                            <g id="SvgjsG1643" class="apexcharts-gridlines-horizontal" style="display: none;">
                                                <line id="SvgjsLine1645" x1="0" y1="0" x2="600" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1646" x1="0" y1="14" x2="600" y2="14" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1647" x1="0" y1="28" x2="600" y2="28" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1648" x1="0" y1="42" x2="600" y2="42" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1649" x1="0" y1="56" x2="600" y2="56" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1650" x1="0" y1="70" x2="600" y2="70" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1644" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                            <line id="SvgjsLine1652" x1="0" y1="70" x2="600" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine1651" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1618" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1619" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1622" d="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" fill="rgba(253, 83, 83, 0.14)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskgskd4op1)" pathTo="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <path id="SvgjsPath1623" d="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" fill="none" fill-opacity="1" stroke="#fd5353" stroke-opacity="1" stroke-linecap="butt" stroke-width="6" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskgskd4op1)" pathTo="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 31.5 171.42857142857142 31.5C 186.42857142857142 31.5 199.28571428571428 49 214.28571428571428 49C 229.28571428571428 49 242.1428571428571 14 257.1428571428571 14C 272.1428571428571 14 285 66.5 300 66.5C 315 66.5 327.85714285714283 31.5 342.85714285714283 31.5C 357.85714285714283 31.5 370.7142857142857 66.5 385.7142857142857 66.5C 400.7142857142857 66.5 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 49 514.2857142857142 49C 529.2857142857142 49 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <g id="SvgjsG1620" class="apexcharts-series-markers-wrap" data:realIndex="0"></g>
                                            </g>
                                            <g id="SvgjsG1621" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1653" x1="0" y1="0" x2="600" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1654" x1="0" y1="0" x2="600" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1655" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1656" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1657" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <g id="SvgjsG1641" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1614" class="apexcharts-annotations"></g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card overflow-hidden invoice-card position-unset">
                            <div class="card-header border-0">
                                <div class="d-flex">
                                    <span class="icon bg-card-loan-3 me-3">
                                        <svg width="40" height="40" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.812 48.64L11.2 53.6C10.594 54.054 9.784 54.128 9.106 53.788C8.428 53.45 8 52.758 8 52V16C8 14.896 8.896 14 10 14H38C39.104 14 40 14.896 40 16V52C40 52.758 39.572 53.45 38.894 53.788C38.216 54.128 37.406 54.054 36.8 53.6L30.188 48.64L25.414 53.414C24.634 54.196 23.366 54.196 22.586 53.414L17.812 48.64ZM36 48V18H12V48L16.8 44.4C17.596 43.802 18.71 43.882 19.414 44.586L24 49.172L28.586 44.586C29.29 43.882 30.404 43.802 31.2 44.4L36 48ZM22 34H26C27.104 34 28 33.104 28 32C28 30.896 27.104 30 26 30H22C20.896 30 20 30.896 20 32C20 33.104 20.896 34 22 34ZM18 26H30C31.104 26 32 25.104 32 24C32 22.896 31.104 22 30 22H18C16.896 22 16 22.896 16 24C16 25.104 16.896 26 18 26Z" fill="#44814E" />
                                            <circle cx="40.5" cy="11.5" r="8.5" fill="#44814E" stroke="white" stroke-width="3" />
                                        </svg>


                                    </span>
                                    <div class="invoices">
                                        <h4 class="invoice-num">{{$orderNdr}}</h4>
                                        <span class="fs-18">NDR</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <svg id="SvgjsSvg1563" width="600" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG1565" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1564">
                                            <clipPath id="gridRectMaskqpe7x0a1">
                                                <rect id="SvgjsRect1568" width="610" height="76" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskqpe7x0a1">
                                                <rect id="SvgjsRect1569" width="604" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG1576" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1577" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG1595" class="apexcharts-grid">
                                            <g id="SvgjsG1596" class="apexcharts-gridlines-horizontal" style="display: none;">
                                                <line id="SvgjsLine1598" x1="0" y1="0" x2="600" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1599" x1="0" y1="14" x2="600" y2="14" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1600" x1="0" y1="28" x2="600" y2="28" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1601" x1="0" y1="42" x2="600" y2="42" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1602" x1="0" y1="56" x2="600" y2="56" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1603" x1="0" y1="70" x2="600" y2="70" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1597" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                            <line id="SvgjsLine1605" x1="0" y1="70" x2="600" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine1604" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1570" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1571" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1574" d="M 0 70L 0 66.5C 14 66.5 26 31.5 40 31.5C 54 31.5 66 66.5 80 66.5C 94 66.5 106 14 120 14C 134 14 146 49 160 49C 174 49 186 14 200 14C 214 14 226 31.5 240 31.5C 254 31.5 266 49 280 49C 294 49 306 14 320 14C 334 14 346 66.5 360 66.5C 374 66.5 386 31.5 400 31.5C 414 31.5 426 66.5 440 66.5C 454 66.5 466 49 480 49C 494 49 506 14 520 14C 534 14 546 49 560 49C 574 49 586 14 600 14C 600 14 600 14 600 70M 600 14z" fill="rgba(22, 192, 70, 0.14)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqpe7x0a1)" pathTo="M 0 70L 0 66.5C 14 66.5 26 31.5 40 31.5C 54 31.5 66 66.5 80 66.5C 94 66.5 106 14 120 14C 134 14 146 49 160 49C 174 49 186 14 200 14C 214 14 226 31.5 240 31.5C 254 31.5 266 49 280 49C 294 49 306 14 320 14C 334 14 346 66.5 360 66.5C 374 66.5 386 31.5 400 31.5C 414 31.5 426 66.5 440 66.5C 454 66.5 466 49 480 49C 494 49 506 14 520 14C 534 14 546 49 560 49C 574 49 586 14 600 14C 600 14 600 14 600 70M 600 14z" pathFrom="M -1 84L -1 84L 40 84L 80 84L 120 84L 160 84L 200 84L 240 84L 280 84L 320 84L 360 84L 400 84L 440 84L 480 84L 520 84L 560 84L 600 84"></path>
                                                <path id="SvgjsPath1575" d="M 0 66.5C 14 66.5 26 31.5 40 31.5C 54 31.5 66 66.5 80 66.5C 94 66.5 106 14 120 14C 134 14 146 49 160 49C 174 49 186 14 200 14C 214 14 226 31.5 240 31.5C 254 31.5 266 49 280 49C 294 49 306 14 320 14C 334 14 346 66.5 360 66.5C 374 66.5 386 31.5 400 31.5C 414 31.5 426 66.5 440 66.5C 454 66.5 466 49 480 49C 494 49 506 14 520 14C 534 14 546 49 560 49C 574 49 586 14 600 14" fill="none" fill-opacity="1" stroke="var(--primary)" stroke-opacity="1" stroke-linecap="butt" stroke-width="6" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqpe7x0a1)" pathTo="M 0 66.5C 14 66.5 26 31.5 40 31.5C 54 31.5 66 66.5 80 66.5C 94 66.5 106 14 120 14C 134 14 146 49 160 49C 174 49 186 14 200 14C 214 14 226 31.5 240 31.5C 254 31.5 266 49 280 49C 294 49 306 14 320 14C 334 14 346 66.5 360 66.5C 374 66.5 386 31.5 400 31.5C 414 31.5 426 66.5 440 66.5C 454 66.5 466 49 480 49C 494 49 506 14 520 14C 534 14 546 49 560 49C 574 49 586 14 600 14" pathFrom="M -1 84L -1 84L 40 84L 80 84L 120 84L 160 84L 200 84L 240 84L 280 84L 320 84L 360 84L 400 84L 440 84L 480 84L 520 84L 560 84L 600 84"></path>
                                                <g id="SvgjsG1572" class="apexcharts-series-markers-wrap" data:realIndex="0"></g>
                                            </g>
                                            <g id="SvgjsG1573" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1606" x1="0" y1="0" x2="600" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1607" x1="0" y1="0" x2="600" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1608" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1609" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1610" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <g id="SvgjsG1594" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1566" class="apexcharts-annotations"></g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card overflow-hidden invoice-card position-unset">
                            <div class="card-header border-0">
                                <div class="d-flex">
                                    <span class="icon bg-card-loan-3 me-3">
                                        <svg width="40" height="40" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.812 48.64L11.2 53.6C10.594 54.054 9.784 54.128 9.106 53.788C8.428 53.45 8 52.758 8 52V16C8 14.896 8.896 14 10 14H38C39.104 14 40 14.896 40 16V52C40 52.758 39.572 53.45 38.894 53.788C38.216 54.128 37.406 54.054 36.8 53.6L30.188 48.64L25.414 53.414C24.634 54.196 23.366 54.196 22.586 53.414L17.812 48.64ZM36 48V18H12V48L16.8 44.4C17.596 43.802 18.71 43.882 19.414 44.586L24 49.172L28.586 44.586C29.29 43.882 30.404 43.802 31.2 44.4L36 48ZM22 34H26C27.104 34 28 33.104 28 32C28 30.896 27.104 30 26 30H22C20.896 30 20 30.896 20 32C20 33.104 20.896 34 22 34ZM18 26H30C31.104 26 32 25.104 32 24C32 22.896 31.104 22 30 22H18C16.896 22 16 22.896 16 24C16 25.104 16.896 26 18 26Z" fill="#44814E" />
                                            <circle cx="40.5" cy="11.5" r="8.5" fill="#44814E" stroke="white" stroke-width="3" />
                                        </svg>


                                    </span>
                                    <div class="invoices">
                                        <h4 class="invoice-num">{{$orderRto}}</h4>
                                        <span class="fs-18">RTO</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <svg id="SvgjsSvg1516" width="600" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <g id="SvgjsG1518" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                                        <defs id="SvgjsDefs1517">
                                            <clipPath id="gridRectMaskp23azq33i">
                                                <rect id="SvgjsRect1521" width="610" height="76" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskp23azq33i">
                                                <rect id="SvgjsRect1522" width="604" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <g id="SvgjsG1529" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG1530" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG1547" class="apexcharts-grid">
                                            <g id="SvgjsG1548" class="apexcharts-gridlines-horizontal" style="display: none;">
                                                <line id="SvgjsLine1550" x1="0" y1="0" x2="600" y2="0" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1551" x1="0" y1="14" x2="600" y2="14" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1552" x1="0" y1="28" x2="600" y2="28" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1553" x1="0" y1="42" x2="600" y2="42" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1554" x1="0" y1="56" x2="600" y2="56" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine1555" x1="0" y1="70" x2="600" y2="70" stroke="#eeeeee" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG1549" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                                            <line id="SvgjsLine1557" x1="0" y1="70" x2="600" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine1556" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG1523" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG1524" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath1527" d="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" fill="rgba(113, 117, 121, 0.14)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp23azq33i)" pathTo="M 0 70L 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14C 600 14 600 14 600 70M 600 14z" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <path id="SvgjsPath1528" d="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" fill="none" fill-opacity="1" stroke="var(--secondary)" stroke-opacity="1" stroke-linecap="butt" stroke-width="6" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp23azq33i)" pathTo="M 0 66.5C 14.999999999999998 66.5 27.857142857142854 31.5 42.857142857142854 31.5C 57.857142857142854 31.5 70.71428571428571 66.5 85.71428571428571 66.5C 100.71428571428571 66.5 113.57142857142856 14 128.57142857142856 14C 143.57142857142856 14 156.42857142857142 49 171.42857142857142 49C 186.42857142857142 49 199.28571428571428 14 214.28571428571428 14C 229.28571428571428 14 242.1428571428571 66.5 257.1428571428571 66.5C 272.1428571428571 66.5 285 31.5 300 31.5C 315 31.5 327.85714285714283 66.5 342.85714285714283 66.5C 357.85714285714283 66.5 370.7142857142857 14 385.7142857142857 14C 400.7142857142857 14 413.57142857142856 49 428.57142857142856 49C 443.57142857142856 49 456.4285714285714 14 471.4285714285714 14C 486.4285714285714 14 499.2857142857142 14 514.2857142857142 14C 529.2857142857142 14 542.1428571428571 49 557.1428571428571 49C 572.1428571428571 49 585 14 600 14" pathFrom="M -1 84L -1 84L 42.857142857142854 84L 85.71428571428571 84L 128.57142857142856 84L 171.42857142857142 84L 214.28571428571428 84L 257.1428571428571 84L 300 84L 342.85714285714283 84L 385.7142857142857 84L 428.57142857142856 84L 471.4285714285714 84L 514.2857142857142 84L 557.1428571428571 84L 600 84"></path>
                                                <g id="SvgjsG1525" class="apexcharts-series-markers-wrap" data:realIndex="0"></g>
                                            </g>
                                            <g id="SvgjsG1526" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine1558" x1="0" y1="0" x2="600" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1559" x1="0" y1="0" x2="600" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG1560" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG1561" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG1562" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <g id="SvgjsG1546" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG1519" class="apexcharts-annotations"></g>
                                </svg>
                            </div>
                        </div>
                    </div>





                </div>

                <div class="row">
                    <div class="col-xl-9 col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">

                                    <div class="col-xl-12">
                                        <div class="row align-items-center  mt-xl-0 mt-4">
                                            <div class="col-md-6">
                                                <h4 class="card-title">Monthly Order Overview</h4>
                                                <!-- <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit psu olor</span> -->
                                                <ul class="card-list mt-4">
                                                    <li><span class="bg-blue circle"></span>cod<span>20%</span></li>
                                                    <li><span class="bg-success circle"></span>prepaid<span>40%</span></li>
                                                    <!-- <li><span class="bg-warning circle"></span>Restaurant<span>15%</span></li>
													<li><span class="bg-light circle"></span>Others<span>15%</span></li> -->
                                                </ul>
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <div class="col-md-6" style="height:200px">
                                                <canvas id="polarChart"></canvas>
                                            </div>

                                            <script>
                                                // Get the canvas element by its id
                                                var canvas = document.getElementById('polarChart');

                                                // Create an initial data object for the polar chart
                                                var data = {
                                                    // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
                                                    datasets: [{
                                                        label: 'Dataset 1',
                                                        data: [100, 60],
                                                        backgroundColor: ['blue', 'green'],
                                                    }]
                                                };

                                                // Create configuration options for the polar chart
                                                var options = {
                                                    responsive: true,
                                                    maintainAspectRatio: false,
                                                    scales: {
                                                        r: {
                                                            ticks: {
                                                                display: false, // Hide the ticks (numbers) on the chart
                                                            },
                                                        },
                                                    },
                                                };

                                                // Create a new polar chart instance
                                                var polarChart = new Chart(canvas, {
                                                    type: 'polarArea',
                                                    data: data,
                                                    options: options
                                                });

                                                // Example of updating the chart data dynamically
                                                setTimeout(function() {
                                                    // polarChart.data.datasets[0].data = [20, 30, 60, 60, 60]; // Update data values
                                                    polarChart.update(); // Update the chart
                                                }, 3000); // Update after 3 seconds
                                            </script>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-xl-3 col-xxl-5">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <div>
                                    <h4 class="card-title mb-2">COD Amont</h4>
                                    <h2 class="mb-0">₹ {{$codAmount}}</h2>
                                </div>
                                <ul class="card-list">
                                    <li class="justify-content-end">Income<span class="bg-success circle me-0 ms-2"></span></li>
                                    <li class="justify-content-end">Outcome<span class="bg-danger circle me-0 ms-2"></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-7">
                        <div class="card">
                            <div class="card-header d-flex flex-wrap border-0 pb-0">
                                <div class="me-auto mb-sm-0 mb-3">
                                    <h4 class="card-title mb-2">COD Overview</h4>
                                    <span class="fs-12">Download your selected date range </span>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-rounded btn-md btn-primary me-3 me-3"><i class="las la-download scale5 me-3"></i>Download Report</a>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                            <div class="card-body pb-2">
                                <div class="d-sm-flex d-block">
                                    <div class="form-check toggle-switch text-end form-switch me-4">
                                        <input checked class="form-control" type="text" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">start Date</label>
                                    </div>
                                    <div class="form-check toggle-switch text-end form-switch me-auto">
                                        <input class="form-control" type="text" id="flexSwitchCheckDefault1">
                                        <label class="form-check-label" for="flexSwitchCheckDefault1">last Date</label>
                                    </div>
                                    <ul class="card-list d-flex mt-sm-0 mt-3">
                                        <li class="me-3"><span class="bg-success circle"></span>Income</li>
                                        <li><span class="oranger-bg circle"></span>Outcome</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datewise Order Summary</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md" id="statusTable">
                                            <thead>
                                                <tr>
                                                    <th style="width:80px;"><strong>#</strong></th>
                                                    <th><strong>Order Date</strong></th>
                                                    <th><strong>Total Orders</strong></th>
                                                    <th><strong>Pickup Scheduled</strong></th>
                                                    <th><strong>In-Transit</strong></th>
                                                    <th><strong>NDR</strong></th>
                                                    <th><strong>Out for Delivery</strong></th>
                                                    <th><strong>Delivered</strong></th>
                                                    <th><strong>RTO</strong></th>
                                                </tr>
                                            </thead>
                                           @php
$reversedDates = array_reverse($dates);
@endphp

<tbody>
    @foreach($reversedDates as $index => $date)
    <tr class="{{ $index >= 7 ? 'd-none' : '' }}">
        <td>#</td>
        <td>{{ $date }}</td>
        <td>{{ $statusCounts['totalOrder'][$date] ?? 0 }}</td>
        <td>{{ $statusCounts['pickup'][$date] ?? 0 }}</td>
        <td>{{ $statusCounts['in_transit'][$date] ?? 0 }}</td>
        <td>{{ $statusCounts['NDR'][$date] ?? 0 }}</td>
        <td>{{ $statusCounts['ofd'][$date] ?? 0 }}</td>
        <td>{{ $statusCounts['Deliverd'][$date] ?? 0 }}</td>
        <td>{{ $statusCounts['RTO'][$date] ?? 0 }}</td>
    </tr>
    @endforeach
</tbody>
                                        </table>
                                    </div>
                                    <button id="showMoreBtn" class="btn btn-primary">Show More</button>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.getElementById('showMoreBtn').addEventListener('click', function() {
                                let rows = document.querySelectorAll('#statusTable tbody tr');
                                rows.forEach((row, index) => {
                                    if (index >= 7) {
                                        row.classList.remove('d-none');
                                    }
                                });
                                this.style.display = 'none'; // Hide the button after clicking
                            });
                        </script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $(".button").click(function() {
                                    $("#p").toggle();
                                });
                            });
                        </script>

                    </div>
                    @foreach($result as $courier => $counts)
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="card" style="background-color: #dadafc;">
                            <div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
                                <div class="">
                                    <h4 class="card-title ">{{ $courier }}</h4>
                                </div>

                            </div>
                            <div class="card-body tab-content orders-summary pt-3">
                                <div class="tab-pane fade show active" id="Monthly">

                                    <div class="row text-center">
                                        <div class="col-sm-2 ">
                                            <div class="border border-3 px-1 py-2 rounded-xl bg-white">
                                                <h2 class="fs-32 font-w600 counter">{{ $counts['totalCount'] }}</h2>

                                            </div>
                                            <p class="fs-16 mb-0">Total Shipment</p>
                                        </div>
                                        <div class="col-sm-2 ">
                                            <div class="border border-3 px-1 py-2 rounded-xl bg-white">
                                                <h2 class="fs-32 font-w600 counter">{{ $counts['pendingCount'] }}</h2>

                                            </div>
                                            <p class="fs-16 mb-0">Pickup Pending</p>

                                        </div>
                                        <div class="col-sm-2 ">
                                            <div class="border border-3 px-1 py-2 rounded-xl bg-white">
                                                <h2 class="fs-32 font-w600 counter">{{ $counts['inTransitCount'] }}</h2>

                                            </div>
                                            <p class="fs-16 mb-0">In-transit</p>
                                        </div>
                                        <div class="col-sm-2 mb-4">
                                            <div class="border border-3 px-1 py-2 rounded-xl bg-white">
                                                <h2 class="fs-32 font-w600 counter">{{ $counts['deliveredCount'] }}</h2>

                                            </div>
                                            <p class="fs-16 mb-0">Delivered</p>
                                        </div>
                                        <div class="col-sm-2 ">
                                            <div class="border border-3 px-1 py-2 rounded-xl bg-white">
                                                <h2 class="fs-32 font-w600 counter">{{ $counts['ofdCount'] }}</h2>

                                            </div>
                                            <p class="fs-16 mb-0">OFD</p>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="border border-3 px-1 py-2 rounded-xl bg-white">
                                                <h2 class="fs-32 font-w600 counter">{{ $counts['rtoCount'] }}</h2>

                                            </div>
                                            <p class="fs-16 mb-0">RTO</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                     @endforeach

                    


                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <script>
            function showDiv(divId, element) {
                document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            document.getElementById('courier_summary_form').addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            return response.json();
                        } else {
                            return response.text(); // Handle non-JSON responses
                        }
                    })
                    .then(data => {
                        // console.log(data);
                        $('#courier_summary').html(data);
                        // Handle the response data
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>


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
    <!-- <script src="{{asset('newtheme/vendor/apexchart/apexchart.js')}}"></script> -->
    <script src="{{asset('newtheme/./vendor/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('newtheme/./vendor/wnumb/wNumb.js')}}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{asset('newtheme/vendor/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('newtheme/vendor/swiper/js/swiper-bundle.min.js')}}"></script>

    <!-- Dashboard 1 -->
    <script src="{{asset('newtheme/js/dashboard/dashboard-5.js')}}"></script>
    <script src="{{asset('newtheme/js/dashboard/dashboard-1.js')}}"></script>

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