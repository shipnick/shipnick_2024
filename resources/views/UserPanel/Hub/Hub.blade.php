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
	
	
	
	
	<link href="vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Hub Details</a></li>
					</ol>
                </div>
                <!-- row -->
                @if(session('status')=="Hub Details Delete Successfully")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status'))
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @endif 

                <div class="row">
                    
					<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Hub Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                            <th>Sno</th>
                                        <th>Hub Code</th>
                                        <!--<th>Logo</th>-->
                                        <th>Hub Name</th>
                                        <th>GST No.</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Pincode</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Delivery Type</th>
                                        <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    @php($i = 1)
                                    @foreach($params as $param)
                                    <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <?php if($param->smartship_hubid=="" && $param->smartship_hubid=="R" ){ ?>
                                            <td class="text-danger">invalid details</td>
                                            <?php }elseif($param->smartship_hubid=="R"){ ?>
                                                <td>invalid details</td>
                                                <?php  }else{ ?>
                                        <td>{{ $param->hub_code }}</td>
                                        <?php }  ?>
                                        <!--<td><img src="{{ asset('HubDetails') }}/{{ $param->hub_folder }}/{{ $param->hub_img }}" title="Hub Image" alt="Not Available" style="width:50px;height:50px;"></td>-->
                                        <td>{{ Str::limit($param->hub_name, 20) }}</td>
                                        <td>{{ $param->hub_gstno }}</td>
                                        <td>{{ Str::limit($param->hub_address1, 20) }}</td>
                                        <td>{{ $param->hub_mobile }}</td>
                                        <td>{{ $param->hub_pincode }}</td>
                                        <td>{{ $param->hub_state }}</td>
                                        <td>{{ $param->hub_city }}</td>
                                        <td>{{ $param->hub_deliverytype }}</td>
                                        
                                       
                                        <td >
                                               <a href="{{ asset('UPHub_Edit/'.$param->hub_id) }}" title="Click here to edit hub detail">
                                                    <i class="far fa-edit me-2"></i>Edit
                                                </a>
                                                <a href="{{ asset('UPHub_Delete/'.$param->hub_id) }}" title="Click here to delete hub detail">
                                                    <i class="far fa-trash-alt me-2"></i>Delete
                                                </a>
                                        </td>
                                       
                                        <!--<td>-->
                                        <!--    <a href="{{ asset('/UPHub_Edit/'.$param->hub_id) }}" title="Click here to edit hub detail"><i class="far fa-edit me-2"></i>Edit</a>-->
                                        <!--</td>-->
                                    </tr>
                                    @php($i++)
                                    @endforeach
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    
                    
                    
                        <!-- /# card -->
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
	
  
	
	<script>
		jQuery(document).ready(function(){
		setTimeout(function(){
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
			jQuery(window).on('resize',function(){
				new dezSettings(dezSettingsOptions);
			})
		},1000)
	});

	
	</script>
	
</body>
</html>