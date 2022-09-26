@extends('layouts.admin')
@section('title', 'Create Gaming Package')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Create Gaming Package</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('admin.gaming-packages.store') }}" method="POST" id="gamingForm"
                        enctype="multipart/form-data">
                        @csrf


                    </form>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success" form="gamingForm">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
