@extends('layouts.app')
@section('title', 'Transaction History')
@section('content')

    @include('frontend.sections.flashmessage')
    <div class="home-bg" id="reload-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="reload">
                        <h2>Transaction History</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mt-5">
            <div class="row">
                <div class="col-md-12 text-dark roboto-font">
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
                                            <td>{{ Carbon\Carbon::parse($history->created_at)->format('d-m-Y h:i:s') }}
                                            </td>
                                            <td>{{ ucfirst($history->type) }}</td>
                                            <td>{{ $history->mode ?? 'N/A' }}</td>
                                            <td>${{ $history->amount ?? 'Full' }}</td>
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
                            <p class="text-center">No History found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 10rem!important;">
        @include('frontend.footer')
    </div>
@endsection
