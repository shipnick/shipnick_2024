
<style>
	#hidden_div {
		display: none;
	}
	
</style>
<style>
	.btn-outline-primary {
    color: var(--primary);
    border-color: var(--primary);
}
</style>

<script>
	function showDiv(divId, element) {
		document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
	}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	document.getElementById('searchForm1').addEventListener('submit', function(e) {
		e.preventDefault();
		var formData = new FormData(this);

		fetch(this.action, {
				method: 'POST',
				body: formData
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Network response was not ok');
				}
				const contentType = response.headers.get('content-type');
				if (contentType && contentType.includes('application/json')) {
					return response.json();
				} else {
					return response.text(); // Handle non-JSON responses
				}
			})
			.then(data => {
				// console.log(data);
				$('#Ofdordersshows').html(data);
				// Handle the response data
			})
			.catch(error => console.error('Error:', error));
	});
</script>

</div>

<div class="row">
	<div class="col-xl-12 tab-content">
		<div class="tab-pane fade show active" id="AllTransaction" role="tabpanel" aria-labelledby="transaction-tab">
			<div class="row p"  style="display:none">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="row">

								<div class="col-lg-12 order-lg-1">
									<h4 class="mb-3">Date Range</h4>


									<form id="searchForm1" action="{{ asset('/ofd-orders') }}" method="post">
										<div class="row">
											<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 mb-1">
												<div class="example">
													<p class="mb-1">From date - To date</p>
													<!--<input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/12/2023 - 01/12/2023">-->
													<div class="row">
														<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
															<input type="date" class="form-control" name="from" value="01/12/2023">
														</div>
														<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 mb-3">
															<input type="date" class="form-control" name="to" value="31/12/2023">
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
												<label class="form-label">Courier</label>
												<select class="default-select form-control wide w-100" name="courier">
													<option value="">Select...</option>
													<option value="Ecom">Ecom</option>
													<option value="Xpressbee">Xpressbee</option>
												</select>

											</div>

											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
												<label for="zip" class="form-label">Waybill Number</label>
												<!--<input type="text" class="form-control" id="waybill" placeholder="" required="">-->
												<input type="text" class="form-control" id="waybill" placeholder="AWB Number" name="awb">
											</div>
											
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
												<label for="product_name" class="form-label">Product Name</label>
												
												<input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name">
											</div>

											<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 mb-3">
												<label class="form-label">order Type</label>
												<select class="default-select form-control wide w-100" name="order_type">
													<option value="">Select...</option>
													<option value="COD">COD</option>
													<option value="Prepaid">Prepaid</option>
												</select>
											</div>
										</div>



										<hr class="mb-4">
										<!--<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Download Report</button>-->
										<button type="submit" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Search</button>
										@csrf
										<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Clear</button>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			

			<form method="post" action="{{ asset('/filter-selected-order') }}">@csrf
				<div>
				

					<div class="d-flex justify-content-start align-items-center">
						<!--<button name="currentbtnname" value="shippinglabel" type="submit" class="btn btn-outline-primary mt-1 me-3 mb-3 btn-sm"><i class="fa fa-calendar me-1"></i>Print Label</button>-->
						<!--<button name="currentbtnname" value="cancelorders" type="submit" class="btn btn-outline-primary mt-1 me-3 mb-3 btn-sm"><i class="fa fa-times-circle me-1"></i>Cancel Orders</button>-->
						<button id="ofdExcelBtn" class="btn btn-outline-secondary btn-sm mb-2">
							<i class="fa fa-download me-1"></i>Export
						</button>

					</div>

				</div>
				<style>
					.table td {
					    font-weight: 700;
						border-color: #e6e6e6;
						hidden_div padding: 0px 10px;
						
					}
				</style>
				<!-- style="background-color: #8089a4;"  -->
				<div class="table-responsive fs-13">

					<table class="table card-table display mb-4 dataTablesCard text-black" id="example1">
						<thead style="background-color:#17a2b89c;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
							<tr>
								<th>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="toggle(this); " style="border-color: black;">
										<label class="form-check-label" for="checkAll">
										</label>
									</div>
								</th>
								<th>AWB #</th>
								<th>ID Orders</th>
								<th>Orders Type</th>
								<th>Date of upload</th>
								<th>Customer details</th>
								<th>Customer address</th>
								<th>Courier</th>
								<th>Status</th>
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							@php($i = 1)
							@foreach($params as $param)
							<tr>
								<td>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="selectedorder[]" value="<?= $param->Awb_Number ?>" style="border-color: black;">
									</div>
								</td>
								<td><span>{{ $param->Awb_Number }}</span></td>
								<td><span>{{ $param->ordernoapi }}</span></td>
								<td><span>{{ $param->Order_Type }}</span></td>
								<td>
									<span>{{ date('Y-m-d', strtotime($param->Last_Time_Stamp)) }}</span><br />
									<span>
										{{ date('H:i:s', strtotime($param->Last_Time_Stamp)) }}
									</span>
								</td>
								<td>
									<div class="d-flex align-items-center">
										<div>
											<h6 class="fs-13 mb-0 text-nowrap"><span>{{ Str::limit($param->Name, 20) }}</span><br />
												<span>{{$param->Mobile}}</span>
											</h6>
										</div>
									</div>
								</td>
								<td><span> {{ Str::limit($param->Address, 20) }}</span></td>
								<td><span>{{ $param->awb_gen_by }}</span></td>
								<td>
									@if($param->showerrors=='Upload')
									<a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Manifested</a>

									@else
									<a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">{{ Str::limit($param->showerrors, 20) }}</a>

									@endif

								</td>
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


											<a class="dropdown-item" href="{{ asset('/UPAll_Cancel_Orders_Now/'.$param->Awb_Number) }}" title="Cancel">
												<i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Order</a>

											<form action=""></form>


											<form action="Labels_Print" method="post">
												@csrf
												<input type="hidden" name="awbnoisa" value="{{ $param->Awb_Number }}">
												<button class="dropdown-item" type="submit"><i class="las la-info-circle scale5 me-3 "></i>Print Label</button>
											</form>
											<a class="dropdown-item" href="#" title="Cancel">
												<i class="las fa-file-invoice  scale5 me-3"></i>Print invoice</a>
											<a class="dropdown-item" href="#" title="Cancel">
												<i class="las fa-file-invoice  scale5 me-3"></i>Print manifest</a>
										</div>
									</div>
								</td>
							</tr>
							@php($i++)
							@endforeach
						</tbody>


					</table>
					<div id="newpaginationnew6">
						{{$params->links('pagination::bootstrap-4')}}
					</div>
				</div>
				<script>
					document.getElementById('ofdExcelBtn').addEventListener('click', function(event) {
						event.preventDefault(); // Prevent the default form submission
						document.getElementById('downloadExcelForm').submit(); // Submit the form manually
					});
				</script>
				<script>
					document.getElementById('ofdExcelBtn').addEventListener('click', function() {
						var cfromdate = "{{ $cfromdate }}";
						var ctodate = "{{ $ctodate }}";
						var ftype = "Excel";

						var url = "{{ asset('/today-ofd-orders') }}";
						url += "?cfromdate=" + encodeURIComponent(cfromdate);
						url += "&ctodate=" + encodeURIComponent(ctodate);
						url += "&ftype=" + encodeURIComponent(ftype);

						window.location.href = url;
					});
				</script>
				<script>
					function toggle(source) {
						var checkboxes = document.querySelectorAll('input[type="checkbox"]');
						for (var i = 0; i < checkboxes.length; i++) {
							if (checkboxes[i] != source)
								checkboxes[i].checked = source.checked;
						}
					}
				</script>
			</form>
		</div>
		

	</div>
</div>
