@extends('layout')

@section('content')
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Upload shipment orders</h5>
                        <span class="d-block m-t-5">Upload shipment orders .csv file to create AWB numbers</span>
                    </div>
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="orders" class="form-label">Orders File (.csv)</label>
                                <input type="file" name="orders" id="orders" />
                            </div>
                            <button type="submit" class="btn btn-outline-success">Upload</button>
                        </form>
                    </div>
                </div>
                
                    @if ($awb_nos ?? null)
                    <div class="card">
                        <div class="card-body">
                            <ol>
                                @foreach ($awb_nos as $awb_no)
                                <li>
                                    <h5 class="fw-bold">AWB : {{$awb_no["awb"]}}  (#{{$awb_no["order_id"]}})</h5>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
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