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
            
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Recharge ID</th>
                    <th>Recharge Date</th>
                    
                  </tr>
                </thead>
                <tr>
                    <th>order_id</th>
                    <th>{{$payment->notes->order_id}}</th>
                </tr>
                <tr>
                    <th>Amount</th>
                    <th>{{$payment->amount / 100}}</th>
                </tr>
                <tr>
                    <th>status</th>
                    <td>{{$payment->status}}</td>
                </tr>
                <tr>
                    <th>payment_id</th>
                    <td>{{$payment->id}}</td>
                </tr>

              </table>
            </div>
            <button id="rzp-button1" class="btn btn-primary">Pay</button>
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
  
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var urls="{{url('succes-payment')}}"
var options = {
    "key": "rzp_live_A2MdcPIWcnJhQc", // Enter the Key ID generated from the Dashboard
    "amount": "{{$payment->amount}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Shipnick", //your business name
    "description": "Test Transaction",
    "image": "https://www.shipnick.com/Admin/images/logo.jpg",
    "order_id": "{{$payment->id}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
       window.location.href=urls+'?Payment_id='+response.razorpay_payment_id,'?razorpay_signature='+response.razorpay_signature;
    },
    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
        "name": "{{$userdata->name}}", //your customer's name
        "email": "{{$userdata->username}}", 
        "contact": "{{$userdata->mobile}}"  //Provide the customer's phone number for better conversion rates 
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        // alert(response.error.code);
        // alert(response.error.description);
        // alert(response.error.source);
        // alert(response.error.step);
        // alert(response.error.reason);
        // alert(response.error.metadata.order_id);
        // alert(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
  <!-- partial -->
</div>







@endsection