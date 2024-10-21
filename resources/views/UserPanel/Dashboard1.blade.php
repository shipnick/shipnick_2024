@extends("UserPanel/userpanel_layout1")
@section("userpanel")
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<!-- row -->

	<div class="container-fluid">
		<div class="row invoice-card-row">
			<div class="col-md-12 mb-5 mt-5 ">
				<form class="rightcol" action="/new">
					<div class="collapsable" id="example4">
						<div class="row">
							<div class="col-4">
								<!-- <label>Produces:</label> -->
								<div id="reportrange" class="pull-right"
									style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
									<i class="fa fa-calendar"></i>&nbsp;
									<span></span> <i class="fa fa-caret-down"></i>
								</div>

								<input type="hidden" id="start_date" name="start_date" />
								<input type="hidden" id="end_date" name="end_date" />


							</div>
						</div>
					</div>
				</form>

			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-blue-bg ">
					<div class="card-body d-flex">
						<h6 class="text-black invoice-num f-24">{{$callcomplete}}</h6>
						<div>
							<!--    <div class="icon me-3">-->
							<!--	<svg width="33px" height="32px">-->
							<!--		<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />-->
							<!--	</svg>-->

							<!--</div>-->


						</div>

					</div>
					<span class="text-black fs-18  mb-4 text-center"><b>Total orders</b> <br> </span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-grey-bg">
					<div class="card-body d-flex">
						<!--<div class="icon me-3">-->
						<!--	<svg width="33px" height="32px">-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />-->
						<!--	</svg>-->

						<!--</div>-->
						<h6 class="text-black invoice-num f-24">{{$monthpickup}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>Pending Pickups</b> <br></b></span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-yellow-bg">
					<div class="card-body d-flex">
						<!--<div class="icon me-3">-->
						<!--	<svg width="35px" height="34px">-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z" />-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z" />-->
						<!--	</svg>-->

						<!--</div>-->
						<h6 class="text-black invoice-num f-24">{{$callintransit}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>In Transit</b> </br></span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-green-bg">
					<div class="card-body d-flex">
						<!--<div class="icon me-3">-->
						<!--	<svg width="35px" height="34px">-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z" />-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z" />-->
						<!--	</svg>-->

						<!--</div>-->
						<h6 class="text-black invoice-num f-24">{{$calldeliverd}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>Delivered</b> <br></span>
				</div>
			</div>
			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-pink-bg">
					<div class="card-body d-flex">
						<!--<div class="icon me-3">-->
						<!--	<svg width="33px" height="32px">-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />-->
						<!--	</svg>-->

						<!--</div>-->
						<h6 class="text-black invoice-num f-24">{{$monthndr}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b>NDR</b> <br></b></span>
				</div>
			</div>

			<div class="col-xl-2 col-xxl-2 col-sm-6">
				<div class="card  invoice-card light-yellow-bg">
					<div class="card-body d-flex">
						<!--<div class="icon me-3">-->
						<!--	<svg width="33px" height="32px">-->
						<!--		<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />-->
						<!--	</svg>-->

						<!--</div>-->
						<h6 class="text-black invoice-num f-24">{{$callretrun}}</h6>
						<div>


						</div>
					</div>
					<span class="text-black fs-18 mb-4 text-center"><b> RTO </b><br></b></span>
				</div>
			</div>


		</div>
		<div class="row">
			<div class="col-xl-9 col-xxl-12">
				<div class="card">
					<div class="card-body">
						<div class="row align-items-center">

							<div class="col-xl-12">
								<div class="row align-items-center  mt-xl-0 mt-4">
									<div class="col-md-6">
										<h4 class="card-title">Today's Overview</h4>
										<!--<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit psu olor</span>-->
										<ul class="card-list mt-4">
											<li><span class="bg-blue circle f-24"></span>COD<span>{{$codPercentage}}%</span></li>
											<li><span class="bg-success circle"></span>Prepaid<span>{{$prepaidPercentage}} %</span></li>
											<!--<li><span class="bg-warning circle"></span>In Transit<span>15%</span></li>-->
											<!--<li><span class="bg-light circle"></span>Others<span>15%</span></li>-->
										</ul>
									</div>
									<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
									<div class="col-md-6" style="height:200px">
										<canvas id="pieChart"></canvas>
									</div>

									<script>
										// Get the canvas element by its id
										var canvas = document.getElementById('pieChart');

										// Create an initial data object for the pie chart
										var data = {
											labels: ['COD', 'Prepaid'],
											datasets: [{
												label: 'Dataset 1',
												data: [{
													{
														$codPercentage
													}
												}, {
													{
														$prepaidPercentage
													}
												}], // Pass percentages directly
												backgroundColor: ['blue', 'green'],
											}]
										};

										// Create configuration options for the pie chart
										var options = {
											responsive: true,
											maintainAspectRatio: false,
										};

										// Create a new pie chart instance
										var pieChart = new Chart(canvas, {
											type: 'pie', // Change chart type to pie
											data: data,
											options: options
										});
									</script>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="container-fluid">
		<div class="row ">

			<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card  invoice-card" style="background-color: #4d81cc">
					<div class="card-body d-flex">
						<div class="icon me-3">
							<svg width="33px" height="32px">
								<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
									d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
							</svg>

						</div>
						<div>
							<h2 class="text-black invoice-num f-24">{{ $talluploaded }}</h2>
							<span class="text-black fs-18">Today's Bookings</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12">

				<div class="card" style="background-color: #4d81cc">
					<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
						<div class="">
							<h4 class="card-title ">Shipment</h4>
						</div>

					</div>
					<div class="card-body tab-content orders-summary pt-3">
						<div class="tab-pane fade show active" id="Monthly">

							<div class="row text-center">
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24  counter ">{{ $talluploaded }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Booked</p>
								</div>
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24  counter">{{$tallpending}}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Pickup Pending</p>

								</div>
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $intransitupload }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">In-transit</p>
								</div>
								<div class="col-sm-2 mb-4">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $tallcomplete }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Delivered</p>
								</div>
								<div class="col-sm-2 ">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{$tallndr}}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">NDR Pending</p>
								</div>
								<div class="col-sm-2">
									<div class="border border-3 px-1 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">{{ $tallcancel }}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">RTO</p>
								</div>
							</div>

						</div>

					</div>
				</div>

			</div>
			<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card  invoice-card" style="background-color: #457B9D">
					<div class="card-body d-flex">
						<div class="icon me-3">
							<svg width="35px" height="34px">
								<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
									d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z" />
								<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
									d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z" />
							</svg>

						</div>
						<div>
							<h2 class="text-black invoice-num fs-24">{{ $tallcomplete }}</h2>
							<span class="text-black fs-18">Delivered Orders</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
				<div class="card" style="background-color: #457B9D;">
					<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
						<div class="">
							<h4 class="card-title ">NDR</h4>
						</div>

					</div>
					<div class="card-body tab-content orders-summary pt-3">
						<div class="tab-pane fade show active" id="Monthly">

							<div class="row text-center">
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter ">{{$tallndr}}</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Total NDR</p>
								</div>
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Reattempt Request</p>
								</div>
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Buyer Reattempt Request</p>
								</div>
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">NDR Delivered</p>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
			<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card  invoice-card" style="background-color: #A8DADC">
					<div class="card-body d-flex">
						<div class="icon me-3">
							<svg width="33px" height="32px">
								<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
									d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
							</svg>

						</div>
						<div>
							<h2 class="text-black invoice-num fs-24">{{ $codamount }}</h2>
							<span class="text-black fs-18">COD Amount</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="card" style="background-color: #A8DADC;">
					<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
						<div class="">
							<h4 class="card-title ">COD</h4>
						</div>
					</div>
					<div class="card-body tab-content orders-summary pt-3">
						<div class="tab-pane fade show active" id="Monthly">

							<div class="row text-center">
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Total COD (30 days)</p>
								</div>
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">COD Available</p>
								</div>
								<div class="col-sm-3 ">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">COD Pending</p>
								</div>
								<div class="col-sm-3">
									<div class="border border-3 px-3 py-2 rounded-xl bg-white">
										<h2 class="fs-24 counter">0</h2>

									</div>
									<p class="fs-16 mb-0 text-white">Last COD Remitted</p>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="row">
			@if ($MonthlyOrder > 0)
                        @php
                        $percentage_xpressbee = ($xpressbee / $MonthlyOrder) * 100;
                        $percentage_ecom = ($Ecom / $MonthlyOrder) * 100;
                        $percentage_bluedart = ($Bluedart / $MonthlyOrder) * 100;

                        $percentage_xpressbeeFormatted = number_format($percentage_xpressbee, 2);
                        $percentage_ecomFormatted = number_format($percentage_ecom, 2);
                        $percentage_bluedartFormatted = number_format($percentage_bluedart, 2);
                        @endphp
                        @endif
				<div class="col-xl-4">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Courier Split</h4>
						</div>
						<div class="card-body">
							<div id="pie-chart" class="ct-chart ct-golden-section"></div>
							<style>
								/* Custom colors for the pie chart slices */
								.ct-series-a .ct-slice-pie {
									fill: #FF5733;
									/* Custom Color 1 (e.g., Orange) */
								}

								.ct-series-b .ct-slice-pie {
									fill: #ffbe33c9;
									/* Custom Color 2 (e.g., Lime Green) */
								}

								.ct-series-c .ct-slice-pie {
									fill: #3357FF;
									/* Custom Color 3 (e.g., Blue) */
								}
							</style>
							<script>
								// Example data for the chart
								var data = {
									labels: [' ', ' ', ' '],
									series: [{
											{
												$percentage_xpressbeeFormatted ?? 0
											}
										},
										{
											{
												$percentage_ecomFormatted ?? 0
											}
										},
										{
											{
												$percentage_bluedartFormatted ?? 0
											}
										}
									] // Sample data values
								};

								// Creating the pie chart
								new Chartist.Pie('#pie-chart', data);
							</script>
							<div class="chart-legend">
								<ul>
									<li><span style="color: #FF5733;">&#9679;</span> Xpressbees: {{ $percentage_xpressbeeFormatted ?? 0 }}%</li>
									<li><span style="color: #ffbe33c9;">&#9679;</span> Ecomexpress: {{ $percentage_ecomFormatted ?? 0 }}%</li>
									<li><span style="color: #3357FF;">&#9679;</span> Bluedart: {{ $percentage_bluedartFormatted ?? 0 }}%</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="card">
						<div class="card-body">
							<div class="profile-news">
								<h5 class="text d-inline ">Shipments - Zone Distribution</h5>
								<ul class="list-group mt-4">
									@foreach ($zoneCounts as $zone => $count)

									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mb-3">Zone {{ $zone }}</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted "> {{ $count }}</span>
									</li>

									@endforeach





								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="card">
						<div class="card-body">
							<div class="profile-news">
								<h5 class="text d-inline">Revenue</h5>
								<ul class="list-group mt-4">
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">Last 90 Days</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($last90DaysCount, 2) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">This Week</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($thisWeekCount, 2) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">This Month</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($thisMonthCount, 2) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between lh-condensed">
										<div>
											<h6 class="my-0 mt-4">This Quarter</h6>
											<!-- <small class="text-muted">Brief description</small> -->
										</div>
										<span class="text-muted mt-4">{{ number_format($thisQuarterCount, 2) }}</span>
									</li>


								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row">

				<div class="col-lg-12">
					<div class="card">
						<div class="card-header light-blue-bg">
							<h4 class="card-title">Courier Wise Summary</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped verticle-middle table-responsive-sm">
									<thead>
										<tr>
											<!-- <th style="width:80px;"><strong>#</strong></th> -->
											<th><strong>Courier Name</strong></th>
											<th><strong>Total Shipments</strong></th>
											<th><strong>Pending Pickups</strong></th>
											<th><strong>In-Transit</strong></th>
											<th><strong>OFD</strong></th>
											<th><strong>Delivered</strong></th>
											<th><strong>RTO</strong></th>
										</tr>
									</thead>
									<tbody>

										<td><strong>Ecom</strong></td>
										@php
										$total1 = $data1['Bluedartcount'];
										$delivered1 = $data1['DeliveredBluedartcount'];
										$percentage1 = $total1 > 0 ? ($delivered1 / $total1) * 100 : 0;
										@endphp

										<td style="color:black">{{ $data1['Bluedartcount'] }}</td>
										<td style="color:black">{{ $data1['pendingBluedartcount'] }}</td>
										<td style="color:black">{{ $data1['inTransitBluedartcount'] }}</td>
										<td style="color:black">{{ $data1['OfdBluedartcount'] }}</td>
										<td style="color:black">{{ $data1['DeliveredBluedartcount'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage1, 2) }}%)</td>
										<td style="color:black">{{ $data1['RtoBluedartcount'] }}</td>
										<!-- Add other status types here in similar fashion -->
										</tr>

										</tr>
										@php
										$total = $data2['Bluedartcount'];
										$delivered = $data2['DeliveredBluedartcount'];
										$percentage = $total > 0 ? ($delivered / $total) * 100 : 0;
										@endphp

										<tr>
											<td><strong>Xpressbee</strong></td>
											<td style="color:black">{{ $data2['Bluedartcount'] }}</td>
											<td style="color:black">{{ $data2['pendingBluedartcount'] }}</td>
											<td style="color:black">{{ $data2['inTransitBluedartcount'] }}</td>
											<td style="color:black">{{ $data2['OfdBluedartcount'] }}</td>
											<td style="color:black">{{ $data2['DeliveredBluedartcount'] }}&nbsp; &nbsp; &nbsp; ({{ number_format($percentage, 2) }}%)</td>
											<td style="color:black">{{ $data2['RtoBluedartcount'] }}</td>




										</tr>
										<!--<tr>-->
										<!--	<td><strong>Shiprocket</strong></td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->
										<!--	<td>0</td>-->

										<!--</tr>-->
										@php
										$total = $data3['Bluedartcount'];
										$delivered = $data3['DeliveredBluedartcount'];
										$percentage3 = $total > 0 ? ($delivered / $total) * 100 : 0;
										@endphp
										<tr>
											<td><strong>Bluedart</strong></td>
											<td style="color:black">{{ $data3['Bluedartcount'] }}</td>
											<td style="color:black">{{ $data3['pendingBluedartcount'] }}</td>
											<td style="color:black">{{ $data3['inTransitBluedartcount'] }}</td>
											<td style="color:black">{{ $data3['OfdBluedartcount'] }}</td>
											<td style="color:black">{{ $data3['DeliveredBluedartcount'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage3, 2) }}%)</td>
											<td style="color:black">{{ $data3['RtoBluedartcount'] }}</td>
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
<!--**********************************
            Content body end
        ***********************************-->
<!-- daterangepicker  -->
<script type="text/javascript">
	$(function() {
		var start = moment();
		var end = moment();

		// Function to update the display
		function cb(start, end) {
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$('#start_date').val(start.format('YYYY-MM-DD'));
			$('#end_date').val(end.format('YYYY-MM-DD'));
		}

		// Initialize the date range picker
		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		// Handle URL parameters
		const urlParams = new URLSearchParams(window.location.search);
		const startDateParam = urlParams.get('start_date');
		const endDateParam = urlParams.get('end_date');

		if (startDateParam && endDateParam) {
			const startDate = moment(startDateParam);
			const endDate = moment(endDateParam);
			cb(startDate, endDate); // Update display with the URL parameters
			$('#reportrange').data('daterangepicker').setStartDate(startDate);
			$('#reportrange').data('daterangepicker').setEndDate(endDate);
		} else {
			// Show today's date initially
			cb(start, end);
		}

		// Handle the selection change
		$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
			// Redirect to the URL with the selected dates
			var url = "{{ url('user-Home') }}?start_date=" + picker.startDate.format('YYYY-MM-DD') + "&end_date=" + picker.endDate.format('YYYY-MM-DD');
			window.location.href = url;
		});
	});
</script>
@endsection()