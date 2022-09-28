<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="navbar-collapse" id="navbar-mobile">
          <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav">
              <li class="nav-item mobile-menu d-xl-none mr-auto">
                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                  <i class="ficon feather icon-menu"></i>
                </a>
              </li>
            </ul>
          </div>
          <ul class="nav navbar-nav float-right">
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link nav-link-expand">
                <i class="ficon feather icon-maximize"></i>
              </a>
            </li>
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                <i class="ficon feather icon-bell"></i>
                @if(getLatestAdminNotificationsCount() > 0)
                <span class="badge badge-pill badge-primary badge-up">{{ getLatestAdminNotificationsCount() }}</span>
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <div class="dropdown-header m-0 p-2">
                    <h3 class="white">{{ getLatestAdminNotificationsCount() }} New</h3>
                    <span class="notification-title">App Notifications</span>
                  </div>
                </li>
                @php
                    $latest_notifications = getLatestAdminNotifications();
                @endphp
                <li class="scrollable-container media-list">
                    @foreach ($latest_notifications as $notification)
                    @if($notification->type == 'request-account')
                        <a class="d-flex justify-content-between" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <i class="feather icon-shield font-medium-5 warning"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="primary media-heading">New Registration!</h6>
                                <small class="notification-text"> <a href="{{ route('admin.players.edit', $notification->user->id) }}">{{ $notification->user->name }}</a> has requested a Sugarsweeps account.</small>
                            </div>
                            <small>
                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">{{ $notification->created_at->diffForHumans() }}</time>
                            </small>
                            </div>
                        </a>
                    @endif
                    @if($notification->type == 'credit-requested')
                        <a class="d-flex justify-content-between" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <i class="feather icon-download-cloud font-medium-5 success"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="primary media-heading">New Deposit Request!</h6>
                                <small class="notification-text"><a href="{{ route('admin.players.edit', $notification->user->id) }}">{{ $notification->user->name }} </a> has requested to load credits worth ${{ $notification->data->amount }} in {{ $notification->data->platform->platform }} account. </small>
                            </div>
                            <small>
                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">{{ $notification->created_at->diffForHumans() }}</time>
                            </small>
                            </div>
                        </a>
                    @endif
                    @if($notification->type == 'redeem-request')
                        <a class="d-flex justify-content-between" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <i class="feather icon-upload-cloud font-medium-5 danger"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="primary media-heading">New Redeem Request!</h6>
                                <small class="notification-text"><a href="{{ route('admin.players.edit', $notification->user->id) }}">{{ $notification->user->name }}</a> has requested to redeem @if($notification->data->redeem_full == "yes") all  @else worth ${{ $notification->data->amount }} @endif credits from {{ $notification->data->platform->platform }} account.</small>
                            </div>
                            <small>
                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">{{ $notification->created_at->diffForHumans() }}</time>
                            </small>
                            </div>
                        </a>
                    @endif
                  @endforeach
                </li>
                @if(getLatestAdminNotificationsCount() > 0)
                <li class="dropdown-menu-footer">
                  <a class="dropdown-item p-1 text-center" href="{{ route('admin.notification-center.index') }}">Read all notifications</a>
                </li>
                @endif
              </ul>
            </li>
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <div class="user-nav d-sm-flex d-none">
                  <span class="user-name text-bold-600">{{ Auth::guard('admin')->user()->name }}</span>
                  <span class="user-status">Administrator</span>
                </div>
                <span>
                  <img class="round" src="{{  isset(Auth::guard('admin')->user()->avatar) ? asset('storage/uploads/admin/'.Auth::guard('admin')->user()->avatar) : asset('assets/images/profile/user-uploads/user-00.png') }}" alt="avatar" height="40" width="40">
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}">
                  <i class="feather icon-user"></i> My Account </a>
                <a class="dropdown-item" href="{{ route('admin.password.form') }}">
                  <i class="feather icon-lock"></i> Change Password </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="feather icon-power"></i> Logout </a>
                <form id="logout-form" action="{{ 'App\Models\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('admin.logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
