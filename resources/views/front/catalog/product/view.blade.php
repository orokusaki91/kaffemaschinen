@extends('front.layouts.app') @section('meta_title') {{ $product->name }} @endsection @section('content')
<!-- Main Content - start -->
<main>
    <section class="container" style="padding-top: 50px;" id="pozadina">
        <ul class="b-crumbs">
            <li>
                <a href="{{ route('home') }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('all.category.view') }}">
                    Catalog
                </a>
            </li>
        </ul>

        <!-- Single Product - start -->
        <div class="prod-wrap">

            <!-- Product Images -->
            <div class="prod-slider-wrap">
                <div class="prod-slider">
                    <ul class="prod-slider-car">
                        @foreach($images as $image)
                        <li>
                            <a data-fancybox-group="product" class="fancy-img" href="{{ $image->path->url }}">
                                    <img src="{{ $image->path->medUrl }}" alt="" class="{{ $image->filters }}">
                                </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="prod-thumbs">
                    <ul class="prod-thumbs-car">
                        @foreach($images as $key => $image)
                        <li>
                            <a data-slide-index="{{ $key }}" href="#">
                                    <img src="{{ $image->path->url }}" alt="" class="{{ $image->filters }}">
                                </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Product Description/Info -->

            
            <div class="prod-cont">
                <h1 class="main-ttl"><span>{{ $product->name }}</span></h1>
            <!--<h4 style="color: #fff;">Artikel Nr. {{ $product->status }}</h4>-->
                @if(!$product->available)
                    <h3 class="available_grid"><span style="color: #666;">{{ __('front.unavailable') }}</span></h3>
                @else
                    <h3 class="available_grid"><span style="color: #666;">{{ __('front.available') }}</span></h3>
                @endif
                
                
                <br>
                <div class="prod-cont-txt">
                    {!! $product->description !!}
                </div>
                
             


                @if ($product->has_packaging == true)
                <div class="prod-info">
                    {{ __('front.packaging', ['num' => $product->packaging]) }}
                </div>
                @endif
                @if ($product->contact_only == 1)
                <a class="prod-add" href="{{ route('contact') }}">
                    {{ __('front.contact-us-button') }}
                </a>
                @else
                    @if(!$product->available)
                    <div class="prod-info text-center" style="font-size: 30px; color: #fff; word-wrap: break-word;">
                        {{ $product->unavailable_text }}
                    </div>
                    @else

                    <div class="prod-info">
                        <p class="prod-price" style="color: #666;">
                            @if($product->discount == 1)
                                <span class="prodlist-i-price">
                                        <b class="single_prduct_price">CHF {{ number_format($product->discount_price, 2) }}</b><br>
                                        <span style="text-decoration:line-through">CHF {{ number_format($product->price,2) }}</span><span class="price-off">-{{ number_format(100-($product->discount_price/$product->price*100), 0) }}%</span><br>
                                </span>
                            @else
                                <b class="single_prduct_price">CHF {{ number_format($product->price,2) }}</b><br>
                                <del></del>
                            @endif
                            exkl. MwSt {{ number_format($product->pdv, 1) }}%
                        </p>

                        <form method="post" class="single_product_form" action="{{ route('cart.add-to-cart') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}" />
                            <input type="hidden" name="type" value="product" />
                            <p class="prod-qnt">
                                <input id="prodQnt" class="prod-qty" name="qty" value="1" type="text" data-max="{{ $product->qty }}">
                                <a id="prodPlus" class="prod-plus"><i class="fa fa-angle-up"></i></a>
                                <a id="prodMinus" class="prod-minus"><i class="fa fa-angle-down"></i></a>
                            </p>
                            <p class="prod-addwrap">
                                <button type="submit" class="prod-add" href="{{ route('cart.add-to-cart', $product->id) }}">
                                    In den Warenkorb
                                </button>
                            </p>
                        </form>
                    </div>
                    @endif @endif {{--

                    <div class="row">--}} {{--
                        <div class="col-xs-6" id="prodart"><a class="qview-btn prod-i-qview" data-toggle="modal" data-target="#exampleModal" style="color: dodgerblue; cursor: pointer"><span>Frage Zum Artikel</span></a></div>--}} {{--
                        <div class="col-xs-6" id="prodart"><a href="mailto:?Subject=Kaffemaschinen&amp;Body={{ Request::url() }}" style="color: dodgerblue; cursor: pointer">Artikel weiterempfehlen</a></div>--}} {{--
                    </div>--}}
                    <!-- Share Links -->

                    <div class="post-share-wrap">
                        <ul class="post-share">
                            <li>
                                <a href="http://www.facebook.com/sharer.php?u={{ Request::url() }}" target="_blank" title="Share on Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                            </li>
                            <li>
                                <a href="http://www.instagram.com/shareArticle?mini=true&amp;url={{ Request::url() }}" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
            </div>



        </div>
        <!-- Single Product - end -->

        <!-- Modal -->
        <div class="modal fade frage_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" style="border-radius: 0;">
                    <div class="modal-header frage_modal_header">
                        <h5 class="modal-title fat" id="exampleModalLabel"><span>Frage Zum Artikel</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </button>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('product.mail') }}">
                            <div class="auth-col" style="width: auto;">
                                {{ csrf_field() }}
                                <p>
                                    <input class="frage_modal_input" placeholder="Name" name="name" type="text" id="firstname">
                                </p>

                                <p>
                                    <input class="frage_modal_input" placeholder="Email" name="email" type="email" id="email">
                                </p>

                                <p>
                                    <textarea class="frage_modal_textarea" placeholder="Ihre Frage" name="mess"></textarea>
                                </p>

                                <input type="hidden" name="url" value="{{ Request::url() }}">

                                <p class="auth-submit frage_auth_submit">
                                    <input id="sende" type="submit" value="Senden">
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- top angebote-->
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
                <div class="modal-dialog modal-lg index_popup_dialog">
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
                        <p class="f-left">Angebot gültig bis - {{ $popup->end_date->format('d/m/Y') }}</p>
                        <form class="f-right" action="{{ route('cart.add-to-cart') }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{ $popup->package->id }}"/>
                            <input type="hidden" name="type" value="package"/>

                            <button type="submit" class="popup_cart_add">In den warenkorb</button>
                        </form>

                        <p class="prod-i-price f-right" style="margin-right: 15px; display: inline-block; text-align: center;">
                            <del>CHF {{ number_format($popup->package->total_price, 2) }}</del>

                            <span style="color: red">{{ $popup->package->percentage_sign }}{{ $popup->package->percentage }}%</span><br>
                            <span style="font-size:20px; color: red;">CHF {{ number_format($popup->package->price, 2) }}</span>
                        </p>
                        <div class="total_price f-right" style="display: inline-block; margin-right: 15px; ">
                            <h1 style="line-height:42px; font-size: 25px; text-transform: uppercase">Total:</h1>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            endif;
            ?>

        @endif

    </section>
</main>
<!-- Main Content - end -->

@endsection @section('scripts')
<script>
    $('.prod-qty').on('change', function() {
        var $this = $(this);
        var $qnt = $('.prod-qty', $this.parent());
        var value = parseInt($qnt.val());
        if (value < 1){
            value = 1;
        }
        $qnt.val(value);
    });

    $('.prod-plus').click(function() {
        var $this = $(this);
        var $qnt = $('.prod-qty', $this.parent());
        var value = parseInt($qnt.val());
        if (value < 1){
            value = 1;
        } else {
            value += 1;
        }
        $qnt.val(value);
    });
    $('.prod-minus').click(function() {
        var $this = $(this);
        var $qnt = $('.prod-qty', $this.parent());
        var value = parseInt($qnt.val());
        if (value > 1) {
            value -= 1;
        } else {
            value = 1;
        }
        $qnt.val(value);
    });
</script>
@endsection