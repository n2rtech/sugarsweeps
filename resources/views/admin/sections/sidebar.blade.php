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

            <li class="nav-item {{ request()->is('admin/gaming-platforms') || request()->is('admin/gaming-platforms/*') ? 'active' : '' }}"><a href="{{ route('admin.gaming-platforms.index') }}"><i class="feather icon-zap"></i><span class="menu-title" data-i18n="Gaming Patforms">Gaming Patforms</span></a></li>

            <li class="nav-item {{ request()->is('admin/payment-methods') || request()->is('admin/payment-methods/*') ? 'active' : '' }}"><a href="{{ route('admin.payment-methods.index') }}"><i class="feather icon-server"></i><span class="menu-title" data-i18n="Payment Methods">Payment Methods</span></a></li>

            <li class="nav-item {{ request()->is('admin/change-password') || request()->is('admin/my-account/*') ? 'has-sub sidebar-group-active open' : '' }}"><a href="#"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce">Settings</span></a>
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
