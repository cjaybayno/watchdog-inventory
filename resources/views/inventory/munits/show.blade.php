@extends('layouts.adminlte')
@section('title', 'Measurements Units')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">
            Inventory Item
          </h1>
		  <div class="pull-right">
		    <div class="btn-group">
              <a href="{{ URL::route('munits') }}">
			    <button class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Back to List</button>
			  </a>
            </div>
			<div class="btn-group">
			  <a href="{{ URL::route('munits.create') }}">
				 <button class="btn btn-block btn-primary"><span class="fa fa-plus-circle"></span> Add Unit </button>
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
				<div class="box box-primary">
					<div class="box-header">
					  <h4>Show Measurements Units</h4>
					</div>
					<form class="form-horizontal">
					  <div class="box-body">
						@if (session('status'))
						<div class="col-sm-offset-4 col-sm-5">
						  <div class="alert alert-success">
							<i><center>{{ session('status') }}</center></i>
						  </div>
	   				    </div>
						@endif
						
						<div class="form-group">
						  <label for="inputName3" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-5">
							<input type="text" name="name" class="form-control" id="inputName3" placeholder="Name" value="{{ $munits->name }}" disabled>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="inputSymbol3" class="col-sm-4 control-label">Symbol</label>
						  <div class="col-sm-5">
							<input type="text" name="symbol" class="form-control" id="inputSymbol3" placeholder="Symbol" value="{{ $munits->symbol }}" disabled>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="inputCategory3" class="col-sm-4 control-label">Category</label>
						  <div class="col-sm-5">
							<input type="text" name="category" class="form-control" id="inputCategory3" placeholder="Category" value="{{ $munits->category }}" disabled>
						  </div>
						</div>
						
					  </div><!-- /.box-body -->
					  <div class="box-footer">
					  </div><!-- /.box-footer -->
					</form>
					<!-- /.box -->	
				 </div><!-- /.box -->
		      </div>
		   </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection