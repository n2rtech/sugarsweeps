@extends('layouts.admin')
@section('title', 'My Account')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">My Account</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form id="accountForm" method="POST"
                        action="{{ route('admin.my-account.update', Auth::guard('admin')->id()) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('name') ? 'error' : '' }}">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Full Name" value="{{ old('name', $admin->name) }}">
                            @error('name')
                                <div class="help-block">
                                    <ul role="alert">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email Address" value="{{ old('email', $admin->email) }}">
                            @error('email')
                                <div class="help-block">
                                    <ul role="alert">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'error' : '' }}">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter Phone Number" value="{{ old('phone', $admin->phone) }}">
                            @error('phone')
                                <div class="help-block">
                                    <ul role="alert">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group {{ $errors->has('avatar') ? 'error' : '' }}">
                            <label for="avatar">Profile Picture</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                        onchange="loadPreview(this);">
                                    <label class="custom-file-label" for="avatar">Choose Image</label>
                                </div>
                            </div>
                            @error('avatar')
                                <div class="help-block">
                                    <ul role="alert">
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                            <img id="preview_img" src="{{ $admin->avatar }}" class="mt-1" width="100"
                                height="100" />
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
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
