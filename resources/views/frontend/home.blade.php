@extends('layouts.front')

@section('title', 'Play Online Sweeps Fish Games | SugarSweeps')

@section('seo')

    <meta name="keywords" content="Online Sweeps Fish Games, Play Online Sweeps Fish Games, Fish Game Online, Online Fish Game, Fish Table Game Online, Online Fish Table Game, Fish Table Games Online, Online Fish Table Games, Play Fish Table Game Online, Best Online Fish Table Games, Best Fish Games Online, Online Sweeps Games, Sweep Game Online">

    <meta name="description" content="An innovative software platform for the game lovers to play online Sweeps fish games for never-ending fun. Register with us today!"/>

    <meta name="author" content="SugarSweeps" />

@endsection

@section('content')

    @include('frontend.components.hero')

    <main id="main">

        @include('frontend.components.our-games')

        @include('frontend.components.reload')

        @include('frontend.components.redeem')

        @include('frontend.components.contact')

    </main>
@endsection
@push('scripts')
    @include('frontend.components.scripts')
@endpush
