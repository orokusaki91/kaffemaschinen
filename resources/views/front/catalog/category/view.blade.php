@extends('front.layouts.app')

@section('nav_active_category', $category->slug)
@section('meta_title')
{{ $category->name }}
@endsection

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
            <li>
                <span>{{ $category->name }}</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Kategorie</span></h1>
        <!-- Catalog Sidebar - start -->
     
        <div class="section-cont">

            <!-- Catalog Topbar - start -->
            <div class="section-top">

                <!-- View Mode -->
                <ul class="section-mode">
                    <li class="section-mode-gallery {{ $mode == 'grid' ? 'active' : '' }}">
                        <a title="View mode: Gallery" href="{{ urldecode(route('all.category.view', array_merge(request()->query(), ['mode' => 'grid']), false)) }}"></a>
                    </li>
                    <li class="section-mode-list {{ $mode == 'list' ? 'active' : '' }}">
                        <a title="View mode: List" href="{{ urldecode(route('all.category.view', array_merge(request()->query(), ['mode' => 'list']), false)) }}"></a>
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
            <!-- Catalog Topbar - end -->
            <div class="product-items">
                <div class="prod-items section-items {{ $mode == 'grid' ? 'is-active' : '' }}" id="catalog-gallery">
                    @if(count($products) <= 0)
                    <p>Momentan sind keine Produkte vorhanden</p>
                    @else
                    @foreach($products as $product)
                    @include('front.catalog.product.view.product-card',['imageType' => 'medUrl'])
                    @endforeach
                    <div class="clearfix"></div>
                    {{ $products->appends(request()->input())->links('front.pagination.bootstrap-4') }}
                    @endif
                </div>
                <div class="prod-items section-items {{ $mode == 'list' ? 'is-active' : '' }}" id="catalog-list">
                    @foreach($products as $product)
                    <?php
                    $image = $product->image;
                    $imageType = (isset($imageType)) ? $imageType : "medUrl"
                    ?>
                    <div class="prodlist-i">
                        <a href="{{ route('product.view', $product->slug)}}" class="prod-i-img">
                            <img src="{{ $image->$imageType }}">
                        </a>
                        <div class="prodlist-i-cont">
                            <h3>
                                <a href="{{ route('product.view', $product->slug)}}">Adipisci aperiam commodi</a>
                            </h3>
                            <div class="prodlist-i-txt">
                            Quisquam totam quas veritatis dolor voluptates, laudantium repellendus. Cupiditate repellat tempora consequatur sequi, neque</div>
                            <div class="prodlist-i-action">
                                <form method="post" action="{{ route('cart.add-to-cart') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="slug" value="{{ $product->slug }}"/>
                                    <p class="prodlist-i-qnt">
                                        <input id="prodQnt" name="qty" value="1" type="text">
                                        <a href="#" class="prodlist-i-plus"><i class="fa fa-angle-up"></i></a>
                                        <a href="#" class="prodlist-i-minus"><i class="fa fa-angle-down"></i></a>
                                    </p>
                                    <p class="prodlist-i-addwrap">
                                        <button type="submit" class="prodlist-i-add">In den Warenkorb</button>
                                    </p>
                                    @if($product->discount == 1)
                                    <span class="prodlist-i-price">
                                        <b>CHF {{ number_format($product->discount_price, 2) }}</b><br>
                                        <del>CHF {{ number_format($product->price,2) }}</del>
                                    </span>
                                    @else
                                    <span class="prodlist-i-price">
                                        <b>CHF {{ number_format($product->price,2) }}</b><br>
                                        <del></del>
                                    </span>
                                    @endif
                                </form>
                            </div>
                            <p class="prodlist-i-info">
                                <a href="product.html" class="qview-btn prodlist-i-qview"><i class="fa fa-search"></i> Siehe Details</a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix"></div>
                    {{ $products->appends(request()->input())->links('front.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
{{-- <script>
    var sectionMode = $('ul.section-mode');
    var sectionList = $('li.section-mode-list');
    var sectionGallery = $('li.section-mode-gallery');
    var catalogList = $('#catalog-list');
    var catalogGallery = $('#catalog-gallery');
    $(function () {
        sectionMode.find('a').on('click', function (e) {
            e.preventDefault();
            var that = $(this);
            var href = that.attr('href');

            if (href == '#catalog-gallery') {
                sectionList.removeClass('active');
                catalogList.removeClass('is-active');
                sectionGallery.addClass('active');
                catalogGallery.addClass('is-active');
            } else {
                sectionGallery.removeClass('active');
                catalogGallery.removeClass('is-active');
                sectionList.addClass('active');
                catalogList.addClass('is-active');
            }
        });
    });
</script> --}}
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