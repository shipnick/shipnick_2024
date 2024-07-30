@extends('super-admin.Layout')

@section('bodycontent')
<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MIS (Management Info. System)
	<span style="font-size:14px;color:#e91e63 !important;font-weight:600">&ensp;* Last 5 Days</span>
</h3>
</div>
<div class="col-auto">
<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Upload MIS Report</a>
</a>
</div>
</div>
</div>

@if(session('status')=="MIS Upload Successfully")
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



<div id="add_tax" class="modal custom-modal fade" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Upload Orders</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<!-- <form> -->
<div class="form-group">
<label>Upload orders via excel file<span class="text-danger">*</span></label>
</div>
<div class="form-group">
<label>Sample file is available for download<span class="text-danger">*</span>
<a href="{{ asset('/MISExcelFiles/Sample_widthdata.csv') }}"><b>Download</b></a>
</label>
</div>
<div class="form-group">
<label>Please remove sample data before proceed<span class="text-danger">*</span></label>
</div>
<form method="POST" action="{{ asset('/AMIS_ReportAdd') }}" enctype="multipart/form-data">
	<div class="form-group">
	<label>Upload (Excel file) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">Click below</a></label>
	<label class="custom-file-container__custom-file">
	<!-- <input type="file"  class="custom-file-container__custom-file__custom-file-input" accept="image/*"> -->
	<br>
	<input type="file" name="bulkorderfile" class="form-control" required="">
	<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
	<span class="custom-file-container__custom-file__custom-file-control"></span>
	</label>
	</div>
	<div class="submit-section">
	@csrf
	<button class="btn btn-primary submit-btn">Upload</button>
	 </div>
</form>
<!-- </form> -->




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
	<th>Sr no</th>
	<th>MIS Date</th>
	<th>Report</th>
	<th>Download</th>
</tr>
</thead>
<tbody>
    @php($i=1)
    @php($j=1)
    @foreach($days0 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate0 }} {{ $days->uploadtime }}</th>
    		<th>MIS Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_Export') }}/{{ $tdate0 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days1 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate1 }} {{ $days->uploadtime }}</th>
    		<th>MIS Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_Export') }}/{{ $tdate1 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days2 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate2 }} {{ $days->uploadtime }}</th>
    		<th>MIS Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_Export') }}/{{ $tdate2 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days3 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate3 }} {{ $days->uploadtime }}</th>
    		<th>MIS Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_Export') }}/{{ $tdate3 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @php($i++)
    @php($j++)
    @endforeach
    @php($j=1)
    @foreach($days4 as $days)
    	<tr style="font-size:13px">
    		<th>{{ $i }}</th>
    		<th>{{ $tdate4 }} {{ $days->uploadtime }}</th>
    		<th>MIS Report {{ $j }}</th>
    		<th><a href="{{ asset('/AMISReport_Export') }}/{{ $tdate4 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
    	</tr>
    @endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection

