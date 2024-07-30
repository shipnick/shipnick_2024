<div class="card" title="Current Month Orders">
<div class="card-body cardbodyone">
<div class="dash-widget-header">
<span class="dash-widget-icon newcarddesone bg-3">
<i class="fas fa-file-alt newfadesone"></i>
</span>
<div class="dash-count">
<div class="dash-counts fontsizeone">
<p><span>Delivered &emsp;&emsp; : </span>{{ $delivered }}
<br>
<span>RTO + RTD &emsp;&ensp; : </span>{{ $rtdo }}
<br>
<span>OFD + Intransit : </span>{{ $ofdintrans }}</p>
</div>
</div>
</div>
<div class="progress progress-sm mt-3">
<div class="progress-bar bg-7" role="progressbar" style="width:100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<p class="text-muted mt-3 mb-0 fontsizeone">Current Month Orders
<span class="fontsizeone" style="float:right;">{{ $total }}</span>
</p>
</div>
</div>
