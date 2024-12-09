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