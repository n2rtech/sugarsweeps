@extends('layouts.admin')
@section('title', 'Gaming Platforms')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="ms-panel-custom">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gaming Platforms</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Gaming Platforms</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('admin.gaming-platforms.create') }}" class="btn btn-gradient-dark">Create</a>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (count($platforms) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover thead-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Gaming Platform</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($platforms as $platform)
                                                <tr>
                                                    <th scope="row">{{ $platform->id }}</th>
                                                    <td>{{ $platform->platform }}</td>
                                                    <td>
                                                        <label class="ms-switch">
                                                            <input type="checkbox" id="statuses" name="status"
                                                                value="{{$platform->id}}"
                                                                @if ($platform->status == 1) checked @endif
                                                                onchange="changeStatus(this.value)">
                                                            <span class="ms-switch-slider ms-switch-dark round"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.gaming-platforms.edit', $platform->id) }}" class="ms-btn-icon btn-secondary"><i
                                                                class="fas fa-pencil-alt ms-text-success"></i> </a>
                                                        <a href="#modal-delete" data-id="{{ $platform->id }}"
                                                            class="confirmDelete ms-btn-icon btn-danger" data-toggle="modal"
                                                            data-target="#modal-delete"><i
                                                                class="far fa-trash-alt ms-text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <p class="text-center">No Listing found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="deleteForm">
                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <input type='hidden' name='_method' value='DELETE'>
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title has-icon text-white"><i class="flaticon-alert-1"></i> Are you sure ?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <p>You won't be able to revert this vendor once deleted!</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary shadow-none">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Confirm Delete Scripts Start -->
    <script>
        $(document).on("click", ".confirmDelete", function(e) {

            e.preventDefault();

            var _self = $(this);

            var requestId = _self.data('id');

            form_action = '{{ route('admin.gaming-platforms.destroy', ':id') }}';
            url = form_action.replace(':id', requestId);

            $('#deleteForm').attr('action', url);


            $(_self.attr('href')).modal('show');
        });
    </script>
    <!-- Confirm Delete Scripts End -->

    <script>
        function changeStatus(value) {
           var url         = '{{ route("admin.gaming-platforms.show", ":id") }}';
           url             = url.replace(':id', value);
           location.href   = url;
        }

   </script>
@endpush
