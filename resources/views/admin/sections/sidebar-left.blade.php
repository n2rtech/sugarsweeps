 <!-- Overlays -->
 <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
 <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight">
 </div>

 <!-- Sidebar Navigation Left -->
 <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">

     <!-- Logo -->
     <div class="logo-sn ms-d-block-lg">
         {{-- <a class="pl-0 ml-0 text-center" href="index.html"> <img src="https://via.placeholder.com/216x62" alt="logo"> </a> --}}
         <a class="pl-0 ml-0 text-center" href="{{ route('admin.dashboard') }}">
             <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="img-responsive">
         </a>
     </div>

     <!-- Navigation -->
     <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
         <!-- Dashboard -->
         <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
             <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                 <span><i class="material-icons fs-16">dashboard</i>Dashboard </span>
             </a>
         </li>
         <!-- Dashboard -->

         <!-- Players -->
         <li class="menu-item" {{ request()->is('admin/players') || request()->is('admin/players/*') ? 'active' : '' }}>
             <a href="{{ route('admin.players.index') }}"
                 class="{{ request()->is('admin/players') || request()->is('admin/players/*') ? 'active' : '' }}">
                 <span><i class="material-icons fs-16">account_box</i>Players </span>
             </a>
         </li>
         <!-- Players -->

         <!-- Cashiers -->
         <li
             class="menu-item {{ request()->is('admin/cashiers') || request()->is('admin/cashiers/*') ? 'active' : '' }}">
             <a href="{{ route('admin.cashiers.index') }}"
                 class="{{ request()->is('admin/cashiers') || request()->is('admin/cashiers/*') ? 'active' : '' }}">
                 <span><i class="fas fa-users"></i>Cashiers </span>
             </a>
         </li>
         <!-- Cashiers -->

         <!-- Gaming requests -->
         <li
             class="menu-item {{ request()->is('admin/gaming-requests') || request()->is('admin/gaming-requests/*') ? 'active' : '' }}">
             <a href="{{ route('admin.gaming-requests.index') }}"
                 class="{{ request()->is('admin/gaming-requests') || request()->is('admin/gaming-requests/*') ? 'active' : '' }}">
                 <span><i class="mdi mdi-gamepad-circle-outline"></i>Gaming Requests </span>
             </a>
         </li>
         <!-- Gaming requests -->

         <!-- Deposit requests -->
         <li
             class="menu-item {{ request()->is('admin/deposit-requests') || request()->is('admin/deposit-requests/*') ? 'active' : '' }}">
             <a href="{{ route('admin.deposit-requests.index') }}"
                 class="{{ request()->is('admin/deposit-requests') || request()->is('admin/deposit-requests/*') ? 'active' : '' }}">
                 <span><i class="mdi mdi-cube-outline"></i>Deposit Requests </span>
             </a>
         </li>
         <!-- Deposit requests -->

         <!-- Redeem requests -->
         <li
             class="menu-item {{ request()->is('admin/redeem-requests') || request()->is('admin/redeem-requests/*') || request()->is('admin/redeem-report') ? 'active' : '' }}">
             <a href="#"
                 class="has-chevron {{ request()->is('admin/redeem-requests') || request()->is('admin/redeem-requests/*') || request()->is('admin/redeem-report') ? 'active' : '' }}"
                 data-toggle="collapse" data-target="#redeem-request-menu" aria-expanded="false" aria-controls="redeem-request-menu">
                 <span><i class="mdi mdi-gift-outline"></i>Redeem Requests </span>
             </a>
             <ul id="redeem-request-menu"
                 class="collapse {{ request()->is('admin/redeem-requests') || request()->is('admin/redeem-requests/*') || request()->is('admin/redeem-report') ? 'show' : '' }}"
                 aria-labelledby="redeem-request-menu" data-parent="#side-nav-accordion">
                 <li> <a href="{{ route('admin.redeem-requests.index') }}"
                         class=" {{ request()->is('admin/redeem-requests') || request()->is('admin/redeem-requests/*') ? 'active' : '' }}">Redeem
                         Requests</a> </li>
                 <li> <a href="{{ route('admin.redeem.report') }}"
                         class=" {{ request()->is('admin/redeem-report') ? 'active' : '' }}">Redeem Report</a>
                 </li>
             </ul>
         </li>
         <!-- Redeem requests -->

          <!-- Redeem Credits -->
          <li class="menu-item {{ request()->is('admin/notification-center') ? 'active' : '' }}">
            <a href="{{ route('admin.notification-center.index')}}" class="{{ request()->is('admin/notification-center') ? 'active' : '' }}">
                <span><i class="fa fa-bell"></i>Notification Center </span>
            </a>
        </li>
        <!-- Redeem Credits -->

         <!-- Transaction History -->
         <li class="menu-item {{ request()->is('admin/transaction-history') ? 'active' : '' }}">
            <a href="{{ route('admin.transaction-history.index')}}" class="{{ request()->is('admin/transaction-history') ? 'active' : '' }}">
                <span><i class="fas fa-dollar-sign"></i>Transaction History </span>
            </a>
        </li>
        <!-- Transaction History -->

         <!-- Gaming Platforms -->
         <li
             class="menu-item {{ request()->is('admin/gaming-platforms') || request()->is('admin/gaming-platforms/*') ? 'active' : '' }}">
             <a href="{{ route('admin.gaming-platforms.index') }}"
                 class="{{ request()->is('admin/gaming-platforms') || request()->is('admin/gaming-platforms/*') ? 'active' : '' }}">
                 <span><i class="fa fa-gamepad"></i>Gaming Platforms </span>
             </a>
         </li>
         <!-- Gaming Platforms -->

         <!-- Payment Methods -->
         <li
             class="menu-item {{ request()->is('admin/payment-methods') || request()->is('admin/payment-methods/*') ? 'active' : '' }}">
             <a href="{{ route('admin.payment-methods.index') }}"
                 class="{{ request()->is('admin/payment-methods') || request()->is('admin/payment-methods/*') ? 'active' : '' }}">
                 <span><i class="mdi mdi-cash-plus fs-16"></i>Payment Methods </span>
             </a>
         </li>
         <!-- Payment Methods -->


         <!--- Settings -->
         <li
             class="menu-item {{ request()->is('admin/my-account') || request()->is('admin/my-account/*') || request()->is('admin/change-password') ? 'active' : '' }}">
             <a href="#"
                 class="has-chevron {{ request()->is('admin/my-account') || request()->is('admin/my-account/*') || request()->is('admin/change-password') ? 'active' : '' }}"
                 data-toggle="collapse" data-target="#settings" aria-expanded="false" aria-controls="settings">
                 <span><i class="flaticon-gear fs-16"></i>Settings</span>
             </a>
             <ul id="settings"
                 class="collapse {{ request()->is('admin/cashapp-setting') || request()->is('admin/my-account') || request()->is('admin/my-account/*') || request()->is('admin/change-password') ? 'show' : '' }}"
                 aria-labelledby="settings" data-parent="#side-nav-accordion">
                 <li> <a href="{{ route('admin.privacy-setting.form') }}"
                    class=" {{ request()->is('admin/privacy-setting') || request()->is('admin/privacy-setting/*') ? 'active' : '' }}">Privacy Setting</a> </li>
                <li> <a href="{{ route('admin.term-setting.form') }}"
                        class=" {{ request()->is('admin/term-setting') || request()->is('admin/term-setting/*') ? 'active' : '' }}">Term Setting</a> </li>
                 <li> <a href="{{ route('admin.cashapp.form') }}"
                    class=" {{ request()->is('admin/cashapp-setting') || request()->is('admin/cashapp-setting/*') ? 'active' : '' }}">Cash App Setting</a> </li>
                 <li> <a href="{{ route('admin.my-account.edit', Auth::guard('admin')->id()) }}"
                         class=" {{ request()->is('admin/my-account') || request()->is('admin/my-account/*') ? 'active' : '' }}">My
                         Account</a> </li>
                 <li> <a href="{{ route('admin.password.form') }}"
                         class=" {{ request()->is('admin/change-password') ? 'active' : '' }}">Change Password</a>
                 </li>
             </ul>
         </li>
         <!-- Settings -->
     </ul>


 </aside>
