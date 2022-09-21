@extends('layouts.app')
@section('title', '404 Page not found | DragonStakes')
@section('content')
<style type="text/css">
    body{
        background: #000;
    }
</style>
<div class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="{{ asset('assets/img/error-404.png') }}" alt="Error" class="img-responsive">
            </div>
            <div class="col-sm-12 text-center">
                <a href="/" class="back-home">Back to Home</a>
            </div>
        </div>

    </div>
</div>
    @include('frontend.footer')
@endsection
