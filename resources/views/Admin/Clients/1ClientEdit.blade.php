@extends('Admin.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">
<!-- Heading -->
<header class="page-header">
<h2>Client Edit</h2>
<div class="right-wrapper pull-right">
	<ol class="breadcrumbs">
	<!-- <li><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li> -->
	<!-- <li><span>Dashboard</span></li> -->
	<!-- <li></li> -->
	</ol>
	<!-- <a class="sidebar-right-toggle">	</a> -->
</div>
</header>
<!-- Heading -->


@if(session('status')=="Client Details Update")
<div class="alert alert-success success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>{{ session('status') }}</strong>
</div>
@elseif(session('status'))
<div class="alert alert-danger success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>{{ session('status') }}</strong>
</div>
@endif

<!-- start: page -->
<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel panel-primary">
        <header class="panel-heading">
        <div class="panel-actions">
            <a href="{{ asset('/New_Client') }}" class="btn" style="color:white;width:auto;height:35px;background-color:#ED9C28 !important"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
        <h2 class="panel-title"><b>Client Edit Process</b></h2>
    </header>
<div class="panel-body">
<div class="row">
<!--  -->


<section class="panel">

	<div class="panel-body">
<form method="post" action="{{ asset('/New_Client_Edit_Update') }}">
		<div class="col-md-12">
            <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Eamil" value="{{ $params['username'] }}" readonly="">
            </div>
            <div class="col-md-6">
                <input type="number" name="mobile" class="form-control" placeholder="Mobile" value="{{ $params['mobile'] }}" readonly="">
            </div>
        </div>
        <div class="col-md-12"><br>
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $params['name'] }}" required="">
            </div>
            <div class="col-md-6">
                <select class="form-control" name="userstatus" style="border-color:green">
                    @if($params['status'])
                        <option value="1" selected="" style="color:green">Active</option>
                        <option value="0" style="color:red">Deactive</option>
                    @else
                        <option value="1" style="color:green">Active</option>
                        <option value="0" selected="" style="color:red">Deactive</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-12"><br>
					<hr>
            <div class="col-md-6" style="background:#EEEEEE;border-radius:20px"><br>
<div class="col-md-12 text-center">
    <label style="font-size:15px">
        @if($params['report_show'])
        <b><input type="checkbox" name="reports" checked=""> Reports Functions Show</b>
        @else
        <b><input type="checkbox" name="reports"> Reports Functions Show</b>
        @endif
    </label>
</div>
                <!-- <label style="font-size:15px">
                    @if($params['report_mis_show'])
                    <input type="checkbox" name="mis" checked=""> MIS
                    @else
                    <input type="checkbox" name="mis"> MIS
                    @endif
                </label>
                &ensp;&ensp;&ensp; -->
                <label style="font-size:15px">
                    @if($params['report_pod_show'])
                    <input type="checkbox" name="pod" checked=""> POD
                    @else
                    <input type="checkbox" name="pod"> POD
                    @endif
                </label>
                &ensp;&ensp;&ensp;
                <!-- <label style="font-size:15px">
                    @if($params['report_rpod_show'])
                    <input type="checkbox" name="rpod" checked=""> R-POD
                    @else
                    <input type="checkbox" name="rpod"> R-POD
                    @endif
                </label>
                &ensp;&ensp;&ensp; -->
                <!-- <label style="font-size:15px">
                    @if($params['report_daily_show'])
                    <input type="checkbox" name="drpt" checked=""> Daily Report
                    @else
                    <input type="checkbox" name="drpt"> Daily Report
                    @endif
                </label> -->
								<br>&ensp;
								<br>
            </div>



           <!--   <div class="col-md-6">
<div class="col-md-12 text-center">
    <label style="font-size:15px">
        @if($params['billing_show'])
        <input type="checkbox" name="billing" checked=""> Billing Functions Show
        @else
        <input type="checkbox" name="billing"> Billing Functions Show
        @endif
    </label>
</div>
                <label style="font-size:15px">
                    @if($params['billing_all_show'])
                    <input type="checkbox" name="billall" checked=""> Billing All Show
                    @else
                    <input type="checkbox" name="billall"> Billing All Show
                    @endif
                </label>
                &ensp;&ensp;&ensp;
                <label style="font-size:15px">
                    @if($params['billing_download_show'])
                    <input type="checkbox" name="billdown" checked=""> Billing Download Show
                    @else
                    <input type="checkbox" name="billdown"> Billing Download Show
                    @endif
                </label>
            </div>
        </div>

        <div class="col-md-12"><br>
            <div class="col-md-6">
<div class="col-md-12 text-center">
    <label style="font-size:15px">
        @if($params['wallet_show'])
        <input type="checkbox" name="wallet" checked=""> Wallet Functions Show
        @else
        <input type="checkbox" name="wallet"> Wallet Functions Show
        @endif
    </label>
