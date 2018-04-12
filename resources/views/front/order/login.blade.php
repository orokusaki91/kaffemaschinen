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

			<div class="col-md-3">
				<div class="auth-wrap">
                      	<h3>Ich habe bereits ein Ex Libris-Konto</h3>
                        <form class="login" role="form" method="POST" action="{{ route('order.login.post') }}">
                        {{ csrf_field() }}
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            <input placeholder="E-mail" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        </p>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        <p>
                            <input placeholder="Passwort" id="password" type="password" name="password" required>
                        </p>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                            @endif
                        
                       <div class="login_button">
                          <input class="button_login" type="submit" value="Login">
                           <div class="remember_me">
                               <input type="checkbox" name="remember_me" id="rememberme" value="forever" style="display:none;">
                               <label class="labelcina" for="rememberme">{{ __('front.account-remember-me') }}</label>
                           </div>
                           
                        </div>
                        <p class="auth-lost_password">
                            <a href="/forgot-password">{{ __('front.account-lost-your-password') }}</a>
                        </p>
                    </form>
                </div>
			</div>

			<div class="col-md-3">
				<h3>Ich bin Neukunde</h3>
                <form class="login" role="form" method="get" action="{{ route('order.register') }}">
					<div class="login_button">
	                 	<input class="button_login" type="submit" value="Registriren">
	                </div>
	            </form>
			</div>

			<div class="col-md-3">
				<h3>Als Gast bestellen (ohne Registrierung)</h3>
                <form class="login" role="form" method="get" action="{{ route('order.address.guest') }}">
					<div class="login_button">
	                 	<input class="button_login" type="submit" value="Als Gast bestellen">
	                </div>
	            </form>
			</div>

        </section>
    </main>
@stop