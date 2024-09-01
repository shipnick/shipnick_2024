<!DOCTYPE html>
<html lang="en">

<head>

  <!-- All Meta -->
  <meta charset="utf-8">
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
  <link rel="shortcut icon" href="{{asset('Admin/images/logo.jpg')}}" />

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

  @include("UserPanel/app")
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
      <!-- row -->
      <div class="container-fluid">
        <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pricing</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home"><i class="la la-home me-2"></i><strong>Pricing PLan</strong> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#profile"><i class="la la-user me-2"></i><strong>COD Remittance</strong></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#contact"><i class="la la-phone me-2"></i><strong>Invoice</strong></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i><strong>Wallet</strong></a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#CreditNotes"><i class="la la-envelope me-2"></i><strong>Credit Notes</strong></a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#WeightReconciliation"><i class="la la-envelope me-2"></i><strong>Weight Reconciliation</strong></a>
                                        </li>
										
                                    </ul>
                                    <div class="tab-content ">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                                            <div class="row">
                                                <style>
                                                .table thead th {
                                                          
                                                            border-color: #161515 !important;
                                                        }
                                                     .table th, .table td {
                                                        border-color: #020202;
                                                        padding: 4px 10px;
                                                    }
                                                    
                                                    .table-bordered > :not(caption) > * > * {
                                                          
                                                        border-width: 2px  2px;
                                                    }
                                                    .table tbody tr td {
                                                        vertical-align: middle;
                                                        border-color: #020202;
                                                    }
                                                </style>
                                                @foreach ($params as $post)
                                                    <div class="col-md-9 mt-3">
                                                        <div class="" style="background-color: #12263f;">
                                                            <h5 class="text-white text-center p-2">
                                                                <strong>Shipnick {{ $post->courier_name }}</strong><br>
                                                            </h5>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-sm text-center align-middle" style="text-size:10px">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="font-size: 11px;"><strong>COURIER</strong></th>
                                                                        <th style="font-size: 11px;"><strong>TYPE</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(A)</span><strong><br>WITHIN <br> CITY</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(B)</span><strong><br>WITHIN <br> STATE</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(C)</span><strong><br>REGIONAL</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(D)</span><strong><br>METRO TO <br> METRO</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(E)</span><br><strong>ROI</strong></th>
                                                                        <th style="font-size: 11px;"><span style="color:#915dd3;">ZONE(F)</span><strong><br>NE,J&K,KL,AN</strong></th>
                                                                        <th style="font-size: 11px;"><strong>COD<br>CHARGES</strong></th>
                                                                        <th style="font-size: 11px;"><strong>COD%</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="text-black">
                                                                        <td rowspan="3">{{ $post->courier_name }}</td>
                                                                        <td>FWD</td>
                                                                        <td>{{ $post->fwda }}</td>
                                                                        <td>{{ $post->fwdb }}</td>
                                                                        <td>{{ $post->fwdc }}</td>
                                                                        <td>{{ $post->fwdd }}</td>
                                                                        <td>{{ $post->fwdf }}</td>
                                                                        <td>{{ $post->fwde }}</td>
                                                                        <td rowspan="3">{{ $post->fwdg }}</td>
                                                                        <td rowspan="3">{{ $post->fwdh }}</td>
                                                                    </tr>
                                                                    <tr class="text-black">
                                                                        <td>RTO</td>
                                                                        <td>{{ $post->rtoa }}</td>
                                                                        <td>{{ $post->rtob }}</td>
                                                                        <td>{{ $post->rtoc }}</td>
                                                                        <td>{{ $post->rtod }}</td>
                                                                        <td>{{ $post->rtof }}</td>
                                                                        <td>{{ $post->rtoe }}</td>
                                                                    </tr>
                                                                    <tr class="text-black" style="border: 2px solid black;">
                                                                        <td>Add Wt.</td>
                                                                        <td>{{ $post->wta }}</td>
                                                                        <td>{{ $post->wtb }}</td>
                                                                        <td>{{ $post->wtc }}</td>
                                                                        <td>{{ $post->wtd }}</td>
                                                                        <td>{{ $post->wtf }}</td>
                                                                        <td>{{ $post->wte }}</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                             <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Terms & Conditions:</h4>
                            </div>
                            
                            <div class="card-body">
                                
                                <!-- Nav tabs -->
                                <div class="">
                                    
                                    <div class="terms-conditions">
                                        <!--<h4>Terms & Conditions:</h4>-->
                                        <ul class="text-black">
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right mb-2"></i> Above prices are inclusive of GST.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Chargeable Weight will be Physical / Dead Weight or Volumetric Weight whichever is Higher.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>COD Charges will be fixed COD charge or COD % of the order value whichever is Higher.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Volumetric Weight (Kilogram) calculation as per IATA - Length (cm) x Breadth (cm) x Height (cm) / 5000</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Other Charges like Octroi charges, state entry tax and fees, address correction charges if applicable shall be charged extra.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>RTO (return to origin) shipment will be charged separately from the forward delivery rate, which will be the same as Forward Rates.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>For any queries a ticket has to be raised on: <a href="mailto:info@shipnick.com"> <strong>info@shipnick.com</strong> </a></li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>The maximum liability if any is limited to Rs. 1000/- in the event of a claim by the Merchant, provided such claim is raised by the Merchant within 7 days from the date of such damage or loss or theft.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>The Merchant shall not book / handover or allow to be handed over any Product which is banned, restricted, illegal, prohibited, stolen, infringing of any third-party rights, liquid materials, hazardous or         dangerous or in breach of any law or regulation in force in India for the purpose of the logistics or delivery services.</li>
                                            <li class="mb-2"> <i class="fa-solid fa-arrow-right me-1"></i>Other terms and conditions will be applicable as defined in the agreement.</li>
                                        </ul>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                                        </div>

                                        <div class="tab-pane fade" id="profile">
											<div class="row ">
												
												<div class="col-md-3 mt-3 card text-center border-right" style="background-color: #bacbff;">
													<h5>Remitted Till Date</h5>
													<h5><b>₹</b>445919</h5>
												</div>
												<div class="col-md-3 mt-3 card text-center border-right" style="background-color: #bdebfe;">
													<h5>Last Remittance</h5>
													<h5><b>₹</b>445919</h5>
												</div>
												<div class="col-md-3 mt-3 card text-center border-right" style="background-color: #f4ccff;">
													<h5>Next Remittance</h5>
													<h5><b>₹</b>445919</h5>
												</div>
												<div class="col-md-3 mt-3 card text-center border-right" style="background-color: #AF5AE2;">
													<h5>Total Remittance Due</h5>
													<h5><b>₹</b>445919</h5>
												</div>
											</div>
											
											<div class="table-responsive">
												<table class="table table-responsive-md">
													<thead>
														<tr>
															<th style="width:80px;"><strong>#</strong></th>
															<th><strong>REMITTANCE ID</strong></th>
															<th><strong>COD AMOUNT</strong></th>
															<th><strong>DATE</strong></th>
															<th><strong>STATUS</strong></th>
															
															<th><strong>FREIGHT DEDUCTIONS</strong></th>
															<th><strong>REMITTANCE AMOUNT</strong></th>
															<th><strong>PAYMENT REF</strong></th>
															<th class="text-end"><strong>DOWNLOAD</strong></th>
														   
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>1</td>
															<td>E136829</td>
															<td>₹21204</td>
															<td>29-04-2024</td>
															<td>Paid</td>
															
															
															<td>₹21204</td>
															<td>₹0</td>
															<td>29-04-2024</td>
															<td><a href="remittance/exportAWB/136829" class="btn btn-sm btn-outline-info"><i class="mdi mdi-download"></i></a></td>
														</tr>
													</tbody>
												</table>
											</div>
                                        </div>
                                        <div class="tab-pane fade" id="contact">
											
											<div class="table-responsive mt-3">
												<table class="table table-responsive-md">
													<thead>
														<tr>
															
															<th><strong>INVOICE NO</strong></th>
															<th><strong>INVOICE STATE</strong></th>
															<th><strong>INVOICE DATE</strong></th>
															<th><strong>INVOICE PERIOD</strong></th>
															
															<th><strong>INVOICE AMOUNT</strong></th>
															
															<th class="text-end"><strong>DOWNLOAD</strong></th>
														   
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>BB/MH/WE/4156</td>
															<td>
																Maharashtra                                </td>
															<td>2024-05-01</td>
															<td>Apr 2024</td>
															<td>₹41.01</td>
															<td>
							
																							
															
																<a target="_blank" href="https://xb-files.s3.amazonaws.com/assets/invoices/ecom/invoice/93589_maharashtra_01-May-24_171450711755446.csv" class="btn btn-sm btn-outline-primary"><i class="mdi mdi-file-excel"></i></a>
																<a target="_blank" href="https://xb-files.s3.amazonaws.com/assets/invoices/ecom/invoice/93589_maharashtra_01-May-24_17145071173676.pdf" class="btn btn-sm btn-outline-danger"><i class="mdi mdi-file-pdf"></i></a>
							
															
															
							
																<!-- <a target="_blank" href="assets/invoice/93589_maharashtra_01-May-24_171450711755446.csv" class="btn btn-sm btn-outline-primary"><i class="mdi mdi-file-excel"></i></a>
																<a target="_blank" href="assets/invoice/93589_maharashtra_01-May-24_17145071173676.pdf" class="btn btn-sm btn-outline-danger"><i class="mdi mdi-file-pdf"></i></a> -->
															
															</td>
														  
														</tr>
													</tbody>
												</table>
											</div>
                                        </div>
                                        <div class="tab-pane fade" id="message">
											<div class="col-xl-12">
												<div class="filter cm-content-box box-primary">
													
													<div class="cm-content-body form excerpt">
														<div class="card-body">
															<div class="row">
																<div class="col-xl-3 col-sm-6">
																	<input type="text" class="form-control mb-xl-0 mb-3" id="exampleFormControlInput1" placeholder="Title">
																</div>
																<div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
																	<select class="nice-select form-control default-select dashboard-select-2 h-auto wide" aria-label="Default select example">
																		<option selected>Select Status</option>
																		<option value="1">Published</option>
																		<option value="2">Draft</option>
																		<option value="3">Trash</option>
																		<option value="4">Private</option>
																		<option value="5">Pending</option>
																	</select> 
																</div>
																<div class="col-xl-3 col-sm-6">
																	<input type="text" class="form-control mb-3 mb-xl-0" placeholder="2017-06-04" id="datepicker">
																</div>
																<div class="col-xl-3 col-sm-6">
																	<button class="btn btn-primary" title="Click here to Search" type="button"><i class="fa fa-search me-1"></i>Filter</button>
																	<button class="btn btn-danger light" title="Click here to remove filter" type="button">Remove</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<h6>@if(isset($billing_data) && $billing_data->isNotEmpty()) Wallet Balance: -₹{{$billing_data_total['close_blance']}} @endif</h6>
											<div class="table-responsive">
												<table class="table table-responsive-md">
													<thead>
														<tr>
															
															<th><strong>DATE</strong></th>
															<th><strong>TXN TYPE</strong></th>
															<th><strong>REF NO#</strong></th>
															<th><strong>TRANSACTION ID</strong></th>
															
															<th><strong>CREDIT(₹)</strong></th>
															<th><strong>DEBIT(₹)</strong></th>
															<th><strong>CLOSING BALANCE(₹)</strong></th>
															
															<th><strong>DESCRIPTION</strong></th>
															
															
														   
														</tr>
													</thead>
													    <tbody>
                                                        @if(isset($billing_data) && $billing_data->isNotEmpty())
                                                            @foreach($billing_data as $data)
                                                                <tr>
                                                                    <td>{{ $data->date }}</td>
                                                                    <td>Shipping</td>
                                                                    <td>
                                                                       {{ $data->awb_no }}</a>
                                                                    </td>
                                                                    <td>{{ $data->transaction }}</td>
                                                                    <td> @if(!is_numeric($data->awb_no))   +{{ $data->credit }} @endif </td>
                                                                  
                                                                    <td>@if(is_numeric($data->awb_no))  -{{ $data->credit }}  @endif</td>
                                                                    <td>-{{ $data->close_blance }}</td>
                                                                    <td>Freight Charges</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

												</table>
											</div>
                                        </div>
										<div class="tab-pane fade" id="CreditNotes">
											<div class="table-responsive mt-3">
												<table class="table table-responsive-md">
													<thead>
														<tr>
															
															<th><strong>CN NO.</strong></th>
															<th><strong>CN STATE</strong></th>
															<th><strong>CN DATE</strong></th>
															<th><strong>CN PERIOD</strong></th>
															
															<th><strong>CN AMOUNT</strong></th>
															<th><strong>ACTION</strong></th>
															
															
															
														   
														</tr>
													</thead>
													<tbody>
														<tr></tr>
													</tbody>
												</table>
											</div>
                                        </div>
										<div class="tab-pane fade mt-5" id="WeightReconciliation">
											<div class="col-xl-12">
												<div class="filter cm-content-box box-primary">
													
													<div class="cm-content-body form excerpt">
														<div class="card-body">
															<div class="row">
																<div class="col-xl-3 col-sm-6">
																	<input type="text" class="form-control mb-xl-0 mb-3" id="exampleFormControlInput1" placeholder="Title">
																</div>
																<div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
																	<select class="nice-select form-control default-select dashboard-select-2 h-auto wide" aria-label="Default select example">
																		<option selected>Select Status</option>
																		<option value="1">Published</option>
																		<option value="2">Draft</option>
																		<option value="3">Trash</option>
																		<option value="4">Private</option>
																		<option value="5">Pending</option>
																	</select> 
																</div>
																<div class="col-xl-3 col-sm-6">
																	<input type="text" class="form-control mb-3 mb-xl-0" placeholder="2017-06-04" id="datepicker">
																</div>
																<div class="col-xl-3 col-sm-6">
																	<button class="btn btn-primary" title="Click here to Search" type="button"><i class="fa fa-search me-1"></i>Filter</button>
																	<button class="btn btn-danger light" title="Click here to remove filter" type="button">Remove</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-responsive-sm">
													<thead>
														<tr style="background-color: #969ba0;">
															
															<th><strong>WEIGHT APPLIED DATE</strong></th>
															<th><strong>COURIER</strong></th>
															<th><strong>AWB NUMBER</strong></th>
															<th><strong>ENTERED WEIGHT</strong></th>
															
															<th><strong>APPLIED WEIGHT</strong></th>
															<th><strong>WEIGHT CHARGES</strong></th>
															<th><strong>PRODUCT</strong></th>
															
															<th><strong>ACTION</strong></th>
															
														</tr>
													</thead>
													<tbody>
														<tr>
															
															<td>2024-04-02</td>
															<td>Surface Xpressbees 0.5 K.G                        </td>
															<td>
																Surface Xpressbees 0.5 K.G<br>
																14344940833061                        </td>
															<td style="min-width:100px;"><b>Entered Weight</b> 500g<br>
																<b>Charged Weight </b> 500<br>                             <b>LxBxH</b>: 13x13x13                        </td>
															<td> 1000g
															</td>
															<td>
																								<b>Forward</b> : 24<br>
																										<b>RTO</b> : 24<br>
																														</td>
															<td>
																<span data-toggle="tooltip" data-html="true" title="" data-original-title="GS-ET6Y-N8WM">
																	GS-ET6Y-N8WM                            </span>
															</td>
															<td>
																								<b>Dispute Raised</b>
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