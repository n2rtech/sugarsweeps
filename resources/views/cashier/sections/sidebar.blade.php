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
