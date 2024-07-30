@if(empty(session('UserLogin2')))
    <script type="text/javascript">
        window.location.assign("{{ asset('/AdminLogin') }}");
    </script>
@endif

@extends('UserPanel.Layout_1')

@section('bodycontent')
@php(error_reporting(1))

<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <span>{{ session('UserLogin2name') }}</span></h3>
                  <!--<h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>-->
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Today (<?= date('d-M-Y') ?>)
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">This Week</a>
                        <a class="dropdown-item" href="#">This month</a>
                        <a class="dropdown-item" href="#">All Time</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!--<div class="col-md-6 grid-margin stretch-card">-->
              <!--<div class="card tale-bg">-->
                <!--<div class="card-people mt-auto">-->
                <!--  <img src="{{asset('Admin/images/dashboard/people.svg')}}" alt="people">-->
                <!--  <div class="weather-info">-->
                <!--    <div class="d-flex">-->
                <!--      <div>-->
                <!--        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>28<sup>C</sup></h2>-->
                <!--      </div>-->
                <!--      <div class="ml-2">-->
                <!--        <h4 class="location font-weight-normal">INDIA</h4>-->
                <!--        <h6 class="font-weight-normal">DEIHI NCR</h6>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
            <!--  </div>-->
            <!--</div>-->
            
            <!--<div class="col-md-6 mt-3 card tale-bg">-->
            <!--    <b>*Currently Show  Data</b>-->
            <!--    <canvas id="north-america-chart"></canvas>-->
            <!--    <div id="north-america-legend"></div>-->
            <!--    <br>&ensp;-->
            <!--</div>-->
                              
            <div class="col-md-12 grid-margin transparent">&ensp;
              <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Today’s Bookings</p>
                      <p class="fs-30 mb-2">{{ $talluploaded }}</p>
                      <!--<p>10.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Delivered Orders</p>
                      <p class="fs-30 mb-2">{{ $tallcomplete }}</p>
                      <!--<p>22.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
                 <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Intransit</p>
                      <p class="fs-30 mb-2">{{ $intransitupload }}</p>
                      <!--<p>22.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">COD Amount</p>
                      <p class="fs-30 mb-2">{{ $codamount }}</p>
                      <!--<p>2.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
                <div class="col-md-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">RTO</p>
                      <p class="fs-30 mb-2">{{ $tallcancel }}</p>
                      <!--<p>0.22% (30 days)</p>-->
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>

          <!--<div class="row">-->
          <!--  <div class="col-md-12 grid-margin stretch-card">-->
          <!--    <div class="card position-relative">-->
          <!--      <div class="card-body">-->
          <!--        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"-->
          <!--          data-ride="carousel">-->
          <!--          <div class="carousel-inner">-->
          <!--            <div class="carousel-item active">-->
          <!--              <div class="row">-->
          <!--                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">-->
          <!--                  <div class="ml-xl-4 mt-3">-->
          <!--                    <p class="card-title">COD Detailed Reports</p>-->
          <!--                    <h1 class="text-primary">₹34040</h1>-->
          <!--                    <h3 class="font-weight-500 mb-xl-4 text-primary">India</h3>-->
          <!--                    <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the-->
          <!--                      period time a user is actively engaged with your website, page or app, etc</p>-->
          <!--                  </div>-->
          <!--                </div>-->
          <!--                <div class="col-md-12 col-xl-9">-->
          <!--                  <div class="row">-->
          <!--                    <div class="col-md-6 border-right">-->
          <!--                      <div class="table-responsive mb-3 mb-md-0 mt-3">-->
          <!--                        <table class="table table-borderless report-table">-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">user 1</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"-->
          <!--                                  aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">713</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">user 2</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"-->
          <!--                                  aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">583</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">User 3</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"-->
          <!--                                  aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">924</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">User 4</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%"-->
          <!--                                  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">664</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">User 5</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%"-->
          <!--                                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">560</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">User 6</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"-->
          <!--                                  aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">793</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                        </table>-->
          <!--                      </div>-->
          <!--                    </div>-->
          <!--                    <div class="col-md-6 mt-3">-->
          <!--                      <canvas id="north-america-chart"></canvas>-->
          <!--                      <div id="north-america-legend"></div>-->
          <!--                    </div>-->
          <!--                  </div>-->
          <!--                </div>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--            <div class="carousel-item">-->
          <!--              <div class="row">-->
          <!--                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">-->
          <!--                  <div class="ml-xl-4 mt-3">-->
          <!--                    <p class="card-title">Prepaid Detailed Reports</p>-->
          <!--                    <h1 class="text-primary">₹34040</h1>-->
          <!--                    <h3 class="font-weight-500 mb-xl-4 text-primary">India ,Delhi</h3>-->
          <!--                    <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the-->
          <!--                      period time a user is actively engaged with your website, page or app, etc</p>-->
          <!--                  </div>-->
          <!--                </div>-->
          <!--                <div class="col-md-12 col-xl-9">-->
          <!--                  <div class="row">-->
          <!--                    <div class="col-md-6 border-right">-->
          <!--                      <div class="table-responsive mb-3 mb-md-0 mt-3">-->
          <!--                        <table class="table table-borderless report-table">-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">Admin 1</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"-->
          <!--                                  aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">713</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">Admin 2</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"-->
          <!--                                  aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">583</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">Admin 3</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"-->
          <!--                                  aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">924</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">Admin 4</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%"-->
          <!--                                  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">664</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">Admin 5</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%"-->
          <!--                                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">560</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                          <tr>-->
          <!--                            <td class="text-muted">Admin 6</td>-->
          <!--                            <td class="w-100 px-0">-->
          <!--                              <div class="progress progress-md mx-4">-->
          <!--                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"-->
          <!--                                  aria-valuenow="79" aria-valuemin="0" aria-valuemax="100"></div>-->
          <!--                              </div>-->
          <!--                            </td>-->
          <!--                            <td>-->
          <!--                              <h5 class="font-weight-bold mb-0">793</h5>-->
          <!--                            </td>-->
          <!--                          </tr>-->
          <!--                        </table>-->
          <!--                      </div>-->
          <!--                    </div>-->
          <!--                    <div class="col-md-6 mt-3">-->
          <!--                      <canvas id="south-america-chart"></canvas>-->
          <!--                      <div id="south-america-legend"></div>-->
          <!--                    </div>-->
          <!--                  </div>-->
          <!--                </div>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--          </div>-->
          <!--          <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">-->
          <!--            <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
          <!--            <span class="sr-only">Previous</span>-->
          <!--          </a>-->
          <!--          <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">-->
          <!--            <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
          <!--            <span class="sr-only">Next</span>-->
          <!--          </a>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          
          
          
          <!--<div class="row">-->
          <!--  <div class="col-md-12 grid-margin stretch-card">-->
          <!--    <div class="card">-->
          <!--      <div class="card-body">-->
          <!--         <p class="card-title mb-0">Top Products</p> -->
          <!--        <div class="table-responsive">-->
          <!--          <table class="table table-striped table-borderless">-->
          <!--            <thead>-->
          <!--              <tr>-->
          <!--                <th>Admins</th>-->
          <!--                <th>Total Orders</th>-->
          <!--                <th>Prepaid</th>-->
          <!--                <th>COD</th>-->
          <!--                <th>Status</th>-->
          <!--              </tr>-->
          <!--            </thead>-->
          <!--            <tbody>-->
          <!--              <tr>-->
          <!--                <td>Search Engine Marketing</td>-->
          <!--                <td class="font-weight-bold">$362</td>-->
          <!--                <td>21 Sep 2018</td>-->

          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-success">Completed</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--              <tr>-->
          <!--                <td>Search Engine Optimization</td>-->
          <!--                <td class="font-weight-bold">$116</td>-->
          <!--                <td>13 Jun 2018</td>-->
          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-success">Completed</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--              <tr>-->
          <!--                <td>Display Advertising</td>-->
          <!--                <td class="font-weight-bold">$551</td>-->
          <!--                <td>28 Sep 2018</td>-->
          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-warning">Pending</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--              <tr>-->
          <!--                <td>Pay Per Click Advertising</td>-->
          <!--                <td class="font-weight-bold">$523</td>-->
          <!--                <td>30 Jun 2018</td>-->
          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-warning">Pending</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--              <tr>-->
          <!--                <td>E-Mail Marketing</td>-->
          <!--                <td class="font-weight-bold">$781</td>-->
          <!--                <td>01 Nov 2018</td>-->
          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-danger">Cancelled</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--              <tr>-->
          <!--                <td>Referral Marketing</td>-->
          <!--                <td class="font-weight-bold">$283</td>-->
          <!--                <td>20 Mar 2018</td>-->
          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-warning">Pending</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--              <tr>-->
          <!--                <td>Social media marketing</td>-->
          <!--                <td class="font-weight-bold">$897</td>-->
          <!--                <td>26 Oct 2018</td>-->
          <!--                <td>12</td>-->
          <!--                <td class="font-weight-medium">-->
          <!--                  <div class="badge badge-success">Completed</div>-->
          <!--                </td>-->
          <!--              </tr>-->
          <!--            </tbody>-->
          <!--          </table>-->
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->

          <!--</div>-->


          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="">
                  All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      @endsection