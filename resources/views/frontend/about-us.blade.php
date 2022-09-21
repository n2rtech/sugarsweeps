@extends('layouts.app')
@section('title', 'DragonStakes')
@section('content')
    <div class="container">

    </div>
    <main>
        <div class="text-center btn-warning">
            <div class="col-md-6 mx-auto p-4 my-5">
                <h1 class="display-4 fw-normal"> DragonStakes</h1>

                <h6 class="text-white">We have been ranked #1 for payouts so that you don't settle for less! It’s your world, start
                    playing now!</h6>
            </div>
            <div class="product-device shadow-sm d-none d-md-block"></div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>

        <div class="p-5 mb-4 bg-primary rounded-3">
            <div class="container-fluid ">
                <h1 class="display-5 fw-bold mb-3">About Us</h1>
                <p>Jay Casino is an innovative approach to accessing your favorite Online Sweeps Fish Games
                    for never-ending fun. The next generation of gaming is here.</p>


                <p>Jay Casino was designed with all of your interests in mind. With gaming software and
                    fun platforms like Smash, Fire Kirin, River Sweeps, and Ultra Monster to pick from, you'll have access
                    to the future of fish games.</p>
                <p> There are several unique features here, including an individual dashboard with the
                    extra convenience of playing games anywhere, at any time. Find Online Fish Table Games that will
                    transform your living space into an arcade and place you at the Centre of the action.</p>
                <p> Why Jay Casino?</p>
                <p>- There are no daily redemption limits.</p>
                <p>- Round-the-clock customer service and instant response time.</p>
                <p>- Advanced payment security for all of your transactions.</p>
                <p>- 24/7 deposits and redeems.</p>
                    @guest
                    <a class="btn btn-dark" href="{{ route('register') }}">Sign Up for Free</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg">Login</a>
                    @endguest
                    @auth
                    <a href="{{ route('home') }}" class="btn btn-dark btn-lg">Dashboard</a>
                    @endauth

            </div>
        </div>

    </main>
@endsection
