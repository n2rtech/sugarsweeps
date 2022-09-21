@extends('layouts.app')
@section('title', 'DragonStakes')
@section('content')
    <main>
        <div class="bg-primary rounded-3">
            <div class="container-fluid py-4">
                <h1 class="display-5 fw-bold">Gaming Platforms</h1>
                <div class="row">
                    @foreach ($platforms as $platform)
                        <div class="col-lg-6 mb-3">
                            <div class="card">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-md-4">
                                        <img @isset($platform->image) src="{{ asset('storage/uploads/gaming-platforms/' . $platform->image) }}" @else src="{{ asset('assets/img/game-placeholder.jpg') }}" @endif
                                            class="card-img" alt="{{ $platform->platform }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $platform->platform }}</h5>
                                            <p class="card-text">
                                                <a href="{{ $platform->download_link }}" target="_blank"><small
                                                        class="text-muted">Click here to
                                                        download</small></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
