@extends('layouts.admin')
@section('title','Create Notification')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.notification-center.index') }}">Notification Center</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Notification</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Create Notification</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <form action="{{ route('admin.notification-center.store') }}" method="POST" id="paymentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="player" class="col-sm-2 col-form-label">Select Player</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="player" name="player">
                                        <option value="">All</option>
                                        @foreach ($players as $player)
                                            <option value="{{ $player->id }}">{{ $player->firstname }} {{ $player->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-sm-2 col-form-label">Message</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="message" placeholder="Message"
                                        name="message" rows="5">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-12 col-md-12 text-right">
                                    <button class="btn btn-gradient-success btn-sm" type="submit"
                                        form="paymentForm">Send</button>
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
