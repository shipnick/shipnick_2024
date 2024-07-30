<center><h4>Failed Orders</h4></center>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
			    <th>Upload Date</th>
				<th>Order No</th>
				<th>Client Name</th>
				<th>Client Mobile</th>
				<th>Client Pincode</th>
				<th>Pickup Pincode</th>
				<th>COD Amt</th>
				<th>Error</th>
			</tr>
		</thead>
		<tbody>
			@php($i = 1)
			@foreach($params as $param)
			<tr class="gradeX">
				<td>{{ $param->Rec_Time_Date }}</td>
				<td>{{ $param->orderno }}</td>
				<td>{{ $param->Name }}</td>
				<td>{{ $param->Mobile }}</td>
				<td>{{ $param->Pincode }}</td>
				<td>{{ $param->pickup_pincode }}</td>
				<td>{{ $param->Cod_Amount }}</td>
				<td>{{ $param->showerrors }}</td>
			</tr>
			@php($i++)
			@endforeach
		</tbody>
	</table>
</div>