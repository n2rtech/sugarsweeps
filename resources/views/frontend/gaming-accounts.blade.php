@extends('layouts.front')
@section('title', 'Gaming Accounts')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Gaming Accounts</h6>
                        </div>
                    </div>
                </div>
                <div class="ms-panel-body">
                    <div class="row">
                        @foreach ($platforms as $platform)
                            <div class="col-lg-6 mb-3">
                                <div class="card">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-4">
                                            <img @isset($platform->image) src="{{ asset('storage/uploads/gaming-platforms/' . $platform->image) }}" @else src="{{ asset('assets/img/game-placeholder.jpg') }}" @endif
                                                class="card-img" alt="{{ $platform->platform }}">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $platform->platform }}</h5>
                                                @if (checkIfAccountIsRequested($platform->id))
                                                    @if (checkIfCredentialsGenerated($platform->id))
                                                        <p class="card-text">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-square btn-gradient-danger show-credentials"
                                                                data-toggle="modal" data-target="#modal-show-credentials"
                                                                data-platform="{{ $platform->platform }}"
                                                                data-username="{{ getUsername($platform->id) }}"
                                                                data-password="{{ getPassword($platform->id) }}">Show
                                                                Credentials</a>
                                                        </p>
                                                    @else
                                                        <p class="card-text">
                                                            <a href="javascript:void(0)"
                                                                class="btn btn-sm btn-square btn-gradient-secondary">Account
                                                                Requested</a>
                                                        </p>
                                                    @endif
                                                @else
                                                    <p class="card-text">
                                                        <a href="{{ route('request-account', $platform->id) }}"
                                                            class="btn btn-sm btn-square btn-gradient-primary">Request
                                                            Account</a>
                                                    </p>
                                                @endif

                                                <p class="card-text">
                                                    <a href="{{ $platform->download_link }}" target="_blank"><small
                                                            class="text-muted">Click here to
                                                            download</small></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-show-credentials" tabindex="-1" role="dialog" aria-labelledby="modal-show-credentials" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-min" role="document">
          <div class="modal-content">

            <div class="modal-body text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <i class="flaticon-secure-shield d-block"></i>
              <h1 id="platform">Subscribe</h1>
              <p>Given below are your Account credentials</p>
              <div class="table-responsive">
                <table class="table table-bordered thead-primary">
                  <tbody>
                    <tr>
                      <th scope="row" class="text-danger">Username</th>
                      <td id="username"></td>
                    </tr>
                    <tr>
                      <th scope="row" class="text-danger">Password</th>
                      <td id="password"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>

@endsection
@push('scripts')
    <script>
        $(".show-credentials").click(function() {

            var platform = $(this).data('platform');
            var username = $(this).data('username');
            var password = $(this).data('password');

            $('#platform').text(platform);
            $('#username').text(username);
            $('#password').text(password);

        });
    </script>
@endpush
