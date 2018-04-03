@php($page_name = 'Partner')
@extends('admin.layouts.app')

@push('styles')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

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
                        <div class="h1">{{ __('lang.admin-create-new-partner') }}</div>
                    </div>
                </div>

                <form id="popup-save-form" action="{{ route('admin.partner.store') }}" method="post" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}

                    <div class="row" id="product-save-accordion" data-children=".product-card">
                        <div class="col-12 mb-2 mt-2">
                            <div class="card product-card  mb-2 mt-2">
                                <div class="card-header">
                                    Partner Details
                                </div>
                                <div class="card-body collapse show" id="basic">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="name" >{{ __('lang.company-name') }}</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="website" >{{ __('lang.website') }}</label>
                                                <input type="text" class="form-control" id="slug" name="website" value="{{ old('website') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    @include('admin.forms.textarea',['name' => 'description','label' => __('lang.description'),
                                                                'attributes' => ['class' => 'ckeditor','id' => 'description']])

                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="image" >{{ __('lang.images') }}</label>
                                                <input type="file" class="form-control" id="name" name="image" required>
                                            </div>
                                        </div>
                                    </div>

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
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn-schoen">
                            {{ __('lang.admin-create-new-partner') }}
                        </button>
                        <a href="{{ route('admin.partner.index') }}" class="btn ">{{ __('lang.cancel') }}</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@stop