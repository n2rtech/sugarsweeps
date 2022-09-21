<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login | DragonStakes</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('vendors/iconic-fonts/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/flat-icons/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <!-- Page Specific CSS (Slick Slider.css) -->
    <link href="{{asset('assets/css/slick.css')}}" rel="stylesheet">
    <!-- Greendash styles -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon.ico')}}">
    @yield('head')
</head>

<body class="ms-body ms-primary-theme ms-logged-out">

    @include('admin.sections.loader')



    <!-- Main Content -->
    <main class="body-content">

        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper ms-auth">

            <div class="ms-auth-container">
                <div class="ms-auth-col">
                    <div class="ms-admin-auth-bg"></div>
                </div>
                <div class="ms-auth-col">
                    <div class="ms-auth-form">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <h1>Admin Login</h1>
                            <p>Please enter your email and password to continue</p>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select class="form-control" id="role"
                                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="{{ route('admin.login') }}" selected>Admin</option>
                                    <option value="{{ route('cashier.login') }}">Cashier</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" placeholder="Email Address"
                                        name="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="ms-checkbox-wrap">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <i class="ms-checkbox-check"></i>
                                </label>
                                <span> Remember Password </span>
                            </div>
                            <button class="btn btn-primary mt-4 d-block w-100" type="submit">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </main>




    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js')}}"> </script>
    <script src="{{ asset('assets/js/jquery-ui.min.js')}}"> </script>
    <!-- Global Required Scripts End -->

    <!-- Page Specific Scripts Start -->
    @stack('scripts')
    <!-- Page Specific Scripts End -->

    <!-- Greendash core JavaScript -->
    <script src="{{ asset('assets/js/framework.js') }}"></script>

    <!-- Settings -->
    <script src="{{ asset('assets/js/settings.js') }}"></script>

</body>

</html>
