@php($page_name = 'Home')
@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
    <div class="container-fluid" style="padding: 0;">
        <div class="row">
            <div class="col-lg-12 col-lg-offset-0 text-center">
            </div>
        </div>

        <div class="container-fluid" style="padding-left: 5px; padding-right: 5px;">
            <div class="row">
                <div class="col-12">
                    <div class="h1">{{ __('lang.admin-create-new-banner') }}</div>
                </div>
            </div>

            <form id="product-save-form" action="{{ route('admin.home.store') }}" method="post" enctype="multipart/form-data" novalidate>
                {{ csrf_field() }}

                <div class="row" id="product-save-accordion" data-children=".product-card">
                    <div class="col-12 mb-2 mt-2">
                        <div class="card product-card  mb-2 mt-2">
                            <div class="card-header">
                                Banner Details
                            </div>
                            <div class="card-body collapse show" id="basic">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="heading" >{{ __('lang.heading') }}</label>
                                            <input type="text" class="form-control" id="name" name="heading" value="{{ old('heading') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="button" >{{ __('lang.button') }}</label>
                                            <input type="text" class="form-control" id="slug" name="button" value="{{ old('button') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="link" >URL</label>
                                            <input type="url" class="form-control" id="slug" name="url" value="{{ old('url') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="link" >{{ __('lang.color') }}</label>
                                            <input type="color" class="form-control" style="height: 38px" id="slug" name="color" value="{{ old('color') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="body">{{ __('lang.body') }}</label>
                                    <textarea class="ckeditor" id="description" name="body" type="text">{{ old('body') }}</textarea>

                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="image" >{{ __('lang.images') }} <span class="text-muted">(Empfohlener Bildformat: 1140 x 480)</span></label>
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
                        {{ __('lang.admin-create-new-banner') }}
                    </button>
                    <a href="{{ route('admin.page.home') }}" class="btn ">{{ __('lang.cancel') }}</a>
                </div>

            </form>

            </div>
        </div>
    </div>
@stop