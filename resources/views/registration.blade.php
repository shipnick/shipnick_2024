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
                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center mt-4">
                    <div class="login-form mt-4">
                        <div class="text-center">
                            <h3 class="title">Sign In</h3>
                            <p>Sign in to your account to start using Shipnick account</p>
                        </div>
                        <h6 class="text-center" style="color:red">{{ session('status') }}</h6>
                        <form action="{{ asset('/new-client-registration-added') }}" method="post">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="mb-1 text-dark">Name</label>
                                        <input type="text" class="form-control form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="mb-1 text-dark">Brand Name</label>
                                        <input type="text" name="bname" class="form-control form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">

                                        <label class="mb-1 text-dark">Email</label>
                                        <input type="email" name="email" class="form-control form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="mb-4">
                                <label class="mb-1 text-dark">Contact Number</label>
                                <input type="text" name="mobile" class="form-control form-control" required>
                            </div>
                                </div>
                            </div>



                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="mb-1 text-dark">City</label>
                                        <input type="text" name="cityname" class="form-control form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="mb-1 text-dark">State</label>
                                        <input type="text" name="statename" class="form-control form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="mb-4">
                                <label class="mb-1 text-dark">GSTIN</label>
                                <input type="text" name="gstno" class="form-control form-control" required>
                            </div>
                                </div>
                                <div class="col-md-6">
                                <div class="mb-4">
                                <label class="mb-1 text-dark">PAN</label>
                                <input type="text" class="form-control form-control" name="panno" required>
                            </div>
                                </div>
                            </div>


                            
                            
                            <div class="mb-4">
                                <label class="mb-1 text-dark">Address</label>
                                <textarea class="form-control form-control" name="" id="" cols="10" rows="4" name="address" required></textarea>
                                
                            </div>
                            <div class="mb-4 position-relative">
                                <label class="mb-1 text-dark">Create Password</label>
                                <input type="password" name="createpassword" id="txtNewPassword" class="form-control form-control" required>
                                <span class="show-pass eye">

                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>

                                </span>
                            </div>
                            <div class="mb-4 position-relative">
                                <label class="mb-1 text-dark">Confirm Password</label>
                                <input type="password" name="password" id="txtConfirmPassword" class="form-control form-control" required>
                                <!-- <span class="show-pass eye" required>

                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>

                                </span> -->
                            </div>
                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="mb-4">
                                    <div class="form-check custom-checkbox mb-3">
                                        <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
                                        <label class="form-check-label mt-1" for="customCheckBox1">I accept the terms and conditions</label>
                                    </div>
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
                            <p class="mb-4">Do you have an account? <a href="/login">login</a> </p>
                           
                            

                            <!-- <div class="mb-3">
                                <ul class="d-flex align-self-center justify-content-center">
                                    <li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
                                    <li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
                                    <li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
                                    <li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
                                </ul>
                            </div> -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function checkPasswordMatch() {
            var password = $("#txtNewPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword)
                $("#CheckPasswordMatch").html("Passwords does not match!");
            else
                $("#CheckPasswordMatch").html("Passwords match.");
        }
        $(document).ready(function() {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });
    </script>
    <!-- Required vendors -->
    <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('newtheme/js/custom.min.js')}}"></script>
    <script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>

</body>

</html>