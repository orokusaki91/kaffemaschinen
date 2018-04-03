
@extends('front.layouts.app')

@if(!isset($search))
    @if($category)
    @section('nav_active_category', $category->topParent()->slug)
    @section('meta_title')
        {{ $category->name }}
    @endsection
    @endif
@endif
@section('content')
<main>
    <section class="container">

        <ul class="b-crumbs">
            <li>
                <a href="{{ route('home') }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('all.category.view') }}">
                    Shop
                </a>
            </li>
            @if(!isset($search))
                @if($category)
            <li>
                <span>{{ $category->name }}</span>
            </li>
            @endif
            @endif
        </ul>

        <h1 class="main-ttl"><span>Kategorie</span></h1>


        <!-- Catalog Sidebar - start -->
        <div class="section-sb">
            @include('front.catalog.category.options')
        </div>
        <div class="section-cont">
            <!-- Catalog Topbar - start -->
            <div class="section-top">
                <!-- View Mode -->
                <ul class="section-mode">
                    <li class="section-mode-gallery {{ $mode == 'grid' ? 'active' : '' }}">
                        <a title="Gallery" href="{{ urldecode(route('all.category.view', array_merge(request()->query(), ['mode' => 'grid']), false)) }}"></a>
                    </li>
                    <li class="section-mode-list {{ $mode == 'list' ? 'active' : '' }}">
                        <a title="List" href="{{ urldecode(route('all.category.view', array_merge(request()->query(), ['mode' => 'list']), false)) }}"></a>
                    </li>
                </ul>
                <!-- Sorting -->
                <div class="section-sortby">
                    <p>{{ old('order_by') ? __('front.' . old('order_by')) : 'sortierung' }}</p>
                    <ul>
                        @foreach(getOrderBy() as $key => $value)
                        <li>
                            <a href="{{ urldecode(route('all.category.view', array_merge(request()->query(), ['order_by' => $key]), false)) }}">{{ $value }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Count per page -->
                <div class="section-count">
                    <p>{{ old('view') ? old('view') : 12 }}</p>
                    <ul>
                        @foreach(getshowNumbers() as $num)
                        <li>
                            <a href="{{ urldecode(route('all.category.view', array_merge(request()->query(), ['view' => $num]), false)) }}">{{ $num }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="product-items">
                @if($mode == 'grid')
                <div class="prod-items section-items {{ $mode == 'grid' ? 'is-active' : '' }}" id="catalog-gallery">
                    @if(count($products) <= 0)
                    <p>Momentan sind keine Produkte vorhanden</p>
                    @else
                    @foreach($products as $product)
                        <?php
                        $image = $product->image;
                        $imageType = (isset($imageType)) ? $imageType : "medUrl"
                        ?>
                        @include('front.catalog.product.view.product-card',['imageType' => 'medUrl'])
                    @endforeach
                    <div class="clearfix"></div>
                    {{ $products->appends(request()->input())->links('front.pagination.bootstrap-4') }}
                    @endif
                </div>
                @elseif($mode == 'list')
                <div class="prod-items section-items {{ $mode == 'list' ? 'is-active' : '' }}" id="catalog-list">
                    @foreach($products as $product)
                    <?php
                    $image = $product->image;
                    $imageType = (isset($imageType)) ? $imageType : "medUrl"
                    ?>
                        @include('front.catalog.product.view.product-card-list',['imageType' => 'medUrl'])
                    @endforeach
                    <div class="clearfix"></div>
                    {{ $products->appends(request()->input())->links('front.pagination.bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    // Range Slider
    var range_slider = $('#range-slider');
    var initialPriceFrom = '{{ old('price_from') }}';
    var initialPriceTo = '{{ old('price_to') }}' != '' ? '{{ old('price_to') }}' : '{{ round($maxPrice) }}';
    range_slider.ionRangeSlider({
        type: "double",
        // grid: range_slider.data('grid'),
        min: 0,
        max: '{{ round($maxPrice) }}',
        from: initialPriceFrom,
        to: initialPriceTo,
        prefix: range_slider.data('prefix'),
        onFinish: function (data) {
            var priceInputsWrapper = $('.price-inputs');
            var $priceFrom = priceInputsWrapper.find('input:first-child').val(data.from);
            var $priceTo = priceInputsWrapper.find('input:last-child').val(data.to);

            var $url = getUrl('/get_price_ranges');

            var requestQueryString = '{{ is_array(request()->query()) && !empty(request()->query()) ? json_encode(request()->query()) : "{}" }}';

            var requestQueryClearedJSON = requestQueryString.replace(/&quot;/gi,"\"")
            .replace(/\[/gi,"")
            .replace(/\]/gi,"");

            var requestQueryObj = JSON.parse(requestQueryClearedJSON);

            delete requestQueryObj.price_to;
            delete requestQueryObj.price_from;

            var requestData = Object.assign({
                price_from: $priceFrom.val(), 
                price_to: $priceTo.val()
            }, requestQueryObj);

            $.ajax({
                data: requestData,
                url: $url,
                dataType: 'json',
                method: 'get',
                success: function (data) {
                    window.location.href = data.url;
                },
                error: function (data) {
                    return true;
                }
            });
        },
    });
</script>
@stop