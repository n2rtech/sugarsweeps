@extends('layouts.admin')
@section('title', 'Edit Gaming Platform')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Gaming Platform</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('admin.gaming-platforms.update', $platform->id) }}" method="POST"
                        id="gamingForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="platform" class="col-sm-2 col-form-label">Gaming Platform</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="platform" placeholder="Gaming Platform"
                                    name="platform" value="{{ old('platform', $platform->platform) }}">
                                @error('platform')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="download_link" class="col-sm-2 col-form-label">Download Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="download_link"
                                    placeholder="Download Link" name="download_link"
                                    value="{{ old('download_link', $platform->download_link) }}">
                                @error('download_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Game Image</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image"
                                            onchange="loadPreview(this);">
                                        <label class="custom-file-label" for="image">Choose Image</label>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <img id="preview_img" src="{{ $platform->image }}" class="mt-2" width="120"
                                    height="120" />
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="statuses" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                    <input type="checkbox" class="custom-control-input" id="statuses" name="status"
                                        value="1" @if (old('status', $platform->status) == 1) checked @endif>
                                    <label class="custom-control-label" for="statuses">
                                        <span class="switch-text-left"><i class="feather icon-check"></i></span>
                                        <span class="switch-text-right"><i class="feather icon-x"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success" form="gamingForm">Update</button>
                </div>
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
                        .width(244)
                        .height(244);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
