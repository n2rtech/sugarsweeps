@extends('layouts.front')
@section('title', 'Redeem Credits')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Redeem Credits</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <form method="POST" action="{{ route('redeem-request') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="platform" class="col-md-4 col-form-label text-md-end">{{ __('Gaming Platform') }}</label>

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
                                <input readonly id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" placeholder="User Name" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Redeem Amount') }}</label>

                            <div class="col-md-3">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" autocomplete="credit" placeholder="Enter Amount" autofocus>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <input id="redeem_full" type="checkbox" name="redeem_full">
                                <label for="redeem_full" class="col-form-label" value="yes" @if(old('redeem_full') == 'yes') checked @endif>{{ __('Redeem Full Credits') }}</label>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="method" class="col-md-4 col-form-label text-md-end">{{ __('Payout method') }}</label>

                            <div class="col-md-6">
                                <select id="method" class="form-control @error('method') is-invalid @enderror" name="method" onchange="showPaymentOptions();">
                                    <option value="" selected>Select Payment method</option>
                                    @foreach($methods as $method)
                                    <option value="{{ $method->id }}" @if(old('method') == $method->id) selected @endif>{{ $method->method }}</option>
                                    @endforeach
                                </select>

                                @error('method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3 cashtag">
                            <label for="cashtag" class="col-md-4 col-form-label text-md-end">{{ __('Cash tag') }}</label>

                            <div class="col-md-6">
                                <input id="cashtag" type="text" class="form-control @error('cashtag') is-invalid @enderror" name="cashtag" value="{{ old('cashtag') }}" autocomplete="cashtag" placeholder="Cash Tag" autofocus>

                                @error('cashtag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 bitcoin_address">
                            <label for="bitcoin_address" class="col-md-4 col-form-label text-md-end">{{ __('Bitcoin Address') }}</label>

                            <div class="col-md-6">
                                <input id="bitcoin_address" type="text" class="form-control @error('bitcoin_address') is-invalid @enderror" name="bitcoin_address" value="{{ old('bitcoin_address') }}" autocomplete="bitcoin_address" placeholder="Bitcoin Address" autofocus>

                                @error('bitcoin_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 text-right">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Send Request') }}
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
           type:'POST',
           url:"{{ route('populate') }}",
           data:{platform_id:platform_id},
           success:function(data){
              $('#username').val(data.success);
           }
        });

});
</script>
<script>
    function showPaymentOptions(){
        var value = $('#method').val();

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
    $(document).ready(function () {
        showPaymentOptions();
    });
</script>
@endpush
