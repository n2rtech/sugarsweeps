@extends('layouts.cashier')
@section('title', 'Players')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Players</h2>
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
        @include('cashier.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-md-12" id="filterBox">
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
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Email Address" name="email" value="{{ $filter_email }}">
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
                                        <input type="text" class="form-control" id="username" placeholder="Username"
                                            name="username" value="{{ $filter_username }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12">
                                    <div class="input-group">
                                        <select class="form-control" id="statuses" name="status">
                                            <option value="">Select Approval</option>
                                            <option value="0" @if ($filter_status == '0') selected @endif>Pending
                                            </option>
                                            <option value="2" @if ($filter_status == '1') selected @endif>
                                                Approved</option>
                                            <option value="3" @if ($filter_status == '3') selected @endif>
                                                    Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 text-right">
                                    <button class="btn btn-md btn-secondary" type="submit"><i
                                            class="feather icon-search"></i></i></button>
                                    <a href="{{ route('cashier.players.index') }}" class="btn btn-md btn-warning"
                                        type="submit"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($players) > 0)
                        <div class="table-responsive" id="table-hover-animation">
                            <table class="table table-hover-animation mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Player</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Approval</th>
                                        <th scope="col" class="text-center">Game Credentials</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($players as $player)
                                        <tr>
                                            <th scope="row">{{ $player->id }}</th>
                                            <td>{{ $player->name }}</td>
                                            <td>{{ $player->email }}</td>
                                            <td>{{ $player->phone }}</td>
                                            @if ($player->approved == '2')
                                                <td>
                                                    <div class="badge badge-light-success">Approved</div>
                                                </td>
                                            @elseif($player->approved == '3')
                                                <td>
                                                    <div class="badge badge-light-danger">Rejected</div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="badge badge-light-warning">Pending</div>
                                                </td>
                                            @endif
                                            <td class="text-center">
                                                @if ($player->approved == '2')
                                                    <a href="{{ route('cashier.players.credentials', $player->id) }}" class="btn btn-relief-success btn-sm waves-effect waves-light">Show</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-relief-light btn-sm waves-effect waves-light">N/A</a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('cashier.players.show', $player->id) }}" class="btn btn-warning btn-sm waves-effect waves-light"><i class="feather icon-eye"></i></a>
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
    {{ $players->links('vendor.pagination.bootstrap-4') }}
@endsection
@push('scripts')

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
@endpush
