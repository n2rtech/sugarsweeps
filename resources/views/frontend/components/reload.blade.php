<!-- ======= Reload Section ======= -->
<section id="reload" class="reload">
    <div class="container">

        <div class="section-title">
            <h2>RE<span class="text-primary">LOAD</span></h2>
        </div>

        <!-- ======= CashApp Reload Section ======= -->

        <div class="row">
            <div class="col-lg-10 col-md-10 align-items-stretch m-auto cash-app">
                <div class="reload-cash-app">
                    <h4>Reload With</h4><img src="{{ asset('img/cash-app.png') }}" alt="cash-app" class="img-responsive">
                </div>
                <h4 class="cash-tag-description">To deposit with CashApp make sure to include Game Name/Username in the
                    Memo $Cashtag</h4>
                <div class="text-center mt-4">
                    <a href="{{ $cashapp['cashapp'] }}" target="_blank" class="cash-app-button">CASHAPP DEPOSIT LINK</a>
                </div>
                @guest
                    @include('frontend.components.disabled', ['title' => ' to reload with CashApp'])
                @endguest
            </div>
        </div>

        <!-- ======= End CashApp Reload Section ======= -->

        <!-- ======= Bitcoin Reload Section ======= -->

        <div class="row mt-5">
            <div class="col-lg-10 col-md-10 align-items-stretch m-auto bitcoin-bg">
                <div class="reload-bitcoin">
                    <h4>Reload With</h4><img src="{{ asset('img/bitcoin.png') }}" alt="bitcoin" class="img-responsive">
                </div>
                <div class="bitcoin-form">
                    <form action="{{ route('create.payment') }}" method="POST" id="reloadForm">
                        @csrf
                        <div class="row mb-3">
                            <label for="platform"
                                class="col-md-4 col-form-label text-white text-left">{{ __('Game') }}</label>

                            <div class="col-md-8">
                                <select name="platform" id="platform"
                                    class="form-control @error('platform') is-invalid @enderror" onchange="populateUsername(this);">
                                    <option value="">Select Gaming Platform</option>
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->platform }}</option>
                                    @endforeach
                                </select>
                                @error('platform')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bitcoin_username"
                                class="col-md-4 col-form-label text-white text-left">{{ __('Username') }}</label>

                            <div class="col-md-8">
                                <input id="bitcoin_username" type="text"
                                    class="form-control @error('bitcoin_username') is-invalid @enderror"
                                    name="bitcoin_username" value="{{ old('bitcoin_username') }}"
                                    placeholder="Game Username" autofocus readonly>
                                @error('bitcoin_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="credit"
                                class="col-md-4 col-form-label text-white text-left">{{ __('Amount') }}</label>

                            <div class="col-md-8">
                                <input id="credit" type="number"
                                    class="form-control @error('credit') is-invalid @enderror" name="credit"
                                    value="{{ old('credit') }}" placeholder="$ 0" autofocus min="0">
                                @error('credit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" id="method" value="1" name="method">
                            <input type="hidden" id="currency" value="btc" name="currency">
                        </div>
                    </form>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" form="reloadForm" class="reload-bitcoin-button">Pay</button>
                </div>
                @guest
                    @include('frontend.components.disabled', ['title' => ' to reload with Bitcoin'])
                @endguest
            </div>
        </div>
        <!-- ======= End Bitcoin Reload Section ======= -->
    </div>
</section><!-- End Reload Section -->
