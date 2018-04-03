<?php $nav_upload_image = 'active'; ?>

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
                        <h3 class="fat"><span>{{ __('front.account-set-profile-picture') }}</span></h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <form action="{{ route('my-account.upload-image.post') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <p class="contactform-field contactform-textarea">
                                    <input type="file" name="profile_image" id="upload_image" class="wir-input">
                                </p>

                                <p class="contactform-submit">
                                    <input type="submit" value="{{ __('front.account-upload') }}">
                                </p>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection