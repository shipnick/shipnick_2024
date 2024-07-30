@extends('UserPanel.Layout_1')

@section('bodycontent')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Menifest (* Last 5 Days)</h4>
                        <div class="template-demo">


                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Menifest Date</th>
                                        <th>Report</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @php($j=1)
                                    @foreach($days0 as $days)
                                    <tr style="font-size:13px">
                                        <th>{{ $i }}</th>
                                        <th>{{ $tdate0 }} {{ $days->uploadtime }}</th>
                                        <th>MIS Report {{ $j }}</th>
                                        <th><a href="{{ asset('/UPMIS_Report_Excel') }}/{{ $tdate0 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
                                    </tr>
                                    @php($i++)
                                    @php($j++)
                                    @endforeach
                                    @php($j=1)
                                    @foreach($days1 as $days)
                                    <tr style="font-size:13px">
                                        <th>{{ $i }}</th>
                                        <th>{{ $tdate1 }} {{ $days->uploadtime }}</th>
                                        <th>MIS Report {{ $j }}</th>
                                        <th><a href="{{ asset('/UPMIS_Report_Excel') }}/{{ $tdate1 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
                                    </tr>
                                    @php($i++)
                                    @php($j++)
                                    @endforeach
                                    @php($j=1)
                                    @foreach($days2 as $days)
                                    <tr style="font-size:13px">
                                        <th>{{ $i }}</th>
                                        <th>{{ $tdate2 }} {{ $days->uploadtime }}</th>
                                        <th>MIS Report {{ $j }}</th>
                                        <th><a href="{{ asset('/UPMIS_Report_Excel') }}/{{ $tdate2 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
                                    </tr>
                                    @php($i++)
                                    @php($j++)
                                    @endforeach
                                    @php($j=1)
                                    @foreach($days3 as $days)
                                    <tr style="font-size:13px">
                                        <th>{{ $i }}</th>
                                        <th>{{ $tdate3 }} {{ $days->uploadtime }}</th>
                                        <th>MIS Report {{ $j }}</th>
                                        <th><a href="{{ asset('/UPMIS_Report_Excel') }}/{{ $tdate3 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
                                    </tr>
                                    @php($i++)
                                    @php($j++)
                                    @endforeach
                                    @php($j=1)
                                    @foreach($days4 as $days)
                                    <tr style="font-size:13px">
                                        <th>{{ $i }}</th>
                                        <th>{{ $tdate4 }} {{ $days->uploadtime }}</th>
                                        <th>MIS Report {{ $j }}</th>
                                        <th><a href="{{ asset('/UPMIS_Report_Excel') }}/{{ $tdate4 }}/{{ $days->uploadtime }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i> Download </a></th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
    <!-- partial -->
</div>



@endsection