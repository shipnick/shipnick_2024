@extends('Admin.Layout')

@section('bodycontent')



<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">


			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Remittance</h4>
						<div class="template-demo">
							
							<button type="file" class="btn btn-outline-danger btn-icon-text file-upload-browse">
								<i class="ti-upload btn-icon-prepend"></i>
								Upload 
							</button>

							<div class="form-group" style="display: none;">

								<input type="file" class="file-upload-default" name="">
								<div class="input-group col-xs-12">	
								</div>
							</div>

						</div>
						@if(session('status')=="MIS Upload Successfully")
						<section class="comp-section" id="returnmsgbox">
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{ session('status') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						</section>
						@elseif(session('status'))
						<section class="comp-section" id="returnmsgbox">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{ session('status') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						</section>
						@endif

						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>
											S. No.
										</th>
										<th>
											 Date
										</th>
										<th>
											Report
										</th>
										<th>
											Download
										</th>
									</tr>
								</thead>
								
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