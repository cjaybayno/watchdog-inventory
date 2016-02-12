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
	
	<script>
		var itemImages = '<img src="{!! !empty($item->image) ? $item->image : url('public/images/items/default/default-logo.jpg'); !!}" class="img-thumbnail" style="height:200px; width:200px"/>';
	</script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	 <section class="content-header">
	  <h1 class="pull-left">Item Edit</h1>
	  <div class="pull-right">
	   <div class="btn-group">
		  <a href="{{ URL::route('items') }}">
			<button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Show List</button>
		  </a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="{{ URL::route('items.create') }}">
			<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add Item</button>
		</a>
		</div>
		&nbsp
		<div id="add-edit-btn" class="btn-group"></div>
	  </div>
	</section>
	<br>
	<!-- Main content -->
	<section class="content">
	  <!-- Your Page Content Here -->
		<div class="row">
		  <div class="col-md-12">
			<div class="box box-primary">
				<form id="item-create-form" class="form-horizontal">
				  <div class="box-body">
				  <div id="item-result" class="col-sm-12"></div>
					<!-- left side form -->
					<div class="col-sm-5">
						<input type="hidden" id="item_id" value="{{ $item->id }}">
						<div class="form-group" id="form-group-code">
						  <label for="code" class="col-sm-4 control-label">Code</label>
						  <div class="col-sm-8">
							<div class="error" id="error-code"></div>
							<input type="text" name="code" style="width:50%; text-transform:uppercase;" class="form-control" id="code" placeholder="Code" value="{{ $item->code }}">
						  </div>
						</div>
						<div class="form-group" id="form-group-brand">
						  <label for="brand" class="col-sm-4 control-label">Brand</label>
						  <div class="col-sm-8">
							<div class="error" id="error-brand"></div>
							<input type="text" name="brand" style="text-transform:capitalize;" class="form-control" id="brand" placeholder="Brand" value="{{ $item->brand }}">
						  </div>
						</div>
						<div class="form-group" id="form-group-name">
						  <label for="name" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-8">
							<div class="error" id="error-name"></div>
							<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="name" placeholder="Name" value="{{ $item->name }}">
						  </div>
						</div>
						<div class="form-group" id="form-group-category">
						  <label for="category" class="col-sm-4 control-label">Category</label>
						  <div class="col-sm-8">
							<div class="error" id="error-category"></div>
							{!! Form::select('category', $selectCategory, $item->category, ['class' => 'form-control select2', 'id' => 'category', 'style' => 'width:100%']) !!}
						  </div>
						</div>
						<div class="form-group" id="form-group-supplier">
						  <label for="supplier" class="col-sm-4 control-label">Supplier</label>
						  <div class="col-sm-8">
							<div class="error" id="error-supplier"></div>
							{!! Form::select('supplier', $selectSupplier, $item->supplier_id, ['class' => 'form-control select2', 'id' => 'supplier', 'style' => 'width:100%']) !!}
						  </div>
						</div>
						<br>
						<div class="form-group" id="form-group-measurement">
						  <label for="measurement" class="col-sm-4 control-label">Measurement</label>
						  <div class="col-sm-8">
							<div class="error" id="error-measurement"></div>
							<input type="text" name="measurement" style="width:50%"; class="form-control" id="measurement" placeholder="Measurement" value="{{ $item->measurement }}">
						  </div>
						</div>
						<div class="form-group" id="form-group-uom">
						  <label for="uom" class="col-sm-4 control-label">UOM</label>
						  <div class="col-sm-8">
							<div class="error" id="error-uom"></div>
							{!! Form::select('uom', $selectUom, $item->uom, ['class' => 'form-control select2', 'id' => 'uom', 'style' => 'width:50%']) !!}
						  </div>
						</div>
					</div>
					<!-- right side form -->
					<div class="col-sm-6">
						<div class="form-group" id="form-group-price">
						  <label for="price" class="col-sm-4 control-label">Price</label>
						  <div class="col-sm-8">
							<div class="error" id="error-price"></div>
							<input type="text" name="price" style="width:50%"; class="form-control" id="price" placeholder="Price" value="{{ $item->current_price }}">
						  </div>
						</div>
						
						<div class="form-group" id="form-group-costing">
						  <label for="costing" class="col-sm-4 control-label">Costing</label>
						  <div class="col-sm-8">
							<div class="error" id="error-costing"></div>
							<input type="text" name="costing" style="width:50%"; class="form-control" id="costing" placeholder="Costing" value="{{ $item->costing_price }}">
						  </div>
						</div>
						
						<div class="form-group" id="form-group-image">
						  <label for="image" class="col-sm-4 control-label">Image</label>
						  <div class="col-sm-8">
						    <div class="error" id="error-image"></div>
							<div style="width:200px">
							 <input type="file" name="image" id="image" class="file-loading">
						    </div>
						  </div>
						</div>
					</div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
					<div class="col-sm-offset-1 col-sm-4">
					  <button type="submit" class="btn btn-info btn-sm submit-btn" id="modify-form-submit">Modify</button>
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