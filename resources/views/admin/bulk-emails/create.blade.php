@extends('layouts.admin')
@section('title','Create Bulk Email')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Create Bulk Email</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @include('admin.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                        <form action="{{ route('admin.bulk-emails.store') }}" method="POST" id="paymentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="player" class="col-sm-2 col-form-label">Select Player</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="player" name="player">
                                        <option value="">All</option>
                                        @foreach ($players as $player)
                                            <option value="{{ $player->id }}">{{ $player->name }}</option>
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
                                    <button class="btn btn-success btn-md" type="submit"
                                        form="paymentForm">Send</button>
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
				.width(244)
				.height(244);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
@endpush
