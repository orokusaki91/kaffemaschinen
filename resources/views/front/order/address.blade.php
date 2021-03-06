@extends('front.layouts.app')

@section('meta_title', 'Adresse & Lieferung')
@section('meta_description', 'Mein Account Management System für Centrocaffe')

@section('styles')
    <link rel="stylesheet" href="{{ asset('front/assets/css/order.css?ver=' . str_random(10)) }}">
@endsection

@section('content')
    <!-- Main Content - start -->
    <main>
        <section class="container stylization maincont" style="" id="pozadina">


            <ul class="b-crumbs login_crumbs">
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
                    Adresse & Lieferung
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
                        <span class="step-2 on"><span class="number-1">2</span><span class="text-1">Adresse &amp; Lieferung</span></span>
                            </li>
                    <li id="checkout_control">
                        <span class="step-3 "><span class="number-1">3</span><span class="text-1">Zahlung</span></span>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>

            <div class="customer-info">
                <div class="customer-hello">
                    <h1 class="t-bold">ADRESSE & LIEFERUNG</h1>
                    <p>Sehr geehrter {{ $user->last_name }}, </p>
                    <p>bitte überprüfen Sie Ihre Rechnungs- und Lieferadresse</p>
                </div>
                <div class="customer-addresses">
                    <div class="billing-address">
                        <h3 class="t-bold">Rechnungsadresse</h3>
                        <p>{{ $billingAddress->title }} {{ $billingAddress->first_name }} {{ $billingAddress->last_name }}</p>
                        <p>{{ $billingAddress->address1 }}</p>
                        <p>{{ $billingAddress->postcode }} {{ $billingAddress->city }}</p>
                            <a href="{{ url('/order/address/billing/edit') }}">Rechnungsadresse ändern</a>
                    </div>
                    <div class="shipping-address">
                        <h3 class="t-bold">Lieferadresse</h3>
                        <p>{{ $shippingAddress->title }} {{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}</p>
                        <p>{{ $shippingAddress->address1 }}</p>
                        <p>{{ $shippingAddress->postcode }} {{ $shippingAddress->city }}</p>
                        <a href="{{ url('/order/address/shipping/edit') }}">Lieferadresse ändern</a>
                    </div>
                </div>
                <div class="cart-submit">
                    <a href="{{ url('checkout') }}" id="button-checkout" class="cart-submit-btn" style="margin-bottom: 0;">Weiter</a>
                    <a href="{{ route('home') }}" class="cart-clear" id="continue-shopping" style="margin-bottom: 0; color: #666;">{{ __('front.continue-shopping') }}</a>
                </div>
            </div>
        </section>
    </main>
@stop