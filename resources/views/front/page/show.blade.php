@extends('front.layouts.app')

@section('meta_title')
    {{ $page->title }}
@endsection

@section('content')
<main>
    <div class="container" style="padding: 55px 0;">
        <div class="row">
            <div class="col-12">
                <h1 style="color: #fff;">{{ $page->title }}</h1>

                <p style="color: #fff;">{!!  $page->content !!}</p>
            </div>
        </div>
    </div>
</main>
@endsection
