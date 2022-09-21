@extends('layouts.admin')
@section('title', 'Gaming Requests')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="ms-panel-custom">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gaming Requests</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Gaming Requests</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="javascript:void(0)" id="filter" class="btn btn-gradient-warning">Filter</a>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-12 mb-4" id="filterBox">
                            <form action="{{ route('admin.gaming-requests.index') }}">
                                <div class="form-row">
                                    <div class="col-xl-2 col-md-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="name" placeholder="Player"
                                                name="name" value="{{ $filter_name }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-12">
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="date" placeholder="Date"
                                                name="date" value="{{ $filter_date }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-12">
                                        <div class="input-group">
                                            <select class="form-control" id="game" name="game">
                                                <option value="">Select Game</option>
                                                @foreach ($platforms as $platform)
                                                    <option value="{{ $platform->id }}" {{ $filter_game == $platform->id ? 'selected' : '' }}>{{ $platform->platform }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="username" placeholder="Username"
                                                name="username" value="{{ $filter_username }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-12">
                                        <div class="input-group">
                                            <select class="form-control" id="statuses" name="status">
                                                <option value="">All</option>
                                                <option value="0" @if($filter_status=='0' ) selected @endif>Requested</option>
                                                <option value="1" @if($filter_status=='1' ) selected @endif>Accepted</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-12 text-right">
                                        <button class="ms-btn-icon btn-gradient-secondary form-control" type="submit"><i class="fas fa-filter"></i></button>
                                        <a href="{{ route('admin.gaming-requests.index') }}" class="ms-btn-icon btn-gradient-warning form-control" type="submit"><i class="fas fa-undo"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            @if (count($requests) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover thead-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Player</th>
                                                <th scope="col">Cashier</th>
                                                <th scope="col">Game</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $request)
                                                <tr>
                                                    <th scope="row">{{ \Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}</th>
                                                    <th scope="row">{{ \Carbon\Carbon::parse($request->created_at)->format('H:i:s') }}</th>
                                                    <td>{{ $request->user->firstname }} {{ $request->user->lastname }}</td>
                                                    <td>@isset($request->cashier_id) {{ $request->cashier->firstname }} {{ $request->cashier->lastname }} @else N/A  @endisset</td>
                                                    <td>{{ $request->platform->platform }}</td>
                                                    <td>
                                                        @if($request->status == 0)
                                                       <span class="badge badge-outline-danger">Requested</span>
                                                        @else
                                                        <span class="badge badge-outline-success">Accepted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.gaming-requests.edit', $request->id) }}" class="ms-btn-icon btn-secondary"><i
                                                                class="fas fa-eye ms-text-success"></i> </a>
                                                        <a href="#modal-delete" data-id="{{ $request->id }}"
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
                    {{ $requests->links('vendor.pagination.bootstrap-4') }}
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

            form_action = '{{ route('admin.gaming-requests.destroy', ':id') }}';
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
   <!-- Filter Box Scripts Start -->
<script>
    $(document).ready(function(){
        var filterBox = '{{ $filter_box }}';
        if(filterBox === 'show'){
            $("#filterBox").css('display', 'block');
        }

        $("#filter").click(function(){
            $("#filterBox").slideToggle();
        });

    });
</script>
<!-- Filter Box Scripts End -->

@endpush
