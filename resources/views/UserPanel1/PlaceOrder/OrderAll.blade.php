<form method="post" action="{{ asset('/filter-selected-order') }}">

@csrf
<div class="col-md-12">
    <center><h4>Delivered Orders</h4></center>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-primary btn-fw arrowbtn" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
				
                </div>
                <div class="col-md-6">
                   
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
        </div>
    </div>
    </div>

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
				<!-- <td>{{ $param->order_username }}</td> -->
				<td><input class="checkbox" name="selectedorder[]" value="<?= $param->Awb_Number ?>" type="checkbox"> {{ $param->Awb_Number }}</td>
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
<script>function toggle(source) {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
				checkboxes[i].checked = source.checked;
		}
	}</script>
</form>