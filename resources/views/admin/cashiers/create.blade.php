@extends('layouts.admin')
@section('title','Create Player')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.cashiers.index') }}">Players</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Player</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Create Cashier</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <form action="{{ route('admin.cashiers.store') }}" method="POST" id="cashierForm">
                            @csrf
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-2 col-form-label">Firstname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="firstname" placeholder="Firstname"
                                        name="firstname" value="{{ old('firstname') }}">
                                    @error('firstname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-sm-2 col-form-label">Lastname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="lastname" placeholder="Lastname"
                                        name="lastname"  value="{{ old('lastname') }}">
                                    @error('lastname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" placeholder="Email Address"
                                        name="email"  value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" placeholder="Phone Number"
                                        name="phone"  value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password-confirm"
                                        placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="statuses" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <label class="ms-switch">
                                        <input type="checkbox" id="statuses" name="status" value="active" @if(old('status') == 'active') checked @endif>
                                        <span class="ms-switch-slider ms-switch-dark round"></span>
                                      </label>
                                      <span>Active</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-12 col-md-12 text-right">
                                    <button class="btn btn-gradient-success btn-sm" type="submit"
                                        form="cashierForm">Save</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
