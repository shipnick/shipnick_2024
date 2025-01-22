@extends("UserPanel/userpanel_layout")
@section("userpanel")

<style type="text/css">
    .shipment {
        padding: 10px;
        margin-top: 5px;
    }

    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p {
        margin-bottom: 0px;
    }

    h4 {
        font-size: 21px;
        font-family: 'Arial', sans-serif;
        font-weight: 600;
    }

    p,
    h6 {
        font-size: 18px;
        font-family: 'Arial', sans-serif;
        font-weight: 600;
    }

    table.manifest-table {
        border-collapse: collapse;
        width: 100%;
        page-break-inside: avoid;
        color: #000000;
        /* float:left;
                margin:10px; */
    }



    table.prod-table {
        border-collapse: collapse;
        width: 100%;
        /* margin: auto; */
        border-top: none;
        font-size: 15px;
        color: #000000;
        font-family: 'Roboto', sans-serif;
    }

    table td {
        border: 1px solid black;
    }

    table .prod-table thead:first-child th {
        border-right: 1px solid;
    }

    table tr td:first-child {
        border-left: 0;
    }

    table .prod-table tr:last-child td {
        border-bottom: 0;
    }

    table tr td:last-child {
        border-right: 0;
    }

    .template_border {
        border: 2px solid #000;
    }

    .barcode {
        font-family: 'B39MHR';
        font-size: 65px;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .rotate270 {
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .mb5 {
        margin-bottom: 5px;
    }

    .fulfilledby {
        font-size: 15px;
        font-weight: 100;
        text-align: left;
    }

    table tr td {
        padding-left: 5px;
        padding-right: 5px;
    }

    body {
        line-height: 2.5;
    }

    /* .sign_manifest {
                    margin-bottom: -210px;
                    margin-right: -120px;
                    margin-left: 787px
                }

            .print_manifest {
                float: right;
                margin-top: 20px;
                margin-bottom: 10px;
                margin-right: 440px;
            }

            .print_invoice {
                margin-top: 45px;
            } */

    @media print {
        @page {
            /* size: auto;   auto is the initial value */
            size: 4in 6in;
            /* size: 8in 12in; */
            margin: 10px;
            /*this affects the margin in the printer settings*/
            color: #000000 !important;
        }

        .sign_manifest {
            display: none;
        }

        .print_manifest {
            display: none;
        }

        .print_invoice {
            display: none;
        }
    }

    /* For Screen Size below 991px */
    @media screen and (max-width: 991px) {
        .d_flex {
            display: flex;
            justify-content: space-between;
            width: 56%;
            padding: 10px;
        }

        .sign_manifest,
        .print_manifest {
            margin-right: 5%;
        }
    }

    /* For Screen Size above 991px */
    @media screen and (min-width: 991px) {
        .d_flex {
            float: right;
            margin-right: 30%;
            padding-top: 10px;
            /* position: fixed;
                    right: 1rem;
                    top: 4rem; */
        }

        .sign_manifest,
        .print_manifest {
            margin: 0px !important;
            display: block;
            margin-bottom: 10px !important;
        }
    }
</style>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item  active"><a href="javascript:void(0)">Settings</a></li>
            </ol>
        </div>
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Settings</h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs"
                                style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                <li class="nav-item font-weight-bold">
                                    <a style="font-weight: 700;" class="nav-link active font-w700" data-bs-toggle="tab"
                                        href="#home1"><i class="la la-smile solid"></i>&nbsp;&nbsp;KYC Details</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab"
                                        href="#profile2"><i class="la la-wallet"></i>&nbsp;&nbsp;Courier Permissions</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab"
                                        href="#profile1"><i class="la la-wallet"></i>&nbsp;&nbsp;Financial Details</a>
                                </li>
                                <li class="nav-item font-weight-bold" style="font-width:800">
                                    <a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab"
                                        href="#contact1"><i class="la la-home me-2"></i>&nbsp;&nbsp;Address Info.</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab"
                                        href="#Document"><i class="la la-wallet"></i>&nbsp;&nbsp;Documents</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a style="font-weight: 700;" class="nav-link font-w700" data-bs-toggle="tab"
                                        href="#label"><i class="la la-home me-2"></i>&nbsp;&nbsp;Label setting</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                    <div class="card-body">
                                        <div class="form-validation">

                                            <form method="post" action="{{ asset('/setting') }}"
                                                enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom01">Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom01" name="name"
                                                                    value="{{$params->name}}"
                                                                    placeholder="Enter name.." required>
                                                                <div class="invalid-feedback">
                                                                    Please enter name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom02">Email <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                            
                                                            <input type="text" class="form-control"
                                                                    id="validationCustom03"
                                                                    placeholder="Please enter a phone no." name="phone" value="{{$params->username}}"
                                                                    disabled>
                                                                <div class="invalid-feedback">
                                                                    Please enter a Email.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom03">Contact No.
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom03"
                                                                    placeholder="Please enter a phone no." name="phone" value="{{$params->mobile}}"
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a phone no.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom04">Address
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom04"
                                                                    placeholder="Please enter address"
                                                                    name="addressline1" value="{{$params->address1}}" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter Address
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom05">PIN
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom05"
                                                                    placeholder="Please enter PIN" name="zipcode"
                                                                    value="{{$params->pincode}}"
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Please enter PIN
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom05">GST Number
                                                                
                                                            </label>
                                                            <div class="col-lg-6">
                                                               
                                                            <input type="text" class="form-control"
                                                                    id="validationCustom04"
                                                                    placeholder="Please Enter GST Number"
                                                                    name="gst"  required>
                                                                <div class="invalid-feedback">
                                                                    Please enter GST Number 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile2">
                                    <div class="card-body">
                                        <div class="panel-body">
                                            <?php
                                                $couriercompany = ['NI' => 'Nimbus', 'IN' => 'Intargos'];
                                                $couriernames = [];
                                                foreach ($couriers as $cr) {
                                                    $couriernames[$cr->courier_by] = $cr->display_courier_by;
                                                }
                                                ?>

                                            <table class="datatable table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Sno</th>
                                                        <th>Courier Through</th>
                                                        <th>Courier Priority</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $cnt = 1; @endphp
                                                    @foreach($param as $item)
                                                    <tr>
                                                        <td>{{ $cnt++ }}</td>
                                                        <td>{{ $couriernames[$item->courier_by] ?? 'Unknown' }}</td>
                                                        <td>
                                                            <select class="form-control priority-select"
                                                                style="padding: 0 0 0 5px; height: 21px;"
                                                                onchange="updatePriorities(this, '{{ $item->courier_code }}', '{{ $item->courier_by }}')">
                                                                <option value="0">Priority not assigned</option>
                                                                @for($cnois = 1; $cnois <= count($param); $cnois++)
                                                                    <option value="{{ $cnois }}" @if($item->
                                                                    courier_priority == $cnois) selected @endif>
                                                                    Priority {{ $cnois }}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label class="switch">
                                                                <input type="checkbox"
                                                                    onchange="change_status('{{ $item->courier_code }}', '{{ $item->courier_by }}', this)"
                                                                    value="0" @if($item->user_flg) checked @endif>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            function updatePriorities(selectedElement, code, courier) {
                                                const selectedPriority = $(selectedElement).val();
                                                const allPriorityElements = $('.priority-select');

                                                allPriorityElements.each(function () {
                                                    if (this !== selectedElement) {
                                                        const currentSelected = $(this).val();
                                                        if (currentSelected == selectedPriority) {
                                                            $(this).find('option[value="' + selectedPriority + '"]').remove();
                                                            $(this).append('<option value="' + selectedPriority + '">Priority ' + selectedPriority + '</option>');
                                                        }
                                                    }
                                                });

                                                change_priority(code, courier, selectedPriority);
                                            }

                                            function change_priority(code, courier, value) {
                                                const userid = "{{ $id }}";
                                                $.ajax({
                                                    type: "GET",
                                                    url: "{{ asset('/courier-priority-update') }}",
                                                    data: {
                                                        code,
                                                        courier,
                                                        userid,
                                                        value
                                                    },
                                                    success: function (response) {
                                                        console.log('Priority updated successfully.');
                                                    },
                                                    error: function (error) {
                                                        console.error('Error updating priority:', error);
                                                    }
                                                });
                                            }

                                            function change_status(code, courier, checkbox) {
                                                const userid = "{{ $id }}";
                                                const value = $(checkbox).prop('checked') ? 1 : 0;
                                                $.ajax({
                                                    type: "GET",
                                                    url: "{{ asset('/courier-permissions-update') }}",
                                                    data: {
                                                        code,
                                                        courier,
                                                        userid,
                                                        value
                                                    },
                                                    success: function (response) {
                                                        console.log('Status updated successfully.');
                                                    },
                                                    error: function (error) {
                                                        console.error('Error updating status:', error);
                                                    }
                                                });
                                            }
                                        </script>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile1">
                                    <div class="card-body">
                                        <div class="form-validation">
                                            <form class="needs-validation" novalidate>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom01">Bank Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom01"
                                                                    placeholder="Enter bank name.." required>
                                                                <div class="invalid-feedback">
                                                                    Please enter bank name.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom02">Account Number<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom02"
                                                                    placeholder="Your account number.." required>
                                                                <div class="invalid-feedback">
                                                                    Please enter account number.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom03">IFSC
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom03"
                                                                    placeholder="Please enter IFSC" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter IFSC.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-3 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom05">Account Type
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <select class="default-select wide form-control"
                                                                    id="validationCustom05">
                                                                    <option data-display="Select account type">
                                                                        Please select account type</option>
                                                                    <option value="html">Current</option>
                                                                    <option value="css">Saving</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Please select an account type.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom04">UPLOAD CHEQUE
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                            <input type="file" id="formFile" name="cheque" class="form-control"/>
                                                                <div class="invalid-feedback">
                                                                    Please Upload Cheque
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact1">
                                    <div class="card-body">
                                        <div class="form-validation">
                                            <form class="needs-validation" novalidate>
                                                <div class="row"
                                                    style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom01">Address
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom01"
                                                                    placeholder="Enter address.." required>
                                                                <div class="invalid-feedback">
                                                                    Please enter address.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom02">State<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom02" placeholder="Your state.."
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Please enter state.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom03">City
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom03"
                                                                    placeholder="Please enter city" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter City.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom04">PIN
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control"
                                                                    id="validationCustom04"
                                                                    placeholder="Please enter PIN" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter PIN
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('input[type="checkbox"]').click(function () {
                                            var inputValue = $(this).attr("value");
                                            $("." + inputValue).toggle();
                                        });
                                    });
                                </script>
                                <div class="tab-pane fade" id="label" class="card-body">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Select Label Format</h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{asset('shipping-label-select')}}" method="post">@csrf
                                                    <div class="row">
                                                        <div class="col-xl-4 col-xxl-4 col-4">
                                                            <div class="form-check custom-radio mb-3">
                                                                <!-- Radio Button for Label Default -->
                                                                <input type="radio" class="form-check-input" id="customRadio1" name="label" value="defult" required onclick="toggleDiv('default')" {{ optional($selectLabel)->label_type == 'defult' ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="margin-top: 2%;" for="customRadio1">Label Default</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-xxl-4 col-4">
                                                            <div class="form-check custom-radio mb-3">
                                                                <!-- Radio Button for Label Format 1 -->
                                                                <input type="radio" class="form-check-input" id="customRadio2" name="label" value="label_first" required onclick="toggleDiv('format1')"
                                                                    {{ optional($selectLabel)->label_type == 'label_first' ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="margin-top: 2%;" for="customRadio2">Label Format 1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-xxl-4 col-4">
                                                            <div class="form-check custom-radio mb-3">
                                                                <!-- Radio Button for Label Format 2 -->
                                                                <input type="radio" class="form-check-input" id="customRadio3" name="label" value="label_second" required onclick="toggleDiv('format2')"

                                                                    {{ optional($selectLabel)->label_type == 'label_second' ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="margin-top: 2%;" for="customRadio3">Label Format 2</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">save</button>
                                                    <!-- Divs to show/hide based on selected radio button -->


                                                    <script>
                                                        function toggleDiv(selectedOption) {
                                                            // Hide all divs
                                                            const divs = document.querySelectorAll('.extra-div');
                                                            divs.forEach(function(div) {
                                                                div.style.display = 'none';
                                                            });

                                                            // Show the selected div
                                                            if (selectedOption === 'default') {
                                                                document.getElementById('defaultDiv').style.display = 'block';
                                                            } else if (selectedOption === 'format1') {
                                                                document.getElementById('format1Div').style.display = 'block';
                                                            } else if (selectedOption === 'format2') {
                                                                document.getElementById('format2Div').style.display = 'block';
                                                            }
                                                        }
                                                    </script>

                                                </form>
                                            </div>
                                        </div>
                                    </div>





                                    <!-- <form action="shipping-label-setting" method="post">@csrf
												<input type="submit">
											</form> -->

                                    <div id="defaultDiv" class="extra-div" style="display:none;">
                                        <!-- <p>This is the Default Label format section.</p> -->
                                        <form class="card-body" action="{{asset('shipping-label-setting')}}"
                                            method="post">@csrf

                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="filter cm-content-box box-primary">
                                                        <div class="content-title border-0">
                                                            <div class="cpa">
                                                                Customize shipping label
                                                            </div>

                                                        </div>
                                                        <div class="card-body mt-4 ">
                                                            <input type="hidden" value="defult" name="labbel_type">
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active"
                                                                    id="Viewall-tab-pane" role="tabpanel"
                                                                    aria-labelledby="Viewall-tab" tabindex="0">
                                                                    <div class="menu-tabs-1">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Consignee_Number"
                                                                                value="Consignee_Number"
                                                                                id="flexCheckDefault" {{
                                                                                isset($label_setting) &&
                                                                                $label_setting->Consignee_Number ?
                                                                            'checked' : '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault">
                                                                                Hide Consignee Number
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="order_id"
                                                                                value="order_id" id="flexCheckDefault-1"
                                                                                {{ isset($label_setting) &&
                                                                                $label_setting->order_id ? 'checked' :
                                                                            '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-1">
                                                                                Hide Order ID
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Products_Details"
                                                                                value="Products_Details"
                                                                                id="flexCheckDefault-2" {{
                                                                                isset($label_setting) &&
                                                                                $label_setting->Products_Details ?
                                                                            'checked' : '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-2">
                                                                                Hide Products Details
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Return_Address"
                                                                                value="Return_Address"
                                                                                id="flexCheckDefault-3" {{
                                                                                isset($label_setting) &&
                                                                                $label_setting->Return_Address ?
                                                                            'checked' : '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-3">
                                                                                Hide Return Address
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Weight"
                                                                                value="Weight" id="flexCheckDefault-4"
                                                                                {{ isset($label_setting) &&
                                                                                $label_setting->Weight ? 'checked' : ''
                                                                            }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-4">
                                                                                Hide Weight
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Dimensions"
                                                                                value="Dimensions"
                                                                                id="flexCheckDefault-5" {{
                                                                                isset($label_setting) &&
                                                                                $label_setting->Dimensions ? 'checked' :
                                                                            '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-5">
                                                                                Hide Dimensions
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Support_Mobile"
                                                                                value="Support_Mobile"
                                                                                id="flexCheckDefault-6" {{
                                                                                isset($label_setting) &&
                                                                                $label_setting->Support_Mobile ?
                                                                            'checked' : '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-6">
                                                                                Hide Support Mobile
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" name="Support_email"
                                                                                value="Support_email"
                                                                                id="flexCheckDefault-7" {{
                                                                                isset($label_setting) &&
                                                                                $label_setting->Support_email ?
                                                                            'checked' : '' }}>
                                                                            <label
                                                                                class="form-check-label mt-1 font-w700"
                                                                                for="flexCheckDefault-7">
                                                                                Hide Support Mail
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="cm-content-body form excerpt border-top">
                                                                    <div class="card-body">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-xl-12">
                                                                                <h6>Business / Seller Display Name</h6>
                                                                            </div>
                                                                            <div class="col-xl-12">
                                                                                <input type="text" id="name"
                                                                                    name="display_name"
                                                                                    class="form-control mb-2"
                                                                                    value="{{ isset($label_setting) ? $label_setting->display_name : '' }}"
                                                                                    onmouseout="showValue()">
                                                                            </div>
                                                                            <div class="row Support_Mobile">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Support Mobile</h6>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <input type="text"
                                                                                        name="supportnumber"
                                                                                        class="form-control mb-2"
                                                                                        value="{{ isset($label_setting) ? $label_setting->supportnumber : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row Support_email">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Support email</h6>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <input type="text"
                                                                                        name="supportemail"
                                                                                        class="form-control mb-2"
                                                                                        value="{{ isset($label_setting) ? $label_setting->supportemail : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row ">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Display Other RTO Address</h6>
                                                                                </div>

                                                                                <div class="col-xl-12">
                                                                                    <textarea id="rtoaddress"
                                                                                        name="rtoaddress"
                                                                                        class="form-control mb-2"
                                                                                        onmouseout="showAddress()">{{ old('rtoAddress', $label_setting->rtoAddress ?? '') }}</textarea>

                                                                                </div>
                                                                            </div>

                                                                            <script>
                                                                                function showValue() {
                                                                                    var name = document.getElementById('name').value;
                                                                                    document.getElementById('ans').innerHTML = name;
                                                                                    document.getElementById('hello').style.display = "none";
                                                                                }

                                                                                function showAddress() {
                                                                                    var name = document.getElementById('rtoaddress').value;
                                                                                    document.getElementById('ansrto').innerHTML = name;
                                                                                    document.getElementById('hellorto').style.display = "none";
                                                                                }
                                                                            </script>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="col-xl-8">
                                                    <div class="filter cm-content-box box-primary">

                                                        <div class="cm-content-body form excerpt rounded-0">
                                                            <div class="card-body ">
                                                                <h6 class="mb-0 content-title  mb-4 cpa">Current
                                                                    Template</h6>
                                                                <!-- <p>Add menu items from the column on the left.</p> -->
                                                                <div class="col-xl-11">
                                                                    <div class="dd" id="nestable">
                                                                        <table class="manifest-table template_border">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="3"
                                                                                        style="text-align:center;">
                                                                                        <h3 id="hello"><b>

                                                                                                Business / Seller
                                                                                                Display Name</b></h3>
                                                                                        <h3 id="ans"
                                                                                            style="font-weight: 800;">
                                                                                        </h3>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <h6 class="fulfilledby">
                                                                                            Fulfilled By: </h6>


                                                                                        <img src="{{asset('/img/ecom.jpg')}}"
                                                                                            title="Hub Image"
                                                                                            style="width: 170px;">

                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="line-height: 1.7;">
                                                                                    <td colspan="4"
                                                                                        class="text-center  "
                                                                                        style="border: none;">
                                                                                        <?php

                                                                                            echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(410010342551, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60% ;margin-top: 2%;" />';
                                                                                            ?>
                                                                                        <br /> <span
                                                                                            style="font-size: 25px; margin-left:10%">410010342551</span>
                                                                                        <span style="float: left;">
                                                                                            <!-- <h6>AMT/AAT/AAT</h6> -->
                                                                                        </span>
                                                                                        <span style="float: right;"
                                                                                            class="order_id">
                                                                                            <h6>Order #</h6>
                                                                                            <h4><b>123456</b></h4>
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="line-height: 20px;">
                                                                                    <td class="address-cell"
                                                                                        colspan="3">
                                                                                        <p>Deliver To:</p>
                                                                                        <h4 class="mb5">name</h4>
                                                                                        <p style="line-height: 1.5em;">
                                                                                            address<br />
                                                                                            city - pincode<br />
                                                                                            <span
                                                                                                class="Consignee_Number">
                                                                                                9999XXXXXX
                                                                                            </span>

                                                                                        </p>
                                                                                    </td>

                                                                                    <td class="text-center">
                                                                                        <h4> <b>COD</b>
                                                                                        </h4>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr style="border: 1px solid #000;">
                                                                                    <td colspan="3"
                                                                                        style="border: none; line-height:2em;">
                                                                                        <p>Ref./Invoice #: <br />
                                                                                            <span
                                                                                                class="Dimensions">Size
                                                                                                : 5 x 3 x 2 </span>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td
                                                                                        style="border: none; line-height:2em;">
                                                                                        <p class="Weight">Date:
                                                                                            <?php

                                                                                                                    // echo date_format( "d-m-Y");
                                                                                                                    ?>
                                                                                            <br />
                                                                                            Weight: 15
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td colspan="4"
                                                                                        class="Products_Details">
                                                                                        <table class="prod-table"
                                                                                            style="border: 1px solid black;">
                                                                                            <h6
                                                                                                style="margin-top: 5px;margin-bottom: 5px;">
                                                                                                In the Package<h6>
                                                                                                    <thead
                                                                                                        style="line-height: 1.5em;">
                                                                                                        <th>Product Name
                                                                                                        </th>
                                                                                                        <th>SKU</th>
                                                                                                        <th>Qty</th>
                                                                                                        <th
                                                                                                            class="text-right">
                                                                                                            Price</th>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                style="line-height: 1.5em;">
                                                                                                                item
                                                                                                            </td>
                                                                                                            <td
                                                                                                                style="line-height: 1.5em;">
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                            <td
                                                                                                                class="text-right">
                                                                                                                999</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td colspan="2"
                                                                                                                class="text-right">
                                                                                                                <p>Total
                                                                                                                </p>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <p>1</p>
                                                                                                            </td>
                                                                                                            <td
                                                                                                                class="text-right">
                                                                                                                <p>999
                                                                                                                </p>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="line-height: 1.5em;">
                                                                                    <td colspan="4" class="address ">
                                                                                        <div class="Return_Address">If
                                                                                            undelivered, please return
                                                                                            to:<br />

                                                                                            <h6 id="hellorto"><b>

                                                                                                    hubname, <br>
                                                                                                    hub address,
                                                                                                    hub state,
                                                                                                    hub city
                                                                                                    -hub pincode</b>
                                                                                                <br>
                                                                                                Phone :
                                                                                                <b>9999XXXXXX</b>
                                                                                            </h6>
                                                                                            <p id="ansrto"
                                                                                                style="font-weight: 800;">
                                                                                            </p>


                                                                                            </p>
                                                                                        </div>
                                                                                        <span style="font-size:small">
                                                                                            <br><b>For any query please
                                                                                                contact</b>
                                                                                            <span
                                                                                                class="Support_Mobile">Mobile:9999999
                                                                                                , </span>
                                                                                            <span
                                                                                                class="Support_email">Email:support@trenchy.com</span>

                                                                                            <hr
                                                                                                style="border: 1px solid black; margin:0">
                                                                                            This is computer generated
                                                                                            document, hence does not
                                                                                            required signature
                                                                                            <br> <b>Note:</b> All
                                                                                            disputes are subject to
                                                                                            Delhi jurisdication. Goods
                                                                                            once sold will only be
                                                                                            taken back or exchanged as
                                                                                            per the store's
                                                                                            exchange/return policy
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="filter cm-content-box box-primary style-1 mb-0 border-0">
                                                <div class="content-title">
                                                    <input type="submit" value="Save Changes"
                                                        class="btn btn-secondary my-2">


                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="format1Div" class="extra-div" style="display:none;">
                                        <!-- <p>This is Label Format 1 section.</p> -->
                                        <form class="card-body" action="{{asset('shipping-label-setting')}}" method="post">@csrf
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="filter cm-content-box box-primary">
                                                        <div class="content-title border-0">
                                                            <div class="cpa">
                                                                Customize shipping label
                                                            </div>

                                                        </div>
                                                        <div class="card-body mt-4 ">
                                                            <input type="hidden" value="label_first" name="labbel_type">

                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="Viewall-tab-pane" role="tabpanel" aria-labelledby="Viewall-tab" tabindex="0">
                                                                    <div class="menu-tabs-1">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Consignee_Number" value="Consignee_Number1" id="flexCheckDefault"
                                                                                {{ isset($label_setting1) && $label_setting1->Consignee_Number ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault">
                                                                                Hide Consignee Number
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="order_id" value="order_id1" id="flexCheckDefault-1"
                                                                                {{ isset($label_setting1) && $label_setting1->order_id ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-1">
                                                                                Hide Order ID
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Products_Details" value="Products_Details1" id="flexCheckDefault-2"
                                                                                {{ isset($label_setting1) && $label_setting1->Products_Details ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-2">
                                                                                Hide Products Details
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Return_Address" value="Return_Address1" id="flexCheckDefault-3"
                                                                                {{ isset($label_setting1) && $label_setting1->Return_Address ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-3">
                                                                                Hide Return Address
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Weight" value="Weight1" id="flexCheckDefault-4"
                                                                                {{ isset($label_setting1) && $label_setting1->Weight ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-4">
                                                                                Hide Weight
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Dimensions" value="Dimensions1" id="flexCheckDefault-5"
                                                                                {{ isset($label_setting1) && $label_setting1->Dimensions ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-5">
                                                                                Hide Dimensions
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Support_Mobile" value="Support_Mobile1" id="flexCheckDefault-6"
                                                                                {{ isset($label_setting1) && $label_setting1->Support_Mobile ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-6">
                                                                            Hide Support Mobile
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Support_email" value="Support_email1" id="flexCheckDefault-7"
                                                                                {{ isset($label_setting1) && $label_setting1->Support_email ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-7">
                                                                            Hide Support Mail
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="cm-content-body form excerpt border-top">
                                                                    <div class="card-body">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-xl-12">
                                                                                <h6>Business / Seller Display Name</h6>
                                                                            </div>
                                                                            <div class="col-xl-12">
                                                                                <input type="text" id="name" name="display_name" class="form-control mb-2" value="{{ isset($label_setting1) ? $label_setting1->display_name : '' }}" onmouseout="showValue()">
                                                                            </div>
                                                                            <div class="row Support_Mobile">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Support Mobile</h6>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <input type="text" name="supportnumber" class="form-control mb-2" value="{{ isset($label_setting1) ? $label_setting1->supportnumber : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row Support_email">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Support email</h6>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <input type="text" name="supportemail" class="form-control mb-2" value="{{ isset($label_setting1) ? $label_setting1->supportemail : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row ">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Display Other RTO Address</h6>
                                                                                </div>

                                                                                <div class="col-xl-12">
                                                                                    <textarea id="rtoaddress" name="rtoaddress" class="form-control mb-2" onmouseout="showAddress()">{{ old('rtoAddress', $label_setting1->rtoAddress ?? '') }}</textarea>

                                                                                </div>
                                                                            </div>

                                                                            <script>
                                                                                function showValue() {
                                                                                    var name = document.getElementById('name').value;
                                                                                    document.getElementById('ans').innerHTML = name;
                                                                                    document.getElementById('hello').style.display = "none";
                                                                                }

                                                                                function showAddress() {
                                                                                    var name = document.getElementById('rtoaddress').value;
                                                                                    document.getElementById('ansrto').innerHTML = name;
                                                                                    document.getElementById('hellorto').style.display = "none";
                                                                                }
                                                                            </script>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <table class="manifest-table template_border">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="3" style="text-align:center;">
                                                                    <h3><b>
                                                                            Rudhraveda India
                                                                </td>
                                                                <td class="text-center">
                                                                    <h6 class="fulfilledby">Fulfilled By:</h6>

                                                                    <img src="{{asset('/img/ecom.jpg')}}" title="Hub Image" style="width: 170px;">
                                                                </td>
                                                            </tr>

                                                            <tr style="line-height: 20px;">
                                                                <td class="address-cell" colspan="3">
                                                                    <!-- <p>Deliver To:</p> -->
                                                                    <h4 class="mb5">Rinchin Choizom</h4>
                                                                    <p style="line-height: 1.5em;">
                                                                        Office Of Sub Treasury Officer<br />
                                                                        DIRANG :-790101<br />
                                                                        <span class="Consignee_Number1">
                                                                            9999XXXXXX
                                                                        </span>
                                                                        test@gmail.cvom
                                                                    </p>
                                                                </td>

                                                                <td class="">
                                                                    <p style="font-size: medium;">ORDER NO. -</p>
                                                                    #1123
                                                                    <p style="font-size: medium;">INVOICE DATE -</p>
                                                                    27-11-2024
                                                                    <span class="Weight1">
                                                                        <p style="font-size: medium;">WEIGHT-</p>
                                                                        0.50 (kgs)
                                                                    </span>


                                                                    <span class="Dimensions1">
                                                                        <p style="font-size: medium;">DIMENSION -</p>Size : 5 x 3 x 2
                                                                    </span>
                                                                </td>

                                                            </tr>
                                                            <tr style="line-height: 1.7;">
                                                                <td colspan="3" class="text-center"
                                                                    style="border-left: dotted 1px; border-top: none; border-right: none; border-bottom: none;border: dotted 2px;">
                                                                    <?php
                                                                      $awbno = 14344943258629;
                                                                      echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60%; height:80px;margin-top: 2%;"  />';
                                                                      ?>
                                                                    <br />AWB - 14344943258629 <br>
                                                                </td>
                                                                <td style="border: dotted 2px;" class="text-center" class="order_id1">
                                                                    <p>ORDER NO.</p>
                                                                    <span>#78985</span>
                                                                </td>
                                                            </tr>


                                                            <tr style="border: 1px solid #000;" class="Products_Details1">
                                                                <td colspan="4" style="border: none; line-height:2em;" class="text-center">
                                                                    <h5>PRODUCT</h5>

                                                                    Men's Clothing Combo Pack - 34 X (1) 1492


                                                                </td>

                                                            </tr>

                                                            <tr style="line-height: 1.7;">
                                                                <td colspan="3" class="text-center">
                                                                    <h2>Rs.998.00</h2>
                                                                    <p>Amount to be Collected</p>

                                                                </td>
                                                                <td class="text-center">
                                                                    <h1>COD</h1>


                                                                </td>
                                                            </tr>



                                                            <tr style="line-height: 1.5em;">
                                                                <td colspan="4" class="address">
                                                                    <p class="Return_Address1">If undelivered, please return to: <br>
                                                                        krish,<br>
                                                                        Vikas Vihar Kakrola, Delhi, Delhi -110078 <br>
                                                                        Phone : 7503XXXXXX
                                                                        <br>
                                                                    </p>

                                                                    <br><b>For any query please contact</b>
                                                                    <span class="Support_Mobile1">Mobile:9999999 , </span>
                                                                    <span class="Support_email1">Email:support@trenchy.com</span>

                                                                    <span style="font-size:small ">

                                                                        <hr style="border: 1px solid black; margin:0;">
                                                                        <span style="font-size: 7px;">All Disputes are subject to Delhi Jurisdication , Goods once sold will only be taken back or exchanged as per the store's exchange / return policy.</span>

                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="filter cm-content-box box-primary style-1 mb-0 border-0">
                                                <div class="content-title">
                                                    <input type="submit" value="Save Changes" class="btn btn-secondary my-2">


                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="format2Div" class="extra-div" style="display:none;">
                                        <!-- <p>This is Label Format 2 section.</p> -->
                                        <form class="card-body" action="{{asset('shipping-label-setting')}}" method="post">@csrf
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="filter cm-content-box box-primary">
                                                        <div class="content-title border-0">
                                                            <div class="cpa">
                                                                Customize shipping label
                                                            </div>

                                                        </div>
                                                        <div class="card-body mt-4 ">
                                                            <input type="hidden" value="label_second" name="labbel_type">
                                                            <div class="tab-content" id="myTabContent">
                                                                <div class="tab-pane fade show active" id="Viewall-tab-pane" role="tabpanel" aria-labelledby="Viewall-tab" tabindex="0">
                                                                    <div class="menu-tabs-1">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Consignee_Number" value="Consignee_Number2" id="flexCheckDefault"
                                                                                {{ isset($label_setting2) && $label_setting2->Consignee_Number ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault">
                                                                                Hide Consignee Number
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="order_id" value="order_id2" id="flexCheckDefault-1"
                                                                                {{ isset($label_setting2) && $label_setting2->order_id ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-1">
                                                                                Hide Order ID
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Products_Details" value="Products_Details2" id="flexCheckDefault-2"
                                                                                {{ isset($label_setting2) && $label_setting2->Products_Details ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-2">
                                                                                Hide Products Details
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Return_Address" value="Return_Address2" id="flexCheckDefault-3"
                                                                                {{ isset($label_setting2) && $label_setting2->Return_Address ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-3">
                                                                                Hide Return Address
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Weight" value="Weight2" id="flexCheckDefault-4"
                                                                                {{ isset($label_setting2) && $label_setting2->Weight ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-4">
                                                                                Hide Weight
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Dimensions" value="Dimensions2" id="flexCheckDefault-5"
                                                                                {{ isset($label_setting2) && $label_setting2->Dimensions ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-5">
                                                                                Hide Dimensions
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Support_Mobile" value="Support_Mobile2" id="flexCheckDefault-6"
                                                                                {{ isset($label_setting2) && $label_setting2->Support_Mobile ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-6">
                                                                            Hide Support Mobile
                                                                            </label>
                                                                        </div>
                                                                        <pre></pre>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="Support_email" value="Support_email2" id="flexCheckDefault-7"
                                                                                {{ isset($label_setting2) && $label_setting2->Support_email ? 'checked' : '' }}>
                                                                            <label class="form-check-label mt-1 font-w700" for="flexCheckDefault-7">
                                                                            Hide Support Mail
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="cm-content-body form excerpt border-top">
                                                                    <div class="card-body">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-xl-12">
                                                                                <h6>Business / Seller Display Name</h6>
                                                                            </div>
                                                                            <div class="col-xl-12">
                                                                                <input type="text" id="name" name="display_name" class="form-control mb-2" value="{{ isset($label_setting2) ? $label_setting2->display_name : '' }}" onmouseout="showValue()">
                                                                            </div>
                                                                            <div class="row Support_Mobile">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Support Mobile</h6>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <input type="text" name="supportnumber" class="form-control mb-2" value="{{ isset($label_setting2) ? $label_setting2->supportnumber : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row Support_email">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Support email</h6>
                                                                                </div>
                                                                                <div class="col-xl-12">
                                                                                    <input type="text" name="supportemail" class="form-control mb-2" value="{{ isset($label_setting2) ? $label_setting2->supportemail : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row ">
                                                                                <div class="col-xl-12">
                                                                                    <h6>Display Other RTO Address</h6>
                                                                                </div>

                                                                                <div class="col-xl-12">
                                                                                    <textarea id="rtoaddress" name="rtoaddress" class="form-control mb-2" onmouseout="showAddress()">{{ old('rtoAddress', $label_setting2->rtoAddress ?? '') }}</textarea>

                                                                                </div>
                                                                            </div>

                                                                            <script>
                                                                                function showValue() {
                                                                                    var name = document.getElementById('name').value;
                                                                                    document.getElementById('ans').innerHTML = name;
                                                                                    document.getElementById('hello').style.display = "none";
                                                                                }

                                                                                function showAddress() {
                                                                                    var name = document.getElementById('rtoaddress').value;
                                                                                    document.getElementById('ansrto').innerHTML = name;
                                                                                    document.getElementById('hellorto').style.display = "none";
                                                                                }
                                                                            </script>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <table class="manifest-table template_border">
                                                        <tbody>

                                                            <tr style="line-height: 20px;">
                                                                <td class="address-cell" colspan="4">
                                                                    <p>To:</p>
                                                                    <h4 class="mb5">Rinchin Choizom</h4>
                                                                    <span style="line-height: 1.5em;">
                                                                        Office Of Sub Treasury Officer<br />
                                                                        DIRANG :-790101<br />
                                                                        <span class="Consignee_Number2">
                                                                            9999XXXXXX
                                                                        </span>
                                                                        test@gmail.cvom
                                                                    </span>
                                                                    <hr style="border: 1px solid black; margin:0">
                                                                </td>



                                                            </tr>

                                                            <tr>
                                                                <td colspan="3" style="border: none; line-height:2em;">
                                                                    <p>Order Date: Nov 27, 2024 </p>
                                                                    <p>Invoice No: #18570</p>
                                                                </td>
                                                                <td style="text-align:center">
                                                                    <p style="margin-top: 1%;">
                                                                        <?php
                                                                          $Invoice = 18570;
                                                                          echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($Invoice, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:40%; height:60px;"/>';
                                                                          ?>
                                                                        <br>


                                                                        #18570

                                                                    </p>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <hr style="border: 1px solid black; margin:0">
                                                                </td>
                                                            </tr>

                                                            <tr style="line-height: 20px;">
                                                                <td class="text-center">
                                                                    <h4> <b>Prepaid</b>
                                                                        <p>₹0</p>
                                                                    </h4>
                                                                </td>
                                                                <td class="address-cell" colspan="3" style="text-align:center;">
                                                                    <p> Bluedart</p>
                                                                    <?php
                                                                      $awbno = 14344943258629;
                                                                      echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60%; height:80px;" />';
                                                                      ?>
                                                                    <br />AWB - 14344943258629 <br>
                                                                </td>
                                                            </tr>

                                                            <tr>

                                                                <td colspan="3" style="text-align:center;" class="Weight2">

                                                                    WEIGHT : 0.5 KG
                                                                </td>
                                                                <td class="text-center">
                                                                    <span class="Dimensions2">Dimensions (cm): 10 X 12 X 11 </span>


                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="4" class="Products_Details2">

                                                                    <table class="prod-table" style="border: 1px solid black;">
                                                                        <h6 style="margin-top: 5px;margin-bottom: 5px;">In the Package<h6>
                                                                                <thead style="line-height: 1.5em;" style="border: 1px solid black;">
                                                                                    <th style="border: 1px solid black;">Product Name</th>
                                                                                    <th style="border: 1px solid black;"> SKU</th>
                                                                                    <th style="border: 1px solid black;">Qty</th>
                                                                                    <th class="text-right">Price</th>
                                                                                </thead>
                                                                                <tbody style="border: 1px solid black;">
                                                                                    <tr style="border: 1px solid black;">
                                                                                        <td style="border: 1px solid black;">R.O.H.C Steel Wired Dishwashing Gloves -
                                                                                            Gloves
                                                                                            For Washing</td>
                                                                                        <td style="border: 1px solid black;"></td>
                                                                                        <td>1</td>
                                                                                        <td class="text-right" style="border: 1px solid black;">210</td>
                                                                                    </tr>
                                                                                    <tr style="border: 1px solid black;">
                                                                                        <td colspan="2" class="text-right" style="border: 1px solid black;">
                                                                                            <p>Total</p>
                                                                                        </td>
                                                                                        <td style="border: 1px solid black;">
                                                                                            <p>1</p>
                                                                                        </td>
                                                                                        <td class="text-right" style="border: 1px solid black;">
                                                                                            <p>219</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>



                                                            <tr style="line-height: 1.5em;">
                                                                <td colspan="4" class="address">
                                                                    <p class="Return_Address2">If undelivered, please return to: <br>
                                                                        krish,<br>
                                                                        Vikas Vihar Kakrola, Delhi, Delhi -110078 <br>
                                                                        Phone : 7503XXXXXX
                                                                        <br><br>
                                                                    </p>

                                                                    <hr style="border: 1px solid black; margin:0">
                                                                    This is computer generated document, hence does not require signature
                                                                    <br> <b>Note:</b> All disputes are subject to Delhi jurisdication. Goods once sold will only be
                                                                    taken back or exchanged as per the store's exchange/return policy


                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="filter cm-content-box box-primary style-1 mb-0 border-0">
                                                <div class="content-title">
                                                    <input type="submit" value="Save Changes" class="btn btn-secondary my-2">


                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="Document">
                                    <div class="card-body">
                                        <div class="form-validation">
                                            <form class="needs-validation" novalidate>
                                                <div class="row"
                                                    style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom01">GST Certificate/Company Incorporated Document
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control"
                                                                    id="validationCustom01"
                                                                    placeholder="Enter address.." required>
                                                                <div class="invalid-feedback">
                                                                    
                                                                   
                                                                </div>
                                                                
                                                            </div>
                                                            <!-- <div class="col-lg-2">
                                                               
                                                                <button class="form-control"><i class="fa-regular fa-eye"></i> View</button>
                                                            </div> -->
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom02">Photo or selfie<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control"
                                                                    id="validationCustom02" placeholder="Your state.."
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Please enter state.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom03">PAN Card/Driving License
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control"
                                                                    id="validationCustom03"
                                                                    placeholder="Please enter city" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter City.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-lg-4 col-form-label"
                                                                for="validationCustom04">Aadhaar Card/Passport/Voter ID Card
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-lg-6">
                                                                <input type="file" class="form-control"
                                                                    id="validationCustom04"
                                                                    placeholder="Please enter PIN" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter PIN
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-xs-12 col-md-12 col-lg-12">
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Submit</button>
                                                    <button type="button"
                                                        class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
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



@endsection()
