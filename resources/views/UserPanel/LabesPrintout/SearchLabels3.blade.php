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

    @for($i=0; $i<$totalorders; $i++)
        <table class="manifest-table template_border">
        <tbody>
            <tr>
                <td colspan="3" style="text-align:center;">
                    <h3><b>
                            @if(isset($label_setting))
                            {{$label_setting->display_name}}
                            @else
                            {{ ucwords($params[$i]['hubname']) }}.....

                            @endif
                </td>
                <td class="text-center">
                    <h6 class="fulfilledby">Courier Partner:</h6>

                    @if($params[$i]['awbcourier'] == 'Ecom')

                    <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}"
                        onerror="this.onerror=null;this.src=`{{asset('/img/ecom.jpg')}}`;" title="Hub Image"
                        style="width: 170px;">
                    @elseif($params[$i]['awbcourier'] == 'Xpressbee')
                    <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}"
                        onerror="this.onerror=null;this.src=`{{asset('/img/Xpressbees.jpg')}}`;" title="Hub Image"
                        style="width: 170px;">
                    @elseif($params[$i]['awbcourier'] == 'Bluedart-sc')
                    <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}"
                        onerror="this.onerror=null;this.src=`{{asset('/img/bluedart-logo.png')}}`;" title="Hub Image"
                        style="width: 170px;">
                    @elseif($params[$i]['awbcourier'] == 'Bluedart')
                    <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}"
                        onerror="this.onerror=null;this.src=`{{asset('/img/bluedart-logo.png')}}`;" title="Hub Image"
                        style="width: 170px;">
                    @elseif($params[$i]['awbcourier'] == 'Ekart')
                    <img src="{{ asset('HubDetails') }}/{{ $params[$i]['hfolder'] }}/{{ $params[$i]['hlogo'] }}"
                        onerror="this.onerror=null;this.src=`{{asset('new1/assets/img/logo/ekart1.png')}}`;"
                        title="Hub Image" style="width: 170px;">

                    @endif
                </td>
            </tr>

            <tr style="line-height: 20px;">
                <td class="address-cell" colspan="3" style="border: none !important;">
                    <!-- <p>Deliver To:</p> -->
                    <h4 class="mb5">{{ ucwords($params[$i]['name']) }}</h4>
                    <p style="line-height: 1.5em;">
                        {{ ucwords($params[$i]['address']) }}<br />{{ ucwords($params[$i]['address2']) }}
                        {{ ucwords($params[$i]['city']) }} :-{{ ucwords($params[$i]['pincode']) }}<br />
                        {{ ucwords($params[$i]['mobile']) }} ,{{ ucwords($params[$i]['mobile2']) }}<br>
                        {{ ucwords($params[$i]['pemail']) }}
                    </p>
                </td>

                <td class="" style="border: none !important;">
                    <p style="font-size: medium;">ORDER NO. -</p>
                    #{{ ucwords($params[$i]['orderno']) }}
                    <p style="font-size: medium;">INVOICE DATE -</p>
                    {{ ucwords($params[$i]['date']) }}

                    <p style="font-size: medium;">WEIGHT-</p>
                    @if(isset($label_setting))
                    @if($label_setting->Weight == 0)
                    {{ $params[$i]['weight'] }} KG
                    @endif
                    @else
                    {{ $params[$i]['weight'] }} KG
                    @endif

                    <p style="font-size: medium;">DIMENSION -</p>
                    @if(isset($label_setting))
                    @if($label_setting->Dimensions == 0)
                    {{ $params[$i]['h'] }} x {{ $params[$i]['w'] }} x {{ $params[$i]['l'] }}
                    @endif
                    @else
                    {{ $params[$i]['h'] }} x {{ $params[$i]['w'] }} x {{ $params[$i]['l'] }} </p>
                    @endif
                </td>

            </tr>
            <tr style="line-height: 1.7;">
                <td colspan="3" class="text-center"
                    style="border-left: dotted 1px; border-top: none; border-right: none; border-bottom: none;border: dotted 2px;">
                    <span style="margin-top: 2%;">
                        <?php
                        $awbno = trim($params[$i]['awb']);
                        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($awbno, 'C128', 2, 33, array(1, 2, 3)) . '" alt="barcode" style="width:60%; height:80px;margin-top: 2%;" />';
                        ?>
                    </span>

                    <br />AWB - <b>{{ $params[$i]['awb'] }}</b> <br>
                </td>
                <td style="border: dotted 2px;" class="text-center">

                    <p>ORDER NO.</p>

                    <span>#{{ ucwords($params[$i]['orderno']) }}</span>

                </td>
            </tr>


            <tr style="border: 1px solid #000;" class="text-center">
                <td colspan="4" style="border: none; line-height:2em;">
                    <p>PRODUCT</p>

                    {{ ucwords($params[$i]['item']) }}


                </td>

            </tr>

            <tr style="line-height: 1.7;">

                <td class="text-center">
                    <h2>Rs. @if($params[$i]['paymode'] == 'COD')
                            {{ ucwords($params[$i]['codamt']) }}
                            
                            @else
                                0
                           
                            @endif</h2>
                    <p>Amount to be Collected</p>


                </td>
                <td colspan="3" class="text-center">
                    <h1>{{ $params[$i]['paymode'] }}</h1>
                </td>
            </tr>



            <tr style="line-height: 1.5em;">
                <td colspan="4" class="address">
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

                        <span style="font-size:small ">

                            <hr style="border: 1px solid black; margin:0;">
                            <span style="font-size: 7px;">All Disputes are subject to Delhi Jurisdication , Goods once sold will only be taken back or exchanged as per the store's exchange / return policy.</span>

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
