@extends('layouts.app')
@section('title', 'Jays Casino')
@section('content')
    <!-- Home section -->
    <div class="home-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h1 class="home-content">Lorem Ipsum Doler Sit Amet</h1>
                </div>
                <div class="col-sm-8">
                    <img src="assets/img/gragon.png" alt="Dragon" class="img-responsive dragon">
                </div>
            </div>
        </div>
    </div>
    <!-- End Home section -->

    <!-- Game section -->
    <div class="our-game" id="four-game">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="game-content">
                        <h2>Our <span>Games</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia aliquet enim nec tempor.
                            Sed mattis mi eros, ut sagittis felis consequat ac. Vivamus neque mi, consectetur a eros ac,
                            gravida pretium tellus. </p>
                    </div>
                </div>
                <div class="col-sm-12 game-group">
                    <div class="row">
                        @foreach ($platforms as $platform)
                            <div class="col-sm-3 col-xs-6 text-center"><img
                                    @isset($platform->image) src="{{ asset('storage/uploads/gaming-platforms/' . $platform->image) }}" @else src="{{ asset('assets/img/game-placeholder.jpg') }}" @endif alt="Fire Kirrin"
                                class="img-responsive">
                                @guest
                                    <div class="game-button">
                                @endguest
                                @auth
                                <div @if (checkIfCredentialsGenerated($platform->id)) class="game-button-active" @else class="game-button"  @endif>
                            @endauth
                                    <a href="{{ $platform->download_link }}" target="_blank"
                                        class="btn btn-download">DOWNLOAD</a>
                                    @auth
                                    @if (checkIfAccountIsRequested($platform->id))
                                    @if (checkIfCredentialsGenerated($platform->id))
                                    <ul class="list-unstyled">
                                        <li>User: <p>{{ getUsername($platform->id) }}</p></li>
                                        <li>Pass: <p>{{ getPassword($platform->id) }}</p></li>
                                    </ul>
                                    @else
                                        <p class="card-text">
                                            <h4>Processing</h4>
                                        </p>
                                    @endif
                                @else
                                    <p class="card-text">
                                        <a href="{{ route('request-account', $platform->id) }}"
                                            class="btn btn-download">Request
                                            </a>
                                    </p>
                                @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- End game section -->

    <!-- Reload section -->

        <!-- (If User login) -->
        <div class="home-bg" id="reload-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="reload">
                            <h2>Reload</h2>
                        </div>
                        <div class="cash-app">
                            <div class="doller">
                                <h4>Reload With</h4><img src="assets/img/doller.png" alt="Doller" class="img-responsive">
                            </div>
                            <h4 class="cash-tag">To deposit with CashApp make sure to include Game Name/Username in the Memo
                                $Cashtag</h4>
                            <div class="cash-app-button">
                                <a href="{{ $cashapp['cashapp'] }}" target="_blank">Cashapp deposit link</a>
                            </div>
                            @guest
                                <div class="disabled">
                                <p><p><button type="button" data-toggle="modal" data-target="#loginModal">Login</button> to reload with cashapp</p> to reload with cashapp</p>
                                </div>
                            @endguest
                        </div>
                        <div class="bitcoin-app">
                            <div class="doller">
                                <h4>Reload With</h4><img src="assets/img/bitcoin.png" alt="Bitcoin" class="img-responsive">
                            </div>
                            <div class="bitcoin-form-bg">
                                <form action="" method="post"class="form-bitcoin">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label" for="input-name">Game:</label>
                                        <div class="col-sm-9">
                                            @guest
                                            <select class="form-select form-control custom-input"
                                            aria-label="Default select example">
                                                <option selected>---</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            @endguest
                                            @auth
                                            <select id="platform" class="form-select form-control custom-input @error('platform') is-invalid @enderror"
                                            name="platform" autofocus onchange="populateUsername(this);" @if (!accountExists()) disabled @endif>
                                            @if (accountExists())
                                            <option value="" selected>Select Gaming Platform</option>
                                            @foreach ($platforms as $platform)
                                                @if (platformExists($platform->id))
                                                    <option value="{{ $platform->id }}" @if (old('platform') == $platform->id) selected
                                                        @endif>{{ $platform->platform }}</option>
                                                @endif
                                            @endforeach
                                            @else
                                            <option value="" selected>No account purchased</option>
                                            @endif
                                            </select>
                                            @endauth
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label" for="input-name">User:</label>
                                        <div class="col-sm-9">
                                            <div class="game-user">
                                                <i class="mdi mdi-account-circle-outline"></i><span>Johndoe</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label" for="input-name">Amount:</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="" placeholder="$0"
                                                id="input-name" class="form-control custom-input">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-pay">PAY</button>
                                </form>
                                <div class="disabled-2">
                                    <p></p><p><button type="button" data-toggle="modal" data-target="#loginModal">Login</button> to reload with cashapp</p> to reload with cashapp<p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <!-- End reload section -->

    <!-- Redeem section -->
    @auth
        <!-- (If User login) -->
        <div class="redeem-bg" id="redeem-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="reload">
                            <h2>rede<span>em</span></h2>
                        </div>
                        <div class="redeem-form-bg">
                            <form action="" method="post"class="form-bitcoin">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Game:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-control custom-input"
                                            aria-label="Default select example">
                                            <option selected>---</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">User:</label>
                                    <div class="col-sm-9">
                                        <div class="game-user">
                                            <i class="mdi mdi-account-circle-outline"></i><span>Johndoe</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Amount:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="" placeholder="0$"
                                            id="input-name" class="form-control custom-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Payment:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-control custom-input"
                                            aria-label="Default select example">
                                            <option selected>Bitcoin</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Cashtag:</label>
                                    <div class="col-sm-9">
                                        <div class="cashtag-user">
                                            <span>$Cashtag</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Bitcoin Address:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control custom-input"
                                                placeholder="Bitcoin Address">
                                            <span class="input-group-text"><i class="mdi mdi-content-copy"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-pay">REDEEM NOW</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endauth
    @guest
        <!-- (If user as guest) -->
        <div class="redeem-bg" id="redeem-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="reload">
                            <h2>rede<span>em</span></h2>
                        </div>
                        <div class="redeem-form-bg">
                            <form action="" method="post"class="form-bitcoin">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Game:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-control custom-input"
                                            aria-label="Default select example">
                                            <option selected>---</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">User:</label>
                                    <div class="col-sm-9">
                                        <div class="game-user">
                                            <input type="hidden" name="username" id="username">
                                            <i class="mdi mdi-account-circle-outline"></i><span id="usernametext">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Amount:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="" placeholder="0$"
                                            id="input-name" class="form-control custom-input">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Payment:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-control custom-input"
                                            aria-label="Default select example">
                                            <option selected>Bitcoin</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Cashtag:</label>
                                    <div class="col-sm-9">
                                        <div class="cashtag-user">
                                            <span>$Cashtag</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">Bitcoin Address:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control custom-input"
                                                placeholder="Bitcoin Address">
                                            <span class="input-group-text"><i class="mdi mdi-content-copy"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-pay">REDEEM NOW</button>
                            </form>
                            <div class="disabled-3">
                                <p><button type="button" data-toggle="modal" data-target="#loginModal">Login</button> to reload with cashapp</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endguest

    <!-- End redeem section -->

    <!-- Contect section -->
    <div class="footer-bg text-center" id="contact-section">
        <div class="container">
            <img src="assets/img/footer-dragon.png" alt="Footer Dragon" class="img-responsive footer-dragon">
            <div class="social-info">
                <a href="#"><img src="assets/img/facebook-icon.png" alt="Facebook" class="img-responsive"></a>
            </div>
            <div class="footer-info">
                <ul class="list-unstyled">
                    <li><a href="#">Privacy Policy</a></li>
                    <li>|</li>
                    <li><a href="#">Terms and Condition</a></li>
                </ul>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                <p class="copy-right">© copyright <span>2022</span><a href="#"> dragonstakes.</a> all rights
                    reserved</p>
            </div>
        </div>
    </div>
    <!-- Contect section -->

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
                                        href="{{ route('login') }}">{{ __('Log in') }}</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Register Modal -->

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
                                        href="{{ route('register') }}">REGISTER</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End End Modal -->
@endsection
@push('scripts')
    @if ($errors->register->has('firstname') || $errors->register->has('email') || $errors->register->has('password'))
        <script>
            $(function() {
                $('#registerModal').modal({
                    show: true
                });
            });
        </script> @endif
                                    @if ($errors->has('email') || $errors->has('password'))
                                <script>
                                    $(function() {
                                        $('#loginModal').modal({
                                            show: true
                                        });
                                    });
                                </script> @endif
                                    <script>
                                        function populateUsername(sel) {
                                            var platform_id = sel.value;

                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });

                                            $.ajax({
                                                type: 'POST',
                                                url: "{{ route('populate') }}",
                                                data: {
                                                    platform_id: platform_id
                                                },
                                                success: function(data) {
                                                    $('#usernametext').text(data.success);
                                                    $('#username').val(data.success);
                                                }
                                            });


                                        }
                                    </script>
                            @endpush
