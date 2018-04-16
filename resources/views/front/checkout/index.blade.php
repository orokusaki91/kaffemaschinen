@extends('front.layouts.app')

@section('meta_title','Checkout Page')
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
                        $subTotal = 0;
                        $subTotal25 = 0;
                        $subTotal77 = 0;
                        $subTotalPickup = 0;
                        $subTotalDelivery = 0;
                        $totalTax25 = 0;
                        $totalTax77 = 0;
                        $shipping = 0;
                        ?>
                        @foreach($cartItems as $cartItem)
                        <tr>
                            <td class="cart-image" style="width: 100px">
                                <a href="{{ route('product.view', $cartItem['slug'])}}">
                                    <img alt="{{ $cartItem['name'] }}"
                                         class="{{\App\Models\Database\Product::where('id', $cartItem['id'])->first()->main_image->filters}}"
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
                        {{-- <h3 class="t-savings text-center">Ich spare CHF 9,95!</h3> --}}
                        <table class="table table-responsive" style="background: #fff;">
                            @php 
                            $total = $subTotal > 100 ? $subTotal : $subTotal + $shipping;
                            $deliveryTotal = $subTotalDelivery + $shipping;
                            $pickupTotal = $subTotalPickup;
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
                            @if($subTotal < 100)
                            <tr class="shipping-row">
                                <td colspan="4" class="hidden-xs"><strong>{{ __('front.shipping-option') }}:</strong></td>
                                <td class="text-right shipping-cost t-bold" data-shipping-cost="{{ $shipping }}">CHF {{ number_format($shipping, 2) }}</td>
                            </tr>
                            @endif
                            <tr class="t-muted tax">
                                <td colspan="4" class="hidden-xs "><strong>{{ __('front.contain_vat', ['vat' => '2.5']) }}</strong></td>
                                <td class="text-right t-bold">{{ 'CHF ' . number_format($totalTax25, 2) }}</td>
                            </tr>
                            <tr class="t-muted">
                                <td colspan="4" class="hidden-xs"><strong>{{ __('front.contain_vat', ['vat' => '7.7']) }}</strong></td>
                                <td class="text-right t-bold">{{ 'CHF ' . number_format($totalTax77, 2) }}</td>
                            </tr>
                            
                        </table>
                        <h3 class="text-center" style="margin-top: 15px;" >{{ __('front.total') }} inkl. MwSt</h3>
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
                                <input type="submit" class="checkout-submit"
                                data-loading-text="Loading..." id="place-order-button" 
                                value="{{ __('front.place-order') }}">
                                <input type="hidden" name="stripeToken" id="stripeToken">
                                <input type="hidden" name="stripeEmail" id="stripeEmail">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    @endif
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
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    let stripe = StripeCheckout.configure({
        key: '{{ config('stripe.publishable_key') }}',
        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
        locale: 'auto',
        token: function (token) {
            var stripeEmail = $('#stripeEmail');
            var stripeToken = $('#stripeToken');
            stripeEmail.val(token.email);
            stripeToken.val(token.id);
            // submit the form
            var url = '{{ route('order.place') }}';
            var token = $('input[name="_token"]').val();
            var form = $('#place-order-form');
            var data = form.serialize();
            // fire ajax post request
            $.post(url, data)
            .done(function (data) {
                window.location.href = getUrl();
            })
            .fail(function(data, textStatus) {
                var errors = data.responseJSON.errors;
                console.log(errors);
                if (!jQuery.isEmptyObject(errors)) {
                    $('ul.billing_errors').remove();
                    $('ul.shipping_errors').remove();
                    var billingErrors = $('<ul></ul>', {
                        class: 'billing_errors'
                    }).insertBefore('.billing-address-wrapper');
                    var shippingErrors = $('<ul></ul>', {
                        class: 'shipping_errors'
                    }).insertBefore('.shipping-address-wrapper');
                        // error.replace(key, $('input[name="' + mainFieldName + '[' + secondaryFieldName + ']]"').siblings('label').text())
                        for (var key in errors) {
                            var error = errors[key][0];
                            if (errors[key][0].indexOf('billing') >= 0) {
                                billingErrors.addClass('alert').addClass('alert-danger');
                                $('<li></li>', {
                                    text: error.replace('billing', '')
                                }).appendTo(billingErrors);
                            } 
                            if(errors[key][0].indexOf('shipping') >= 0) {
                                shippingErrors.addClass('alert').addClass('alert-danger');
                                $('<li></li>', {
                                    text: error.replace('shipping', '')
                                }).appendTo(shippingErrors);
                            }
                        }
                    }
                });
        }
    });
    $('#place-order-form').on('submit', function (e) {
        stripe.open({
            name: 'Centrocaffe',
            description: 'Billing',
        });
        e.preventDefault();
    });
</script>

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