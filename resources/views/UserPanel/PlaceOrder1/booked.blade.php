@extends("UserPanel/userpanel_layout1")
@section("userpanel")
<style>
    .header-new {
        position: fixed;
        /* Change to fixed positioning */
        top: 178px;
        /* Always stick to the top */
        width: 100%;
        /* background-color: white; */
        /* Optional: to ensure it stands out */
        z-index: 1000;
        /* Ensure it stays above other content */
    }

    .button-clor-white {
        background-color: white;
    }

    .hidden {
        display: none;
    }
</style>
{{-- <script>
	// Perform background URL hit asynchronously
	fetch('https://shipnick.com/UPBulk_Order_API', {
			method: 'GET'
		})
		.then(response => {
			// Handle the response if needed
		})
		.catch(error => {
			console.error('Error performing background URL hit:', error);
		});
</script> --}}
<script>
    window.addEventListener('scroll', function() {
        var header = document.querySelector('.header-new');
        var scrollPosition = window.scrollY;

        if (scrollPosition > 105) { // Adjust this value as needed
            header.style.position = 'fixed';
            header.style.top = '105px';
        } else {
            header.style.position = 'absolute'; // Or use a value that fits your layout
            header.style.top = '181px'; // Adjust to match your original design
        }
    });
</script>


