@extends('layouts.front')
@section('title', 'Notifications | SugarSweeps')
@section('content')

<!-- ======= Notifications Section ======= -->
<section id="notifications" class="notifications">
    <div class="container">
        <div class="section-title">
            <h2><span class="text-primary">Notifications</span></h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-10 col-md-10 align-items-stretch m-auto">
            @if (count($notifications) > 0)
            <ul class="list-group">
                @foreach($notifications as $notification)
                @if($notification->type == 'account-approved')
                <li class="list-group-item mt-2" style="border:1px solid yellow; background:transparent; color:white">
                    <b>Welcome to Sugarsweeps!</b> Your Sugarsweeps account has been approved by the administrator.
                    <span class="float-right badge badge-danger">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                </li>
            @endif
                @if($notification->type == 'account-created')
                    <li class="list-group-item mt-2" style="border:1px solid yellow; background:transparent; color:white">
                        Your <b>{{ $notification->data->platform->platform }}</b> account has been created with username - <b>{{ $notification->data->username }}</b> and password - <b>{{ $notification->data->password }}</b>.
                        <span class="float-right badge badge-danger">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                    </li>
                @endif

                @if($notification->type == 'credit-added')
                    <li class="list-group-item mt-2" style="border:1px solid yellow; background:transparent; color:white">
                       Your {{ $notification->data->platform->platform }} account has been credited with ${{ $notification->data->amount }} credit.
                       <span class="float-right badge badge-danger">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span>
                    </li>
                @endif

                @if($notification->type == 'redeem-done')
                    <li class="list-group-item mt-2" style="border:1px solid yellow; background:transparent; color:white">Your request to redeem @if($notification->data->redeem_full == 'yes' ) all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account has been accepted.<span class="float-right badge badge-danger">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
                @endif

                @if($notification->type == 'redeem-rejected')
                    <li class="list-group-item mt-2" style="border:1px solid yellow; background:transparent; color:white">Your request to redeem @if($notification->data->redeem_full == 'yes' ) all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account has been rejected.</li>
                @endif

                @if($notification->type == 'notification')
                <li class="list-group-item mt-2" style="border:1px solid yellow; background:transparent; color:white">Message from admin: {{ $notification->message }}<span class="float-right badge badge-danger">{{ Carbon\Carbon::parse($notification->created_at)->format('d-m-Y h:i:s') }}</span></li>
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
</section>
<!-- ======= End Notifications Section ======= -->
@endsection
