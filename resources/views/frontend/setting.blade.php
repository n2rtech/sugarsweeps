@extends('layouts.app')
@section('title', 'DragonStakes')
@section('head')
<style>
    .invalid-feedback{
        color: red;
    }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="setting-page">
            <div class="setting-logo">
                <img src="assets/img/setting-logo.png" alt="Setting" class="img-responsive">
            </div>
            <h3>Account Info</h3>
            <form class="form-horizontal" id="accountForm" action="{{ route('my-account.update', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="firstname">Firstname</label>
                    <input type="text" id="firstname" name="firstname" class="form-control setting-input"
                        value="{{ $user->firstname }}">
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="lastname">Lastname</label>
                    <input type="text" id="lastname" name="lastname" class="form-control setting-input"
                        value="{{ $user->lastname }}">
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control setting-input"
                        placeholder="Email" value="{{ $user->email }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="phone">Telephone</label>
                    <input type="text" id="phone" name="phone" class="form-control setting-input"
                        value="{{ $user->phone }}">
                </div>

                <div class="form-group text-center">
                    <button type="accountForm" class="btn btn-update" form="accountForm">Update </button>
                </div>
            </form>
            <h3>Change Password</h3>
            <form class="form-horizontal" id="passwordForm" action="{{ route('change-password') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="current_password">Current Password</label>
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

                <div class="form-group mb-3">
                    <label for="password">New Password</label>
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

                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm New Password</label>
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

                <div class="form-group text-center">
                        <button type="submit" class="btn btn-update" form="passwordForm">Change Password</button>
                </div>
            </form>
        </div>
    </div>
    <div style="margin-top: 10rem!important;">
        @include('frontend.footer')
    </div>
@endsection
