@if(empty(session('UserLogin2')))
<script type="text/javascript">
	window.location.assign("{{ asset('/AdminLogin') }}");
</script>
@endif
<!--**********************************
            Nav header start
        ***********************************-->
<style>
	.dlabnav {
		width: 15.5rem;
	}

	.nav-header {
		width: 15.5rem;
	}

	.content-body {
		margin-left: 17.563rem;
	}

	.amount-bx {
		background-color: #e5effa !important;
		/* border: 2px solid #b2d7ff !important; */
	}
</style>
<style>
	.dlab-scroll {
		overflow-y: scroll;
	}

	.dlab-scroll {
		overflow-y: scroll;
	}

	body>* {
		scrollbar-width: thin;
		overflow-y: scroll;
		scrollbar-color: rgb(0 0 0 / 41%) rgba(0, 0, 0, 0);
	}

	::-webkit-scrollbar {
		width: 10px;
		opacity: 0;
	}

	/* ::-webkit-scrollbar-thumb{
	background:  rgba(111, 133, 147, 0.0); 
} */
	::-webkit-scrollbar-thumb {
		background: rgb(0 0 0 / 49%);
	}
</style>
<div class="nav-header">
	<a href="{{ asset('/UserPanel') }}" class="brand-logo">
		<h1 class="logo-abbr">SHIPNICK</h1>
		<!--<svg class="logo-abbr" width="53" height="53" viewBox="0 0 53 53">-->
		<!--	<path d="M21.6348 8.04782C21.6348 5.1939 23.9566 2.87204 26.8105 2.87204H28.6018L28.0614 1.37003C27.7576 0.525342 26.9616 0 26.1132 0C25.8781 0 25.639 0.0403711 25.4052 0.125461L7.3052 6.7133C6.22916 7.105 5.67535 8.29574 6.06933 9.37096L7.02571 11.9814H21.6348V8.04782Z" fill="#759DD9" />-->
		<!--	<path d="M26.8105 5.97754C25.6671 5.97754 24.7402 6.90442 24.7402 8.04786V11.9815H42.8555V8.04786C42.8555 6.90442 41.9286 5.97754 40.7852 5.97754H26.8105Z" fill="#F8A961" />-->
		<!--	<path class="svg-logo-primary-path" d="M48.3418 41.8457H41.0957C36.8148 41.8457 33.332 38.3629 33.332 34.082C33.332 29.8011 36.8148 26.3184 41.0957 26.3184H48.3418V19.2275C48.3418 16.9408 46.4879 15.0869 44.2012 15.0869H4.14062C1.85386 15.0869 0 16.9408 0 19.2275V48.8594C0 51.1462 1.85386 53 4.14062 53H44.2012C46.4879 53 48.3418 51.1462 48.3418 48.8594V41.8457Z" fill="#5BCFC5" />-->
		<!--	<path class="svg-logo-primary-path" d="M51.4473 29.4238H41.0957C38.5272 29.4238 36.4375 31.5135 36.4375 34.082C36.4375 36.6506 38.5272 38.7402 41.0957 38.7402H51.4473C52.3034 38.7402 53 38.0437 53 37.1875V30.9766C53 30.1204 52.3034 29.4238 51.4473 29.4238ZM41.0957 35.6348C40.2382 35.6348 39.543 34.9396 39.543 34.082C39.543 33.2245 40.2382 32.5293 41.0957 32.5293C41.9532 32.5293 42.6484 33.2245 42.6484 34.082C42.6484 34.9396 41.9532 35.6348 41.0957 35.6348Z" fill="#5BCFC5" />-->
		<!--</svg>-->
		<!--<svg class="brand-title" width="124px" height="33px">-->
		<!--	<path class="svg-title-path" fill-rule="evenodd" fill="rgb(25, 59, 98)" d="M119.160,20.128 C119.363,20.309 119.602,20.400 119.873,20.400 L123.681,20.400 L123.681,24.820 L118.718,24.820 C117.108,24.820 115.850,24.366 114.944,23.460 C114.037,22.530 113.583,21.284 113.583,19.720 L113.583,11.696 L118.887,11.696 L118.887,19.414 C118.887,19.686 118.978,19.924 119.160,20.128 ZM110.727,11.696 L110.727,7.378 L113.583,7.378 L113.583,11.696 L110.727,11.696 ZM113.583,3.128 L118.887,3.128 L118.887,7.378 L113.583,7.378 L113.583,3.128 ZM123.681,7.378 L123.681,11.696 L118.887,11.696 L118.887,7.378 L123.681,7.378 ZM110.085,17.782 L98.661,17.782 C98.797,18.371 99.058,18.870 99.443,19.278 C99.828,19.686 100.316,19.992 100.905,20.196 C101.494,20.377 102.151,20.468 102.877,20.468 L108.215,20.468 L108.215,24.820 L103.047,24.820 C101.075,24.820 99.341,24.457 97.845,23.732 C96.349,22.984 95.182,21.964 94.343,20.672 C93.527,19.357 93.119,17.839 93.119,16.116 C93.119,14.212 93.516,12.580 94.309,11.220 C95.102,9.860 96.157,8.817 97.471,8.092 C98.808,7.344 100.281,6.970 101.891,6.970 C103.727,6.970 105.257,7.355 106.481,8.126 C107.728,8.897 108.668,9.951 109.303,11.288 C109.937,12.602 110.255,14.110 110.255,15.810 C110.255,16.104 110.232,16.456 110.187,16.864 C110.164,17.249 110.130,17.555 110.085,17.782 ZM104.951,13.430 C104.860,13.090 104.713,12.795 104.509,12.546 C104.328,12.274 104.112,12.047 103.863,11.866 C103.614,11.662 103.319,11.503 102.979,11.390 C102.661,11.276 102.299,11.220 101.891,11.220 C101.370,11.220 100.905,11.310 100.497,11.492 C100.089,11.673 99.749,11.922 99.477,12.240 C99.205,12.534 98.990,12.886 98.831,13.294 C98.695,13.679 98.593,14.076 98.525,14.484 L105.155,14.484 C105.110,14.121 105.041,13.770 104.951,13.430 ZM87.805,24.106 C86.559,24.854 85.108,25.228 83.454,25.228 C82.751,25.228 82.082,25.137 81.448,24.956 C80.835,24.775 80.269,24.514 79.747,24.174 C79.249,23.811 78.829,23.392 78.489,22.916 L78.387,22.916 L78.387,32.198 L73.117,32.198 L73.117,16.422 C73.117,14.518 73.503,12.852 74.274,11.424 C75.044,9.996 76.132,8.897 77.538,8.126 C78.942,7.355 80.586,6.970 82.467,6.970 C83.940,6.970 85.244,7.196 86.377,7.650 C87.533,8.103 88.508,8.760 89.301,9.622 C90.118,10.460 90.740,11.458 91.171,12.614 C91.602,13.770 91.817,15.028 91.817,16.388 C91.817,18.156 91.455,19.697 90.729,21.012 C90.027,22.326 89.052,23.358 87.805,24.106 ZM85.935,13.770 C85.618,13.067 85.165,12.523 84.576,12.138 C83.986,11.730 83.283,11.526 82.467,11.526 C81.651,11.526 80.938,11.730 80.326,12.138 C79.736,12.523 79.282,13.067 78.965,13.770 C78.648,14.450 78.489,15.221 78.489,16.082 C78.489,16.943 78.648,17.714 78.965,18.394 C79.282,19.074 79.736,19.618 80.326,20.026 C80.938,20.411 81.651,20.604 82.467,20.604 C83.283,20.604 83.986,20.411 84.576,20.026 C85.165,19.618 85.618,19.074 85.935,18.394 C86.275,17.714 86.445,16.943 86.445,16.082 C86.445,15.221 86.275,14.450 85.935,13.770 ZM65.039,14.688 C65.039,14.121 64.892,13.611 64.597,13.158 C64.325,12.682 63.951,12.297 63.475,12.002 C62.999,11.707 62.455,11.560 61.843,11.560 C61.231,11.560 60.676,11.707 60.177,12.002 C59.701,12.297 59.327,12.682 59.055,13.158 C58.783,13.611 58.647,14.121 58.647,14.688 L58.647,24.820 L53.377,24.820 L53.377,14.688 C53.377,14.121 53.230,13.611 52.935,13.158 C52.663,12.682 52.278,12.297 51.779,12.002 C51.303,11.707 50.759,11.560 50.147,11.560 C49.535,11.560 48.979,11.707 48.481,12.002 C48.005,12.297 47.631,12.682 47.359,13.158 C47.087,13.611 46.951,14.121 46.951,14.688 L46.951,24.820 L41.681,24.820 L41.681,14.518 C41.681,13.090 42.010,11.809 42.667,10.676 C43.347,9.520 44.311,8.613 45.557,7.956 C46.804,7.299 48.288,6.970 50.011,6.970 C50.873,6.970 51.666,7.072 52.391,7.276 C53.117,7.457 53.774,7.718 54.363,8.058 C54.975,8.375 55.497,8.760 55.927,9.214 L55.995,9.214 C56.448,8.760 56.970,8.375 57.559,8.058 C58.171,7.718 58.840,7.457 59.565,7.276 C60.313,7.072 61.118,6.970 61.979,6.970 C63.702,6.970 65.187,7.299 66.433,7.956 C67.680,8.613 68.643,9.520 69.323,10.676 C70.003,11.809 70.343,13.090 70.343,14.518 L70.343,24.820 L65.039,24.820 L65.039,14.688 ZM34.927,24.038 C33.499,24.831 31.901,25.228 30.133,25.228 C28.343,25.228 26.733,24.831 25.306,24.038 C23.877,23.244 22.744,22.156 21.906,20.774 C21.089,19.391 20.681,17.839 20.681,16.116 C20.681,14.370 21.089,12.818 21.906,11.458 C22.744,10.075 23.877,8.987 25.306,8.194 C26.733,7.378 28.343,6.970 30.133,6.970 C31.924,6.970 33.522,7.378 34.927,8.194 C36.356,8.987 37.478,10.075 38.293,11.458 C39.132,12.818 39.551,14.370 39.551,16.116 C39.551,17.839 39.132,19.391 38.293,20.774 C37.478,22.156 36.356,23.244 34.927,24.038 ZM33.738,13.804 C33.397,13.124 32.921,12.580 32.310,12.172 C31.698,11.764 30.972,11.560 30.133,11.560 C29.295,11.560 28.558,11.764 27.924,12.172 C27.312,12.580 26.835,13.124 26.495,13.804 C26.156,14.484 25.985,15.243 25.985,16.082 C25.985,16.943 26.156,17.714 26.495,18.394 C26.835,19.074 27.312,19.618 27.924,20.026 C28.558,20.434 29.295,20.638 30.133,20.638 C30.972,20.638 31.698,20.434 32.310,20.026 C32.921,19.618 33.397,19.074 33.738,18.394 C34.078,17.714 34.247,16.943 34.247,16.082 C34.247,15.243 34.078,14.484 33.738,13.804 ZM14.280,24.072 C12.875,24.842 11.231,25.228 9.350,25.228 C7.876,25.228 6.561,25.001 5.406,24.548 C4.272,24.094 3.298,23.449 2.482,22.610 C1.689,21.748 1.076,20.740 0.646,19.584 C0.215,18.428 0.000,17.170 0.000,15.810 C0.000,14.042 0.351,12.501 1.054,11.186 C1.779,9.871 2.765,8.840 4.012,8.092 C5.258,7.344 6.709,6.970 8.364,6.970 C9.067,6.970 9.724,7.061 10.336,7.242 C10.971,7.423 11.537,7.695 12.036,8.058 C12.557,8.398 12.988,8.806 13.328,9.282 L13.430,9.282 L13.430,-0.000 L18.700,-0.000 L18.700,15.776 C18.700,17.680 18.314,19.346 17.544,20.774 C16.773,22.202 15.686,23.301 14.280,24.072 ZM12.851,13.804 C12.534,13.124 12.070,12.591 11.458,12.206 C10.869,11.798 10.166,11.594 9.350,11.594 C8.534,11.594 7.831,11.798 7.242,12.206 C6.652,12.591 6.187,13.124 5.848,13.804 C5.530,14.484 5.372,15.254 5.372,16.116 C5.372,16.977 5.530,17.759 5.848,18.462 C6.187,19.142 6.652,19.686 7.242,20.094 C7.831,20.479 8.534,20.672 9.350,20.672 C10.166,20.672 10.869,20.479 11.458,20.094 C12.070,19.686 12.534,19.142 12.851,18.462 C13.169,17.759 13.328,16.977 13.328,16.116 C13.328,15.254 13.169,14.484 12.851,13.804 Z" />-->
		<!--</svg>-->
	</a>
	<div class="nav-control">
		<div class="hamburger">
			<span class="line"></span><span class="line"></span><span class="line"></span>
		</div>
	</div>
