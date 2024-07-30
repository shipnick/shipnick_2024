@extends('Admin.Layout')

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
		<div class="col-xl-3 col-md-4">

			<div class="widget settings-menu">
				<ul style="list-style-type:none;">
					<li class="nav-item">
						<a href="{{ asset('/client-setting/'.$id) }}" class="nav-link active">
							<i class="far fa-user"></i> <span>Profile Settings</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ asset('/client-financial-details/'.$id) }}" class="nav-link">
							<i class="far fa-list-alt"></i> <span>Financial Details</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ asset('/client-billing-information/'.$id) }}" class="nav-link">
							<i class="far fa-check-square"></i> <span>Billing Information</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="" class="nav-link">
							<i class="far fa-bell"></i> <span>KYC Details</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{ asset('/client-courier-permissions/'.$id) }}" class="nav-link">
							<i class="fa fa-signal"></i> <span>Courier Permissions</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ asset('/client-change-password/'.$id) }}" class="nav-link">
							<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
						</a>
					</li>
				</ul>
			</div>

		</div>




		<div class="col-xl-9 col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Change Password
						<span class="text-primary" style="float: right;">{{ session('status') }}</span>
					</h5>
				</div>
				<div class="card-body">

					<form method="post" action="{{ asset('/change-password') }}">
						<div class="row form-group">
							<label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
							<div class="col-sm-9">

								<div class="pass-group">
									<input type="password" name="current_password" class="form-control pass-input">
									<!-- <span class="fas fa-eye toggle-password"></span> -->
								</div>
								<!-- <input type="password" class="form-control" name="current_password" placeholder="Enter current password"> -->
							</div>
						</div>

						<div class="row form-group">
							<label for="new_password" class="col-sm-3 col-form-label input-label">New Password</label>
							<div class="col-sm-9">
								<div class="pass-group">
									<input type="password" name="new_password" class="form-control pass-input">
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
									<input type="password" name="confirm_password" class="form-control pass-input">
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