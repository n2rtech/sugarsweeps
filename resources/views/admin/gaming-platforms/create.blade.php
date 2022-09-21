@extends('layouts.admin')
@section('title','Create Gaming Platform')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.gaming-platforms.index') }}">Gaming Platforms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Gaming Platform</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Create Gaming Platform</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <form action="{{ route('admin.gaming-platforms.store') }}" method="POST" id="paymentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="platform" class="col-sm-2 col-form-label">Gaming Platform</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="platform" placeholder="Gaming Platform"
                                        name="platform" value="{{ old('platform') }}">
                                    @error('platform')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="download_link" class="col-sm-2 col-form-label">Game Download Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="download_link" placeholder="Game Download Link"
                                        name="download_link" value="{{ old('download_link') }}">
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
                                            <input type="file" class="custom-file-input" id="image" name="image" onchange="loadPreview(this);">
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>
                                    </div>
                                    @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                    <img id="preview_img" src="https://via.placeholder.com/244" class="mt-2" width="120" height="120"/>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="statuses" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <label class="ms-switch">
                                        <input type="checkbox" id="statuses" name="status" value="1" @if(old('status') == 1) checked @endif>
                                        <span class="ms-switch-slider ms-switch-dark round"></span>
                                      </label>
                                      <span>Active</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-12 col-md-12 text-right">
                                    <button class="btn btn-gradient-success btn-sm" type="submit"
                                        form="paymentForm">Save</button>
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
@push('scripts')
<script>
	function loadPreview(input, id) {
		id = id || '#preview_img';
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
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
