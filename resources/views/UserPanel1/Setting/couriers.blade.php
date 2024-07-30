@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Switch -->
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 30px;
    height: 17px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 13px;
    width: 13px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(13px);
    -ms-transform: translateX(13px);
    transform: translateX(13px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<!-- 
<label class="switch">
  <input type="checkbox">
  <span class="slider round"></span>
</label>

<label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label>
 -->
<!-- Switch -->





<div class="content container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="page-title">Settings </h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-2 col-md-4">

      <div class="widget settings-menu">
        <ul>
          <li class="nav-item ">
            <a href="{{ asset('/setting') }}" class="nav-link btn btn-primary">
              <i class="far fa-user"></i> <span>Profile Settings</span>
            </a>
          </li>
          <li class="nav-item my-2">
            <a href="{{ asset('/financial-details') }}" class="nav-link btn btn-primary">
              <i class="far fa-list-alt"></i> <span>Financial Details</span>
            </a>
          </li>
          <li class="nav-item my-2">
            <a href="{{ asset('/billing-information') }}" class="nav-link btn btn-primary">
              <i class="far fa-check-square"></i> <span>Billing Information</span>
            </a>
          </li>
          <!-- <li class="nav-item my-2">
            <a href="" class="nav-link btn btn-primary">
              <i class="far fa-bell"></i> <span>KYC Details</span>
            </a>
          </li> -->

          <li class="nav-item my-2">
            <a href="{{ asset('/courier-permissions') }}" class="nav-link active btn btn-primary">
              <i class="fa fa-signal"></i> <span>Courier Permissions</span>
            </a>
          </li>

          <li class="nav-item my-2">
            <a href="{{ asset('/change-password') }}" class="nav-link btn btn-primary">
              <i class="fas fa-unlock-alt"></i> <span>Change Password</span>
            </a>
          </li>

        </ul>
      </div>

    </div>
    <div class="col-xl-9 col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Courier Permissions</h5>
        </div>
        <div class="card-body">
          <div class="panel-body">

            <?php
            $couriercompany = array('NI' => 'Nimbus', 'IN' => 'Intargos');
            $couriernames = array();
            //$couriernames = array('AML'=>'Amazon Logistics','BDE'=>'Bluedart Express','DELS'=>'Delhivery Surface','DTCS'=>'DTDC Surface','ECMX'=>'Ecom EXP','EKT'=>'Ekart','SFX'=>'Shadowfax','STR'=>'Smartr','XPBS'=>'Xpressbees Surface','ANY'=>'Any','DELA'=>'Delhivery Air','DTCA'=>'DTDC Air','DTCP'=>'DTDC Premium','ECMR'=>'Ecom ROS','XPBA'=>'Xpressbees Air');
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
                  <!--<td><?php echo $couriercompany["$param->courier_code"]; ?></td>     -->
                  <td><?php
                        if($couriernames["$param->courier_by"]=="IntargosAny"){
                          echo "Shipedia";
                        }elseif ($couriernames["$param->courier_by"]=="SmartshipAny") {
                          echo "Bluedart";
                        }else{
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


@endsection