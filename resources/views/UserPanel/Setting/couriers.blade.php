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

    @include("UserPanel/app")
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item  active"><a href="javascript:void(0)">Settings</a></li>
          </ol>
        </div>
        <div class="row">






          <div class="col-xl-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Profile Details</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="nav flex-column nav-pills mb-3">
                      <a href="#v-pills-financial" data-bs-toggle="pill" class="nav-link active show">Financial Details</a>
                      <a href="#v-pills-profile" data-bs-toggle="pill" class="nav-link">Profile</a>
                      <a href="#v-pills-billing" data-bs-toggle="pill" class="nav-link">Billing Info.</a>
                      <a href="#v-pills-courier" data-bs-toggle="pill" class="nav-link">Courier Permissions</a>
                      <a href="#v-pills-pass" data-bs-toggle="pill" class="nav-link">Change Password</a>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="tab-content">

                      <div id="v-pills-courier" class="tab-pane fade">
                        <div class="col-xl-12 col-md-12">
                          <div class="card">
                            <div class="card-header">
                              <h5 class="card-title">Courier Permissions</h5>
                            </div>
                            <div class="card-body">
                              <div class="panel-body">

                                <?php
                                $couriercompany = array('NI' => 'Nimbus', 'IN' => 'Intargos');
                                $couriernames = array();

                                foreach ($couriers as $cr) {

                                  $couriernames[$cr->courier_by] = $cr->display_courier_by;
                                }
                                ?>
                                <table class="datatable table table-stripped">
                                  <thead>
                                    <tr>
                                      <th>Sno</th>
                                      <!--<th>Courier Compny</th>-->
                                      <th>Courier Through</th>
                                      <th>Courier Priority</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $cnt = 1;
                                    $courirlen = count($params);
                                    ?>
                                    @foreach($params as $param)
                                    <tr>
                                      <td><?php echo $cnt++; ?></td>
                                     
                                      <td><?php
                                          if ($couriernames["$param->courier_by"] == "IntargosAny") {
                                            echo "Shipedia";
                                          } elseif ($couriernames["$param->courier_by"] == "SmartshipAny") {
                                            echo "Bluedart";
                                          } else {
                                            echo $couriernames["$param->courier_by"];
                                          }
                                          ?></td>
                                      <td>
                                        <select class="form-control" style="padding:0px 0px 0px 5px !important;height:21px !important" onchange="change_priority('<?php echo $param->courier_code; ?>','<?php echo $param->courier_by; ?>',this.value)">
                                          <option value="0">Priority not assign</option>
                                          @for($cnois=1;$cnois<($courirlen+1);$cnois++) @if($param->courier_priority == $cnois)
                                            <option value="{{ $cnois }}" selected="">Priority {{ $cnois }}</option>
                                            @else
                                            <option value="{{ $cnois }}">Priority {{ $cnois }}</option>
                                            @endif
                                            @endfor
                                        </select>
                                      </td>
                                      @if($param->user_flg)
                                      <td>
                                        <label class="switch">
                                          <input type="checkbox" onchange="change_status('<?php echo $param->courier_code; ?>','<?php echo $param->courier_by; ?>',this)" value="0" checked>
                                          <span class="slider round"></span>
                                        </label>
                                      </td>
                                      @else
                                      <td>
                                        <label class="switch">
                                          <input type="checkbox" onchange="change_status('<?php echo $param->courier_code; ?>','<?php echo $param->courier_by; ?>',this)" value="1">
                                          <span class="slider round"></span>
                                        </label>
                                      </td>
                                      @endif
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>

                              <script type="text/javascript">
                                function change_priority(code, courier, obj) {
                                  var userid = "{{ $id }}"
                                  var value = obj
                                  // alert(userid);
                                  // alert(code);
                                  // alert(courier);
                                  // alert(value);
                                  $.ajax({
                                    type: "GET",
                                    url: "{{ asset('/courier-priority-update') }}",
                                    data: {
                                      code: code,
                                      courier: courier,
                                      userid: userid,
                                      value: value
                                    },
                                    success: function(data) {

                                    },
                                    error: function(data) {
                                      console.log('Error:', data);
                                    }
                                  });
                                }

                                function change_status(code, courier, obj) {
                                  var userid = "{{ $id }}"
                                  var value = 0;
                                  if ($(obj).prop('checked') == true) {
                                    value = 1;
                                  }
                                  $.ajax({
                                    type: "GET",
                                    url: "{{ asset('/courier-permissions-update') }}",
                                    data: {
                                      code: code,
                                      courier: courier,
                                      userid: userid,
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