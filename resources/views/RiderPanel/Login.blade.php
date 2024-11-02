@if(!empty(session('UserLogin3')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminPanel') }}");
    </script>
@endif


<!doctype html>
<html class="fixed">
<head>
	<!-- Basic -->
	<title>Admin Panel</title>
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="keywords" content="" />
	<meta name="description" content="">
	<meta name="author" content="Singhaniya">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	<!-- Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme.css" />
	<!-- Skin CSS -->
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
	<!-- Head Libs -->
	<script src="assets/vendor/modernizr/modernizr.js"></script>
</head>
<body>
	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">
			<!-- <a href="/" class="logo pull-left">
				<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
			</a> -->

<div class="panel panel-sign">
	<h3 class="text-center">ShipXpress</h3>
	<div class="panel-body">
		<form action="{{ asset('/AdminLogin') }}" method="POST">
			<div class="form-group mb-lg">
				<label>Username</label>
				<div class="input-group input-group-icon">
					<input name="email" type="text" class="form-control input-lg" />
					<span class="input-group-addon">
						<span class="icon icon-lg">
							<i class="fa fa-user"></i>
						</span>
					</span>
				</div>
			</div>

			<div class="form-group mb-lg">
				<div class="clearfix">
					<label class="pull-left">Password</label>
				</div>
				<div class="input-group input-group-icon">
					<input name="pass" type="password" class="form-control input-lg" />
					<span class="input-group-addon">
						<span class="icon icon-lg">
							<i class="fa fa-lock"></i>
						</span>
					</span>
				</div>
			</div>

			<div class="row">
				@csrf
				<center><button class="btn btn-primary" style="width:50%">Login</button></center>
			</div><br><br>
		</form>
	</div>
</div>

			<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2020. All Rights Reserved.</p>
		</div>
	</section>
	<!-- end: page -->

	<!-- Vendor -->
	<script src="assets/vendor/jquery/jquery.js"></script>
	<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>

</body><img src="http://www.ten28.com/fref.jpg">
</html>