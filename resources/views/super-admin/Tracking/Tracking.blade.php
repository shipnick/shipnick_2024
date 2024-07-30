@extends('super-admin.Layout')

@section('bodycontent')
<?php
error_reporting(1);
?>
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">


			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<!--  -->
					<div class="col-md-12 my-5">

						<section class="panel">
							<div class="panel-body">
								<form method="POST" action="{{ asset('/super-order-tracking-no') }}">
									<div class="row">
										<div class="col-md-6">
											<input type="text" name="orderno" class="form-control" placeholder="Write AWB Number (Use , Between 2 Awb Numbers)" required>
										</div>
										<div class="col-md-2">
											@csrf
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</div>
								</form>
								<div class="row" style="margin-top:15px !important">
									<div class="col-md-12 text-danger">
										@php($errosc = 0)
										@foreach($params as $param)
										@if($param['localstatus'] == 1)
										{{ $param['tracking_number'] }},
										@php($errosc++)
										@endif
										@endforeach
										@if($errosc)
										AWB Not Found
										@endif
									</div>
								</div>
							</div>
						</section>

					</div>
					<!--  -->

					<!-- start: page -->
					<div class="row">
						<div class="col-md-12 col-lg-12 col-xl-12">
							<section class="panel">
								<div class="panel-body">
									<div class="row">
										<!--  -->






										<?php
										$statusdetails = array('PP' => 'Pending Pickup', 'IT' => 'In Transit', 'EX' => 'Exception', 'OFD' => 'Out For Delivery', 'DL' => 'Delivered', 'RT' => 'RTO', 'RT-IT' => 'RTO In Transit', 'RT-DL' => 'RTO Delivered');
										?>


										@foreach($params as $param)
										@if($param['localstatus'] != 1)
										<div class="row">
											<div class="col-sm-12">
												<div class="card card-table">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table">
																<thead class="thead-light">
																	<tr>
																		<th>AWB No </th>
																		<th>Last Status</th>
																		<th>Current Location</th>
																		<th>Status</th>
																		<th>Remark</th>
																	</tr>
																</thead>
																<tbody>
																	<tr class="gradeX">
																		<td>{{ $param['tracking_number'] }}</td>
																		<td>{{ $param['statusdate'] }}</td>
																		<td>{{ $param['location'] }}</td>
																		<td></td>
																		<td>{{ $param['msg'] }}</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endif
										@endforeach










										<!--  -->
									</div>
								</div>
							</section>
						</div>


					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection


<!-- Header -->
@section('HeaderExtraFiles')

<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme.css') }}" />

<!-- Skin CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/skins/default.css') }}" />

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme-custom.css') }}">

<!-- Head Libs -->
<script src="{{ asset('Admin/assets/vendor/modernizr/modernizr.js') }}"></script>
@endsection
<!-- Header -->

<!-- Footer -->
@section('FooterExtraFiles')
<!-- Vendor -->
<script src="{{ asset('Admin/assets/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

<!-- Specific Page Vendor -->
<script src="{{ asset('Admin/assets/vendor/select2/select2.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('Admin/assets/javascripts/theme.js') }}"></script>

<!-- Theme Custom -->
<script src="{{ asset('Admin/assets/javascripts/theme.custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('Admin/assets/javascripts/theme.init.js') }}"></script>


<!-- Examples -->
<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.default.js') }}"></script>
<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
@endsection
<!-- Footer -->