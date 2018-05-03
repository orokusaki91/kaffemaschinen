@php($page_name = 'Angebot')
@extends('admin.layouts.app')


@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 text-center">
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h1">Angebot bearbeiten</div>
                    </div>
                </div>
                <form
                        id="package-save-form"
                        action="{{ route('admin.package.update', $model->id) }}"
                        method="post"
                        enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            @include("admin.forms.text",['value' => $model->name, 'name'=> 'name','label' => __('lang.name')])
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            @include('admin.forms.text',['value' => $model->price, 'name' => 'price','label' => __('front.price')])
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
                    <div class="product-list">
                        @foreach ($model->products as $product)
                            <div class="product-item-wrapper">
                                <div class="product-item">
                                    <img src="{{ $product->image->smallUrl }}"/><input type="hidden" name="products[]" class="product-id" value="{{ $product->id }}" />
                                    <button type="button" name="delete-product" class="btn btn-xs btn-default delete-product" onclick="removeProduct(this)"><i class="oi oi-trash text-danger"></i></button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn-schoen" onclick="jQuery('#package-save-form').submit()">
                            Speichern
                        </button>
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