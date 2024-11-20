<!DOCTYPE html>
<html lang="en">

<head>

  <!-- All Meta -->
  <meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Shipnick.com">
  <meta name="robots" content="">
  <meta name="keywords" content="Logistics, shipment, shipnick, shipnick.com, courier, xpressbee, ecom, dtdc, bluedart, invoice, modern, money, transaction, Transfer money, user interface, wallet">
  <meta name="description" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
  <meta property="og:title" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
  <meta property="og:description" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
  <meta property="og:image" content="//shipnick.com/Shipnick.jpg">
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

 @include("Admin/app")
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
                                <div class="">
                                    
                                    <div class="">
                                        <div class="" >
                                            <div class="row">
                                                <style>
                                                .table thead th {
                                                          
                                                            border-color: #161515 !important;
                                                        }
                                                     .table th, .table td {
                                                        border-color: #020202;
                                                        padding: 4px 10px;
                                                    }
                                                    
                                                    .table-bordered > :not(caption) > * > * {
                                                          
                                                        border-width: 2px  2px;
                                                    }
                                                    .table tbody tr td {
                                                        vertical-align: middle;
                                                        border-color: #020202;
                                                    }
                                                </style>
                                                @foreach ($courier as $post)
                                                <div class="col-md-2"></div>
                                                    <div class="col-md-9 mt-3">
                                                        <div class="" style="background-color: #12263f;">
                                                            <h5 class="text-white text-center p-2">
                                                                <strong>Shipnick  {{ $post->courier_name }} {{ $post->weight }}</strong><br>
                                                            </h5>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-sm text-center align-middle" style="text-size:10px">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="font-size: 11px;"><strong>COURIER</strong></th>
                                                                        <th style="font-size: 11px;"><strong>TYPE</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(A)</span><strong><br>WITHIN <br> CITY</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(B)</span><strong><br>WITHIN <br> STATE</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(C)</span><strong><br>REGIONAL</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(D)</span><strong><br>METRO TO <br> METRO</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(E)</span><br><strong>ROI</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(F)</span><strong><br>NE,J&K,KL,AN</strong></th>
                                                                        <th style="font-size: 11px;"><strong>COD<br>CHARGES</strong></th>
                                                                        <th style="font-size: 11px;"><strong>COD%</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="text-black">
                                                                        <td rowspan="3">{{ $post->courier_name }}{{ $post->weight }}</td>
                                                                        <td>FWD</td>
                                                                        <td>{{ $post->fwda }}</td>
                                                                        <td>{{ $post->fwdb }}</td>
                                                                        <td>{{ $post->fwdc }}</td>
                                                                        <td>{{ $post->fwdd }}</td>
                                                                        <td>{{ $post->fwdf }}</td>
                                                                        <td>{{ $post->fwde }}</td>
                                                                        <td rowspan="3">{{ $post->fwdg }}</td>
                                                                        <td rowspan="3">{{ $post->fwdh }}</td>
                                                                    </tr>
                                                                    <tr class="text-black">
                                                                        <td>RTO</td>
                                                                        <td>{{ $post->rtoa }}</td>
                                                                        <td>{{ $post->rtob }}</td>
                                                                        <td>{{ $post->rtoc }}</td>
                                                                        <td>{{ $post->rtod }}</td>
                                                                        <td>{{ $post->rtof }}</td>
                                                                        <td>{{ $post->rtoe }}</td>
                                                                    </tr>
                                                                    <tr class="text-black" style="border: 2px solid black;">
                                                                        <td>Add Wt.</td>
                                                                        <td>{{ $post->wta }}</td>
                                                                        <td>{{ $post->wtb }}</td>
                                                                        <td>{{ $post->wtc }}</td>
                                                                        <td>{{ $post->wtd }}</td>
                                                                        <td>{{ $post->wtf }}</td>
                                                                        <td>{{ $post->wte }}</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Terms & Conditions:</h4>
                            </div>
                            
                            <div class="card-body">
                                
                                <!-- Nav tabs -->
                                <div class="">
                                    
                                    <div class="terms-conditions">
                                        <!--<h4>Terms & Conditions:</h4>-->
                                        <ul class="text-black">
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right mb-2"></i> Above prices are inclusive of GST.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Chargeable Weight will be Physical / Dead Weight or Volumetric Weight whichever is Higher.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>COD Charges will be fixed COD charge or COD % of the order value whichever is Higher.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Volumetric Weight (Kilogram) calculation as per IATA - Length (cm) x Breadth (cm) x Height (cm) / 5000</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Other Charges like Octroi charges, state entry tax and fees, address correction charges if applicable shall be charged extra.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>RTO (return to origin) shipment will be charged separately from the forward delivery rate, which will be the same as Forward Rates.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>For any queries a ticket has to be raised on: <a href="mailto:info@shipnick.com"> <strong>info@shipnick.com</strong> </a></li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>The maximum liability if any is limited to Rs. 1000/- in the event of a claim by the Merchant, provided such claim is raised by the Merchant within 7 days from the date of such damage or loss or theft.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>The Merchant shall not book / handover or allow to be handed over any Product which is banned, restricted, illegal, prohibited, stolen, infringing of any third-party rights, liquid materials, hazardous or         dangerous or in breach of any law or regulation in force in India for the purpose of the logistics or delivery services.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Other terms and conditions will be applicable as defined in the agreement.</li>
                                        </ul>
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