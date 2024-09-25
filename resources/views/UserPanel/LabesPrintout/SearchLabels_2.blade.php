<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="">
    <link rel="stylesheet" crossorigin="anonymous" href="">


    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Shipnick | Print Manifest</title>

    <style type="text/css" media="print">

    </style>
    <style type="text/css">
        .shipment {
            padding: 10px;
            margin-top: 5px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin-bottom: 0px;
        }

        h4 {
            font-size: 21px;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
        }

        p,
        h6 {
            font-size: 18px;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
        }

        table.manifest-table {
            border-collapse: collapse;
            width: 55%;
            page-break-inside: avoid;
            color: #000000;
            /* float:left;
                margin:10px; */
        }



        table.prod-table {
            border-collapse: collapse;
            width: 100%;
            /* margin: auto; */
            border-top: none;
            font-size: 15px;
            color: #000000;
            font-family: 'Roboto', sans-serif;
        }

        table td {
            border: 1px solid black;
        }

        table .prod-table thead:first-child th {
            border-right: 1px solid;
        }

        table tr td:first-child {
            border-left: 0;
        }

        table .prod-table tr:last-child td {
            border-bottom: 0;
        }

        table tr td:last-child {
            border-right: 0;
        }

        .template_border {
            border: 2px solid #000;
        }

        .barcode {
            font-family: 'B39MHR';
            font-size: 65px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .rotate270 {
            -webkit-transform: rotate(270deg);
            -moz-transform: rotate(270deg);
            -o-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            transform: rotate(270deg);
        }

        .mb5 {
            margin-bottom: 5px;
        }

        .fulfilledby {
            font-size: 15px;
            font-weight: 100;
            text-align: left;
        }

        table tr td {
            padding-left: 5px;
            padding-right: 5px;
        }

        body {
            line-height: 2.5;
        }

        /* .sign_manifest {
                    margin-bottom: -210px;
                    margin-right: -120px;
                    margin-left: 787px
                }

            .print_manifest {
                float: right;
                margin-top: 20px;
                margin-bottom: 10px;
                margin-right: 440px;
            }

            .print_invoice {
                margin-top: 45px;
            } */

        @media print {
            @page {
                /* size: auto;   auto is the initial value */
                size: 4in 6in;
                /* size: 8in 12in; */
                margin: 10px;
                /*this affects the margin in the printer settings*/
                color: #000000 !important;
            }

            .sign_manifest {
                display: none;
            }

            .print_manifest {
                display: none;
            }

            .print_invoice {
                display: none;
            }
        }

        /* For Screen Size below 991px */
        @media screen and (max-width: 991px) {
            .d_flex {
                display: flex;
                justify-content: space-between;
                width: 56%;
                padding: 10px;
            }

            .sign_manifest,
            .print_manifest {
                margin-right: 5%;
            }
        }

        /* For Screen Size above 991px */
        @media screen and (min-width: 991px) {
            .d_flex {
                float: right;
                margin-right: 30%;
                padding-top: 10px;
                /* position: fixed;
                    right: 1rem;
                    top: 4rem; */
            }

            .sign_manifest,
            .print_manifest {
                margin: 0px !important;
                display: block;
                margin-bottom: 10px !important;
            }
        }
    </style>
</head>

<body>
    <!-- <div class="d_flex">
        <button class="btn btn-warning sign_manifest" id="signManifest"
            style="font-size: 12px;height: 30px;width: 120px;background-color: #915bd8;border: #915bd8;color: #fff;">Print
            Manifest</button>
        <button class="btn btn-primary print_manifest" onClick="window.print();"
            style="font-size: 12px;height: 30px;width: 120px;background-color: #915bd8;border: #915bd8;color: #fff;">Print
            Label(s)</button>
        <button class="btn btn-info print_invoice" id="printInvoice"
            style="font-size: 12px;height: 30px;width: 120px;background-color: #915bd8;border: #915bd8;color: #fff;">Print
            Invoice(s)</button>
    </div> -->

    @for($i=0; $i<$totalorders; $i++)
    <table class="manifest-table template_border">
        <tbody>
            <tr>
                <td colspan="3" style="text-align:center;">
                    <h3><b>
                        <!--{{ ucwords($params[$i]['awbcourier']) }}.....-->
                        Fashion Flair...</b></h3>
                </td>
                <td class="text-center">
                    <h6 class="fulfilledby">Fulfilled By:</h6>
                    
                        @if($params[$i]['awbcourier'] == 'Ecom')
                    
                        <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}" onerror="this.onerror=null;this.src=`{{asset('/img/ecom.jpg')}}`;" title="Hub Image" style="width: 170px;">
                        @elseif($params[$i]['awbcourier'] == 'Xpressbee')
                        
                        <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}" onerror="this.onerror=null;this.src=`{{asset('/img/Xpressbees.jpg')}}`;" title="Hub Image" style="width: 170px;">
                        @elseif($params[$i]['awbcourier'] == 'Bluedart-sc')
                         <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}" onerror="this.onerror=null;this.src=`{{asset('/img/bluedart-logo.png')}}`;" title="Hub Image" style="width: 170px;">
                         @elseif($params[$i]['awbcourier'] == 'Bluedart')
                         <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}" onerror="this.onerror=null;this.src=`{{asset('/img/bluedart-logo.png')}}`;" title="Hub Image" style="width: 170px;">
                         @endif
                </td>
            </tr>
            <tr style="line-height: 1.7;">
                <td colspan="4" class="text-center" style="border: none;">
                    <?php
								$awbno = trim($params[$i]['awb']);
								echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60%;margin-top: 2%;" />';
								?>
                    <br /> <span style="font-size: 25px; margin-left:20%">{{ $params[$i]['awb'] }} </span> 
                    <span style="float: left;">
                         <h6>{{ $params[$i]['route'] }} </h6> 
                    </span>
                    <span style="float: right;">
                        <h6>Order #</h6>
                        <h4><b>{{ ucwords($params[$i]['orderno']) }}</b></h4>
                    </span>
                </td>
            </tr>
            <tr style="line-height: 20px;">
                <td class="address-cell" colspan="3">
                    <p>Deliver To:</p>
                    <h4 class="mb5">{{ ucwords($params[$i]['name']) }}</h4>
                    <p style="line-height: 1.5em;">
                        <?php
