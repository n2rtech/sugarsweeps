@extends('layouts.front')
@section('title', 'My Account')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>My Account</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <form class="form-horizontal" id="accountForm" action="{{ route('my-account.update', $user->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname" class="form-control"
                                value="{{ $user->firstname }}">
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname" class="form-control"
                                value="{{ $user->lastname }}">
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                value="{{ $user->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Telephone</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ $user->phone }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="avatar">Profile Picture</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                        onchange="loadPreview(this);">
                                    <label class="custom-file-label" for="avatar">Choose Image</label>
                                </div>
                            </div>
                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                            <img id="preview_img" src="{{ $user->avatar }}" class="mt-2" width="150" height="150" />
                        </div>

                        <div class="form-group mb-3 text-right">
                                <button type="accountForm" class="btn btn-gradient-success btn-md" form="accountForm"><i
                                        class="mdi mdi-content-save"></i> Update </button>
                        </div>
                    </form>
                </div>
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
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
