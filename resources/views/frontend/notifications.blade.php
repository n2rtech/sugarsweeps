@extends('layouts.app')
@section('title', 'Transaction History')
@section('content')

    @include('frontend.sections.flashmessage')
<div class="home-bg" id="reload-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="reload">
                    <h2>Notifications</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="mt-5">
        <div class="row">
            <div class="col-md-12 roboto-font">
                @if (count($notifications) > 0)
                <ul class="list-group">
                    @foreach($notifications as $notification)
                    @if($notification->type == 'account-created')
                        <li class="list-group-item">
                            Your <b>{{ $notification->data->platform->platform }}</b> account has been created with username - <b>{{ $notification->data->username }}</b> and password - <b>{{ $notification->data->password }}</b>.
                            <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                        </li>
                    @endif

                    @if($notification->type == 'credit-added')
                        <li class="list-group-item">
                           Your {{ $notification->data->platform->platform }} account has been credited with ${{ $notification->data->amount }} credit.
                           <span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                        </li>
                    @endif

                    @if($notification->type == 'redeem-done')
                        <li class="list-group-item">Your request to redeem @if($notification->data->redeem_full == 'yes' ) all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account has been accepted.<span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @if($notification->type == 'redeem-rejected')
                        <li class="list-group-item">Your request to redeem @if($notification->data->redeem_full == 'yes' ) all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account has been rejected.</li>
                    @endif

                    @if($notification->type == 'notification')
                    <li class="list-group-item">Message from admin: {{ $notification->message }}<span class="float-right badge badge-light">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                    @endif

                    @endforeach
                </ul>
                    <div class="col-sm-12">
                        {{ $notifications->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <p class="text-center">No Notifications found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div style="margin-top: 10rem!important;">
    @include('frontend.footer')
</div>
@endsection
