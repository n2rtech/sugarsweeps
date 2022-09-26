@extends('layouts.admin')
@section('title', 'Cash App')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Cash App</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('admin.save-cashapp') }}" method="POST" id="cashAppForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('cashapp') ? 'error' : '' }}">
                            <label for="cashapp">Cashapp Link</label>
                            <input type="text" class="form-control" id="cashapp" placeholder="Cash App Link"
                                name="cashapp" value="{{ old('cashapp', $cashapp['cashapp']) }}">
                            @error('cashapp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success" form="cashAppForm">Save</button>
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
                        .width(120)
                        .height(120);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
