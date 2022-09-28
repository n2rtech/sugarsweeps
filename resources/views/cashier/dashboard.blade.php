@extends('layouts.cashier')
@section('title', 'Dashboard')
@section('content')
    <section id="dashboard-ecommerce">

        @include('cashier.sections.flash-message')

        <!-- Cashier Stats starts Here-->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700">{{ $total_players }}</h2>
                            <p class="mb-1">Total Players</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-primary font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700">{{ $total_approval_requests }}</h2>
                            <p class="mb-1">Approval Requests</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shield text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700">{{ $total_credit_requests }}</h2>
                            <p class="mb-1">Credit Requests</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-download-cloud text-warning font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700">{{ $total_redeem_requests }}</h2>
                            <p class="mb-1">Redeem Requests</p>
                        </div>
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-upload-cloud text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cashier Stats ends Here-->

        <!-- Recent  Player starts Here-->
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Players</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if (count($players) > 0)
                            <div class="table-responsive" id="table-hover-animation">
                                <table class="table table-hover-animation mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Player</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Approval</th>
                                            <th scope="col" class="text-center">Game Credentials</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($players as $player)
                                            <tr>
                                                <th scope="row">{{ $player->id }}</th>
                                                <td>{{ $player->name }}</td>
                                                <td>{{ $player->email }}</td>
                                                <td>{{ $player->phone }}</td>
                                                @if ($player->approved == '2')
                                                    <td>
                                                        <div class="badge badge-light-success">Approved</div>
                                                    </td>
                                                @elseif($player->approved == '3')
                                                    <td>
                                                        <div class="badge badge-light-danger">Rejected</div>
                                                    </td>
                                                @else
                                                    <td>
                                                        <div class="badge badge-light-warning">Pending</div>
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    @if ($player->approved == '2')
                                                        <a href="{{ route('cashier.players.credentials', $player->id) }}"
                                                            class="btn btn-relief-success btn-sm waves-effect waves-light">Show</a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-relief-light btn-sm waves-effect waves-light">N/A</a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('cashier.players.show', $player->id) }}"
                                                            class="btn btn-warning btn-sm waves-effect waves-light"><i class="feather icon-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-responsive">
                                <p class="text-center">No Listing found.</p>
                            </div>
                        @endif
                    </div>
                    @if (count($players) > 5)
                        <div class="card-footer text-center">
                            <a href="{{ route('cashier.players.index') }}"
                                class="btn btn-outline-light square waves-effect waves-light">View All</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Recent  Player ends Here-->

        <!-- Recent  Approval Requests starts Here-->
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Approval Requests</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if (count($approval_requests) > 0)
                            <div class="table-responsive" id="table-hover-animation">
                                <table class="table table-hover-animation mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Player</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Approval</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approval_requests as $request)
                                            <tr>
                                                <th scope="row">{{ $request->id }}</th>
                                                <td>{{ $request->name }}</td>
                                                <td>{{ $request->email }}</td>
                                                <td>{{ $request->phone }}</td>
                                                @if ($request->approved == '2')
                                                    <td>
                                                        <div class="badge badge-light-success">Approved</div>
                                                    </td>
                                                @elseif($request->approved == '3')
                                                    <td>
                                                        <div class="badge badge-light-danger">Rejected</div>
                                                    </td>
                                                @else
                                                    <td>
                                                        <div class="badge badge-light-warning">Pending</div>
                                                    </td>
                                                @endif
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('cashier.approval-requests.show', $request->id) }}"
                                                            class="btn btn-warning btn-sm waves-effect waves-light">Show</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-responsive">
                                <p class="text-center">No Listing found.</p>
                            </div>
                        @endif
                    </div>
                    @if (count($approval_requests) > 5)
                        <div class="card-footer text-center">
                            <a href="{{ route('cashier.approval-requests.index') }}"
                                class="btn btn-outline-light square waves-effect waves-light">View All</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Recent  Approval Requests ends Here-->

        <!-- Recent  Deposit Requests starts Here-->
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Deposit Requests</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if (count($deposit_requests) > 0)
                            <div class="table-responsive" id="table-hover-animation">
                                <table class="table table-hover-animation mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="date-width">Date</th>
                                            <th>Cashier</th>
                                            <th>Player</th>
                                            <th>Email</th>
                                            <th class="text-center">Phone</th>
                                            <th>Gaming Platform</th>
                                            <th>Username</th>
                                            <th>Amount</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposit_requests as $request)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y h:i:s') }}
                                                </td>
                                                <td>
                                                    @if($request->status == '1')
                                                        @isset($request->cashier)
                                                            <div class="badge badge-light-success">{{ $request->cashier->name }}</div>
                                                        @else
                                                            <div class="badge badge-light-warning">Admin</div>
                                                        @endisset
                                                    @else
                                                        <div class="badge badge-light-danger">N/A</div>
                                                    @endif
                                                </td>
                                                <td>{{ $request->user->name }}</td>
                                                <td>{{ $request->user->email }}</td>
                                                <td class="text-center">{{ $request->user->phone }}</td>
                                                <td>{{ $request->platform->platform }}</td>
                                                <td>{{ $request->username }}</td>
                                                <td>$ {{ $request->amount }}</td>
                                                @if ($request->status == '0')
                                                    <td class="text-center">
                                                        <div class="button-group">
                                                            <a href="javascript:void(0)"
                                                                onclick="confirmDepositAccept({{ $request->id }});"
                                                                class="btn btn-warning btn-sm">Process</a>
                                                        </div>
                                                    </td>
                                                @endif
                                                @if ($request->status == '1')
                                                    <td class="text-center">
                                                        <span class="text-success">Approved</span>
                                                    </td>
                                                @endif
                                                @if ($request->status == '2')
                                                    <td class="text-center">
                                                        <span class="text-danger">Rejected</span>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-responsive">
                                <p class="text-center">No Listing found.</p>
                            </div>
                        @endif
                    </div>
                    @if (count($deposit_requests) > 5)
                        <div class="card-footer text-center">
                            <a href="{{ route('cashier.deposit-requests.index') }}"
                                class="btn btn-outline-light square waves-effect waves-light">View All</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Recent Deposit Requests ends Here-->

        <!-- Recent Redeem Requests starts Here-->
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Redeem Requests</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @if (count($redeem_requests) > 0)
                            <div class="table-responsive" id="table-hover-animation">
                                <table class="table table-hover-animation mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="date-width">Date</th>
                                            <th scope="col">Cashier</th>
                                            <th scope="col">Player</th>
                                            <th scope="col">Game</th>
                                            <th scope="col">Game Credentials</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Payout Details</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($redeem_requests as $request)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}<br/>
                                                    {{ Carbon\Carbon::parse($request->created_at)->format('h:i:s') }}
                                                </td>
                                                <td>
                                                    @if($request->status == '1')
                                                        @isset($request->cashier)
                                                            <div class="badge badge-light-success">{{ $request->cashier->name }}</div>
                                                        @else
                                                            <div class="badge badge-light-warning">Admin</div>
                                                        @endisset
                                                    @elseif($request->status == '2')
                                                        @isset($request->cashier)
                                                            <div class="badge badge-light-success">{{ $request->cashier->name }}</div>
                                                        @else
                                                            <div class="badge badge-light-warning">Admin</div>
                                                        @endisset
                                                    @else
                                                        <div class="badge badge-light-danger">N/A</div>
                                                    @endif
                                                </td>
                                                <td>{{ $request->user->name }}</td>
                                                <td>{{ $request->platform->platform }}</td>
                                                <td>
                                                    <span class="text-danger">Username:</span> <span class="float-right">
                                                        {{ $request->username }}</span><br>
                                                    <span class="text-danger">Password:</span> <span class="float-right">
                                                        {{ getPasswordByUserId($request->user_id, $request->platform_id) }}</span><br>
                                                </td>

                                                <td>
                                                    @if ($request->redeem_full == 'yes')
                                                        Full
                                                    @else
                                                    $ {{ $request->amount }} @endisset
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-info show-credentials"
                                                        data-toggle="modal" data-target="#modal-show-credentials"
                                                        data-payment_method="{{ $request->paymentMethod->method }}"
                                                        data-method="{{ $request->payment_method_id }}"
                                                        data-bitcoin_address="{{ $request->bitcoin_address }}"
                                                        data-cashtag="{{ $request->cashtag }}">Show </a>
                                                </td>
                                                @if ($request->status == '0')
                                                    <td class="text-center">
                                                        <div class="button-group">
                                                            @if ($request->redeem_full == 'yes')
                                                                <a data-id="{{ $request->id }}" title="Add this item"
                                                                    class="btn btn-dark btn-sm enterAmountDialog" href="#login-modal">Accept</a>
                                                            @else
                                                                <a href="javascript:void(0)" onclick="confirmAccept({{ $request->id }});"
                                                                    class="btn btn-dark btn-sm">Accept</a>
                                                            @endif
                                                            <a href="javascript:void(0)" onclick="confirmReject({{ $request->id }});"
                                                                class="btn btn-danger btn-sm">Reject</a>
                                                        </div>
                                                    </td>
                                                @endif
                                                @if ($request->status == '1')
                                                    <td class="text-center">
                                                        <span class="text-success">Accepted</span>
                                                    </td>
                                                @endif
                                                @if ($request->status == '2')
                                                    <td class="text-center">
                                                        <span class="text-danger">Rejected</span>
                                                    </td>
                                                @endif
                                                @if ($request->status == '3')
                                                    <td class="text-center">
                                                        <div class="button-group">

                                                            <a href="javascript:void(0)" onclick="confirmAccept({{ $request->id }});"
                                                                class="btn btn-warning btn-sm">Approve</a>

                                                            <a href="javascript:void(0)" onclick="confirmReject({{ $request->id }});"
                                                                class="btn btn-danger btn-sm">Reject</a>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="table-responsive">
                                <p class="text-center">No Listing found.</p>
                            </div>
                        @endif
                    </div>
                    @if (count($redeem_requests) > 5)
                        <div class="card-footer text-center">
                            <a href="{{ route('cashier.redeem-requests.index') }}"
                                class="btn btn-outline-light square waves-effect waves-light">View All</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Recent Redeem Requests ends Here-->
</section>

<!-- Confirm Delete for Player  Starts Here-->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="" id="deleteForm">
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <input type='hidden' name='_method' value='DELETE'>
                <div class="modal-header bg-danger">
                    <h4 class="modal-title has-icon text-white"><i class="flaticon-alert-1"></i> Are you sure ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <p>You won't be able to revert this player once deleted!</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success shadow-none">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Confirm Delete for Player Section Ends here-->

<!-- Show Payout Details Starts Here-->
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
<!-- Show Payout Details Ends Here-->
@endsection
@push('scripts')
<!-- Confirm Delete Scripts Start -->
<script>
    $(document).on("click", ".confirmDelete", function(e) {

        e.preventDefault();

        var _self = $(this);

        var requestId = _self.data('id');

        form_action = '{{ route('cashier.players.destroy', ':id') }}';
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
<script type="text/javascript">
    function confirmDepositAccept(id) {
        url_string = '{{ route('cashier.deposit-requests.show', ':id') }}';
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
</script>
@endpush
