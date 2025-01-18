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
	<link rel="{{asset('newtheme/stylesheet" href="vendor/nouislider/nouislider.min.css')}}">
	<link rel="{{asset('newtheme/stylesheet" href="./vendor/swiper/css/swiper-bundle.min.css')}}">
	<!-- Style css -->
     <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">
	
</head>
<style>
	.light-blue-bg {
		background-color: #F0F8FEFF;
		border: 1px solid #b9e1ff;
	}

	.light-grey-bg {
		background-color: #f3f3f3;
		border: 1px solid #d6d6d6;
	}

	.light-yellow-bg {
		background-color: #fff9ee;
		border: 1px solid #ffe1aa;
	}

	.light-green-bg {
		background-color: #f3fbfa;
		border: 1px solid #c4fef7;
	}

	.light-pink-bg {
		background-color: #fff0f4;
		border: 1px solid #ffc9d8;
	}
</style> 
<body>

    <!--*******************
        Preloader start
    ********************-->
         @include("UserPanel/preloader")
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
         @section("userpanel")

            @show()
            
            
             <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">

		<div class="copyright">
            
			<p>Copyright © Shipnick <span id="current-year"></span></p>
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
	<!--<script src="{{asset('newtheme/vendor/apexchart/apexchart.js')}}"></script>-->
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
	
  
	
	<!--<script>-->
	<!--	jQuery(document).ready(function(){-->
	<!--	setTimeout(function(){-->
	<!--		var dezSettingsOptions = {-->
	<!--			typography: "cairo",-->
	<!--			version: "light",-->
	<!--			layout: "vertical",-->
	<!--			primary: "color_10",-->
	<!--			headerBg: "color_1",-->
	<!--			navheaderBg: "color_1",-->
	<!--			sidebarBg: "color_10",-->
	<!--			sidebarStyle: "mini",-->
	<!--			sidebarPosition: "fixed",-->
	<!--			headerPosition: "fixed",-->
	<!--			containerLayout: "wide",-->
	<!--		};-->
	<!--		new dezSettings(dezSettingsOptions);-->
	<!--		jQuery(window).on('resize',function(){-->
	<!--			new dezSettings(dezSettingsOptions);-->
	<!--		})-->
	<!--	},1000)-->
	<!--});-->

	
	<!--</script>-->
	
</body>
</html>