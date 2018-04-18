@php($page_name = 'Artikel')
@extends('admin.layouts.app')

@push('styles')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

@section('content')

    <div class="container">
        @if ($errors->any())
            <div class="row justify-content-center text-center">
                <div class="col-lg-6 col-sm-12 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="h1">Produkt bearbeiten</div>
            </div>
        </div>
        <?php
        $productCategories = $model->categories()->get()->pluck('id')->toArray();
        ?>
        <form id="product-save-form"
              action="{{ route('admin.product.update', $model->id) }}"
              enctype="multipart/form-data" method="post"  novalidate>
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">

            <div class="row" id="product-save-accordion" data-children=".product-card">
                <div class="col-12 mb-2 mt-2">
                    <div class="card product-card  mb-2 mt-2">
                        <div class="card-header">
                            {{ __('lang.basic-details') }}
                        </div>
                        <div class="card-body collapse show" id="basic">
                            @include('admin.product.card.basic', ['editMethod' => true])
                        </div>
                    </div>

                    <div class="card product-card mb-2 mt-2">
                        <div class="card-header">
                            {{ __('lang.images') }}
                        </div>
                        <div class="card-body" id="images">
                            @include('admin.product.card.images')
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn-schoen" onclick="jQuery('#product-save-form').submit()">
                    {{ __('lang.product-edit-product') }}
                </button>
                <button type="button" class="btn" onclick="location='{{ route('admin.product.index') }}'">
                    {{ __('lang.cancel') }}
                </button>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function () {
            $("input[name=contact_only_toggle]").on('change', function () {
                if ($('#contact_only').val() == 1) {
                    $('#contact_only').val(0);
                } else {
                    $('#contact_only').val(1);
                }
            });
            $("input[name=has_packaging_toggle]").on('change', function () {
                if ($('#has_packaging').val() == 1) {
                    $('#has_packaging').val(0);
                } else {
                    $('#has_packaging').val(1);
                }
            });
            $("input[name=new_product_toggle]").on('change', function () {
                if ($('#new_product').val() == 1) {
                    $('#new_product').val(0);
                } else {
                    $('#new_product').val(1);
                }
            });
            $("input[name=hit_product_toggle]").on('change', function () {
                if ($('#hit_product').val() == 1) {
                    $('#hit_product').val(0);
                } else {
                    $('#hit_product').val(1);
                }
            });
            $("input[name=available_toggle]").on('change', function () {
                if ($('#available').val() == 1) {
                    $('#available').val(0);
                    $('#unavailable_text').attr('disabled', '').removeAttr('required');
                } else {
                    $('#available').val(1);
                    $('#unavailable_text').removeAttr('disabled').attr('required', '');
                }
            });
            @if(session()->has('slug'))
                $.notify({
                // options
                message: '{{ session('slug') }}'
            },{
                // settings
                type: 'danger'
            });
            @endif

        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                var form = document.getElementById('product-save-form');
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();
    </script>
@endpush