@extends('layouts.admin')
@section('title','Change Password')
@section('content')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="ms-panel-custom">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item" aria-current="page"> <a href="{{ route('admin.dashboard') }}"><i class="material-icons">home</i>
                        Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="ms-panel">
            <div class="ms-panel-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Change Password</h6>
                    </div>
                </div>
            </div>
            <div class="ms-panel-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <form class="form-horizontal" id="passwordForm" action="{{route('admin.change-password')}}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="current_password">Current Password</label>
                                <div class="input-group input-group-merge">
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" autocomplete="off" placeholder="Current Password">
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="off" placeholder="New Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm New Password</label>
                                <div class="input-group input-group-merge">
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation" autocomplete="off"
                                        placeholder="Confirm New Password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group mb-0 justify-content-end row text-right">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-warning btn-sm" form="passwordForm"><i
                                            class="mdi mdi-key"></i> Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
