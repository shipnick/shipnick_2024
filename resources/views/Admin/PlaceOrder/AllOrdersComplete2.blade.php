@extends('Admin.Layout')

@section('bodycontent')

<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col xs-12 col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">All Orders</h4>
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
						<div class="col-12 grid-margin">
							<div class="template-demo">
								<div class="btn-group" role="group" aria-label="Basic example">
									<div class="btn-group" role="group" aria-label="Basic example" id="nav">
										<a href="#content1" class="btn btn-outline-primary btn-fw">Process</a>
										<a href="#content2" class="btn btn-outline-primary btn-fw">Cancelled</a>
										<a href="#content3" class="btn btn-outline-primary btn-fw">Failed</a>
										<a href="#content4" class="btn btn-outline-primary btn-fw">Not Picked</a>
										<a href="#content5" class="btn btn-outline-primary btn-fw">Delivered</a>
										<a href="#content6" class="btn btn-outline-primary btn-fw">Intransit</a>
										<a href="#content7" class="btn btn-outline-primary btn-fw">RTO</a>

									</div>
								</div>

							</div>
						</div>

						<div id="content1" class="toggle">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!--<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>-->
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
					<button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="cancelorders">Cancel Orders</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>AWB No</th>
											<th>Order No</th>
											<th>Courier Name</th>
											<th>Customer Name</th>
											<th>Client Name</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>Destination Pincode</th>
											<th>COD Amt</th>
											<th>Upload Date</th>
											<th>Current Status</th>
										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<tr class="gradeX">
											<!-- <td>{{ $param->order_username }}</td> -->
											<td>{{ $param->Awb_Number }}</td>
											<td>{{ $param->orderno }}</td>
											<td>{{ $param->awb_gen_by }}</td>
											<td>
												@foreach($allusers as $alluser)
												@if($alluser->id == $param->User_Id)
												{{ $alluser->name }}
												@endif
												@endforeach
											</td>
											<td>{{ $param->Name }}</td>
											<td>{{ $param->Mobile }}</td>
											<td>{{ $param->Address }}</td>
											<td>{{ $param->Pincode }}</td>
											<td>{{ $param->Cod_Amount }}</td>
											<td>{{ $param->Rec_Time_Date }}</td>
											<td>
												@if($param->order_status_show == "Cancel")
												{{ $param->order_status_show }}ed
												@elseif($param->order_status_show == "Unexpected")
												Unknown Error
												@elseif($param->order_status_show == "Upload")
												Not Picked
												@else
												{{ $param->order_status_show }}
												@endif
											</td>
										</tr>
										@php($i++)
										@endforeach
									</tbody>
								</table>
							</div>

						</div>
						<!-- b2b calculator  -->
						<div id="content2" class="toggle" style="display:none">
							<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!--<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>-->
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
					
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>AWB No</th>
											<th>Order No</th>
											<th>Courier Name</th>
											<th>Customer Name</th>
											<th>Client Name</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>Destination Pincode</th>
											<th>COD Amt</th>
											<th>Upload Date</th>
											<th>Current Status</th>
										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<tr class="gradeX">
											<td>{{ $param->Awb_Number }}</td>
											<td>{{ $param->orderno }}</td>
											<td>{{ $param->awb_gen_by }}</td>
											<td>
												@foreach($allusers as $alluser)
												@if($alluser->id == $param->User_Id)
												{{ $alluser->name }}
												@endif
												@endforeach
											</td>
											<td>{{ $param->Name }}</td>
											<td>{{ $param->Mobile }}</td>
											<td>{{ $param->Address }}</td>
											<td>{{ $param->Pincode }}</td>
											<td>{{ $param->Cod_Amount }}</td>
											<td>{{ $param->Rec_Time_Date }}</td>
											<td>
												@if($param->order_cancel == "1")
												Canceled
												@else
												@if($param->order_status_show == "Cancel")
												{{ $param->order_status_show }}ed
												@elseif($param->order_status_show == "Unexpected")
												Unknown Error
												@elseif($param->order_status_show == "Upload")
												Not Picked
												@else
												{{ $param->order_status_show }}
												@endif
												@endif
											</td>

										</tr>
										@php($i++)
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<!-- internation calculator  -->
						<div id="content3" class="toggle" style="display:none">
							<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!--<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>-->
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
				
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Order No</th>
											<th>Customer Name</th>
											<th>Client Name</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>Destination Pincode</th>
											<th>COD Amt</th>
											<th>Upload Date</th>
										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<tr class="gradeX">
											<!-- <td>{{ $param->Awb_Number }}</td> -->
											<td>{{ $param->orderno }}</td>
											<!-- <td>{{ $param->awb_gen_by }}</td> -->
											<td>
												@foreach($allusers as $alluser)
												@if($alluser->id == $param->User_Id)
												{{ $alluser->name }}
												@endif
												@endforeach
											</td>
											<td>{{ $param->Name }}</td>
											<td>{{ $param->Mobile }}</td>
											<td>{{ $param->Address }}</td>
											<td>{{ $param->Pincode }}</td>
											<td>{{ $param->Cod_Amount }}</td>
											<td>{{ $param->Rec_Time_Date }}</td>

										</tr>
										@php($i++)
										@endforeach
									</tbody>
								</table>
							</div>

						</div>
						<div id="content4" class="toggle" style="display:none">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!--<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>-->
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
					<button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="cancelorders">Cancel Orders</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>AWB No</th>
											<th>Order No</th>
											<th>Courier Name</th>
											<th>Customer Name</th>
											<th>Client Name</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>Destination Pincode</th>
											<th>COD Amt</th>
											<th>Upload Date</th>
											<th>Current Status</th>

										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<tr class="gradeX">
											<td>{{ $param->Awb_Number }}</td>
											<td>{{ $param->orderno }}</td>
											<td>{{ $param->awb_gen_by }}</td>
											<td>
												@foreach($allusers as $alluser)
												@if($alluser->id == $param->User_Id)
												{{ $alluser->name }}
												@endif
												@endforeach
											</td>
											<td>{{ $param->Name }}</td>
											<td>{{ $param->Mobile }}</td>
											<td>{{ $param->Address }}</td>
											<td>{{ $param->Pincode }}</td>
											<td>{{ $param->Cod_Amount }}</td>
											<td>{{ $param->Rec_Time_Date }}</td>
											<td>
												@if($param->Awb_Number != '' && $param->order_status_show == "Upload")
												Picking Soon
												@elseif($param->order_status_show == "Cancel")
												{{ $param->order_status_show }}ed
												@elseif($param->order_status_show == "Unexpected")
												Unknown Error
												@elseif($param->order_status_show == "Upload")
												Not Picked
												@else
												{{ $param->order_status_show }}
												@endif


											</td>
										</tr>
										@php($i++)
										@endforeach
									</tbody>
								</table>
							</div>

						</div>
						<div id="content5" class="toggle" style="display:none">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!--<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>-->
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
				
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>AWB No</th>
											<th>Order No</th>
											<th>Courier Name</th>
											<th>Customer Name</th>
											<th>Client Name</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>Destination Pincode</th>
											<th>COD Amt</th>
											<th>Upload Date</th>
											<th>Current Status</th>
										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<tr class="gradeX">
											<td>{{ $param->Awb_Number }}</td>
											<td>{{ $param->orderno }}</td>
											<td>{{ $param->awb_gen_by }}</td>
											<td>
												@foreach($allusers as $alluser)
												@if($alluser->id == $param->User_Id)
												{{ $alluser->name }}
												@endif
												@endforeach
											</td>
											<td>{{ $param->Name }}</td>
											<td>{{ $param->Mobile }}</td>
											<td>{{ $param->Address }}</td>
											<td>{{ $param->Pincode }}</td>
											<td>{{ $param->Cod_Amount }}</td>
											<td>{{ $param->Rec_Time_Date }}</td>
											<td>
												@if($param->order_status_show == "Cancel")
												{{ $param->order_status_show }}ed
												@elseif($param->order_status_show == "Unexpected")
												Unknown Error
												@elseif($param->order_status_show == "Upload")
												Not Picked
												@else
												{{ $param->order_status_show }}
												@endif
											</td>

										</tr>
										@php($i++)
										@endforeach
									</tbody>
								</table>
							</div>

						</div>
						<div id="content6" class="toggle" style="display:none">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!--<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>-->
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
					<button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="cancelorders">Cancel Orders</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Order No.</th>
											<th>Customer</th>
											<th>Client</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>COD Amt</th>
											<th>Date of Upload</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>

						</div>
						<div id="content7" class="toggle" style="display:none">

							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>AWB No</th>
											<th>Order No</th>
											<th>Courier Name</th>
											<th>Customer Name</th>
											<th>Client Name</th>
											<th>Client Mobile</th>
											<th>Client Address</th>
											<th>Destination Pincode</th>
											<th>COD Amt</th>
											<th>Upload Date</th>
											<th>Current Status</th>
										</tr>
									</thead>
									<tbody>
										@php($i = 1)
										@foreach($params as $param)
										<tr class="gradeX">
											<td>{{ $param->Awb_Number }}</td>
											<td>{{ $param->orderno }}</td>
											<td>{{ $param->awb_gen_by }}</td>
											<td>
												@foreach($allusers as $alluser)
												@if($alluser->id == $param->User_Id)
												{{ $alluser->name }}
												@endif
												@endforeach
											</td>
											<td>{{ $param->Name }}</td>
											<td>{{ $param->Mobile }}</td>
											<td>{{ $param->Address }}</td>
											<td>{{ $param->Pincode }}</td>
											<td>{{ $param->Cod_Amount }}</td>
											<td>{{ $param->Rec_Time_Date }}</td>
											<td>
												@if($param->order_status_show == "Cancel")
												{{ $param->order_status_show }}ed
												@elseif($param->order_status_show == "Unexpected")
												Unknown Error
												@elseif($param->order_status_show == "Upload")
												Not Picked
												@else
												{{ $param->order_status_show }}
												@endif
											</td>
										</tr>
										@php($i++)
										@endforeach
									</tbody>
								</table>
							</div>

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
<script>
	$("#nav a").click(function(e) {
		e.preventDefault();
		$(".toggle").hide();
		var toShow = $(this).attr('href');
		$(toShow).show();
	});
</script>
@endsection