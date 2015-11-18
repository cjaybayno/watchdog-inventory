@extends('layouts.adminlte')
@section('title', 'User')

@section('addStylesheets')
	<link rel="stylesheet"  href="{!! asset('public/adminlte/plugins/iCheck/square/blue.css') !!}" >
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte//plugins/iCheck/icheck.min.js') !!}" ></script>
	<script>
	  $(function () {
		$('[type=checkbox]').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' // optional
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
            Show User
          </h1>
		  <div class="pull-right">
		    <div class="btn-group">
              <a href="{{ URL::to('user') }}">
			    <button class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Back User List</button>
			  </a>
            </div>
			<div class="btn-group">
			  <a href="{{ URL::to('user/edit/'.$user->id) }}">
				  <button class="btn btn-info pull-right"><span class="fa fa-edit"></span> Edit </button>
				</a>
			</div>
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
                <form class="form-horizontal">
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
					    <img src="{!! asset($user->avatar) !!}" class="img-thumbnail" style="height:100px; width:100px">
					  </a>
				     </div>
				   </div>
				   <br>
					<div class="form-group">
                      <label for="inputUsername3" class="col-sm-4 control-label">Username</label>
                      <div class="col-sm-5">
                        <input type="text" name="username" class="form-control" id="inputUsername3" placeholder="Username" value="{{ $user->username }}" disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputName3" class="col-sm-4 control-label">Full Name</label>
                      <div class="col-sm-5">
                        <input type="text" name="name" class="form-control" id="inputName3" placeholder="name" value="{{ $user->name }}" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                      <div class="col-sm-5">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $user->email }}" disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputSocial3" class="col-sm-4 control-label">Socialites</label>
                      <div class="col-sm-5">
						<input type="text" name="socialites" class="form-control" id="inputSocial3" value="{{ ($user->socialites) ? $user->socialites : 'None' }}" disabled>
                      </div>
                    </div>
					@if ($user->socialites)
					<div class="form-group">
					  <div class="col-sm-offset-4">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" disabled {{ ($user->is_approved) ? 'checked' : '' }}> Approved
                          </label>
                        </div>
                      </div>
                    </div>
					@endif
                  </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
		   </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection