@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')


<div class="content container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-6">
				<h3 class="page-title">Settings</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-2 col-md-4">

			<div class="widget settings-menu">
				<ul>
					<li class="nav-item">
						<a href="{{ asset('/setting') }}" class="nav-link btn btn-primary">
							<i class="far fa-user"></i> <span>Profile Settings</span>
						</a>
					</li>
					<li class="nav-item my-2">
						<a href="{{ asset('/financial-details') }}" class="nav-link btn btn-primary">
							<i class="far fa-list-alt"></i> <span>Financial Details</span>
						</a>
					</li>
					<li class="nav-item my-2">
						<a href="{{ asset('/billing-information') }}" class="nav-link btn btn-primary">
							<i class="far fa-check-square"></i> <span>Billing Information</span>
						</a>
					</li>
					<li class="nav-item my-2">
						<a href="" class="nav-link btn btn-primary">
							<i class="far fa-bell"></i> <span>KYC Details</span>
						</a>
					</li>

					<li class="nav-item my-2">
						<a href="{{ asset('/courier-permissions') }}" class="nav-link btn btn-primary">
							<i class="fa fa-signal"></i> <span>Courier Permissions</span>
						</a>
					</li>


					<li class="nav-item my-2">
						<a href="{{ asset('/change-password') }}" class="nav-link active btn btn-primary">
							<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
						</a>
					</li>
				</ul>
			</div>

		</div>




		<div class="col-xl-9 col-md-8">

			@if(session('status')=="Password update successfully")
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

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Change Password</h5>
				</div>
				<div class="card-body">

					<form method="post" action="{{ asset('/change-password') }}">
						<div class="row form-group">
							<label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
							<div class="col-sm-9">

								<div class="pass-group">
									<input type="password" name="current_password" class="form-control pass-input" required="">
									<!-- <span class="fas fa-eye toggle-password"></span> -->
								</div>
								<!-- <input type="password" class="form-control" name="current_password" placeholder="Enter current password"> -->
							</div>
						</div>

						<div class="row form-group">
							<label for="new_password" class="col-sm-3 col-form-label input-label">New Password</label>
							<div class="col-sm-9">
								<div class="pass-group">
									<input type="password" name="new_password" class="form-control pass-input" required="">
									<!-- <span class="fas fa-eye toggle-password"></span> -->
								</div>
								<!-- <input type="password" class="form-control" name="new_password" placeholder="Enter new password"> -->
							</div>
						</div>

						<div class="row form-group">
							<label for="confirm_password" class="col-sm-3 col-form-label input-label">Confirm new password</label>
							<div class="col-sm-9">
								<!-- <div class="mb-3"> -->

								<div class="pass-group">
									<input type="password" name="confirm_password" class="form-control pass-input" required="">
									<!-- <span class="fas fa-eye toggle-password"></span> -->
								</div>
								<!-- <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your new password"> -->
								<!-- </div> -->
							</div>
						</div>
						<div class="text-end">
							@csrf
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>


@endsection