@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Bulk Orders</h3> <span style="font-size:14px;color:#29326A !important">* Today upload only</span>
                        <!-- <p class="card-description">
                    Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.
                  </p> -->
                        @if(session('status')=="File uploaded successfully. Please wait 1min file is
                        processing")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status')=="File uploaded successfully.")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status')=="Order delete please refresh page if not deleted")
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @elseif(session('status'))
                        <section class="comp-section" id="returnmsgbox">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </section>
                        @endif
                        <div class="text-right">



                            @php($tno = 0)
                            @php($tnofld = 0)
                            @foreach($params as $param)
                            @if($param->order_cancel != '1' AND $param->Awb_Number != '')
                            @php($tno++)
                            @endif
                            @if($param->Awb_Number == '')
                            @php($tnofld++)
                            @endif
                            @endforeach


                            <a href="{{ asset('/today-failed-orders') }}/Excel" target="_black" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure download Failed orders?')">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Failed({{ $tnofld }})
                            </a>

                            <a href="{{ asset('/today-placed-orders') }}/Excel" target="_black" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure download placed orders?')">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                Placed({{ $tno }})
                            </a>

                            @if($tno>0)
                            <a href="{{ asset('/today-labels') }}" target="_black" class="btn btn-outline-warning btn-sm" onclick="return confirm('Are you sure download all labels?')">Download A4 Labels</a>
                            <a href="{{ asset('/today-thermal-labels') }}" target="_black" class="btn btn-outline-warning btn-sm" onclick="return confirm('Are you sure download all labels?')">Download Thermal Labels</a>
                            @endif



                            <!--<a href="{{ asset('/today-failed-orders') }}/Single" target="_black" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure download Failed orders?')">-->
                            <!--    <i class="fa fa-table" aria-hidden="true"></i>-->
                            <!--    Failed Orders-->
                            <!--</a>-->

                            <!--<a href="{{ asset('/today-placed-orders') }}/Single" target="_black" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Are you sure download placed orders?')">-->
                            <!--    <i class="fa fa-table" aria-hidden="true"></i>-->
                            <!--    Placed Orders-->
                            <!--</a>-->
                            <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_tax">Upload Orders</a>












                        </div>
                        <div id="add_tax" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload Orders</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ asset('/UPBulk_Order_Add') }}" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label><span class="text-danger">* This (–) Special character not-acceptable | Database Error shows*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <label>Upload orders via excel file<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <label>
                                                    Sample file is available for download<span class="text-danger">*</span>
                                                    <a href="{{ asset('SampleExcel/Sample_Order_File.csv') }}" class="custom-file-container__image-clear" title="Download Sample File">Download</a>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label>Please remove sample data before proceed<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="form-group">
                                                <div id="error_msg" style="color:red;"></div>
                                                <label class="custom-file-container__custom-file">
                                                    <!-- <input type="file" name="bulkorders" class="custom-file-container__custom-file__custom-file-input" accept="image/*"> -->
                                                    <input type="file" id="csvFile" name="bulkorders" class="form-control" accept=".csv" onchange="checkFileContent()" required />
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />

                                                </label>
                                            </div>
                                            <div class="submit-section">
                                                @csrf
                                                <button class="btn btn-primary submit-btn" id="btnSubmit">Upload</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="{{ asset('/UPBulk_Order') }}">
                            <div class="row">

                                <div class="colmd-6"></div>


                                <div class="form-group col-md-2">
                                    <label for="exampleFormControlSelect3">Hubs(All) </label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                        <option>ALL</option>
                                        @foreach($Hubs as $Hub)
                                        <option value="{{ $Hub->hub_id  }}">{{ $Hub->hub_code  }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-2">

                                    <label for="exampleFormControlSelect3">Delivery Mode </label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                                        <option>ALL</option>
                                        <option>COD</option>
                                        <option>Prepaid</option>
                                    </select>
                                </div>
                                <div class="form-group my-4">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mr-0">Search</button>
                                </div>
                                <!-- <input type="submit" name="" class="btn btn-primary"> -->


                            </div>
                        </form>





                    </div>
                </div>
            </div>



            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ asset('/filter-selected-order') }}">

                            @csrf

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <!-- <div class="col-md-4">
                    <div class="form-check mx-sm-2">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                            Select All
                        </label>
                    </div>
                </div> -->
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure to print this order?')" name="currentbtnname" value="shippinglabel">Print Label</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure cancel this order?')" name="currentbtnname" value="cancelorders">Cancel Orders</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- <div class="row">
                <div class="col-md-5">
                    <select class="form-control btn btn-primary badge mr-2">
                        <option>Print Size</option>
                        <option>A4 Size</option>
                        <option>A6 Size</option>
                        <option>Barcode</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <button type="submit" class="btn btn-primary mr-2">Print shipping label</button>
                </div>
            </div> -->
                                    </div>
                                </div>
                            </div>




                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> <input type="checkbox" name="select-all" onclick="toggle(this);" />Order No</th>
                                            <th>Label</th>
                                            <th>AWB No</th>
                                            <th>Courier Name</th>
                                            <th>Name</th>
                                            <!--<th>Mobile</th>-->
                                            <!--<th>Address</th>-->
                                            <th>Pincode</th>
                                            <th>Product Name</th>
                                            <th>COD Amt</th>
                                            <!--<th>Last Update</th>-->
                                            <th>status</th>
                                            <th>Remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i = 1)
                                        @foreach($params as $param)
                                        <tr class="gradeX">
                                            <!--<td>{{ $i }}</td>-->
                                            <!--<td>{{ $param->Rec_Time_Date }}</td>-->

                                            <td>
                                                <label>
                                                    <input class="checkbox" name="selectedorder[]" value="<?= $param->Awb_Number ?>" type="checkbox">
                                                    <?php
                                                    // echo $param->Single_Order_Id;
                                                    if (!empty($param->ordernoapi)) {
                                                        echo $param->ordernoapi;
                                                    }
                                                    ?>
                                                </label>
                                            </td>
                                            <td>
                                                @if($param->Awb_Number)
                                                <a href="{{ asset('/UPProduct_Receipt/'.$param->Single_Order_Id) }}" target="_black" class="btn btn-sm" style="border-color:#FF4800;color:#FF4800">Download</a>
                                                @endif
                                            </td>
                                            <td>{{ $param->Awb_Number }}</td>
                                            <td>{{ $param->awb_gen_by }}</td>
                                            <td>{{ ucwords($param->Name) }}</td>
                                            <!--<td>{{ $param->Mobile }}</td>-->
                                            <!--<td>{{ $param->Address }}</td>-->
                                            <td>{{ $param->Pincode }}</td>
                                            <td><span>{{ $param->Item_Name }}</span></td>
                                            <td>{{ $param->Cod_Amount }}</td>
                                            <!--<td>{{ $param->Last_Stamp_Date }}</td>-->
                                            <td>
                                                @if($param->Awb_Number != '' && $param->order_status_show == "Upload")
                                                Processing
                                                @elseif($param->order_status_show == "Cancel")
                                                {{ $param->order_status_show }}ed
                                                @elseif($param->order_status_show == "Unexpected")
                                                Unknown Error
                                                @elseif($param->order_status_show == "Upload")
                                                Not Picked
                                                @else
                                                {{ $param->order_status_show }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($param->Awb_Number == '')

                                                {!! nl2br($param->showerrors) !!}
                                                @endif
                                            </td>
                                            <td>
                                                @if($param->order_cancel != '1')
                                                @if($param->Awb_Number)
                                                <a href="{{ asset('/BulkOrderDeletesmannual') }}/{{ $param->Awb_Number }}" style="color:red;cursor:pointer" onclick="return confirm('Are you sure cancel this order?')">Cancel</a>
                                                @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @php($i++)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">



            </footer>
            <!-- partial -->
        </div>




        <script>
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>

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

        @endsection