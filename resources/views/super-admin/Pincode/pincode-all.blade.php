@extends('super-admin.Layout2')

@php(error_reporting(1))
@section('bodycontent')
<div class="content-body">
			<div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Pincode</a></li>
					</ol>
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Pincode</h4>
							</div>
							<div class="card-body">
								<div class="basic-form">
									<form class="form-valide-with-icon needs-validation" action="super-picode-add" method="post" enctype="multipart/form-data" novalidate>@csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-3">
                                    <label class="form-label">Select Courier</label>
                                    <select class="default-select form-control wide w-100" name="courier" required>
                                        <option value="" disabled selected>Select...</option>
                                        <option value="ecom">Ecom</option>
                                        <option value="xpress">xpress</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                                    <label for="formFile" class="form-label">Upload orders excel file (CSV only)</label>
                                    <input type="file" id="formFile" name="bulkpincode" class="form-control" accept=".csv" onchange="checkFileContent()" required />
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <div id="error_msg" style="color:red;"></div>
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-map me-3 scale5"></i> Submit
                                </button>
                            </div>
                        </form>
								</div>

							</div>
						</div>
						
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header d-flex flex-wrap border-0 pb-0">
								<div class="me-auto mb-sm-0 mb-3">
									<h4 class="card-title mb-2">Pincode Details</h4>
									<!-- <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span> -->
								</div>
								
							</div>
							<hr>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-responsive-md">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Courier</th>
												<th>Total Pincode</th>
												
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											 @foreach($pincode as $data)
                                <tr>
                                    <td>1</td>
                                    <td>{{$data->courier}}</td>
                                    <td>{{$data->total_count}}</td>
                                    <td><a href="{{('pincode-bulk-delete')}}/{{$data->id}}" title="Click here to edit hub detail"><i class="far fa-edit me-2"></i>Delete</a>

                                    </td>

                                </tr>
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




@endsection