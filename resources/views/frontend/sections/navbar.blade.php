<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-xl-9 d-flex align-items-center justify-content-between">
                <h1 class="logo"><a href="{{ route('index') }}">Sugar Sweeps</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <li class="active"><a href="{{ route('index') }}">Home</a></li>
                        <li><a @if(request()->is('/')) href="#games" @else href="{{route('index')}}#games" @endif>Games</a></li>
                        <li><a @if(request()->is('/')) href="#reload" @else href="{{route('index')}}#reload" @endif>Reload</a></li>
                        <li><a @if(request()->is('/')) href="#redeem" @else href="{{route('index')}}#redeem" @endif>Redeem</a></li>
                        <li><a @if(request()->is('/')) href="#contact" @else href="{{route('index')}}#contact" @endif>Contact</a></li>

                    </ul>
                </nav><!-- .nav-menu -->
                @guest
                    <a href="{{ route('login') }}" class="get-started-btn scrollto">Login</a>
                    <a href="{{ route('register') }}" class="btn-register">Register</a>
                @endguest
                @auth
                <button class="btn-logout dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-regular fa-circle-user"></i> <span>{{ Auth::user()->name }}</span></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('settings') }}"><i class="fa fa-gear"></i>  Settings</a>
                    <a class="dropdown-item" href="{{ route('notifications') }}"><i class="fa fa-bell"></i>  Notifications</a>
                    <a class="dropdown-item" href="{{ route('transactions') }}"><i class="fa fa-dollar"></i>  Transactions</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-right-from-bracket"></i> Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </div>
                @endauth
            </div>
        </div>

    </div>
</header><!-- End Header -->
