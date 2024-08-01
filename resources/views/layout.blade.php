<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Shipnick</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Shipnick...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-5 d-none d-lg-block">
		<div class="tpHeader">
            <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
            <small class="me-3 text-light">Important Alert: Protect Yourself! Shipnick and our courier partners will never ask for sensitive/financial transactions information or request money via call, SMS, or email. Your security is our top priority. Do not disclose login details or personal data. Stay vigilant and stay safe with Shipnick!</small>
            </marquee>
        </div>
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="mailto:info@shipnick.com"><i class="fa fa-envelope fw-normal"></i></a>
                        <a href="mailto:info@shipnick.com" class="me-3 text-light" ><i></i>info@shipnick.com</a>                    
					</div>    
                </div>
                <div class="col-lg-4 text-right text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="/registration"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Register</small></a>
                        <a href="https://shipnick.com/login"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

       

          @yield('content')

        <!-- Subscribe Start -->
        <div class="container-fluid subscribe py-5">
            <div class="container text-center py-5">
                <div class="mx-auto text-center" style="max-width: 900px;">
                    <h5 class="subscribe-title px-3">Subscribe</h5>
                    <h1 class="text-white mb-4">Subscribe our news letter:</h1>
                    <p class="text-white mb-5">Don't miss out on the latest updates and insights! Subscribe to our newsletter today and take your knowledge and engagement to the next level.</p>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subscribe End -->

        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <a href=""><i class="fas fa-home me-2"></i>Sec-55, Shushant lok, Gurugram, Haryana</a>
                            <a href=""><i class="fas fa-envelope me-2"></i>info@shipnick.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i>+91-1234567890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i>+91-1234567890</a>
                            <!--<div class="d-flex align-items-center">-->
                            <!--    <i class="fas fa-share fa-2x text-white me-2"></i>-->
                            <!--    <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>-->
                            <!--    <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>-->
                            <!--    <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>-->
                            <!--    <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Company</h4>
                            <a href="about"><i class="fas fa-angle-right me-2"></i>About</a>
                            <a href="careers"><i class="fas fa-angle-right me-2"></i>Careers</a>
                            <!--<a href=""><i class="fas fa-angle-right me-2"></i>Blog</a>-->
                            <!--<a href=""><i class="fas fa-angle-right me-2"></i>Press</a>-->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Support</h4>
                            <a href="contact"><i class="fas fa-angle-right me-2"></i> Contact</a>
                            <a href="privacy"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href="terms-and-conditions"><i class="fas fa-angle-right me-2"></i>Terms and Conditions</a>
                            <a href="cookie-policy"><i class="fas fa-angle-right me-2"></i>Cookie policy</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Shipnick.com</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        Developed By <a href="">Shipnick</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

</html>