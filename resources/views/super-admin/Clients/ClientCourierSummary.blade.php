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