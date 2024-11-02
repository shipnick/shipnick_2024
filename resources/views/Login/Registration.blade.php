@if(!empty(session('UserLogin')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminPanel') }}");
    </script>
@endif
@php(error_reporting(1))



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Shipnick Logistic Registration</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body>

<div class="main-wrapper login-body">
<div class="login-wrapper">
<div class="container">
<img class="img-fluid logo-dark mb-2" src="assets/img/logo.png" alt="Logo" style="width:40px;margin-bottom:-20px !important;">
<div class="loginbox">
<div class="login-right">
<div class="login-right-wrap">
<h1>Registration</h1>

    <h6 class="text-center" style="color:red">{{ session('status') }}</h6>


<form action="{{ asset('/NewClientRegistrationAdd') }}" method="POST">
<div class="form-group">
	<label class="form-control-label">Name</label>
	<input type="text" name="name" class="form-control">
</div>
<div class="form-group">
	<label class="form-control-label">Email</label>
	<input type="email" name="email" class="form-control">
</div>

<div class="form-group">
	<label class="form-control-label">Mobile</label>
	<input type="number" name="mobile" class="form-control">
</div>
<div class="form-group">
	<label class="form-control-label">Password</label>
	<div class="pass-group">
		<input type="password" name="password" class="form-control pass-input">
		<span class="fas fa-eye toggle-password"></span>
	</div>
</div>
@csrf
<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Registration Now</button>
<div class="login-or">
<span class="or-line"></span>
<span class="span-or">or</span>
</div>
</form>
<div class="text-center dont-have">Already Have a Account.<a href="{{ asset('/AdminPanel') }}"> Login </a>Now.</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/script.js"></script>
</body>


</html>
