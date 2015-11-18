@extends('layouts.adminlteLogin')
@section('title', 'Reset Password')

@section('content')
<div class="login-box">
  <div class="login-logo">
	<a href="#"><b>Admin</b>LTE</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
	<p class="login-box-msg">
		<h2 class="text-blue">Reset Password?</h2>
		Fill up all the fields:
	</p>
	<form method="POST" action="{{ URL::to('password/reset') }}" >
	  {!! csrf_field() !!}
	  <input type="hidden" name="token" value="{{ $token }}">
	  <div class="form-group has-feedback {{ ! empty($errors->first('email')) ? 'has-error' : '' }}">
	    @if (! empty($errors->first('email')))
		  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('email') }}</label>
		@endif
		<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
	  </div>
	  <div class="form-group has-feedback {{ ! empty($errors->first('password')) ? 'has-error' : '' }}">
		@if (! empty($errors->first('password')))
		  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('password') }}</label>
		@endif
		<input type="password" name="password" class="form-control" placeholder="Password">
	  </div>
	  <div class="form-group has-feedback">
		<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
	  </div>
	  <br>
	  <div class="row">
		<div class="col-xs-5">
		  <div>
			<button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
		  </div>
		</div><!-- /.col -->
	  </div>
	</form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection