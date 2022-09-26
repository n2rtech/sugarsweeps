@extends('layouts.cashier')
@section('title', 'Show Gaming Request')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="ms-panel-custom">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item" aria-current="page"> <a href="#"><i class="material-icons">home</i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cashier.gaming-requests.index') }}">Gaming Requests</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show Gaming Request</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Show Gaming Request</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="ms-panel ms-widget ms-identifier-widget bg-info" style="height: 326px;">
                                <div class="ms-panel-header header-mini">
                                    <h6>Player Information</h6>
                                </div>
                                <div class="ms-panel-body">
                                    <table class="table table-bordered bg-white">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Player</th>
                                                <td class="text-right">{{ $request->user->firstname }}
                                                    {{ $request->user->lastname }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Email Address</th>
                                                <td class="text-right">{{ $request->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Phone Number</th>
                                                <td class="text-right">{{ $request->user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Joined On</th>
                                                <td class="text-right">
                                                    {{ \Carbon\Carbon::parse($request->user->created_at)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="ms-panel ms-widget ms-identifier-widget bg-warning">
                                <div class="ms-panel-header header-mini">
                                    <h6>Account Information</h6>
                                </div>
                                <div class="ms-panel-body">
                                        <table class="table table-bordered bg-white">
                                            <form method="POST" action="{{route('cashier.gaming-requests.update', $request->id)}}" id="requestForm">
                                                @csrf
                                                @method('PUT')
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Gaming Platform</th>
                                                <td class="text-right">{{ $request->platform->platform }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Username</th>
                                                <td class="text-right">
                                                    <input type="text" name="username"
                                                        class="form-control form-control-sm" id="username"
                                                        placeholder="Username" value="{{ old('username', $request->username) }}">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Password</th>
                                                <td class="text-right">
                                                    <input type="text" name="password"
                                                        class="form-control form-control-sm" id="password"
                                                        placeholder="Password" value="{{ old('password', $request->password) }}">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <td class="text-right" colspan="2"><button class="btn btn-sm btn-success"
                                                    type="submit" form="requestForm">Submit</button></td>
                                            </tr>
                                        </tbody>
                                    </form>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Other Gaming Request</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (count($other_requests) > 0)
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
                                            @foreach ($other_requests as $request)
                                                <tr>
                                                    <th scope="row">
                                                        {{ \Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}
                                                    </th>
                                                    <th scope="row">
                                                        {{ \Carbon\Carbon::parse($request->created_at)->format('H:i:s') }}
                                                    </th>
                                                    <td>{{ $request->user->firstname }} {{ $request->user->lastname }}
                                                    </td>
                                                    <td>
                                                        @isset($request->cashier_id)
                                                            {{ $request->cashier->firstname }}
                                                            {{ $request->cashier->lastname }}
                                                        @else
                                                            N/A
                                                        @endisset
                                                    </td>
                                                    <td>{{ $request->platform->platform }}</td>
                                                    <td>
                                                        @if ($request->status == 0)
                                                            <span class="badge badge-outline-danger">Requested</span>
                                                        @else
                                                            <span class="badge badge-outline-success">Accepted</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('cashier.gaming-requests.edit', $request->id) }}"
                                                            class="ms-btn-icon btn-secondary"><i
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
@endpush