</div>
<!--**********************************
            Nav header end
        ***********************************-->



<!--**********************************
            Header start
        ***********************************-->
<div class="header">
	<div class="header-content">
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				<div class="header-left">
					<div class="dashboard_bar">
						<!--<span class="font-w600 ">Hi,<b>{{ session('UserLogin2name') }}</b></span>-->
						<small class="text-end font-w400">Hi, {{ session('UserLogin2name') }}</small>
						<p class="font-w200 " style="font-size:18px">{{ \Carbon\Carbon::now()->format('l, F jS Y') }}</p>

					</div>
				</div>
				<ul class="navbar-nav header-right">
					<li class="nav-item">
						<button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#add_tax">

							Add Balance
						</button>
					</li>
					<!--<li class="nav-item dropdown notification_dropdown">-->
					<!--	<a class="nav-link bell dz-theme-mode p-0" href="javascript:void(0);">-->
					<!--		<i id="icon-light" class="fas fa-sun"></i>-->
					<!--		<i id="icon-dark" class="fas fa-moon"></i>-->

					<!--	</a>-->
					<!--</li>-->
					<!--<li class="nav-item dropdown notification_dropdown">-->
					<!--	<a class="nav-link" href="{{ asset('/UserPanel') }}">-->
					<!--		<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">-->
					<!--			<path d="M3.88552 6.2921C1.95571 6.54135 0.439911 8.19656 0.439911 10.1896V10.7253C0.439911 12.8874 2.21812 14.6725 4.38019 14.6725H12.7058V24.9768H7.01104C5.77451 24.9768 4.82009 24.0223 4.82009 22.7858V18.4039C4.84523 16.6262 2.16581 16.6262 2.19096 18.4039V22.7858C2.19096 25.4334 4.36345 27.6059 7.01104 27.6059H21.0331C23.6807 27.6059 25.8532 25.4334 25.8532 22.7858V13.9981C26.9064 13.286 27.6042 12.0802 27.6042 10.7253V10.1896C27.6042 8.17115 26.0501 6.50077 24.085 6.28526C24.0053 0.424609 17.6008 -1.28785 13.9827 2.48534C10.3936 -1.60185 3.7545 1.06979 3.88552 6.2921ZM12.7058 5.68103C12.7058 5.86287 12.7033 6.0541 12.7058 6.24246H6.50609C6.55988 2.31413 11.988 1.90765 12.7058 5.68103ZM21.4559 6.24246H15.3383C15.3405 6.05824 15.3538 5.87664 15.3383 5.69473C15.9325 2.04532 21.3535 2.18829 21.4559 6.24246ZM4.38019 8.87502H12.7058V12.0382H4.38019C3.62918 12.0382 3.06562 11.4764 3.06562 10.7253V10.1896C3.06562 9.43859 3.6292 8.87502 4.38019 8.87502ZM15.3383 8.87502H23.6656C24.4166 8.87502 24.9785 9.43859 24.9785 10.1896V10.7253C24.9785 11.4764 24.4167 12.0382 23.6656 12.0382H15.3383V8.87502ZM15.3383 14.6725H23.224V22.7858C23.224 24.0223 22.2696 24.9768 21.0331 24.9768H15.3383V14.6725Z" fill="#4f7086" />-->
					<!--		</svg>-->
					<!--		<span class="badge light text-white bg-primary rounded-circle">2</span>-->
					<!--	</a>-->

					<!--</li>-->


				</ul>
			</div>

			<div class="card-body pb-3 transaction-details d-flex flex-wrap justify-content-between align-items-center">
				<?php

				use App\Models\orderdetail;

				$userid = session()->get('UserLogin2id');
				$articles = orderdetail::where('user_id', $userid)->orderby('orderid', 'DESC')->first();
				?>

				<div class="amount-bx mb-3">
					<i class="fas fa-inr" style="    background: #17a2b8;
					"></i>
					<div>
						<p class="mb-1">Wallet Amount</p>
						<h3 class="mb-0">@if($articles) {{$articles->close_blance}} @endif</h3>
					</div>
				</div>

			</div>
		</nav>
	</div>
