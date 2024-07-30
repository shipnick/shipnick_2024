@extends('Admin.Layout')
@section('bodycontent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Switch -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- 
<label class="switch">
  <input type="checkbox">
  <span class="slider round"></span>
</label>

<label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label>
 -->
<!-- Switch -->


<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Merchant Add Courier Services
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
</h3>
</div>
<div class="col-auto">
<!-- <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
<i class="fas fa-filter"></i>
</a> -->
</div>
</div>
</div>




<div id="add_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Create new client account</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
      <form method="POST" action="{{ asset('/New_Client') }}">
        <!-- <center><h3>Item Details</h3></center> -->
        <br>
        	<div class="col-md-12">
        		<input type="text" name="name" class="form-control" placeholder="Name" required="">
        	</div><br>
        	<div class="col-md-12">
        		<input type="email" name="email" class="form-control" placeholder="Email" required="">
        	</div><br>
        	<div class="col-md-12">
        		<input type="number" name="mobile" class="form-control" placeholder="Mobile" required="">
        	</div><br>
<!--         	<div class="col-md-12">
        		<input type="text" name="password" class="form-control" placeholder="Password" required="">
        	</div> -->
<div class="pass-group">
<input type="password" name="password" class="form-control pass-input" placeholder="Password">
<span class="fas fa-eye toggle-password"></span>
</div>

            <br>
        <div class="col-md-12 text-center"><br>
        	<div class="col-md-12">
        		@csrf
                <button class="btn btn-primary submit-btn">Upload</button>
        	</div>
            <br><br>
        </div>
      </form>

</div>
</div>
</div>
</div>




<div id="filter_inputs" class="card filter-card">
<div class="card-body pb-0">
<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>Search filter</label>
<select class="select">
<option>AWB Number</option>
<option>Customer Name</option>
<option>Order ID</option>
<option>Product Details</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>NDR Status</label>
<select class="select">
<option>Customer Wants Open Delivery Package</option>
<option>Customer Refused</option>
<option>Customer Not Available</option>
<option>Cash Not Available</option>
<option>Customer Out of Station</option>
<option>Door Locked</option>
<option>Door Locked</option>
<option>No Such Customer but Address correct</option>
<option>Out of Delivery Area(ODA)</option>
<option>Requested Delay Delivery</option>
<option>Restricted Entry</option>
<option>Self Collection Requested By Customer</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Delivery By</label>
<select class="select">
<option>InTargos</option>
<option>Nimbus</option>
</select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Delivery Mode</label>
<select class="select">
<option>COD</option>
<option>Prepaid</option>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-stripped table-hover datatable">
<thead class="thead-light">
<tr>
	<th>Courier ID</th>
	<th>Courier Name</th>
	<th>Logo</th>
    <th class="text-center">Active Courier Status</th>
</tr>
</thead>
<tbody>
@php($i = 1)
@foreach($params as $param)
<tr class="gradeX">
<td>{{ $param->courierid }}</td>
<td>{{ $param->name }}</td>
<td>
    <img src="{{ asset('/Couriers') }}/{{ $param->email }}/{{ $param->logo }}" style="width:50px">
</td>
<td class="text-center">
@if($param->name == "Intargos")
    @if($users->Intargos)
        <label class="switch" onchange='statusactive("{{ $param->courierid }}")'>
        <input type="checkbox" checked>
        <span class="slider round"></span>
        </label>
    @else
        <label class="switch" onchange='statusactive("{{ $param->courierid }}")'>
        <input type="checkbox">
        <span class="slider round"></span>
        </label>
    @endif
@elseif($param->name == "Nimbus")
    @if($users->Nimbus)
        <label class="switch" onchange='statusactive("{{ $param->courierid }}")'>
        <input type="checkbox" checked>
        <span class="slider round"></span>
        </label>
    @else
        <label class="switch" onchange='statusactive("{{ $param->courierid }}")'>
        <input type="checkbox">
        <span class="slider round"></span>
        </label>
    @endif
@else
    <label class="switch" onchange='statusactive("{{ $param->courierid }}")'>
    <input type="checkbox">
    <span class="slider round"></span>
    </label>
@endif
</td>
</tr>
@php($i++)
@endforeach
</tbody>
</table>
<script type="text/javascript">
function statusactive(val){
    var userid = "{{ $Userid }}";
    // alert(userid);
    $.ajax({
    type: "GET",
    url: "{{ asset('/merchant-courier-update') }}",
    data:{currentcourierno:val,userid:userid},
    success: function (data){
        // alert(data);
        // console.log(data);
      $("#lastmonthdatashows").html(data);
    },
    error: function (data) {
      console.log('Error:', data);
    }
    });
}
</script>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="lastmonthdatashows"></div>

@endsection

