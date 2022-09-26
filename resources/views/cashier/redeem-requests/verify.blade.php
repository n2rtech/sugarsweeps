@extends('layouts.cashier')
@section('title', 'Verify Request')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="ms-panel-custom">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item" aria-current="page"> <a href="{{ route('cashier.dashboard') }}"><i
                                class="material-icons">home</i>
                            Dashboard</a></li>
                    <li class="breadcrumb-item"> <a href="{{ route('cashier.redeem-requests.index') }}">Redeem Requests</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verify</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Redeem Requests</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('cashier.redeem-requests.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="ms-panel ms-widget bg-info" style="height: 326px;">
                                <div class="ms-panel-header header-mini">
                                    <h6 class="text-success">Verify Request to Process Redeem Request</h6>
                                </div>
                                <div class="ms-panel-body">
                                    <form method="POST" action="{{ route('cashier.verify-request', $request->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="batch_withdrawal_id" value="12345">
                                        <div class="form-group">
                                            <label for="verification_code">Enter Code sent on Registered NowPayments Email Address</label>
                                            <input type="text" name="verification_code" id="verification_code" placeholder="Enter Verification Code here" class="form-control">
                                            @error('verification_code')
                                                <code>{{ $message }}</code>
                                            @enderror
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success">Verify</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="ms-panel ms-widget ms-identifier-widget bg-info" style="height: 326px;">
                                <div class="ms-panel-header header-mini">
                                    <h6>Player Information</h6>
                                </div>
                                <div class="ms-panel-body">
                                    <table class="table table-bordered bg-white">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Player</th>
                                                <td class="text-right">{{ $request->user->firstname }}
                                                    {{ $request->user->lastname }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Email Address</th>
                                                <td class="text-right">{{ $request->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Phone Number</th>
                                                <td class="text-right">{{ $request->user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Joined On</th>
                                                <td class="text-right">
                                                    {{ \Carbon\Carbon::parse($request->user->created_at)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover thead-dark">
                                    <thead>
                                        <tr>
                                            <th class="date-width">Request Generated </th>
                                            <th>Requested Amount</th>
                                            <th>Game</th>
                                            <th class="text-center">Game Credentials</th>
                                            <th class="text-right">Payout Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}
                                                {{ Carbon\Carbon::parse($request->created_at)->format('h:i:s') }}
                                            </td>
                                            <td>
                                                @if ($request->redeem_full == 'yes')
                                                    Full
                                                @else
                                                $ {{ $request->amount }} @endisset
                                        </td>
                                        <td>{{ $request->platform->platform }}</td>
                                        <td class="text-center">
                                            <span class="text-danger">Username:</span> <span class="float-right">
                                                {{ $request->username }}</span><br>
                                            <span class="text-danger">Password:</span> <span class="float-right">
                                                {{ getPasswordByUserId($request->user_id, $request->platform_id) }}</span><br>
                                        </td>


                                        <td class="text-right">
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-square btn-gradient-info show-credentials"
                                                data-toggle="modal" data-target="#modal-show-credentials"
                                                data-payment_method="{{ $request->paymentMethod->method }}"
                                                data-method="{{ $request->payment_method_id }}"
                                                data-bitcoin_address="{{ $request->bitcoin_address }}"
                                                data-cashtag="{{ $request->cashtag }}">Show </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Redeem Full amount</h4>
                </div>


                <form action="{{ route('cashier.redeem.full') }}" class="pl-3 pr-3" id="approveAmount" method="POST">
                    @csrf
                    <input type="hidden" name="redeemid" id="redeemid" value="">
                    <div class="form-group">
                        <label for="amount">Redeem Amount</label>
                        <input class="form-control" name="amount" type="number" id="amount" required=""
                            placeholder="Enter Redeem Amount">
                    </div>



                    <div class="form-group text-center">
                        <button class="btn btn-rounded btn-primary" type="submit">Approve</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="" id="deleteForm">
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <input type='hidden' name='_method' value='DELETE'>
                <div class="modal-header bg-warning">
                    <h4 class="modal-title has-icon text-white"><i class="flaticon-alert-1"></i> Are you sure ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <p>You won't be able to revert this player once deleted!</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary shadow-none">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
<!-- Confirm Delete Scripts Start -->
<script>
    $(document).on("click", ".confirmDelete", function(e) {

        e.preventDefault();

        var _self = $(this);

        var requestId = _self.data('id');

        form_action = '{{ route('cashier.deposit-requests.destroy', ':id') }}';
        url = form_action.replace(':id', requestId);

        $('#deleteForm').attr('action', url);


        $(_self.attr('href')).modal('show');
    });
</script>
<!-- Confirm Delete Scripts End -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function confirmAccept(id) {
        url_string = '{{ route('cashier.redeem-requests.show', ':id') }}';
        url = url_string.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Accept it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }

    function confirmReject(id) {
        url_string = '{{ route('cashier.redeem-requests.edit', ':id') }}';
        url = url_string.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
<script>
    $(document).on("click", ".enterAmountDialog", function(e) {

        e.preventDefault();

        var _self = $(this);

        var requestId = _self.data('id');

        $("#redeemid").val(requestId);


        $(_self.attr('href')).modal('show');
    });
</script>
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
