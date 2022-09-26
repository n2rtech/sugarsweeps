@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<section id="dashboard-ecommerce">

    @include('admin.sections.flash-message')

    <!-- Admin Stats starts Here-->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ $total_players }}</h2>
                    <p class="mb-0">Total Players</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-gitlab text-success font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ $total_cashiers }}</h2>
                    <p class="mb-0">Total Cashiers</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-download-cloud text-danger font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ $total_credit_requests }}</h2>
                    <p class="mb-0">Credit Requests</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column align-items-start pb-0">
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-upload-cloud text-warning font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="text-bold-700 mt-1">{{ $total_redeem_requests }}</h2>
                    <p class="mb-0">Redeem Requests</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Admin Stats ends Here-->

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
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('admin.players.edit', $player->id) }}" class="btn btn-warning btn-sm waves-effect waves-light">Edit</a>
                                                    <a href="#modal-delete" data-id="{{ $player->id }}"  data-toggle="modal" data-target="#modal-delete" class="confirmDelete btn btn-sm btn-danger waves-effect waves-light">Delete</a>
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
            </div>
        </div>
    </div>
    <!-- Recent  Player ends Here-->

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

@endsection
@push('scripts')
<!-- Confirm Delete Scripts Start -->
<script>
    $(document).on("click", ".confirmDelete", function(e) {

        e.preventDefault();

        var _self = $(this);

        var requestId = _self.data('id');

        form_action = '{{ route('admin.players.destroy', ':id') }}';
        url = form_action.replace(':id', requestId);

        $('#deleteForm').attr('action', url);


        $(_self.attr('href')).modal('show');
    });
</script>
<!-- Confirm Delete Scripts End -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function confirmAccept(id) {
        url_string = '{{ route('admin.redeem-requests.show', ':id') }}';
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
        url_string = '{{ route('admin.redeem-requests.edit', ':id') }}';
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
