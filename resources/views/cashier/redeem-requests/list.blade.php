@extends('layouts.cashier')
@section('title', 'Redeem Requests')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Redeem Requests</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <a href="javascript:void(0)" id="filter"
                        class="btn btn-info btn-md waves-effect waves-light">Filter</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('cashier.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-md-12" id="filterBox">
                        <form action="{{ route('cashier.redeem-requests.index') }}">
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
                                        <select class="form-control" name="platform" id="platform">
                                            <option value="" selected>Select Platform</option>
                                            @foreach ($platforms as $platform)
                                                <option {{ $platform->id }}
                                                    @if ($gaming_platform == $platform->id) selected @endif>
                                                    {{ $platform->platform }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <select class="form-control" id="status" name="status">
                                            <option value="" selected>Select Status</option>
                                            <option value="0" {{ $request_status == '0' ? 'selected' : '' }}>
                                                Requested</option>
                                            <option value="1" {{ $request_status == '1' ? 'selected' : '' }}>
                                                Approved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <input type="text" name="username" class="form-control" placeholder="Player Username"
                                        value="{{ $username }}">
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <select id="payment_method" class="form-control" name="payment_method" autofocus>
                                            <option value="" selected>Payout Method</option>
                                            @foreach ($methods as $method)
                                                <option value="{{ $method->id }}"
                                                    @if ($payment_method == $method->id) selected @endif>
                                                    {{ $method->method }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <div class="input-group">
                                        <select id="period" class="form-control" name="period" autofocus>
                                            <option value="">Action taken</option>
                                            <option value="1" @if ($period == '1') selected @endif>
                                                Today</option>
                                            <option value="2" @if ($period == '2') selected @endif>
                                                Yesterday</option>
                                            <option value="3" @if ($period == '3') selected @endif>
                                                This Week</option>
                                            <option value="4" @if ($period == '4') selected @endif>
                                                This Month</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-12 mb-1">
                                    <input type="date" name="date" class="form-control" placeholder="Date"
                                        value="{{ $date }}">
                                </div>
                                <div class="col-xl-4 col-md-12 text-right">
                                    <button class="btn btn-md btn-secondary" type="submit"><i
                                            class="feather icon-search"></i></i></button>
                                    <a href="{{ route('cashier.redeem-requests.index') }}" class="btn btn-md btn-warning"
                                        type="submit"><i class="feather icon-refresh-cw"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                                            <td>{{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }} <br/>
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
                                                        class="btn btn-dark btn-sm enterAmountDialog"
                                                        href="#login-modal">Accept</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmAccept({{ $request->id }});"
                                                        class="btn btn-dark btn-sm">Accept</a>
                                                @endif
                                                <a href="javascript:void(0)"
                                                    onclick="confirmReject({{ $request->id }});"
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

                                                <a href="javascript:void(0)"
                                                    onclick="confirmAccept({{ $request->id }});"
                                                    class="btn btn-warning btn-sm">Approve</a>

                                                <a href="javascript:void(0)"
                                                    onclick="confirmReject({{ $request->id }});"
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
    </div>
</div>
</div>
{{ $redeem_requests->links('vendor.pagination.bootstrap-4') }}
<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="text-center">
                <i class="dripicons-warning h1 text-warning"></i>
                <h4 class="mt-2">Redeem Full amount</h4>
            </div>


            <form action="{{ route('cashier.redeem.full') }}" class="pl-3 pr-3" id="approveAmount"
                method="POST">
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

<!-- Filter Box Scripts Start -->
<script>
    $(document).ready(function() {
        var filterBox = '{{ $filter_box }}';
        if (filterBox === 'show') {
            $("#filterBox").css('display', 'block');
        }

        $("#filter").click(function() {
            $("#filterBox").slideToggle();
        });

    });
</script>
<!-- Filter Box Scripts End -->
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
