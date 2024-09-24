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
<script>
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
    performBackgroundRequest('https://shipnick.com/UPBulk_Order_API');
    performBackgroundRequest('https://shipnick.com/UPBulk_Order_API');
    performBackgroundRequest('https://shipnick.com/UPBulk_Order_API');
    performBackgroundRequest('https://shipnick.com/UPBulk_Order_API');
    performBackgroundRequest('https://shipnick.com/UPBulk_Order_API');
</script>

<!-- Load jQuery in noConflict mode -->
<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        fetchOrders("UPAll_All_Orders", "#allordersshows");
        fetchOrders("UPAll_Pending_Orders", "#Pendingordersshows");
        fetchOrders("UPAll_Canceled_Orders", "#canceledordersshows");
        fetchOrders("UPAll_Orders", "#deliveredordersshows");
        fetchOrders("UPAll_Cancel_Orders", "#rtoordersshows");
        fetchOrders("UPAll_Uploaded_Orders", "#notpickedordersshows");
        fetchOrders("failed-orders", "#failedordersshows");
        fetchOrders("ofd-orders", "#Ofdordersshows");
        fetchOrders("Transit-orders", "#Transitordersshows");
    });

    function fetchOrders(url, target) {
        $.ajax({
            type: "GET",
            url: "{{ asset('/') }}" + url,
            data: {
                crtpage: 'Cancelled'
            },
            success: function(data) {
                $(target).html(data);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$(".button").click(function() {
			$(".p").toggle();
		});
	});
</script>
 <script>
        // Perform background URL hit asynchronously
        fetch('https://shipnick.com/order-update-ecom', {
            method: 'GET'
        })
        .then(response => {
            // Handle the response if needed
        })
        .catch(error => {
            console.error('Error performing background URL hit:', error);
        });
        </script>
         <script>
        // Perform background URL hit asynchronously
        fetch('https://shipnick.com/UPBulk_Order_API121', {
            method: 'GET'
        })
        .then(response => {
            // Handle the response if needed
        })
        .catch(error => {
            console.error('Error performing background URL hit:', error);
        });
        </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        function setupPagination(containerId, paginationId, apiUrl) {
            var $allOrdersContainer = $('#' + containerId); // Cache the jQuery object

            $(document).on('click', '#' + paginationId + ' a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                $.get(apiUrl + "?page=" + page, function(data) {
                    $allOrdersContainer.html(data);
                }).fail(function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                    // You can add error handling here, such as displaying an error message to the user
                });
            }
        }

        // Setup pagination for different containers
        setupPagination('allordersshows', 'newpaginationnew', 'UPAll_All_Orders');
        setupPagination('Transitordersshows', 'newpaginationnew1', 'Transit-orders');
        setupPagination('deliveredordersshows', 'newpaginationnew2', 'UPAll_Orders');
        setupPagination('rtoordersshows', 'newpaginationnew3', 'UPAll_Cancel_Orders');
        setupPagination('canceledordersshows', 'newpaginationnew4', 'UPAll_Canceled_Orders');
        setupPagination('failedordersshows', 'newpaginationnew5', 'failed-orders');
        setupPagination('Ofdordersshows', 'newpaginationnew6', 'ofd-orders');
        setupPagination('Pendingordersshows', 'newpaginationnew7', 'UPAll_Pending_Orders');
    });
</script>


<body>
<!-- <style>
	.btn-outline-primary {
    color: var(--primary);
    background-color: transparent;
    background-image: none;
    border-color: var(--primary);
}

</style> -->

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
			<div class="container-fluid">
				<div class="d-flex flex-wrap align-items-center mb-3">
					<div class="mb-3 me-auto">
						<div class="card-tabs style-1 mt-3 mt-sm-0">

							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="javascript:void(0);" data-bs-toggle="tab" id="booked-tab" data-bs-target="#booked" role="tab">Booked ({{$booked}})</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Pending-tab" data-bs-target="#Pending" role="tab">Pick-up Pending ({{$pending_pickup}})</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="In-Transit-tab" data-bs-target="#In-Transit" role="tab">In Transit ({{$in_transit}})</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="ofd-tab" data-bs-target="#ofd" role="tab">OFD ({{$ofd}})</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Delivered-tab" data-bs-target="#Delivered" role="tab">Delivered ({{$deliver}})</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="RTO-tab" data-bs-target="#RTO" role="tab">RTO/RTS ({{$rto}})</a>
								</li>
							

								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Canceled-tab" data-bs-target="#Cancelled" role="tab">Cancelled ({{$cancel}})</a>
								</li>


								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Failed-tab" data-bs-target="#Failed" role="tab">Failed ({{$failde}})</a>
								</li>
							</ul>
						</div>
					</div>
					<style>
						#hidden_div {
							display: none;
						}
					</style>
					<div class="form-group">
					<button class="button btn btn-outline-primary btn-sm" >Date Range</button>
					</div>
					<script>
						function showDiv(divId, element) {
							document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
						}
					</script>
				</div>
				<style>
					table.dataTable tbody td {

						padding: 0px 0px;
						font-weight: 600;
						border-bottom: 0;
					}
				</style>
				<div class="row">
					<div class="col-xl-12 tab-content">
						<div class="tab-pane fade show active" id="booked" role="tabpanel" aria-labelledby="booked-tab">
							<div id="allordersshows">

							</div>

						</div>

						<div class="tab-pane fade" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
							<div id="Pendingordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
						<div class="tab-pane fade" id="In-Transit" role="tabpanel" aria-labelledby="In-Transit-tab">
							<div id="Transitordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
						<div class="tab-pane fade" id="ofd" role="tabpanel" aria-labelledby="ofd-tab">
							<div id="Ofdordersshows">
								<h6>Loading...</h6>
							</div>

						</div>

						<div class="tab-pane fade" id="Delivered" role="tabpanel" aria-labelledby="Delivered-tab">
							<div id="deliveredordersshows">

							</div>
						</div>
						<div class="tab-pane fade" id="RTO" role="tabpanel" aria-labelledby="RTO-tab">
							<div id="rtoordersshows">

							</div>
						</div>
						<div class="tab-pane fade" id="Cancelled" role="tabpanel" aria-labelledby="Cancelled-tab">
							<div id="canceledordersshows">

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

