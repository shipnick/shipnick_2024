@extends("UserPanel/userpanel_layout")
@section("userpanel")
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
											<div class="row invoice-card-row mt-4">
                            					<div class="col-xl-3 col-xxl-3 col-sm-6">
                            						<div class="card  invoice-card light-blue-bg " >
                            							<div class="card-body d-flex">
                            								<div class="icon me-3">
                            									<svg width="33px" height="32px">
                            										<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
                            									</svg>
                            
                            								</div>
                            								<div>
                            									<h2 class="text-black invoice-num">0</h2>
                            									
                            								</div>
                            								
                            							</div>
                            							<span class="text-black fs-18  mb-4 text-center"><b>Remitted Till Date</b>  <br></span>
                            						</div>
                            					</div>
                            					<div class="col-xl-3 col-xxl-3 col-sm-6">
                            						<div class="card  invoice-card light-grey-bg" >
                            							<div class="card-body d-flex">
                            								<div class="icon me-3">
                            									<svg width="33px" height="32px">
                            										<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
                            									</svg>
                            
                            								</div>
                            								<div>
                            									<h2 class="text-black invoice-num">0</h2>
                            									
                            								</div>
                            							</div>
                            							<span class="text-black fs-18 mb-4 text-center"><b>Last Remittance</b> <br></b></span>
                            						</div>
                            					</div>
                            					<div class="col-xl-3 col-xxl-3 col-sm-6">
                            						<div class="card  invoice-card light-yellow-bg" >
                            							<div class="card-body d-flex">
                            								<div class="icon me-3">
                            									<svg width="35px" height="34px">
                            										<path fill-rule="evenodd" fill="#0d111b" d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z" />
                            										<path fill-rule="evenodd" fill="#0d111b" d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z" />
                            									</svg>
                            
                            								</div>
                            								<div>
                            									<h2 class="text-black invoice-num">0</h2>
                            									
                            								</div>
                            							</div>
                            							<span class="text-black fs-18 mb-4 text-center"><b>Next Remittance</b>   </br></span>
                            						</div>
                            					</div>
                            					<div class="col-xl-3 col-xxl-3 col-sm-6">
                            						<div class="card  invoice-card light-green-bg" >
                            							<div class="card-body d-flex">
                            								<div class="icon me-3">
                            									<svg width="35px" height="34px">
                            										<path fill-rule="evenodd" fill="#0d111b" d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z" />
                            										<path fill-rule="evenodd" fill="#0d111b" d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z" />
                            									</svg>
                            
                            								</div>
                            								<div>
                            									<h2 class="text-black invoice-num">0</h2>
                            								
                            								</div>
                            							</div>
                            								<span class="text-black fs-18 mb-4 text-center"><b>Total Remittance Due</b>  <br></span>
                            						</div>
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
														<!--<tr>-->
														<!--	<td>1</td>-->
														<!--	<td>E136829</td>-->
														<!--	<td>₹21204</td>-->
														<!--	<td>29-04-2024</td>-->
														<!--	<td>Paid</td>-->
															
															
														<!--	<td>₹21204</td>-->
														<!--	<td>₹0</td>-->
														<!--	<td>29-04-2024</td>-->
														<!--	<td><a href="remittance/exportAWB/136829" class="btn btn-sm btn-outline-info"><i class="mdi mdi-download"></i></a></td>-->
														<!--</tr>-->
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


@endsection()