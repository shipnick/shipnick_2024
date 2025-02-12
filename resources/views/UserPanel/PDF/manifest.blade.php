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
    .new td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>

<body>
    <div class="center">
        <h1>manifest of {{ session('UserLogin2name') }}</h1>
    </div>
    <div class=""></div>

   
        <table class="new">
            <tr>
                <th>#</th>
                <th>Shipper Info</th>
                <th>Item Name</th>
                <th>Order ID</th>
                <th>AWB</th>
                <th>Courier</th>
            </tr>
            @foreach($selectorders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Incrementing index -->
                <td>{{ $order->Name }}</td>
                <td>{{ $order->Item_Name }}</td>
                <td>{{ $order->orderno }}</td>
                <td>{{ $order->Awb_Number }}</td>
                <td>{{ $order->awb_gen_by }}</td>
            </tr>
            @endforeach


        </table>
    
    <table>
        <tr>
            <td>Merchant Signature:</td>
            <td>Merchant SPOC Name:</td>
        </tr>
        <tr>
            <td>Courier Signature:</td>
            <td>Courier SPOC Name:</td>
        </tr>
    </table>

</body>

</html>