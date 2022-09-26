@extends('layouts.admin')
@section('title', 'Deposit Requests')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Deposit Requests</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <a href="javascript:void(0)" id="filter"
                        class="btn btn-info btn-md waves-effect waves-light">Filter</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-md-12" id="filterBox">
                        <form action="{{ route('admin.deposit-requests.index') }}">
                            <div class="form-row">
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="filter_name" placeholder="Player"
                                            name="filter_name" value="{{ $filter_name }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="filter_phone"
                                            placeholder="Phone number" name="filter_phone" value="{{ $filter_phone }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <select class="form-control" name="filter_cashier" id="filter_cashier">
                                            <option value="">Select Cashier</option>
                                            @foreach ($cashiers as $cashier)
                                                <option value="{{ $cashier->id }}"
                                                    @if ($filter_cashier == $cashier->id) selected @endif>{{ $cashier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <select class="form-control" name="filter_platform" id="filter_platform">
                                            <option value="" selected>Select Platform</option>
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}"
                                                    @if ($filter_platform == $platform->id) selected @endif>
                                                    {{ $platform->platform }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <select class="form-control" id="filter_status" name="filter_status">
                                            <option value="" selected>Select Status</option>
                                            <option value="0" {{ $filter_status == '0' ? 'selected' : '' }}>Requested
                                            </option>
                                            <option value="1" {{ $filter_status == '1' ? 'selected' : '' }}>Approved
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 text-right">
                                    <button class="btn btn-md btn-secondary" type="submit"><i
                                            class="feather icon-search"></i></i></button>
                                    <a href="{{ route('admin.deposit-requests.index') }}" class="btn btn-md btn-warning"
                                        type="submit"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($requests) > 0)
                        <div class="table-responsive" id="table-hover-animation">
                            <table class="table table-hover-animation mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="date-width">Date</th>
                                        <th>Cashier</th>
                                        <th>Player</th>
                                        <th>Email</th>
                                        <th class="text-center">Phone</th>
                                        <th>Gaming Platform</th>
                                        <th>Username</th>
                                        <th>Amount</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y h:i:s') }}
                                            </td>
                                            <td>
                                                @if (isset($request->cashier))
                                                    {{ $request->cashier->name }}
                                                @elseif($request->status == '1' && is_null($request->cashier))
                                                    <span class="badge badge-outline-danger badge-pill">Admin</span>
                                                @else
                                                    N/A
                                                @endisset
                                        </td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $request->user->email }}</td>
                                        <td class="text-center">{{ $request->user->phone }}</td>
                                        <td>{{ $request->platform->platform }}</td>
                                        <td>{{ $request->username }}</td>
                                        <td>$ {{ $request->amount }}</td>
                                        @if ($request->status == '0')
                                            <td class="text-center">
                                                <div class="button-group">
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmAccept({{ $request->id }});"
                                                        class="btn btn-dark btn-sm">Process</a>
                                                </div>
                                            </td>
                                        @endif
                                        @if ($request->status == '1')
                                            <td class="text-center">
                                                <span class="text-success">Approved</span>
                                            </td>
                                        @endif
                                        @if ($request->status == '2')
                                            <td class="text-center">
                                                <span class="text-danger">Rejected</span>
                                            </td>
                                        @endif
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
{{ $requests->links('vendor.pagination.bootstrap-4') }}
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
                    <p>You won't be able to revert this player once deleted!</p>
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

        form_action = '{{ route('admin.deposit-requests.destroy', ':id') }}';
        url = form_action.replace(':id', requestId);

        $('#deleteForm').attr('action', url);


        $(_self.attr('href')).modal('show');
    });
</script>
<!-- Confirm Delete Scripts End -->

<!-- Filter Box Scripts Start -->
<script>
    $(document).ready(function() {
        var filterBox = '{{ $filter_box }}';
        if (filterBox === 'show') {
            $("#filterBox").css('display', 'block');
        }

        $("#filter").click(function() {
            $("#filterBox").slideToggle();
        });

    });
</script>
<!-- Filter Box Scripts End -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function confirmAccept(id) {
        url_string = '{{ route('admin.deposit-requests.show', ':id') }}';
        url = url_string.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Accept it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
@endpush
