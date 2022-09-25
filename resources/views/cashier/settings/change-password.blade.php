@extends('layouts.cashier')
@section('title', 'Change Password')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Change Password</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @include('cashier.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form id="accountForm" method="POST" action="{{ route('cashier.change-password') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('current_password') ? 'error' : '' }}">
                        <label for="current_password">Current password *</label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                        @error('current_password')
                            <div class="help-block"><ul role="alert"><li>{{ $message }}</li></ul></div>
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('new_password') ? 'error' : '' }}">
                        <label for="new_password">New password *</label>
                        <input type="password" id="new_password" name="new_password" class="form-control">
                        @error('new_password')
                            <div class="help-block"><ul role="alert"><li>{{ $message }}</li></ul></div>
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('new_password_confirmation') ? 'error' : '' }}">
                        <label for="new_password_confirmation">New password confirmation *</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="form-control">
                        @error('new_password_confirmation')
                            <div class="help-block"><ul role="alert"><li>{{ $message }}</li></ul></div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success" form="accountForm">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>

    </script>
@endpush