// Example address
$address = ucwords($params[$i]['address']);

// Check if the address length is more than 50 characters
if (strlen($address) > 30) {
    // Split the address into parts where each part is 50 characters or less
    $addressParts = str_split($address, 30);
    
    // Join the parts with a <br> tag
    $formattedAddress = implode('<br>', $addressParts);
} else {
    // No need to break the address, just use it as is
    $formattedAddress = $address;
}

// Output the formatted address
echo $formattedAddress;
?>
<br />
                        {{ ucwords($params[$i]['city']) }} :-{{ ucwords($params[$i]['pincode']) }}<br />
                        {{ ucwords($params[$i]['mobile']) }} </p>
                </td>

                <td class="text-center">
                    <h4> <b>{{ $params[$i]['paymode'] }}</b>
                    </h4>
                </td>
            </tr>

            <tr style="border: 1px solid #000;">
                <td colspan="3" style="border: none; line-height:2em;">
                    <p>Ref./Invoice #: <br />
                        Size : {{ $params[$i]['h'] }} x {{ $params[$i]['w'] }} x {{ $params[$i]['l'] }} </p>
                </td>
                <td style="border: none; line-height:2em;">
                    <p>Date: <?php
                        $date = date_create($params[$i]['date']);
                        echo date_format($date, "d-m-Y");
                        ?> <br />
                        Weight: {{ $params[$i]['weight'] }}
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    <table class="prod-table" style="border: 1px solid black;">
                        <h6 style="margin-top: 5px;margin-bottom: 5px;">In the Package<h6>
                                <thead style="line-height: 1.5em;">
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Qty</th>
                                    <th class="text-right">Price</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="line-height: 1.5em;">{{ ucwords($params[$i]['item']) }}</td>
                                        <td style="line-height: 1.5em;">{{ ucwords($params[$i]['sku']) }}</td>
                                        <td>{{ ucwords($params[$i]['qlty']) }}</td>
                                        <td class="text-right">{{ ucwords($params[$i]['codamt']) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <p>Total</p>
                                        </td>
                                        <td>
                                            <p>{{ ucwords($params[$i]['qlty']) }}</p>
                                        </td>
                                        <td class="text-right">
                                            <p>{{ ucwords($params[$i]['codamt']) }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                    </table>
                </td>
            </tr>
            <tr style="line-height: 1.5em;">
                <td colspan="4" class="address">
                   
                    <span style="font-size:small ">
                        <br><b>For any query please contact</b>
                        Mobile: ,Email:support@trenchy.com
        
                        <hr style="border: 1px solid black; margin:0">
                        This is computer generated document, hence does not require signature 
                        <br> <b>Note:</b> All disputes are subject to Delhi jurisdication. Goods once sold will only be
                        taken back or exchanged as per the store's exchange/return policy
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    @endfor


    <script>
        function printpage() {
            window.print()
        }
        printpage();
    </script>
</body>

</html>