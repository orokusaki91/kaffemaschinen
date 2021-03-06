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
            line-height: 0.4;
            font-size: 13px;
        }

        .wrapper {
            width: 80%;
            margin: 50px auto;
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
            margin-top: 30px;
            margin-bottom: 30px;
            clear: both;
            width: 60%;
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

        /*td,
        th {
            border: 1px solid #e0e4f6;
            text-align: unset;
            padding: 8px;
        }*/

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

        .h4 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .address p {
            font-size: 13px;
            font-style: italic;
        }

        .receipt-table td {
            vertical-align: middle;
            text-align: center;
            font-size: 13px;
            padding: 10px 0px;
            border-top: 1px solid #e0e4f6;
            line-height: 1.2;
            white-space: nowrap;
        }

        .receipt-table th {
            text-align: center;
            font-size: 13px;
            padding: 10px 0px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .calc td {
            border: none;
            line-height: 0.2;
        }

        .calc:first-child td {
            padding-top: 30px;
            border-top: 1px solid #e0e4f6;
        }

        .calc:last-child td {
            font-size: 14px;
            font-weight: 600;
            padding-top: 20px;
        }
    </style>
</head>

<body>

    @php
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
    @endphp

    <div class="wrapper order-pdf">
        <div class="header">
            <div class="info company-info">
                <p>Centrocaffè Fruci</p>
                <p>Althardstasse 160</p>
                <p>CH-8105 Regensdorf</p>
                {{-- <p>Tel. +41 (0) 44 450 21 02</p> --}}
                <p><a href="mailto:shop@centrocaffe.ch">shop@centrocaffe.ch</a></p>
                <p><a href="http://centrocaffe.ch/" target="_blank">www.centrocaffe.ch</a></p>
                {{-- <p>MwSt-Nr. CHE-115.174.365</p> --}}
            </div>
            <div id="nobold" class="customer-data" style="text-align: right;">
                <p>Kunden-Nr.: {{ $user->id }}</p>
                <p id="">Bestell-Nr.: {{ $orderNumber }}</p>
                <p id="">{{ strftime("%d. %m. %Y") }}</p>
            </div>
        </div>
    
        <div class="mid_part">
            <table>
                <tr>
                    <th style="border: none;">
                        @if(isset($billing))
                        <div class="left_info address">
                            <h4>Rechnungadresse:</h4>
                            {!! $orders['deliveryOrder']->user->is_company ? '<p>'.$orders['deliveryOrder']->user->company_name.'</p>' : '' !!}

                            <p>{{ $full_name }}</p>
                            <p>{{ $billing->address1 }}</p>
                            <p>{{ $billing_zip_city }}</p>
                        </div>
                        @endif
                    </th>
                    @if(isset($shipping))
                        <th style="border: none; text-align: left;">
                            <div id="nobold" class="address">
                                <h4>Lieferadresse:</h3>
                                <p>{{ $full_name }}</p>
                                <p>{{ $shipping->address1 }}</p>
                                <p>{{ $shipping_zip_city }}</p>
                            </div>
                        </th>
                    @endif
                </tr>
            </table>
        </div>

        <div style="overflow-x: auto">
            <table class="receipt-table">
                <tr>
                    <th>Artikel Nr.</th>
                    <th>Artikel</th>
                    <th>Menge</th>
                    <th>Preis pro Stück</th>
                    <th>Preis</th>
                </tr>
                @if(isset($orders['deliveryOrder']))
                    @foreach($orders['deliveryOrder']->products as $product)
                        <tr class="products">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->qty }}</td>
                            <td>{{ $product->discount == 1 ? $product->discount_price : $product->price }} CHF</td>
                            <td>{{ number_format(($product->discount == 1 ? $product->discount_price : $product->price) * ($product->pivot->qty), 2) }} CHF</td>
                        </tr>
                    @endforeach
                    @foreach($orders['deliveryOrder']->packages as $product)
                        <tr class="products">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->qty }}</td>
                            <td>{{ $product->price }} CHF</td>
                            <td>{{ number_format(($product->price) * ($product->pivot->qty), 2) }} CHF</td>
                        </tr>
                    @endforeach
                @endif

                @php
                    $subtotal = $orders['deliveryOrder']->subtotal;

                    $discount = 0;
                    if (Auth::check()) {
                        $discount = $subtotal * 2 / 100;
                    }
                    $subTotalWithDiscount = $subtotal - $discount;
                    $total = $subTotalWithDiscount >= 100 ? $subTotalWithDiscount : $subTotalWithDiscount + $shipping_price;
                @endphp

                <tr class="calc">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right calc">Subtotal</td>
                    <td>{{ number_format($subtotal, 2) }} CHF</td>
                </tr>
                @if(Auth::check())
                    <tr class="calc">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right calc">Discount</td>
                        <td>{{ number_format($discount, 2) }} CHF</td>
                    </tr>
                @endif
                <tr class="calc">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right calc">Versandgebühren</td>
                    <td>{{ number_format($subTotalWithDiscount >= 100 ? 0 : $shipping_price, 2) }} CHF</td>
                </tr>
{{--                 <tr class="calc">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right calc">zzgl. MwSt 2,5%</td>
                    <td>{{ number_format($orders['deliveryOrder']->tax_25, 2) }} CHF</td>
                </tr>
                <tr class="calc">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right calc">zzgl. MwSt 7,7%</td>
                    <td>{{ number_format($orders['deliveryOrder']->tax_77, 2) }} CHF</td>
                </tr> --}}
                <tr class="calc">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right calc">Total</td>
                    <td>{{ number_format($total, 2) }} CHF</td>
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