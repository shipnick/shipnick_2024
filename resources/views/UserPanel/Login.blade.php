@if(!empty(session('UserLogin')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminPanel') }}");
    </script>
@endif



<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Artu Logistic Login</title>

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
<img class="img-fluid logo-dark mb-2" src="assets/img/logo1.png" alt="Logo">
<div class="loginbox">
<div class="login-right">
<div class="login-right-wrap">
<h1>Login</h1>
<p class="account-subtitle">Access to our dashboard</p>
<h6 class="text-center" style="color:red">{{ session('status') }}</h6>
<form action="{{ asset('/AdminLogin') }}" method="POST">
<div class="form-group">
<label class="form-control-label">Username</label>
<input type="text" name="email" class="form-control">
</div>
<div class="form-group">
<label class="form-control-label">Password</label>
<div class="pass-group">
<input type="password" name="pass" class="form-control pass-input">
<span class="fas fa-eye toggle-password"></span>
</div>
</div>
<!-- <div class="form-group">
<div class="row">
<div class="col-6">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="cb1">
<label class="custom-control-label" for="cb1">Remember me</label>
</div>
</div>
<div class="col-6 text-end">
<a class="forgot-link" href="">Forgot Password ?</a>
</div>
</div>
</div> -->
@csrf
<button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>
<div class="login-or">
<span class="or-line"></span>
<span class="span-or">or</span>
</div>



<div class="text-center dont-have">Don't have an account yet? <a href="{{ asset('/AdminPanelRegistration') }}">Register</a></div>
</form>
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











