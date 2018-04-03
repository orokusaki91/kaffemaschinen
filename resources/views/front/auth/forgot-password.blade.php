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
                    <form class="login" role="form" method="POST" action="/forgot-password">
                        {{ csrf_field() }}
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            <label for="email">E-mail <span class="required">*</span></label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </p>
                        <p class="auth-submit">
                            <button type="submit" class="btn btn-primary">
                                Senden
                            </button>
                        </p>
                    </form>
                </div>
            </div>



        </section>
    </main>
    <!-- Main Content - end -->

@endsection

