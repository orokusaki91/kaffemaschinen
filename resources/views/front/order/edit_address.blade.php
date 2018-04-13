@extends('front.layouts.app')

@section('meta_title', 'Registration')
@section('meta_description', 'Mein Account Management System für Centrocaffe')

@section('styles')
    <link rel="stylesheet" href="{{ asset('front/assets/css/order.css?ver=' . str_random(10)) }}">
@endsection

@section('content')
    <!-- Main Content - start -->
    <main>
        <section class="container stylization maincont" style="padding-top: 50px;" id="pozadina">


            <ul class="b-crumbs login_crumbs">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}">
                        Registrierung
                    </a>
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
            
            <form action="{{ url(route('order.address.update', strtolower($address->type))) }}" method="POST">
                <input type="hidden" name="_method" value="PUT" />
                {{ csrf_field() }}
                <div class="row space">
                    <div id="different-shipping-form" style="clear: both;">
                        <div class="radio shipping-address-wrapper">
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    <input type="text" name="first_name"
                                           value="{{ $address->first_name }}" placeholder="{{ __('front.account-first-name') }}*"
                                           id="input-billing-firstname" class="form-control">
                                </div>
                                <div class="form-group  col-sm-6">
                                    <input type="text" name="last_name"
                                           value="{{ $address->last_name }}" placeholder="{{ __('front.account-last-name') }}*"
                                           id="input-billing-lastname" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="text" name="address" value="{{ $address->address1 }}" placeholder="{{ __('front.account-address-1') }}*"
                                       id="input-shipping-address-1" class="form-control">
                            </div>

                            {{-- <div class="form-group">
                                <input type="text" name="address2" value="{{ $address->address2 }}" placeholder="{{ __('front.account-Address 2') }}"
                                       id="input-shipping-address-2" class="form-control">
                            </div> --}}

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input type="text" data-name="postcode" name="postcode" value="{{ $address->postcode }}"
                                           placeholder="{{ __('front.account-zip') }}*"
                                           id="input-shipping-postcode"
                                           class="shipping tax-calculation  form-control">
                                </div>


                                <div class="form-group  col-sm-6">
                                    <input type="text" 
                                            data-name="city" 
                                            name="city" 
                                            value="{{ $address->city }}" 
                                            placeholder="{{ __('front.account-city') }}*"
                                           id="input-shipping-city"
                                           class="shipping tax-calculation  form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    
                                    <input type="text" name="phone" value="{{ $address->phone }}" placeholder="{{ __('front.phone') }}{{ $address->type == 'BILLING' ? '*' : '' }}"
                                           id="input-shipping-phone" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="hidden" class="form-control" id="delivery" name="type" value="{{ $address->type == 'SHIPPING' ? 'SHIPPING' : 'BILLING' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row space">
                    <button type="submit" class="new_address_button">Speichern</button>
                </div>
            </form>
        </section>
    </main>
@stop