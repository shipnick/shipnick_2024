@extends("UserPanel/userpanel_layout1")
@section("userpanel")
<style>
    .header-new {
        position: fixed;
        /* Change to fixed positioning */
        top: 190px;
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

    .table thead th {

        font-size: 12px;
    }
</style>
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

<script>
    window.addEventListener('scroll', function() {
        var header = document.querySelector('.header-new');
        var scrollPosition = window.scrollY;

        if (scrollPosition > 105) { // Adjust this value as needed
            header.style.position = 'fixed';
            header.style.top = '105px';
        } else {
            header.style.position = 'absolute'; // Or use a value that fits your layout
            header.style.top = '194px'; // Adjust to match your original design
        }
    });
</script>
<style>
    .card-body {
        padding: 1rem;
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

<div class="content-body">
    <div class="container-fluid" style="padding-top: 0;">
        <div class="d-flex flex-wrap align-items-center ">
            <div class="  me-auto">
                <div class="card-tabs style-1 mt-3 mt-sm-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " href="UPNDR_Report">NDR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="report-ndr">NDR <span class="fs-12">(wrong Address/Phone)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="report-ndr-delivered">NDR Delivered</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="report-rto">RTO </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="report-rto-delivered">RTO Delivered </a>
                        </li>
                       
                    </ul>

                </div>
            </div>
            <button class="button btn btn-outline-primary btn-sm"><i class="fa-solid fa-filter"></i></button>
        </div>

        <div class="row mt-2" id="allordersshows">
            <div class="col-xl-12 tab-content ">
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
                                                            <input type="hidden" name="per_page" id="hiddenPerPage" value="{{ request()->get('per_page', 50) }}">
                                                            <input type="hidden" name="from" id="start_date" value="{{ request()->get('from') }}">
                                                            <input type="hidden" name="to" id="end_date" value="{{ request()->get('to') }}">

                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 ">
                                                                    <div class="example">
                                                                        <p class="mb-1">Date Range</p>
                                                                        <input type="text" id="daterange" class="form-control"
                                                                            value="{{ request()->get('from') && request()->get('to') ? request()->get('from') . ' - ' . request()->get('to') : '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 ">
                                                                    <label for="product_name" class="form-label">Customer name</label>
                                                                    <input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name" value="{{ request()->get('product_name') }}">
                                                                </div>
                                                               
                                                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 ">
                                                                    <label for="waybill" class="form-label">ORDER ID</label>
                                                                    <input type="text" class="form-control" id="waybill" name="orderid" >
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 ">
                                                                    <label class="form-label">AWB No.</label>
                                                                    <input type="text" class="form-control" id="waybill" name="waybill" >
                                                                </div>

                                                            </div>
                                                            <!-- <hr class="mb-4"> -->
                                                            <button type="submit" class="btn btn-secondary ms-sm-auto mt-1 mb-sm-0">Search</button>
                                                            <a href="{{ url('/booked-order') }}" class="btn btn-secondary ms-sm-auto mt-1 mb-sm-0">Clear</a>
                                                        </form>






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
                                <form method="post" action="{{ asset('/filter-selected-order1') }}">
                                    @csrf
                                    <div id="myDiv" class="hidden " style="margin-bottom: 5%;">
                                        <div class="d-flex justify-content-start align-items-center header-new button-clor-white ">
                                            
                                            <button name="currentbtnname" value="exportorderdetails" class="btn btn-outline-secondary  me-3 mb-2 btn-sm button-clor-white">
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

                                    <div class="table-responsive fs-13 card  fc-view ">
                                        <table class="table card-table display mb-4 dataTablesCard text-black" id="example1">
                                            <thead style="background-color:#17a2b89c;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                                                <tr>

                                                    <th style="padding-left: 2%;">

                                                        <div class="" style="line-height: 2;">
                                                            <span id="selectedCountText">0</span>
                                                            <input class="form-check-input" type="checkbox" value="" id="checkAll" onclick="toggle(this);" style="border-color: black;">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Order date</th>
                                                    <th>Order Details</th>
                                                    <th>Product details</th>
                                                    <th>Payment</th>
                                                    <th>Tracking Info</th>
                                                    <th>NDR Details</th>
                                                    <th>Action</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody></tbody>

                                        </table>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                    <form id="perPageForm" action="{{ url('/booked-order') }}" method="get">
                                        <div class="mb-3 col-md-2">
                                            <label for="perPageSelect" class="form-label" id="showingLabel">Showing 1 to 50</label>
                                            <select id="perPageSelect" name="per_page" class="form-control" onchange="updatePerPage()">
                                                <option value="50" {{ request()->get('per_page') == '50' ? 'selected' : (request()->get('per_page') == null ? 'selected' : '') }}>50</option>
                                                <option value="100" {{ request()->get('per_page') == '100' ? 'selected' : '' }}>100</option>
                                                <option value="200" {{ request()->get('per_page') == '200' ? 'selected' : '' }}>200</option>
                                                <option value="500" {{ request()->get('per_page') == '500' ? 'selected' : '' }}>500</option>
                                            </select>
                                        </div>
                                    </form>

                                    <script>
                                        // Update the "Showing X to Y" label when the page loads
                                        window.onload = function() {
                                            updateShowingLabel();
                                        };

                                        function updatePerPage() {
                                            var perPage = document.getElementById('perPageSelect').value;
                                            var url = new URL(window.location.href);
                                            url.searchParams.set('per_page', perPage); // Update the per_page query parameter
                                            window.location.href = url.toString(); // Navigate to the updated URL
                                        }

                                        function updateShowingLabel() {
                                            var perPage = new URLSearchParams(window.location.search).get('per_page') || '50'; // Default to 50 if not specified
                                            var labelText = `Showing 1 to ${perPage}`;
                                            document.getElementById('showingLabel').textContent = labelText;
                                        }
                                    </script>

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
<!-- checkbox count start -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('input.form-check-input[type="checkbox"]:not(#checkAll)');
        const checkAllCheckbox = document.getElementById('checkAll');
        const selectedCountText = document.getElementById('selectedCountText'); // This is the counter element

        // Function to update the visibility of the counter
        function updateSelectedCount() {
            const selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            selectedCountText.textContent = selectedCheckboxes.length; // Update count text
        }

        // Add event listeners to all checkboxes (excluding the "check all" checkbox)
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Add event listener to the "check all" checkbox
        checkAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateSelectedCount(); // Update the count after toggling
        });
    });
