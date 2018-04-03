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
                        <h3 class="main-ttl">
                            <span>Meine Bestellungen</span>

                        </h3>
                        <div class="row space">
                            <div class="auth-wrap">
                                @if(count($orders) == 0)
                                    <p>Keine Bestellungen vorhanden</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table myacc_table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>{{ __('lang.date') }}</th>
<!--                                                <th>{{ __('lang.order-status') }}</th>-->
                                                <th>{{ __('lang.order-shipping-option') }}</th>
                                                <th>{{ __('lang.view') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>

                                                    <td> {{ $order->id }}</td>
                                                    <td> {{ $order->created_at }} </td>
                                                    {{--<td> {{ $order->payment_option }}</td>--}}
                                                    <td> {{ $order->order_status_title == 'Verkauft' ? 'Gekauft' : $order->order_status_title }} </td>
                                                    <td><a href="{{ route('my-account.order.view', $order->id) }}" style="color: cornflowerblue">Ansicht</a></td>
                                                </tr>
                                            @endforeach
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
    </main>
@endsection