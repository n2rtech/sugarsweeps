@extends('layouts.admin')
@section('title','Change Password')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Change Password</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <a class="btn btn-dark btn-md waves-effect waves-light"
                    href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    @include('admin.sections.flash-message')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form class="form-horizontal" id="passwordForm" action="{{route('admin.cashier.change-password')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cashier_id" value="{{ $id }}">
                    <div class="form-group">
                        <label for="password">New Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" placeholder="New Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="off" placeholder="Confirm New Password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success" form="passwordForm">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection
