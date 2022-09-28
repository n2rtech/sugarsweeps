<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('cashier.dashboard') }}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Cashier</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('cashier') ? 'active' : '' }}"><a href="{{ route('cashier.dashboard') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>

            <li class="nav-item {{ request()->is('cashier/players') || request()->is('cashier/players/*') ? 'active' : '' }}"><a href="{{ route('cashier.players.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Players">Players</span></a></li>


            <li class="nav-item {{ request()->is('cashier/approval-requests') || request()->is('cashier/approval-requests/*') ? 'active' : '' }}"><a href="{{ route('cashier.approval-requests.index') }}"><i class="feather icon-shield"></i><span class="menu-title" data-i18n="Players">Approval Requests</span></a></li>

            <li class="nav-item {{ request()->is('cashier/deposit-requests') || request()->is('cashier/deposit-requests/*') ? 'active' : '' }}"><a href="{{ route('cashier.deposit-requests.index') }}"><i class="feather icon-download-cloud"></i><span class="menu-title" data-i18n="Deposit Requests">Deposit Requests</span></a></li>

            <li class="nav-item {{ request()->is('cashier/redeem-requests') || request()->is('cashier/redeem-requests/*') ? 'active' : '' }}"><a href="{{ route('cashier.redeem-requests.index') }}"><i class="feather icon-upload-cloud"></i><span class="menu-title" data-i18n="Redeem Requests">Redeem Requests</span></a></li>


            <li class="nav-item {{ request()->is('cashier/notification-center') || request()->is('cashier/notification-center/*') ? 'active' : '' }}"><a href="{{ route('cashier.notification-center.index') }}"><i class="feather icon-bell"></i><span class="menu-title" data-i18n="Notification Center">Notification Center</span></a></li>

            <li class="nav-item {{ request()->is('cashier/transaction-history') || request()->is('cashier/transaction-history/*') ? 'active' : '' }}"><a href="{{ route('cashier.transaction-history.index') }}"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Transaction History">Transaction History</span></a></li>


            <li class="nav-item {{ request()->is('cashier/change-password') || request()->is('cashier/my-account/*') ? 'has-sub sidebar-group-active open' : '' }}"><a href="#"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce">Settings</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('cashier/change-password') ? 'active' : '' }}"><a href="{{ route('cashier.password.form') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Change Password</span></a>
                    </li>
                    <li class="{{ request()->is('cashier/my-account/*') ? 'active' : '' }}"><a href="{{ route('cashier.my-account.edit', Auth::guard('cashier')->id()) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">My Account</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
