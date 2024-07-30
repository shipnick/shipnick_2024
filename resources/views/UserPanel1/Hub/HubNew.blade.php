@extends('UserPanel.Layout_1')

@section('bodycontent')





<div class="content container-fluid">
    
	@if(session('status')=="New Hub Added")
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
    
    
    
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">



<h4 class="card-title mt-4">Add Hub Details

</h4>
<form method="post" action="{{ asset('/UPNew_Hub') }}" enctype="multipart/form-data">
<!-- <div class="text-end">
<button type="submit" class="btn btn-outline-primary btn-sm">Return to Hub Details</button>
</div> -->
<div class="row">
<div class="col-md-6">
	<div class="form-group">
	<label>Hub Name*</label>
	<input type="text" name="name" class="form-control" required>
	</div>
	<div class="form-group">
	<label>Mobile Number*</label>
	<input type="text" name="mobile" class="form-control" required>
	</div>
	<div class="form-group">
	<label>State*</label>
	<input type="text" name="state" class="form-control" required>
	</div>
	<div class="form-group">
	<label>Address*</label>
	<textarea rows="5" cols="5" name="address1" class="form-control" placeholder="Enter Address" required></textarea>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
	<label>GSTIN</label>
	<input type="text" name="gstno" class="form-control">
	</div>
	<div class="form-group">
	<label>City*</label>
	<input type="text" name="city" class="form-control" required>
	</div>
	<div class="form-group">
	<label>PIN Code*</label>
	<input type="text" name="pincode" class="form-control" required>
	</div>
	<!-- <div class="form-group">
	<label>Address 2:</label>
	<textarea rows="5" cols="5" class="form-control" placeholder="Enter Address"></textarea>
	</div> -->
	<div class="form-group">
	<label>Hub Pickup Type</label>
		<select class="select" name="deliverytype" title="Delivery Type" required="">
			<option value="Bulk">Delivery Type</option>
			<option value="Express">Express</option>
			<option value="Economy">Economy</option>
			<option value="Bulk" selected="">Bulk</option>
		</select>
	</div>
	<div class="form-group">
	<label>Pickup Store Image</label>
	<input type="file" name="hubimage" class="form-control">
	</div>
</div>
</div>
<div class="text-end mt-4">
	@csrf
<button type="submit" class="btn btn-primary" style="float: left !important;">Add Hub</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ asset('/UPAll_Hubs') }}" class="btn btn-danger" style="float:right;">Back</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>






@endsection