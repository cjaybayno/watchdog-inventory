@extends('layouts.adminlte')
@section('title', 'supplier')

@section('addStylesheets')
	 <link rel="stylesheet" href="{!! asset('public/adminlte/plugins/select2/select2.min.css') !!}">
@endsection

@section('addScripts')
	<script src="{!! asset('resources/assets/js/supplier/supplier-form-function.js') !!}"></script>
	<script src="{!! asset('public/adminlte/plugins/select2/select2.full.min.js') !!}"></script>
@endsection

@section('content')
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">Supplier Edit</h1>
		  <div class="pull-right">
		   <div class="btn-group">
              <a href="{{ URL::route('suppliers') }}">
			    <button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Show List</button>
			  </a>
            </div>
			&nbsp
			<div class="btn-group">
			  <a href="{{ URL::route('suppliers.create') }}">
				<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add supplier</button>
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
					<form class="form-horizontal">
					  <input type="hidden" id="supplier_id" value="{{ $supplier->id }}">
					  <div class="box-body">
					  <div id="supplier-result" class="col-sm-12"></div>
						<!-- left side form -->
						<div class="col-sm-5">
							<div class="form-group" id="form-group-code">
							  <label for="code" class="col-sm-4 control-label">Code</label>
							  <div class="col-sm-8">
								<div class="error" id="error-code"></div>
								<input type="text" name="code" style="width:50%; text-transform:uppercase;" class="form-control" id="code" value="{{ $supplier->code }}" >
							  </div>
							</div>
							<div class="form-group" id="form-group-name">
							  <label for="name" class="col-sm-4 control-label">Name</label>
							  <div class="col-sm-8">
								<div class="error" id="error-name"></div>
								<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="name" value="{{ $supplier->name }}">
							  </div>
							</div>
							<br>
							<div class="form-group" id="form-group-contact_person">
							  <label for="contact_person" class="col-sm-4 control-label">Contact Person</label>
							  <div class="col-sm-8">
								<div class="error" id="error-contact_person"></div>
								<input type="text" name="contact_person" style="text-transform:capitalize;" class="form-control" id="contact_person" value="{{ $supplier->contact_person }}">
							  </div>
							</div>
							<div class="form-group" id="form-group-contact_number">
							  <label for="contact_number" class="col-sm-4 control-label">Contact Number</label>
							  <div class="col-sm-8">
								<div class="error" id="error-contact_number"></div>
								<input type="text" name="contact_number" class="form-control" id="contact_number" value="{{ $supplier->contact_number }}">
							  </div>
							</div>
							<div class="form-group" id="form-group-fax_number">
							  <label for="fax_number" class="col-sm-4 control-label">Fax Number</label>
							  <div class="col-sm-8">
								<div class="error" id="error-fax_number"></div>
								<input type="text" name="fax_number" class="form-control" id="fax_number" value="{{ $supplier->fax_number }}">
							  </div>
							</div>
							<div class="form-group" id="form-group-email">
							  <label for="email" class="col-sm-4 control-label">Email</label>
							  <div class="col-sm-8">
								<div class="error" id="error-email"></div>
								<input type="text" name="email" class="form-control" id="email" value="{{ $supplier->email }}">
							  </div>
							</div>
							<br>
							<div class="form-group" id="form-group-payment_terms">
							  <label for="payment_terms" class="col-sm-4 control-label">Payment Terms</label>
							  <div class="col-sm-8">
								<div class="error" id="error-payment_terms"></div>
								{!! Form::select('payment_terms', $selectPaymentTerms, $supplier->payment_terms, ['class' => 'form-control select2', 'id' => 'payment_terms', 'style' => 'width:100%']) !!}
							  </div>
							</div>
						</div>
						<!-- right side form -->
						<div class="col-sm-6">
							<div class="form-group" id="form-group-address">
							  <label for="address" class="col-sm-4 control-label">Address</label>
							  <div class="col-sm-8" data-toggle="modal" data-target="#address-modal" id="address-modal-toggle">
								<div class="error" id="error-address"></div>
								<textarea class="form-control" id="address" rows="5">{{ $supplier->street.'&#13;&#10;'.$supplier->brgy_town.'&#13;&#10;'.$supplier->province_city.'&#13;&#10;'.$supplier->zipcode.'&#13;&#10;'.$supplier->country }}</textarea>
							  </div>
							</div>
							<br>
							<div class="form-group" id="form-group-remarks">
							  <label for="remarks" class="col-sm-4 control-label">Remarks</label>
							  <div class="col-sm-8">
								<div class="error" id="error-remarks"></div>
								<textarea class="form-control" id="remarks" rows="5">{{ $supplier->remarks }}</textarea>
							  </div>
							</div>
						</div>
					  </div><!-- /.box-body -->
					  <div class="box-footer">
						<div class="col-sm-offset-1 col-sm-4">
						  <button type="submit" class="btn btn-info btn-sm submit-btn" id="modify-form-submit">Modify</button>
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
	  
<!-- Address modal -->
<div class="modal fade" id="address-modal" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Address</h4>
	  </div>
	  <div class="modal-body col-sm-12">
		<div class="col-xs-12">
			<div class="form-group" id="form-group-street">
			  <label for="street" class="control-label">Street</label>
				<input type="text" name="street" class="form-control" id="street" value="{{ $supplier->street }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group" id="form-group-province_city">
			  <label for="province_city" class="control-label">Province/City</label>
				{!! Form::select('province_city', $selectProvinceCity, $supplier->province_city, ['class' => 'form-control select2', 'id' => 'province_city', 'style' => 'width:100%']) !!}
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group" id="form-group-brgy_town">
			  <label for="brgy_town" class="control-label">Barangay/Town</label>
				{!! Form::select('brgy_town', $selectBrgyTown, $supplier->brgy_town, ['class' => 'form-control select2', 'id' => 'brgy_town', 'style' => 'width:100%']) !!}
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
			  <label for="country" class="control-label">Country</label>
				<input type="text" name="country" class="form-control" id="country" value="PHILIPPINES" readonly>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
			  <label for="zipcode" class="control-label">Zipcode</label>
				<input type="text" name="zipcode" class="form-control" id="zipcode"  value="{{ $supplier->zipcode }}" readonly>
			</div>
		</div>
	 </div>
	  <div class="modal-footer">
		<div class="col-sm-12">
			<button type="button" class="col-sm-2 btn btn-primary pull-left" id="ok-address">OK</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection