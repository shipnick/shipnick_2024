<!DOCTYPE html>

<html lang="en">

<head>
   <!-- All Meta --> 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab">
	<meta name="robots" content="">
	<meta name="keywords" content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
	<meta name="description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
	<meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
	<meta property="og:description" content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
	<meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="{{asset('Admin/images/logo.jpg')}}" />

	<!-- Page Title Here -->
<title>Shipnick</title>
	
	
	
	
	<link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
     <link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
     @include("UserPanel/preloader")
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

    @include("UserPanel/app")
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Add a Hub</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add a Hub</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="needs-validation" method="post" action="{{ asset('/UPNew_Hub') }}" enctype="multipart/form-data" novalidate >@csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                 <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom01">Hub Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 input-success-o">
														<input type="text" class="form-control " name="name" id="validationCustom01"   required>
														<div class="invalid-feedback">
															Please enter a Hub Name.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom02">PIN Code<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="pincode" id="validationCustom02"   required>
														<div class="invalid-feedback">
															Please enter a PIN Code.
														</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom02">Contact Number<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="mobile" id="validationCustom02"   required>
														<div class="invalid-feedback">
															Please enter a Contact Number.
														</div>
                                                    </div>
                                                </div>
												
              <!--                                  <div class="mb-3 row">-->
              <!--                                      <label class="col-lg-4 col-form-label text-black" for="validationCustom09">house/flat no.<span-->
              <!--                                              class="text-danger">*</span>-->
              <!--                                      </label>-->
              <!--                                      <div class="col-lg-6">-->
              <!--                                          <input type="text" class="form-control text-black" name="address2" id="validationCustom09"   required>-->
														<!--<div class="invalid-feedback">-->
														<!--	Please enter a house/flat no.-->
														<!--</div>-->
              <!--                                      </div>-->
              <!--                                  </div>-->
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom04">to Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control"  name="address1" id="validationCustom04"  rows="5"  required></textarea>
														<div class="invalid-feedback">
															Please enter a address.
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                
                                                
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom06">City
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="city" id="validationCustom06" required>
														<div class="invalid-feedback">
															Please enter city.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom07">State
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control"  name="state" id="validationCustom07"   required>
														<div class="invalid-feedback">
															Please enter state.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom08">GSTIN
                                                        <!--<span class="text-danger">*</span>-->
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="gstno" id="validationCustom08" value="0000"  required>
														<div class="invalid-feedback">
															Please enter GSTIN
														</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-4 col-form-label text-black" for="validationCustom05">Hub Pickup type
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="default-select wide form-control" name="deliverytype"  id="validationCustom05">
                                                            <option  data-display="Select">Select a hub type</option>
                                                            <option value="2">Economy</option>
                                                            <option value="1">Express</option>
                                                        </select>
														<div class="invalid-feedback">
															Please select hub type.
														</div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-lg-8 ms-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
														
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script>

	<script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

      <script src="{{asset('newtheme/js/custom.min.js')}}"></script>
	<script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>
	
  
	<script>
		(function () {
		  'use strict'

		  // Fetch all the forms we want to apply custom Bootstrap validation styles to
		  var forms = document.querySelectorAll('.needs-validation')

		  // Loop over them and prevent submission
		  Array.prototype.slice.call(forms)
			.forEach(function (form) {
			  form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
				  event.preventDefault()
				  event.stopPropagation()
				}

				form.classList.add('was-validated')
			  }, false)
			})
		})()
	</script>

<script>
		jQuery(document).ready(function(){
		setTimeout(function(){
			var dezSettingsOptions = {
				typography: "cairo",
				version: "light",
				layout: "vertical",
				primary: "color_10",
				headerBg: "color_1",
				navheaderBg: "color_1",
				sidebarBg: "color_10",
				sidebarStyle: "mini",
				sidebarPosition: "fixed",
				headerPosition: "fixed",
				containerLayout: "wide",
			};
			new dezSettings(dezSettingsOptions);
			jQuery(window).on('resize',function(){
				new dezSettings(dezSettingsOptions);
			})
		},1000)
	});

	
	</script>
</body>
</html>