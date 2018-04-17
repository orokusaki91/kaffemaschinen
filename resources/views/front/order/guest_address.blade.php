@extends('front.layouts.app')

@section('meta_title', 'Registration')
@section('meta_description', 'Mein Account Management System für Centrocaffe')

@section('styles')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"/>
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
            <div class="auth-wrap">
                <div class="auth-col">
                    <h1 class="main-ttl"><span>{{ __('front.account-register') }}</span></h1>
                    <form class="register" role="form" method="POST" action="{{ url('order/address/guest') }}">
                        {{ csrf_field() }}
                        <p>
                            <select onchange="checkCompany()" name="is_company" id="is_company">
                                <option selected disabled>{{ __('front.please-select') }}</option>
                                <option value="0">{{ __('front.private-customer') }}</option>
                                <option value="1">{{ __('front.business-customer') }}</option>
                            </select>
                        </p>
                        <p id="check_company" style="display: none">
                            <input id="company_name" placeholder="Firmenname" type="text" name="company_name" value="{{ old('company_name') }}">
                        </p>
                        <p>
                            <label for="title">{{ __('front.account-title') }}*<span class="required"></span></label>
                            <label class="radio-inline">
                                <input class="herr_frau" type="radio" name="title" value="Herr">Herr
                            </label>
                            <label class="radio-inline">
                                <input class="herr_frau" type="radio" name="title" value="Frau">Frau
                            </label>                        </p>
                        <p>
                            <input id="firstname" placeholder="{{ __('front.account-first-name') }}*" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
                        </p>
                        <p>
                            <input id="lastname" placeholder="{{ __('front.account-last-name') }}*" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>
                        </p>

                        <p>
                            <input id="reg_email" placeholder="Adresse*" type="text" name="address" value="{{ old('address') }}" required>
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.account-city') }}*" type="text" name="city" value="{{ old('city') }}" required>
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.account-zip') }}*" type="text" name="zip" value="{{ old('zip') }}" required>
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.phone') }} P" type="text" name="phone" value="{{ old('phone') }}" required>
                        </p>
                        <p>
                            <input id="password" placeholder="E-mail*" type="email" name="email" value="{{ old('email') }}" required>
                        </p>
                        <div class="remember_me_register">
                           <input id="subscribe" type="checkbox" name="subscribe" style="display:none">
                            <label class="labelcina" for="subscribe">{{ __('front.i-want-to-subscribe') }}<span class="required"></span></label>
                            
                        </div>
                        <p class="auth-submit">
                            <input type="submit" value="{{ __('front.account-register') }}">
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- Main Content - end -->

@endsection

@section('scripts')
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
@endsection