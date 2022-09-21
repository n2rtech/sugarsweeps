@extends('layouts.cashier')
@section('title','Players')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="{{ route('cashier.dashboard') }}"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Players</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Players</h6>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="javascript:void(0)" id="filter" class="btn btn-gradient-warning">Filter</a>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12 mb-4" id="filterBox">
                        <form action="{{ route('cashier.players.index') }}">
                            <div class="form-row">
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" placeholder="Player"
                                            name="name" value="{{ $filter_name }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email Address"
                                            name="email" value="{{ $filter_email }}">
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
                                        <input type="text" class="form-control" id="phone" placeholder="Phone number"
                                            name="phone" value="{{ $filter_phone }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <select class="form-control" id="statuses" name="status">
                                            <option value="">Select Status</option>
                                            <option value="active" @if($filter_status=='active' ) selected @endif>Active
                                            </option>
                                            <option value="inactive" @if($filter_status=='inactive' ) selected @endif>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 text-right">
                                    <button class="ms-btn-icon btn-gradient-secondary form-control" type="submit"><i class="fas fa-filter"></i></button>
                                    <a href="{{ route('cashier.players.index') }}" class="ms-btn-icon btn-gradient-warning form-control" type="submit"><i class="fas fa-undo"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        @if(count($players) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover thead-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Player</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Gaming Platforms</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($players as $player)
                                    <tr>
                                        <th scope="row">{{ $player->id }}</th>
                                        <td><img src="{{ asset('assets/img/avatar.png') }}" style="width:50px; height:30px;">{{ $player->firstname }} {{ $player->lastname }}</td>
                                        <td>{{ $player->email }}</td>
                                        <td>{{ $player->phone }}</td>
                                        @if($player->status == 'inactive')
                                        <td><span class="badge badge-outline-danger">{{ ucfirst($player->status) }}</span>
                                        </td>
                                        @else
                                        <td><span class="badge badge-outline-light">{{ ucfirst($player->status) }}</span>
                                        </td>
                                        @endif
                                        @if(count($player->gamingAccount) > 0)
                                        <td>
                                            @foreach($player->gamingAccount as $account)
                                            <span class="badge badge-outline-primary">{{ $account->platform->platform }}</span>
                                            @endforeach
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-outline-danger">N/A</span>
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('cashier.players.show', $player->id) }}" class="ms-btn-icon btn-secondary"><i class="fas fa-eye ms-text-success"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $players->links('vendor.pagination.bootstrap-4') }}
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
                <input type='hidden' name='_token' value='{{ csrf_token()}}'>
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
    $(document).on("click", ".confirmDelete", function (e) {

    e.preventDefault();

    var _self = $(this);

    var requestId = _self.data('id');

    form_action = '{{ route("cashier.players.destroy", ":id") }}';
    url = form_action.replace(':id', requestId);

    $('#deleteForm').attr('action', url);


    $(_self.attr('href')).modal('show');
    });
</script>
<!-- Confirm Delete Scripts End -->

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
