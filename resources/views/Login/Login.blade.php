<!DOCTYPE html>
<html lang="en" class="h-100">

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

  <!-- Page Title Here -->
  <title>Shipnick</title>



  <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
  <div class="authincation h-100">
    <div class="container-fluid h-100">
      <div class="row h-100">
        <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
          <div class="login-form">
            <div class="text-center">
              <h3 class="title">Sign In</h3>
              <p>Sign in to your account to start using Shipnick account</p>
            </div>
             <h6 class="text-center" style="color:red">{{ session('status') }}</h6>
            <form action="{{ asset('/AdminLogin') }}" method="post">
              <div class="mb-4">
                <label class="mb-1 text-dark">Email</label>
                <input type="email" name="email" class="form-control form-control" >
              </div>
              <div class="mb-4 position-relative">
                <label class="mb-1 text-dark">Password</label>
                <input type="password" name="pass" id="dlab-password" class="form-control form-control" >
                <span class="show-pass eye">

                  <i class="fa fa-eye-slash"></i>
                  <i class="fa fa-eye"></i>

                </span>
              </div>
              <div class="form-row d-flex justify-content-between mt-4 mb-2">
                <div class="mb-4">
                  <!--<div class="form-check custom-checkbox mb-3">-->
                  <!--  <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">-->
                  <!--  <label class="form-check-label mt-1" for="customCheckBox1">Remember my preference</label>-->
                  <!--</div>-->
                </div>
               
                <div class="mb-4">
                  <!--<a href="page-forgot-password.html" class="btn-link text-primary">Forgot Password?</a>-->
                </div>
              </div>
              <div class="text-center mb-4">
              @csrf
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <h6 class="text-center"><span>Or continue with</span></h6>
                            <p class="mb-4">Don't have an account?  <a href="registration">Create Account</a> </p>
              <!--<p class="text-center">Not registered?-->
              <!--  <a class="btn-link text-primary" href="page-register.html">Register</a>-->
              </p>
            </form>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6">
          <div class="pages-left h-100">
            <div class="login-content">
              <a href="index.html"><img src="images/logo-full.png" class="mb-3" alt=""></a>

              <p>Your true value is determined by how much more you give in value than you take in payment. ...</p>
            </div>
            <div class="login-media text-center">
              <img src="{{asset('newtheme/images/login.png')}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>
  <script src="{{asset('newtheme/js/custom.min.js')}}"></script>
  <script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>

</body>

</html>