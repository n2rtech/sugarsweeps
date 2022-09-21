@extends('layouts.front')
@section('title', 'Buy Credits')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Buy Credits</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <form class="form-horizontal" id="accountForm" action="{{ route('create.payment') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="platform" class="col-md-4 col-form-label text-md-end">{{ __('Gaming Platform')
                                }}</label>

                            <div class="col-md-6">
                                <select id="platform" class="form-control @error('platform') is-invalid @enderror"
                                    name="platform" autofocus onchange="populateUsername(this);" @if(!$account_exists) disabled @endif>
                                    @if($account_exists)
                                    <option value="" selected>Select Gaming Platform</option>
                                    @foreach($platforms as $platform)
                                        @if($platform->exists)
                                            <option value="{{ $platform->id }}" @if(old('platform')==$platform->id) selected
                                                @endif>{{ $platform->platform }}</option>
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
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" autocomplete="username" placeholder="User Name" autofocus readonly>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="credit" class="col-md-4 col-form-label text-md-end">{{ __('Buy Credit Amount')
                                }}</label>

                            <div class="col-md-6">
                                <input id="credit" type="number" class="form-control @error('credit') is-invalid @enderror"
                                    name="credit" value="{{ old('credit') }}" autocomplete="credit"
                                    placeholder="Credit Amount" autofocus>

                                @error('credit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="method" class="col-md-4 col-form-label text-md-end">{{ __('Payment method')
                                }}</label>

                            <div class="col-md-6">
                                <select id="method" class="form-control @error('method') is-invalid @enderror" name="method"
                                    autofocus>
                                    <option value="" selected>Select Payment method</option>
                                    @foreach($methods as $method)
                                    <option value="{{ $method->id }}" @if(old('method')==$method->id) selected @endif>{{
                                        $method->method }}</option>
                                    @endforeach
                                </select>

                                @error('method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="currency" class="col-md-4 col-form-label text-md-end">{{ __('Crypto Currency')
                                }}</label>

                            <div class="col-md-6">
                                <select id="currency" class="form-control @error('currency') is-invalid @enderror" name="currency"
                                    autofocus>
                                    <option value="">Select Crypto Currency</option>
                                    @foreach($response['currencies'] as $currency)
                                    <option value="{{ $currency }}" @if(old('currency')==$currency) selected @endif>
                                        @if($currency == 'btg')
                                        Bitcoin Gold
                                        @elseif($currency == 'btc')
                                        Bitcoin
                                        @elseif($currency == 'xmr')
                                        Monero
                                        @elseif($currency == 'zec')
                                        Zcash
                                        @elseif($currency == 'etc')
                                        Etherium Classic
                                        @elseif($currency == 'xvg')
                                        Verge
                                        @elseif($currency == 'ada')
                                        Cardano
                                        @elseif($currency == 'ltc')
                                        Litecoin
                                        @elseif($currency == 'bch')
                                        Bitcoin Cash
                                        @elseif($currency == 'xlm')
                                        Stellar
                                        @elseif($currency == 'xrp')
                                        Ripple
                                        @elseif($currency == 'dgb')
                                        DigiByte
                                        @elseif($currency == 'cvc')
                                        Civic
                                        @elseif($currency == 'dcr')
                                        Decred
                                        @elseif($currency == 'doge')
                                        Dogecoin
                                        @elseif($currency == 'kmd')
                                        Komodo
                                        @elseif($currency == 'rep')
                                        Augur
                                        @elseif($currency == 'bat')
                                        Basic Attention Token
                                        @elseif($currency == 'mana')
                                        Decentraland
                                        @elseif($currency == 'ark')
                                        ARK
                                        @elseif($currency == 'tusd')
                                        TrueUSD
                                        @elseif($currency == 'vet')
                                        VChain
                                        @elseif($currency == 'grs')
                                        Groestlcoin
                                        @elseif($currency == 'fun')
                                        FunFair
                                        @elseif($currency == 'neo')
                                        NEO
                                        @elseif($currency == 'usdc')
                                        USD Coin
                                        @elseif($currency == 'xtz')
                                        Tezos
                                        @elseif($currency == 'hot')
                                        Holo
                                        @elseif($currency == 'icx')
                                        ICON
                                        @elseif($currency == 'iotx')
                                        IoTeX
                                        @elseif($currency == 'knc')
                                        Kyber Network Crystal
                                        @elseif($currency == 'link')
                                        Chainlink
                                        @elseif($currency == 'rvn')
                                        Ravencoin
                                        @elseif($currency == 'enj')
                                        Enjin Coin
                                        @elseif($currency == 'bnbmainnet')
                                        BNB Mainnet
                                        @elseif($currency == 'vib')
                                        Viberate
                                        @elseif($currency == 'bcd')
                                        Bitcoin Diamond
                                        @elseif($currency == 'usdt')
                                        Tether
                                        @elseif($currency == 'atom')
                                        Cosmos
                                        @elseif($currency == 'usdterc20')
                                        USDT ERC20
                                        @elseif($currency == 'hbar')
                                        Hedera
                                        @elseif($currency == 'ht')
                                        Huobi Token
                                        @elseif($currency == 'matic')
                                        Polygon
                                        @elseif($currency == 'busd')
                                        Binance USD
                                        @elseif($currency == 'algo')
                                        Algorand
                                        @elseif($currency == 'usdttrc20')
                                        USDT TRC20
                                        @elseif($currency == 'gt')
                                        GateToken
                                        @elseif($currency == 'stpt')
                                        Standard Tokenization Protocol (STPT)
                                        @elseif($currency == 'ftt')
                                        FTX
                                        @elseif($currency == 'gusd')
                                        Gemini dollar
                                        @elseif($currency == 'ava')
                                        AVA
                                        @elseif($currency == 'yfi')
                                        YFI
                                        @elseif($currency == 'sxp')
                                        Swipe (SXP)
                                        @elseif($currency == 'luna')
                                        Tera
                                        @elseif($currency == 'uni')
                                        Uniswap
                                        @elseif($currency == 'tfuel')
                                        Theta Fuel
                                        @elseif($currency == 'fil')
                                        Filecoin
                                        @elseif($currency == 'one')
                                        Harmony (One)
                                        @elseif($currency == 'axs')
                                        Axie Infinity Shards (AXS)
                                        @elseif($currency == 'strax')
                                        Stratis (STRAX)
                                        @elseif($currency == 'srk')
                                        SparkPoint (SRK)
                                        @elseif($currency == 'ftm')
                                        Fantom (FTM)
                                        @elseif($currency == 'lgcy')
                                        LGCY
                                        @elseif($currency == 'front')
                                        Frontier (FRONT)
                                        @elseif($currency == 'sand')
                                        The Sandbox (SAND)
                                        @elseif($currency == 'chz')
                                        Chiliz (CHZ)
                                        @elseif($currency == 'cake')
                                        PancakeSwap (CAKE)
                                        @elseif($currency == 'om')
                                        Mantro Dao (OM)
                                        @elseif($currency == 'hoge')
                                        Hoge Finance (HOGE)
                                        @elseif($currency == 'klv')
                                        Klever (KLV)
                                        @elseif($currency == 'sol')
                                        Solana
                                        @elseif($currency == 'ctsi')
                                        Cartesi
                                        @elseif($currency == 'shib')
                                        Shiba Inu
                                        @elseif($currency == 'kishu')
                                        Kishu Inu
                                        @elseif($currency == 'zil')
                                        Zilliqa
                                        @elseif($currency == 'super')
                                        SuperCoin
                                        @elseif($currency == 'keanu')
                                        Keanu Inu
                                        @elseif($currency == 'ftmmainnet')
                                        Fantom's Mainnet
                                        @elseif($currency == 'chr')
                                        Chromia
                                        @elseif($currency == 'feg')
                                        FEG Token
                                        @elseif($currency == 'bnbbsc')
                                        BNBBSC
                                        @elseif($currency == 'busdbsc')
                                        BUSDBSC
                                        @elseif($currency == 'nwc')
                                        Newscrypto
                                        @elseif($currency == 'ust')
                                        TerraUSD (UST)
                                        @elseif($currency == 'avax')
                                        Avalanche
                                        @elseif($currency == 'grt')
                                        The Graph (GRT)
                                        @elseif($currency == 'eth')
                                        Ethereum
                                        @elseif($currency == 'brise')
                                        Bitgert
                                        @elseif($currency == 'usdtbsc')
                                        USDT BSC
                                        @elseif($currency == 'c98')
                                        Coin98
                                        @elseif($currency == 'raca')
                                        Radio Caca
                                        @elseif($currency == 'mx')
                                        MX Token
                                        @elseif($currency == 'usdp')
                                        Pax Dollar (USDP)
                                        @elseif($currency == 'leash')
                                        Doge Killer
                                        @elseif($currency == 'tko')
                                        Toko
                                        @elseif($currency == 'folki')
                                        Floki Inu
                                        @elseif($currency == 'avaerc20')
                                        AVA COIN (AVA) ERC20
                                        @elseif($currency == 'xdc')
                                        XinFin - XDC
                                        @elseif($currency == 'arpa')
                                        Arpa
                                        @elseif($currency == 'bel')
                                        Bella Protocol (BEL)
                                        @elseif($currency == 'trvl')
                                        TRVL
                                        @elseif($currency == 'avabsc')
                                        AVA BSC
                                        @elseif($currency == 'fluf')
                                        Fluffy Coin (FLUF)
                                        @elseif($currency == 'xyo')
                                        XYO
                                        @elseif($currency == 'nftb')
                                        NFTB
                                        @elseif($currency == 'marsh')
                                        UnMarshal (Marsh)
                                        @elseif($currency == 'avn')
                                        AVNRich (AVN)
                                        @elseif($currency == 'ilv')
                                        Illuvium
                                        @elseif($currency == 'ntvrk')
                                        NetVRk
                                        @elseif($currency == 'sfund')
                                        Seedify.fund (SFUND)
                                        @else
                                        {{ ucfirst($currency) }}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>

                                @error('currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-right">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function populateUsername(sel)
    {
        var platform_id = sel.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
           type:'POST',
           url:"{{ route('populate') }}",
           data:{platform_id:platform_id},
           success:function(data){
              $('#username').val(data.success);
           }
        });


    }
</script>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#currency').select2({
  theme: "bootstrap"
});
    var platform_id = $('#platform').val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
           type:'POST',
           url:"{{ route('populate') }}",
           data:{platform_id:platform_id},
           success:function(data){
              $('#username').val(data.success);
           }
        });

});
</script>
@endpush
