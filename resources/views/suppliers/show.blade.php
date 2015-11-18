@extends('layouts.adminlte')
@section('title', 'Supplier')

@section('addStylesheets')
	<style>
		input[type="text"]:read-only, #address, #remarks, #payment_terms {
			background-color: #fff; 
		}
	</style>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="pull-left">Supplier Info</h1>
	  <div class="pull-right">
		<div class="btn-group">
		  <a href="{{ URL::route('suppliers') }}">
			<button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Show List</button>
		  </a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="{{ URL::route('suppliers.edit', $supplier->id) }}">
			  <button class="btn btn-block btn-sm btn-info pull-right"><span class="fa fa-edit"></span> Edit </button>
			</a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="">
			<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add supplier</button>
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
					<!-- left side form -->
					<div class="col-sm-5">
						<div class="form-group" id="form-group-code">
						  <label for="code" class="col-sm-4 control-label">Code</label>
						  <div class="col-sm-8">
							<div class="error" id="error-code"></div>
							<input type="text" name="code" style="width:50%; text-transform:uppercase;" class="form-control" id="code" value="{{ $supplier->code }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-name">
						  <label for="name" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-8">
							<div class="error" id="error-name"></div>
							<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="name" value="{{ $supplier->name }}" readonly>
						  </div>
						</div>
						<br>
						<div class="form-group" id="form-group-contact_person">
						  <label for="contact_person" class="col-sm-4 control-label">Contact Person</label>
						  <div class="col-sm-8">
							<div class="error" id="error-contact_person"></div>
							<input type="text" name="contact_person" style="text-transform:capitalize;" class="form-control" id="contact_person" value="{{ $supplier->contact_person }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-contact_number">
						  <label for="contact_number" class="col-sm-4 control-label">Contact Number</label>
						  <div class="col-sm-8">
							<div class="error" id="error-contact_number"></div>
							<input type="text" name="contact_number" class="form-control" id="contact_number" value="{{ $supplier->contact_number }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-fax_number">
						  <label for="fax_number" class="col-sm-4 control-label">Fax Number</label>
						  <div class="col-sm-8">
							<div class="error" id="error-fax_number"></div>
							<input type="text" name="fax_number" class="form-control" id="fax_number" value="{{ $supplier->fax_number }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-email">
						  <label for="email" class="col-sm-4 control-label">Email</label>
						  <div class="col-sm-8">
							<div class="error" id="error-email"></div>
							<input type="text" name="email" class="form-control" id="email" value="{{ $supplier->email }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-payment_terms">
						  <label for="payment_terms" class="col-sm-4 control-label">Payment Terms</label>
						  <div class="col-sm-8">
							<div class="error" id="error-payment_terms"></div>
							{!! Form::select('payment_terms', $selectPaymentTerms, $supplier->payment_terms, ['class' => 'form-control select2', 'id' => 'payment_terms', 'style' => 'width:100%', 'disabled']) !!}
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-4 control-label">Date Created</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" value="{{ date('F jS, Y', strtotime($supplier->created_at)) }}" readonly>
						  </div>
						</div>
					</div>
					<!-- right side form -->
					<div class="col-sm-6">
						<div class="form-group" id="form-group-address">
						  <label for="address" class="col-sm-4 control-label">Address</label>
						  <div class="col-sm-8" data-toggle="modal" data-target="#address-modal">
							<div class="error" id="error-address"></div>
							<textarea class="form-control" id="address" rows="5" readonly>{{ $supplier->street.'&#13;&#10;'.$supplier->brgy_town.'&#13;&#10;'.$supplier->province_city.'&#13;&#10;'.$supplier->zipcode.'&#13;&#10;'.$supplier->country }}</textarea>
						  </div>
						</div>
						<br>
						<div class="form-group" id="form-group-remarks">
						  <label for="remarks" class="col-sm-4 control-label">Remarks</label>
						  <div class="col-sm-8">
							<div class="error" id="error-remarks"></div>
							<textarea class="form-control" id="remarks" rows="5" readonly>{{ $supplier->remarks }}</textarea>
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