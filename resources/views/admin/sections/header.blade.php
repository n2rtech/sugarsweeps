    <!-- Navigation Bar -->
    <nav class="navbar ms-navbar">

        <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft">
            <span class="ms-toggler-bar bg-primary"></span>
            <span class="ms-toggler-bar bg-primary"></span>
            <span class="ms-toggler-bar bg-primary"></span>
        </div>

        <div class="logo-sn logo-sm ms-d-block-sm">
            <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="img-responsive">
            </a>
        </div>

        <ul class="ms-inline mb-0" id="ms-nav-options">
            @php
                $admin_notifications = getLatestAdminNotifications();
            @endphp
            <li class="ms-nav-item dropdown notification-list">
                @if(count($admin_notifications) > 0)
                <a href="#" class="text-white" id="notificationDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon-bell"></i>
                    <span id="notification-count" class="text-center"></span>
                </a>
                @else
                <a href="#" class="text-white" id="notificationDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon-bell"></i></a>
                @endif

                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                    <li class="dropdown-menu-header">
                        <h6 class="dropdown-header ms-inline m-0 text-center"><span class="text-disabled">Notifications</span></h6>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="ms-scrollable ms-dropdown-list">

                        @foreach ($admin_notifications as $notification)
                            <a class="media p-2" href="javascript:void(0)">
                                <div class="media-body">
                                    @if ($notification->type == 'request-account')
                                        <span>{{ $notification->user->firstname }}
                                                {{ $notification->user->lastname }} has requested
                                            {{ $notification->data->platform->platform }} account. </span>
                                    @endif

                                    @if ($notification->type == 'credit-requested')
                                        <span>{{ $notification->user->firstname }}
                                                {{ $notification->user->lastname }}'s
                                            {{ $notification->data->platform->platform }} account has been credited with
                                            ${{ $notification->data->amount }} credit. </span>
                                    @endif

                                    @if ($notification->type == 'redeem-request')
                                        <span>{{ $notification->user->firstname }} {{ $notification->user->lastname }} has requested to redeem @if($notification->data->redeem_full == "yes") all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account.</span>
                                    @endif
                                    <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> {{$notification->created_at->diffForHumans()}}</p>
                                </div>
                            </a>
                        @endforeach
                    </li>
                    @if(count($admin_notifications) > 0)
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-menu-footer text-center">

                        <a href="{{ route('admin.notification-center.index') }}">View all Notifications</a>
                    </li>
                    @else
                    <li class="dropdown-menu-footer text-center">
                    <p>No New Notification</p>
                    </li>
                    @endif
                </ul>
            </li>

            <li class="ms-nav-item ms-nav-user dropdown">
                <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="ms-user-img ms-img-round float-right" src="{{ asset('assets/img/avatar.png') }}"
                        alt="people"> </a>
                <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
                    <li class="dropdown-menu-header">
                        <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Welcome
                                {{ Auth::guard('admin')->user()->firstname }}
                                {{ Auth::guard('admin')->user()->lastname }}</span></h6>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="ms-dropdown-list">
                        <a class="media fs-14 p-2"
                            href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}"> <span><i
                                    class="flaticon-gear mr-2"></i> My Account</span> </a>
                    </li>
                    <li class="dropdown-menu-footer">
                        <a class="media fs-14 p-2" href="{{ route('admin.password.form') }}"> <span><i
                                    class="flaticon-security mr-2"></i> Change Password</span> </a>
                    </li>
                    <li class="dropdown-divider"></li>

                    <li class="dropdown-menu-footer">
                        <a class="media fs-14 p-2" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span><i
                                    class="flaticon-shut-down mr-2"></i> Logout</span> </a>
                        <form id="logout-form"
                            action="{{ 'App\Models\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('logout') }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
            <span class="ms-toggler-bar bg-primary"></span>
            <span class="ms-toggler-bar bg-primary"></span>
            <span class="ms-toggler-bar bg-primary"></span>
        </div> -->

    </nav>
