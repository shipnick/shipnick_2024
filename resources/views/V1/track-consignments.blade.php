@extends('layout')

@section('content')
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between;">
                        <div>
                            <h5>Track shipment status</h5>
                            <span class="d-block m-t-5">Track Shipnick shipments</span>
                        </div>
                        <button class="btn" style="float: right" onclick="window.open('/v1/download-awb')">Download AWB (.csv)</button>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="awb_nos" class="form-label">AWB No(s).</label>
                                <textarea class="form-control" id="awb_nos" name="awb_nos" placeholder="Eg. 
221748DS901
221748DS902
...
upto 5
" rows="5">
{{implode($awb_nos ?? [], "\r\n")}}
</textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-success">Track</button>
                        </form>
                    </div>
                </div>
                
                    @if ($consignments ?? null)
                        @foreach ($consignments as $consignment)
                            <!-- Section: Timeline -->
                            <div class="card">
                                <div class="card-body">
                                    <section class="py-5">
                                        <h5 class="fw-bold">AWB : {{$consignment->AWB}}  (#{{$consignment->Order_ID}})</h5>
                                        <ul class="timeline">
                                            @foreach ($consignment->statusUpdates as $update)  
                                            <li class="timeline-item mb-3">
                                                <h6 class="fw-bold">{{$update->status}}</h6>
                                                <p class="text-muted mb-2 fw-bold">{{$update->updated_at->format('Y-m-d h:i a')}}</p>
                                                <p class="text-muted">
                                                    {{$update->notes}}
                                                </p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </section>
                                    <!-- Section: Timeline -->
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.timeline {
  border-left: 1px solid hsl(0, 0%, 90%);
  position: relative;
  list-style: none;
}

.timeline .timeline-item {
  position: relative;
}

.timeline .timeline-item:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline .timeline-item:after {
  background-color: hsl(0, 0%, 90%);
  left: -38px;
  border-radius: 50%;
  height: 11px;
  width: 11px;
  content: "";
}
</style>
@endsection