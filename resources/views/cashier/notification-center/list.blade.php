@extends('layouts.cashier')
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
</div>
<div class="content-body">
    @include('cashier.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="list-group">
                    @foreach($notifications as $notification)
                    @if($notification->type == 'request-account')
                        <li class="list-group-item"><a href="{{ route('cashier.players.show', $notification->user->id) }}">{{ $notification->user->name }}</a> has requested a new Sugarsweeps account. <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @if($notification->type == 'credit-requested')
                        <li class="list-group-item"><a href="{{ route('cashier.players.show', $notification->user->id) }}">{{ $notification->user->name }} </a> has requested to load credits worth ${{ $notification->data->amount }} in {{ $notification->data->platform->platform }} account. <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @if($notification->type == 'redeem-request')
                        <li class="list-group-item"><a href="{{ route('cashier.players.show', $notification->user->id) }}">{{ $notification->user->name }}</a> has requested to redeem @if($notification->data->redeem_full == "yes") all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account.<span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
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
