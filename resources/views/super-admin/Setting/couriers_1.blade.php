@extends('super-admin.Layout')
@php(error_reporting(1))
@section('bodycontent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Switch -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
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
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
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
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
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
<div class="row">
<div class="col-sm-6">
<h3 class="page-title">Settings </h3>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-3 col-md-4">

<div class="widget settings-menu">
<ul>
<li class="nav-item">
<a href="{{ asset('/client-setting/'.$id) }}" class="nav-link">
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
<a href="{{ asset('/client-courier-permissions/'.$id) }}" class="nav-link active">
<i class="far fa-bell"></i> <span>Courier Permissions</span>
</a>
</li>
<!-- <li class="nav-item">
<a href="{{ asset('/client-change-password/'.$id) }}" class="nav-link">
<i class="fas fa-unlock-alt"></i> <span>Change Password</span>
</a>
</li> -->
</ul>
</div>

</div>
<div class="col-xl-9 col-md-8">
<div class="card">
<div class="card-header">
<h5 class="card-title">Courier Permissions</h5>
</div>
<div class="card-body">
    <div class="panel-body">
		<table class="datatable table table-stripped">
<thead>
<tr>
<th>Sno</th>
<th>Courier Compny</th>
<th>Courier Through</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $cnt = 1; ?>
@foreach($params as $param)
<?php $dlstatus = "notchecked"; ?>
<?php $xbstatus = "notchecked"; ?>
    @foreach($permissions as $permission)
        @if($permission->courier_code==$param->cou_code && $permission->courier_by=='DEL' && $permission->admin_flg=='1' && $permission->user_id==$id)
            <?php $dlstatus = "checked"; ?>
        @endif
    @endforeach
    <tr>
        <td><?php echo $cnt++; ?></td>
        <td><?php echo $param->name; ?></td>     
        <td>Delhivery</td>
        <td>
            <label class="switch">
            <input type="checkbox" onchange="change_status('<?php echo $param->cou_code; ?>','DEL',this)" value="0" <?php echo $dlstatus; ?>>
            <span class="slider round"></span>
            </label>
         </td>
    </tr>
    @foreach($permissions as $permission)
        @if($permission->courier_code==$param->cou_code && $permission->courier_by=='XPB' && $permission->admin_flg=='1' && $permission->user_id==$id)
            <?php $xbstatus = "checked"; ?>
        @endif
    @endforeach
    <tr>
        <td><?php echo $cnt++; ?></td>
        <td><?php echo $param->name; ?></td>    
        <td>XpressBees</td>
        <td>
            <label class="switch">
            <input type="checkbox" onchange="change_status('<?php echo $param->cou_code; ?>','XPB',this)" value="0" <?php echo $xbstatus; ?>>
            <span class="slider round"></span>
            </label>
        </td>
    </tr>
@endforeach
</tbody>
</table>
	</div>

<script type="text/javascript">
function change_status(code,courier,obj){
    var userid = "{{ $id }}"
    
    var value = 0;
    if ($(obj).prop('checked')==true){ 
        value = 1;
    }

    $.ajax({
    type: "GET",
    url: "{{ asset('/client-courier-permissions') }}",
    data:{code:code,courier:courier,userid:userid,value:value},
    success: function (data){
        
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


@endsection


