<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>E-mail</title>
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
        }



        .wrapper {
            width: 80%;
            margin: 0 auto;
        }

        .logo {
            display: block;
        }

        .info {
            display: block;
            float: left;
            margin-bottom: 20px;
        }

        .info>p {
            text-align: left;
        }

        .mid_part {
            margin-top: 100px;
            clear: both;
        }
        #nobold {
            font-weight: normal;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
        }

        td,
        th {
            border: 1px solid #e0e4f6;
            text-align: unset;
            padding: 8px;
        }

        td:hover,
        th:hover {
            background: #f8fafc;
        }

        .left_info {
            display: inline-block;
            font-weight: normal;
        }

        ::selection {
            background: #373d54;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="header">

            <div class="info">
                <p>Brock GmbH - Birmensdorferstrasse 430 - CH-8055 Zürich</p>
                <p>Tel. +41 (0) 44 450 21 02 - <a href="mailto:shop@centrocaffe.ch">shop@centrocaffe.ch</a> - <a href="http://centrocaffe.ch/" target="_blank">www.centrocaffe.ch</a> </p>
                <p> MwSt-Nr. CHE-115.174.365 </p>
            </div>
        </div>

        <?php
            $first_name = $orders['deliveryOrder']->user->first_name;
            $last_name = $orders['deliveryOrder']->user->last_name;
            $full_name =  $first_name . ' ' . $last_name;

            setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

            $hasDeliveryOrder = isset($orders['deliveryOrder']);
            $hasPickupOrder = isset($orders['pickupOrder']);

            $orderNumber = "";

            if ($hasDeliveryOrder == true && $hasPickupOrder == true) {
                $orderNumber = $orders['deliveryOrder']->id."/".$orders['pickupOrder']->id;
            } elseif ($hasDeliveryOrder == true && $hasPickupOrder == false) {
                $orderNumber = $orders['deliveryOrder']->id;
            } elseif ($hasDeliveryOrder == false && $hasPickupOrder == true) {
                $orderNumber = $orders['pickupOrder']->id;
            }

            $shipping_price = (float)\App\Models\Database\Configuration::getConfiguration('delivery_price');

            if ($hasDeliveryOrder == true )
                $orderForAddresses = 'deliveryOrder';
            else
                $orderForAddresses = 'pickupOrder';

            $billing = $orders[$orderForAddresses]->billing_address;
            $shipping = is_null($orders[$orderForAddresses]->shipping_address) ? $orders[$orderForAddresses]->billing_address : $orders[$orderForAddresses]->shipping_address;

            $billing_zip_city = $billing->postcode . ' ' . $billing->city;
            $shipping_zip_city = $shipping->postcode . ' ' . $shipping->city;
        ?>

            <div class="mid_part">
                <table>
                    <tr>
                        <th style="border:none;">
                            @if(isset($billing))
                            <div class="left_info">
                                {!! $orders['deliveryOrder']->user->is_company ? '<p>'.$orders['deliveryOrder']->user->company_name.'</p>' : '' !!}
                                <p>{{ $full_name }}</p>
                                <p>{{ $billing->address1 }}</p>
                                @if($billing->address2 != '/')
                                <p>{{ $billing->address2 }}</p>
                                @endif
                                <p>{{ $billing_zip_city }}</p>
                            </div>
                            @endif
                        </th>
                        @if(isset($shipping))
                            <th style="border: none; text-align: left">
                                <div id="nobold">
                                    <p>Lieferadresse:</p>
                                    <p>{{ $full_name }}</p>
                                    <p>{{ $shipping->address1 }}</p>
                                    @if($shipping->address2 != '/')
                                        <p>{{ $shipping->address2 }}</p>
                                    @endif
                                    <p>{{ $shipping_zip_city }}</p>
                                </div>
                            </th>
                        @endif
                        <th style="text-align:right; border:none;">
                            <div id="nobold">
                                <p>Kunden-Nr.: {{ auth()->user()->id }}</p>
                                <p id="">Bestell-Nr.: {{ $orderNumber }}</p>
                                <p id="">{{ strftime("%a, %d. %m. %Y") }}</p>
                            </div>
                        </th>
                    </tr>
                </table>


            </div>

            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>Artikel Nr.</th>
                        <th>Artikel</th>
                        <th>Menge</th>
                        <th>Preis pro Stück CHF</th>
                        <th>Preis CHF</th>
                    </tr>
                    {{--@if(isset($orders['pickupOrder']))--}}
                        {{--@foreach($orders['pickupOrder']->products as $product)--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<p>{{ $product->id }}</p> }}--}}
                                {{--</td>--}}
                                {{--<td>{{ $product->name }}</td>--}}
                                {{--<td>{{ $product->pivot->qty }}</td>--}}
                                {{--<td>{{ $product->discount == 1 ? $product->discount_price : $product->price }}</td>--}}
                                {{--<td>{{ ($product->discount == 1 ? $product->discount_price : $product->price) * ($product->pivot->qty) }}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    @if(isset($orders['deliveryOrder']))
                        @foreach($orders['deliveryOrder']->products as $product)
                            <tr>
                                <td>
                                    <p>{{ $product->id }}</p></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->qty }}</td>
                                <td>{{ $product->discount == 1 ? $product->discount_price : $product->price }}</td>
                                <td>{{ number_format(($product->discount == 1 ? $product->discount_price : $product->price) * ($product->pivot->qty), 2) }}</td>
                            </tr>
                        @endforeach
                        @foreach($orders['deliveryOrder']->packages as $product)
                            <tr>
                                <td><p>{{ $product->id }}</p></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->qty }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ number_format(($product->price) * ($product->pivot->qty), 2) }}</td>
                            </tr>
                        @endforeach
                    @endif

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <p>Versandgebühren</p>
                            <p>inkl. MwSt 2,5%</p>
                            <p>inkl. MwSt 7,7%</p>
                            <p class="bold">Total</p>

                        </td>

                        <?php
                            $subtotal = (isset($orders['pickupOrder']) ? $orders['pickupOrder']->total_amount : 0) + (isset($orders['deliveryOrder']) ? $orders['deliveryOrder']->total_amount : 0);
                            $sub_pdv = ($subtotal) * 0.077;
                            $total = $subtotal;
                        ?>
                        <td>
                            <p>{{ number_format($subtotal > 100 ? 0 : $shipping_price, 2) }} CHF</p>
                            <p>{{ number_format($orders['deliveryOrder']->tax_25, 2) }} CHF</p>
                            <p>{{ number_format($orders['deliveryOrder']->tax_77, 2) }} CHF</p>
                            <p class="bold">{{ number_format($total, 2) }} CHF</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <table>
                    <tr>
                    </tr>
                </table>
            </div>

    </div>

</body>

</html>