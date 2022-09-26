@extends('layouts.admin')
@section('title', 'Payment Methods')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Payment Methods</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <a class="btn btn-dark btn-md waves-effect waves-light" href="{{ route('admin.payment-methods.create') }}">Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (count($methods) > 0)
                        <div class="table-responsive" id="table-hover-animation">
                            <table class="table table-hover-animation mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($methods as $method)
                                        <tr>
                                            <th scope="row">{{ $method->id }}</th>
                                            <td>{{ $method->method }}</td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="status{{ $method->id }}" name="status"
                                                        value="{{ $method->id }}"
                                                        @if ($method->status == 1) checked @endif
                                                        onchange="changeStatus(this.value)">
                                                    <label class="custom-control-label" for="status{{ $method->id }}">
                                                        <span class="switch-text-left"><i
                                                                class="feather icon-check"></i></span>
                                                        <span class="switch-text-right"><i
                                                                class="feather icon-x"></i></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-warning btn-sm waves-effect waves-light">Edit</a>
                                                    <a href="#modal-delete" data-id="{{ $method->id }}"  data-toggle="modal" data-target="#modal-delete" class="confirmDelete btn btn-sm btn-danger waves-effect waves-light">Delete</a>
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

            form_action = '{{ route('admin.payment-methods.destroy', ':id') }}';
            url = form_action.replace(':id', requestId);

            $('#deleteForm').attr('action', url);


            $(_self.attr('href')).modal('show');
        });
    </script>
    <!-- Confirm Delete Scripts End -->

    <script>
        function changeStatus(value) {
            var url = '{{ route('admin.payment-methods.show', ':id') }}';
            url = url.replace(':id', value);
            location.href = url;
        }
    </script>
@endpush
