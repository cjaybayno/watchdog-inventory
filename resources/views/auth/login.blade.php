@extends('layouts.adminlteLogin')
@section('title', 'Login')

@section('addStylesheets')
	<link rel="stylesheet"  href="{!! asset('public/adminlte/plugins/iCheck/square/blue.css') !!}" >
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte//plugins/iCheck/icheck.min.js') !!}" ></script>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
		});
	  });
	</script>
@endsection

@section('content')
 <div class="login-box">
  <div class="login-logo">
	<a href="#"><b>Watchdog</b> Inventory</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
	<p class="login-box-msg">
	  @if (session('success_message'))
	    <div class="alert alert-success">
		  <i><center>{{ session('success_message') }}</center></i>
		</div>
	  @elseif(session('failed_message'))
	    <div class="alert alert-danger">
		  <i><center>{{ session('failed_message') }}</center></i>
		</div>
	  @endif
	</p>
	<form method="POST" action="{{ URL::to('login') }}">
	  {!! csrf_field() !!}
	  <div class="form-group has-feedback {{ ! empty($errors->first('username')) ? 'has-error' : '' }} ">
		@if (! empty($errors->first('username')))
		  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('username') }}</label>
		@endif
		<input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
	  </div>
	  <div class="form-group has-feedback {{ ! empty($errors->first('password')) ? 'has-error' : '' }} ">
		@if (! empty($errors->first('password')))
		  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('password') }}</label>
		@endif
		<input type="password" name="password" class="form-control" placeholder="Password">
	  </div>
	  <div class="row">
		<div class="col-xs-8">
		  <div class="checkbox icheck">
			<label>
			  <input type="checkbox" name="remember"> Remember Me
			</label>
		  </div>
		</div><!-- /.col -->
		<div class="col-xs-4">
		  <div>
			<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
		  </div>
		</div><!-- /.col -->
	  </div>
	</form>
	
	 <div class="social-auth-links text-center">
	  <a href="{{ URL::to('auth/fb') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Log in with Facebook</a>
	  <a href="{{ URL::to('auth/google') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Log in with Google</a>
	</div><!-- /.social-auth-links -->
	
	<a href="{{ URL::to('password/email') }}">Forgot password</a><br>
	<!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection