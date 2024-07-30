<center><h4>Canceled Orders</h4></center>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>AWB No</th>
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
				<td>{{ $param->Awb_Number }}</td>
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


