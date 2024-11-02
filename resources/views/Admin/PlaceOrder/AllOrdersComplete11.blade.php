<!DOCTYPE html>
<html lang="en">

<head>

    <!-- All Meta -->
    <meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords" content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
    <meta property="og:description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!-- Page Title Here -->
    <title>Shipnick</title>




    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">
    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">S</span>
            <span style="--i:2">H</span>
            <span style="--i:3">I</span>
            <span style="--i:4">P</span>
            <span style="--i:5">N</span>
            <span style="--i:6">I</span>
            <span style="--i:7">C</span>
            <span style="--i:8">K</span>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    @include("Admin/app")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center mb-3">
                    <div class="mb-3 me-auto">
                        <div class="card-tabs style-1 mt-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);" data-bs-toggle="tab" id="transaction-tab" data-bs-target="#AllTransaction" role="tab">All Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Completed-tab" data-bs-target="#Completed" role="tab">Delivered</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Pending-tab" data-bs-target="#Pending" role="tab">Pending</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Canceled-tab" data-bs-target="#Cancelled" role="tab">Cancelled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Not-picked-tab" data-bs-target="#Notpicked" role="tab">Not Picked</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="RTO-tab" data-bs-target="#RTO" role="tab">RTO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="tab" id="Failed-tab" data-bs-target="#Failed" role="tab">Failed</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-outline-primary mb-3"><i class="fa fa-calendar me-3 scale3"></i>Filter Date</a>
                </div>
                <div class="row">
                    <div class="col-xl-12 tab-content">
                        <div class="tab-pane fade show active" id="AllTransaction" role="tabpanel" aria-labelledby="transaction-tab">
                            <div class="table-responsive fs-14">
                                <table class="table card-table display mb-4 dataTablesCard text-black" id="example5">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                                    <label class="form-check-label" for="checkAll">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>AWB #</th>
                                            <th>ID Order(s)</th>
                                            <th>Date of upload</th>
                                            <th>Customer details</th>
                                            <th>Customer address</th>
                                            <th>Courier</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>AWHD12451</span></td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">Nov 1, 2023</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap"><span>Archana</span><br />
                                                            <span>9865524251</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>C5A, Janakpuri<br>Delhi</span></td>
                                            <td><span>Delhivery</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>AWHD12451</span></td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">Nov 1, 2023</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap"><span>Radhey Shyam</span><br />
                                                            <span>9865524251</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>C5A, Burari<br>Delhi</span></td>
                                            <td><span>Delhivery</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>AWHD12451</span></td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">Nov 1, 2023</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap"><span>Gaurav Mishra</span><br />
                                                            <span>9865524251</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>C5A, Rohini<br>Delhi</span></td>
                                            <td><span>Delhivery</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning  btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>AWHD12451</span></td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">Nov 1, 2023</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap"><span>Bhawna</span><br />
                                                            <span>9865524251</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>RZ-41, Hari Nagar<br>Delhi</span></td>
                                            <td><span>DTDC</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>AWHD12451</span></td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">Nov 1, 2023</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap"><span>Vaibhav</span><br />
                                                            <span>9865524251</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>86, Mayapuri<br>Delhi</span></td>
                                            <td><span>Bluedart</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>AWHD12451</span></td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">Nov 1, 2023</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap"><span>Nurkomariah</span><br />
                                                            <span>9865524251</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>House no. 56, Laxmi nagar<br>Delhi</span></td>
                                            <td><span>ATS</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Completed" role="tabpanel" aria-labelledby="Completed-tab">
                            <div class="table-responsive fs-14">
                                <table class="table card-table display mb-4 dataTablesCard text-black" id="example6">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="checkAll1">
                                                    <label class="form-check-label" for="checkAll">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>AWB #</th>
                                            <th>ID Order(s)</th>
                                            <th>Date of upload</th>
                                            <th>Customer details</th>
                                            <th>Customer address</th>
                                            <th>Courier</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/1.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip211)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip211">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/2.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Jeremy Tedy</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$738.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip222)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip222">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Medan,<br> Sumut Indonesia</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/3.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Clown Studio</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$560.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-danger">
                                                        <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
                                                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
                                                        </svg>

                                                    </span>
                                                    Outcome
                                                </div>
                                            </td>
                                            <td><span>London,<br> England</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/4.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Samuel Bro</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip233)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip233">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/5.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">David Oconner</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$738.30</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip244)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip244">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Medan,<br> Sumut Indonesia</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/6.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Cindy Seea</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$312.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-danger">
                                                        <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
                                                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
                                                        </svg>

                                                    </span>
                                                    Outcome
                                                </div>
                                            </td>
                                            <td><span>London,<br> England</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/7.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                        <span class="fs-14 text-light">Freelancer</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip255)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip255">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/8.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip266)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip266">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-sm btn-danger btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
                            <div class="table-responsive fs-14">
                                <table class="table card-table display mb-4 dataTablesCard text-black" id="example7">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="checkAll2">
                                                    <label class="form-check-label" for="checkAll">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>ID Invoice</th>
                                            <th>Date</th>
                                            <th>Recipient</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/1.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip277)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip277">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/2.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Jeremy Tedy</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$738.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip288)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip288">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Medan,<br> Sumut Indonesia</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-sm btn-danger btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/3.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Clown Studio</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$560.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-danger">
                                                        <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
                                                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
                                                        </svg>

                                                    </span>
                                                    Outcome
                                                </div>
                                            </td>
                                            <td><span>London,<br> England</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/4.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Samuel Bro</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip299)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip299">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/5.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">David Oconner</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$738.30</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip12)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip12">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Medan,<br> Sumut Indonesia</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/6.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Cindy Seea</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$312.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-danger">
                                                        <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
                                                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
                                                        </svg>

                                                    </span>
                                                    Outcome
                                                </div>
                                            </td>
                                            <td><span>London,<br> England</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/7.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                        <span class="fs-14 text-light">Freelancer</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip42)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip42">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/8.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip52)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip52">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Canceled" role="tabpanel" aria-labelledby="Canceled-tab">
                            <div class="table-responsive fs-14">
                                <table class="table card-table display mb-4 dataTablesCard text-black" id="example8">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="checkAll3">
                                                    <label class="form-check-label" for="checkAll">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>ID Invoice</th>
                                            <th>Date</th>
                                            <th>Recipient</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/1.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip1)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip1">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/2.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Jeremy Tedy</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$738.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip88885)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip88885">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Medan,<br> Sumut Indonesia</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/3.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Clown Studio</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$560.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-danger">
                                                        <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
                                                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
                                                        </svg>

                                                    </span>
                                                    Outcome
                                                </div>
                                            </td>
                                            <td><span>London,<br> England</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/4.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Samuel Bro</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip88884)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip88884">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm  btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/5.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">David Oconner</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$738.30</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip88883)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip88883">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Medan,<br> Sumut Indonesia</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/6.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Cindy Seea</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$312.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-danger">
                                                        <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
                                                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
                                                        </svg>

                                                    </span>
                                                    Outcome
                                                </div>
                                            </td>
                                            <td><span>London,<br> England</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm btn-rounded light">Pending</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/7.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                        <span class="fs-14 text-light">Freelancer</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip88881)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip88881">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Completed</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                </div>
                                            </td>
                                            <td><span>#123412451</span></td>
                                            <td><span class="text-nowrap">June 1, 2020, 08:22 AM</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="images/avatar/8.jpg" alt="" class="rounded-circle me-3" width="50">
                                                    <div>
                                                        <h6 class="fs-16 mb-0 text-nowrap">Nurkomariah</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>$128.89</span></td>
                                            <td>
                                                <div>
                                                    <span class="me-2 oi-icon bgl-success">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip8888)">
                                                                <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155"></path>
                                                                <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip8888">
                                                                    <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                    Income
                                                </div>
                                            </td>
                                            <td><span>Bangladesh,<br> India</span></td>
                                            <td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">Canceled</a></td>
                                            <td class="text-end">
                                                <div class="dropdown dropstart">
                                                    <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Transactions</a>
                                                        <a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>View Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">

            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->




    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js')}}"></script>
    <script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

    <!-- Apex Chart -->
    <script src="{{asset('newtheme/vendor/apexchart/apexchart.js')}}"></script>
    <script src="{{asset('newtheme/./vendor/nouislider/nouislider.min.js')}}"></script>
    <script src="{{asset('newtheme/./vendor/wnumb/wNumb.js')}}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{asset('newtheme/vendor/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('newtheme/vendor/swiper/js/swiper-bundle.min.js')}}"></script>

    <!-- Dashboard 1 -->
    <script src="{{asset('newtheme/js/dashboard/dashboard-5.js')}}"></script>

    <script src="{{asset('newtheme/js/custom.min.js')}}"></script>
    <script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>



    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                var dezSettingsOptions = {
                    typography: "cairo",
                    version: "light",
                    layout: "vertical",
                    primary: "color_10",
                    headerBg: "color_1",
                    navheaderBg: "color_1",
                    sidebarBg: "color_10",
                    sidebarStyle: "mini",
                    sidebarPosition: "fixed",
                    headerPosition: "fixed",
                    containerLayout: "wide",
                };
                new dezSettings(dezSettingsOptions);
                jQuery(window).on('resize', function() {
                    new dezSettings(dezSettingsOptions);
                })
            }, 1000)
        });
    </script>

</body>

</html>