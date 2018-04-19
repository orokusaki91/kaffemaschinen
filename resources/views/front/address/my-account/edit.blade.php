<?php $nav_address = 'active'; ?>

@extends('front.layouts.app')

@section('meta_title','My Address List Account E commerce')
@section('meta_description','My Address List Account E commerce')

@section('content')
    <main class="padd">
        <div class="container">
            <div class="bat">
                <div class="row">
                    @include('front.user.my-account.sidebar')
                    <div class="col-sm-7 profile-info">
                        <form action="{{ url(route('my-account.address.update',  $address->id)) }}" method="POST">
                            <input type="hidden" name="_method" value="PATCH" />
                            {{ csrf_field() }}
                            <div class="row space">
                                <div id="different-shipping-form" style="clear: both;">
                                    <div class="radio shipping-address-wrapper">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="title">{{ __('front.account-title') }}*<span class="required"></span></label>
                                                <label class="radio-inline">
                                                    <input class="herr_frau" type="radio" name="title" value="Herr" {{ $address->title == 'Herr' ? 'checked' : '' }}>Herr
                                                </label>
                                                <label class="radio-inline">
                                                    <input class="herr_frau" type="radio" name="title" value="Frau" {{ $address->title == 'Frau' ? 'checked' : '' }}>Frau
                                                </label>      
                                            </div>
                                        </div>
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

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <input type="text" name="address" value="{{ $address->address1 }}" placeholder="{{ __('front.account-address-1') }}*"
                                                       id="input-shipping-address-1" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input type="text" data-name="postcode" name="postcode" value="{{ $address->postcode }}"
                                                       placeholder="{{ __('front.account-zip') }}*"
                                                       id="input-shipping-postcode"
                                                       class="shipping tax-calculation  form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            

                                            <div class="form-group  col-sm-6">
                                                <input type="text" 
                                                        data-name="city" 
                                                        name="city" 
                                                        value="{{ $address->city }}" 
                                                        placeholder="{{ __('front.account-city') }}*"
                                                       id="input-shipping-city"
                                                       class="shipping tax-calculation  form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <input type="text" name="phone" value="{{ $address->phone }}" placeholder="{{ __('front.phone') }}"
                                                       id="input-shipping-phone" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            
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
                            <div class="crvena_zvezdica">
                                <p>Obligatorische Felder sind mit (*) markiert</p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection