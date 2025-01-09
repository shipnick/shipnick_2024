@extends("UserPanel/userpanel_layout1")
@section("userpanel")

<div class="content-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center mb-3">
            <div class=" me-auto">
                <div class="card-tabs style-1 mt-3 mt-sm-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " href="booked-order">New Orders ({{$booked}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="pickup-pending">Ready to ship ({{$pending_pickup}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="intransit">In Transit ({{$in_transit}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="ofd">OFD ({{$ofd}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="deliverd">Delivered ({{$deliver}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="rto">RTO/RTS ({{$rto}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cancelled">All Orders ({{$cancel}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="failled">Failed ({{$failde}})</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="form-group">
                <button class="button btn btn-outline-primary btn-sm">Date Range</button>
            </div>
        </div>
    </div>

    <style>
        #hidden_div {
            display: none;
        }

        table.dataTable tbody td {
            padding: 0px 0px;
            font-weight: 600;
            border-bottom: 0;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .table thead th {

            font-size: 12px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".button").click(function() {
                $(".p").toggle();
            });
        });
    </script>

    <script>
        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
        }
    </script>


    <!-- <script>
    $(document).ready(function() {
    $('#perPageSelect').change(function() {
        var form = $('#searchForm1');
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                // Assuming the server returns the updated content in the 'response' variable
                $('#allordersshows').html(response);
            },
            error: function(xhr) {
                console.log('Error:', xhr);
            }
        });
    });
}); -->

    </script>



    <div class="row " id="allordersshows">
        <div class="col-xl-12 tab-content">
            <div class="tab-pane fade show active" id="booked" role="tabpanel" aria-labelledby="booked-tab">
                <div class="row">
                    <div class="col-xl-12 tab-content">
                        <div class="tab-pane fade show active" id="AllTransaction" role="tabpanel" aria-labelledby="transaction-tab">
                            <div class="row p" style="display:none">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 order-lg-1">
                                                    <h4 class="mb-3">FILTERS</h4>
                                                    <form id="filterForm" action="{{ url('/cancelled') }}" method="get">
                                                        <input type="hidden" name="per_page" id="hiddenPerPage" value="{{ request()->get('per_page', 10) }}">
                                                        <input type="hidden" name="from" id="start_date" value="{{ request()->get('from') }}">
                                                        <input type="hidden" name="to" id="end_date" value="{{ request()->get('to') }}">

                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 mb-1">
                                                                <div class="example">
                                                                    <p class="mb-1">Date Range</p>
                                                                    <input type="text" id="daterange" class="form-control"
                                                                        value="{{ request()->get('from') && request()->get('to') ? request()->get('from') . ' - ' . request()->get('to') : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
                                                                <label class="form-label">Courier</label>
                                                                <select class="default-select form-control wide w-100" name="courier">
                                                                    <option value="">Select...</option>
                                                                    <option value="Ecom" {{ request()->get('courier') == 'Ecom' ? 'selected' : '' }}>Ecom</option>
                                                                    <option value="Xpressbee" {{ request()->get('courier') == 'Xpressbee' ? 'selected' : '' }}>Xpressbee</option>
                                                                    <option value="Bluedart" {{ request()->get('courier') == 'Bluedart' ? 'selected' : '' }}>Bluedart</option>
                                                                    <option value="Ekart" {{ request()->get('courier') == 'Ekart' ? 'selected' : '' }}>Ekart</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
                                                                <label for="product_name" class="form-label">Product Name</label>
                                                                <input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name" value="{{ request()->get('product_name') }}">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
                                                                <label for="waybill" class="form-label">Waybill Number</label>
                                                                <input type="text" class="form-control" id="waybill" placeholder="AWB Number" name="awb" value="{{ request()->get('awb') }}">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 mb-3">
                                                                <label class="form-label">Order Type</label>
                                                                <select class="default-select form-control wide w-100" name="order_type">
                                                                    <option value="">Select...</option>
                                                                    <option value="COD" {{ request()->get('order_type') == 'COD' ? 'selected' : '' }}>COD</option>
                                                                    <option value="Prepaid" {{ request()->get('order_type') == 'Prepaid' ? 'selected' : '' }}>Prepaid</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
                                                                <label class="form-label">Cannel</label>
                                                                <select class="default-select form-control wide w-100" name="cannel">
                                                                    <option value="">Select...</option>
                                                                    <option value="Excel" {{ request()->get('cannel') == 'Excel' ? 'selected' : '' }}>Excel</option>
                                                                    <option value="shopify" {{ request()->get('cannel') == 'shopify' ? 'selected' : '' }}>shopify</option>
                                                                    <option value="Single" {{ request()->get('cannel') == 'single' ? 'selected' : '' }}>single order</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mb-1">
                                                                <label for="waybill" class="form-label">ORDER ID</label>
                                                                <input type="text" class="form-control" id="waybill" name="orderid" value="{{ request()->get('awb') }}">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 mb-3">
                                                                <label class="form-label" for="warehouse">Warehouse</label>
                                                                <select class="default-select form-control wide w-100" name="warehouse" id="warehouse">
                                                                    <option value="" disabled selected>Select a warehouse</option> <!-- Placeholder option -->
                                                                    @foreach($Hubs1 as $Hub)
                                                                    <option value="{{ ucwords($Hub->hub_id) }}">
                                                                        {{ ucwords($Hub->hub_code) }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr class="mb-4">
                                                        <button type="submit" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Search</button>
                                                        <a href="{{ url('/booked-order') }}" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Clear</a>
                                                    </form>
                                                    <script>
                                                        $(function() {
                                                            // Initialize the date range picker with the options
                                                            $('#daterange').daterangepicker({
                                                                opens: 'left', // Position the calendar to the left
                                                                startDate: moment().subtract(6, 'days'), // Default to Last 7 Days
                                                                endDate: moment(), // End on today
                                                                locale: {
                                                                    format: 'YYYY-MM-DD' // Format of the date
                                                                },
                                                                ranges: {
                                                                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')], // Yesterday
                                                                    'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')], // Tomorrow
                                                                    'Last 7 Days': [moment().subtract(6, 'days'), moment()], // Last 7 Days
                                                                    'Last 30 Days': [moment().subtract(29, 'days'), moment()], // Last 30 Days
                                                                    'This Month': [moment().startOf('month'), moment().endOf('month')], // This Month
                                                                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')] // Last Month
                                                                }
                                                            }, function(start, end) {
                                                                // When the date range is selected, update the input fields
                                                                $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                                                                $('#start_date').val(start.format('YYYY-MM-DD'));
                                                                $('#end_date').val(end.format('YYYY-MM-DD'));
                                                            });

                                                            // Set the initial value based on the selected range
                                                            var start = moment().subtract(6, 'days'); // Default to Last 7 Days
                                                            var end = moment(); // Today
                                                            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                                                            $('#start_date').val(start.format('YYYY-MM-DD'));
                                                            $('#end_date').val(end.format('YYYY-MM-DD'));
                                                        });
                                                    </script>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .hidden {
                                    display: none;
                                }
                            </style>
                            <form method="post" action="{{ asset('/filter-selected-order') }}">
                                @csrf
                                <div id="myDiv" class="hidden">
                                    <div class="d-flex justify-content-start align-items-center header-new">
                                        <!--                  <button name="currentbtnname" value="shippinglabel" type="submit"-->
                                        <!--	class="btn btn-outline-primary mt-1 me-3 mb-3 btn-sm button-clor-white">-->
                                        <!--	<i class="fa fa-calendar me-1"></i> Print Label-->
                                        <!--</button>-->
                                        <!--<button name="currentbtnname" value="cancelorders" type="submit"-->
                                        <!--	class="btn btn-outline-primary mt-1 me-3 mb-3 btn-sm button-clor-white">-->
                                        <!--	<i class="fa fa-times-circle me-1"></i> Cancel Orders-->
                                        <!--</button>-->
                                        <button name="currentbtnname" value="exportorderdetails" class="btn btn-outline-secondary btn-sm me-3 mb-2 button-clor-white">
                                            <i class="fa fa-download me-1 "></i> Export
                                        </button>
                                    </div>
                                </div>
                                <style>
                                    .table td {
                                        font-weight: 700;
                                        border-color: #e6e6e6;
                                        padding: 0px 10px;
                                    }
                                </style>

                                <div class="table-responsive fs-13 card fc-view">
                                    <table class="table card-table display mb-4 dataTablesCard text-black" id="example1">
                                        <thead style="background-color:#17a2b89c;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="toggle(this);" style="border-color: black;">
                                                        <label class="form-check-label" for="checkAll"></label>
                                                    </div>
                                                </th>
                                                <th>CHANNEL</th>
                                                <th>ORDER ID</th>
                                                <th>DATE</th>
                                                <th>CUSTOMER</th>

                                                <th>PRODUCTS</th>
                                                <th>QTY</th>
                                                <th>AMOUNT</th>
                                                <th>TYPE</th>
                                                <th>AWB</th>
                                                <th>CARRIER</th>
                                                <th>STATUS</th>
                                                <th class="text-end"> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderTableBody">
                                            @foreach($params as $param)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="selectedorder[]" value="<?= $param->Awb_Number ?>" style="border-color: black;">
                                                    </div>
                                                </td>
                                                <td><span>{{ $param->uploadtype }}</span></td>
                                                <td><span>{{ $param->orderno }}</span></td>
                                                <td>
                                                    <span>{{ date('Y-m-d', strtotime($param->Last_Time_Stamp)) }}</span><br />
                                                    <span>
                                                        {{ date('H:i:s', strtotime($param->Last_Time_Stamp)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h6 class="fs-13 mb-0 text-nowrap"><span>{{ Str::limit($param->Name, 10) }}</span><br />
                                                                <span>{{$param->Mobile}}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span title="{{$param->Item_Name}}">{{ Str::limit($param->Item_Name, 10) }}</span> </td>
                                                <td><span>{{ $param->Quantity }}</span></td>
                                                <td><span>{{ $param->Total_Amount }}</span></td>
                                                <td><span>{{ $param->Order_Type }}</span></td>
                                                <td><a href="/order/{{ $param->ordernoapi }}"><span>{{ $param->Awb_Number }}</span></a> </td>
                                                <td>{{ $param->awb_gen_by }}</td>

                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light">{{ Str::limit($param->showerrors, 20) }}</a>

                                                </td>
                                                <td class="text-end">
                                                    <div class="dropdown dropstart">
                                                        <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu">


                                                            <a class="dropdown-item" href="{{ asset('/UPAll_Cancel_Orders_Now/'.$param->Awb_Number) }}" title="Cancel">
                                                                <i class="las la-times-circle text-danger scale5 me-3"></i>Cancel Order</a>

                                                            <form action=""></form>


                                                            <form action="Labels_Print" method="post">
                                                                @csrf
                                                                <input type="hidden" name="awbnoisa" value="{{ $param->Awb_Number }}">
                                                                <button class="dropdown-item" type="submit"><i class="las la-info-circle scale5 me-3 "></i>Download Invoice</button>
                                                            </form>
                                                            <a class="dropdown-item" href="edit-order/{{ $param->Single_Order_Id }}" title="Edit Order">
                                                                <i class="las fa-file-invoice  scale5 me-3"></i>Edit Order</a>
                                                            <a class="dropdown-item" href="clone-order/{{ $param->Single_Order_Id }}" title="Cancel">
                                                                <i class="las fa-file-invoice  scale5 me-3"></i>Clone Order</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="perPageForm" action="{{ url('/cancelled') }}" method="get">
                                        <div class="mb-3 col-md-2">
                                            <label for="perPageSelect" class="form-label">Results per page</label>
                                            <select id="perPageSelect" name="per_page" class="form-control" onchange="updatePerPage()">
                                                <option value="50" {{ request()->get('per_page') == '5' ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request()->get('per_page') == '10' ? 'selected' : '' }}>100</option>
                                                <option value="200" {{ request()->get('per_page') == '20' ? 'selected' : '' }}>200</option>
                                                <option value="500" {{ request()->get('per_page') == '50' ? 'selected' : '' }}>500</option>
                                            </select>
                                        </div>
                                    </form>

                                    <script>
                                        function updatePerPage() {
                                            var perPage = document.getElementById('perPageSelect').value;
                                            document.getElementById('hiddenPerPage').value = perPage;
                                            document.getElementById('filterForm').submit();
                                        }
                                    </script>

                                </div>
                                <div class="col-md-6 ">
                                    <div id="newpaginationnew" style="float: right;">
                                        {{ $params->appends([
                                        'per_page' => request()->get('per_page'),
                                        'from' => request()->get('from'),
                                        'to' => request()->get('to'),
                                        'courier' => request()->get('courier'),
                                        'product_name' => request()->get('product_name'),
                                        'awb' => request()->get('awb'),
                                        'order_type' => request()->get('order_type')
                                    ])->links() }}
                                    </div>
                                </div>
                            </div>


                            <script>
                                $(document).ready(function() {
                                    $('#perPageSelect').change(function() {
                                        $('#searchForm1').submit();
                                    });
                                });
                            </script>
                            <!-- Pagination Links -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @endsection
