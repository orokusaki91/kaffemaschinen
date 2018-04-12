@php($page_name = 'Artikel verkauft')
@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-12 h1" >{{ __('lang.orders-sold') }}</div>
         
            <div class="col-lg-3 col-sm-12">
                <select class="form-control" name="select-status" onchange="location=this.value;">
                    <option value="{{ urldecode(route('admin.order.index', array_merge(request()->query(), ['delivery_status' => '']), false)) }}"  @if (app('request')->input('delivery_status') == null || app('request')->input('delivery_status') == '') selected @endif>Wählen Sie den Lieferstatus</option>
                    <option value="{{ urldecode(route('admin.order.index', array_merge(request()->query(), ['delivery_status' => '1']), false)) }}" @if (app('request')->input('delivery_status') == '1') selected @endif>Offen</option>
                    <option value="{{ urldecode(route('admin.order.index', array_merge(request()->query(), ['delivery_status' => '2']), false)) }}" @if (app('request')->input('delivery_status') == '2') selected @endif>Abgeschlossen</option>
                </select>
            </div>
            <div class="col-lg-3 col-sm-12 text-right">
                <form method="GET" action="{{ urldecode(route('admin.order.index', array_merge(request()->query(), ['search' => Input::get('search')]), false)) }}" accept-charset="UTF-8" class="navbar-form navbar-left" role="search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="Suche...">
                        <span class="input-group-btn">
                            <button class="btn btn-default-sm" type="submit">
                                <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-fa-processed="" data-prefix="fa" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg><!-- <i class="fa fa-search" aria-hidden="true"></i> -->
                            </button>
                        </span>
                    </div>
                </form>
            </div>


        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop