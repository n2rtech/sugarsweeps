@extends('layouts.admin')
@section('title','Create Player')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Create Player</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <a class="btn btn-dark btn-md waves-effect waves-light"
                    href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @include('admin.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.players.store') }}" method="POST" id="playerForm">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
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
                            <input type="password" class="form-control" id="email" placeholder="Password"
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
                        <label for="statuses" class="col-sm-2 col-form-label">Approval</label>
                        <div class="col-sm-10">
                            <select name="approved" id="approved" class="form-control">
                                <option value="">Select Account Approval</option>
                                <option value="0">Pending</option>
                                <option value="2" selected>Approved</option>
                                <option value="3">Rejected</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success" form="playerForm">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
