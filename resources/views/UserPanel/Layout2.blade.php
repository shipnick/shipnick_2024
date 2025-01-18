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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Page Title Here -->
    <title>Shipnick</title>



    <link href="{{asset('newtheme/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/blue/pace-theme-minimal.css" />




</head>


                <style>
					.header-new {
						position: fixed;
						/* Change to fixed positioning */
						top: 178px;
						/* Always stick to the top */
						width: 100%;
						/* background-color: white; */
						/* Optional: to ensure it stands out */
						z-index: 1000;
						/* Ensure it stays above other content */
					}
					.button-clor-white{
						background-color: white;
					}
					.hidden {
                                    display: none;
                                }
				</style>

				<script>
					window.addEventListener('scroll', function () {
						var header = document.querySelector('.header-new');
						var scrollPosition = window.scrollY;

						if (scrollPosition > 105) { // Adjust this value as needed
							header.style.position = 'fixed';
							header.style.top = '105px';
						} else {
							header.style.position = 'absolute'; // Or use a value that fits your layout
							header.style.top = '-20px'; // Adjust to match your original design
						}
					});
				</script>
				

<body>


    <!--*******************
        Preloader start
    ********************-->
   
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
        @section("order")

            @show()
    </div>
    <!--**********************************
            Content body end
        ***********************************-->
      

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

    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <!-- Required vendors -->
    <script src="{{asset('newtheme/vendor/global/global.min.js')}}" defer></script>
    <script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}" defer></script>

    <!-- Datatable -->
    <script src="{{asset('newtheme/vendor/datatables/js/jquery.dataTables.min.js')}}" defer></script>
    <script src="{{asset('newtheme/js/plugins-init/datatables.init.js')}}" defer></script>

    <script src="{{asset('newtheme/js/custom.min.js')}}" defer></script>
    <script src="{{asset('newtheme/js/dlabnav-init.js')}}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
    

    <!--<script>-->
    <!--    jQuery(document).ready(function() {-->
    <!--        setTimeout(function() {-->
    <!--            var dezSettingsOptions = {-->
    <!--                typography: "cairo",-->
    <!--                version: "light",-->
    <!--                layout: "vertical",-->
    <!--                primary: "color_10",-->
    <!--                headerBg: "color_1",-->
    <!--                navheaderBg: "color_1",-->
    <!--                sidebarBg: "color_10",-->
    <!--                sidebarStyle: "mini",-->
    <!--                sidebarPosition: "fixed",-->
    <!--                headerPosition: "fixed",-->
    <!--                containerLayout: "wide",-->
    <!--            };-->
    <!--            new dezSettings(dezSettingsOptions);-->
    <!--            jQuery(window).on('resize', function() {-->
    <!--                new dezSettings(dezSettingsOptions);-->
    <!--            })-->
    <!--        }, 100)-->
    <!--    });-->
    <!--</script>-->
    
    
    

   




</body>

</html>