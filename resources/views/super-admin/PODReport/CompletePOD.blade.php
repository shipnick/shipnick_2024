@extends('super-admin.Layout_1')

@section('bodycontent')

<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title"> Proof of Delivery Details 
	<span style="font-size:14px;color:red">&ensp;* Last 5 Days</span>
</h3>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-stripped table-hover datatable">
<thead class="thead-light">
<tr>
	<th>MIS Date</th>
	<th>Report</th>
	<th>Download</th>
</tr>
</thead>
<tbody>
	<tr style="font-size:13px">
		<th><?php echo $tdate = date('Y-m-d'); ?></th>
		<th>Delivered Report</th>
		<th><a href="{{ asset('/AMISReport_ExportD') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate1 = date('Y-m-d',strtotime("-1 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="{{ asset('/AMISReport_ExportD1') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate2 = date('Y-m-d',strtotime("-2 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="{{ asset('/AMISReport_ExportD2') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate3 = date('Y-m-d',strtotime("-3 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="{{ asset('/AMISReport_ExportD3') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate4 = date('Y-m-d',strtotime("-4 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="{{ asset('/AMISReport_ExportD4') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download</a></th>
	</tr>

	<!-- <tr style="font-size:13px">
		<th><?php echo $tdate5 = date('Y-m-d',strtotime("-5 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="#?date=<?= $tdate5 ?>" class="btn btn-success">Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate6 = date('Y-m-d',strtotime("-6 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="#?date=<?= $tdate6 ?>" class="btn btn-success">Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate7 = date('Y-m-d',strtotime("-7 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="#?date=<?= $tdate7 ?>" class="btn btn-success">Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate8 = date('Y-m-d',strtotime("-8 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="#?date=<?= $tdate8 ?>" class="btn btn-success">Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate9 = date('Y-m-d',strtotime("-9 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="#?date=<?= $tdate9 ?>" class="btn btn-success">Download</a></th>
	</tr>
	<tr style="font-size:13px">
		<th><?php echo $tdate10 = date('Y-m-d',strtotime("-10 days")); ?></th>
		<th>Delivered Report</th>
		<th><a href="#?date=<?= $tdate10 ?>" class="btn btn-success">Download</a></th>
	</tr> -->
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>




@endsection

