@extends('UserPanel.Layout_1')

@section('bodycontent')
@php(error_reporting(1))

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

<!--<center><span style="color:red;font-weight:900;font-size:20px">*Under Maintenance Page*</span></center>-->

                        <h4 class="card-title mt-4">Print Shipping Labels</h4>
                        <form method="post" action="{{ asset('/Labels_Print') }}" target="_black">
                            <div class="col-md-12">
                                <h6 class="title">Write Next AWB Number In New Line</h6>
                                    <textarea class="form-control" rows="4" name="awbnoisa" placeholder="Write AWB Number Line By Line [Max 100]"><?php
                                        foreach ($params as $param){
                                            echo $param."\n";
                                        }
                                    ?></textarea>
                                @csrf
                                <br>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="newcheck" value="1">
                                           whithout return address
                                    </label>
                                </div>
                                <span style="float:right;">
                                    <button class="btn btn-primary" type="submit" title="Print A4 Size" value="a4size"
                                        name="printout"><i class="fa fa-print" aria-hidden="true"></i>&ensp; A4
                                        Size</button>
                                    <button class="btn btn-primary" type="submit" title="Print A6 Size" value="a6size"
                                        name="printout"><i class="fa fa-print" aria-hidden="true"></i>&ensp; A6
                                        Size</button>
                                    <button class="btn btn-primary" type="submit" title="Thermal Print Size"
                                        value="thermalsize" name="printout"><i class="fa fa-print"
                                            aria-hidden="true"></i>&ensp; Thermal Print</button>
                                </span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet"
    href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
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