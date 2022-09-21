@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
	<i class="flaticon-tick-inside-circle"></i> <strong>Well done!</strong> {{ $message }}
</div>
@endif


@if ($message = Session::get('delete'))
<div class="alert alert-danger" role="alert">
	<i class="flaticon-alert-1"></i> <strong>Oh snap!</strong> {{ $message }}
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning" role="alert">
	<i class="flaticon-alert"></i> <strong>Warning!</strong> {{ $message }}
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info" role="alert">
	<i class="flaticon-information"></i> <strong>Heads up!</strong> {{ $message }}
</div>
@endif


{{-- @if ($errors->any())
<div class="alert alert-danger" role="alert">
	<i class="flaticon-alert"></i> <strong>Warning! Please check all form fields below.</strong> {{ $message }}
</div>
@endif --}}
