@extends('layouts.front')
@section('title', 'Reload with Bitcoin | SugarSweeps')
@section('content')
@section('head')
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
@endsection
<!-- ======= Payment Section ======= -->
<section id="payment" class="payment">
    <div class="container">
        <div class="section-title">
            <h2>Reload With <span class="text-primary"> Bitcoin</span></h2>
            <p class="text-center">Send the indicated amount to the address below.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 align-items-stretch m-auto credit-bg">
            <h3 class="logo-footer text-center mb-4">Sugar Sweeps</h3>
            <form method="POST" action="{{ route('request.credits') }}" id="creditForm">
                @csrf
                <input id="platform" type="hidden" name="platform" value="{{ $data['platform'] }}">
                <input id="username" type="hidden" name="username" value="{{ $data['bitcoin_username'] }}">
                <input id="credit" type="hidden" name="credit" value="{{ $data['credit'] }}">
                <input id="method" type="hidden" name="method" value="{{ $data['method'] }}">
                <input id="currency" type="hidden" name="currency" value="{{ $data['currency'] }}">
            </form>

                <div class="row mb-3">
                    <label for="pay_address" class="col-form-label text-md-end">{{ __('Pay Address') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i
                                    class="mdi mdi-home-currency-usd"></i></span>
                        </div>
                        <input type="text" id="address" class="form-control" placeholder="Address" value="{{ $result['pay_address'] }}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1"><button
                                    class="btn btn-square" onclick="copyAddress()">Copy</button></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="amount" class="col-form-label text-md-end">{{ __('Amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-cash"></i></span>
                        </div>
                        <input type="text" id="amount" class="form-control" placeholder="BTC"
                            step="any" value="{{ $result['pay_amount'] }}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1"><button
                                    class="btn btn-square" onclick="copyAmount()">Copy</button></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12" style="text-align: center">
                        <p style="color: #db0038;font-size: 20px">Link expires in</p>
                        <p id="demo" style="color: #61A5EE; font-size: 30px"></p>
                    </div>
                </div>

        </div>
    </div>
</section>
<!-- ======= Login Section Ends Here ======= -->

@endsection
@push('scripts')
<script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
    <script>
        function copyAmount() {
            /* Get the text field */
            var copyText = document.getElementById("amount");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);


        }
    </script>
    <script>
        function copyAddress() {
            /* Get the text field */
            var copyText = document.getElementById("address");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);


        }
    </script>
    <script>
        // Set the date we're counting down to
        var minutesToAdd = 45.005;

        var currentDate = new Date();
        var countDownDate = new Date(currentDate.getTime() + minutesToAdd * 60000);

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = minutes + " m : " + seconds + " s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                // $('#creditForm').submit();
                window.location.href = "{{ route('link.expired') }}";
            }
        }, 1000);
    </script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                checkPaymentStatus()
            }, 5000);
        });
    </script>
    <script>
        function checkPaymentStatus() {
            var paymentId = '{{ $result['payment_id'] }}';
            var settings = {
                "url": "https://api.nowpayments.io/v1/payment/" + paymentId,
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "x-api-key": "2M26KTF-S5E4487-JD4E6Y7-8816EGW"
                },
            };

            $.ajax(settings).done(function(response) {
                console.log(response.payment_status);

                if ((response.payment_status == 'confirmed') || (response.payment_status == 'finished')) {
                    $('#creditForm').submit();
                }
            });

        }
    </script>

@endpush
