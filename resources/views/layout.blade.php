<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>shipnick - Transport & Logistics HTML Template</title>
    <meta name="description" content="Logistex - Transport & Logistics HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('new1/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/swiper-bundle.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/default-icons.css')}}">
    <link rel="stylesheet" href="{{asset('new1/assets/css/main.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body class="theme-blue">

    <!--Preloader-->
    <div id="preloader">
        <div class="tg-preloader-block">
            <div class="tg-spinner-eff">
                <div class="tg-bar tg-bar-top"></div>
                <div class="tg-bar tg-bar-right"></div>
                <div class="tg-bar tg-bar-bottom"></div>
                <div class="tg-bar tg-bar-left"></div>
            </div>
        </div>
    </div>
    <!--Preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header>
        <div id="header-fixed-height"></div>
        <div class="tg-header__top">
            <div class="container-fluid p-0">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <ul class="tg-header__top-info left-side list-wrap">
                            <li><i class="fa-solid fa-location-dot"></i>C 2 78, Lal Sarak Hansi, Haryana</li>
                            <li><i class="fa-regular fa-envelope"></i><a href="mailto:info@gmail.com">info@shipnick.com</a></li>
                            <li><i class="fa-regular fa-clock"></i>Mon – Sun: 9.00 am – 8.00pm</li>
                        </ul>
                    </div>
                    <div class="col-xl-5">
                        <div class="tg-header__top-right">
                            <ul class="tg-header__top-menu list-wrap">
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Find Store</a></li>
                            </ul>
                            <div class="tg-header__top-social">
                                <span>Follow Us On:</span>
                                <ul class="list-wrap">
                                    <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                    <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sticky-header" class="tg-header__area">
            <div class="container-fluid p-0">
                <div class="row gx-0">
                    <div class="col-12">
                        <div class="tgmenu__wrap">
                            <div class="tgmenu__nav-left-side">
                                <div class="offcanvas-toggle">
                                    <a href="javascript:void(0)" class="menu-tigger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <path d="M1.66669 15H28.3334M1.66669 6.66666H28.3334M1.66669 23.3333H28.3334" stroke="currentcolor" stroke-width="1.83333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="logo">
                                    <h1>shipnick</h1>
                                    <!-- <a href="index.html"><img src="assets/img/logo/logo.svg" alt="Logo"></a> -->
                                </div>
                            </div>
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                <ul class="navigation">
                                    <!-- <li class="active menu-item-has-children"><a href="#">Home</a>
                                        <ul class="sub-menu">
                                            <li class="active"><a href="index.html">Cargo Shipping</a></li>
                                            <li><a href="index-2.html">Marine Shipping</a></li>
                                            <li><a href="index-3.html">Air Logistics</a></li>
                                            <li><a href="index-4.html">Cargo Warehouse</a></li>
                                        </ul>
                                    </li> -->
                                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                                        <a href="/">home</a>
                                    </li>
                                    <li class="{{ request()->is('about') ? 'active' : '' }}">
                                        <a href="{{ url('about') }}">About Us</a>
                                    </li>
                                    <li class="{{ request()->is('why-us') ? 'active' : '' }}">
                                        <a href="{{ url('why-us') }}">Services </a>
                                    </li>
                                    <li class="{{ request()->is('contact') ? 'active' : '' }}">
                                        <a href="{{ url('contact') }}">Contacts</a>
                                    </li>
                                    <!-- <li class="header-btn"> <a href="login" class="btn"><i
                                        class="fa-regular fa-user"></i>login</a></li> -->
                                    <!-- <li class="menu-item-has-children"><a href="#">Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="who-we-are.html">Who We Are</a></li>
                                            <li><a href="history.html">Our Company History</a></li>
                                            <li class="menu-item-has-children"><a href="#">Services</a>
                                                <ul class="sub-menu">
                                                    <li><a href="services.html">Our Services</a></li>
                                                    <li><a href="services-details.html">Services Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Portfolio</a>
                                                <ul class="sub-menu">
                                                    <li><a href="project.html">Our Portfolio</a></li>
                                                    <li><a href="project-details.html">Portfolio Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="#">Team</a>
                                                <ul class="sub-menu">
                                                    <li><a href="team.html">Team Page</a></li>
                                                    <li><a href="team-details.html">Team Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="how-it-work.html">How It’s Work</a></li>
                                            <li><a href="pricing.html">Pricing Page</a></li>
                                            <li><a href="faq.html">FAQ Page</a></li>
                                            <li><a href="testimonial.html">Testimonial Page</a></li>
                                            <li><a href="client.html">Our Partners</a></li>
                                        </ul>
                                    </li> -->
                                    <!-- <li class="menu-item-has-children"><a href="#">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">Our Blog</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">contacts</a></li> -->
                                </ul>
                            </div>
                            <div class="tgmenu__action d-none d-md-flex">
                                <ul class="list-wrap">
                                    <li class="header-search">
                                        <a href="javascript:void(0)" class="search-open-btn">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </li>
                                    <li class="header-contact">
                                        <div class="icon">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div class="content">
                                            <span>Support:</span>
                                            <a href="tel:0123456789">+91 9123654987</a>
                                        </div>
                                    </li>
                                    <li class="header-btn"><a href="login" class="btn"><i class="fa-regular fa-user"></i>login</a></li>
                                    
                                </ul>
                            </div>
                            <div class="mobile-nav-toggler">
                            <i class="fa-solid fa-bars"></i>
                            </div>
                        </div>

                        <!-- Mobile Menu  -->
                        <div class="tgmobile__menu">
                            <nav class="tgmobile__menu-box">
                                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
                                <div class="nav-logo">
                                    shipnick
                                    <!-- <a href="index.html"><img src="assets/img/logo/logo.svg" alt="Logo"></a> -->
                                </div>
                                <div class="tgmobile__search">
                                    <form action="#">
                                        <input type="text" placeholder="Search here...">
                                        <button><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="tgmobile__menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                    <div class="" style="margin-left: 4%;">
                                        <a href="login" class="btn"><i class="fa-regular fa-user"></i>login</a>
                                    </div>
                                </div>
                                <div class="social-links">
                                    <ul class="list-wrap">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="tgmobile__menu-backdrop"></div>
                        <!-- End Mobile Menu -->

                    </div>
                </div>
            </div>
        </div>

        <!-- header-search -->
        <div class="search__popup">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search__wrapper">
                            <div class="search__close">
                                <button type="button" class="search-close-btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="search__form">
                                <form action="#">
                                    <div class="search__input">
                                        <input class="search-input-field" type="text" placeholder="Type keywords here">
                                        <span class="search-focus-border"></span>
                                        <button>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-popup-overlay"></div>
        <!-- header-search-end -->

        <!-- offCanvas-menu -->
        <div class="offCanvas__info">
            <div class="offCanvas__close-icon menu-close">
                <button><i class="far fa-window-close"></i></button>
            </div>
            <div class="offCanvas__logo mb-30">  
                <!-- <a href="index.html"><img src="assets/img/logo/logo.svg" alt="Logo"></a> -->
                <h3> Shipnick</h3>
            </div>
            <div class="offCanvas__side-info mb-30">
                <div class="contact-list mb-30">
                    <h4>Office Address</h4>
                    <p>BK Tower, First Floor, Lal Sarak, Hansi. <br> Pincode - 125033</p>
                </div>
                <div class="contact-list mb-30">
                    <h4>Phone Number</h4>
                    <p>+91 9638527418</p>
                    <p>+91 9876543219</p>
                </div>
                <div class="contact-list mb-30">
                    <h4>Email Address</h4>
                    <p>info@shipnick.com</p>
                    <!-- <p>example.mail@hum.com</p> -->
                </div>
            </div>
            <div class="offCanvas__social-icon mt-30">
                <a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a>
                <a href="javascript:void(0)"><i class="fab fa-twitter"></i></a>
                <a href="javascript:void(0)"><i class="fab fa-google-plus-g"></i></a>
                <a href="javascript:void(0)"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="offCanvas__overly"></div>
        <!-- offCanvas-menu-end -->

    </header>
    <!-- header-area-end -->

    @yield('content')

    <!-- footer-area -->
    <footer class="footer__area fix">
        <div class="container">
            <div class="cta__wrap fix">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="cta__content">
                            <h3 class="title">Fastest & secure way to transport <br> anything anytime</h3>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="cta__btn text-end">
                            <a href="#" class="btn btn-two">Request a Quote <img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                        </div>
                    </div>
                </div>
                <div class="cta__shape">
                    <img src="new1/assets/img/images/cta_shape.png" alt="img" data-aos="fade-up-right" data-aos-delay="400">
                </div>
            </div>
            <div class="footer__top">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="footer__widget">
                            <div class="footer__logo">
                                <h1><b>shipnick</b> </h1>
                                <!-- <a href="index.html"><img src="assets/img/logo/w_logo.svg" alt="logo"></a> -->
                            </div>
                            <div class="footer__content">
                                <p>Lorem ipsum dolor sit amet, consect etur adi pisicing elit sed do eiusmod tempor incidunt ut labore et</p>
                            </div>
                            <form action="#" class="footer__newsletter">
                                <div class="form-grp">
                                    <input type="email" placeholder="enter your e-mail">
                                    <button type="submit">Subscribe</button>
                                </div>
                                <span>We don’t send you any spam</span>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">Our Services</h4>
                            <div class="footer__link">
                                <ul class="list-wrap">
                                    <li><a href="#">Same Day Delivery</a></li>
                                    <li><a href="#">Next Day Delivery</a></li>
                                    <li><a href="#">Third-Party Logistics</a></li>
                                    <li><a href="#">B2B</a></li>
                                    <li><a href="#">Supply Chain Management</a></li>
                                    <li><a href="#">Operations Management</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">Quick Links</h4>
                            <div class="footer__link">
                                <ul class="list-wrap">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="about">About us</a></li>
                                    <li><a href="service">Service</a></li>
                                    <li><a href="contact">Contact</a></li>
                                    <li><a href="privacy"> Privacy & Refund Policy</a></li>
                                    <li><a href="/terms-and-conditions">Terms and Conditions</a></li>
                                    <li><a href="/cookie-policy">Cookie policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer__widget">
                            <h4 class="footer__widget-title">Information</h4>
                            <div class="footer__info-wrap">
                                <ul class="list-wrap">
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <p>BK Tower, First Floor, Lal Sarak, Hansi <br> Haryana , India</p>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="tel:0123456789">+91 9187456237</a>
                                    </li>
                                    <li>
                                        <i class="fa-regular fa-clock"></i>
                                        <p>Mon – Sat: 8 am – 5 pm, <br> Sunday: <span>CLOSED</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="copyright-text">
                            <p>Copyright <a href="/">©shipnick</a> | All Right Reserved</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="footer__social">
                            <ul class="list-wrap">
                                <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__shape">
            <img src="new1/assets/img/images/footer_shape01.png" alt="shape" data-aos="fade-down" data-aos-delay="400">
            <img src="new1/assets/img/images/footer_shape02.png" alt="shape" data-aos="fade-left" data-aos-delay="400">
        </div>
    </footer>
    <!-- footer-area-end -->



    <!-- JS here -->
    <script src="{{asset('new1/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('new1/assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/svg-inject.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/ajax-form.js')}}"></script>
    <script src="{{asset('new1/assets/js/jquery.marquee.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('new1/assets/js/aos.js')}}"></script>
    <script src="{{asset('new1/assets/js/main.js')}}"></script>
    <script>
        SVGInject(document.querySelectorAll("img.injectable"));
    </script>
</body>

</html>