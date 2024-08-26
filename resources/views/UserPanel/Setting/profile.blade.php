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
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">

    <!-- Page Title Here -->
    <title>Shipnick</title>




    <link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">
    <!-- Style css -->
    <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>
<style type="text/css">
	.shipment {
		padding: 10px;
		margin-top: 5px;
	}

	.h1,
	.h2,
	.h3,
	.h4,
	.h5,
	.h6,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	p {
		margin-bottom: 0px;
	}

	h4 {
		font-size: 21px;
		font-family: 'Arial', sans-serif;
		font-weight: 600;
	}

	p,
	h6 {
		font-size: 18px;
		font-family: 'Arial', sans-serif;
		font-weight: 600;
	}

	table.manifest-table {
		border-collapse: collapse;
		width: 100%;
		page-break-inside: avoid;
		color: #000000;
		/* float:left;
                margin:10px; */
	}



	table.prod-table {
		border-collapse: collapse;
		width: 100%;
		/* margin: auto; */
		border-top: none;
		font-size: 15px;
		color: #000000;
		font-family: 'Roboto', sans-serif;
	}

	table td {
		border: 1px solid black;
	}

	table .prod-table thead:first-child th {
		border-right: 1px solid;
	}

	table tr td:first-child {
		border-left: 0;
	}

	table .prod-table tr:last-child td {
		border-bottom: 0;
	}

	table tr td:last-child {
		border-right: 0;
	}

	.template_border {
		border: 2px solid #000;
	}

	.barcode {
		font-family: 'B39MHR';
		font-size: 65px;
	}

	.text-center {
		text-align: center;
	}

	.text-right {
		text-align: right;
	}

	.rotate270 {
		-webkit-transform: rotate(270deg);
		-moz-transform: rotate(270deg);
		-o-transform: rotate(270deg);
		-ms-transform: rotate(270deg);
		transform: rotate(270deg);
	}

	.mb5 {
		margin-bottom: 5px;
	}

	.fulfilledby {
		font-size: 15px;
		font-weight: 100;
		text-align: left;
	}

	table tr td {
		padding-left: 5px;
		padding-right: 5px;
	}

	body {
		line-height: 2.5;
	}

	/* .sign_manifest {
                    margin-bottom: -210px;
                    margin-right: -120px;
                    margin-left: 787px
                }

            .print_manifest {
                float: right;
                margin-top: 20px;
                margin-bottom: 10px;
                margin-right: 440px;
            }

            .print_invoice {
                margin-top: 45px;
            } */

	@media print {
		@page {
			/* size: auto;   auto is the initial value */
			size: 4in 6in;
			/* size: 8in 12in; */
			margin: 10px;
			/*this affects the margin in the printer settings*/
			color: #000000 !important;
		}

		.sign_manifest {
			display: none;
		}

		.print_manifest {
			display: none;
		}

		.print_invoice {
			display: none;
		}
	}

	/* For Screen Size below 991px */
	@media screen and (max-width: 991px) {
		.d_flex {
			display: flex;
			justify-content: space-between;
			width: 56%;
			padding: 10px;
		}

		.sign_manifest,
		.print_manifest {
			margin-right: 5%;
		}
	}

	/* For Screen Size above 991px */
	@media screen and (min-width: 991px) {
		.d_flex {
			float: right;
			margin-right: 30%;
			padding-top: 10px;
			/* position: fixed;
                    right: 1rem;
                    top: 4rem; */
		}

		.sign_manifest,
		.print_manifest {
			margin: 0px !important;
			display: block;
			margin-bottom: 10px !important;
		}
	}
