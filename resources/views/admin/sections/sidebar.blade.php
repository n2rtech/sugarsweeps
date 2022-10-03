<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Admin</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a></li>

            <li class="nav-item {{ request()->is('admin/players') || request()->is('admin/players/*') ? 'active' : '' }}"><a href="{{ route('admin.players.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Players">Players</span></a></li>

            <li class="nav-item {{ request()->is('admin/cashiers') || request()->is('admin/cashiers/*') ? 'active' : '' }}"><a href="{{ route('admin.cashiers.index') }}"><i class="feather icon-gitlab"></i><span class="menu-title" data-i18n="Cashiers">Cashiers</span></a></li>

            <li class="nav-item {{ request()->is('admin/approval-requests') || request()->is('admin/approval-requests/*') ? 'active' : '' }}"><a href="{{ route('admin.approval-requests.index') }}"><i class="feather icon-shield"></i><span class="menu-title" data-i18n="Players">Approval Requests</span></a></li>

            <li class="nav-item {{ request()->is('admin/deposit-requests') || request()->is('admin/deposit-requests/*') ? 'active' : '' }}"><a href="{{ route('admin.deposit-requests.index') }}"><i class="feather icon-download-cloud"></i><span class="menu-title" data-i18n="Deposit Requests">Deposit Requests</span></a></li>

            <li class="nav-item {{ request()->is('admin/redeem-requests') || request()->is('admin/redeem-requests/*') || request()->is('admin/redeem-report') ? 'active' : '' }}"><a href="#"><i class="feather icon-upload-cloud"></i><span class="menu-title" data-i18n="Redeem Requests">Redeem Requests</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('admin/redeem-requests') || request()->is('admin/redeem-requests/*') ? 'active' : '' }}"><a href="{{ route('admin.redeem-requests.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Redeem Requests">Redeem Requests</span></a>
                    </li>
                    <li class="{{ request()->is('admin/redeem-report') ? 'active' : '' }}"><a href="{{ route('admin.redeem.report') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Redeem Reports">Redeem Reports</span></a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ request()->is('admin/notification-center') || request()->is('admin/notification-center/*') ? 'active' : '' }}"><a href="{{ route('admin.notification-center.index') }}"><i class="feather icon-bell"></i><span class="menu-title" data-i18n="Notification Center">Notification Center</span></a></li>

            <li class="nav-item {{ request()->is('admin/transaction-history') || request()->is('admin/transaction-history/*') ? 'active' : '' }}"><a href="{{ route('admin.transaction-history.index') }}"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Transaction History">Transaction History</span></a></li>

            <li class="nav-item {{ request()->is('admin/gaming-packages') || request()->is('admin/gaming-packages/*') ? 'active' : '' }}"><a href="{{ route('admin.gaming-packages.index') }}"><i class="feather icon-star"></i><span class="menu-title" data-i18n="Gaming Packages">Gaming Packages</span></a></li>

            <li class="nav-item {{ request()->is('admin/gaming-platforms') || request()->is('admin/gaming-platforms/*') ? 'active' : '' }}"><a href="{{ route('admin.gaming-platforms.index') }}"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Gaming Platforms">Gaming Platforms</span></a></li>

            <li class="nav-item {{ request()->is('admin/payment-methods') || request()->is('admin/payment-methods/*') ? 'active' : '' }}"><a href="{{ route('admin.payment-methods.index') }}"><i class="feather icon-server"></i><span class="menu-title" data-i18n="Payment Methods">Payment Methods</span></a></li>

            <li class="nav-item {{ request()->is('admin/bulk-emails') || request()->is('admin/bulk-emails/*') ? 'active' : '' }}"><a href="{{ route('admin.bulk-emails.index') }}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Bulk Emails">Bulk Emails</span></a></li>

            <li class="nav-item {{ request()->is('admin/change-password') || request()->is('admin/my-account/*') ? 'has-sub sidebar-group-active open' : '' }}"><a href="#"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Settings">Settings</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('admin/privacy-setting') ? 'active' : '' }}"><a href="{{ route('admin.privacy-setting.form') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Privacy Page">Privacy Page</span></a>
                    </li>
                    <li class="{{ request()->is('admin/term-setting') ? 'active' : '' }}"><a href="{{ route('admin.term-setting.form') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Terms and Conditions">Terms Page</span></a>
                    </li>
                    <li class="{{ request()->is('admin/cashapp-setting') ? 'active' : '' }}"><a href="{{ route('admin.cashapp.form') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Cash App">Cash App</span></a>
                    </li>
                    <li class="{{ request()->is('admin/change-password') ? 'active' : '' }}"><a href="{{ route('admin.password.form') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Change Password">Change Password</span></a>
                    </li>
                    <li class="{{ request()->is('admin/my-account/*') ? 'active' : '' }}"><a href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="My Account">My Account</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