</div>
                <label style="font-size:15px">
                    @if($params['wallet_add_show'])
                    <input type="checkbox" name="walletadd" checked=""> Wallet Add Show
                    @else
                    <input type="checkbox" name="walletadd"> Wallet Details Show
                    @endif
                </label>
                &ensp;&ensp;&ensp;
                <label style="font-size:15px">
                    @if($params['wallet_details_show'])
                    <input type="checkbox" name="walletdetails" checked=""> Wallet Details Show
                    @else
                    <input type="checkbox" name="walletdetails"> Wallet Details Show
                    @endif
                </label>
            </div> -->


             <div class="col-md-6"><br>
                <label style="font-size:15px">
                    @if($params['pincode_show'])
                    <input type="checkbox" name="pinshow" checked=""> Pincode Show
                    @else
                    <input type="checkbox" name="pinshow"> Pincode Show
                    @endif
                </label>
            </div>
        </div>


        <div class="col-md-12"><br>
            <div class="col-md-6">
                <label style="font-size:15px">
                    @if($params['ndr_show'])
                    <input type="checkbox" name="ndrshow" checked=""> NDR Show
                    @else
                    <input type="checkbox" name="ndrshow"> NDR Show
                    @endif
                </label>
            </div>
             <!-- <div class="col-md-6">
                <label style="font-size:15px">
                    @if($params['print_ship_labels'])
                    <input type="checkbox" name="printlabelshow" checked=""> Print Show Label
                    @else
                    <input type="checkbox" name="printlabelshow"> Print Show Label
                    @endif
                </label>
            </div> -->

        <!-- </div>
        <div class="col-md-12"><br> -->

            <!-- <div class="col-md-6">
                <label style="font-size:15px">
                    @if($params['rider_show'])
                    <input type="checkbox" name="ridershow" checked=""> Rider Show
                    @else
                    <input type="checkbox" name="ridershow"> Rider Show
                    @endif
                </label>
            </div> -->


        </div>
<!--
<div class="col-md-12" style="border:1px solid #2da98f;border-radius:20px">
    <center><u style="font-size:18px;color:#2da98f"><b>Courier Supports</b></u></center>

<div class="col-md-6">
    <div class="col-md-6">
        <label style="font-size:15px">
            @if($params['Pickrr'])
            <b><input type="checkbox" name="Pickrr" checked=""> Pickrr</b>
            @else
            <b><input type="checkbox" name="Pickrr"> Pickrr</b>
            @endif
        </label>
    </div>
    <div class="col-md-6">
        <select class="form-control" name="PickrrPriority">
            <option value="0">Priority</option>
            <?php
                for ($i=1;$i<3;$i++) {
                    if($params['api_priority_Pickrr']==$i){
                        echo "<option value='$i' selected>$i</option>";
                    }else
                    {
                        echo "<option value='$i'>$i</option>";
                    }
                }
            ?>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="col-md-6">
        <label style="font-size:15px">
            @if($params['SmartShip'])
            <b><input type="checkbox" name="SmartShip" checked=""> SmartShip</b>
            @else
            <b><input type="checkbox" name="SmartShip"> SmartShip</b>
            @endif
        </label>
    </div>
    <div class="col-md-6">
        <select class="form-control" name="SmartShipPriority">
            <option value="0">Priority</option>
            <?php
                for ($i=1;$i<3;$i++) {
                    if($params['api_priority_SmartShip']==$i){
                        echo "<option value='$i' selected>$i</option>";
                    }else
                    {
                        echo "<option value='$i'>$i</option>";
                    }
                }
            ?>
        </select>
    </div>
</div>
    &ensp; <br>
</div> -->



        <div class="col-md-12 text-center">
					<hr>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <input type="hidden" name="customerid" value="{{ $params['id'] }}">
                @csrf
                <button type="submit" class="btn btn-success">Update Details</button>
            </div>
            <div class="col-md-3"></div>
        </div>
</form>
	</div>
</section>




<!--  -->
</div>
</div>
</section>
</div>


</div>




<!-- end: page -->
</section>
@endsection


<!-- Header -->
@section('HeaderExtraFiles')

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/select2/select2.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('Admin/assets/vendor/modernizr/modernizr.js') }}"></script>
@endsection
<!-- Header -->

<!-- Footer -->
@section('FooterExtraFiles')
			<!-- Vendor -->
		<script src="{{ asset('Admin/assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		<!-- Specific Page Vendor -->
		<script src="{{ asset('Admin/assets/vendor/select2/select2.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('Admin/assets/javascripts/theme.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('Admin/assets/javascripts/theme.custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('Admin/assets/javascripts/theme.init.js') }}"></script>


		<!-- Examples -->
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.default.js') }}"></script>
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
@endsection
<!-- Footer -->
