@extends('layouts.admin')
@section('title', 'Import / Export Gaming Packages')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Import / Export Gaming Packages</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrum-right">
                <div class="dropdown">
                    <a class="btn btn-dark btn-md waves-effect waves-light" href="{{ url()->previous() }}">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        @include('admin.sections.flash-message')
        <section id="content-types">
            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="card text-white bg-gradient-primary">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title text-white">Import Gaming Packages</h4>
                                <h6 class="card-subtitle text-muted">Please download format <a class="text-warning" href="{{ asset('assets/format/packages.xlsx') }}" download>here</a></h6>
                            </div>
                            <div class="card-body">
                                <form class="form" method="POST" action="{{ route('admin.gaming-packages.import') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file" name="file">
                                                <label class="custom-file-label" for="file">Choose File</label>
                                            </div>
                                            @error('file')
                                                <div class="invalid-feedback text-white">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    <div class="form-group text-center">
                                        <button type="submit"
                                            class="btn btn-warning mr-1 waves-effect waves-light">Import</button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="card text-white bg-gradient-danger">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title text-white">Export Gaming Packages</h4>
                                <h6 class="card-subtitle text-muted">Exported in .csv or .xlsx file</h6>
                            </div>
                            <div class="card-body">
                                <form class="form" method="POST" action="{{ route('admin.gaming-packages.export') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <select name="type" id="export_type" class="form-control">
                                                <option value="">Select Export Type</option>
                                                <option value="0">All Packages</option>
                                                <option value="1">Assigned Packages</option>
                                                <option value="2">Unassigned Packages</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback text-white">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit"
                                            class="btn btn-info mr-1 waves-effect waves-light">Export</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
