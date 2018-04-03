@php($page_name = 'Kunden')
@extends('admin.layouts.app')
@section('content')
   
        <h1>
            <span class="main-title-wrap">{{ __('lang.kunden.index.title') }}</span>
            
        </h1>
   
    <div class="container">
        {!! $dataGrid->render() !!}
    </div>
@stop