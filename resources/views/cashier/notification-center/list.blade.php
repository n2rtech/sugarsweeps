@extends('layouts.cashier')
@section('title', 'Notification Center')
@section('content')

<!-- end page title -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Notifications</h4>
                    <ul class="list-group">
                        @foreach($notifications as $notification)
                        @if($notification->type == 'request-account')
                            <li class="list-group-item"><a href="{{ route('cashier.players.show', $notification->user->id) }}">{{ $notification->user->firstname }} {{ $notification->user->lastname }}</a> has requested {{ $notification->data->platform->platform }} account. <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                        @endif

                        @if($notification->type == 'credit-requested')
                            <li class="list-group-item"><a href="{{ route('cashier.players.show', $notification->user->id) }}">{{ $notification->user->firstname }} {{ $notification->user->lastname }}'s </a> {{ $notification->data->platform->platform }} account has been credited with ${{ $notification->data->amount }} credit. <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                        @endif

                        @if($notification->type == 'redeem-request')
                            <li class="list-group-item"><a href="{{ route('cashier.players.show', $notification->user->id) }}">{{ $notification->user->firstname }} {{ $notification->user->lastname }}</a> has requested to redeem @if($notification->data->redeem_full == "yes") all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account.<span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                        @endif

                        @endforeach
                    </ul>

                    <div class="mt-3">
                        {{ $notifications->links('vendor.pagination.bootstrap-4') }}
                    </div>
                    @if(count($notifications) < 1)
                        <div class="col-sm-12 text-center mt-3">
                            <p> No notification found.</a>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
