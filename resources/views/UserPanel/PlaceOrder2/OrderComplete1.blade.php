@extends('UserPanel.Layout_1')

@section('bodycontent')

<style>
	#nav a {
		border: 1px solid blue
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	function alllorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_All_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#allordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	alllorders();

	function processorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Pending_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#processordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	processorders();


	function canceledorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Canceled_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#canceledordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	canceledorders();



	function deliveredorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#deliveredordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	deliveredorders();


	function rtoorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Cancel_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#rtoordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	rtoorders();





	function notpickedorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/UPAll_Uploaded_Orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#notpickedordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	notpickedorders();




	function failedorders() {
		$.ajax({
			type: "GET",
			url: "{{ asset('/failed-orders') }}",
			data: {
				crtpage: 'Cancelled'
			},
			success: function(data) {
				$("#failedordersshows").html(data);
			},
			error: function(data) {
				console.log('Error:', data);
			}
		});
	}
	failedorders();
</script>


<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">



			<div class="col xs-12 col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">

					<!--<center><span style="color:red;font-weight:900;font-size:20px">*Under Maintenance Page*</span></center>-->

					<div class="card-body">
						<h4 class="card-title">Orders Details</h4>

						<!--
						<div class="col-md-12 grid-margin stretch-card">
							<div class="card">
								<div class="form-group row">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
										<input class="form-control" placeholder="dd/mm/yyyy" />
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
										<input class="form-control" placeholder="dd/mm/yyyy" />
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

										<div id="the-basics">
											<input class="typeahead" type="text" placeholder="Order ID(s)">
										</div>
									</div>

								</div>
								<div class="form-group row">

									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

										<div id="bloodhound">
											<input class="typeahead" type="text" placeholder="Product Name">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
										<div class="form-group row">
											<div class="col-sm-9">
												<select class="form-control">
													<option>COD</option>
													<option>Prepaid</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

										<button type="submit" class="btn btn-primary mb-4">Apply</button>
									</div>

								</div>

							</div>
						</div>
						-->

						<div class="col-12 grid-margin">
							<div class="template-demo">
								<div class="btn-group" role="group" aria-label="Basic example">
									<div class="btn-group" role="group" aria-label="Basic example" id="nav">
										<a href="#content8" class="btn btn-outline-primary btn-fw">All Orders</a>
										<a href="#content1" class="btn btn-outline-primary btn-fw">Process</a>
										<a href="#content2" class="btn btn-outline-primary btn-fw">Cancelled</a>
										<a href="#content4" class="btn btn-outline-primary btn-fw">Not Picked</a>
										<a href="#content5" class="btn btn-outline-primary btn-fw">Delivered</a>
										<!--<a href="#content6" class="btn btn-outline-primary btn-fw">Intransit</a>-->
										<a href="#content7" class="btn btn-outline-primary btn-fw">RTO</a>
										<a href="#content3" class="btn btn-outline-primary btn-fw">Failed</a>

									</div>
								</div>
							</div>
						</div>
						<form class=" " action="{{asset('/failed-orders-new')}}" method="post">@csrf
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"></h4>

									<div class="form-inline">
										<div class="row">
											<div class="col-md-4">
												<label class="" style="justify-content: flex-start;">From</label>
												<input type="date" name="from" class="form-control  mr-sm-2" placeholder="From" required>
											</div>
											<div class="col-md-4">
												<label class="mr-right" style="justify-content: flex-start;">To</label>
												<div class="input-group mb-2 mr-sm-2">
													<input type="date" name="to" class="form-control" placeholder="To" required>
												</div>
											</div>
											<div class="col-md-4"> <button type="submit" class="btn btn-primary mb-2" style="margin-top:13%">Submit</button> </div>
										</div>


									</div>
								</div>
							</div>
						</form>
					</div>

					<!-- All Orders  -->
					<div id="content9" class="toggle" style="display:none">
						<div class="table-responsive">
							<div id="failedordersshowsnew">
								<h6>Loading...</h6>
							</div>




						</div>
					</div>
					<div id="content8" class="toggle" style="display:none">
						<div class="table-responsive">


							<div id="allordersshows">
								<h6>Loading...</h6>
							</div>


						</div>
					</div>
					<!-- All Orders  -->
					<!--    Process    -->
					<div id="content1" class="toggle">
						<div class="table-responsive">
							<div id="processordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!--    Process    -->
					<!-- Canceled  -->
					<div id="content2" class="toggle" style="display:none">
						<div class="table-responsive">

							<div id="canceledordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!-- Canceled  -->
					<!-- Failed  -->
					<div id="content3" class="toggle" style="display:none">
						<div class="table-responsive">

							<div id="failedordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!-- Failed  -->
					<!-- Not Picked  -->
					<div id="content4" class="toggle" style="display:none">
						<div class="table-responsive">

							<div id="notpickedordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!-- Not Picked  -->
					<!-- Delivered  -->
					<div id="content5" class="toggle" style="display:none">
						<div class="table-responsive">

							<div id="deliveredordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!-- Delivered  -->
					<!-- Intransit -->
					<div id="content6" class="toggle" style="display:none">
						<div class="table-responsive">

							<div id="intransitordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!--   Intransit  -->
					<!-- RTO  -->
					<div id="content7" class="toggle" style="display:none">
						<div class="table-responsive">

							<div id="rtoordersshows">
								<h6>Loading...</h6>
							</div>

						</div>
					</div>
					<!-- RTO  -->


				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<footer class="footer">
	<div class="d-sm-flex justify-content-center justify-content-sm-between">
		<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
	</div>
</footer>
<!-- partial -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
	$(function() {
		$("#start_date").datepicker({
			"dateFormat": "yy-mm-dd"
		});
		$("#end_date").datepicker({
			"dateFormat": "yy-mm-dd"
		});
	});
</script>

<script>
	$(document).on("click", "#filter", function(e) {
		e.preventDefault();
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
		if (start_date == "" || end_date == "") {
			alert("Both date required");
		} else {
			$('#records').DataTable().destroy();
			fetch(start_date, end_date);
		}
	});
</script>
<script>
	$("#nav a").click(function(e) {
		e.preventDefault();
		$(".toggle").hide();
		var toShow = $(this).attr('href');
		$(toShow).show();
	});
</script>

@endsection