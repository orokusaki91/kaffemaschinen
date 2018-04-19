<div class="prod-i">
    <div class="prod-i-top">
        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->name }}" class="prod-i-img">
            @include('front.catalog.product.view.product-image',['product' => $product])
        </a>
        <div class="prod-sticker">
            @if($product->hit_product == 1)
                <div class="item-hit-badge"><i class="fa fa-star"></i> hit</div>
            @endif
            @if($product->new_product == 1)
                <div class="item-new-badge">new</div>
            @endif

        </div>
    </div>
    <h3>
        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->name }}">{{ $product->name }}</a>
    </h3>
    
    @if ($product->contact_only == 1)
       <p class="prodlist-i-addwrap prodlist-i-addwrap_gastro">
            <a class="prod-add add_to_cart_gastro" href="{{ route('contact') }}">
            {{ __('front.contact-us-button') }}
            </a>
        </p>
    @else
    @if(!$product->available)

            <h3 class="available_grid"><span style="color:red !important;" >{{ __('front.unavailable') }}</span></h3>

            <p class="prod-i-price">
            <b>{{ strlen($product->unavailable_text) > 20 ? substr($product->unavailable_text, 0, 20) . "..." : $product->unavailable_text }}</b>
        </p>
    @else

       <h3 class="available_grid"><span style="color:green;" >{{ __('front.available') }}</span></h3>
        @if($product->discount == 1)
            <p class="prod-i-price">
                <b>CHF {{ number_format($product->discount_price, 2) }}</b><br>
                <del>CHF {{ number_format($product->price,2) }}</del>
                @if($product->discount == 1)
                    <span class="price-off">-{{ number_format(100-($product->discount_price/$product->price*100), 0) }}%</span>
                @endif
                <form method="post" action="{{ route('cart.add-to-cart') }}" style="text-align:center;">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                    <input type="hidden" name="type" value="product"/>
                <p class="prodlist-i-addwrap">
                    <button type="submit" class="prodlist-i-add">In den Warenkorb</button>
                </p>
                </form>
            </p>
        @else
            <p class="prod-i-price">
                <b>CHF {{ number_format($product->price,2) }}</b>
                @if($product->discount == 1)
                    <span class="price-off">-{{ number_format(100-($product->discount_price/$product->price*100), 0) }}%</span>
                @endif
            <form method="post" action="{{ route('cart.add-to-cart') }}" style="text-align:center;">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}"/>
                <input type="hidden" name="type" value="product"/>
                <p class="prodlist-i-addwrap">
                    <button type="submit" class="prodlist-i-add">In den Warenkorb</button>
                </p>
            </form>
            </p>
        @endif
    @endif
        @endif
</div>

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush