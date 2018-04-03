<?php $menu_wir = 'active'; ?>

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
                    <section class="container stylization maincont">


                        <ul class="b-crumbs">
                            <li>
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('wir-kaufen') }}">
                                    Wir Kaufen
                                </a>
                            </li>
                        </ul>
                        <h1 class="main-ttl"><span>Wir Kaufen</span></h1>
                        <!-- Contacts - start -->
                        <br>
                        <p class="text-justify">
                            {{ $description->body }}
                        </p>

                        <!-- Contact Form -->
                        <br>
                        <div class="contactform-wrap">
                            <form action="{{ route('wir-kaufen.mail') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h3 class="component-ttl component-ttl-ct component-ttl-hasdesc"><span>Kontaktformular</span></h3>
                                <p class="component-desc component-desc-ct">Unvollstandige Anfragen werden nicht beantwortet.</p>
                                <p class="contactform-field contactform-text">
                                    {{--<label class="contactform-label">Name</label>--}}
                                    <span class="contactform-input"><input placeholder="Name" type="text" name="name" id="name" value="{{ old('name') }}" data-required="text" required></span>
                                </p>
                                <p class="contactform-field contactform-tel">
                                    {{--<label class="contactform-label">Telefon</label>--}}
                                    <span class="contactform-input"><input placeholder="Ihre Telefon" type="text" name="tel" id="tel" value="{{ old('tel') }}" data-required="text" required></span>
                                </p>
                                <p class="contactform-field contactform-email">
                                    {{--<label class="contactform-label">Email</label>--}}
                                    <span class="contactform-input"><input placeholder="Ihre Email" type="text" name="email" id="email" value="{{ old('email') }}" data-required="text" data-required-email="email" required></span>
                                </p>
                                <p class="contactform-field contactform-textarea">
                                    {{--<label class="contactform-label">Meine Frage</label>--}}
                                    <span class="contactform-input"><textarea placeholder="Ihre Nachricht" name="mess" id="mess" data-required="text" required>{{ old('mess') }}</textarea></span>
                                </p>
                                <p class="contactform-field contactform-textarea">
                                    <input class="wir-input" type="file" name= "image[]" multiple required>
                                </p>

                                <p class="contactform-submit">
                                    <input type="submit" value="Senden">
                                </p>
                            </form>
                        </div>
                        <br>
                        <br>
                        <!-- Contacts - end -->

                        <div class="iconbox-wrap">
                            <div class="row iconbox-list">
                                <div class="cf-xs-6 cf-sm-4 cf-lg-4 col-xs-6 col-sm-4 iconbox-i">
                                    <p class="iconbox-i-img"><i class="fa fa-phone" aria-hidden="true" style="font-size:60px;"></i></p>
                                    <h3 class="iconbox-i-ttl">+41 44 450 21 02</h3>
                                    <span class="contact-text">
                                        Rufen Sie uns an
                                    </span>
                                    <span class="iconbox-i-margin"></span>
                                </div>
                                <div class="cf-xs-6 cf-sm-4 cf-lg-4 col-xs-6 col-sm-4 iconbox-i">
                                    <p class="iconbox-i-img"><i class="fa fa-map-marker" aria-hidden="true" style="font-size:60px;"></i></p>
                                    <h3 class="iconbox-i-ttl">Adresse</h3>
                                    <span class="contact-text">
                                        Brock GmbH<br>
                                        Birmensdorferstr. 430<br>
                                        8055 Zurich
                                    </span>
                                    <span class="iconbox-i-margin"></span>
                                </div>
                                <div class="cf-xs-6 cf-sm-4 cf-lg-4 col-xs-6 col-sm-4 iconbox-i">
                                    <p class="iconbox-i-img"><i class="fa fa-clock-o" aria-hidden="true" style="font-size:60px;"></i></p>
                                    <h3 class="iconbox-i-ttl">Öffnungszeiten</h3>
                                    <span class="contact-text">
                                        Montag - Freitag 13:00 - 18:00
                                    </span>
                                    <span class="iconbox-i-margin"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Contacts Info - end -->
                        <div class="social-wrap">
                            <div class="social-list">
                                <div class="social-i">
                                    <a rel="nofollow" target="_blank" href="https://de-de.facebook.com/centrocaffe.ch/">
                                        <p class="social-i-img">
                                            <i class="fa fa-facebook"></i>
                                        </p>
                                        <p class="social-i-ttl">Facebook</p>
                                    </a>
                                </div>

                                <div class="social-i">
                                    <a rel="nofollow" target="_blank" href="https://www.instagram.com/centrocaffe.ch/">
                                        <p class="social-i-img">
                                            <i class="fa fa-instagram"></i>
                                        </p>
                                        <p class="social-i-ttl">Instagram</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </section>
                </main>
            </div>
        </div>
    </div>
@endsection