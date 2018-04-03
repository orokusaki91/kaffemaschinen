<?php $nav_orders = 'active'; ?>

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
                        <h3 class="main-ttl"><span>Bestellansicht</span></h3>
                        <div class="row space">
                            <div class="auth-wrap">
                               <table class="bestel_table">
                                   <tr>
                                       <td>
                                            <h3 class="fet">Grundinformation Ihrer Bestellung</h3>
                                       </td>
                                            
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="h5">Bestellnummer: {{ $order->id }}</label><br>
                                        </td>
                                    </tr>
                               </table>
                               
                               
                               <!--
                                <label class="h5">Geschlossen / Offen: {{ $order->payment_option }}</label><br>
                                <label class="h5">Bestellnummer: {{ $order->orderStatusTitle  }}</label><br>
-->
                                <h3 class="fet" style="padding-top: 20px">Bestellinformationen</h3>
                                <div class="table-responsive">
                                    <table class="table order_view_table">

                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titel</th>
                                            <th>Menge</th>
                                            <th>Preis</th>
                                            <th>Gesamt</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->products as $product)
                                                <tr>
                                                    <td>{{ $product->product_no }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->getRelationValue('pivot')->qty }}</td>
                                                    <td>CHF {{ number_format($product->getRelationValue('pivot')->price, 2) }}</td>
                                                    <td>CHF {{ number_format($total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <h3 class="fet">Kundendaten</h3>
                                <div class="table-responsive row">
                                    @if (!is_null($order->shipping_address_id))
                                        <div class="col-sm-6">
                                            <table class="table order_view_table">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('lang.order-shipping-info') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{ $order->shipping_address->first_name }} {{ $order->shipping_address->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->shipping_address->address1 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->shipping_address->address2 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->shipping_address->postcode }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->shipping_address->city }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->shipping_address->phone }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="col-sm-6">
                                            <table class="table order_view_table">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('lang.order-shipping-info') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{ $order->billing_address->first_name }} {{ $order->billing_address->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->billing_address->address1 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->billing_address->address2 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->billing_address->postcode }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->billing_address->city }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->billing_address->phone }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection