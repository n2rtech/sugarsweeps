@extends('layouts.admin')
@section('title', 'Transaction History')
@section('content')

    @include('admin.sections.flash-message')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Transaction History</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (count($histories) > 0)
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="date-width">Date & Time</th>
                                        <th>Cashier</th>
                                        <th>Player</th>
                                        <th>Game</th>
                                        <th>Game Credentials</th>
                                        <th>Amount</th>
                                        <th>Transaction Type</th>
                                        <th>Payout details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $history)
                                        <tr>
                                            @php
                                                $redeem_request = \App\Models\RedeemRequest::where('id', $history->request_id)->first();
                                                $credit_request = \App\Models\CreditRequest::where('id', $history->request_id)->first();
                                            @endphp
                                            <td>{{ Carbon\Carbon::parse($history->created_at)->format('d-m-Y h:i:s') }}</td>
                                            <td>
                                                @isset($history->cashier_id)
                                                    {{ $history->cashier->name }}
                                                @else
                                                    Admin
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($history->user_id)
                                                    {{ $history->user->name }}
                                                @else
                                                    Null
                                                @endisset
                                            </td>
                                            @if ($history->type == 'redeemed')
                                                <td>{{ $redeem_request->platform->platform }}</td>
                                            @else
                                                <td>{{ $credit_request->platform->platform }}</td>
                                            @endif
                                            @if ($history->type == 'redeemed')
                                                <td>
                                                    <span class="text-danger">Username:</span> <span class="float-right">
                                                        {{ $redeem_request->username }}</span><br>
                                                    <span class="text-danger">Password:</span> <span class="float-right">
                                                        {{ getPasswordByUserId($redeem_request->user_id, $redeem_request->platform_id) }}</span><br>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="text-danger">Username:</span> <span class="float-right">
                                                        {{ $credit_request->username }}</span><br>
                                                    <span class="text-danger">Password:</span> <span class="float-right">
                                                        {{ getPasswordByUserId($credit_request->user_id, $credit_request->platform_id) }}</span><br>
                                                </td>
                                            @endif
                                            <td>$ {{ $history->amount }}</td>
                                            <td>{{ ucfirst($history->type) }}</td>
                                            <td>

                                                @if ($history->type == 'redeemed')
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-square btn-gradient-warning show-credentials"
                                                        data-toggle="modal" data-target="#modal-show-credentials"
                                                        data-payment_method="{{ $redeem_request->paymentMethod->method }}"
                                                        data-method="{{ $redeem_request->payment_method_id }}"
                                                        data-bitcoin_address="{{ $redeem_request->bitcoin_address }}"
                                                        data-cashtag="{{ $redeem_request->cashtag }}">Show </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="table-responsive">
                            <p class="text-center">No History found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{ $histories->links('vendor.pagination.bootstrap-4') }}
    <div class="modal fade" id="modal-show-credentials" tabindex="-1" role="dialog"
        aria-labelledby="modal-show-credentials" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-min" role="document">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="flaticon-secure-shield d-block"></i>
                    <h2 id="platform">Payout Details</h2>
                    <p>Given below are player payment details</p>
                    <div class="table-responsive">
                        <table class="table table-bordered thead-primary">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-danger">Payment Method</th>
                                    <td id="paymentmethod"></td>
                                </tr>
                                <tr id="cryptocurrency">
                                    <th scope="row" class="text-danger">Bitcoin Address</th>
                                    <td id="bitcoin_address"></td>
                                </tr>
                                <tr id="cashapp">
                                    <th scope="row" class="text-danger">Cash Tag</th>
                                    <td id="cashtag"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".show-credentials").click(function() {

            var method = $(this).data('method');
            var paymentmethod = $(this).data('payment_method');
            var bitcoin_address = $(this).data('bitcoin_address');
            var cashtag = $(this).data('cashtag');
            if (method == 1) {
                $('#cryptocurrency').show();
                $('#cashapp').hide();
            }
            if (method == 2) {
                $('#cryptocurrency').hide();
                $('#cashapp').show();
            }
            $('#paymentmethod').text(paymentmethod);
            $('#bitcoin_address').text(bitcoin_address);
            $('#cashtag').text(cashtag);

        });
    </script>
@endpush