</div>

<div id="add_tax" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Money</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
			</div>
			<!-- <form class="contribution-form" id="contribution-form" method="POST" enctype="multipart/form-data" action="{{url('make-order')}}">@csrf -->

			<div class="text-center">
				<div class="row my-4">
					<div class="col-md-3 my-1">
						<p><strong>Amount</strong></p>
					</div>
					<div class="col-md-6">
						<input type="text" placeholder="₹" class="form-control" style="border-color:#33333373;border-radius:20px" value="500" name="amount" required="" id="plan">
						<!-- @error('amount') <font color="red">{{$massage}}</font> @enderror() -->
					</div>
					<div class="col-md-3"></div>
				</div>
				<!-- <div class="text-center my-3">
                                                    <a href="#" class="btn btn-success badge">500</a>
                                                    <a href="#" class="btn btn-success badge">1000</a>
                                                    <a href="#" class="btn btn-success badge">2000</a>
                                                    <a href="#" class="btn btn-success badge">5000</a>
                                                </div> -->
				<button class="btn btn-primary badge pay_now" type="button">Recharge</button>
			</div>
			<!-- </form> -->
			<br><br>

		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
	$(document).ready(function() {
		$(document).on("click", ".pay_now", function() {
			var plan = $('#plan').val(); // Get the value of the input field

			if (plan !== '') {
				$.ajax({
					url: "{{ url('make-order1') }}", // Ensure this URL is correct
					type: 'POST',
					data: {
						'_token': '{{ csrf_token() }}',
						'plan_id': plan
					},
					success: function(res) {
						try {
							payNow(res.amount, res.rzp_order);
							// Try parsing JSON response if needed
							// var response = JSON.parse(res);
							// console.log('Response:', response);
							// alert('Success: ' + response.message); // Adjust based on your response
						} catch (e) {
							console.log('Invalid JSON response:', res);
							alert('Success, but unable to parse response.');
						}
					},
					error: function(xhr, status, error) {
						console.log('Error:', status, error);
						alert('An error occurred: ' + xhr.responseText);
					}
				});
			} else {
				alert('Please enter an amount.');
			}
		});

		function payNow(amount, rzp_order) {
			var options = {
				"key": "{{env('rzr_key')}}", // Enter the Key ID generated from the Dashboard
				"amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
				"currency": "INR",
				"name": "Shipnick", //your business name
				"description": "Wallet Transaction",
				"image": "https://shipnick.com/images/shiplogo.jpeg",
				"order_id": rzp_order, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
				"callback_url": "{{url('succes-payment')}}",
				"prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
					"name": "{{ session('UserLogin2name') }}", //your customer's name
					"email": "",
					"contact": "9000090000" //Provide the customer's phone number for better conversion rates 
				},
				"notes": {
					"address": "Razorpay Corporate Office"
				},
				"theme": {
					"color": "#3399cc"
				}
			};
			var rzp1 = new Razorpay(options);
			{
				rzp1.open();

			}
		}
	});
