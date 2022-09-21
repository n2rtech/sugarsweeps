<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendors/iconic-fonts/flat-icons/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconic-fonts/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ asset('assets/css/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- Greendash styles -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> -->

    <link href="{{ asset('assets/css/frontend.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @yield('head')
</head>

<body class="ms-body ms-primary-theme ">

    @include('admin.sections.loader')


    <!-- Main Content -->
    <main class="body-content">

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
            <div class="container">
               <div class="logo-sn logo-sm">
                <a class="navbar-brand" href="{{ route('index') }}"> <img src="{{ asset('assets/img/Logo.png') }}" alt="Logo" class="img-responsive"></a>
            </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <i class="mdi mdi-menu"></i>
                </button>

              <div class="collapse navbar-collapse flex-row-reverse" id="navbarSupportedContent">
                <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">
                <li class="ms-nav-item mobile-menu">
                    <a href="{{ route('index') }}">Home</i></a>
                </li>
                <li class="ms-nav-item mobile-menu">
                    @if(request()->is('/'))
                    <a href="#four-game">Games</i></a>
                    @else
                    <a href="{{route('index')}}#four-game">Games</i></a>
                    @endif
                </li>
                <li class="ms-nav-item mobile-menu">
                    @if(request()->is('/'))
                    <a href="#reload-section">Reload</i></a>
                    @else
                    <a href="{{route('index')}}#reload-section">Reload</i></a>
                    @endif
                </li>
                <li class="ms-nav-item mobile-menu">
                    @if(request()->is('/'))
                    <a href="#redeem-section">Redeem</i></a>
                    @else
                    <a href="{{route('index')}}#redeem-section">Redeem</i></a>
                    @endif
                </li>
                <li class="ms-nav-item mobile-menu">
                    @if(request()->is('/'))
                    <a href="#contact-section">Contact</i></a>
                    @else
                    <a href="{{route('index')}}#contact-section">Contact</i></a>
                    @endif
                </li>
                @guest
                <li class="ms-nav-item custom-login mobile-menu">
                    <button type="button" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"><i class="mdi mdi-login"></i>Login</button>
                </li>
                <li class="ms-nav-item custom-login mobile-menu">
                    <button type="button" data-toggle="modal" data-target="#registerModal" data-dismiss="modal"><i class="mdi mdi-file-document-edit"></i>Register</button>
                </li>
                @endguest
                @auth
                <li class="ms-nav-item user-login mobile-menu dropdown">
                    <a href="{{ route('home') }}" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-account-circle-outline"></i>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</i></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="{{ route('setting') }}"><i class="mdi mdi-tools"></i>Setting</a>
                      <a class="dropdown-item" href="{{ route('transaction-history')}}"><i class="mdi mdi-currency-usd"></i>Transaction History</a>
                      <a class="dropdown-item" href="{{ route('notifications')}}"><i class="mdi mdi-bell"></i>Notification</a>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="mdi mdi-logout"></i>Logout</i></a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </div>
                </li>
                @endauth
            </ul>
              </div>
            </div>
        </nav>


        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper">
            @include('admin.sections.flashmessage')
            @yield('content')
              <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-login text-center">
                        <img src="assets/img/login-logo.png" alt="Login" class="img-responsive">
                        <h3>Account Login</h3>
                    </div>
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input id="email" type="email"
                                        class="form-control login-input @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        autofocus placeholder="Your email ">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input id="password" type="password"
                                        class="form-control login-input @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password"
                                        placeholder="Your password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label remember" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot-pass">
                                @if (Route::has('password.request'))
                                    <a class="nav-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-pay">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12 text-center">
                                <p class="account-message">Don't have an account? <a
                                        href="#" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">REGISTER</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End End Modal -->

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-login text-center">
                        <img src="assets/img/login-logo.png" alt="Login" class="img-responsive">
                        <h3>Register New Account</h3>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input id="firstname" type="text"
                                        class="form-control login-input @if ($errors->register->has('firstname')) is-invalid @endif"
                                        name="firstname" value="{{ old('firstname') }}" autocomplete="firstname"
                                        placeholder="Firstname" autofocus>
                                </div>
                                @if ($errors->register->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input id="lastname" type="text"
                                        class="form-control login-input @error('lastname') is-invalid @enderror"
                                        name="lastname" value="{{ old('lastname') }}" autocomplete="lastname"
                                        placeholder="Lastname" autofocus>
                                </div>
                                @if ($errors->register->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone Number</label>
                                    <input id="phone" type="tel"
                                        class="form-control login-input @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" autocomplete="phone"
                                        placeholder="Phone Number" autofocus>
                                </div>
                                @if ($errors->register->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email Address</label>
                                    <input id="email" type="email"
                                        class="form-control login-input @if ($errors->register->has('email')) is-invalid @endif"
                                        name="email" value="{{ old('email') }}" placeholder="Email Address"
                                        autocomplete="email">
                                </div>
                                @if ($errors->register->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input id="password" type="password"
                                        class="form-control login-input @if ($errors->register->has('password')) is-invalid @endif"
                                        placeholder="Password" name="password" autocomplete="new-password">
                                </div>
                                @if ($errors->register->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control login-input"
                                        name="password_confirmation" placeholder="Confirm Password"
                                        autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label remember" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-pay">
                                    {{ __('Create an account') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <p class="account-message">Already have an account ? <a
                                        href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">{{ __('Log in') }}</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Register Modal -->
        </div>

    </main>




    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- Global Required Scripts End -->

    <!-- Page Specific Scripts Start -->
    @stack('scripts')
    <!-- Page Specific Scripts End -->

    <!-- Greendash core JavaScript -->
    <script src="{{ asset('assets/js/framework.js') }}"></script>

    <!-- Settings -->
    <script src="{{ asset('assets/js/settings.js') }}"></script>
      <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6086967662662a09efc227be/1f46rngfd';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
@if(request()->is('/'))
    <script>
        $(document).ready(function(){
            $(this).scrollTop(0);
        });
    </script>
    @endif
    <!--End of Tawk.to Script-->
</body>

</html>
