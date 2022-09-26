@extends('layouts.admin')
@section('title','Edit Player')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Edit Player</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-6 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <a class="btn btn-dark btn-md waves-effect waves-light"
                    href="{{ url()->previous() }}">Back</a>
                    <a class="btn btn-warning btn-md waves-effect waves-light" href="{{ route('admin.player.password-form', $player->id) }}">Change Password</a>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @include('admin.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.players.update', $player->id) }}" method="POST" id="playerForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                name="name" value="{{ old('name', $player->name) }}">
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
                                name="email"  value="{{ old('email', $player->email) }}">
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
                                name="phone"  value="{{ old('phone', $player->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="statuses" class="col-sm-2 col-form-label">Approval</label>
                        <div class="col-sm-10">
                            <select name="approved" id="approved" class="form-control">
                                <option value="">Select Account Approval</option>
                                <option value="1" @if($player->approved == '1' || $player->approved == '0') selected @endif>Pending</option>
                                <option value="2" @if($player->approved == '2') selected @endif>Approved</option>
                                <option value="3" @if($player->approved == '3') selected @endif>Rejected</option>
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
