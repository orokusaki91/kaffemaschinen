<?php $menu_home = 'active'; ?>

@extends('front.layouts.app')

@section('meta_title','Home Page')
@section('meta_description','Home Page')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css">
@stop

@section('content')
<!-- Main Content - start -->
<main>
    <section class="container" id="pozadina" style="margin-top: 50px;">
        <!-- Slider -->
        @php
        @endphp
        <div class="fr-slider-wrap">
            <div class="fr-slider">
                <ul class="slides">
                    @foreach($sliders as $slider)
                        <li>
                            <img src="{{ $slider->image }}" alt="">
                            <div class="fr-slider-cont">
                                <h3 style="color: {{ $slider->color }}">{{ $slider->heading }}</h3>
                                <div style="color: {{ $slider->color }}">
                                    {!! $slider->body !!}
                                </div>
                                @if(!is_null($slider->url))
                                <p class="fr-slider-more-wrap">
                                    <a class="fr-slider-more" href="{{ $slider->url }}" style="background-color: {{ $slider->color }}; color: {{ getForegroundColor($slider->color) }};">{{ $slider->button }}</a>
                                </p>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Catalog Sidebar - start -->
        <h1 class="main-ttl"><span>Produkte</span></h1>
        
    
            <!-- Catalog Categories - end -->
        <div class="section-cont">
            <!-- Catalog Topbar - start -->
            <div class="section-top">
                <!-- View Mode -->
                <ul class="section-mode">
                    <li class="section-mode-gallery {{ $mode == 'grid' ? 'active' : '' }}">
                        <a title="Gallery" href="{{ urldecode(route('home', array_merge(request()->query(), ['mode' => 'grid']), false)) }}"></a>
                    </li>
                    <li class="section-mode-list {{ $mode == 'list' ? 'active' : '' }}">
                        <a title="List" href="{{ urldecode(route('home', array_merge(request()->query(), ['mode' => 'list']), false)) }}"></a>
                    </li>
                </ul>
                <!-- Sorting -->
                <div class="section-sortby">
                    <p>{{ request()->input('order_by') ? __('front.' . request()->input('order_by')) : 'sortierung' }}</p>
                    <ul>
                        @foreach(getOrderBy() as $key => $value)
                            <li>
                                <a href="{{ urldecode(route('home', array_merge(request()->query(), ['order_by' => $key]), false)) }}">{{ $value }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Count per page -->
                <div class="section-count">
                    <p>{{ request()->input('view') ? request()->input('view') : 12 }}</p>
                    <ul>
                        @foreach(getshowNumbers() as $num)
                            <li>
                                <a href="{{ urldecode(route('home', array_merge(request()->query(), ['view' => $num]), false)) }}">{{ $num }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="section-cont">
            <!-- Catalog Topbar - end -->
            <div class="prod-items section-items">
                @if($mode == 'grid')
                    <div class="prod-items section-items {{ $mode == 'grid' ? 'is-active' : '' }}" id="catalog-gallery">
                        @if(count($hitAndNewProducts) <= 0)
                            <p>Momentan sind keine Produkte vorhanden</p>
                        @else
                            @foreach($hitAndNewProducts as $product)
                                <?php
                                $image = $product->image;
                                $imageType = (isset($imageType)) ? $imageType : "medUrl"
                                ?>
                                @include('front.catalog.product.view.product-card',['imageType' => 'medUrl'])
                            @endforeach
                            <div class="clearfix"></div>
                            {{ $hitAndNewProducts->appends(request()->input())->links('front.pagination.bootstrap-4') }}
                        @endif
                    </div>
                @elseif($mode == 'list')
                    <div class="prod-items section-items {{ $mode == 'list' ? 'is-active' : '' }}" id="catalog-list">
                        @foreach($hitAndNewProducts as $product)
                            <?php
                            $image = $product->image;
                            $imageType = (isset($imageType)) ? $imageType : "medUrl"
                            ?>
                            @include('front.catalog.product.view.product-card-list',['imageType' => 'medUrl'])
                        @endforeach
                        <div class="clearfix"></div>
                        {{ $hitAndNewProducts->appends(request()->input())->links('front.pagination.bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection

@section('popup')
    <?php

    if(session()->has('check')){

    }else {
        ?>
    @if ($popup != null)
        <?php
            if (strtotime($popup->end_date) < strtotime('now')) {
                $popup->active = 0;
                $popup->update();
                //shutdowns pop-up

//                unset($_COOKIE['popup_'.$popup->id]);
//                setcookie('popup_'.$popup->id, null, -1, '/');
            } elseif($popup->active == 1) {
                ?>
            <div class="modal fade index_popup" id="myModal">
            <div class="modal-dialog modal-md index_popup_dialog">
                <div class="modal-header index_popup_header">
                    <a class="close modal_close" data-dismiss="modal">×</a>
                    <h3 class="main-ttl-popup" style="margin-bottom:0;">
                        <span>{{ $popup->title }}</span>
                    </h3>
                </div>
                <div class="modal-body index_popup_body">
                    <div class="popup_desc">{!! $popup->package->description !!}</div>
                    <div class="popup_cover" style="background-image: url('{{ asset($popup->image) }}');">
                        <div class="popup_cover_container">
                            <div class="owl-carousel owl-theme">
                                <?php
                                $count = count($popup->package->products);
                                $i = 0;
                                ?>
                                @foreach ($popup->package->products as $product)
                                    <?php $i++; ?>
                                    <div class="item {{ $i == $count ? '' : 'plus_item' }}">
                                        <a href="{{ route('product.view', $product->slug) }}">
                                                    <span class="carousel_img" style="background-image: url('{{ asset($product->image->medUrl) }}')">
                                                        <span class="carousel_price">CHF {{ number_format($product->price, 2) }}</span>
                                                    </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                      <p class="popup_date">Angebot gültig bis - {{ $popup->end_date->format('d/m/Y') }}</p>
                   <div class="container-fluid">
                       <div class="row">

                            
                            
                    <div class="col-md-6 col-sm-6 price_popup">
                        <div class="total_price" style="display: inline-block; margin-right: 15px; ">
                            <h1 style="line-height:42px; font-size: 25px; text-transform: uppercase">Total:</h1>
                        </div>
                   
                        <p class="prod-i-price" style="margin-right: 15px; display: inline-block; text-align: center; font-size:12px">
                            <del>CHF {{ number_format($popup->package->total_price, 2) }}</del>

                            <span style="color: red">{{ $popup->package->percentage_sign }}{{ $popup->package->percentage }}%</span><br>
                            <span style="font-size:20px; color: red;">CHF {{ number_format($popup->package->price, 2) }}</span>
                        </p>
                           
                           
                           
                    </div>
                            
                    <div class="col-md-6 col-sm-6 button_war_popup">
                                <form class="" action="{{ route('cart.add-to-cart') }}" method="POST">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{ $popup->package->id }}"/>
                                    <input type="hidden" name="type" value="package"/>

                                    <button type="submit" class="popup_cart_add">In den warenkorb</button>
                                </form>
                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
            session(['check' => '1']);
                }

//            $popupCookie = true;
//            if (isset($_COOKIE['popup_'.$popup->id])) {
//                if ($_COOKIE['popup_'.$popup->id] == 'seen') {
//                    $popupCookie = false;
//                }
//            }
        ?>

    @endif
    <?php
    }
    ?>
    <!--TOP ANGEBOTE-->
    @if ($popup != null)
        <?php
        if (strtotime($popup->end_date) < strtotime('now')):

            $popup->active = 0;
            $popup->update();
            //shutdowns pop-up

//                unset($_COOKIE['popup_'.$popup->id]);
//                setcookie('popup_'.$popup->id, null, -1, '/');
        elseif($popup->active == 1):
        ?>
            <div class="modal fade index_popup" id="modal_button">
        <div class="modal-dialog modal-md index_popup_dialog">
            <div class="modal-header index_popup_header">
                <a class="close modal_close" data-dismiss="modal">×</a>
                <h3 class="main-ttl-popup" style="margin-bottom:0;">
                    <span>{{ $popup->title }}</span>
                </h3>
            </div>
            <div class="modal-body index_popup_body">
                <div class="popup_desc">{!! $popup->package->description !!}</div>
                <div class="popup_cover" style="background-image: url('{{ asset($popup->image) }}');">
                    <div class="popup_cover_container">
                        <div class="owl-carousel owl-theme">
                            <?php
                            $count = count($popup->package->products);
                            $i = 0;
                            ?>
                            @foreach ($popup->package->products as $product)
                                <?php $i++; ?>
                                <div class="item {{ $i == $count ? '' : 'plus_item' }}">
                                    <a href="{{ route('product.view', $product->slug) }}">
                                                    <span class="carousel_img" style="background-image: url('{{ asset($product->image->medUrl) }}')">
                                                        <span class="carousel_price">CHF {{ number_format($product->price, 2) }}</span>
                                                    </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                  
                  <p class="popup_date">Angebot gültig bis - {{ $popup->end_date->format('d/m/Y') }}</p>
                   <div class="container-fluid">
                       <div class="row">

                            
                            
                    <div class="col-md-6 col-sm-6 price_popup">
                        <div class="total_price" style="display: inline-block; margin-right: 15px; ">
                            <h1 style="line-height:42px; font-size: 25px; text-transform: uppercase">Total:</h1>
                        </div>
                   
                        <p class="prod-i-price" style="margin-right: 15px; display: inline-block; text-align: center; font-size:12px">
                            <del>CHF {{ number_format($popup->package->total_price, 2) }}</del>

                            <span style="color: red">{{ $popup->package->percentage_sign }}{{ $popup->package->percentage }}%</span><br>
                            <span style="font-size:20px; color: red;">CHF {{ number_format($popup->package->price, 2) }}</span>
                        </p>
                           
                           
                           
                    </div>
                            
                    <div class="col-md-6 col-sm-6 button_war_popup">
                                <form class="" action="{{ route('cart.add-to-cart') }}" method="POST">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{ $popup->package->id }}"/>
                                    <input type="hidden" name="type" value="package"/>

                                    <button type="submit" class="popup_cart_add">In den warenkorb</button>
                                </form>
                    </div>

                        </div>
                    </div>
                </div>

        </div>
    </div>
        <?php
        endif;
        ?>

    @endif
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>

@if(Session::has('order_made'))
<script>
    swal({
        title: '{{ __('front.all_done') }}',
        confirmButtonText: 'OK',
        type: 'success',
        text: '{{ Session::get('order_made') }}'
    });
</script>
@endif

@if(Session::has('error'))
<script>
    swal({
        title: 'Fehler!',
        confirmButtonText: 'OK',
        type: 'error',
        text: '{{ Session::get('error') }}'
    });
</script>
@endif

@if(Session::has('registration_success'))
<script>
    swal({
        title: '{{ __('front.all_done') }}',
        confirmButtonText: 'OK',
        type: 'success',
        text: '{{ Session::get('registration_success') }}'
    });
</script>
@endif

@endsection