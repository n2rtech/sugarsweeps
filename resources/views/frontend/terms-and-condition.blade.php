@extends('layouts.app')
@section('title', 'Terms and Conditions')
@section('content')

    @include('frontend.sections.flashmessage')
    <div class="home-bg" id="reload-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="reload">
                        <h2>Terms and Conditions</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mt-5">
            <div class="row">
                <div class="col-md-12 information-page">
                    {!! $terms['content'] !!}
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: 10rem!important;">
        @include('frontend.footer')
    </div>
@endsection
