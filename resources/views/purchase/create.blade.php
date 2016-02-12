@extends('layouts.adminlte')
@section('title', 'Purchase')

@section('addStylesheets')
	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/select2/select2.min.css') !!}">
@endsection

@section('addScripts')
	<script src="{!! asset('public/adminlte/plugins/select2/select2.full.min.js') !!}"></script>
	<script src="{!! asset('public/adminlte/plugins/input-mask/jquery.inputmask.js') !!}"></script>
	<script src="{!! asset('public/adminlte/plugins/input-mask/jquery.inputmask.numeric.extensions.js') !!}"></script>
	<script src="{!! asset('resources/assets/js/purchase/purchase-form-function.js') !!}"></script>
	<script>
		var htmlSelectItems = '\
			<tr class="remove-item">\
				<td style="width:40%">\
					{!! Form::select("item[]", [], null, ["class" => "form-control select2 item",]) !!}\
				</td>\
				<td><input type="text" name="quantity[]"  class="form-control quantity" readonly></td>\
				<td><input type="text" name="price[]" 	class="form-control price" value=0.00 readonly></td>\
				<td><input type="text" name="discount[]"  class="form-control discount" value=0.00 readonly></td>\
				<td><input type="text" name="subtotal[]" class="form-control subtotal" value=0.00 readonly></td>\
				<td><div class="btn btn-danger btn-sm remove-single-column-btn item-btn"><i class="fa fa-remove"></i></div>\</td>\
			<tr>\
		 ';
	</script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="pull-left">Create Purchase Order</h1>
	  <div class="pull-right">
		<div class="btn-group">
		  <a href="{{ URL::route('purchases') }}">
			<button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Button</button>
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
				  <div id="purchase-result" class="col-sm-12"></div>
					<div class="row">
						<!-- left side form -->
						<div class="col-sm-5">
							<div class="form-group" id="form-group-branch">
							  <label for="branch" class="col-sm-3 control-label">Branch</label>
							  <div class="col-sm-8">
								<div class="error" id="error-branch"></div>
								{!! Form::select('branch', $selectBranches, null, ['class' => 'form-control select2', 'id' => 'branch']) !!}
							  </div>
							</div>
							<div class="form-group" id="form-group-supplier">
							  <label for="supplier" class="col-sm-3 control-label">Supplier</label>
							  <div class="col-sm-8">
								<div class="error" id="error-supplier"></div>
								{!! Form::select('supplier', $selectSupplier, null, ['class' => 'form-control select2', 'id' => 'supplier']) !!}
							  </div>
							</div>
						</div>
						<!-- right side form -->
						<div class="col-sm-7">
							<div class="form-group form-hide" id="form-group-entry_type" style="display:none">
							  <label for="entry_type" class="col-sm-4 control-label"></label>
							  <div class="col-sm-7">
								<div class="btn-group pull-right">
									<div class="btn btn-danger btn-sm item-btn" id="remove-column-btn"><i class="fa fa-minus-square"></i> less column</div>
								</div>
								<div class="btn-group pull-right">
									<div class="btn btn-info btn-sm item-btn" id="add-column-btn"><i class="fa fa-plus-square"></i> add columns</div>&nbsp &nbsp
								</div>
							  </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
						  <div class="box box-solid">
							<div class="box-body table-responsive no-padding">
							  <table class="table table-hover form-hide" id="item-table" style="width:93%; margin: 0 auto; display:none">
								<tr>
								  <th>Item</th>
								  <th>Quantity</th>
								  <th>Price</th>
								  <th>Discount</th>
								  <th>Sub Total</th>
								  <th></th>
								</tr>
								<tr id="add-item">
								  <td style="width:40%">{!! Form::select('item[]', [], null, ['class' => 'form-control select2 item']) !!}</td>
								  <td><input type="text" name="quantity[]"  class="form-control quantity" readonly></td>
								  <td><input type="text" name="price[]" 	class="form-control price" value=0.00 readonly></td>
								  <td><input type="text" name="discount[]"  class="form-control discount" value=0.00 readonly></td>
								  <td><input type="text" name="subtotal[]" class="form-control subtotal" value=0.00 readonly></td>
								  <td></td>
								</tr>
							  </table>
							</div><!-- /.box-body -->
						  </div><!-- /.box -->
						</div>
					</div>
					<div class="row form-hide" style="display:none">
						<!-- left side form -->
						<div class="col-sm-5">
							<div class="form-group" id="form-group-remarks">
							  <label for="remarks" class="col-sm-3 control-label">Remarks</label>
							  <div class="col-sm-8">
								<div class="error" id="error-remarks"></div>
								<textarea name="remarks" class="form-control" id="remarks" rows="5"></textarea>
							  </div>
							</div>
						</div>
						<!-- right side form -->
						<div class="col-sm-7">
							<div class="form-group" id="form-group-total">
							  <label for="total" class="col-sm-4 control-label">Total</label>
							  <div class="col-sm-8">
								<div class="error" id="error-total"></div>
								<input type="text" name="total" style="width:50%;" class="form-control" id="total" value=0.00 readonly>
								<input type="hidden" name="total_raw" id="total_raw">
							  </div>
							</div>
						</div>
					</div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
					<div class="col-sm-5 form-hide" style="display:none">
					  <button type="submit" class="btn btn-primary btn-sm submit-btn" id="new-form-submit">Create PO</button>
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