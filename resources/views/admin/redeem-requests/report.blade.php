@extends('layouts.admin')
@section('title', 'Redeem Report')
@section('head')
<style type="text/css">
    .filterCol .form-group {
        margin-bottom: 10px;
    }

    .filterCol .form-group input {
        max-width: unset;
    }
    .invalid-feedback{
        display: block;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Redeem Report</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card widget-flat bg-success text-white">
            <div class="card-body">
                <div class="float-right">
                    <i class="mdi mdi-account-multiple widget-icon bg-white text-success"></i>
                </div>
                <h2 class="text-uppercase mt-0 text-white" title="Customers">{{
                    $cashier_selected->firstname }} {{
                    $cashier_selected->lastname }}</h2>
                <h3 class="mt-3 mb-3 text-white">Amount Redeemed: ${{
                    $redeem_requests }}</h3>
                    @if (isset($request_platform))
                    <p class="mb-0 text-white"><i class="mdi mdi-gamepad-circle-outline"></i> {{ \App\Models\GamingPlatform::find($request_platform)->platform }} Platform</p>
                    @else
                    <p class="mb-0 text-white"><i class="mdi mdi-gamepad-circle-outline"></i> All Platforms</p>
                    @endif

                <p class="mb-0">
                    @if(isset($period))

                    @if($period == '1')
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  Today
                    </span>
                    @endif
                    @if($period == '2')
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  Yesterday
                    </span>
                    @endif
                    @if($period == '3')
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  This Week
                    </span>
                    @endif
                    @if($period == '4')
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  This Month
                    </span>
                    @endif

                    @endif

                    @if(isset($datefrom) && !isset($dateto))
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  From {{ Carbon\Carbon::parse($datefrom)->format('d-m-Y') }} - Till now
                    </span>
                    @endif

                    @if(isset($dateto) && !isset($datefrom))
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  Till {{ Carbon\Carbon::parse($dateto)->format('d-m-Y') }}
                    </span>
                    @endif

                    @if(isset($dateto) && isset($datefrom))
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  From {{ Carbon\Carbon::parse($datefrom)->format('d-m-Y') }} - Till {{ Carbon\Carbon::parse($dateto)->format('d-m-Y') }}
                    </span>
                    @endif

                    @if(!isset($dateto) && !isset($datefrom) && !isset($period))
                    <span class="text-nowrap text-white">
                        <i class="mdi mdi-calendar"></i>  All Time
                    </span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.get-report') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Choose Cashier</label>
                        <select id="cashier" class="form-control" name="cashier" autofocus>
                            <option value="" selected>Choose Cashier</option>
                            @foreach($cashiers as $cashier)
                            <option value="{{ $cashier->id }}" @if($request_cashier==$cashier->id) selected @endif>{{ $cashier->firstname }} {{ $cashier->lastname }}</option>
                            @endforeach
                        </select>
                        @error('cashier')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Choose Gaming Platform</label>
                        <select id="platform" class="form-control" name="platform" autofocus>
                            <option value="" selected>All</option>
                            @foreach($platforms as $platform)
                            <option value="{{ $platform->id }}" @if($request_platform==$platform->id) selected @endif>{{ $platform->platform }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date From</label>
                        <input type="date" name="datefrom" id="datefrom" class="form-control" placeholder="From"
                            onfocus="removeselected()" value="{{ $datefrom }}">
                    </div>

                    <div class="form-group">
                        <label>Date To</label>
                        <input type="date" name="dateto" class="form-control" id="dateto" placeholder="Till"
                            onfocus="removeselected()" value="{{ $dateto }}">
                    </div>
                    <div class="form-group">
                        or
                    </div>
                    <div class="form-group">
                        <label>Select Time</label>
                        <select id="period" class="form-control" name="period" onchange="removedate()">
                            <option value="" selected>Select Time</option>
                            <option value="1" @if($period=='1' ) selected @endif>Today</option>
                                            <option value="2" @if($period=='2' ) selected @endif>Yesterday</option>
                                            <option value="3" @if($period=='3' ) selected @endif>This Week</option>
                                            <option value="4" @if($period=='4' ) selected @endif>This Month</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">
                            Generate Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function confirmAccept(id){
        url_string = '{{ route("admin.redeem-requests.show", ":id") }}';
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

    function confirmReject(id){
        url_string = '{{ route("admin.redeem-requests.edit", ":id") }}';
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
    function removeselected(){
        $("#period").val([]);
    }
</script>
<script>
    function removedate(){
            $("#datefrom").val([]);
            $("#dateto").val([]);
        }
</script>
@endpush
