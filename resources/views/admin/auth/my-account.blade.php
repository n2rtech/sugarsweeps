@extends('layouts.admin')
@section('title', 'My Account')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="{{ route('admin.dashboard') }}"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </nav>
    </div>
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
                <form class="form-horizontal" id="accountForm" action="{{route('admin.my-account.update', $admin->id)}}" method="POST" enctype="multipart/form-data">

					@csrf
					@method('PUT')


					<div class="form-group row mb-3">
						<label for="firstname" class="col-3">Firstname</label>
						<div class="col-9">
							<input type="text" id="firstname" name="firstname" class="form-control" value="{{$admin->firstname}}">
							@error('firstname')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

                    <div class="form-group row mb-3">
						<label for="lastname" class="col-3">Lastname</label>
						<div class="col-9">
							<input type="text" id="lastname" name="lastname" class="form-control" value="{{$admin->lastname}}">
							@error('lastname')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-3">
						<label for="email" class="col-3">Email</label>
						<div class="col-9">
							<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{$admin->email}}">
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-3">
						<label for="phone" class="col-3">Telephone</label>
						<div class="col-9">
							<input type="text" id="phone" name="phone" class="form-control" value="{{$admin->phone}}">
						</div>
					</div>

					<div class="form-group row mb-3">
						<label for="avatar" class="col-3 col-form-label">Profile Picture</label>
						<div class="col-9">
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="avatar" name="avatar" onchange="loadPreview(this);">
									<label class="custom-file-label" for="avatar">Choose Image</label>
								</div>
							</div>
							@if($errors->has('avatar'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('avatar') }}</strong>
							</span>
							@endif
							<img id="preview_img" src="{{$admin->avatar}}" class="mt-2" width="150" height="150"/>
						</div>
					</div>

					<div class="form-group mb-0 justify-content-end row text-right mt-3">
						<div class="col-12">
							<button type="accountForm" class="btn btn-gradient-success btn-sm" form="accountForm"><i class="mdi mdi-content-save"></i> Update </button>
						</div>
					</div>
				</form>
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
				.width(150)
				.height(150);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
@endpush
