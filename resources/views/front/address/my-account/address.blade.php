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
                        <h3 class="main-ttl">
                            <span>{{ __('front.address') }}</span>
                        </h3>
                        @if(count($addresses) <= 0)
                            <p>Keine Adresse vorhanden</p>
                        @else
                            <div class="row space">
                                <div class="auth-wrap">
                                    @foreach($addresses as $address)
                                        <div class="auth-col" style="margin: 0;">
                                            <div class="table-responsive">
                                                <table class="table myacc_table">
                                                    <thead>
                                                    <tr>
                                                        @if($address->type == "SHIPPING")
                                                            <th>{{ __('front.account-shipping-address') }}</th>
                                                            <th>
                                                                <a href="{{ route('my-account.address.edit', $address->id) }}" style="color: cornflowerblue">Bearbeiten</a> | 
                                                                <form action="{{ route('my-account.address.destroy', $address->id) }}" method="POST" style="display: inline-block;">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                    <button style="color: red" class="link-button">Löschen</button>
                                                                </form>
                                                            </th>
                                                        @else
                                                            <th>{{ __('front.account-billing-address') }}</th>
                                                            <th>
                                                                <a href="{{ route('my-account.address.edit', $address->id) }}" style="color: cornflowerblue">Bearbeiten</a>
                                                            </th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.account-first-name') }}</td>
                                                        <td>{{ $address->first_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.account-last-name') }}</td>
                                                        <td>{{ $address->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.account-address-1') }}</td>
                                                        <td>{{ $address->address1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.account-Address 2') }}</td>
                                                        <td>{{ $address->address2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.account-city') }}</td>
                                                        <td>{{ $address->city }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.account-zip') }}</td>
                                                        <td>{{ $address->postcode }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 700">{{ __('front.phone') }}</td>
                                                        <td>{{ $address->phone }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        @if(!$user->getShippingAddress())
                            <div class="form-group col-sm-12" style="padding-left: 0px">
                                <label style="color: #fff;">
                                    <input type="checkbox" id="use_different_shipping_address" name="use_different_shipping_address" autocomplete="off">&nbsp;{{ __('front.different-shipping-address') }}
                                </label>
                            </div>
                            <form action="{{ url('my-account/address/new') }}" method="post" id="different-shipping-form" style="display: none; clear: both;">
                                <div class="radio shipping-address-wrapper">
                                    <div class="row">
                                        <div class="form-group  col-sm-6">
                                            {{--<label class="control-label" for="input-billing-firstname">{{ __('front.account-first-name') }}*</label>--}}
                                            <input type="text" name="first_name"
                                            value="" placeholder="{{ __('front.account-first-name') }}*"
                                            id="name" class="form-control checkout-input">
                                        </div>
                                        <div class="form-group  col-sm-6">
                                            {{--<label class="control-label" for="input-billing-lastname">{{ __('front.account-last-name') }}*</label>--}}
                                            <input type="text" name="last_name"
                                            value="" placeholder="{{ __('front.account-last-name') }}*"
                                            id="name" class="form-control checkout-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{--<label class="control-label" for="input-shipping-address-1">{{ __('front.account-address-1') }}*</label>--}}
                                        <input type="text" name="address" value="" placeholder="{{ __('front.account-address-1') }}*"
                                        id="name" class="form-control checkout-input">
                                    </div>

                                    <div class="form-group">
                                        {{--<label class="control-label" for="input-shipping-address-2">{{ __('front.account-Address 2') }}</label>--}}
                                        <input type="text" name="address2" value="" placeholder="{{ __('front.account-Address 2') }}"
                                        id="name" class="form-control checkout-input">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            {{--<label class="control-label" for="input-shipping-postcode">{{ __('front.account-zip') }}*</label>--}}
                                            <input type="text" data-name="postcode" name="postcode" value=""
                                            placeholder="{{ __('front.account-zip') }}*"
                                            id="name" class="form-control checkout-input">
                                        </div>


                                        <div class="form-group  col-sm-6">
                                            {{--<label class="control-label" for="input-shipping-city">{{ __('front.account-city') }}*</label>--}}
                                            <input type="text" data-name="city" name="city" placeholder="{{ __('front.account-city') }}*"
                                            id="name" class="form-control checkout-input">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            {{--<label class="control-label" for="input-shipping-phone">{{ __('front.phone') }}</label>--}}
                                            <input type="text" name="phone" value="" placeholder="{{ __('front.phone') }}"
                                            id="name" class="form-control checkout-input">
                                            <input type="hidden" name="type" value="shipping">
                                            {{ csrf_field() }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <div class="login_button">
                                                <input class="button_login" type="submit" value="Speichern">
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        @endif
                        {{-- <div class="row space">
                            <a class="button-c" href="{{ route('my-account.address.new') }}" style="color: #fff;">Adresse hinzufügen</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script>
    $(function () {
        // toggle show shipping address
        $('input#use_different_shipping_address').on('click', function () {
            $('#different-shipping-form').toggle();
        });
    });
</script>
@stop