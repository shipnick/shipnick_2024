 @php(error_reporting(1))

 @extends('super-admin.Layout')

 @section('bodycontent')
 <!-- [ Main Content ] start -->
 <div class="pcoded-main-container">
     <div class="pcoded-content">
         <!-- [ breadcrumb ] start -->
         <div class="page-header">
             <div class="page-block">
                 <div class="row align-items-center">
                     <div class="col-md-12">
                         <div class="page-header-title">
                             <h5 class="m-b-10">{{$userName}}</h5>
                         </div>
                         <ul class="breadcrumb">
                             <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-user"></i></a>
                             </li>
                             <li class="breadcrumb-item">{{$adminName}}</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         <!-- [ breadcrumb ] end -->
         <!-- [ Main Content ] start -->
         <div class="row">
             <!-- table card-1 start -->
             <div class="col-md-12 col-xl-4">
                 <div class="card flat-card">
                     <div class="row-table">
                         <div class="col-sm-6 card-body br">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$totalOrder}}</h5>
                                     <span>Total No Of Orders</span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6 card-body">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-music text-c-red mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$totalPP}}</h5>
                                     <span>Pending Pickups</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row-table">
                         <div class="col-sm-6 card-body br">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$totalCod}} </h5>
                                     <span>Cod Oders</span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6 card-body">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$totalPrepaid}}</h5>
                                     <span>Prepaid Oders</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 

                 <!-- widget primary card start -->
                 <div class="card flat-card widget-primary-card">
                     <div class="row-table">
                         <div class="col-sm-3 card-body">
                             <i class="feather icon-star-on"></i>
                         </div>
                         <div class="col-sm-9">
                             <h4>{{$blance}} </h4>
                             <h6>Wallet Balance</h6>
                         </div>
                     </div>
                 </div>
                 <!-- widget primary card end -->
             </div>
             <!-- table card-1 end -->
             <!-- table card-2 start -->
             <div class="col-md-12 col-xl-4">
                 <div class="card flat-card">
                     <div class="row-table">
                         <div class="col-sm-6 card-body br">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-share-2 text-c-blue mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$monthlyOrder}}</h5>
                                     <span>Monthly Orders</span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6 card-body">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-wifi text-c-blue mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$monthlyPP}}</h5>
                                     <span>Pending Pickups</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row-table">
                         <div class="col-sm-6 card-body br">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-rotate-ccw text-c-blue mb-1 d-block"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$monthlyCod}}</h5>
                                     <span>Cod Oders</span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6 card-body">
                             <div class="row">
                                 <div class="col-sm-4">
                                     <i class="icon feather icon-shopping-cart text-c-blue mb-1 d-blockz"></i>
                                 </div>
                                 <div class="col-sm-8 text-md-center">
                                     <h5>{{$monthlyPrepaid}}</h5>
                                     <span>Prepaid Oders</span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- widget-success-card start -->
                 <div class="card flat-card widget-purple-card">
                     <div class="row-table">
                         <div class="col-sm-3 card-body">
                             <i class="fas fa-trophy"></i>
                         </div>
                         <div class="col-sm-9">
                             <h4>{{$codAmount}}</h4>
                             <h6>COD Amount</h6>
                         </div>
                     </div>
                 </div>
                 <!-- widget-success-card end -->
             </div>
             <!-- table card-2 end -->

             <!-- Widget primary-success card start -->
             <div class="col-md-12 col-xl-4">
                 <div class="card support-bar overflow-hidden">
                     <div class="card-body pb-0">
                         <h2 class="m-0">{{$todayOders}}</h2>
                         <span class="text-c-blue">Today's Orders</span>
                         <p class="mb-4 mt-4"><br>&nbsp;&nbsp;</p>
                     </div>
                     <div id="support-chart"></div>
                     <div class="card-footer bg-primary text-white">
                         <div class="row text-center">
                             <div class="col">
                                 <h4 class="m-0 text-white">{{$todayCod}}</h4>
                                 <span>Cod</span>
                             </div>
                             <div class="col">
                                 <h4 class="m-0 text-white">{{$todayPrepaid}}</h4>
                                 <span>Prepaid</span>
                             </div>
                             <div class="col">
                                 <h4 class="m-0 text-white">0</h4>
                                 <span>Reverse</span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Widget primary-success card end -->

             <!-- prject ,team member start -->
             <div class="col-xl-12 col-md-12">
                 <div class="card table-card">
                     <div class="card-header">
                         <h5>Datewise Order Summary (last 30days)</h5>
                         <div class="card-header-right">
                             <div class="btn-group card-option">
                                 <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                     aria-haspopup="true" aria-expanded="false">
                                     <i class="feather icon-more-horizontal"></i>
                                 </button>
                                 
                             </div>
                         </div>
                     </div>
                     <div class="card-body p-0">
                         <div class="table-responsive">
                             <table class="table table-hover mb-0">
                                 <thead>
                                     <tr>
                                         <th>
                                             Order Date
                                         </th>
                                         <th>No of Orders</th>
                                         <th>Pickup Pending</th>
                                         <th>Cod</th>
                                         <th class="text-right">Prepaid</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($dates as $date)
                                     <tr>
                                         <td>{{ $date }}</td>
                                         <td>{{ $statusCounts['totalOrder'][$date] ?? 0 }}</td>
                                         <td>{{ $statusCounts['pickup'][$date] ?? 0 }}</td>
                                         <td>{{ $statusCounts['in_transit'][$date] ?? 0 }}</td>
                                         <td>{{ $statusCounts['ofd'][$date] ?? 0 }}</td>
                                         <td>{{ $statusCounts['Delivered'][$date] ?? 0 }}</td>
                                         <td>{{ $statusCounts['NDR'][$date] ?? 0 }}</td>
                                         <td>{{ $statusCounts['RTO'][$date] ?? 0 }}</td>
                                     </tr>
                                     @endforeach

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-12 col-md-12">
                 <div class="card table-card">
                     <div class="card-header">
                         <h5>Courier Wise Summary</h5>
                         <div class="card-header-right">

                         </div>
                     </div>
                     <div class="card-body p-0">
                         <div class="table-responsive">
                             <table class="table table-hover mb-0">
                                 <thead>
                                     <tr>
                                         <th>
                                             Courier Name
                                         </th>
                                         <th>No of Orders</th>
                                         <th>Pending Pickups</th>
                                         <th>In-Transit</th>
                                         <th>OFD</th>
                                         <th>Delivered</th>
                                         <th>NDR</th>
                                         <th>RTO</th>

                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($orderDetails as $courier => $details)
                                     <tr>
                                         <td>{{ $courier }}</td>
                                         <td>{{ $details['totalOrders'] }}</td>
                                         <td>{{ $details['orderPending'] }}</td>
                                         <td>{{ $details['orderInTransit'] }}</td>
                                         <td>{{ $details['orderInOfd'] }}</td>
                                         <td>{{ $details['orderDelivered'] }}</td>
                                         <td>{{ $details['orderNdr'] }}</td>
                                         <td>{{ $details['orderRto'] }}</td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
         <!-- [ Main Content ] end -->
     </div>
 </div>
 <!-- [ Main Content ] end -->
 @endsection