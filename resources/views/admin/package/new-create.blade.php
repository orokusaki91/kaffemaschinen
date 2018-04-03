@php($page_name = 'Angebot')
@extends('admin.layouts.app')


@section('content')
    <div class="main-content p-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 text-center">
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h1">{{ __("lang.package.create.text") }}</div>
                    </div>
                </div>
                <form
                        id="package-save-form"
                        action="{{ route('admin.package.store') }}"
                        method="post"
                        enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            @include("admin.forms.text",['name'=> 'name','label' => __('lang.name')])
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            @include('admin.forms.text',['name' => 'price','label' => __('front.price')])
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            @include('admin.forms.select',['name' => 'pdv', 'label' => __('lang.pdv'), 'options' => ['2.5' => '2.5%', '7.7' => '7.7%']])
                        </div>
                    </div>

                    @include('admin.forms.textarea',['name' => 'description','label' => __('lang.description'),
                                                                'attributes' => ['class' => 'ckeditor','id' => 'description']])



                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            @include('admin.forms.autocomplete',['placeholder' => __('front.product-search-products'), 'name' => 'product-search', 'label' => __('front.product'), 'class' => 'autocomplete-input'])
                        </div>
                    </div>

                    <script>
                        function removeProduct(self) {
                            var productElement = $(self).parent().parent();
                            productElement.remove();
                        }
                    </script>
                    <div class="product-list"></div>

                    <div class="form-group">
                        <button type="submit" class="btn-schoen">{{ __('lang.create') }}</button>
                        <button type="button"
                                onclick="location='{{ route('admin.package.index') }}'"
                                class="btn">{{ __('lang.cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .product-list {
            width: 100%;
            overflow: hidden;
        }

        .product-list > .product-item-wrapper {
            width: calc(100% / 2);
            float: left;
            padding-right: 8px;
            padding-bottom: 8px;
        }

        @media screen (min-width: 992) {
        .product-list > .product-item-wrapper {
            width: calc(100% / 6);
            }
        }

        .product-list > .product-item-wrapper > .product-item {
            padding: 4px;
            border: 1px solid #D9D9D9;
            border-radius: .25rem;
            text-align: center;
        }

        .product-list > .product-item-wrapper > .product-item > img {
            width: 100%;
        }

        .product-list > .product-item-wrapper > .product-item > button {
            margin-top: 8px;
        }
    </style>
@endpush