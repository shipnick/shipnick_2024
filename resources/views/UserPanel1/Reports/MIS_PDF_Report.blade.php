<head>
	<title>MIS Report</title>
</head>
<div style="width:100%;"> <!-- Main Div -->

<div style="width:99%;">

<table>
@php($finalcouriername = 0)

@foreach($couriers as $courier)
@php($manifestid = 0)
@php($hubname = 0)
@php($couriername = 0)
@php($noofshipment = 0)
<!--  -->
	@foreach($params as $param)
		@if($courier->courier_name==$param->courier_name)
			@php($manifestid = $courier->courier_id)
			@php($hubname = $param->hub_name)
			@php($couriername = $courier->courier_name)
         	@php($noofshipment++)
         @endif
	@endforeach
<!--  -->
<!--  -->
	@if($manifestid)
		<tr>
			<td>Manifest ID</td>
            <td>:</td>
            <td></td>
            <td>{{ $manifestid }}</td>
        </tr>
        <tr>
			<td>Shipping Hub Id</td>
            <td>:</td>
            <td></td>
            <td>{{ $hubname }}</td>
        </tr>
        <tr>
			<td>Courier Name</td>
            <td>:</td>
            <td></td>
            <td>
            	{{ $couriername }}
            	@php($finalcouriername = $couriername)
            </td>
        </tr>
        <tr>
			<td>No Of Shipments</td>
            <td>:</td>
            <td></td>
            <td>{{ $noofshipment }}</td>
        </tr>
   	@endif
<!--  -->
@endforeach
</table>

<br><br>

<table width="100%" border="1" style="border-collapse: collapse;">
<tr>
	<th width="10%">Sr. No.</th>
    <th width="30%">Order ID</th>
    <th width="30%">Product Name</th>
    <th width="30%">Tracking No.</th>
</tr>
<!--  -->
@php($i=1)
@foreach($params as $param)
	@if($finalcouriername==$param->courier_name)
		<tr>
			<td>{{ $i }}</td>
            <td>{{ $param->orderno }}</td>
            <td>{{ $param->itemname }}</td>
            <td>{{ $param->awb_no }}</td>
        </tr>
     @endif
@php($i++)
@endforeach
<!--  -->
<!--  -->
<!--  -->

</table>
</div>


</div>


<script>
function printpage()
  {
  window.print()
  }
  printpage();
</script>


