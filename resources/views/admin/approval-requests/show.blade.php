@extends('layouts.admin')
@section('title','Show Approval Request')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Show Approval Request</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-6 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <a class="btn btn-dark btn-md waves-effect waves-light"
                    href="{{ url()->previous() }}">Back</a>
                    <a class="btn btn-success btn-md waves-effect waves-light" href="javascript:void(0)" onclick="confirmAccept({{ $player->id }})">Approve</a>
                    <a class="btn btn-danger btn-md waves-effect waves-light" href="javascript:void(0)" onclick="confirmReject({{ $player->id }})">Reject</a>
            </div>
        </div>
    </div>
</div>
@include('admin.sections.flash-message')
<div class="row">
    <div class="col-md-8">
        <div class="content-body">

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Name</span>
                                    <span class="text-primary">{{ $player->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Email</span>
                                    <span class="text-primary">{{ $player->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Phone</span>
                                    <span class="text-primary">{{ $player->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Account Created On</span>
                                    <span class="text-primary">{{ $player->created_at }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="content-body">
            <img id="preview_img" src="{{ $player->photo_id }}" class="img-fluid"/>
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
                    .width(260)
                    .height(160);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- Filter Box Scripts End -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function confirmAccept(id) {
        url_string = '{{ route('admin.approval-requests.approve', ':id') }}';
        url = url_string.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
<script type="text/javascript">
    function confirmReject(id) {
        url_string = '{{ route('admin.approval-requests.reject', ':id') }}';
        url = url_string.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
@endpush
