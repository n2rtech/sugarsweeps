@extends('layouts.admin')
@section('title', 'Redeem History')
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
    <div class="col-12">
        <p>Please select following fields accordingly.</p>
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
                            <option value="{{ $cashier->id }}">{{ $cashier->firstname }} {{ $cashier->lastname }}
                            </option>
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
                            <option value="{{ $platform->id }}">{{ $platform->platform }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date From</label>
                        <input type="date" name="datefrom" id="datefrom" class="form-control" placeholder="From"
                            onfocus="removeselected()">
                    </div>

                    <div class="form-group">
                        <label>Date To</label>
                        <input type="date" name="dateto" class="form-control" id="dateto" placeholder="Till"
                            onfocus="removeselected()">
                    </div>
                    <div class="form-group">
                        or
                    </div>
                    <div class="form-group">
                        <label>Select Time</label>
                        <select id="period" class="form-control" name="period" onchange="removedate()">
                            <option value="" selected>Select Time</option>
                            <option value="1">Today</option>
                            <option value="2">Yesterday</option>
                            <option value="3">This Week</option>
                            <option value="4">This Month</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">
                            Generate Report</button>
                    </div>
                </form>
                {{-- @if(count($redeem_requests) > 0)

                @else
                <div class="table-responsive">
                    <p class="text-center text-mute mt-3">No Redeem Request found.</p>
                </div>
                @endif --}}

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
