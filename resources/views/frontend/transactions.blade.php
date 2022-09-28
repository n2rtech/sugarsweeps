@extends('layouts.front')
@section('title', 'Transactions | SugarSweeps')
@section('content')

<!-- ======= Transactions Section ======= -->
<section id="transactions" class="transactions">
    <div class="container">
        <div class="section-title">
            <h2><span class="text-primary">Transactions</span></h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-10 col-md-10 align-items-stretch m-auto text-white">
            @if (count($histories) > 0)
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="date-width">Date & Time</th>
                                <th>Credits status</th>
                                <th>Payment mode</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td class="text-white">{{ Carbon\Carbon::parse($history->created_at)->format('d-m-Y h:i:s') }}
                                    </td>
                                    <td class="text-white">{{ ucfirst($history->type) }}</td>
                                    <td class="text-white">{{ $history->mode ?? 'N/A' }}</td>
                                    <td class="text-white">${{ $history->amount ?? 'Full' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    {{ $histories->links('vendor.pagination.bootstrap-4') }}
                </div>
            @else
                <div class="table-responsive">
                    <p class="text-center text-white">No History found.</p>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- ======= End Transactions Section ======= -->
@endsection
