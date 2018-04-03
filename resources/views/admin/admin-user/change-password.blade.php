@php($page_name = 'Passwort ändern')
@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="h1">
                {{ __('lang.change-password') }}
            </div>
        </div>

        @if (Session::has('success_message'))
            <div class="alert alert-success">
                <strong>Success!</strong> You have successfully changed your password.
            </div>
        @endif
        @if (Session::has('fail_message'))
            <div class="alert alert-error">
                <strong>Fail!</strong> You haven't changed your password.
            </div>
        @endif

        <div class="row">
            <form method="POST" action="{{route('admin.change.password')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="current_password">{{ __('lang.current-password') }}
                        @if($errors->has('current_password'))
                            <div class="text-right" role="alert" style="color:red">
                                {{ $errors->first('current_password') }}
                            </div>
                        @endif
                    </label>
                    <input type="password" name="current_password" class="form-control" id="current_password" placeholder="{{ __('lang.current-password') }}">
                </div>

                <div class="form-group">
                    <label for="password">{{ __('lang.new-password') }}
                        @if($errors->has('password'))
                            <div class="text-right" role="alert" style="color:red">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('lang.new-password') }}">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('lang.confirm-password') }}

                    </label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="{{ __('lang.confirm-password') }}">
                </div>
                <button type="submit" class="btn-schoen">{{ __('lang.change-password') }}</button>
            </form>
        </div>
    </div>


@stop