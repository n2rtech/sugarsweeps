 <!-- Overlays -->
 <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
 <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight">
 </div>

 <!-- Sidebar Navigation Left -->
 <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">

     <!-- Logo -->
     <div class="logo-sn ms-d-block-lg">
         {{-- <a class="pl-0 ml-0 text-center" href="index.html"> <img src="https://via.placeholder.com/216x62" alt="logo"> </a> --}}
         <a class="pl-0 ml-0 text-center" href="{{ route('cashier.dashboard') }}">
             <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="img-responsive">
         </a>
     </div>

     <!-- Navigation -->
     <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
         <!-- Dashboard -->
         <li class="menu-item">
             <a href="{{ route('cashier.dashboard') }}">
                 <span><i class="material-icons fs-16">dashboard</i>Dashboard </span>
             </a>
         </li>
         <!-- Dashboard -->

         <!-- Players -->
         <li class="menu-item"
             {{ request()->is('cashier/players') || request()->is('cashier/players/*') ? 'active' : '' }}>
             <a href="{{ route('cashier.players.index') }}"
                 class="{{ request()->is('cashier/players') || request()->is('cashier/players/*') ? 'active' : '' }}">
                 <span><i class="material-icons fs-16">account_box</i>Players </span>
             </a>
         </li>
         <!-- Players -->

         <!-- Gaming requests -->
         <li
             class="menu-item {{ request()->is('cashier/gaming-requests') || request()->is('cashier/gaming-requests/*') ? 'active' : '' }}">
             <a href="{{ route('cashier.gaming-requests.index') }}"
                 class="{{ request()->is('cashier/gaming-requests') || request()->is('cashier/gaming-requests/*') ? 'active' : '' }}">
                 <span><i class="mdi mdi-gamepad-circle-outline"></i>Gaming Requests </span>
             </a>
         </li>
         <!-- Gaming requests -->

         <!-- Deposit requests -->
         <li
             class="menu-item {{ request()->is('cashier/deposit-requests') || request()->is('cashier/deposit-requests/*') ? 'active' : '' }}">
             <a href="{{ route('cashier.deposit-requests.index') }}"
                 class="{{ request()->is('cashier/deposit-requests') || request()->is('cashier/deposit-requests/*') ? 'active' : '' }}">
                 <span><i class="mdi mdi-cube-outline"></i>Deposit Requests </span>
             </a>
         </li>
         <!-- Deposit requests -->

         <!-- Redeem requests -->
         <li
             class="menu-item {{ request()->is('cashier/redeem-requests') || request()->is('cashier/redeem-requests/*') ? 'active' : '' }}">
             <a href="{{ route('cashier.redeem-requests.index') }}"
                 class="{{ request()->is('cashier/redeem-requests') || request()->is('cashier/redeem-requests/*') ? 'active' : '' }}">
                 <span><i class="mdi mdi-gift-outline"></i>Redeem Requests </span>
             </a>
         </li>
         <!-- Redeem requests -->

         <!-- Notification -->
         <li class="menu-item {{ request()->is('cashier/notification-center') ? 'active' : '' }}">
             <a href="{{ route('cashier.notification-center.index') }}"
                 class="{{ request()->is('cashier/notification-center') ? 'active' : '' }}">
                 <span><i class="fa fa-bell"></i>Notification Center </span>
             </a>
         </li>
         <!-- Notification -->

         <!-- Transaction History -->
         <li class="menu-item {{ request()->is('cashier/transaction-history') ? 'active' : '' }}">
             <a href="{{ route('cashier.transaction-history.index') }}"
                 class="{{ request()->is('cashier/transaction-history') ? 'active' : '' }}">
                 <span><i class="fas fa-dollar-sign"></i>Transaction History </span>
             </a>
         </li>
         <!-- Transaction History -->


         <!--- User Management -->
         <li class="menu-item">
             <a href="#" class="has-chevron" data-toggle="collapse" data-target="#settings" aria-expanded="false"
                 aria-controls="settings">
                 <span><i class="flaticon-gear"></i>Settings</span>
             </a>
             <ul id="settings" class="collapse" aria-labelledby="settings" data-parent="#side-nav-accordion">
                 <li> <a href="{{ route('cashier.my-account.edit', Auth::guard('cashier')->id()) }}">My Account</a>
                 </li>
                 <li> <a href="{{ route('cashier.password.form') }}">Change Password</a> </li>
             </ul>
         </li>
         <!-- User Management -->
     </ul>


 </aside>
