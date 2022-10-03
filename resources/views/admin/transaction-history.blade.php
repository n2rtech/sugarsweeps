@extends('layouts.admin')
@section('title', 'Transaction History')
@section('content')
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
                    <div class="col-md-12" id="filterBox">
                        <form action="{{ route('admin.transaction-history.index') }}">
                            <div class="form-row">
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <input type="name" name="name" class="form-control" placeholder="Player"
                                            value="{{ $name }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ $email }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phone" placeholder="Phone number"
                                            name="phone" value="{{ $phone }}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <select class="form-control" name="request_cashier" id="request_cashier">
                                            <option value="">Select Cashier</option>
                                            @foreach ($cashiers as $cashier)
                                                <option {{ $cashier->id }}
                                                    @if ($request_cashier == $cashier->id) selected @endif>
                                                    {{ $cashier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <select class="form-control" id="status" name="status">
                                            <option value="" selected>Type</option>
                                            <option value="redeemed" {{ $request_status == 'redeemed' ? 'selected' : '' }}>
                                                Redeemed</option>
                                            <option value="purchased" {{ $request_status == 'purchased' ? 'selected' : '' }}>
                                                Purchased</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <select id="payment_method" class="form-control" name="payment_method" autofocus>
                                            <option value="" selected>Payout Method</option>
                                            @foreach ($methods as $method)
                                                <option value="{{ $method->method }}"
                                                    @if ($payment_method == $method->method) selected @endif>
                                                    {{ $method->method }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <input type="date" name="date" class="form-control" placeholder="Date"
                                        value="{{ $date }}">
                                </div>
                                <div class="col-xl-10 col-md-12 text-right">
                                    <button class="btn btn-md btn-secondary" type="submit"><i
                                            class="feather icon-search"></i></i></button>
                                    <a href="{{ route('admin.transaction-history.index') }}" class="btn btn-md btn-warning"
                                        type="submit"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($histories) > 0)
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="date-width">Date & Time</th>
                                        <th>Cashier</th>
                                        <th>Player</th>
                                        <th>Email</th>
                                        <th class="text-center">Phone</th>
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
                                            <td>{{ $history->user->email }}</td>
                                            <td class="text-center">{{ $history->user->phone }}</td>
                                            @if ($history->type == 'redeemed')
                                                <td>{{ $redeem_request->platform->platform }}</td>
                                            @else
                                                <td>{{ $credit_request->platform->platform }}</td>
                                            @endif
                                            @if ($history->type == 'redeemed')
                                                <td>
                                                    <span class="text-danger">Username:</span> <br><span>
                                                        {{ $redeem_request->username }}</span><br>
                                                    <span class="text-danger">Password:</span><br> <span>
                                                        {{ getPasswordByUserId($redeem_request->user_id, $redeem_request->platform_id) }}</span><br>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="text-danger">Username:</span><br> <span>
                                                        {{ $credit_request->username }}</span><br>
                                                    <span class="text-danger">Password:</span> <br><span>
                                                        {{ getPasswordByUserId($credit_request->user_id, $credit_request->platform_id) }}</span><br>
                                                </td>
                                            @endif
                                            <td>$ {{ $history->amount }}</td>
                                            <td><div class="badge badge-light-success">{{ ucfirst($history->type) }}</div></td>
                                            <td>

                                                @if ($history->type == 'redeemed')
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-relief-success btn-sm waves-effect waves-light show-credentials"
                                                        data-toggle="modal" data-target="#modal-show-credentials"
                                                        data-payment_method="{{ $redeem_request->paymentMethod->method }}"
                                                        data-method="{{ $redeem_request->payment_method_id }}"
                                                        data-bitcoin_address="{{ $redeem_request->bitcoin_address }}"
                                                        data-cashtag="{{ $redeem_request->cashtag }}">Show </a>
                                                @else
                                                <a href="javascript:void(0)" class="btn btn-relief-light btn-sm waves-effect waves-light show-credentials">N/A</a>
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
