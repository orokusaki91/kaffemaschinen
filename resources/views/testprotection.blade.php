@extends('front.layouts.app')

@section('meta_title', 'Login: TestProtection')
@section('meta_description', '')

@section('content')
    <!-- Main Content - start -->
    <main>
        <section class="container stylization maincont">
            <h1 class="main-ttl"><span>TestProtection</span></h1>
            <div class="auth-wrap">
                <div class="auth-col">
                    <h2>Login</h2>
                    <form class="login" role="form" method="POST" action="{{ route('testprotection') }}">
                        {{ csrf_field() }}
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            <label for="email">E-mail <span class="required">*</span></label><input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </p>
                        <p>
                            <label for="password">{{ __('front.account-password') }} <span class="required">*</span></label><input id="password" class="form-control" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                            @endif
                        </p>
                        <p class="auth-submit">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                            <input type="checkbox" name="remember_me" id="rememberme" value="forever">
                            <label for="rememberme">{{ __('front.account-remember-me') }}</label>
                        </p>
                        <p class="auth-lost_password">
                            <a href="#" style="color: #fff;">{{ __('front.account-lost-your-password') }}</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- Main Content - end -->

@endsection

