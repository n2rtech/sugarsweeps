@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')

    @include('frontend.sections.flashmessage')
    <div class="home-bg" id="reload-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="reload">
                        <h2>Privacy Policy</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
       <div class="mt-5">
            <div class="row">
                <div class="col-md-12 information-page">
                    {!! $privacy['content'] !!}
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 10rem!important;">
        @include('frontend.footer')
    </div>
@endsection
