@extends('layouts.front')
@section('title', 'Login | SugarSweeps')
@section('content')

<!-- ======= Login Section ======= -->
<section id="login" class="login">
    <div class="container">
        <div class="section-title">
            <h2><span class="text-primary">LOGIN</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 align-items-stretch m-auto register-bg">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">

                            <label class="form-check-label remember" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 forgot-pass">
                        <a class="forget-link" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="row text-center mb-3">
                    <button type="submit" form="loginForm" class="login-button">{{ __('Login') }}</button>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <p class="account-message">Don't have an account? <a href="{{ route('register') }}">REGISTER</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ======= Login Section Ends Here ======= -->

@endsection
