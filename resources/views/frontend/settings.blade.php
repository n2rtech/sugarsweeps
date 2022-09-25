@extends('layouts.front')
@section('title', 'Settings | SugarSweeps')
@section('content')

<!-- ======= Settings Section ======= -->
<section id="settings" class="settings">
    <div class="container">
        <div class="section-title">
            <h2><span class="text-primary">SETTINGS</span></h2>
        </div>
    </div>
    <!-- ======= Account Info Section ======= -->

    <div class="row">
        <div class="col-lg-10 col-md-10 align-items-stretch m-auto account-info">
            <div class="settings-account-info">
                <h4>Account <span class="text-primary">Info</span></h4>
                <form method="POST" action="{{ route('my-account.update', $user) }}" id="registrationForm">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-form-label text-md-end">{{ __('Your Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter Your Name" autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-form-label text-md-end">{{ __('Phone Number') }}</label>
                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter Phone Number" autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter Email Address" autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="approved" class="col-form-label text-md-end">{{ __('Account Status') }}</label>
                        <input id="approved" type="text" class="form-control" name="approved" placeholder="Approved" value="Approved" readonly>
                    </div>

                    <div class="row text-center">
                        <button type="submit" form="registrationForm" class="register-button">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- ======= End Account Info Section ======= -->

    <!-- ======= Change Password Section ======= -->

    <div class="row mt-5">
        <div class="col-lg-10 col-md-10 align-items-stretch m-auto change-password">
            <div class="settings-change-password">
                <h4>Change <span class="text-primary">Password</span></h4>
                <form id="passwordForm" action="{{ route('change-password') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="current_password" class="col-form-label text-md-end">Current Password</label>
                    <div class="input-group input-group-merge">
                        <input id="current_password" type="password"
                            class="form-control setting-input @error('current_password') is-invalid @enderror"
                            name="current_password" autocomplete="off" placeholder="Current Password">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-form-label text-md-end">New Password</label>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password"
                            class="form-control setting-input @error('password') is-invalid @enderror" name="password"
                            autocomplete="off" placeholder="New Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password_confirmation" class="col-form-label text-md-end">Confirm New Password</label>
                    <div class="input-group input-group-merge">
                        <input id="password_confirmation" type="password"
                            class="form-control setting-input @error('password') is-invalid @enderror"
                            name="password_confirmation" autocomplete="off" placeholder="Confirm New Password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row text-center">
                    <button type="submit" form="passwordForm" class="register-button">{{ __('Change Password') }}</button>
                </div>
            </form>
            </div>

        </div>
    </div>

    <!-- ======= End Change Password Section ======= -->

</section>
<!-- ======= End Settings Section ======= -->
@endsection
