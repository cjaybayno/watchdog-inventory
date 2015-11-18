@extends('layouts.adminlteLogin')
@section('title', 'Forget Password')

@section('content')
<div class="login-box">
  <div class="login-logo">
	<a href="#"><b>Admin</b>LTE</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
	<p class="login-box-msg">
		<h2 class="text-blue">Forgot Password?</h2>
		Enter your e-mail address:
	</p>
	<form method="POST" action="{{ URL::to('password/email') }}" >
	  {!! csrf_field() !!}
	  <div class="form-group has-feedback {{ ! empty($errors->first('email')) ? 'has-error' : '' }}">
		@if (! empty($errors->first('email')))
		  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('email') }}</label>
		@endif
		<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	  </div>
	  <br>
	  <div class="row">
		<div class="col-xs-4">
		  <div>
			<a href="{{ URL::to('login') }}">
				<div class="btn btn-default btn-block btn-flat">Login</div>
			</a>
		  </div>
		</div><!-- /.col -->
		<div class="col-xs-4"></div>
		<div class="col-xs-4">
		  <div>
			<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
		  </div>
		</div><!-- /.col -->
	  </div>
	</form>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection