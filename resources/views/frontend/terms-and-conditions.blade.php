@extends('layouts.front')
@section('title', 'Terms and conditions | SugarSweeps')
@section('content')

<!-- ======= Terms and conditions Section ======= -->
<section id="terms-and-conditions" class="terms-and-conditions">
    <div class="container">
        <div class="section-title">
            <h2><span class="text-primary">Terms and conditions</span></h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-10 col-md-10 align-items-stretch m-auto text-white">
            {!! $terms['content'] !!}
        </div>
    </div>
</section>
<!-- ======= End Terms and conditions Section ======= -->
@endsection
