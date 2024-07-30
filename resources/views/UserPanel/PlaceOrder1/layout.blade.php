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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Page Title Here -->
    <title>Shipnick</title>



    <link href="{{asset('newtheme/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">




</head>

<!-- Include a newer version of jQuery -->
<!-- <script>
    async function performBackgroundRequest(url) {
        try {
            const response = await fetch(url, {
                method: 'GET'
            });
            // Handle the response if needed
        } catch (error) {
            console.error('Error performing background URL hit:', error);
        }
    }

    // Perform background URL hits asynchronously
    performBackgroundRequest('https://shipnick.com/order-update-ecom');
    performBackgroundRequest('https://shipnick.com/order-update-ecom');
    performBackgroundRequest('https://shipnick.com/order-update-ecom');
    performBackgroundRequest('https://shipnick.com/order-update-intransit-ecom');
    performBackgroundRequest('https://shipnick.com/order-update-ofd-ecom');
</script> -->

<!-- Load jQuery in noConflict mode -->
<!-- Include jQuery -->




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
            @if(session()->has('message'))
            <div class="alert alert-success left-icon-big alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                </button>
                <div class="media">
                    <div class="alert-left-icon-big">
                        <span><i class="mdi mdi-check-circle-outline"></i></span>
                    </div>
                    <div class="media-body">
                        <h5 class="mt-1 mb-2">successfully</h5>
                        <p class="mb-0">{{ session()->get('message') }}</p>
                    </div>
                </div>
            </div>

            @endif
            <!-- row -->
            @section("order")

            @show()
            
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->
<script>
					document.getElementById('downloadExcelBtn').addEventListener('click', function(event) {
						event.preventDefault(); // Prevent the default form submission
						document.getElementById('downloadExcelForm').submit(); // Submit the form manually
					});
				</script>
				<script>
					document.getElementById('downloadExcelBtn').addEventListener('click', function() {
						var cfromdate = "{{ $cfromdate }}";
						var ctodate = "{{ $ctodate }}";
						var ftype = "Excel";

						var url = "{{ asset('/today-placed-orders') }}";
						url += "?cfromdate=" + encodeURIComponent(cfromdate);
						url += "&ctodate=" + encodeURIComponent(ctodate);
						url += "&ftype=" + encodeURIComponent(ftype);

						window.location.href = url;
					});
				</script>
				<script>
					function toggle(source) {
						var checkboxes = document.querySelectorAll('input[type="checkbox"]');
						for (var i = 0; i < checkboxes.length; i++) {
							if (checkboxes[i] != source)
								checkboxes[i].checked = source.checked;
						}
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
    <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

    <!-- Datatable -->
    <script src="{{asset('newtheme/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('newtheme/js/plugins-init/datatables.init.js')}}"></script>

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
            }, 100)
        });
    </script>






</body>

</html>