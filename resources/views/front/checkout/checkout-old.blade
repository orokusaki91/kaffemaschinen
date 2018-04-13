<div class="card billing-address-wrapper">
                    <div class="card-header">
                        {{ __('front.personal-details') }}
                    </div>
                    <div class="card-body" style="margin-top: 10px">
                        <?php
                        $firstName = $lastName = $phone = "";
                        if (Auth::check()) {
                            $firstName = Auth::user()->first_name;
                            $lastName = Auth::user()->last_name;
                            $phone = Auth::user()->phone;
                        }
                        ?>
                        @if(!Auth::check())
                         <div class="row">
                            <div class="form-group col-sm-6">
                                <select onchange="checkCompany()" name="is_company" id="is_company" class="form-control checkout-input">
                                    <option selected disabled>{{ __('front.please-select') }}</option>
                                    <option value="0">{{ __('front.private-customer') }}</option>
                                    <option value="1">{{ __('front.business-customer') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6" id="check_company" style="display: none;">
                                <input id="company_name" class="form-control checkout-input" placeholder="Firmenname" type="text" name="company_name" value="{{ old('company_name') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                {{--<label class="control-label" for="input-user-first-name">{{ __('front.account-first-name') }}*</label>--}}
                                <input type="text" name="billing_first_name" placeholder="{{ __('front.account-first-name') }}"
                                id="name" class="form-control checkout-input">
                            </div>
                            <div class="form-group  col-sm-6">
                                {{--<label class="control-label" for="input-user-last-name">{{ __('front.account-last-name') }}*</label>--}}
                                <input type="text" name="billing_last_name" placeholder="{{ __('front.account-last-name') }}"
                                id="name" class="form-control checkout-input">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div id="payment-address-new">
                            <?php
                            $address = NULL;
                            if (NULL !== $user) {
                                $address = $user->getBillingAddress();
                            }
                            ?>
                            @if(NULL === $address)
                            <div class="form-group">
                                {{--<label class="control-label" for="input-billing-address-1">{{ __('front.address') }}*</label>--}}
                                <input type="text" name="billing_address" value="" placeholder="{{ __('front.address') }}"
                                id="name" class="form-control checkout-input">
                            </div>

                            <div class="form-group">
                                {{--<label class="control-label" for="input-billing-address-2">{{ __('front.account-Address 2') }}</label>--}}
                                <input type="text" name="billing_address2" value="" placeholder="{{ __('front.account-Address 2') }}"
                                 id="name" class="form-control checkout-input">
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    {{--<label class="control-label" for="input-billing-postcode">{{ __('front.account-zip') }}*</label>--}}
                                    <input type="text" data-name="postcode" name="billing_postcode" value=""
                                    placeholder="{{ __('front.account-zip') }}"
                                    id="name" class="form-control checkout-input">
                                </div>
                                <div class="form-group  col-sm-6">
                                    {{--<label class="control-label" for="input-billing-city">{{ __('front.account-city') }}*</label>--}}
                                    <input type="text" data-name="city" name="billing_city"
                                    placeholder="{{ __('front.account-city') }}"
                                    id="name" class="form-control checkout-input">
                                </div>
                            </div>
                            
                             <div class="form-group">
                            {{--<label class="control-label" for="input-user-email">E-Mail*</label>--}}
                            <input type="text" name="email" placeholder="E-Mail"
                            id="name" class="form-control checkout-input">
                        </div>

                        <div class="register-form">
                            <div class="row">
                                <div class="form-group  col-sm-6">
                                    {{--<label class="control-label" for="input-billing-password">{{ __('front.account-password') }}*</label>--}}
                                    <input type="password" name="password" placeholder="{{ __('front.account-password') }}"
                                    id="name" class="form-control checkout-input">
                                </div>
                                <div class="form-group  col-sm-6">
                                    {{--<label class="control-label" for="input-billing-confirm">{{ __('front.account-confirm-password') }}*</label>--}}
                                    <input type="password" name="password_confirmation"
                                    placeholder="{{ __('front.account-confirm-password') }}"
                                    id="name" class="form-control checkout-input">
                                </div>
                            </div>
                        </div>
                            @else

                            <div class="form-group  col-sm-12">
                                <div class="card card-default">
                                    <div class="card-header">{{ __('front.account-billing-address') }}</div>
                                    <div class="card-body">

                                        <p style="color: #fff;">
                                            {{ $address->first_name }} {{ $address->last_name }}
                                            <br/>
                                            {{ $address->address1 }}<br/>
                                            {{ $address->address2 }}<br/>
                                            {{ $address->postcode }}<br/>
                                            {{ $address->city }}<br/>
                                            {{ $address->state }}<br/>
                                            {{ $address->phone }}<br/>
                                        </p>
                                        <input type="hidden" name="billing[id]" value="{{ $address->id }}"/>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>