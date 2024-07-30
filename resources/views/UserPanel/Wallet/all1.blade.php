@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">


      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Wallet
              @if(session('status')=="Hub Details Delete Successfully")
              <span style="color:green;font-size: 14px;">
                {{ session('status') }}
              </span>
              @elseif(session('status'))
              <span style="color:orange;font-size: 14px;">
                {{ session('status') }}
              </span>
              @endif
            </h4>
            <div class="text-right">
              <button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#add_tax">

                Add Balance
              </button>

            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Recharge ID</th>
                    <th>Recharge Date</th>
                    <th>Recharge Amount</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                  </tr>
                </thead>
                @foreach ($params as $post)
                <tr>
                  <td>{{ $post->id}}</td>
                  <td>{{ $post->created_at}}</td>
                  <td>{{ $post->amount }}</td>
                  <td>{{ $post->r_payment_id	 }}</td>
                  <td>{{ $post->status}}</td>
                </tr>

                @endforeach

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
    </div>
  </footer>
  <!-- partial -->
</div>

<div id="add_tax" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Money</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <form class="contribution-form" id="contribution-form" method="POST" enctype="multipart/form-data" action="{{url('make-order')}}">@csrf
        <div class="text-center ">
          <div class="row my-4">
            <div class="col-md-3 my-1">
              <p> <strong>Amount</strong> </p>
            </div>
            <div class="col-md-6">
              <input type="text" placeholder="₹" class="form-control" style="border-color:#33333373;border-radius:20px" value="500" name="amount" required="">
              <!-- @error('amount') <font color="red">{{$massage}}</font> @enderror() -->
            </div>
            <div class="col-md-3"></div>

          </div>
          <!-- <div class="text-center my-3">
          <a href="#" class="btn btn-success badge">500</i></a>
          <a href="#" class="btn btn-success badge">1000</i></a>
          <a href="#" class="btn btn-success badge">2000</i></a>
          <a href="#" class="btn btn-success badge">5000</i></a>

        </div> -->
          <button class="btn btn-primary badge" type="submit"> Recharge </button>




        </div>
      </form>
      <br><br>

    </div>
  </div>
</div>






@endsection