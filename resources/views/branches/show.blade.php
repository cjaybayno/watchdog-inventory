@extends('layouts.adminlte')
@section('title', 'Branch')

@section('addStylesheets')
	<style>
		input[type="text"]:read-only, #address, #remarks {
			background-color: #fff; 
		}
	</style>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1 class="pull-left">Branch Info</h1>
	  <div class="pull-right">
		<div class="btn-group">
		  <a href="{{ URL::route('branches') }}">
			<button class="btn btn-block btn-sm btn-default pull-right"><span class="fa fa-list"></span> Show List</button>
		  </a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="{{ URL::route('branches.edit',$branch->id) }}">
			  <button class="btn btn-block btn-sm btn-info pull-right"><span class="fa fa-edit"></span> Edit </button>
			</a>
		</div>
		&nbsp
		<div class="btn-group">
		  <a href="{{ URL::route('branches.create') }}">
			<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Add Branch</button>
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
							<input type="text" name="code" style="width:50%; text-transform:uppercase;" class="form-control" id="code" value="{{ $branch->code }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-name">
						  <label for="name" class="col-sm-4 control-label">Name</label>
						  <div class="col-sm-8">
							<div class="error" id="error-name"></div>
							<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="name" value="{{ $branch->name }}" readonly>
						  </div>
						</div>
						<br>
						<div class="form-group" id="form-group-contact_person">
						  <label for="contact_person" class="col-sm-4 control-label">Contact Person</label>
						  <div class="col-sm-8">
							<div class="error" id="error-contact_person"></div>
							<input type="text" name="contact_person" style="text-transform:capitalize;" class="form-control" id="contact_person" value="{{ $branch->contact_person }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-contact_number">
						  <label for="contact_number" class="col-sm-4 control-label">Contact Number</label>
						  <div class="col-sm-8">
							<div class="error" id="error-contact_number"></div>
							<input type="text" name="contact_number" class="form-control" id="contact_number" value="{{ $branch->contact_number }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-fax_number">
						  <label for="fax_number" class="col-sm-4 control-label">Fax Number</label>
						  <div class="col-sm-8">
							<div class="error" id="error-fax_number"></div>
							<input type="text" name="fax_number" class="form-control" id="fax_number" value="{{ $branch->fax_number }}" readonly>
						  </div>
						</div>
						<div class="form-group" id="form-group-email">
						  <label for="email" class="col-sm-4 control-label">Email</label>
						  <div class="col-sm-8">
							<div class="error" id="error-email"></div>
							<input type="text" name="email" class="form-control" id="email" value="{{ $branch->email }}" readonly>
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-4 control-label">Date Created</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" value="{{ date('F jS, Y', strtotime($branch->created_at)) }}" readonly>
						  </div>
						</div>
					</div>
					<!-- right side form -->
					<div class="col-sm-6">
						<div class="form-group" id="form-group-address">
						  <label for="address" class="col-sm-4 control-label">Address</label>
						  <div class="col-sm-8" data-toggle="modal" data-target="#address-modal">
							<div class="error" id="error-address"></div>
							<textarea class="form-control" id="address" rows="5" readonly>{{ $branch->street.'&#13;&#10;'.$branch->brgy_town.'&#13;&#10;'.$branch->province_city.'&#13;&#10;'.$branch->zipcode.'&#13;&#10;'.$branch->country }}</textarea>
						  </div>
						</div>
						<br>
						<div class="form-group" id="form-group-remarks">
						  <label for="remarks" class="col-sm-4 control-label">Remarks</label>
						  <div class="col-sm-8">
							<div class="error" id="error-remarks"></div>
							<textarea class="form-control" id="remarks" rows="5" readonly>{{ $branch->remarks }}</textarea>
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