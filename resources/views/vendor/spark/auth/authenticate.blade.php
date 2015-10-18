@extends('spark::layouts.skeleton')

<!-- Main Content -->
@section('content')
<div class="container-fluid container-fill-height">

	<div class="container-content-middle container spark-screen" id="spark-authenticate-screen">

		<form role="form" action="{{ url('/login') }}" method="POST" class="m-x-auto text-center app-login-form">

			{!! csrf_field() !!}
			<a href="{{ route('home') }}" class="app-brand m-b-lg">
				<img src="{{ asset('images/cmv-logo-application.png') }}" alt="brand">
			</a>
			@include('spark::common.errors', ['form' => 'default'])
			<div class="form-group">
				<input type="email" placeholder="Your Email Address" class="form-control spark-first-field" name="email" value="{{ old('email') }}">
			</div>

			<div class="form-group m-b-md">
				<input type="password" placeholder="Password" class="form-control" name="password">
			</div>
			<input type="hidden" value="1" name="remember">
			<div class="m-b-lg">
				<button type="submit" class="btn btn-primary btn-block">Log In</button>

				<hr />

				<div class="btn-group btn-group-sm">
					<a href="{{ url('/register') }}" class="btn btn-success btn-sm">Create Account</a>
					<a href="{{ url('/password/email') }}" class="btn btn-default text-muted btn-sm">Forgot password</a>
				</div>
				
			</div>
		</form>
	</div>
</div>
@endsection
