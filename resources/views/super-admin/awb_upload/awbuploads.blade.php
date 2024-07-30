@extends('super-admin.Layout')

@section('bodycontent')
<div class="content container-fluid">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Ecom Express Awb Numbers Details
</h3>
</div>
<div class="col-auto">
<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Upload AWB-Numbers</a>
</a>
</div>
</div>
</div>

@if(session('status')=="Awb Upload Successfully")
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
<h5 class="modal-title">Upload Awbs</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<!-- <form> -->
<div class="form-group">
<label>Upload awbs via excel file<span class="text-danger">*</span></label>
</div>
<div class="form-group">
<label>Sample file is available for download<span class="text-danger">*</span>
<!-- <a href="{{ asset('/MISExcelFiles/Sample_widthdata.csv') }}"><b>Download</b></a> -->
</label>
</div>
<div class="form-group">
<label>Please remove sample data before proceed<span class="text-danger">*</span></label>
</div>
<form method="POST" action="{{ asset('/super-awb-details-upload') }}" enctype="multipart/form-data">

<div class="form-group">
<label>Awb Category<span class="text-danger">*</span></label>
&emsp;&emsp;
<label style="color:blue">
    <input type="radio" name="awbcate" value="COD" checked="checked"> COD
</label>
&emsp;
<label style="color:blue">
    <input type="radio" name="awbcate" value="PPD"> Prepaid
</label>

</div>

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

<div class="container-fluid">
    <br>&emsp;<br>
    <div class="row">
        <div class="col-md-4">
            <strong>Total Awbs : </strong>{{ $ecomtotal }}
        </div>
        <div class="col-md-4">
            <strong>Used Awbs : </strong>{{ $ecomused }}
        </div>
        <div class="col-md-4">
            <strong>Remains Awbs : </strong>{{ $ecomleft }}
        </div>
    </div>
    <br>&emsp;<br>
    <div class="row">
        <div class="col-md-4">
            <strong>COD Total Awbs : </strong>{{ $ecomtotalcod }}
        </div>
        <div class="col-md-4">
            <strong>COD Used Awbs : </strong>{{ $ecomusedcod }}
        </div>
        <div class="col-md-4">
            <strong>COD Remains Awbs : </strong>{{ $ecomleftcod }}
        </div>
    </div>
    <br>&emsp;<br>
    <div class="row">
        <div class="col-md-4">
            <strong>Prepaid Total Awbs : </strong>{{ $ecomtotalppd }}
        </div>
        <div class="col-md-4">
            <strong>Prepaid Used Awbs : </strong>{{ $ecomusedppd }}
        </div>
        <div class="col-md-4">
            <strong>Prepaid Remains Awbs : </strong>{{ $ecomleftppd }}
        </div>
    </div>


    <br>&emsp;<br>
</div>


</div>
</div>
</div>
</div>
</div>

@endsection

