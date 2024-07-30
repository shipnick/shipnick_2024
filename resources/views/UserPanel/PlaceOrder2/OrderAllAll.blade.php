<!-- All Orders  -->
<form method="post" action="{{ asset('/filter-selected-order') }}">@csrf
	<div>
		<button name="currentbtnname" value="shippinglabel" type="submit" class="btn btn-outline-primary mb-3"><i class="fa fa-calendar me-3 scale3"></i>Print Label</button>
		<!-- <a href="javascript:void(0);" class="btn btn-outline-primary mb-3"><i class="fa fa-calendar me-3 scale3"></i>Print Label</a><br /> -->
	</div>

	<div class="table-responsive fs-14">
		<table class="table card-table display mb-4 dataTablesCard text-black" id="example5">
			<thead>
				<tr>
					<th>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="toggle(this);">
							<label class="form-check-label" for="checkAll">
							</label>
						</div>
					</th>
					<th>AWB #</th>
					<th>ID Order(s)</th>
					<th>Date of upload</th>
					<th>Customer details</th>
					<th>Customer address</th>
					<th>Courier</th>
					<th>Status</th>
					<th class="text-end">Action</th>
				</tr>
			</thead>
			<tbody>
				@php($i = 1)
				@foreach($params as $param)
				<tr>
					<td>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="selectedorder[]" value="<?= $param->Awb_Number ?>">
						</div>
					</td>
					<td><span>{{ $param->Awb_Number }}</span></td>
					<td><span>{{ $param->ordernoapi }}</span></td>
					<td><span class="text-nowrap">{{ $param->Rec_Time_Date }}</span></td>
					<td>
						<div class="d-flex align-items-center">
							<div>
								<h6 class="fs-16 mb-0 text-nowrap"><span>{{ $param->Name }}</span><br />
									<span>{{$param->Mobile}}</span>
								</h6>
							</div>
						</div>
					</td>
					<td><span>{{ $param->Address }}</span></td>
					<td><span>{{ $param->awb_gen_by }}</span></td>
					<td><a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">{{ $param->showerrors }}</a></td>
					<td class="text-end">
						<div class="dropdown dropstart">
							<a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="javascript:void(0);"><i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Order</a>
								<a class="dropdown-item" href="transaction-details.html"><i class="las la-info-circle scale5 me-3"></i>Print Label</a>
							</div>
						</div>
					</td>
				</tr>
				@php($i++)
				@endforeach
			</tbody>
		</table>
	</div>
	<script>
		function toggle(source) {
			var checkboxes = document.querySelectorAll('input[type="checkbox"]');
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i] != source)
					checkboxes[i].checked = source.checked;
			}
		}
	</script>
</form>