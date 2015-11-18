@extends('layouts.adminlte')
@section('title', 'User Register')

@section('addScripts')
	<script>
	  $(function () {
		/* === click clear button === */
		$("#clear-user-field").click(function() {
			clearInputs();
		});
	  });
	</script>
@endsection

@section('content')
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">
            User Registration
          </h1>
		  <div class="pull-right">
		    <a href="{{ URL::to('user') }}">
			  <button class="btn btn-block btn-primary"><span class="fa fa-arrow-left"></span> Back User List</button>
		    </a>
		  </div>
        </section>
		<br>
		<br>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
			<div class="row">
			  <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-primary">
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ URL::to('user/register') }}">
				  {!! csrf_field() !!}
                  <div class="box-body">
				  <div class="col-sm-offset-4 col-sm-5">
				    @if (session('register_status'))
					  <div class="alert alert-success">
					    <i><center>{{ session('register_status') }}</center></i>
					  </div>
				    @endif
				   </div>
				   <div class="row">
				     <div class="col-sm-offset-4 col-sm-5">
					  <a href="#">
					    <img src="{!! asset('public/images/users/icon-user-default.png') !!}" class="img-thumbnail" style="height:100px; width:100px">
					  </a>
				     </div>
				   </div>
				   <br>
					<div class="form-group {{ ! empty($errors->first('username')) ? 'has-error' : '' }}">
                      <label for="inputUsername3" class="col-sm-4 control-label">Username</label>
                      <div class="col-sm-5">
						@if (! empty($errors->first('username')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('username') }}</label>
						@endif
                        <input type="text" name="username" class="form-control" id="inputUsername3" placeholder="Username" value="{{ old('username') }}">
                      </div>
                    </div>
					<div class="form-group {{ ! empty($errors->first('password')) ? 'has-error' : '' }}">
                      <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                      <div class="col-sm-5">
						@if (! empty($errors->first('password')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('password') }}</label>
						@endif
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                      </div>
                    </div>
					<div class="form-group {{ ! empty($errors->first('password_confirmation')) ? 'has-error' : '' }}">
                      <label for="inputConfirmPassword3" class="col-sm-4 control-label">Confirm Password </label>
                      <div class="col-sm-5">
						@if (! empty($errors->first('password_confirmation')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('password_confirmation') }}</label>
						@endif
                        <input type="password" name="password_confirmation" class="form-control" id="inputConfirmPassword3" placeholder="Confirm Password">
                      </div>
                    </div>
					<br>
					 <div class="form-group {{ ! empty($errors->first('name')) ? 'has-error' : '' }}">
                      <label for="inputName3" class="col-sm-4 control-label">Full Name</label>
                      <div class="col-sm-5">
					    @if (! empty($errors->first('name')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('name') }}</label>
						@endif
                        <input type="text" name="name" class="form-control" id="inputName3" placeholder="name" value="{{ old('name') }}">
                      </div>
                    </div>
                    <div class="form-group {{ ! empty($errors->first('email')) ? 'has-error' : '' }}">
                      <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                      <div class="col-sm-5">
					    @if (! empty($errors->first('email')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('email') }}</label>
						@endif
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ old('email') }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
					<div class="col-sm-offset-4 col-sm-5">
                      <button type="submit" class="btn btn-primary">Register</button>
					  <div class="btn btn-default" id="clear-user-field">Clear</div>
					</div>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
		   </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

@endsection