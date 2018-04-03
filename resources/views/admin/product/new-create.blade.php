@php($page_name = 'Artikel')
@extends('admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="h1">{{ __("lang.product.create.text") }}</div>
        </div>
    </div>
    <form
            id="product-save-form"
            action="{{ route('admin.product.store') }}"
            method="post"
            enctype="multipart/form-data">

        {{ csrf_field() }}

        @include("admin.forms.text",['name'=> 'name','label' => __('lang.name')])



        <div class="form-group">
            <button type="submit" class="btn-schoen">{{ __('lang.create') . ' & ' . __('lang.continue') }}</button>
            <button type="button"
                    onclick="location='{{ route('admin.product.index') }}'"

                    class="btn">{{ __('lang.cancel') }}
            </button>
        </div>
    </form>
@endsection