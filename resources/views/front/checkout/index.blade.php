@extends('front.layouts.app')

@section('meta_title','Zahlung')
@section('meta_description','Checkout Page')

@section('styles')
    <link rel="stylesheet" href="{{ asset('front/assets/css/order.css?ver=' . str_random(10)) }}">
@endsection

@section('content')
<main>
<div class="container">
            <ul class="b-crumbs">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.view') }}">
                        Warenkorb
                    </a>
                </li>
                <li>
                    Zur Kasse
                </li>
            </ul>

            <div class="steps-1">
                <ul class="ul-2">
                    <li id="checkout_cart">
                        <a href="{{ url(route('cart.view')) }}">
                            <span class="step-1 done"><span class="number-1">1</span><span class="text-1">Warenkorb</span></span>
                        </a>
                    </li>
                    <li id="checkout_register">
                        <a href="{{ url(route('order.address')) }}">
                            <span class="step-2 done"><span class="number-1">2</span><span class="text-1">Adresse &amp; Lieferung</span></span>
                        </a>
                    </li>
                    <li id="checkout_control">
                        <span class="step-3 on"><span class="number-1">3</span><span class="text-1">Zahlung</span></span>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>

    <div class="main-ttl"><span>{{ __('front.checkout') }}</span></div>

    @if(count($cartItems) <=  0)
        <p>{{ __('front.product-no-found') }} <a href="{{ route('home') }}">{{ __('front.start-shopping') }}</a></p>
    @else

    <div class="help-block">
        <span class="payment-error"></span>
    </div>
    <form id="place-order-form" method="post" action="{{ route('order.place') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-9">
                <table id="cart_table" class="table table-bordered table-hover table-responsive" style="margin-top: 10px">
                    <thead>
                        <tr>
                            <th class="cart-image">{{ __('front.photo') }}</th>
                            <th>{{ __('front.product-name') }}</th>
                            <th>{{ __('front.quantity') }}</th>
                            <th>{{ __('front.unit-price') }}</th>
                            {{--<th class="text-right">{{ __('front.delivery_option') }}</th>--}}
                            <th>{{ __('front.total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $discount = 0;
                        $subTotal = 0;
                        $subTotal25 = 0;
                        $subTotal77 = 0;
                        $subTotalPickup = 0;
                        $subTotalDelivery = 0;
                        $totalTax25 = 0;
                        $totalTax77 = 0;
                        $shipping = 0;
                        ?>
                        {{-- {{dd($cartItems)}} --}}
                        @foreach($cartItems as $key => $cartItem)
                        <tr>
                            <td class="cart-image" style="width: 100px">
                                <a href="{{ "package" == substr($key, 0, 7) ? '#' : route('product.view', $cartItem['slug']) }}">
                                    <img alt="{{ $cartItem['name'] }}"
                                         class="{{ "package" == substr($key, 0, 7) ? asset('front/assets/img/package-default.png') : \App\Models\Database\Product::where('id', $cartItem['id'])->first()->main_image->filters}}"
                                         src="{{ asset( $cartItem['image']) }}"/>
                                </a>
                            </td>
                            <td>{{ $cartItem['name'] }}</td>
                            <td>{{ $cartItem['qty'] }}</td>
                            <td>CHF {{ number_format($cartItem['price'], 2) }}</td>
                            <td>CHF {{ number_format($cartItem['qty'] * $cartItem['price'], 2) }}</td>
                        </tr>

                        <?php
                        $shipping = (float)\App\Models\Database\Configuration::getConfiguration('delivery_price');

                        if ($cartItem['pdv'] == '2.5') {
                            $subTotal25 += $cartItem['qty'] * $cartItem['price'];
                        } elseif ($cartItem['pdv'] == '7.7') {
                            $subTotal77 += $cartItem['qty'] * $cartItem['price'];
                        }

                        ?>

                        <input type="hidden" name="products[]" value="{{ $cartItem['id'] }}"/>
                        @endforeach
                        <?php
                            $subTotal = ($subTotal25 + $subTotal77);

                            $totalTax25 = ($subTotal25 / 100) * 2.5;
                            $totalTax77 = ($subTotal77 / 100) * 7.7;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3">
                <div class="card mb-3">
                    <div class="card-body" id="checkout-receipt">
                        <h1 class="t-upcase text-center">Kassenzettel</h1>
                        @if(Auth::check())
                        @php 
                            $discount = $subTotal * 2 / 100;
                        @endphp
                            <h3 class="t-savings text-center">Sie sparen CHF {{ number_format($discount, 2) }}!</h3>
                        @endif
                        <table class="table table-responsive" style="background: #fff;">
                            @php
                            $subTotalWithDiscount = $subTotal - $discount;
                            $total = $subTotalWithDiscount >= 100 ? $subTotalWithDiscount : $subTotalWithDiscount + $shipping;
                            $deliveryTotal = $subTotalDelivery + $shipping;
                            $pickupTotal = $subTotalPickup;
                            Session::put('shipping', $shipping);
                            Session::put('subtotal', $subTotal);
                            Session::put('paypalSubtotal', $subTotal - $discount);
                            Session::put('discount', $discount);
                            Session::put('total', $total);
                            Session::put('deliveryTotal', $deliveryTotal);
                            Session::put('pickupTotal', $pickupTotal);
                            Session::put('totalTax25', $totalTax25);
                            Session::put('totalTax77', $totalTax77);
                            @endphp
                            <tr>
                                <td colspan="4" class="hidden-xs"><strong>Subtotal:</strong></td>
                                <td class="text-right total t-bold" data-total="{{ $subTotal }}">
                                CHF {{ number_format($subTotal, 2) }}</td>
                            </tr>
                            @if(Auth::check())
                            <tr class="shipping-row">
                                <td colspan="4" class="hidden-xs"><strong>Rabatt:</strong></td>
                                <td class="text-right auth-discount t-bold" data-shipping-cost="{{ $shipping }}">CHF {{ number_format($discount, 2) }}</td>
                            </tr>
                            @endif
                            @if($subTotal < 100)
                            <tr class="shipping-row">
                                <td colspan="4" class="hidden-xs"><strong>{{ __('front.shipping-option') }}:</strong></td>
                                <td class="text-right shipping-cost t-bold" data-shipping-cost="{{ $shipping }}">CHF {{ number_format($shipping, 2) }}</td>
                            </tr>
                            @endif
{{--                             <tr class="t-muted tax">
                                <td colspan="4" class="hidden-xs "><strong>{{ __('front.contain_vat', ['vat' => '2.5']) }}</strong></td>
                                <td class="text-right t-bold">{{ 'CHF ' . number_format($totalTax25, 2) }}</td>
                            </tr>
                            <tr class="t-muted">
                                <td colspan="4" class="hidden-xs"><strong>{{ __('front.contain_vat', ['vat' => '7.7']) }}</strong></td>
                                <td class="text-right t-bold">{{ 'CHF ' . number_format($totalTax77, 2) }}</td>
                            </tr> --}}
                            
                        </table>
                        <h3 class="text-center" style="margin-top: 15px;" >{{ __('front.total') }} exkl. MwSt</h3>
                        <h1 class="total t-upcase t-bold text-center" data-total="{{ $total }}">CHF {{ number_format($total, 2) }}</h1>
                    </div>
                </div>

                <div class="card mb-3" style="clear: both;">
                    <div class="card-header">
                        {{ __('front.your-comment') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <textarea name="comment" rows="3" class="form-control checkout-textarea"></textarea>
                            <div class="buttons clearfix">
                                <div class="float-right" style="margin:15px 0; color: #fff; font-size: 13px;">
                                    Mit meiner Bestellung erkläre ich mich mit den Datenschutzbestimmungen und den <a href="{{ $termConditionPageUrl }}">AGB's</a> von centrocaffe.ch einverstanden.
                                </div>
                            </div>

                            <div class="payment float-right clearfix">
                                <button type="submit" class="checkout-submit"
                                        data-loading-text="Loading..." 
                                        id="place-order-button">{{ __('front.place-order') }}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    @endif
</div>
<div id="loading" class="is-hidden">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="loading-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</div>
</main>
@endsection

@push('scripts')
<script>
    $(function () {
        function calcualateTotal() {
            subTotal = parseFloat(jQuery('.sub-total').attr('data-sub-total')).toFixed(2);
            shippingCost = parseFloat(jQuery('.shipping-cost').attr('data-shipping-cost')).toFixed(2);
            taxAmount = parseFloat(jQuery('.tax-amount').attr('data-tax-amount')).toFixed(2);

            total = parseFloat(subTotal) + parseFloat(taxAmount) + parseFloat(shippingCost);
            jQuery('.total').attr('data-total', total.toFixed(2));
            jQuery('.total').html("$" + total.toFixed(2));
        }


        function checkIfUserExist(data) {
            $.post({
                url : "/check-user-exists",
                data : data,
                type: 'json',
                success:function(res) {
                    console.info(res);
                }
            });
        }

        jQuery(document).on('change','#input-user-email',function(e) {
            var data = {
                'email': jQuery(this).val(),
                '_token': '{{ csrf_token()  }}'
            };

            checkIfUserExist(data);

        });

            /**
             jQu`ry('.tax-calculation').change(function () {
            var data = {
                'name': jQuery(this).attr('data-name'),
                'value': jQuery(this).val(),
                '_token': '{{ csrf_token()  }}'
            };

            $.post({
                data: data,
                type: 'json',
                url: '#',
                success: function (res) {
                    if ((res.success == true)) {
                        jQuery('.tax-amount').html(res.tax_amount_text);
                        jQuery('.tax-amount').attr('data-tax-amount', res.tax_amount);
                        calcualateTotal();
                    }
                }
            });
        });
        */
        jQuery('.shipping_option_radio').change(function (e) {

            if (jQuery(this).is(':checked')) {
                var shippingTitle = jQuery(this).attr('data-title');
                var shippingCost = jQuery(this).attr('data-cost');

                jQuery('.shipping-row').removeClass('hidden');

                jQuery('.shipping-row .shipping-title').html(shippingTitle + ":");
                jQuery('.shipping-row .shipping-cost').html("$" + shippingCost);
                jQuery('.shipping-row .shipping-cost').attr('data-shipping-cost', shippingCost);


            } else {
                jQuery('.shipping-row').addClass('hidden');
            }
            calcualateTotal();
        });

        jQuery('#place-order-button').click(function (e) {
            jQuery('#place-order-form').submit();
        });
    });
</script>
@endpush

@section('scripts')
<script>
    $(function () {
        // toggle show shipping address
        $('input#use_different_shipping_address').on('click', function () {
            $('#different-shipping-form').toggle();
        });
    });
</script>

<script>
    function checkCompany() {
        var check = document.getElementById('is_company');
        var action = document.getElementById('check_company');
        var input = document.getElementById('company_name');
        var value = check.options[check.selectedIndex].value;

        if (value == 1) {
            action.style.display = 'block';
            input.setAttribute('required', '');

        } else {
            action.style.display = 'none';
            input.removeAttribute('required');
        }
    }
</script>
@stop