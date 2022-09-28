@extends('layouts.cashier')
@section('title', 'Show Player')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Show Player</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <a class="btn btn-dark btn-md waves-effect waves-light" href="{{ url()->previous() }}">Back</a>
                    @if ($player->approved == '2')
                        <a class="btn btn-success btn-md waves-effect waves-light" href="javascript:void(0)">Approved</a>
                    @elseif($player->approved == '3')
                        <a class="btn btn-danger btn-md waves-effect waves-light" href="javascript:void(0)">Rejected</a>
                    @else
                        <a class="btn btn-warning btn-md waves-effect waves-light" href="javascript:void(0)">Pending</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('admin.sections.flash-message')
    <div class="row">
        <div class="col-md-8">
            <div class="content-body">

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Name</span>
                                    <span class="text-primary">{{ $player->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Email</span>
                                    <span class="text-primary">{{ $player->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Phone</span>
                                    <span class="text-primary">{{ $player->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span> Account Created On</span>
                                    <span class="text-primary">{{ $player->created_at }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content-body">
                <img id="preview_img" src="{{ $player->photo_id }}" class="img-fluid" />
            </div>
        </div>
    </div>
@endsection
