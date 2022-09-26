@extends('layouts.admin')
@section('title', 'Notification Center')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Notification Center</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <a href="{{ route('admin.notification-center.create') }}"
                    class="btn btn-info btn-md waves-effect waves-light">Create</a>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @include('admin.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="list-group">
                    @foreach($notifications as $notification)
                    @if($notification->type == 'request-account')
                        <li class="list-group-item"><a href="{{ route('admin.players.edit', $notification->user->id) }}">{{ $notification->user->firstname }} {{ $notification->user->lastname }}</a> has requested {{ $notification->data->platform->platform }} account. <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @if($notification->type == 'credit-requested')
                        <li class="list-group-item"><a href="{{ route('admin.players.edit', $notification->user->id) }}">{{ $notification->user->firstname }} {{ $notification->user->lastname }}'s </a> {{ $notification->data->platform->platform }} account has been credited with ${{ $notification->data->amount }} credit. <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @if($notification->type == 'redeem-request')
                        <li class="list-group-item"><a href="{{ route('admin.players.edit', $notification->user->id) }}">{{ $notification->user->firstname }} {{ $notification->user->lastname }}</a> has requested to redeem @if($notification->data->redeem_full == "yes") all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account.<span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @endforeach
                </ul>

                @if(count($notifications) < 1)
                    <div class="col-sm-12 text-center mt-3">
                        <p> No notification found.</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{ $notifications->links('vendor.pagination.bootstrap-4') }}
@endsection
