<!DOCTYPE html>
<html lang="en">

<head>
	<!-- All Meta -->
	<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Shipnick.com">
	<meta name="robots" content="">
	<meta name="keywords" content="Logistics, shipment, shipnick, shipnick.com, courier, xpressbee, ecom, dtdc, bluedart, invoice, modern, money, transaction, Transfer money, user interface, wallet">
	<meta name="description" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
	<meta property="og:title" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
	<meta property="og:description" content="Shipnick · Innovative and Clever Deliveries Just for Your · Your Coolest Delivery Partner · Rhyme and Rhyme, We Deliver On Time · Classy Delivery Solutions ...">
	<meta property="og:image" content="//shipnick.com/Shipnick.jpg">
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- favicon -->
	<link rel="shortcut icon" href="{{asset('Admin/images/logo.jpg')}}" />

	<!-- Page Title Here -->
	<title>Shipnick</title>



	<!-- Form step -->
	<link href="{{asset('newtheme/./vendor/jquery-smartwizard/dist/css/smart_wizard.min.css')}}" rel="stylesheet">
	<!-- Custom Stylesheet -->
	<link href="{{asset('newtheme/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">

</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="waviy">
			<span style="--i:1">S</span>
			<span style="--i:2">H</span>
			<span style="--i:3">I</span>
			<span style="--i:4">P</span>
			<span style="--i:5">N</span>
			<span style="--i:6">I</span>
			<span style="--i:7">C</span>
			<span style="--i:8">K</span>
		</div>
	</div>
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Bulk Orders</a></li>
					</ol>
				</div>
				<!-- row -->
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-xl-12 col-lg-12">
						<div class="card">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="card-header">
										<h4 class="card-title">Bulk Orders</h4>
									</div>
								</div>


								<form method="POST" action="{{ asset('/UPBulk_Order_Add') }}" enctype="multipart/form-data" class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
									<div class="card-body">
										<div class="mb-3">
											<label for="formFile" class="form-label">Upload orders excel file (CSV only)</label>

											<input type="file" id="formFile" name="bulkorders" class="form-control" accept=".csv" onchange="checkFileContent()" required />
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
											<div id="error_msg" style="color:red;"></div>
										</div>
										@csrf
										<button class="btn btn-primary submit-btn" id="btnSubmit">Upload</button>
										<button class="btn btn-primary" type="button">Cancel</button>
										<a href="{{ asset('SampleExcel/Sample_Order_File.csv') }}" class="btn btn-primary" title="Download Sample File">Download sample order file</a>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->
		<!-- script  -->
		<script>
			var hubs = <?php echo json_encode($Hubs); ?>;

			function hubrExists(hub_code) {
				return hubs.some(function(el) {
					return el.hub_code === hub_code;
				});
			}

			function checkFileContent() {
				const csvFile = document.getElementById("csvFile");
				const input = csvFile.files[0];
				const reader = new FileReader();
				$("#btnSubmit").prop('disabled', true);

				$('#error_msg').hide();
				$('#error_msg').html('');

				reader.onload = function(e) {

					const text = e.target.result;

					const data = csvToArray(text);
					var totallen = data.length - 1;

					var totallenhub = hubs.length - 1;

					const hubsstatus = 0;
					// Hub Details

					var Order_ID;
					var Address;
					var Address2;
					var Customer_City;
					var Weight;
					var Length;
					var Breadth;
					var Height;
					var Customer_Name;
					var Customer_State;
					var Pincode;
					var Mobile;
					var Product_Name;
					var Quantity;
					var Order_Type;
					var COD_AMOUNT;
					var Invoice_Value;
					var Total_Amount;
					var Hub_Code;
					var Hub_Code_Check;
					var Mobilelen;
					var Pincodelen;
					var statetype;
					var Pincodetype;


					var message = '';
					var cnt = 0;
					var crtno = 2;
					var checkString = 'Order_ID*,Customer_Name*,Address*,Address2*,Customer_City*,Customer_State*,Pincode*,Mobile*,Product_Name*,Quantity*,Order_Type*,COD_AMOUNT*,Weight(gm)*,Length(Cm)*,Breadth(Cm)*,Height(Cm)*,Invoice_Value*,Total_Amount*,Hub_Code*';

					if (text.indexOf(checkString) == 0) {
						if (totallen > 5000) {
							message = 'Total Orders must be less than 5000.';
						} else {
							for (var i = 0; i < totallen; i++) {
								Order_ID = data[i]['Order_ID*'].trim();
								Customer_Name = data[i]['Customer_Name*'].trim();
								Address = data[i]['Address*'].trim();
								Address2 = data[i]['Address2*'].trim();
								Customer_City = data[i]['Customer_City*'].trim();
								Customer_State = data[i]['Customer_State*'].trim();
								Pincode = data[i]['Pincode*'].trim();
								// alert(Pincode);
								Mobile = data[i]['Mobile*'].trim();
								Product_Name = data[i]['Product_Name*'].trim();
								Quantity = data[i]['Quantity*'].trim();
								Order_Type = data[i]['Order_Type*'].trim();
								COD_AMOUNT = data[i]['COD_AMOUNT*'].trim();
								Weight = data[i]['Weight(gm)*'].trim();
								Length = data[i]['Length(Cm)*'].trim();
								Breadth = data[i]['Breadth(Cm)*'].trim();
								Height = data[i]['Height(Cm)*'].trim();
								Invoice_Value = data[i]['Invoice_Value*'].trim();
								Total_Amount = data[i]['Total_Amount*'].trim();


								Hub_Code = data[i]['Hub_Code*\r'].replace("\r", "").trim();
								Hub_Code = Hub_Code.toUpperCase();
								//pickup_city = data[i]['pickup_city\r'].replace("\r", "").trim();   //  last column should be used with \r

								if (Order_ID == '' || Order_ID == '0') {
									message = 'Line no ' + crtno + ', Order ID can not be blank....!';
									break;
								}
								if (Customer_Name == '' || Customer_Name == '0') {
									message = 'Line no ' + crtno + ', Customer Name can not be blank....!';
									break;
								}
								if (!isNaN(Customer_Name)) {
									message = 'Line no ' + crtno + ', Customer Name can not be numeric only....!';
									break;
								}
								if (Address == '' || Address == '0') {
									message = 'Line no ' + crtno + ', Address can not be blank....!';
									break;
								}
								if (!isNaN(Address)) {
									message = 'Line no ' + crtno + ', Address can not be numeric only....!';
									break;
								}
								/*
								if(!/^[a-zA-Z0-9 /]+$/.test(Address)){
								    message='Line no '+crtno+', Address special characters can not be accepted....!';
								    break;  
								}
								*/
								if (Customer_City == '' || Customer_City == '0') {
									message = 'Line no ' + crtno + ', Customer City can not be blank....!';
									break;
								}
								if (!isNaN(Customer_City)) {
									message = 'Line no ' + crtno + ', Customer City can not be numeric....!';
									break;
								}
								if (Customer_State == '' || Customer_State == '0') {
									message = 'Line no ' + crtno + ', Customer State can not be blank....!';
									break;
								}
								if (!isNaN(Customer_State)) {
									message = 'Line no ' + crtno + ', Customer State can not be numeric....!';
									break;
								}
								if (Pincode == '' || Pincode == '0') {
									message = 'Line no ' + crtno + ', Customer Pincode can not be blank....!';
									break;
								}
								if (!/^[0-9]+$/.test(Pincode)) {
									message = 'Line no ' + crtno + ', Customer Pincode enter only numeric characters....!';
									break;
								}
								if (Mobile == '' || Mobile == '0') {
									message = 'Line no ' + crtno + ', Customer Mobile can not be blank....!';
									break;
								}
								if (!/^[0-9]+$/.test(Mobile)) {
									message = 'Line no ' + crtno + ', Customer Mobile enter only numeric characters....!';
									break;
								}
								if (Product_Name == '' || Product_Name == '0') {
									message = 'Line no ' + crtno + ', Product Name can not be blank....!';
									break;
								}
								if (Quantity == '' || Quantity == '0') {
									message = 'Line no ' + crtno + ', Product Quantity can not be blank....!';
									break;
								}
								if (isNaN(Quantity)) {
									message = 'Line no ' + crtno + ', Product Quantity must be numberic....!';
									break;
								}
								if (Order_Type == '' || Order_Type == '0') {
									message = 'Line no ' + crtno + ', Order Type can not be blank....!';
									break;
								}
								//  if(Order_Type !='COD' && Order_Type !='prepaid'){              
								//     message='Line no '+crtno+', Order Type must be either COD or prepaid ....!';
								//      break;  
								//  }
								if (COD_AMOUNT == '' || COD_AMOUNT == '0') {
									if (Order_Type == 'COD') {
										message = 'Line no ' + crtno + ', Product COD Amount can not be blank....!';
										break;
									}
									// message='Line no '+crtno+', Product COD Amount can not be blank....!';
									// break;  
								}
								if (isNaN(COD_AMOUNT)) {
									message = 'Line no ' + crtno + ', Product COD Amount must be numberic....!';
									break;
								}
								if (Weight == '' || Weight == '0') {
									message = 'Line no ' + crtno + ', Product Weight can not be blank....!';
									break;
								}
								if (isNaN(Weight)) {
									message = 'Line no ' + crtno + ', Product Weight must be numberic....!';
									break;
								}
								if (Length == '' || Length == '0') {
									message = 'Line no ' + crtno + ', Product Length can not be blank....!';
									break;
								}
								if (isNaN(Length)) {
									message = 'Line no ' + crtno + ', Product Length must be numberic....!';
									break;
								}
								if (Breadth == '' || Breadth == '0') {
									message = 'Line no ' + crtno + ', Product Breadth can not be blank....!';
									break;
								}
								if (isNaN(Breadth)) {
									message = 'Line no ' + crtno + ', Product Breadth must be numberic....!';
									break;
								}
								if (Height == '' || Height == '0') {
									message = 'Line no ' + crtno + ', Product Height can not be blank....!';
									break;
								}
								if (isNaN(Height)) {
									message = 'Line no ' + crtno + ', Product Height must be numberic....!';
									break;
								}
								if (Invoice_Value == '' || Invoice_Value == '0') {
									message = 'Line no ' + crtno + ', Product Invoice Value can not be blank....!';
									break;
								}
								if (isNaN(Invoice_Value)) {
									message = 'Line no ' + (cnt + 2) + ', Product Invoice_Value must be numberic....!';
									break;
								}
								if (Total_Amount == '' || Total_Amount == '0') {
									message = 'Line no ' + crtno + ', Product Total Amount can not be blank....!';
									break;
								}
								if (isNaN(Total_Amount)) {
									message = 'Line no ' + crtno + ', Product Total_Amount must be numberic....!';
									break;
								}

								if (Hub_Code == '' || Hub_Code == '0') {
									message = 'Line no ' + crtno + ', Hub Code can not be blank....!';
									break;
								}

								if (!hubrExists(Hub_Code)) {
									message = 'Line no ' + crtno + ', Hub code not available, Please use available hub codes.....!';
									break;
								}

								cnt++;
								crtno++;
							}
						}

					} else {
						message = 'Please download the sample file and use that formated file........!';
					}





					if (message == '') {
						if (cnt == totallen) {
							$("#btnSubmit").prop('disabled', false);
						}
					} else {
						$('#error_msg').show();
						$('#error_msg').html(message);

						document.getElementById("csvFile").value = "";
						$("#btnSubmit").prop('disabled', true);
					}


				}

				reader.readAsText(input);

			}


			function csvToArray(str, delimiter = ",") {

				const headers = str.slice(0, str.indexOf("\n")).split(delimiter);

				const rows = str.slice(str.indexOf("\n") + 1).split("\n");



				const arr = rows.map(function(row) {
					var refine_row = row.split('\"');

					var newrow = '';
					for (var ii = 0; ii < refine_row.length; ii++) {
						if (ii % 2 == 0) {
							newrow = newrow + refine_row[ii];
						} else {
							var temp = refine_row[ii].replace(/,/gi, "___");
							newrow = newrow + temp;
						}

					}
					const values = newrow.split(delimiter);
					const el = headers.reduce(function(object, header, index) {
						object[header] = values[index];
						return object;
					}, {});
					return el;
				});
				return arr;
			}
		</script>


		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">
			<div class="copyright">
				<p>Copyright © Designed &amp; Developed by <a href="" target="_blank">Smartship</a> 2023</p>
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

	<script src="{{asset('newtheme/vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
	<script src="{{asset('newtheme/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
	<!-- Form validate init -->
	<script src="{{asset('newtheme/./js/plugins-init/jquery.validate-init.js')}}"></script>


	<!-- Form Steps -->
	<script src="{{asset('newtheme/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>
	<script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	<script src="{{asset('newtheme/js/custom.min.js')}}"></script>
	<script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>


	<script>
		$(document).ready(function() {
			// SmartWizard initialize
			$('#smartwizard').smartWizard();
		});
	</script>
	<script>
		jQuery(document).ready(function() {
			setTimeout(function() {
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
				jQuery(window).on('resize', function() {
					new dezSettings(dezSettingsOptions);
				})
			}, 1000)
		});
	</script>

</body>

</html>