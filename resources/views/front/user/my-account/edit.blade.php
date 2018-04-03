<?php $nav_edit = 'active'; ?>

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
                        <h3 class="main-ttl">
                            <span>{{ __('front.account-profile-edit') }}</span>
                        </h3>
                        <div class="row space">
                            <div class="auth-wrap">

                                <div class="auth-col" style="width: 100%; margin: 0;">
                                    <form method="post" action="{{ route('my-account.store') }}">
                                        {{ csrf_field() }}
                                        <p>
                                            <label for="title">{{ __('front.account-title') }}<span class="required"></span></label>
                                            <label class="radio-inline">
                                                <input class="herr_frau" type="radio" name="title" value="Herr" @if ($user->title == 'Herr') checked @endif>Herr
                                            </label>
                                            <label class="radio-inline">
                                                <input class="herr_frau" type="radio" name="title" value="Frau" @if ($user->title == 'Frau') checked @endif>Frau
                                            </label>
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <p>
                                            <input class="change_passwort" placeholder="{{ __('front.account-first-name') }}" id="firstname" type="text" value="{{ $user->first_name }}"
                                                   name="first_name">
                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <p>
                                            <input class="change_passwort" placeholder="{{ __('front.account-last-name') }}" id="lastname" type="text" value="{{ $user->last_name}}"
                                                   name="last_name">
                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <p>
                                            <input class="change_passwort" placeholder="{{ __('front.email') }}" id="email" type="text" disabled="true"
                                                   value="{{ $user->email }}"
                                                   name="email">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <p>
                                            <input class="change_passwort" placeholder="{{ __('front.phone') }}" id="tel" type="text"
                                                   value="{{ $user->phone }}"
                                                   name="phone">
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <p>
                                            <input class="change_passwort" placeholder="{{ __('front.account-company-name') }}" id="company" type="text"
                                                   value="{{ $user->company_name }}"
                                                   name="company_name">
                                            @if ($errors->has('company_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <p class="auth-submit">
                                            <input type="submit" value="{{ __('front.account-update-profile') }}">
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