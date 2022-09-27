@extends('layouts.admin')
@section('title', 'Player Credentials')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Player Credentials</h2>
                </div>
            </div>
        </div>
    </div>
    @include('admin.sections.flash-message')
    <div class="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="package" class="col-sm-2 col-form-label">Package Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="package" placeholder="Package Name"
                                name="package" value="{{ old('package', $package->package) }}">
                            @error('package')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Default Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" placeholder="Default Password"
                                name="password" value="{{ old('password', $package->password) }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($platforms as $platform)
                                            <div class="col-md-6">
                                                <div class="media-list">
                                                    <div class="media">
                                                        <a class="media-left" href="#">
                                                            <img src="{{ $platform->image }}"
                                                                alt="Generic placeholder image" height="64"
                                                                width="64">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5 class="media-heading">{{ $platform->platform }}</h5>
                                                            <input type="text" class="form-control"
                                                                placeholder="{{ $platform->platform }} Username"
                                                                name="{{ Str::lower(str_replace(' ', '', $platform->platform)) }}"
                                                                value="{{ old(Str::lower(str_replace(' ', '', $platform->platform)), $platform->username) }}">
                                                            @error(Str::lower(str_replace(' ', '', $platform->platform)))
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
