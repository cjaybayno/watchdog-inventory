@extends('layouts.adminlte')
@section('title', 'User')

@section('addStylesheets')
	<link rel="stylesheet"  href="{!! asset('public/adminlte/plugins/iCheck/square/blue.css') !!}" >
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte//plugins/iCheck/icheck.min.js') !!}" ></script>
	<script>
	  $(function () {
		 /* === apply icheck to checked box === */
		$('[type=checkbox]').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
		});
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
            Edit User
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
                <form class="form-horizontal" method="POST" action="{{ URL::to('user/update/'.$user->id) }}">
				  {!! csrf_field() !!}
                  <div class="box-body">
				   <div class="row">
				     <div class="col-sm-offset-4 col-sm-5">
					  <a href="#">
					    <img src="{!! asset($user->avatar) !!}" class="img-thumbnail" style="height:100px; width:100px">
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
                        <input type="text" name="username" class="form-control" id="inputUsername3" placeholder="Username" value="{{ $user->username }}" {{ ($user->socialites) ? 'disabled' : '' }}>
                      </div>
                    </div>
					<div class="form-group {{ ! empty($errors->first('name')) ? 'has-error' : '' }}">
                      <label for="inputName3" class="col-sm-4 control-label">Full Name</label>
                      <div class="col-sm-5">
					    @if (! empty($errors->first('name')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('name') }}</label>
						@endif
                        <input type="text" name="name" class="form-control" id="inputName3" placeholder="name" value="{{ $user->name }}">
                      </div>
                    </div>
                    <div class="form-group {{ ! empty($errors->first('email')) ? 'has-error' : '' }}">
                      <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                      <div class="col-sm-5">
					    @if (! empty($errors->first('email')))
						  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('email') }}</label>
						@endif
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $user->email }}">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputSocial3" class="col-sm-4 control-label">Socialites</label>
                      <div class="col-sm-5">
						<input type="text" name="socialites" class="form-control" id="inputSocial3" value="{{ ($user->socialites) ? $user->socialites : 'None' }}" readonly>
                      </div>
                    </div>
					@if ($user->socialites)
					<div class="form-group">
					  <div class="col-sm-offset-4">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" {{ ($user->is_approved) ? 'checked' : '' }}> Approved
                          </label>
                        </div>
                      </div>
                    </div>
					@endif
                  </div><!-- /.box-body -->
                  <div class="box-footer">
					<div class="col-sm-offset-4 col-sm-5">
                      <button type="submit" class="btn btn-info">Modify</button>
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