@extends('admin.layouts.app')
@section('content')
    <div class="main-content p-3" style="margin-left: 200px; ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 text-center">
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="h1">Wir Kaufen Details</div>
                    </div>
                </div>

                <form id="product-save-form" action="{{ route('admin.wir-kaufen.update', $description->id) }}" method="post" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}

                    <div class="row" id="product-save-accordion" data-children=".product-card">
                        <div class="col-12 mb-2 mt-2">
                            <div class="card product-card  mb-2 mt-2">
                                <div class="card-header">
                                    Text Details
                                </div>
                                <div class="card-body collapse show" id="basic">

                                    <div class="form-group">
                                        <label for="body">{{ __('lang.body') }}</label><br>
                                        <textarea id="description" name="body" type="text" cols="60" rows="5">{{ $description->body }}</textarea>

                                    </div>
                                </div>

                                    @if ($errors->any())
                                        <div class="row justify-content-center text-center">
                                            <div class="col-6 alert alert-danger">
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

                    <div class="form-group">
                        <button type="submit" class="btn-schoen">
                            {{ __('lang.admin-update-text') }}
                        </button>
                    </div>

                </form>

                </div>

                <div class="container">
                    @if(Session::has('success'))
                        <div class="containter">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="alert alert-success text-center">
                                        {{ Session::get('success') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
@stop