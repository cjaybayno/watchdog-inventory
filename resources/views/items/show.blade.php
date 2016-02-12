@extends('layouts.adminlte')
@section('title', 'Items')

@section('addStylesheets')
	<style>
		input[type="text"]:read-only {
			background-color: #fff; 
		}
	</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="pull-left">Item Info</h1>
	  <div class="pull-right">
		<div class="btn-group">
		  <a href="{{ URL::route('items') }}">
			<button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Show List</button>
		  </a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="{{ URL::route('items.edit', $item->id) }}">
			  <button class="btn btn-block btn-sm btn-info pull-right"><span class="fa fa-edit"></span> Edit </button>
			</a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="{{  URL::route('items.create') }}">
			<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add Items</button>
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
				  <div id="item-result" class="col-sm-12"></div>
					<!-- left side form -->
					<div class="col-sm-5">
						<form id="item-create-form">
						<div class="form-group" id="form-group-code">
						  <label for="code" class="col-sm-4 control-label">Code</label>
						  <div class="col-sm-8">
							<div class="error" id="error-code"></div>
							<input type="text" name="code" style="width:50%; text-transform:uppercase;" class="form-control" id="code" value="{{ $item->code }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-brand">
						  <label for="brand" class="col-sm-4 control-label">Brand</label>
						  <div class="col-sm-8">
							<div class="error" id="error-brand"></div>
							<input type="text" name="brand" style="text-transform:capitalize;" class="form-control" id="brand" value="{{ $item->brand }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-name">
						  <label for="name" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-8">
							<div class="error" id="error-name"></div>
							<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="name" value="{{ $item->name }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-category">
						  <label for="category" class="col-sm-4 control-label">Category</label>
						  <div class="col-sm-8">
							<div class="error" id="error-category"></div>
							{!! Form::select('category', $selectCategory, $item->category, ['class' => 'form-control select2', 'id' => 'category', 'style' => 'width:100%', 'disabled']) !!}
						  </div>
						</div>
						<div class="form-group" id="form-group-supplier">
						  <label for="supplier" class="col-sm-4 control-label">Supplier</label>
						  <div class="col-sm-8">
							<div class="error" id="error-supplier"></div>
							{!! Form::select('supplier', $selectSupplier, $item->supplier_id, ['class' => 'form-control select2', 'id' => 'supplier', 'style' => 'width:100%', 'disabled']) !!}
						  </div>
						</div>
						<br>
						<div class="form-group" id="form-group-measurement">
						  <label for="measurement" class="col-sm-4 control-label">Measurement</label>
						  <div class="col-sm-8">
							<div class="error" id="error-measurement"></div>
							<input type="text" name="measurement" style="width:50%"; class="form-control" id="measurement" value="{{ $item->measurement }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-uom">
						  <label for="uom" class="col-sm-4 control-label">UOM</label>
						  <div class="col-sm-8">
							<div class="error" id="error-uom"></div>
							{!! Form::select('uom', $selectUom, $item->uom, ['class' => 'form-control select2', 'id' => 'uom', 'style' => 'width:50%', 'disabled']) !!}
						  </div>
						</div>
					</div>
					<!-- right side form -->
					<div class="col-sm-6">
						<div class="form-group" id="form-group-price">
						  <label for="price" class="col-sm-4 control-label">Price</label>
						  <div class="col-sm-8">
							<div class="error" id="error-price"></div>
							<input type="text" name="price" style="width:50%"; class="form-control" id="price" value="{{ $item->current_price }}" readonly>
						  </div>
						</div>
						
						<div class="form-group" id="form-group-costing">
						  <label for="costing" class="col-sm-4 control-label">Costing</label>
						  <div class="col-sm-8">
							<div class="error" id="error-costing"></div>
							<input type="text" name="costing" style="width:50%"; class="form-control" id="costing" value="{{ $item->costing_price }}" readonly>
						  </div>
						</div>
						
						<div class="form-group" id="form-group-image">
						  <label for="image" class="col-sm-4 control-label">Image</label>
						  <div class="col-sm-6">
						   <div style="width:200px">
						     <img src="{!! !empty($item->image) ? $item->image : url('public/images/items/default/default-logo.jpg'); !!}" class="img-thumbnail">
						   </div>
						  </div>
						</div>
					</div>
				  </div><!-- /.box-body -->
				</form>
				<!-- /.box -->	
			 </div><!-- /.box -->
		  </div>
	   </div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection