<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show/Hide Example</title>

</head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .new td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #dddddd;
    }

    .center {
        text-align: center;
    }

    .left {
        float: right;
    }

    .mt {
        margin-top: 2%;
    }

    .mb {
        margin-bottom: 10%;
    }

    .bold {
        font-weight: bold;

    }
</style>

<body>
@foreach($selectorders as $order)
    <div class="">
        <div class="center">
            <h1>TAX INVOICE</h1>
        </div>



        <table>

            <tr>
                <td class="bold">Order Information</td>
                <td class="left bold">Invoice</td>

            </tr>
            <tr>
                <td><span class="bold"> Order Reference : </span> {{ $order->ordernoapi }}</td>
                <td class="left"> <span class="bold"> Invoice Number :</span> {{ $order->Single_Order_Id }}</td>
            </tr>
            <tr>
                <td><span class="bold"> AWB Number :</span> {{ $order->Awb_Number }}</td>
                <td class="left"> <span class="bold">Invoice Date : </span> {{ $order->Rec_Time_Date }} </td>
            </tr>


        </table>
        <hr>
        <table class="mt">

            <tr>
                <td class="bold">Sold By:</td>
                <td class="left bold">Billed To:</td>

            </tr>
            <tr>
                <td>{{ $order->pickup_name }}</td>
                <td class="left">{{ $order->Name }}</td>
            </tr>
            <tr>
                <td>{{ $order->pickup_address }}</td>
                <td class="left">{{ $order->Address }}</td>
            </tr>
            <tr>
                <td>{{ $order->pickup_state }},{{ $order->pickup_city }} </td>
                <td class="left">{{ $order->State }},{{ $order->City }}</td>
            </tr>
            <tr>
                <td>{{ $order->pickup_pincode }}</td>
                <td class="left">{{ $order->Pincode }}</td>
            </tr>
            <tr>
                <td>gst:{{ $order->pickup_gstin }} </td>
                
            </tr>

        </table>

        <table class="mt">
            <tr>
                <th>Product Description </th>
                <th>Product SKU</th>
                <th>HSN Code </th>
                <th>Quantity</th>
                <th>Product Amount</th>
                <th>Total</th>
            </tr>


            <tr>
                <td>{{ $order->Item_Name }}</td>
                <td> {{ $order->sku }}</td>
                <td> </td>
                <td>{{ $order->Quantity }}</td>
                <td>{{ $order->Total_Amount }}</td>
                <td>{{ $order->Total_Amount }}</td>
            </tr>


        </table>

        <table class="new mt">
            <tr>
                <th>Weight (gram) </th>
                <th>Length (cm) </th>
                <th>Breadth (cm)</th>
                <th>Height (cm) </th>

            </tr>


            <tr>
                <td>{{ $order->Actual_Weight }}</td>
                <td> {{ $order->Length }}</td>
                <td>{{ $order->Width }}</td>
                <td>{{ $order->Height }}</td>

            </tr>


        </table>
        <table class="mt">
            <th>Shipping Charges</th>
        </table>
        <table class="new  mb">
            <tr>
                <th>HSN Code </th>
                <th>Base Amount </th>
                <th>CGST @9%</th>
                <th>SGST @9%</th>
                <th>UTGST @0%</th>
                <th>Net Payable</th>

            </tr>


            <tr>
                <td>0 </td>
                <td> 0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>


        </table>
        <div class="center">This is a computer generated invoice no signature is required.</div>

    </div>
@endforeach    

</body>

</html>