</script>

<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
	<div class="dlabnav-scroll">
		<ul class="metismenu" id="menu">
			<li class="dropdown header-profile">
				<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
					<img src="{{asset('/Profiles/')}}/{{ session('UserLoginPic') }}" width="20" alt="">
					<div class="header-info ms-3">
						<span class="font-w600 ">Hi,<b>{{ session('UserLogin2name') }}</b></span>
						<!--<small class="text-end font-w400">{{ session('UserLogin2name') }}</small>-->
					</div>
				</a>

			</li>

			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-025-dashboard"></i>
					<span class="nav-text">Dashboard</span>
				</a>
				<ul aria-expanded="false">

					<li><a href="{{ asset('/UserPanel') }}">Dashboard</a></li>


				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-043-menu"></i>
					<span class="nav-text">Orders</span></a>
				<ul aria-expanded="false">
					<li><a href="{{ asset('/UPBulk_Order') }}">Create order</a></li>
					<li><a href="{{asset('/booked-order')}}">Shipment</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-022-copy"></i>
					<span class="nav-text">Reports</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{asset('/UPMIS_Report')}}">MIS</a></li>
					<!--<li><a href="{{asset('/page-error-503')}}">Menifest<span class="badge badge-xs badge-success ms-3">Update</span></a></li>-->
					<li><a href="#">NDR</a></li>
					<li><a href="{{ asset('/showordercounts') }}">Courier Insight</a></li>
					<li><a href="{{asset('/sku_summary')}}">SKU Wise Summary </a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="fa-solid fa-house fw-bold"></i>
					<span class="nav-text">Hub</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{ asset('/UPNew_Hub') }}">Add a hub</a></li>
					<li><a href="{{ asset('/UPAll_Hubs') }}">All hub</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="mdi mdi-file-document-box font-18 align-middle me-2"></i>
					<span class="nav-text">Billing</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{ asset('/Wallet') }}">Billing</a></li>
					<!-- <li><a href="{{ asset('/UPAll_Hubs') }}">All hub</a></li> -->
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-072-printer"></i>
					<span class="nav-text">Print</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{ asset('/Label_Print') }}">Print shipping label</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-locations"></i>
					<span class="nav-text">Location</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="#">Order Tracking</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="fa-solid fa-gear fw-bold"></i>
					<span class="nav-text">Settings</span>
					<!-- <span class="badge badge-xs badge-danger ms-3">New</span> -->
				</a>
				<ul aria-expanded="false">
					<li><a href="{{ asset('/setting') }}">Setting</a></li>

				</ul>

			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<i class="flaticon-381-turn-off"></i>
					<span class="nav-text">Power</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="{{ asset('/Logout') }}">Sign out</a></li>
				</ul>
			</li>
		</ul>
		<div class="copyright">
			<!-- <p><strong>Shipnick</strong> © 2023 All Rights Reserved</p>
			<p class="fs-12">Made with <span class="heart"></span> by Philon Technologies Pvt. Ltd.</p> -->
		</div>
	</div>
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
</div>

<!--**********************************
            Sidebar end
        ***********************************-->