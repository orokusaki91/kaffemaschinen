<?php $menu_contact = 'active'; ?>

@extends('front.layouts.app')

@section('meta_title')
    {{ $page->name }}
@endsection

@section('scripts')
    <script src="{{ asset('front/assets/js/gmap.js') }}"></script>
@endsection

@section('content')
    <main>
        <section class="container stylization maincont">


            <ul class="b-crumbs">
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">
                        Kontakt
                    </a>
                </li>
            </ul>
            <h1 class="main-ttl"><span>Kontakt</span></h1>
            <br>

            <!-- Contact Form -->
            <div class="contactform-wrap">
                <form method="post" action="{{ route('contact.email') }}">
                    {{ csrf_field() }}
                    <h3 class="component-ttl component-ttl-ct component-ttl-hasdesc"><span>Kontaktformular</span></h3>
                    <p class="component-desc component-desc-ct">Unvollstandige Anfragen werden nicht beantwortet.</p>
                    <p class="contactform-field contactform-text">
                        {{--<label class="contactform-label">Name</label>--}}
                        <span class="contactform-input"><input placeholder="Name" id="name" type="text" name="name" value="{{ old('name') }}" data-required="text" required></span>
                    </p>
                    <p class="contactform-field contactform-tel">
                        {{--<label class="contactform-label">Telefon</label>--}}
                        <span class="contactform-input"><input placeholder="Telefonnummer" id="tel" type="text" name="tel" value="{{ old('tel') }}" data-required="text" required></span>
                    </p>
                    <p class="contactform-field contactform-email">
                        {{--<label class="contactform-label">Email</label>--}}
                        <span class="contactform-input"><input placeholder="Emailadresse" id="email" type="text" name="email" value="{{ old('email') }}" data-required="text" data-required-email="email" required></span>
                    </p>
                    <p class="contactform-field contactform-textarea">
                        {{--<label class="contactform-label">Nachricht</label>--}}
                        <span class="contactform-input"><textarea placeholder="Nachricht" id="mess" name="mess" data-required="text" required>{{ old('mess') }}</textarea></span>
                    </p>

                    <p class="contactform-submit">
                        <input value="Senden" type="submit">
                    </p>
                </form>
            </div>
            <!-- Contacts - end -->

            
        </section>
    </main>
@endsection