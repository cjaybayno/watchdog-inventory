@extends('layouts.adminlte')
@section('title', 'Items')

@section('addStylesheets')
	 <link rel="stylesheet" href="{!! asset('public/adminlte/plugins/select2/select2.min.css') !!}">
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte/plugins/select2/select2.full.min.js') !!}"></script>
	<script>
		/* === click clear button === */
		$("#clear-item-field").click(function() {
			clearInputs();
		});
		
		$(".select2").select2();
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
              <a href="{{ URL::to('inventory/items') }}">
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
					  <h4>Add Item</h4>
					</div>
					<form class="form-horizontal" method="POST" action="{{ URL::to('inventory/items/store') }}">
					  {!! csrf_field() !!}
					  <div class="box-body">
						<div class="form-group {{ ! empty($errors->first('brand')) ? 'has-error' : '' }}">
						  <label for="inputBrandename3" class="col-sm-4 control-label">Brand Name</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('brand')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('brand') }}</label>
							@endif
							<input type="text" name="brand" class="form-control" id="inputBrandename3" placeholder="Brand Name" value="{{ old('brand') }}">
						  </div>
						</div>
						<div class="form-group {{ ! empty($errors->first('name')) ? 'has-error' : '' }}">
						  <label for="inputName3" class="col-sm-4 control-label">Item Name</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('name')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('name') }}</label>
							@endif
							<input type="text" name="name" class="form-control" id="inputName3" placeholder="Item Name" value="{{ old('name') }}">
						  </div>
						</div>
						<div class="form-group {{ ! empty($errors->first('measurement')) ? 'has-error' : '' }}">
						  <label for="inputMeasurement3" class="col-sm-4 control-label">Measurement</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('measurement')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('measurement') }}</label>
							@endif
							<input type="text" name="measurement" class="form-control" id="inputMeasurement3" placeholder="Measurement" value="{{ old('measurement') }}">
						  </div>
						</div>
						<div class="form-group {{ ! empty($errors->first('unit')) ? 'has-error' : '' }}">
						  <label for="inputUnitt3" class="col-sm-4 control-label">Unit</label>
						  <div class="col-sm-5">
							@if (! empty($errors->first('unit')))
							  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->first('unit') }}</label>
							@endif
							{!! Form::select('unit', $selectMunits, null, ['class' => 'form-control select2', 'id' => 'inputUnit3']) !!}
						  </div>
						</div>
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<div class="col-sm-offset-4 col-sm-4">
						  <button type="submit" class="btn btn-primary">Add</button>
						  <div class="btn btn-default" id="clear-item-field">Clear</div>
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