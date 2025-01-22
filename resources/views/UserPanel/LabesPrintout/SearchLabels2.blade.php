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
            /* border: 1px solid black; */
        }

        table .prod-table thead:first-child th {
            /* border-right: 1px solid; */
        }

        /* table tr td:first-child {
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
        } */

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

    @for($i=0; $i<$totalorders; $i++)
        <table class="manifest-table template_border">
        <tbody>

            <tr style="line-height: 20px;">
                <td class="address-cell" colspan="4">
                    <p>To:</p>
                    <h4 class="mb5">{{ ucwords($params[$i]['name']) }}</h4>
                    <span style="line-height: 1.5em;">
                        {{ ucwords($params[$i]['address']) }}<br />{{ ucwords($params[$i]['address2']) }}
                        {{ ucwords($params[$i]['city']) }} :-{{ ucwords($params[$i]['pincode']) }}<br />
                        {{ ucwords($params[$i]['mobile']) }} ,{{ ucwords($params[$i]['mobile2']) }}<br>
                        {{ ucwords($params[$i]['pemail']) }}</p>
                    </span>
                    <hr style="border: 2px solid black; margin:0">
                </td>



            </tr>

            <tr>

                <td colspan="3" style="border: none; line-height: 1.2;">

                    <p>Order Date: <?php
                                    $date = date_create($params[$i]['date']);
                                    echo date_format($date, "d-m-Y");
                                    ?>
                    </p>
                    <p>Invoice No: #{{ ucwords($params[$i]['orderno']) }}</p>
                </td>
                <td style="text-align:center">
                    <p style="margin-top: 1%;"><?php
                                                $Invoice = trim($params[$i]['orderno']);
                                                echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($Invoice, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:40%; height:60px;"/>';
                                                ?>
                        <br>


                        #{{ ucwords($params[$i]['orderno']) }}

                    </p>
                </td>



            </tr>

            <tr>
                <td colspan="4">
                    <hr style="border: 2px solid black; margin:0">
                </td>
            </tr>

            <tr style="line-height: 20px;">
                <td class="text-center ">
                    <br>
                    <span style="font-size: xx-large;"> {{ $params[$i]['paymode'] }}
                        <p style="font-size: x-large;margin-top: 4%;"> ₹ @if($params[$i]['paymode'] == 'COD')
                            {{ ucwords($params[$i]['codamt']) }}

                            @else
                            0

                            @endif
                        </p>
                    </span>
                </td>
                <td class="address-cell " colspan="3" style="text-align:center;">
                    <br>
                    <p> {{ ucwords($params[$i]['awbcourier']) }}</p>
                    <?php
                    $awbno = trim($params[$i]['awb']);
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60%; height:80px;" />';
                    ?>
                    <br />AWB - <b>{{ $params[$i]['awb'] }}</b> <br>
                </td>

            </tr>

            <tr>

                <td colspan="3" style="text-align:center;margin: 0;">
                    WEIGHT : {{ $params[$i]['weight'] }} KG
                </td>
                <td class="text-center" style="margin: 0;">
                    Dimensions (cm): {{ $params[$i]['h'] }} x {{ $params[$i]['w'] }} x {{ $params[$i]['l'] }}
                </td>
            </tr>

            <tr>
                <td colspan="4">

                    <table class="prod-table" style="border: 1px solid black;">
                        <!-- <h6 style="margin-top: 5px;margin-bottom: 5px;">In the Package<h6> -->
                        <thead style="line-height: 1.5em;" style="border: 2px solid black;">
                            <th style="border: 1px solid black;">Product Name</th>
                            <th style="border: 1px solid black;"> SKU</th>
                            <th style="border: 1px solid black;">Qty</th>
                            <th class="text-right">Price</th>
                        </thead>
                        <tbody style="border: 1px solid black;">
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;">{{ ucwords($params[$i]['item']) }}</td>
                                <td style="border: 1px solid black;">{{ ucwords($params[$i]['sku']) }}</td>
                                <td>{{ ucwords($params[$i]['qlty']) }}</td>
                                <td class="text-right" style="border: 1px solid black;">{{ ucwords($params[$i]['codamt']) }}</td>
                            </tr>
                            <tr style="border: 1px solid black;">
                                <td colspan="2" class="text-right" style="border: 1px solid black;">
                                    <p>Total</p>
                                </td>
                                <td style="border: 1px solid black;">
                                    <p>{{ ucwords($params[$i]['qlty']) }}</p>
                                </td>
                                <td class="text-right" style="border: 1px solid black;">
                                    <p>{{ ucwords($params[$i]['codamt']) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>



            <tr style="line-height: 1.5em;">
                <td colspan="4" class="address">
                    <hr style="border: 2px solid black; margin:0">
                    @if(isset($label_setting))
                    @if($label_setting->Return_Address == 0)
                    <p>If undelivered, please return to:<br />

                        @if($label_setting->rtoAddress != '')

                        {{$label_setting->rtoAddress}}

                        @else
                        {{ ucwords($params[$i]['hname']) }}, <br>
                        {{ ucwords($params[$i]['haddress']) }},
                        {{ ucwords($params[$i]['hstate']) }},
                        {{ ucwords($params[$i]['hcity']) }}
                        -{{ ucwords($params[$i]['hpincode']) }}
                        <br>
                        Phone : <b>{{ ucwords($params[$i]['hmobile']) }}</b>
                        @endif

                    </p>
                    @endif
                    @else
                    <p>If undelivered, please return to:<br />
                        {{ ucwords($params[$i]['hname']) }}, <br>
                        {{ ucwords($params[$i]['haddress']) }},
                        {{ ucwords($params[$i]['hstate']) }},
                        {{ ucwords($params[$i]['hcity']) }}
                        -{{ ucwords($params[$i]['hpincode']) }}
                        <br>
                        Phone : <b>{{ ucwords($params[$i]['hmobile']) }}</b>
                    </p>
                    @endif
                    <span style="font-size:small ">
                        <br><b>For any query please contact</b>
                        @if(isset($label_setting))

                        @if($label_setting->Support_Mobile == 0)
                        Mobile:{{$label_setting->supportnumber}}
                        @endif
                        ,
                        @if($label_setting->Support_email == 0)
                        Email:{{$label_setting->supportemail}}
                        @endif
                        @endif
                        <br>



                        <table>
                            <tr>
                                <td colspan="2" style="">
                                    <!-- <hr style="border: 2px solid black; margin:0"> -->
                                    This is computer generated document, hence does not require signature
                                    <br> <b>Note:</b> All disputes are subject to Delhi jurisdication. Goods once sold will only be
                                    taken back or exchanged as per the store's exchange/return policy
                                </td>
                                <td>
                                    <span style="float: right;font-size: 7px;">Powered By:<br> <img src="/Shipnick.png" alt="" style="height: 40px;width: 40px;"></span>
                                </td>
                            </tr>
                        </table>
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