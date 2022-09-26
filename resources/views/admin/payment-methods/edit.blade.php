@extends('layouts.admin')
@section('title', 'Edit Payment Method')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Payment Method</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('admin.payment-methods.update', $method->id) }}" method="POST" id="paymentForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="method" class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="method" placeholder="Payment Method"
                                    name="method" value="{{ old('method', $method->method) }}">
                                @error('method')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="statuses" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                    <input type="checkbox" class="custom-control-input" id="statuses" name="status"
                                        value="1" @if (old('status', $method->status) == 1) checked @endif>
                                    <label class="custom-control-label" for="statuses">
                                        <span class="switch-text-left"><i class="feather icon-check"></i></span>
                                        <span class="switch-text-right"><i class="feather icon-x"></i></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success" form="paymentForm">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
