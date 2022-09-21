@extends('layouts.app')
@section('title', 'DragonStakes')
@section('content')
    <!-- Home section -->
    <div class="home-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h1 class="home-content">Play The Best Online Sweepstakes Slots and Fish Games</h1>
                </div>
                <div class="col-sm-8">
                    <img src="{{ asset('assets/img/gragon.png') }}" alt="Dragon" class="img-responsive dragon">
                </div>
            </div>
        </div>
    </div>
    <div class="our-game" id="four-game">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="game-content">
                        <h2>Our <span>Games</span></h2>
                        <p>
                            We provide the most popular games in the market. Register an account, request a username and password for the game you want to play, then reload your account and WIN BIG! Request to redeem at any time from your DragonStakes account.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 game-group">
                    <div class="row">
                        @foreach ($platforms as $platform)
                            <div class="col-sm-3 col-xs-6 casino-game text-center">
                                @guest
                                    <img src="{{ $platform->image }}" alt="{{ $platform->platform }}">
                                    <div class="game-button">
                                        <a href="{{ $platform->download_link }}" target="_blank"
                                            class="btn btn-download">DOWNLOAD</a>
                                    </div>
                                @endguest
                                @auth
                                    <img src="{{ $platform->image }}" alt="{{ $platform->platform }}">
                                    @if (checkIfAccountIsRequested($platform->id))
                                        @if (checkIfCredentialsGenerated($platform->id))
                                            <div class="game-button-active">
                                                <a href="{{ $platform->download_link }}" target="_blank"
                                                    class="btn btn-download">DOWNLOAD</a>
                                                <ul class="list-unstyled">
                                                    <li>Username: <p>{{ getUsername($platform->id) }}</p>
                                                    </li>
                                                    <li>Password: <p>{{ getPassword($platform->id) }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="game-button">
                                                <a href="{{ $platform->download_link }}" target="_blank"
                                                    class="btn btn-download">DOWNLOAD</a>
                                                <p class="card-text">
                                                    <h4>PROCESSING</h4>
                                                </p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="game-button">
                                            <a href="{{ $platform->download_link }}" target="_blank"
                                                class="btn btn-download">DOWNLOAD</a>
                                            <p class="card-text">
                                                <a href="{{ route('request-account', $platform->id) }}"
                                                    class="btn btn-download">REQUEST</a>
                                            </p>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-bg" id="reload-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="reload">
                        <h2>Reload</h2>
                    </div>
                    <!-- Start cashapp reload section -->
                    <div class="cash-app">
                        <div class="doller">
                            <h4>Reload With</h4><img src="{{ asset('assets/img/doller.png') }}" alt="Doller"
                                class="img-responsive">
                        </div>
                        <h4 class="cash-tag">To deposit with CashApp make sure to include Game Name/Username in the Memo
                            $Cashtag</h4>
                        <div class="cash-app-button">
                            <a href="{{ $cashapp['cashapp'] }}" target="_blank">Cashapp deposit link</a>
                        </div>
                        @guest
                            <div class="disabled">
                                <p><button type="button" data-toggle="modal" data-target="#loginModal">Login</button> to reload
                                    with cashapp</p>
                            </div>
                        @endguest
                    </div>
                    <!-- End cashapp reload section -->

                    <!-- Start bitcoin reload section -->
                    <div class="bitcoin-app">
                        <div class="doller">
                            <h4>Reload With</h4><img src="{{ asset('assets/img/bitcoin.png') }}" alt="Bitcoin"
                                class="img-responsive">
                        </div>
                        <div class="bitcoin-form-bg">
                            <form action="{{ route('create.payment') }}" method="post" class="form-bitcoin"
                                id="form-bitcoin">
                                @csrf

                                <div class="form-group row">
                                    <label for="platform"
                                        class="col-md-3 control-label text-md-end">{{ __('Game') }}</label>
                                    <div class="col-md-9">
                                        @guest
                                            <select id="platform"
                                                class="form-select form-control custom-input @error('platform') is-invalid @enderror"
                                                name="platform" autofocus>
                                                <option value="" selected> {{ __('Select Game') }}</option>
                                                @foreach ($platforms as $platform)
                                                    <option value="{{ $platform->id }}"
                                                        {{ old('platform') == $platform->id ? 'selected' : '' }}>
                                                        {{ $platform->platform }}</option>
                                                @endforeach
                                            </select>
                                        @endguest
                                        @auth
                                            <select id="platform"
                                                class="form-select form-control custom-input @error('platform') is-invalid @enderror"
                                                name="platform" autofocus onchange="populateUsername(this);"
                                                @if (!accountExists()) disabled @endif>
                                                @if (accountExists())
                                                    <option value="" selected>Select Gaming Platform</option>
                                                    @foreach ($platforms as $platform)
                                                        @if (platformExists($platform->id))
                                                            <option value="{{ $platform->id }}"
                                                                @if (old('platform') == $platform->id) selected @endif>
                                                                {{ $platform->platform }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="" selected>No account purchased</option>
                                                @endif
                                            </select>
                                            @error('platform')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endauth
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="input-name">User</label>
                                    <div class="col-sm-9">
                                        <div class="game-user">
                                            <input type="hidden" name="bitcoin_username" class="bitcoin_username">
                                            <i class="mdi mdi-account-circle-outline"></i><span
                                                id="game_username_for_bitcoin">Game Username</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 control-label" for="credit">Amount:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="credit" value="{{ old('credit') }}"
                                            placeholder="$0" id="credit" class="form-control custom-input">
                                        @error('credit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="method" value="1" name="method">
                                <input type="hidden" id="currency" value="btc" name="currency">
                                <button type="submit" class="btn btn-pay" form="form-bitcoin">PAY</button>
                            </form>
                            @guest
                                <div class="disabled-2">
                                    <p><button type="button" data-toggle="modal" data-target="#loginModal">Login</button> to
                                        reload with bitcoin</p>
                                </div>
                            @endguest
                        </div>
                    </div>
                    <!-- Start bitcoin reload section -->
                </div>
            </div>
        </div>
    </div>
    <div class="redeem-bg" id="redeem-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="reload">
                        <h2>rede<span>em</span></h2>
                    </div>
                    <div class="redeem-form-bg">
                        <form method="POST" action="{{ route('redeem-request') }}" class="form-bitcoin"
                            id="redeemForm">
                            @csrf
                            <div class="form-group row">
                                <label for="redeem_platform"
                                    class="col-sm-3 control-label text-sm-end">{{ __('Game') }}</label>
                                <div class="col-sm-9">
                                    @guest
                                        <select id="redeem_platform"
                                            class="form-select form-control custom-input @error('redeem_platform') is-invalid @enderror"
                                            name="redeem_platform" autofocus>
                                            <option value="" selected> {{ __('Select Game') }}</option>
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}"
                                                    {{ old('redeem_platform') == $platform->id ? 'selected' : '' }}>
                                                    {{ $platform->platform }}</option>
                                            @endforeach
                                        </select>
                                    @endguest
                                    @auth
                                        <select id="redeem_platform"
                                            class="form-select form-control custom-input @error('redeem_platform') is-invalid @enderror"
                                            name="redeem_platform" autofocus onchange="populateRedeemUsername(this);"
                                            @if (!accountExists()) disabled @endif>
                                            @if (accountExists())
                                                <option value="" selected>Select Gaming Platform</option>
                                                @foreach ($platforms as $platform)
                                                    @if (platformExists($platform->id))
                                                        <option value="{{ $platform->id }}"
                                                            @if (old('redeem_platform') == $platform->id) selected @endif>
                                                            {{ $platform->platform }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="" selected>No account purchased</option>
                                            @endif
                                        </select>
                                        @error('redeem_platform')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endauth
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="input-name">User</label>
                                <div class="col-sm-9">
                                    <div class="game-user">
                                        <input type="hidden" name="redeem_username" class="redeem_username">
                                        <i class="mdi mdi-account-circle-outline"></i><span id="redeem_username_game">Game
                                            Username</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="credit">Amount:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="amount" value="{{ old('amount') }}" placeholder="$0"
                                        id="amount" class="form-control custom-input">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="payment_method">Payment:</label>
                                <div class="col-sm-9">
                                    <select class="form-select form-control custom-input" id="payment_method"
                                        aria-label="Default select example" name="payment_method"
                                        onchange="showPaymentOptions();">
                                        <option selected>Choose One</option>
                                        @foreach ($methods as $method)
                                            <option value="{{ $method->id }}"
                                                @if (old('payment_method') == $method->id) selected @endif>{{ $method->method }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payment_method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row cashtag">
                                <label for="cashtag"
                                    class="col-md-3 col-form-label text-md-end">{{ __('Cash tag') }}</label>

                                <div class="col-md-9">
                                    <input id="cashtag" type="text"
                                        class="form-control custom-input @error('cashtag') is-invalid @enderror"
                                        name="cashtag" value="{{ old('cashtag') }}" autocomplete="cashtag"
                                        placeholder="Cash Tag" autofocus>

                                    @error('cashtag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row bitcoin_address">
                                <label for="bitcoin_address"
                                    class="col-md-3 col-form-label text-md-end">{{ __('Bitcoin Address') }}</label>

                                <div class="col-md-9">
                                    <input id="bitcoin_address" type="text"
                                        class="form-control custom-input @error('bitcoin_address') is-invalid @enderror"
                                        name="bitcoin_address" value="{{ old('bitcoin_address') }}"
                                        autocomplete="bitcoin_address" placeholder="Bitcoin Address" autofocus>

                                    @error('bitcoin_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-pay" form="redeemForm">REDEEM NOW</button>
                        </form>
                        @guest
                        <div class="disabled-3">
                            <p><button type="button" data-toggle="modal" data-target="#loginModal">Login</button> to redeem</p>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.footer')


@endsection
@push('scripts')
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
                    $('.bitcoin_username').val(data.success);
                    $('#game_username_for_bitcoin').text(data.success);
                }
            });


        }
    </script>
        <script>
            function populateRedeemUsername(sel) {
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
                        $('#redeem_username_game').text(data.success);
                        $('.redeem_username').val(data.success);
                    }
                });


            }
        </script>
    <script>
        const checkbox = document.getElementById('redeem_full')

        checkbox.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                $('#amount').prop('disabled', true);
                $('#amount').val('');
            } else {
                $('#amount').prop('disabled', false);
            }
        })
    </script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {

            var platform_id = $('#platform').val();

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
                    $('.bitcoin_username').val(data.success);
                    $('#game_username_for_bitcoin').text(data.success);
                }
            });

            var platform_id = $('#redeem_platform').val();

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
                    $('#redeem_username_game').text(data.success);
                    $('.redeem_username').val(data.success);
                }
            });

        });
    </script>
    <script>
        function showPaymentOptions() {
            var value = $('#payment_method').val();

            switch (value) {
                case '1':
                    $('.bitcoin_address').show();
                    $('.cashtag').hide();
                    break;
                case '2':
                    $('.bitcoin_address').hide();
                    $('.cashtag').show();
                    break;
                default:
                    $('.cashtag').hide();
                    $('.bitcoin_address').hide();
                    break;
            }

        }
    </script>
    <script>
        $(document).ready(function() {
            showPaymentOptions();
        });
    </script>
    @if ($errors->register->has('firstname') || $errors->register->has('email') || $errors->register->has('password'))
        <script>
            $(function() {
                $('#registerModal').modal({
                    show: true
                });
            });
        </script>
    @endif
    @if ($errors->has('email') || $errors->has('password'))
        <script>
            $(function() {
                $('#loginModal').modal({
                    show: true
                });
            });
        </script>
    @endif
@endpush
