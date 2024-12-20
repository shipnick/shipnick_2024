<!DOCTYPE html>
<html lang="en">

<head>

	<title>SuperAdmin-Panel</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="{{asset('assets/super-admin/assets/css/style.css')}}">
	
	


</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="/ShipnickTrans.png" alt="Shipnick.com" title="Shipnick" class="img-fluid mb-4" style="max-height: 100px;">
        {{-- <h1 style="background: linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet); -webkit-background-clip: text; color: transparent;">SHIPNICK</h1> --}}

		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<form class="card-body" action="{{ asset('/superlogin') }}" method="POST">@csrf
						<h4 class="mb-3 f-w-400">Super Login</h4>
						<hr>
						<div class="form-group mb-3">
							<input type="text" class="form-control" name="email" id="Email" placeholder="Email address">
						</div>
						<div class="form-group mb-4">
							<input type="password" name="pass" class="form-control" id="Password" placeholder="Password">
						</div>
						<!-- <div class="custom-control custom-checkbox text-left mb-4 mt-2">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Save credentials.</label>
						</div> -->
						<button class="btn btn-block btn-primary mb-4">Signin</button>
						<hr>
						
					</form >
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="{{asset('assets/super-admin/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('assets/super-admin/assets/js/plugins/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/super-admin/assets/js/pcoded.min.js')}}"></script>



</body>

</html>