<div class="content-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center mb-3">
            <div class="mb-3 me-auto">
                <div class="card-tabs style-1 mt-3 mt-sm-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="booked-order">Booked ({{$booked}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pickup-pending">Pick-up Pending ({{$pending_pickup}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="intransit">In Transit ({{$in_transit}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ofd">OFD ({{$ofd}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="deliverd">Delivered ({{$deliver}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rto">RTO/RTS ({{$rto}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cancelled">Cancelled ({{$cancel}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="failled">Failed ({{$failde}})</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <button class="button btn btn-outline-primary btn-sm">FILTERS</button>
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

        <script>
            document.getElementById('downloadExcelBtn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission
                document.getElementById('downloadExcelForm').submit(); // Submit the form manually
            });
        </script>
        <script>
            document.getElementById('downloadExcelBtn').addEventListener('click', function() {
                var cfromdate = "{{ $cfromdate }}";
                var ctodate = "{{ $ctodate }}";
                var ftype = "Excel";

                var url = "{{ asset('/today-placed-orders') }}";
                url += "?cfromdate=" + encodeURIComponent(cfromdate);
                url += "&ctodate=" + encodeURIComponent(ctodate);
                url += "&ftype=" + encodeURIComponent(ftype);

                window.location.href = url;
            });
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
                                                        <form id="filterForm" action="{{ url('/booked-order') }}" method="get">
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
                                                                // Initialize the date range picker
                                                                $('#daterange').daterangepicker({
                                                                    opens: 'left',
                                                                    startDate: '{{ request()->get('
                                                                    from ', date("Y-m-d", strtotime("-30 days"))) }}',
                                                                    endDate: '{{ request()->get('
                                                                    to ', date("Y-m-d")) }}',
                                                                    locale: {
                                                                        format: 'YYYY-MM-DD'
                                                                    }
                                                                }, function(start, end) {
                                                                    // Set the input value to the selected date range
                                                                    $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                                                                    // Update hidden input fields with selected dates
                                                                    $('#start_date').val(start.format('YYYY-MM-DD'));
                                                                    $('#end_date').val(end.format('YYYY-MM-DD'));
                                                                });

                                                                // Set the hidden fields if values are present on page load
                                                                if ($('#daterange').val() === '') {
                                                                    $('#start_date').val('{{ request()->get('
                                                                        from ') }}');
                                                                    $('#end_date').val('{{ request()->get('
                                                                        to ') }}');
                                                                }
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
                                <form method="post" action="{{ asset('/filter-selected-order') }}" target="_blank">
                                    @csrf
                                    <div id="myDiv" class="hidden">
                                        <div class="d-flex justify-content-start align-items-center header-new button-clor-white ">
                                            <button name="currentbtnname" value="shippinglabel" type="submit"
                                                class="btn btn-outline-primary mt-1 me-3 mb-3 btn-sm button-clor-white">
                                                <i class="fa fa-calendar me-1"></i> Print Label
                                            </button>
                                            <button name="currentbtnname" value="cancelorders" type="submit"
                                                class="btn btn-outline-primary mt-1 me-3 mb-3 btn-sm button-clor-white">
                                                <i class="fa fa-times-circle me-1"></i> Cancel Orders
                                            </button>
                                            <button name="currentbtnname" value="exportorderdetails" class="btn btn-outline-secondary btn-sm me-3 mb-2 button-clor-white">
                                                <i class="fa fa-download me-1 "></i> Export
                                            </button>
                                            <button id="downloadExcelBtn" class="btn btn-outline-secondary btn-sm mb-2 button-clor-white">
                                                <i class="fa fa-download me-1"></i> Export All
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

                                    <div class="table-responsive fs-13 card  fc-view">
                                        <table class="table card-table display mb-4 dataTablesCard text-black" id="example1">
                                            <thead style="background-color:#17a2b89c;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="toggle(this);" style="border-color: black;">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>AWB #</th>
                                                    <th>ID Orders</th>
                                                    <th>Type</th>
                                                    <th>Date </th>
                                                    <th>Product</th>
                                                    <th>Customer </th>
                                                    <th>address</th>
                                                    <th>Courier</th>
                                                    <th>Status</th>
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
                                                    <td><span>{{ $param->Awb_Number }}</span></td>
                                                    <td><span>{{ $param->ordernoapi }}</span></td>
                                                    <td><span>{{ $param->Order_Type }}</span></td>
                                                    <td>
                                                        <span>{{ date('Y-m-d', strtotime($param->Last_Time_Stamp)) }}</span><br />
                                                        <span>
                                                            {{ date('H:i:s', strtotime($param->Last_Time_Stamp)) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ Str::limit($param->Item_Name, 10) }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <h6 class="fs-13 mb-0 text-nowrap"><span>{{ Str::limit($param->Name, 10) }}</span><br />
                                                                    <span>{{$param->Mobile}}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span title="{{$param->Address}}"> {{ Str::limit($param->Address, 20) }}</span></td>
                                                    <td><span>{{ $param->awb_gen_by }}</span></td>
                                                    <td>
                                                        @if($param->showerrors=='Upload')
                                                        <a href="javascript:void(0)" class="btn btn-success btn-sm btn-rounded light">Manifested</a>

                                                        @else
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-rounded light" title="{{$param->showerrors}}">{{ Str::limit($param->showerrors, 20) }}</a>

                                                        @endif

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
                                                                    <button class="dropdown-item" type="submit"><i class="las la-info-circle scale5 me-3 "></i>Print Label</button>
                                                                </form>
                                                                <a class="dropdown-item" href="#" title="Cancel">
                                                                    <i class="las fa-file-invoice  scale5 me-3"></i>Print invoice</a>
                                                                <a class="dropdown-item" href="#" title="Cancel">
                                                                    <i class="las fa-file-invoice  scale5 me-3"></i>Print manifest</a>
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
                                        <form id="perPageForm" action="{{ url('/booked-order') }}" method="get">
                                            <div class="mb-3 col-md-2">
                                                <label for="perPageSelect" class="form-label">Showing 1 to 50 </label>
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
                                    document.addEventListener('DOMContentLoaded', () => {
                                        const checkboxes = document.querySelectorAll('input.form-check-input[type="checkbox"]');
                                        const myDiv = document.getElementById('myDiv');
                                        const checkAllCheckbox = document.getElementById('checkAll');

                                        // Function to update the visibility of myDiv
                                        function updateDivVisibility() {
                                            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                                            myDiv.classList.toggle('hidden', !anyChecked);
                                        }

                                        // Add event listeners to all checkboxes
                                        checkboxes.forEach(checkbox => {
                                            checkbox.addEventListener('change', updateDivVisibility);
                                        });

                                        // Add event listener to the "check all" checkbox
                                        checkAllCheckbox.addEventListener('change', function() {
                                            const isChecked = this.checked;
                                            checkboxes.forEach(checkbox => {
                                                checkbox.checked = isChecked;
                                            });
                                            updateDivVisibility();
                                        });
                                    });
                                </script>
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

    </div>
</div>

<script>
    document.getElementById('failedBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission
        document.getElementById('failedBtnform').submit(); // Submit the form manually
    });
</script>
<script>
    document.getElementById('failedBtn').addEventListener('click', function() {
        var cfromdate = "{{ $cfromdate }}";
        var ctodate = "{{ $ctodate }}";
        var ftype = "Excel";

        var url = "{{ asset('/today-failed-orders') }}";
        url += "?cfromdate=" + encodeURIComponent(cfromdate);
        url += "&ctodate=" + encodeURIComponent(ctodate);
        url += "&ftype=" + encodeURIComponent(ftype);

        window.location.href = url;
    });
</script>


<script>
    document.getElementById('downloadExcelBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission
        document.getElementById('downloadExcelForm').submit(); // Submit the form manually
    });
</script>
<script>
    document.getElementById('downloadExcelBtn').addEventListener('click', function() {
        var cfromdate = "{{ $cfromdate }}";
        var ctodate = "{{ $ctodate }}";
        var ftype = "Excel";

        var url = "{{ asset('/today-placed-orders') }}";
        url += "?cfromdate=" + encodeURIComponent(cfromdate);
        url += "&ctodate=" + encodeURIComponent(ctodate);
        url += "&ftype=" + encodeURIComponent(ftype);

        window.location.href = url;
    });
</script>

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
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('input.form-check-input[type="checkbox"]');
        const myDiv = document.getElementById('myDiv');
        const checkAllCheckbox = document.getElementById('checkAll');

        // Function to update the visibility of myDiv
        function updateDivVisibility() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            myDiv.classList.toggle('hidden', !anyChecked);
        }

        // Add event listeners to all checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDivVisibility);
        });

        // Add event listener to the "check all" checkbox
        checkAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateDivVisibility();
        });
    });
</script>


@endsection
