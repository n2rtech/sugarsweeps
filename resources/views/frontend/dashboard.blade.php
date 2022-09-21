@extends('layouts.front')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Dashboard</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <a href="{{ route('gaming-accounts') }}">
                                <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                                    <div class="ms-card-body media">
                                        <div class="media-body">
                                            <h6>Gaming Accounts</h6>
                                            <p class="ms-card-change"> {{ $gaming_accounts }}</p>
                                        </div>
                                    </div>
                                    <i class="fa fa-gamepad"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <a href="{{ route('my-account.edit', Auth::user()->id) }}">
                                <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget"
                                    style="height: 103px;">
                                    <div class="ms-card-body media">
                                        <div class="media-body">
                                            <h6>My Account</h6>
                                            <p class="ms-card-change"></p>
                                        </div>
                                    </div>
                                    <i class="flaticon-user"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <a href="{{ route('change-password') }}">
                                <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget"
                                    style="height: 103px;">
                                    <div class="ms-card-body media">
                                        <div class="media-body">
                                            <h6>Change Password</h6>
                                            <p class="ms-card-change"></p>
                                            <p class="fs-12"></p>
                                        </div>
                                    </div>
                                    <i class="flaticon-reuse"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="ms-card card-gradient-info ms-widget ms-infographics-widget"
                                    style="height: 103px;">
                                    <div class="ms-card-body pos media">
                                        <div class="media-body">
                                            <h6>Logout</h6>
                                            <p class="ms-card-change"></p>
                                            <p class="fs-12"></p>
                                        </div>
                                    </div>
                                    <i class="fas fa-cannabis"></i>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Recent Notifications</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <ul class="list-group">
                        @foreach ($notifications as $notification)
                            @if ($notification->type == 'account-created')
                                <li class="list-group-item">
                                    Your {{ $notification->data->platform->platform }} account has been created with
                                    username - {{ $notification->data->username }} and password -
                                    {{ $notification->data->password }}.
                                    <span
                                        class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                                </li>
                            @endif

                            @if ($notification->type == 'credit-added')
                                <li class="list-group-item">
                                    Your {{ $notification->data->platform->platform }} account has been credited with
                                    ${{ $notification->data->amount }} credit.
                                    <span
                                        class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                                </li>
                            @endif

                            @if ($notification->type == 'redeem-done')
                                <li class="list-group-item">Your request to redeem @if ($notification->data->redeem_full == 'yes')
                                        all
                                    @else
                                        worth ${{ $notification->data->amount }}
                                    @endif credits from {{ $notification->data->platform->platform }}
                                    account has been accepted.<span
                                        class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                                </li>
                            @endif

                            @if ($notification->type == 'redeem-rejected')
                                <li class="list-group-item">Your request to redeem @if ($notification->data->redeem_full == 'yes')
                                        all
                                    @else
                                        worth ${{ $notification->data->amount }}
                                    @endif credits from {{ $notification->data->platform->platform }}
                                    account has been rejected.</li>
                            @endif

                            @if ($notification->type == 'notification')
                                <li class="list-group-item">Message from admin: {{ $notification->message }}<span
                                        class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @if (count($notifications) > 0)
                        <div class="col-md-12 text-center mt-3">
                            <a href="{{ route('notifications') }}" class="btn btn-sm btn-warning">View all</a>
                        </div>
                    @endif

                    @if (count($notifications) < 1)
                        <div class="col-sm-12 text-center mt-3">
                            <p> No notification found.</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Recent Transaction History</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (count($histories) > 0)
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="date-width">Date & Time</th>
                                                <th>Credits status</th>
                                                <th>Payment mode</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($histories as $history)
                                                <tr>
                                                    <td>{{ Carbon\Carbon::parse($history->created_at)->format('d-m-Y h:i:s') }}
                                                    </td>
                                                    <td>{{ ucfirst($history->type) }}</td>
                                                    <td>{{ $history->mode ?? 'N/A' }}</td>
                                                    <td>{{ $history->amount ?? 'Full' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if (count($histories) > 0)
                                    <div class="col-md-12 text-center mt-3">
                                        <a href="{{ route('transaction-history') }}" class="btn btn-sm btn-warning">View
                                            all</a>
                                    </div>
                                @endif
                            @else
                                <div class="table-responsive">
                                    <p class="text-center">No History found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
