@extends('Admin.Layout')

@section('bodycontent')



<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">


			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Merchants Summary
							<center>

								@if(session('status')=="New Client Added")
								<span class="text-primary" style="font-size:20px;">
									New client added
								</span>
								@elseif(session('status'))
								<span class="text-primary" style="font-size:20px;">
									{{ session('status') }}
								</span>
								@endif
							</center>
						</h4>
						<form class="form-group row" method="post" action="{{ asset('/merchant-summary') }}">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label>From</label>
								<input class="form-control" name="startdatefrom"  />
							</div>

							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<label>To</label>
								<input class="form-control" name="enddatefrom"  />
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

								<button type="submit" class="btn btn-primary mb-4 my-4">Apply</button>
							</div>

						</form>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											Merchant
										</th>
										<th>
											Name
										</th>
										<th>
											Total Amount
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>  <img src="{{asset('Admin/images/faces/face1.jpg')}}" height="50px"/></th>
										<th>Total</th>
										<th>0</th>
									</tr>
								</tbody>
							</table>
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
@endsection