@extends('layouts.app')
@section('title', 'Reload with Bitcoin | DragonStakes')
@section('head')
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
    <style>
        .payment-page {
            overflow: hidden;
            padding: 83px 412px 90px;
            min-height: 100vh;
        }
        #demo{
            font-family: roboto;
        }
        input#address {
            height: 60px;
        }

        input#amount {
            height: 60px;
        }

        .mdi {
            font-weight: 900;
            font-size: 30px;
        }

        .uil {
            font-size: 17px;
        }

        .btn {
            font-size: 14px;
            outline: none;
            padding: 0.625rem 1rem;
            min-width: 0;
        }

        .border.p-3.mt-3.mb-3.rounded {
            background: snow;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="border p-3 mt-3 mb-3 rounded">
                    <div class="row">
                        <div class="col-sm-8">
                            <div>
                                <h4 class="font-weight-bold" for="BillingOptRadio1">Reload/Pay Via Bitcoin
                                </h4>
                            </div>
                            <p class="mb-0 pt-1">Send the indicated amount to the address below.</p>
                        </div>
                        <div class="col-sm-4 text-right mt-3 mt-sm-0">
                            <a class="pl-0 ml-0 navbar-brand mr-0" href="/">
                                <h3 class="ms-text-primary">DragonStakes</h3>
                            </a>
                        </div>
                    </div> <!-- end row -->
                    <form method="POST" action="{{ route('request.credits') }}" id="creditForm">
                        @csrf
                        <input id="platform" type="hidden" name="platform" value="{{ $data['platform'] }}">
                        <input id="username" type="hidden" name="username" value="{{ $data['bitcoin_username'] }}">
                        <input id="credit" type="hidden" name="credit" value="{{ $data['credit'] }}">
                        <input id="method" type="hidden" name="method" value="{{ $data['method'] }}">
                        <input id="currency" type="hidden" name="currency" value="{{ $data['currency'] }}">
                    </form>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="card-number" class="">Pay Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="mdi mdi-home-currency-usd"></i></span>
                                    </div>
                                    <input type="text" id="address" class="form-control" placeholder="Address"
                                        value="{{ $result['pay_address'] }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><button
                                                class="btn btn-square btn-dark" onclick="copyAddress()"><i
                                                    class="uil uil-copy"></i></button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="card-number" class="">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-cash"></i></span>
                                    </div>
                                    <input type="text" id="amount" class="form-control" placeholder="BTC"
                                        step="any" value="{{ $result['pay_amount'] }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><button
                                                class="btn btn-square btn-dark" onclick="copyAmount()"><i
                                                    class="uil uil-copy"></i></button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: center">
                            <p style="color: #ff00008f; font-size: 20px">Link expires in</p>
                            <p id="demo" style="color: #61A5EE; font-size: 30px"></p>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
        </div>
    </div>
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
            }, 2000);
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
                    "x-api-key": "9KCBP26-9XF4MG6-PJR8FXM-MY1XC19"
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
