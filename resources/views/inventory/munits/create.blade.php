@extends('layouts.adminlte')
@section('title', 'Measurements Units')

@section('addScripts')
	<script>
		/* === click clear button === */
		$("#clear-munits-field").click(function() {
			clearInputs();
		});
	</script>
@endsection

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
					  <h4>Add Measurements Units</h4>
					</div>
					<form class="form-horizontal" method="POST" action="{{ URL::route('munits.store') }}">
					  {!! csrf_field() !!}
					  <div class="box-body">
						
						<div class="form-group {{ ! empty($errors->first('name')) ? 'has-error' : '' }}">
						  <label for="inputName3" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('name')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('name') }}</label>
							@endif
							<input type="text" name="name" class="form-control" id="inputName3" placeholder="Name" value="{{ old('name') }}">
						  </div>
						</div>
						
						<div class="form-group {{ ! empty($errors->first('symbol')) ? 'has-error' : '' }}">
						  <label for="inputSymbol3" class="col-sm-4 control-label">Symbol</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('symbol')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('symbol') }}</label>
							@endif
							<input type="text" name="symbol" class="form-control" id="inputSymbol3" placeholder="Symbol" value="{{ old('symbol') }}">
						  </div>
						</div>
						
						<div class="form-group {{ ! empty($errors->first('category')) ? 'has-error' : '' }}">
						  <label for="inputCategory3" class="col-sm-4 control-label">Category</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('category')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('category') }}</label>
							@endif
							<input type="text" name="category" class="form-control" id="inputCategory3" placeholder="Category" value="{{ old('category') }}">
						  </div>
						</div>
						
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<div class="col-sm-offset-4 col-sm-4">
						  <button type="submit" class="btn btn-primary">Add</button>
						  <div class="btn btn-default" id="clear-munits-field">Clear</div>
						</div>
					  </div><!-- /.box-footer -->
					</form>
					<!-- /.box -->	
				 </div><!-- /.box -->
		      </div>
		   </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection