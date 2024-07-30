@extends('UserPanel.Layout_1')

@section('bodycontent')
<section role="main" class="content-body">

<!-- Add New Record Through Model -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <!--  -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center" style="color:black"><b>Add Bulk Orders Product Details</b></h4>
      <!--  -->
      </div>
      <div class="modal-body">
      <!--  -->
      <form method="POST" action="{{ asset('/UPBulk_Order_Add') }}" enctype="multipart/form-data">
        <div class="row"><br>
        	<div class="col-md-6">
        		<input type="file" name="bulkorders" class="form-control" required="">
        	</div>
        	<div class="col-md-6">
        		@csrf
        		<button class="btn btn-success">Upload Bulk Orders</button>
        	</div>
        </div>
        <div class="row"><br>
        	<center>
                <a href="{{ asset('SampleExcel/SampleBulk_Order_With_Data.csv') }}" download=""><b>Download Sample File With Entry </b></a>
                &ensp;&ensp;
        		<a href="{{ asset('SampleExcel/SampleBulk_Orders_Without_Data.csv') }}" download=""><b>Download Sample File Without Entry</b></a>
        	</center>
        </div>
      </form>
      <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- //Add New Record Through Model -->



<!-- start: page -->
<div class="row" id="Showdatahere" style="margin-top:-40px;margin-bottom:auto">









<!--  -->
<script type="text/javascript">
$(document).ready(function(){
  $("Showdatahere").html("Loading...");
	$.ajax({
	type: "GET",
	url: "{{ asset('/UPBulk_OrderAjax') }}",
	data:{val:"Bulk Orders"},
	success: function (data){
		$("#Showdatahere").html(data);
	},
	error: function (data) {
		console.log('Error:', data);
	}
	});
});
</script>
<!--  -->










</div>


</div>




<!-- end: page -->
</section>
@endsection


<!-- Header -->
@section('HeaderExtraFiles')

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/select2/select2.css') }}" />
		<link rel="stylesheet" href="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('Admin/assets/stylesheets/theme-custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('Admin/assets/vendor/modernizr/modernizr.js') }}"></script>
@endsection
<!-- Header -->

<!-- Footer -->
@section('FooterExtraFiles')
			<!-- Vendor -->
		<script src="{{ asset('Admin/assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		<!-- Specific Page Vendor -->
		<script src="{{ asset('Admin/assets/vendor/select2/select2.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
		<script src="{{ asset('Admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('Admin/assets/javascripts/theme.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('Admin/assets/javascripts/theme.custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('Admin/assets/javascripts/theme.init.js') }}"></script>


		<!-- Examples -->
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.default.js') }}"></script>
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.row.with.details.js') }}"></script>
		<script src="{{ asset('Admin/assets/javascripts/tables/examples.datatables.tabletools.js') }}"></script>
@endsection
<!-- Footer -->

<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    setTimeout(function () {
      // alert('Reloading Page');
      location.reload(true);
    }, 30000);
  });
</script>
 -->