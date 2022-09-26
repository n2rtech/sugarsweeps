@extends('layouts.cashier')
@section('title','Dashboard')
@section('content')
<div class="row">

    <div class="col-xl-3 col-md-6">
        <a href="{{ route('cashier.players.index') }}">
            <div class="ms-card card-gradient-success ms-widget ms-infographics-widget">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Players</h6>
                        <p class="ms-card-change"> {{ $total_players }}</p>
                    </div>
                </div>
                <i class="fas fa-users"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('cashier.gaming-requests.index')}}">
            <div class="ms-card card-gradient-secondary ms-widget ms-infographics-widget" style="height: 103px;">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Gaming Requests</h6>
                        <p class="ms-card-change">{{ $total_gaming_requests }}</p>
                        <p class="fs-12"></p>
                    </div>
                </div>
                <i class="flaticon-reuse"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('cashier.deposit-requests.index')}}">
            <div class="ms-card card-gradient-warning ms-widget ms-infographics-widget" style="height: 103px;">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Deposit Requests</h6>
                        <p class="ms-card-change">{{ $total_deposit_requests }}</p>
                    </div>
                </div>
                <i class="flaticon-supermarket"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6">
        <a href="{{route('cashier.redeem-requests.index')}}">
            <div class="ms-card card-gradient-info ms-widget ms-infographics-widget" style="height: 103px;">
                <div class="ms-card-body pos media">
                    <div class="media-body">
                        <h6>Redeem Requests</h6>
                        <p class="ms-card-change">{{ $total_redeem_requests }}</p>
                        <p class="fs-12"></p>
                    </div>
                </div>
                <i class="fas fa-cannabis"></i>
            </div>
        </a>
    </div>

    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Recent Players</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($players) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover thead-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Player</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Gaming Platforms</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($players as $player)
                                    <tr>
                                        <td>{{ $player->firstname }} {{ $player->lastname }}</td>
                                        <td>{{ $player->email }}</td>
                                        <td>{{ $player->phone }}</td>
                                        @if($player->status == 'inactive')
                                        <td><span class="badge badge-outline-danger">{{ ucfirst($player->status) }}</span>
                                        </td>
                                        @else
                                        <td><span class="badge badge-outline-light">{{ ucfirst($player->status) }}</span>
                                        </td>
                                        @endif
                                        @if(count($player->gamingAccount) > 0)
                                        <td>
                                            @foreach($player->gamingAccount as $account)
                                            <span class="badge badge-outline-primary">{{ $account->platform->platform }}</span>
                                            @endforeach
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-outline-danger">N/A</span>
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('cashier.players.show', $player->id) }}" class="ms-btn-icon btn-secondary"><i class="fas fa-eye ms-text-success"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                        <a href="{{ route('cashier.players.index') }}" class="btn btn-warning btn-sm">View all</a>
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
    </div>

    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Recent Gaming Requests</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (count($gaming_requests) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover thead-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Player</th>
                                            <th scope="col">Cashier</th>
                                            <th scope="col">Game</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gaming_requests as $request)
                                            <tr>
                                                <th scope="row">{{ \Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}</th>
                                                <th scope="row">{{ \Carbon\Carbon::parse($request->created_at)->format('H:i:s') }}</th>
                                                <td>{{ $request->user->firstname }} {{ $request->user->lastname }}</td>
                                                <td>@isset($request->cashier_id) {{ $request->cashier->firstname }} {{ $request->cashier->lastname }} @else N/A  @endisset</td>
                                                <td>{{ $request->platform->platform }}</td>
                                                <td>
                                                    @if($request->status == 0)
                                                   <span class="badge badge-outline-danger">Requested</span>
                                                    @else
                                                    <span class="badge badge-outline-success">Accepted</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('cashier.gaming-requests.edit', $request->id) }}" class="ms-btn-icon btn-secondary"><i
                                                            class="fas fa-eye ms-text-success"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 text-center">
                                <a href="{{ route('cashier.gaming-requests.index')}}" class="btn btn-sm btn-warning">View all</a>
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
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Recent Redeem Requests</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (count($redeem_requests) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover thead-dark">
                                    <thead>
                                        <tr>
                                            <th class="date-width">Date</th>
                                            <th class="date-width">Time</th>
                                            <th>Cashier</th>
                                            <th>Player</th>
                                            <th>Game</th>
                                            <th>Game Credentials</th>
                                            <th>Amount</th>
                                            <th>Payout Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($redeem_requests as $request)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($request->created_at)->format('h:i:s') }}
                                                </td>
                                                <td>
                                                    @if (isset($request->cashier))
                                                        {{ $request->cashier->firstname }}
                                                        {{ $request->cashier->lastname }}
                                                    @elseif($request->status == '1' && is_null($request->cashier))
                                                        <span
                                                            class="badge badge-outline-danger badge-pill">cashier</span>
                                                    @else
                                                        N/A
                                                    @endisset
                                            </td>
                                            <td>{{ $request->user->firstname }} {{ $request->user->lastname }}
                                            </td>
                                            <td>{{ $request->platform->platform }}</td>
                                            <td>
                                                <span class="text-danger">Username:</span> <span class="float-right"> {{ $request->username }}</span><br>
                                                <span class="text-danger">Password:</span> <span class="float-right"> {{ getPasswordByUserId($request->user_id, $request->platform_id) }}</span><br>
                                            </td>

                                            <td>
                                                @if ($request->redeem_full == 'yes')
                                                    Full
                                                @else
                                                $ {{ $request->amount }} @endisset
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)"
                                            class="btn btn-sm btn-square btn-gradient-info show-credentials"
                                            data-toggle="modal" data-target="#modal-show-credentials"
                                            data-payment_method="{{ $request->paymentMethod->method }}"
                                            data-method="{{ $request->payment_method_id }}"
                                            data-bitcoin_address="{{ $request->bitcoin_address }}"
                                            data-cashtag="{{ $request->cashtag }}">Show                                                </a>
                                        </td>
                                        @if ($request->status == '0')
                                            <td class="text-center">
                                                <div class="button-group">
                                                    @if ($request->redeem_full == 'yes')
                                                        <a data-id="{{ $request->id }}"
                                                            title="Add this item"
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
                    <div class="col-md-12 text-center">
                        <a href="{{ route('cashier.redeem-requests.index')}}" class="btn btn-sm btn-warning">View all</a>
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
    <div class="modal fade" id="modal-show-credentials" tabindex="-1" role="dialog" aria-labelledby="modal-show-credentials" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-min" role="document">
          <div class="modal-content">

            <div class="modal-body text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
        if(method == 1){
            $('#cryptocurrency').show();
            $('#cashapp').hide();
        }
        if(method == 2){
            $('#cryptocurrency').hide();
            $('#cashapp').show();
        }
        $('#paymentmethod').text(paymentmethod);
        $('#bitcoin_address').text(bitcoin_address);
        $('#cashtag').text(cashtag);

    });
</script>
@endpush
