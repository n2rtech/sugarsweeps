@extends('layouts.front')
@section('title', 'Privacy Policy | SugarSweeps')
@section('content')

<!-- ======= Privacy Policy Section ======= -->
<section id="privacy-policy" class="privacy-policy">
    <div class="container">
        <div class="section-title">
            <h2><span class="text-primary">Privacy Policy</span></h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-10 col-md-10 align-items-stretch m-auto text-white">
            {!! $privacy['content'] !!}
        </div>
    </div>
</section>
<!-- ======= End Privacy Policy Section ======= -->
@endsection
