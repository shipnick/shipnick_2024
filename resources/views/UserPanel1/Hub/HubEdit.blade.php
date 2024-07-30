@extends('UserPanel.Layout_1')

@section('bodycontent')


<div class="content container-fluid">
    
                
            @if(session('status')=="Hub Details Update")
            <section class="comp-section" id="returnmsgbox">
            	<div class="alert alert-success alert-dismissible fade show" role="alert">
                	{{ session('status') }}
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </section>
            @elseif(session('status'))
            <section class="comp-section" id="returnmsgbox">
            	<div class="alert alert-danger alert-dismissible fade show" role="alert">
                	work{{ session('status') }}
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </section>
            @endif
    
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">




<div class="row">
    <div class="col-md-4"><h4 class="card-title">Edit Hub <span class="text-primary">{{ $params->hub_code }}</span> Details</h4></div>
    <div class="col-md-4">
        <center>

        </center>
    </div>
    <div class="col-md-4">
        <form method="post" action="{{ asset('/UPHub_Delete') }}">
            <input type="hidden" name="hubid" value="{{ $params->hub_id }}">
            @csrf
            <button type="submit" class="btn btn-danger" style="width:100%" onclick="return confirm('Are you sure Delete this orders?')">Delete Hub</button>
        </form>
    </div>
</div>

<br>


<form method="post" action="{{ asset('/UPHub_Edit_Update') }}" enctype="multipart/form-data">
<div class="row">
<div class="col-md-6">
    <div class="form-group">
    <label>Hub Name*</label>
    <input type="text" name="name" value="{{ $params->hub_name }}" class="form-control">
    </div>
    <div class="form-group">
    <label>Mobile Number*</label>
    <input type="text" name="mobile" value="{{ $params->hub_mobile }}" class="form-control">
    </div>
    <div class="form-group">
    <label>State*</label>
    <input type="text" name="state" value="{{ $params->hub_state }}" class="form-control">
    </div>
    <div class="form-group">
    <label>Address*</label>
    <textarea rows="5" cols="5" name="address1" class="form-control" placeholder="Enter Address">{{ $params->hub_address1 }}</textarea>
    </div>
    <div class="form-group">
    <label>Hub Pickup Type</label>
        <select class="select" name="deliverytype" title="Delivery Type" required="">
            @if($params->hub_deliverytype=="Economy")
                <option>Delivery Type</option>
                <option value="Economy" selected="">Economy</option>
                <option value="Bulk">Bulk</option>
            @elseif($params->hub_deliverytype=="Bulk")
                <option>Delivery Type</option>
                <option value="Economy">Economy</option>
                <option value="Bulk" selected="">Bulk</option>
            @else
            <option>Delivery Type</option>
            <option value="Economy">Economy</option>
            <option value="Bulk">Bulk</option>
            @endif
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
    <label>GSTIN</label>
    <input type="text" name="gstno" value="{{ $params->hub_gstno }}" class="form-control">
    </div>
    <div class="form-group">
    <label>City*</label>
    <input type="text" name="city" value="{{ $params->hub_city }}" class="form-control">
    </div>
    <div class="form-group">
    <label>PIN Code*</label>
    <input type="text" name="pincode" value="{{ $params->hub_pincode }}" class="form-control">
    </div>
    <!-- <div class="form-group">
    <label>Address 2:</label>
    <textarea rows="5" cols="5" name="address2" class="form-control" placeholder="Enter Address">{{ $params->hub_address2 }}</textarea>
    </div> -->
    <div class="form-group">
    
    <img src="{{ asset('HubDetails') }}/{{ $params->hub_folder }}/{{ $params->hub_img }}" title="Hub Image" style="width:200px;height:200px;">
    <label>Pickup Store Image</label>
    <input type="file" name="hubimage" class="form-control">
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-4">
        @csrf
        <input type="hidden" name="hubid" value="{{ $params->hub_id }}">
        <input type="hidden" name="hubfolder" value="{{ $params->hub_folder }}">
        <button type="submit" class="btn btn-primary" style="width:80%">Update Hub Details</button>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <a href="{{ asset('/UPAll_Hubs') }}" class="btn btn-danger">Back</a>
    </div>
</div>


</form>


</div>
</div>
</div>
</div>
</div>


@endsection
