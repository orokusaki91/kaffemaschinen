@php($page_name = 'Admin-Benutzer')
@extends('admin.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('lang.edit-user') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admin-user.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">


                        @include('admin.admin-user._fields',['editMethod' => true,'roles' => $roles])

                        <div class="form-group">
                            <button class="btn-schoen" type="submit">{{ __('lang.update') }}</button>
                            <a href="{{ route('admin.admin-user.index') }}" class="btn">{{ __('lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>
    </div>
@endsection