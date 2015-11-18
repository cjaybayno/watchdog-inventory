@extends('layouts.adminlte')
@section('title', 'Branch')

@section('addStylesheets')
	 <link rel="stylesheet" href="{!! asset('public/adminlte/plugins/select2/select2.min.css') !!}">
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte/plugins/select2/select2.full.min.js') !!}"></script>
	<script>
		var htmlSelectItems = '\
			   <div class="form-group remove-item">\
				<label class="col-sm-1 control-label"></label>\
				<div class="col-sm-5">\
					<div class="error item_purchase-error"></div>\
					{!! Form::select("item_purchase[]", $selectItems, null, ["class" => "form-control select2"]) !!}\
				</div>\
				<div class="col-sm-3">\
					<div class="col-sm-9">\
						<div class="error quantity-error"></div>\
						<input type="text" name="quantity[]" class="form-control" placeholder="Qty">\
					</div>\
					<div class="col-sm-1">\
						<label class="control-label col-sm-1">X</label>\
					</div>\
				</div>\
				<div class="col-sm-2">\
					<div class="error price-error"></div>\
					<input type="text" name="price[]" class="form-control price" placeholder="price">\
				</div>\
				 <div class="col-sm-1">\
				   <div class="error remove-btn-error"></div>\
				   <div class="btn btn-danger remove-btn"><i class="fa fa-remove"></i></div>\
				 </div>\
			  </div>\
			';
	</script>
	<script src="{!! asset('resources/assets/js/purchase-item-function.js') !!}"></script>
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
              <a href="{{ URL::route('purchase.list') }}">
			    <button class="btn btn-primary"><span class="fa fa-arrow-left"></span> Back to List</button>
			  </a>
            </div>
			&nbsp &nbsp
			<div class="btn btn-info" id="add-item-btn"><i class="fa fa-plus-square"></i> add item</div>
			<div class="btn btn-danger remove-btn remove"><i class="fa fa-minus-square"></i> remove item</div>
			<div class="btn btn-primary" id="new-purchase-btn" style="display:none"><span class="fa fa-plus-circle"></span> New Purchase </div>
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
					  <h4>Purchase Item</h4>
					</div>
					<form class="form-horizontal">
					  <div class="box-body">
						<div id="purchase-result" class="col-sm-12">
							
						</div>
						 <div class="form-group">
							<label for="inputPurchaseBranch" class="col-sm-1 control-label">Branch</label>
							<div class="col-sm-5">
							<div class="error branch_purchase-error"></div>
							{!! Form::select('branch_purchase', $selectBranches, null, ['class' => 'form-control select2', 'id' => 'branch_id']) !!}
						   </div>
						</div>
						
						
						<div id="add-item">
							<div class="form-group">
								<label for="inputPurchaseItem" class="col-sm-1 control-label">Items</label>
								<div class="col-sm-5">
									<div class="error item_purchase-error"></div>
									{!! Form::select('item_purchase[]', $selectItems, null, ['class' => 'form-control select2']) !!}
								</div>
								<div class="col-sm-3">
									<div class="col-sm-9">
										<div class="error quantity-error"></div>
										<input type="text" name="quantity[]" class="form-control"  placeholder="Qty">
									</div>
									<div class="col-sm-1">
										<label class="control-label col-sm-1">X</label>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="error price-error"></div>
									<input type="text" name="price[]" class="form-control price" placeholder="price">
								</div>
							</div>
						</div>
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<div class="col-sm-offset-1" >
						  <button type="submit" class="btn btn-primary" id="save-purchase-btn">Save</button>&nbsp &nbsp
						  <div class="btn btn-default" id="clear-purchase-btn">clear</div>
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