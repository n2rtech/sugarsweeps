@extends('layouts.admin')
@section('title', 'Terms')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="ms-panel-custom">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Terms Page Content</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <form action="{{ route('admin.save-term-setting') }}" method="POST" id="paymentForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="cashapp" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="content" placeholder="Content"
                                            name="content" rows="10">{{ old('content', $terms['content']) }}</textarea>
                                        @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
     <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>
<script>

tinymce.init({
  selector: 'textarea#content',
  height: 300,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:roboto; font-size:16px }'
});
</script>
@endpush