</style>
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
        <div class="content-body" >
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item  active"><a href="javascript:void(0)">Settings</a></li>
                    </ol>
                </div>
                <div class="row">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Settings</h4>
							</div>
							<div class="card-body">
								<!-- Nav tabs -->
								<div class="custom-tab-1" >
									<ul class="nav nav-tabs" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
										<li class="nav-item font-weight-bold">
											<a style="font-weight: 700;" class="nav-link active font-w700" data-bs-toggle="tab" href="#home1"><i
													class="la la-smile solid"></i>&nbsp;&nbsp;Merchant Details</a>
										</li>
										<li class="nav-item font-weight-bold">
											<a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab" href="#profile2"><i
													class="la la-wallet"></i>&nbsp;&nbsp;Courier Permissions</a>
										</li>
										<li class="nav-item font-weight-bold">
											<a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab" href="#profile1"><i
													class="la la-wallet"></i>&nbsp;&nbsp;Financial Details</a>
										</li>
										<li class="nav-item font-weight-bold" style="font-width:800">
											<a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab" href="#contact1"><i
													class="la la-home me-2"></i>&nbsp;&nbsp;Address Info.</a>
										</li>
										<li class="nav-item font-weight-bold">
											<a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab" href="#label"><i class="la la-home me-2"></i>&nbsp;&nbsp;Label setting</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="home1" role="tabpanel">
											<div class="card-body">
												<div class="form-validation">

                                                <form method="post" action="{{ asset('/setting') }}" enctype="multipart/form-data">
														<div class="row">
															<div
																class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom01">Name
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom01" name="name"
																			placeholder="Enter name.."
																			 required>
																		<div class="invalid-feedback">
																			Please enter name.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom02">Email <span
																			class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom02"
																			placeholder="Your valid email.."
																			name="email" 
																			required>
																		<div class="invalid-feedback">
																			Please enter a Email.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom03">Contact No.
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom03"
																			placeholder="Please enter a phone no."
																			name="phone" 
																			required>
																		<div class="invalid-feedback">
																			Please enter a phone no.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom04">Address
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom04"
																			placeholder="Please enter address"
																			name="addressline1"
																			required>
																		<div class="invalid-feedback">
																			Please enter Address
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom05">PIN
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom05"
																			placeholder="Please enter PIN"
																			name="zipcode"
																			required>
																		<div class="invalid-feedback">
																			Please enter PIN
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
															@csrf
															<button type="submit"
																class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
															<button type="button"
																class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="profile2">
											<div class="card-body">
												<div class="panel-body">
													<?php
													$couriercompany = ['NI' => 'Nimbus', 'IN' => 'Intargos'];
													$couriernames = [];
													foreach ($couriers as $cr) {
														$couriernames[$cr->courier_by] = $cr->display_courier_by;
													}
													?>

													<table class="datatable table table-striped">
														<thead>
															<tr>
																<th>Sno</th>
																<th>Courier Through</th>
																<th>Courier Priority</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															@php $cnt = 1; @endphp
															@foreach($param as $item)
															<tr>
																<td>{{ $cnt++ }}</td>
																<td>{{ $couriernames[$item->courier_by] ?? 'Unknown' }}</td>
																<td>
																	<select class="form-control priority-select" style="padding: 0 0 0 5px; height: 21px;" onchange="updatePriorities(this, '{{ $item->courier_code }}', '{{ $item->courier_by }}')">
																		<option value="0">Priority not assigned</option>
																		@for($cnois = 1; $cnois <= count($param); $cnois++) <option value="{{ $cnois }}" @if($item->courier_priority == $cnois) selected @endif>
																			Priority {{ $cnois }}
																			</option>
																			@endfor
																	</select>
																</td>
																<td>
																	<label class="switch">
																		<input type="checkbox" onchange="change_status('{{ $item->courier_code }}', '{{ $item->courier_by }}', this)" value="0" @if($item->user_flg) checked @endif>
																		<span class="slider round"></span>
																	</label>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>

												<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
												<script>
													function updatePriorities(selectedElement, code, courier) {
														const selectedPriority = $(selectedElement).val();
														const allPriorityElements = $('.priority-select');

														allPriorityElements.each(function() {
															if (this !== selectedElement) {
																const currentSelected = $(this).val();
																if (currentSelected == selectedPriority) {
																	$(this).find('option[value="' + selectedPriority + '"]').remove();
																	$(this).append('<option value="' + selectedPriority + '">Priority ' + selectedPriority + '</option>');
																}
															}
														});

														change_priority(code, courier, selectedPriority);
													}

													function change_priority(code, courier, value) {
														const userid = "{{ $id }}";
														$.ajax({
															type: "GET",
															url: "{{ asset('/courier-priority-update') }}",
															data: {
																code,
																courier,
																userid,
																value
															},
															success: function(response) {
																console.log('Priority updated successfully.');
															},
															error: function(error) {
																console.error('Error updating priority:', error);
															}
														});
													}

													function change_status(code, courier, checkbox) {
														const userid = "{{ $id }}";
														const value = $(checkbox).prop('checked') ? 1 : 0;
														$.ajax({
															type: "GET",
															url: "{{ asset('/courier-permissions-update') }}",
															data: {
																code,
																courier,
																userid,
																value
															},
															success: function(response) {
																console.log('Status updated successfully.');
															},
															error: function(error) {
																console.error('Error updating status:', error);
															}
														});
													}
												</script>

											</div>
										</div>
										<div class="tab-pane fade" id="profile1">
											<div class="card-body">
												<div class="form-validation">
													<form class="needs-validation" novalidate>
														<div class="row">
															<div
																class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom01">Bank Name
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom01"
																			placeholder="Enter bank name.." required>
																		<div class="invalid-feedback">
																			Please enter bank name.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom02">Account Number<span
																			class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom02"
																			placeholder="Your account number.."
																			required>
																		<div class="invalid-feedback">
																			Please enter account number.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom03">IFSC
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom03"
																			placeholder="Please enter IFSC" required>
																		<div class="invalid-feedback">
																			Please enter IFSC.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom04">Branch
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom04"
																			placeholder="Please enter branch name"
																			required>
																		<div class="invalid-feedback">
																			Please enter branch
																		</div>
																	</div>
																</div>
																<div class="mb-3 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom05">Account Type
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<select class="default-select wide form-control"
																			id="validationCustom05">
																			<option data-display="Select account type">
																				Please select account type</option>
																			<option value="html">Current</option>
																			<option value="css">Saving</option>
																		</select>
																		<div class="invalid-feedback">
																			Please select an account type.
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
															<button type="button"
																class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
															<button type="button"
																class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="contact1">
											<div class="card-body">
												<div class="form-validation">
													<form class="needs-validation" novalidate>
														<div class="row" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
															<div
																class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom01">Address
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom01"
																			placeholder="Enter address.." required>
																		<div class="invalid-feedback">
																			Please enter address.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom02">State<span
																			class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom02"
																			placeholder="Your state.." required>
																		<div class="invalid-feedback">
																			Please enter state.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom03">City
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom03"
																			placeholder="Please enter city" required>
																		<div class="invalid-feedback">
																			Please enter City.
																		</div>
																	</div>
																</div>
																<div class="mb-2 row">
																	<label class="col-lg-4 col-form-label"
																		for="validationCustom04">PIN
																		<span class="text-danger">*</span>
																	</label>
																	<div class="col-lg-6">
																		<input type="text" class="form-control"
																			id="validationCustom04"
																			placeholder="Please enter PIN" required>
																		<div class="invalid-feedback">
																			Please enter PIN
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
															<button type="button"
																class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
															<button type="button"
																class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
										<script type="text/javascript">
											$(document).ready(function() {
												$('input[type="checkbox"]').click(function() {
													var inputValue = $(this).attr("value");
													$("." + inputValue).toggle();
												});
											});
										</script>
										<div class="tab-pane fade" id="label" class="card-body">
											<!-- <form action="shipping-label-setting" method="post">@csrf
												<input type="submit">
											</form> -->
											<form class="card-body" action="{{asset('shipping-label-setting')}}" method="post">@csrf

												<div class="row">
													<div class="col-xl-4">
														<div class="filter cm-content-box box-primary">
															<div class="content-title border-0">
																<div class="cpa">
																	Customize shipping label
																</div>

															</div>
															<div class="card-body mt-4 ">

																<div class="tab-content" id="myTabContent">
																	<div class="tab-pane fade show active" id="Viewall-tab-pane" role="tabpanel" aria-labelledby="Viewall-tab" tabindex="0">
																		<div class="menu-tabs-1">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Consignee_Number" value="Consignee_Number" id="flexCheckDefault"
            {{ isset($label_setting) && $label_setting->Consignee_Number ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault">
            Hide Consignee Number
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="order_id" value="order_id" id="flexCheckDefault-1"
            {{ isset($label_setting) && $label_setting->order_id ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-1">
            Hide ShipNick Order ID
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Products_Details" value="Products_Details" id="flexCheckDefault-2"
            {{ isset($label_setting) && $label_setting->Products_Details ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-2">
            Hide Products Details
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Return_Address" value="Return_Address" id="flexCheckDefault-3"
            {{ isset($label_setting) && $label_setting->Return_Address ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-3">
            Hide Return Address
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Weight" value="Weight" id="flexCheckDefault-4"
            {{ isset($label_setting) && $label_setting->Weight ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-4">
            Hide Weight
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Dimensions" value="Dimensions" id="flexCheckDefault-5"
            {{ isset($label_setting) && $label_setting->Dimensions ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-5">
            Hide Dimensions
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Support_Mobile" value="Support_Mobile" id="flexCheckDefault-6"
            {{ isset($label_setting) && $label_setting->Support_Mobile ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-6">
            Support Mobile
        </label>
    </div>
    <pre></pre>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="Support_email" value="Support_email" id="flexCheckDefault-7"
            {{ isset($label_setting) && $label_setting->Support_email ? 'checked' : '' }}>
        <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-7">
            Support Email
        </label>
    </div>
</div>

																	</div>
																	<div class="cm-content-body form excerpt border-top">
																		<div class="card-body">
																			<div class="row align-items-center">
																				<div class="col-xl-12">
																					<h6>Business / Seller Display Name</h6>
																				</div>
																				<div class="col-xl-12">
																					<input type="text" id="name" name="display_name" class="form-control mb-2" value="{{ isset($label_setting) ? $label_setting->display_name : '' }}"  onmouseout="showValue()">
																				</div>
																				<div class="row Support_Mobile">
																					<div class="col-xl-12">
																						<h6>Support Mobile</h6>
																					</div>
																					<div class="col-xl-12">
																						<input type="text" name="supportnumber" class="form-control mb-2"  value="{{ isset($label_setting) ? $label_setting->supportnumber : '' }}">
																					</div>
																				</div>
																				<div class="row Support_email">
																					<div class="col-xl-12">
																						<h6>Support email</h6>
																					</div>
																					<div class="col-xl-12">
																						<input type="text" name="supportemail" class="form-control mb-2"  value="{{ isset($label_setting) ? $label_setting->supportemail : '' }}">
																					</div>
																				</div>
																				<div class="row ">
																					<div class="col-xl-12">
																						<h6>Change Rto address</h6>
																					</div>
																					
																					<div class="col-xl-12">
																					<textarea  id="rtoaddress" name="rtoaddress"   class="form-control mb-2" onmouseout="showAddress()">{{ old('rtoAddress', $label_setting->rtoAddress ?? '') }}</textarea>
																						
																					</div>
																				</div>

																				<script>
																					function showValue() {
																						var name = document.getElementById('name').value;
																						document.getElementById('ans').innerHTML = name;
																						document.getElementById('hello').style.display = "none";
																					}
																					function showAddress() {
																						var name = document.getElementById('rtoaddress').value;
																						document.getElementById('ansrto').innerHTML = name;
																						document.getElementById('hellorto').style.display = "none";
																					}
																				</script>
																				<!-- <div class="col-xl-4">
																					<h6 class="mb-xl-0 text-nowrap ">Link Text</h6>
																				</div>
																				<div class="col-xl-8">
																					<input type="text" class="form-control" placeholder="Menu items">
																				</div> -->
																			</div>
																		</div>
																	</div>


																</div>
															</div>


														</div>
													</div>

													<div class="col-xl-8">
														<div class="filter cm-content-box box-primary">

															<div class="cm-content-body form excerpt rounded-0">
																<div class="card-body ">
																	<h6 class="mb-0 content-title  mb-4 cpa">Current Template</h6>
																	<!-- <p>Add menu items from the column on the left.</p> -->
																	<div class="col-xl-11">
																		<div class="dd" id="nestable">
																			<table class="manifest-table template_border">
																				<tbody>
																					<tr>
																						<td colspan="3" style="text-align:center;">
																							<h3 id="hello"><b>

																									Business / Seller Display Name</b></h3>
																							<h3 id="ans" style="font-weight: 800;"></h3>
																						</td>
																						<td class="text-center">
																							<h6 class="fulfilledby">Fulfilled By: </h6>


																							<img src="{{asset('/img/ecom.jpg')}}" title="Hub Image" style="width: 170px;">

																						</td>
																					</tr>
																					<tr style="line-height: 1.7;">
																						<td colspan="4" class="text-center  " style="border: none;">
																							<?php

																							echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(410010342551, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60% ;margin-top: 2%;" />';
																							?>
																							<br /> <span style="font-size: 25px; margin-left:10%">410010342551</span>
																							<span style="float: left;">
																								<!-- <h6>AMT/AAT/AAT</h6> -->
																							</span>
																							<span style="float: right;" class="order_id">
																								<h6>Order #</h6>
																								<h4><b>123456</b></h4>
																							</span>
																						</td>
																					</tr>
																					<tr style="line-height: 20px;">
																						<td class="address-cell" colspan="3">
																							<p>Deliver To:</p>
																							<h4 class="mb5">name</h4>
																							<p style="line-height: 1.5em;">
																								address<br />
																								city - pincode<br />
																								<span class="Consignee_Number">
																									99999999999
																								</span>

																							</p>
																						</td>

																						<td class="text-center">
																							<h4> <b>COD</b>
																							</h4>
																						</td>
																					</tr>

																					<tr style="border: 1px solid #000;">
																						<td colspan="3" style="border: none; line-height:2em;">
																							<p>Ref./Invoice #: <br />
																								<span class="Dimensions">Size : 5 x 3 x 2 </span>
																							</p>
																						</td>
																						<td style="border: none; line-height:2em;">
																							<p class="Weight">Date: <?php

																													// echo date_format( "d-m-Y");
																													?> <br />
																								Weight: 15
																							</p>
																						</td>
																					</tr>

																					<tr>
																						<td colspan="4" class="Products_Details">
																							<table class="prod-table" style="border: 1px solid black;">
																								<h6 style="margin-top: 5px;margin-bottom: 5px;">In the Package<h6>
																										<thead style="line-height: 1.5em;">
																											<th>Product Name</th>
																											<th>SKU</th>
																											<th>Qty</th>
																											<th class="text-right">Price</th>
																										</thead>
																										<tbody>
																											<tr>
																												<td style="line-height: 1.5em;">item</td>
																												<td style="line-height: 1.5em;"></td>
																												<td>1</td>
																												<td class="text-right">999</td>
																											</tr>
																											<tr>
																												<td colspan="2" class="text-right">
																													<p>Total</p>
																												</td>
																												<td>
																													<p>1</p>
																												</td>
																												<td class="text-right">
																													<p>999</p>
																												</td>
																											</tr>
																										</tbody>
																							</table>
																						</td>
																					</tr>
																					<tr style="line-height: 1.5em;">
																						<td colspan="4" class="address ">
																							<div class="Return_Address">If undelivered, please return to:<br />

																							<h6 id="hellorto"><b>

																							hubname, <br>
																								hub address,
																								hub state,
																								hub city
																								-hub pincode</b>
																									<br>
																								Phone : <b>99999999999</b></h6>
																							<p id="ansrto" style="font-weight: 800;"></p>
																								
																							
																							</p>
																							</div>
																							<span style="font-size:small">
																								<br><b>For any query please contact</b>
																								<span class="Support_Mobile">Mobile:9999999 , </span>
																								<span class="Support_email">Email:support@trenchy.com</span>

																								<hr style="border: 1px solid black; margin:0">
																								This is computer generated document, hence does not required signature
																								<br> <b>Note:</b> All disputes are subject to Delhi jurisdication. Goods once sold will only be
																								taken back or exchanged as per the store's exchange/return policy
																							</span>
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
												<div class="filter cm-content-box box-primary style-1 mb-0 border-0">
													<div class="content-title">
														<input type="submit" value="Save Changes" class="btn btn-secondary my-2">


													</div>
												</div>
											</form>
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