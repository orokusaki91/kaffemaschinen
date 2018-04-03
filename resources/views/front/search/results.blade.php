@extends('front.layouts.app')

@section('meta_title')
    {{ "Search results for " . $queryParam }}
@endsection

@section('content')
    <main>
        <section class="container">
            <div class="section-sb">
                @include('front.catalog.category.options')
            </div>
            <div class="section-cont">
                <h2> Search Results for: {{ $queryParam }}</h2>
                <div class="prod-items section-items">
                    @if(count($products) <= 0)
                        <p>Momentan sind keine Produkte vorhanden</p>
                    @else

                        @foreach($products as $product)
                            @include('front.catalog.product.view.product-card',['product' => $product])
                        @endforeach
                        <div class="clearfix"></div>
                        {!!  $products->links('front.pagination.bootstrap-4') !!}
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
