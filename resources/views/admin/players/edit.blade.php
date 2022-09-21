@extends('layouts.admin')
@section('title','Edit Player')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="{{ route('admin.dashboard') }}"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.players.index') }}">Players</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Player</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Edit Player</h6>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.player.password-form', $player->id) }}" class="btn btn-sm btn-warning">Change Password</a>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <form action="{{ route('admin.players.update', $player->id) }}" method="POST" id="playerForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-2 col-form-label">Firstname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="firstname" placeholder="Firstname"
                                        name="firstname" value="{{ old('firstname', $player->firstname) }}">
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
                                        name="lastname"  value="{{ old('lastname', $player->lastname) }}">
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
                                <label for="statuses" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <label class="ms-switch">
                                        <input type="checkbox" id="statuses" name="status" value="active" @if(old('status', $player->status) == 'active') checked @endif>
                                        <span class="ms-switch-slider ms-switch-dark round"></span>
                                      </label>
                                      <span>Active</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-12 col-md-12 text-right">
                                    <button class="btn btn-gradient-success btn-sm" type="submit"
                                        form="playerForm">Save</button>
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
