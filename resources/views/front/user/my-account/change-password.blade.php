<?php $nav_password = 'active'; ?>

@extends('front.layouts.app')

@section('meta_title','Kundenbereich')
@section('meta_description','Kundenbereich')

@section('content')
    <main class="padd">
        <div class="container">
            <div class="bat">
                <div class="row">

                    @include('front.user.my-account.sidebar')

                    <div class="col-sm-7 profile-info">
                        <h3 class="main-ttl"><span>{{ __('front.account-change-password') }}</span></h3>
                        <div class="row space">
                            <div class="auth-wrap">

                                <div class="auth-col" style="width: 100%; margin:0;">
                                    <form method="post" action="{{ route('my-account.change-password.post') }}" >
                                        {{ csrf_field() }}

                                        <p>
                                            <input placeholder="{{ __('front.account-current-password') }}" type="password" name="current_password" id="reg_password" class="change_passwort">
                                        </p>
                                        <p>
                                            <input placeholder="{{ __('front.account-new-password') }}" type="password" name="password" id="reg_password" class="change_passwort">
                                        </p>
                                        <p>
                                            <input placeholder="{{ __('front.account-confirm-password') }}" type="password" name="password_confirmation" id="reg_password" class="change_passwort">
                                        </p>

                                        <p class="auth-submit">
                                            <input type="submit" value="{{ __('front.account-change-password') }}">
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection