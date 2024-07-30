<!--  -->
<div class="row">

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Total Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-5">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">{{ $total }}</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-5" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">LMTotal Orders</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Intransit Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-6">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">{{ $intransit }}</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Intransit</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Out for delivery Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-7">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">{{ $ofd }}</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-7" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">OFD</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Delivered Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-8">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">{{ $delivered }}</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-8" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">Delivered</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Return to origin Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-6">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">{{ $rto }}</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-6" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">RTO</p>
</div>
</div>
</div>

<div class="col-xl-2 col-sm-2 col-2">
<div class="card" title="Return to delivered Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddes bg-8">
<i class="far fa-file newfades"></i>
</span>
<div class="dash-count">
<div class="dash-counts">{{ $rtd }}</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-8" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0">RTD</p>
</div>
</div>
</div>


</div>
