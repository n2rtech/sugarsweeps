<!-- ======= Counts Section ======= -->
<section id="redeem" class="redeems">
    <div class="container">

        <div class="section-title">
            <h2>REDEEM</h2>
        </div>

        <div class="redeem-form">
            <form method="POST" action="{{ route('redeem-request') }}" id="redeemForm">
                @csrf
                <div class="row mb-3">
                    <label for="redeem_platform"
                        class="col-md-4 col-form-label text-white text-left">{{ __('Game') }}</label>

                    <div class="col-md-8">
                        <select name="redeem_platform" id="redeem_platform"
                            class="form-control @error('redeem_platform') is-invalid @enderror" onchange="populateRedeemUsername(this);">
                            <option value="">Select Gaming Platform</option>
                            @foreach ($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->platform }}</option>
                            @endforeach
                        </select>
                        @error('redeem_platform')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="redeem_username"
                        class="col-md-4 col-form-label text-white text-left">{{ __('Username') }}</label>

                    <div class="col-md-8">
                        <input id="redeem_username" type="text"
                            class="form-control @error('redeem_username') is-invalid @enderror"
                            name="redeem_username" value="{{ old('redeem_username') }}"
                            placeholder="Game Username" autofocus readonly>
                        @error('redeem_username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="amount"
                        class="col-md-4 col-form-label text-white text-left">{{ __('Amount') }}</label>

                    <div class="col-md-8">
                        <input id="amount" type="number"
                            class="form-control @error('amount') is-invalid @enderror" name="amount"
                            value="{{ old('amount') }}" placeholder="$ 0" autofocus min="0">
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="payment_method"
                        class="col-md-4 col-form-label text-white text-left">{{ __('Payment') }}</label>

                    <div class="col-md-8">
                        <select name="payment_method" id="payment_method"
                            class="form-control @error('payment_method') is-invalid @enderror" onchange="showPaymentOptions();">
                            <option value="">Choose One</option>
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

                <div class="row mb-3 cashtag">
                    <label for="cashtag"
                        class="col-md-4 col-form-label text-white text-left">{{ __('Cashtag') }}</label>

                    <div class="col-md-8">
                        <input id="cashtag" type="text"
                            class="form-control @error('cashtag') is-invalid @enderror" name="cashtag"
                            value="{{ old('cashtag') }}" placeholder="Cashtag" autofocus>
                        @error('cashtag')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 bitcoin_address">
                    <label for="bitcoin_address"
                        class="col-md-4 col-form-label text-white text-left">{{ __('Bitcoin Address') }}</label>

                    <div class="col-md-8">
                        <input id="bitcoin_address" type="text"
                            class="form-control @error('bitcoin_address') is-invalid @enderror" name="bitcoin_address"
                            value="{{ old('bitcoin_address') }}" placeholder="Bitcoin Address" autofocus>
                        @error('bitcoin_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </form>
            <div class="text-center mt-4">
                <button type="submit" form="redeemForm" class="redeem-button">Redeem Now</button>
            </div>
            @guest
                @include('frontend.components.disabled', ['title' => ' to redeem'])
            @endguest
        </div>

    </div>
</section>
<!-- End Counts Section -->