</script>
<!-- checkbox count end -->
<!-- daterange filter  -->
<script>
    $(function() {
        // Function to get the query parameter value by name
        function getQueryParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.has(name) ? urlParams.get(name) : null;
        }

        // Get 'from' and 'to' dates from the URL query parameters
        const fromDate = getQueryParameter('from');
        const toDate = getQueryParameter('to');

        // Initialize the date range picker with options
        $('#daterange').daterangepicker({
            opens: 'left', // Position the calendar to the left
            locale: {
                format: 'YYYY-MM-DD' // Format of the date
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function(start, end) {
            // When the date range is selected, update the input fields
            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        });

        // Set the initial value based on the 'from' and 'to' query parameters
        if (fromDate && toDate) {
            var start = moment(fromDate, 'YYYY-MM-DD');
            var end = moment(toDate, 'YYYY-MM-DD');
            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        } else {
            // If no parameters are found, default to Last 7 Days
            var start = moment().subtract(6, 'days');
            var end = moment();
            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        }
    });
</script>
<!-- end daterange filter  -->
<script>
    document.getElementById('failedBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission
        document.getElementById('failedBtnform').submit(); // Submit the form manually
    });
</script>



<script>
    document.getElementById('downloadExcelBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission
        document.getElementById('downloadExcelForm').submit(); // Submit the form manually
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