@extends('front.layouts.app')

@section('meta_title', 'Registration')
@section('meta_description', 'Mein Account Management System für Centrocaffe')

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
            <div class="auth-wrap">
                <div class="auth-col">
                    <h1 class="main-ttl"><span>{{ __('front.account-register') }}</span></h1>
                    <form class="register" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <p>
                            <select onchange="checkCompany()" name="is_company" id="is_company">
                                <option selected disabled>{{ __('front.select-account-type') }}</option>
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
                            </label>                       
                        </p>
                        <p>
                            <input id="firstname" placeholder="{{ __('front.account-first-name') }}*" type="text" name="first_name" value="{{ old('first_name') }}" autofocus>
                        </p>
                        <p>
                            <input id="lastname" placeholder="{{ __('front.account-last-name') }}*" type="text" name="last_name" value="{{ old('last_name') }}" autofocus>
                        </p>

                        <p>
                            <input id="reg_email" placeholder="Adresse*" type="text" name="address" value="{{ old('address') }}">
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.account-city') }}*" type="text" name="city" value="{{ old('city') }}">
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.account-zip') }}*" type="text" name="zip" value="{{ old('zip') }}">
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.phone') }} P" type="text" name="phone" value="{{ old('phone') }}">
                        </p>
                        <p>
                            <input id="password" placeholder="E-mail*" type="text" name="email" value="{{ old('email') }}">
                        </p>
                        <p>
                            <input id="reg_password" placeholder="{{ __('front.account-password') }}*" type="password"  name="password">
                        </p>
                        <p>
                            <input id="password" placeholder="{{ __('front.account-confirm-password') }}*" type="password" name="password_confirmation">
                        </p>
                        <div class="remember_me_register">
                           <input id="subscribe" type="checkbox" name="subscribe" style="display:none">
                            <label class="labelcina" for="subscribe">{{ __('front.i-want-to-subscribe') }}<span class="required"></span></label>
                            
                        </div>
                        <p class="auth-submit">
                            <input type="submit" value="{{ __('front.account-register') }}">
                        </p>
                        <div class="crvena_zvezdica">
                            <p>Obligatorische Felder sind mit (*) markiert</p>
                        </div>
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