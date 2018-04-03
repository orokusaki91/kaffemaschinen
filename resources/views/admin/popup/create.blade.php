@php($page_name = 'Popup')
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
                        <div class="h1">{{ __('lang.admin-create-new-popup') }}</div>
                    </div>
                </div>

                <form id="popup-save-form" action="{{ route('admin.popup.store') }}" method="post" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}

                    <div class="row" id="product-save-accordion" data-children=".product-card">
                        <div class="col-12 mb-2 mt-2">
                            <div class="card product-card  mb-2 mt-2">
                                <div class="card-header">
                                    Popup Details
                                </div>
                                <div class="card-body collapse show" id="basic">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="title" >{{ __('lang.title') }}</label>
                                                <input type="text" class="form-control" id="name" name="title" value="{{ old('title') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="end_date" >{{ __('lang.end-date') }}</label>
                                                <input type="date" class="form-control" id="slug" name="end_date" value="{{ old('end_date') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="package_id" >{{ __('lang.package') }}</label>
                                                <select name="package_id" class="form-control" required>
                                                    @foreach ($packages as $package)
                                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="active">{{ __('lang.popup-active') }}</label>
                                                <div class="checkbox">
                                                    <label style="margin-left: 20px;">
                                                        <input id="active_toggle" name="active_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('front.yes') }}" data-off="{{ __('front.no') }}" checked>
                                                        <input hidden id="active" type="number" name="active" value="1" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                            {{ __('lang.admin-create-new-popup') }}
                        </button>
                        <a href="{{ route('admin.popup.index') }}" class="btn ">{{ __('lang.cancel') }}</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function () {
            $("input[name=active_toggle]").on('change', function () {
                if ($('#active').val() == 1) {
                    $('#active').val(0);
                } else {
                    $('#active').val(1);
                }
            });
        });
    </script>
@endpush