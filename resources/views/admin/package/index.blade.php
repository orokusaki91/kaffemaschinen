@php($page_name = 'Angebot')
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">{{ __('lang.package.index.title') }}</span>
            <a style="" href="{{ route('admin.package.create') }}" class="btn btn-schoen float-right">
                {{ __('lang.package.create.text') }}
            </a>
        </h1>

        {!! $dataGrid->render() !!}
    </div>
@stop