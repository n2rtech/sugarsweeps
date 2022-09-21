 <!-- Overlays -->
 <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
 <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight">
 </div>

 <!-- Sidebar Navigation Left -->
 <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">

     <!-- Logo -->
     <div class="logo-sn ms-d-block-lg">
         {{-- <a class="pl-0 ml-0 text-center" href="index.html"> <img src="https://via.placeholder.com/216x62" alt="logo"> </a> --}}
         <a class="pl-0 ml-0 text-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="img-responsive">
         </a>
     </div>

     <!-- Navigation -->
     <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
         <!-- Dashboard -->
         <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
             <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}">
                 <span><i class="material-icons fs-16">dashboard</i>Dashboard </span>
             </a>
         </li>
         <!-- Dashboard -->

         <!-- Gaming Accounts -->
         <li class="menu-item {{ request()->is('gaming-accounts') ? 'active' : '' }}">
             <a href="{{ route('gaming-accounts')}}" class="{{ request()->is('gaming-accounts') ? 'active' : '' }}">
                 <span><i class="fa fa-gamepad"></i>Gaming Accounts </span>
             </a>
         </li>
         <!-- Gaming Accounts -->

         <!-- Buy Credits -->
         <li class="menu-item {{ request()->is('buy-credits') ? 'active' : '' }}">
             <a href="{{ route('buy-credits')}}" class="{{ request()->is('buy-credits') ? 'active' : '' }}">
                 <span><i class="material-icons fs-16">input</i>Buy Credits </span>
             </a>
         </li>
         <!-- Buy Credits -->

         <!-- Redeem Credits -->
         <li class="menu-item {{ request()->is('redeem-credits') ? 'active' : '' }}">
             <a href="{{ route('redeem-credits')}}" class="{{ request()->is('redeem-credits') ? 'active' : '' }}">
                 <span><i class="material-icons fs-16">output</i>Redeem Credits </span>
             </a>
         </li>
         <!-- Redeem Credits -->

         <!-- Notifications -->
         <li class="menu-item {{ request()->is('notifications') ? 'active' : '' }}">
             <a href="{{ route('notifications')}}" class="{{ request()->is('notifications') ? 'active' : '' }}">
                 <span><i class="fa fa-bell"></i>Notifications </span>
             </a>
         </li>
         <!-- Notifications -->

         <!-- Transaction History -->
         <li class="menu-item {{ request()->is('transaction-history') ? 'active' : '' }}">
             <a href="{{ route('transaction-history')}}" class="{{ request()->is('transaction-history') ? 'active' : '' }}">
                 <span><i class="fas fa-dollar-sign"></i>Transaction History </span>
             </a>
         </li>
         <!-- Transaction History -->

          <!--- Settings -->
          <li class="menu-item {{ request()->is('my-account') || request()->is('my-account/*') || request()->is('change-password') ? 'active' : '' }}">
            <a href="#" class="has-chevron {{ request()->is('my-account') || request()->is('my-account/*') || request()->is('change-password') ? 'active' : '' }}" data-toggle="collapse" data-target="#settings" aria-expanded="false"
                aria-controls="settings">
                <span><i class="flaticon-gear fs-16"></i>Settings</span>
            </a>
            <ul id="settings" class="collapse {{ request()->is('my-account') || request()->is('my-account/*') || request()->is('change-password') ? 'show' : '' }}" aria-labelledby="settings" data-parent="#side-nav-accordion">
                <li> <a href="{{ route('my-account.edit', Auth::user()->id) }}" class=" {{ request()->is('my-account') || request()->is('my-account/*') ? 'active' : '' }}">My Account</a> </li>
                <li> <a href="{{ route('password.form') }}" class=" {{ request()->is('change-password') ? 'active' : '' }}">Change Password</a> </li>
            </ul>
        </li>
        <!-- Settings -->
     </ul>


 </aside>
