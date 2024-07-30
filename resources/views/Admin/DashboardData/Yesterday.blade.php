<!--  -->
<div class="row">




<!-- <h5 class="text-semibold text-dark text-uppercase mb-md mt-lg">Border Color Positions</h5> -->


<div class="col-md-12 col-lg-12 col-xl-12">
<section class="panel panel-featured-left">
<div class="panel-body" title="Delivered/ Process/ RTD" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;border-radius:3px">
	<a style="text-decoration:none;color:black" href="{{ asset('/All_Orders') }}">
		<span style="font-size:21px;color:black">All Orders</span>
		&ensp;	: &ensp;&ensp;
		<span style="font-size:21px;float:right">{{ $allcomplete + $allpending + $allcancel }}</span>
	</a>
</div>
</section>
</div>


<div class="col-md-6 col-lg-6 col-xl-6">
<section class="panel panel-featured-left panel-featured-primary" style="border-left-color:#0088cc">
<div class="panel-body" title="Delivered" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;border-radius:3px">
	<a style="text-decoration:none;color:black" href="{{ asset('/All_Orders_Complete') }}">
		<span style="font-size:21px;color:black">Delivered</span>
		&ensp;	: &ensp;&ensp;
		<span style="font-size:21px;float:right">{{ $allcomplete }}</span>
	</a>
</div>
</section>
</div>

<div class="col-md-6 col-lg-6 col-xl-6">
<section class="panel panel-featured-left panel-featured-primary" style="border-left-color:#038303">
<div class="panel-body" title="Process" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;border-radius:3px">
	<a style="text-decoration:none;color:black" href="{{ asset('/All_Orders_Pending') }}">
		<span style="font-size:21px;color:black">Process</span>
		&ensp;	: &ensp;&ensp;
		<span style="font-size:21px;float:right">{{ $allpending }}</span>
	</a>
</div>
</section>
</div>




<div class="col-md-6 col-lg-6 col-xl-6">
<section class="panel panel-featured-left" style="border-left-color:#ff5722">
<div class="panel-body" title="RTO Orders" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;border-radius:3px">
	<a style="text-decoration:none;color:black" href="{{ asset('/All_Orders_Cancel') }}">
		<span style="font-size:21px;color:black">RTO</span>
		&ensp;	: &ensp;&ensp;
		<span style="font-size:21px;float:right">{{ $allcancel }}</span>
	</a>
</div>
</section>
</div>
<div class="col-md-6 col-lg-6 col-xl-6">
<section class="panel panel-featured-left" style="border-left-color:#ffc107">
<div class="panel-body" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;border-radius:3px">
	<a style="text-decoration:none;color:black" href="{{ asset('/All_Orders_Uploaded') }}">
		<span style="font-size:21px;color:black">Not Picked</span> :
		<span style="font-size:21px;float:right">{{ $alluploaded }}</span>
	</a>
</div>
</section>
</div>

<div class="col-md-6 col-lg-6 col-xl-6">
<section class="panel panel-featured-left" style="border-left-color:#e9271e">
<div class="panel-body" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%) !important;border-radius:3px">
	<a style="text-decoration:none;color:black" href="{{ asset('/All_Orders_Canceled') }}">
		<span style="font-size:21px;color:black">Canceled</span>
		&ensp;	: &ensp;&ensp;
		<span style="font-size:21px;float:right">{{ $allcanceled }}</span>
	</a>
</div>
</section>
</div>




</div>
