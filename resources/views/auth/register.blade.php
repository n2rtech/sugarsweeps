@extends('layouts.front')
@section('title', 'Registration | SugarSweeps')
@section('content')

<!-- ======= Registration Section ======= -->
<section id="registration" class="registration">
    <div class="container">
        <div class="section-title">
            <h2>CREATE <span class="text-primary">NEW ACCOUNT</span></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 align-items-stretch m-auto register-bg">
            <form method="POST" action="{{ route('register') }}" id="registrationForm">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-form-label text-md-end">{{ __('Your Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-form-label text-md-end">{{ __('Phone Number') }}</label>
                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" autocomplete="phone" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
                    <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                </div>

                <div class="row mb-3">
                    <label for="photo-id" class="col-form-label text-md-end">{{ __('Upload Photo ID') }}</label>
                    <input id="photo-id" type="file" class="form-control" name="photo_id" placeholder="Upload Photo ID">
                    @error('photo_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row text-center mb-3">
                    <button type="submit" form="registrationForm" class="register-button">{{ __('Register') }}</button>
                </div>

                <div class="row mb-0">
                    <div class="col-md-12 text-center">
                        <p class="account-message">Already have an account? <a href="{{ route('login') }}">LOGIN</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- ======= Registration Section Ends Here ======= -->

@endsection
