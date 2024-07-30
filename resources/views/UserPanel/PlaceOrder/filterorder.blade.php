@extends('UserPanel.Layout_1')

@section('bodycontent')

<style>
    #nav a {
        border: 1px solid blue
    }
</style>



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
                                    <div class="btn-group" role="group" aria-label="Basic example" >
                                        <a href="{{asset('UPAll_Complete_Orders')}}" class="btn btn-outline-primary btn-fw">All Orders</a>
                                        <!-- <a href="#content1" class="btn btn-outline-primary btn-fw">Process</a>
                                        <a href="#content2" class="btn btn-outline-primary btn-fw">Cancelled</a>
                                        <a href="#content4" class="btn btn-outline-primary btn-fw">Not Picked</a>
                                        <a href="#content5" class="btn btn-outline-primary btn-fw">Delivered</a>
                                        
                                        <a href="#content7" class="btn btn-outline-primary btn-fw">RTO</a>
                                        <a href="#content3" class="btn btn-outline-primary btn-fw">Failed</a> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form class=" " action="{{asset('/failed-orders-new')}}" method="post">@csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"></h4>

                                        <div class="form-inline">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="" style="justify-content: flex-start;">From</label>
                                                    <input type="date" name="from" class="form-control  mr-sm-2" placeholder="" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="" style="justify-content: flex-start;">To</label>
                                                    <div class="input-group mb-2 mr-sm-2">
                                                        <input type="date" name="to" class="form-control" placeholder="" required>
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
                        <div  class="toggle" >
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="select-all" onclick="toggle(this);" /> AWB No</th>
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
                                                <td>
                                                    <label>
                                                        <input class="checkbox" name="selectedorder[]" value="<?= $param->Awb_Number ?>" type="checkbox"> {{ $param->Awb_Number }}
                                                    </label>
                                                </td>
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