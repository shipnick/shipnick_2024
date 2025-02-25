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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">All Merchants</a></li>
            <li class="breadcrumb-item  active"><a href="javascript:void(0)">Merchant Settings</a></li>
          </ol>
        </div>
        <div class="row">

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Merchant Settings</h4>
              </div>
              <div class="card-body">
                <!-- Nav tabs -->
                <div class="custom-tab-1">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link " href="{{ asset('/client-setting/'.$id) }}"><i class="la la-smile solid"></i>&nbsp;&nbsp;Merchant Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ asset('/client-financial-details/'.$id) }}"><i class="la la-wallet"></i>&nbsp;&nbsp;Financial Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ asset('/client-billing-information/'.$id) }}"><i class="la la-home me-2"></i>&nbsp;&nbsp;Address Info.</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="{{ asset('/client-courier-permissions/'.$id) }}"><i class="la la-ship"></i>&nbsp;&nbsp;Courier Permissions</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link  " href="{{ asset('/rate-list-permissions/'.$id) }}"><i class="la la-ship"></i>&nbsp;&nbsp;Courier pricing</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="home1" role="tabpanel">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table primary-table-bg-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Courier Name</th>
                                <th scope="col">Sent by Courier Company</th>
                                <th scope="col">Active/Inactive (Select to active API)
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $cnt = 1; ?>
                              @foreach($params as $param)
                              <?php $dlstatus = "notchecked"; ?>
                              <?php $xbstatus = "notchecked"; ?>
                              @foreach($permissions as $permission)
                              @if($permission->courier_code==$param->courier_code &&
                              $permission->courier_by==$param->courier_by &&
                              $permission->admin_flg=='1' && $permission->user_id==$id)
                              <?php $dlstatus = "checked"; ?>
                              @endif
                              @endforeach
                              <?php
                              $corunamea = $param->name;
                              if ($admins[$corunamea]) {
                              ?>
                                <tr>
                                  <td>
                                    <?php echo $cnt++; ?>
                                  </td>
                                  <td>
                                    <?php
                                    // echo $param->name; 
                                    if ($param->name == "Xpressbees") {
                                      echo "Shipnick Xpressbees";
                                    } elseif ($param->name == "Xpressbees2") {
                                      echo "XpressBees";
                                    }elseif ($param->name == "Xpressbees3") {
                                      echo "Shipnick XB";
                                    } else {
                                      echo $param->name;
                                    } ?>
                                  </td>
                                  <td>
                                    <?php
                                    // $param->display_courier_by; 
                                    if ($param->display_courier_by == "SmartshipAny") {
                                      echo "Bluedart Any";
                                    } else {
                                      echo $param->display_courier_by;
                                    } ?>
                                  </td>
                                  <td>
                                    <label class="switch">
                                      <input type="checkbox" onchange="change_status('<?php echo $param->courier_code; ?>','<?php echo $param->courier_by; ?>','<?php echo $param->cl_id; ?>',this)" value="0" <?php echo $dlstatus; ?>>
                                      <span class="slider round"></span>
                                    </label>
                                  </td>
                                </tr>
                              <?php
                              }
                              ?>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                      </div>
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


    <script type="text/javascript">
      function change_status(code, courier, courieridno, obj) {
        var userid = "{{ $id }}";

        var value = 0;
        if ($(obj).prop('checked') == true) {
          value = 1;
        }

        $.ajax({
          type: "GET",
          url: "{{ asset('/client-courier-permissions') }}",
          data: {
            code: code,
            courier: courier,
            userid: userid,
            courieridno: courieridno,
            value: value
          },
          success: function(data) {

          },
          error: function(data) {
            console.log('Error:', data);
          }
        });

      }
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