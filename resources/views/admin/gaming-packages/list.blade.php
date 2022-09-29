@extends('layouts.admin')
@section('title', 'Gaming Packages')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Gaming Packages</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <a class="btn btn-info btn-md waves-effect waves-light"
                        href="{{ route('admin.gaming-packages.import-export') }}">Import</a>
                    <a class="btn btn-dark btn-md waves-effect waves-light"
                        href="{{ route('admin.gaming-packages.create') }}">Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (count($packages) > 0)
                        <div class="table-responsive" id="table-hover-animation">
                            <table class="table table-hover-animation mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Gaming Platform</th>
                                        <th scope="col" class="text-center">Assigned</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <th scope="row">{{ $package->id }}</th>
                                            <td>{{ $package->package }}</td>
                                            <td class="text-center">
                                                @isset ($package->user_id)
                                                <a href="{{ route('admin.players.edit', $package->user_id) }}" class="btn btn-relief-success btn-sm waves-effect waves-light">{{ getPlayerNameById($package->user_id) }}</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-relief-light btn-sm waves-effect waves-light">Not Assigned</a>
                                                @endisset
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.gaming-packages.edit', $package->id) }}"
                                                    class="btn btn-warning btn-sm waves-effect waves-light">Edit</a>
                                                <a href="#modal-delete" data-id="{{ $package->id }}"  class="confirmDelete btn btn-sm btn-danger waves-effect waves-light" data-toggle="modal"
                                                    data-target="#modal-delete">Delete</a>
                                                </div>
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

            form_action = '{{ route('admin.gaming-packages.destroy', ':id') }}';
            url = form_action.replace(':id', requestId);

            $('#deleteForm').attr('action', url);


            $(_self.attr('href')).modal('show');
        });
    </script>
    <!-- Confirm Delete Scripts End -->

    <script>
        function changeStatus(value) {
            var url = '{{ route('admin.gaming-packages.show', ':id') }}';
            url = url.replace(':id', value);
            location.href = url;
        }
    </script>
@endpush
