@extends("UserPanel/userpanel_layout1")
@section("userpanel")

<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-12">

						<div class="card mt-3">
							<div class="card-header"> <strong>  Orders Details</strong>
								<!-- <strong>01/01/01/2018</strong> -->
								<span class="float-end">
									<!-- <button type="button" class="btn btn-outline-primary btn-xs">ship</button> -->
									<!-- <button type="button" class="btn btn-outline-primary btn-xs">clone</button> -->
									<a class="btn btn-outline-primary btn-xs" href="/clone-order/{{ $order->Single_Order_Id }}" title="clone">Clone Order</a>
							</div>
							<div class="card-body">
								<div class="row mb-5">
									<div class="mt-4 col-xl-4 col-lg-3 col-md-6 col-sm-12">
										<h6>Order Details</h6>
										<div> <strong>Order No: </strong> {{$order->orderno}}</div>
										<div> <strong>Date: </strong> {{$order->Rec_Time_Date}}</div>
										<div><strong>Payment Type: </strong> {{$order->Order_Type}}</div>
										<div><strong> Order Weight:</strong>{{$order->Actual_Weight}}Kg</div>
										<div><strong>Dimension:</strong>{{$order->Width}}x {{$order->Height}} x {{$order->Length}}</div>
									</div>
									<div class="mt-4 col-xl-4 col-lg-3 col-md-6 col-sm-12">
										<h6>Warehouse Details</h6>
										<div> <strong>{{$order->pickup_name}}</strong> </div>
										<div>{{$order->pickup_address}}</div>
										<div>{{$order->pickup_state}},{{$order->pickup_city}}</div>
										<div>pincode: {{$order->pickup_pincode}}</div>
										<div>Phone: {{$order->pickup_mobile}}</div>
									</div>
									<div class="mt-4 col-xl-4 col-lg-3 col-md-6 col-sm-12">
										<h6>Customer Details</h6>
										<div> <strong>{{$order->Name}}</strong> </div>
										<div>{{$order->Address}}</div>
										<div>{{$order->State}},{{$order->City}}</div>
										<div>pincode: {{$order->Pincode}}</div>
										<div>Phone: {{$order->Mobile}}</div>
									</div>
								</div>
								<div class="">
									<hr>
									<div> <strong>Courier:
										</strong>{{$order->awb_gen_by}}</div>
									<div> <strong>AWB : </strong> {{$order->Awb_Number}}</div>
								</div>
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th class="center text-black">#</th>
												<th class="text-black">Product Name</th>
												<th class="text-black">Quantity</th>
												<th class="right  text-black">Per Product Price</th>
												<th class="center text-black">Product SKU (Optional)</th>
												<th class="right  text-black">Total</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="center">1</td>
												<td class="left strong">{{$order->Item_Name}}</td>
												<td class="left">{{$order->Quantity}}</td>
												<td class="right">{{$order->Invoice_Value}}</td>
												<td class="center">{{$order->sku}}</td>
												<td class="right">{{$order->Total_Amount}}</td>
											</tr>

										</tbody>
									</table>
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-5"> </div>
									<div class="col-lg-4 col-sm-5 ms-auto">
										<table class="table table-clear">
											<tbody>
												<tr>
													<td class="left"><strong>Shipping Charges</strong></td>
													<td class="right">0</td>
												</tr>
												<tr>
													<td class="left"><strong>Tax Amount</strong></td>
													<td class="right">0</td>
												</tr>
												<tr>
													<td class="left"><strong>Grand Total</strong></td>
													<td class="right">{{$order->Total_Amount}}</td>
												</tr>
												<tr>
													<td class="left"><strong>Collectable Amount</strong></td>
													<td class="right"><strong>{{$order->Cod_Amount}}</strong>
														
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
		<!--**********************************
            Content body end
        ***********************************-->

@endsection
