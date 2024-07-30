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
	
	
	
	<link href="{{asset('newtheme/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
	<!-- Style css -->
     <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">
	
</head>
<script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>
<script type="text/javascript">
	function alllorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_All_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#allordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	alllorders();

	function processorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Pending_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#processordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	processorders();


	function canceledorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Canceled_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#canceledordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	canceledorders();



	function deliveredorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#deliveredordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	deliveredorders();


	function rtoorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Cancel_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#rtoordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	rtoorders();





	function notpickedorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Uploaded_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#notpickedordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	notpickedorders();




	function failedorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/failed-orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#failedordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	failedorders(); 

	function Ofdorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/ofd-orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#Ofdordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	Ofdorders();
	function Transitorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/Transit-orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#Transitordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	Transitorders();
</script>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
		   <span style="--i:1">L</span>
		   <span style="--i:2">o</span>
		   <span style="--i:3">a</span>
		   <span style="--i:4">d</span>
		   <span style="--i:5">i</span>
		   <span style="--i:6">n</span>
		   <span style="--i:7">g</span>
		   <span style="--i:8">.</span>
		   <span style="--i:9">.</span>
		   <span style="--i:10">.</span>
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
            <!-- row -->
			<div class="container-fluid">
				<div class="d-flex flex-wrap align-items-center mb-3">
					<div class="mb-3 me-auto">
						<div class="card-tabs style-1 mt-3 mt-sm-0">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="javascript:void(0);" data-bs-toggle="tab" id="transaction-tab" data-bs-target="#AllTransaction" role="tab">All Orders</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Delivered-tab" data-bs-target="#Completed" role="tab">Delivered</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="ofd-tab" data-bs-target="#OFD" role="tab">OFD</a>
								</li>
									<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Transit-tab" data-bs-target="#Transit" role="tab">In Transit </a>
								</li
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Pending-tab" data-bs-target="#Pending" role="tab">Pending</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Canceled-tab" data-bs-target="#Canceled" role="tab">Cancelled</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Not-Picked-tab" data-bs-target="#Not-Picked" role="tab">Not Picked</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="RTO-tab" data-bs-target="#RTO" role="tab">RTO</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Failed-tab" data-bs-target="#Failed" role="tab">Failed</a>
								</li>
								
							</ul>
						</div>
					</div>
					<a href="javascript:void(0);" class="btn btn-outline-primary mb-3"><i class="fa fa-calendar me-3 scale3"></i>Filter Date</a>
				</div>
				<div class="row">
					<div class="col-xl-12 tab-content">
						<div class="tab-pane fade show active" id="AllTransaction" role="tabpanel" aria-labelledby="transaction-tab">
							<div id="allordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="Completed" role="tabpanel" aria-labelledby="Completed-tab">
						<div id="deliveredordersshows">
								<h6>Loading...</h6>
							</div>
							
						</div>
						<div class="tab-pane fade" id="OFD" role="tabpanel" aria-labelledby="ofd-tab">
							<div id="Ofdordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
							<div id="processordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="Canceled" role="tabpanel" aria-labelledby="Canceled-tab">
							<div id="canceledordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="Transit" role="tabpanel" aria-labelledby="Transit-tab">
							<div id="Transitordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="Not-Picked" role="tabpanel" aria-labelledby="Not-Picked-tab">
							<div id="notpickedordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="RTO" role="tabpanel" aria-labelledby="RTO-tab">
							<div id="rtoordersshows">
								
							</div>
						</div>
						<div class="tab-pane fade" id="Failed" role="tabpanel" aria-labelledby="Failed-tab">
							<div id="failedordersshows">
								
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

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
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
	
	<!-- Datatable -->
	<script src="{{asset('newtheme/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('newtheme/js/plugins-init/datatables.init.js')}}"></script>

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