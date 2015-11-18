@extends('layouts.adminlte')
@section('title', 'Items')

@section('addStylesheets')
	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/select2/select2.min.css') !!}">
	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/fileinput/css/fileinput.min.css') !!}">
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte/plugins/select2/select2.full.min.js') !!}"></script>
	<script src="{!! asset('public/adminlte/plugins/fileinput/js/fileinput.min.js') !!}"></script>
	<script src="{!! asset('resources/assets/js/item/item-form-function.js') !!}"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="pull-left">
		Item Create
	  </h1>
	  <div class="pull-right">
		 <div class="btn-group">
		  <a href="{{ URL::route('items') }}">
			<button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Show List</button>
		  </a>
		</div>
	  </div>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">
	  <!-- Your Page Content Here -->
		<div class="row">
		  <div class="col-md-12">
			<div class="box box-primary">
				<form class="form-horizontal">
				  <div class="box-body">
				  <div id="supplier-result" class="col-sm-12"></div>
					<!-- left side form -->
					<div class="col-sm-5">
						<form id="item-create-form">
						<div class="form-group" id="form-group-code">
						  <label for="code" class="col-sm-4 control-label">Code</label>
						  <div class="col-sm-8">
							<div class="error" id="error-code"></div>
							<input type="text" name="code" style="width:50%; text-transform:uppercase;" class="form-control" id="code" placeholder="Code">
						  </div>
						</div>
						<div class="form-group" id="form-group-brand">
						  <label for="brand" class="col-sm-4 control-label">Brand</label>
						  <div class="col-sm-8">
							<div class="error" id="error-brand"></div>
							<input type="text" name="brand" style="text-transform:capitalize;" class="form-control" id="brand" placeholder="Brand">
						  </div>
						</div>
						<div class="form-group" id="form-group-name">
						  <label for="name" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-8">
							<div class="error" id="error-name"></div>
							<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="name" placeholder="Name">
						  </div>
						</div>
						<div class="form-group" id="form-group-category">
						  <label for="category" class="col-sm-4 control-label">Category</label>
						  <div class="col-sm-8">
							<div class="error" id="error-category"></div>
							{!! Form::select('category', $selectCategory, null, ['class' => 'form-control select2', 'id' => 'category', 'style' => 'width:100%']) !!}
						  </div>
						</div>
						
						<br>
						<div class="form-group" id="form-group-measurement">
						  <label for="measurement" class="col-sm-4 control-label">Measurement</label>
						  <div class="col-sm-8">
							<div class="error" id="error-measurement"></div>
							<input type="text" name="measurement" class="form-control" id="measurement" placeholder="Measurement">
						  </div>
						</div>
						<div class="form-group" id="form-group-uom">
						  <label for="uom" class="col-sm-4 control-label">UOM</label>
						  <div class="col-sm-8">
							<div class="error" id="error-uom"></div>
							{!! Form::select('uom', $selectUom, null, ['class' => 'form-control select2', 'id' => 'uom', 'style' => 'width:50%']) !!}
						  </div>
						</div>
					</div>
					<!-- right side form -->
					<div class="col-sm-6">
						<div class="form-group" id="form-group-price">
						  <label for="price" class="col-sm-4 control-label">Price</label>
						  <div class="col-sm-8">
							<div class="error" id="error-price"></div>
							<input type="text" name="price" style="width:50%"; class="form-control" id="price" placeholder="Price">
						  </div>
						</div>
						
						<div class="form-group" id="form-group-costing">
						  <label for="costing" class="col-sm-4 control-label">Costing</label>
						  <div class="col-sm-8">
							<div class="error" id="error-costing"></div>
							<input type="text" name="costing" style="width:50%"; class="form-control" id="costing" placeholder="Costing">
						  </div>
						</div>
						
						<div class="form-group" id="form-group-image">
						  <label for="image" class="col-sm-4 control-label">Image</label>
						  <div class="col-sm-8">
						    <div class="error" id="error-image"></div>
							<input type="file" name="image" id="image" class="file-loading" >
						  </div>
						</div>
					</div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
					<div class="col-sm-offset-1 col-sm-4">
					  <button type="submit" class="btn btn-primary btn-sm submit-btn" id="new-form-submit">Create</button>
					  &nbsp
					  <div class="btn btn-default btn-sm clear-btn submit-btn">Clear</div>
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