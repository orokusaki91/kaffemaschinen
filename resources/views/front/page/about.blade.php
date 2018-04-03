<?php $menu_about_us = 'active'; ?>

@extends('front.layouts.app')

@section('meta_title')
    {{ $page->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $page->title }}</h1>

                <main>
                    <section class="container">


                        <ul class="b-crumbs">
                            <li>
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about-us') }}">
                                    Über uns
                                </a>
                            </li>

                        </ul>
                        <h1 class="main-ttl"><span>Über uns</span></h1>
                        <!-- Blog Post - start -->
                        <div class="post-wrap stylization">
                            <!-- Slider -->
                            <div class="flexslider post-slider" id="post-slider-car">
                                <ul class="slides">
                                    @foreach($banners as $banner)
                                    <li>
                                        <a data-fancybox-group="fancy-img" class="fancy-img" href="{{ $banner->value }}"><img src="{{ $banner->value }}" alt=""></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <p>
                            {{ $text->value }}
                        </p>

                        <!-- Share Links -->
                        <div class="post-share-wrap">
                            <ul class="post-share">
                                <li>
                                    <a onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=http://allstore-html.real-web.pro','sharer', 'toolbar=0,status=0,width=620,height=280');" data-toggle="tooltip" title="Share on Facebook" href="javascript:">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tooltip" title="Share on Instagram" onclick="popUp=window.open('https://www.instagram.com/kaffemaschinen.ch');popUp.focus();return false;" href="javascript:;">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Blog Post - end -->
                    </section>
                </main>
            </div>
        </div>
    </div>
@endsection
