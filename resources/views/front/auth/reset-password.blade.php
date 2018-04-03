@extends('front.layouts.app')

@section('meta_title', __('front.account-lost-your-password'))
@section('meta_description', 'My Account Management System for Centrocaffe E Commerce')

@section('content')
    <!-- Main Content - start -->
    <main>
        <section class="container stylization maincont">


            <ul class="b-crumbs">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/forgot-password">
                        {{ __('front.account-lost-your-password') }}
                    </a>
                </li>
            </ul>
            <h1 class="main-ttl"><span>{{ __('front.account-lost-your-password') }}</span></h1>
            <div class="auth-wrap">
                <div class="auth-col">
                    <h2>{{ __('front.account-lost-your-password') }}</h2>
                    <form class="login" role="form" method="POST" action="">
                        {{ csrf_field() }}
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            <label for="password">Passwort<span class="required">*</span></label>
                            <input id="password" type="password" name="password" class="form-control" required autofocus>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </p>
                        <p>
                            <label for="password_confirmation">Passwort Bestätigung<span class="required">*</span></label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autofocus>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </p>
                        <p class="auth-submit">
                            <button type="submit" class="btn btn-primary">
                                Kennwort aktualisieren
                            </button>
                        </p>
                    </form>
                </div>
            </div>



        </section>
    </main>
    <!-- Main Content - end -->

@endsection

