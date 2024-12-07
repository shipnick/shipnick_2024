@if(empty(session('UserLogin')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/superlogin') }}");
    </script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shipnick - Best eCommerce shipping solution </title>
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
    <link rel="icon" href="assets/super-admin/assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/super-admin/assets/css/style.css')}}">



</head>
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
<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar  ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="{{asset('assets/super-admin/assets/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
                        <div class="user-details">
                            <span>Super-Admin</span>
                            <div id="more-details"></div>
                        </div>
                    </div>

                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('/superpanel') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-layout"></i></span><span class="pcoded-mtext">Courier
                                Setting</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="{{ asset('/super-courier') }}"> Courier Assignment</a></li>
                            <li><a href="{{ asset('super-rate-list') }}">Default Commercials</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Admin</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-box"></i></span><span class="pcoded-mtext">All about Admins</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="{{ asset('/super-all-admin') }}">Admin Roles</a></li>
                            <li><a href="{{ asset('/super-all-admin-new') }}">Admin Details</a></li>

                        </ul>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Pincode &amp; </label>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('/super-admin-pincode') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-file-text"></i></span><span class="pcoded-mtext">Pincode
                                Manage</span></a>
                    </li>


                </ul>



            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">


        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <!-- <img src="assets/images/logo.png" alt="" class="logo">
						<img src="assets/images/logo-icon.png" alt="" class="logo-thumb"> -->
                {{-- <h4 style="color: white;">SHIPNICK</h4> --}}
                <img src="/ShipnickTransH-sm.png" style="max-height: 46px; filter: invert(1) hue-rotate(170deg);" alt="Shipnick" />
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="icon feather icon-bell"></i>
                            <span class="badge badge-pill badge-danger">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{asset('assets/super-admin/assets/images/user/avatar-2.jpg')}}"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Kuldeep</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-2.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="{{asset('assets/super-admin/assets/images/user/avatar-2.jpg')}}"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="assets/images/user/avatar-2.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{asset('assets/super-admin/assets/images/user/avatar-2.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                <span>John Doe</span>
                                <a href="{{ asset('/Logout') }}" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <!-- <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i>
                                        Profile</a></li>
                                <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i>
                                        My Messages</a></li> -->
                                <li><a href="{{ asset('/Logout') }}" class="dropdown-item"><i class="feather icon-lock"></i>
                                        Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


    </header>
    <!-- [ Header ] end -->
    @if(session()->has('message'))
    <section class="pcoded-main-container" style="min-height: 0vh;">
        <div class="">
            <div class="alert alert-success left-icon-big alert-dismissible fade show">

                <div class="media">
                    <div class="alert-left-icon-big">
                        <span></span>
                    </div>
                    <div class="media-body">
                        <h5 class="mt-1 mb-2">successfully</h5>
                        <p class="mb-0">{{ session()->get('message') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endif


    @yield('bodycontent')
   

    <!-- Required Js -->
    <script src="{{asset('assets/super-admin/assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/super-admin/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/super-admin/assets/js/pcoded.min.js')}}"></script>

    <!-- Apex Chart -->
    <script src="{{asset('assets/super-admin/assets/js/plugins/apexcharts.min.js')}}"></script>


    <!-- custom-chart js -->
    <script src="{{asset('assets/super-admin/assets/js/pages/dashboard-main.js')}}"></script>
</body>

</html>
