@extends('UserPanel.Layout_1')

@php(error_reporting(1))
@section('bodycontent')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">COD Remittance 
                        @if(session('status')=="Hub Details Delete Successfully")
	<span style="color:green;font-size: 14px;">
		{{ session('status') }}
	</span>
@elseif(session('status'))
	<span style="color:orange;font-size: 14px;">
		{{ session('status') }}
	</span>
@endif </h4>
                        <div class="text-right">
                            <span style="font-size:14px;color:red">&ensp;* Last 5 Days</span>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>Remit ID</th>
		<th>Due Date</th>
		<th>Expected Amt</th>
		<th>Transaction ID</th>
		<th>Download Report</th>
		<th>Status</th>
                                    </tr>
                                </thead>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
        </div>
    </footer>

</div>




@endsection

