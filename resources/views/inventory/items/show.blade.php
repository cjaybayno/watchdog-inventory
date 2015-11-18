@extends('layouts.adminlte')
@section('title', 'Branch')

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
            <div class="btn-group">
				<a href="{{ URL::to('inventory/items/create') }}">
				<button class="btn btn-block btn-primary"><span class="fa fa-plus-circle"></span> Add Items </button>
			 </a>
			</div>
			<div class="btn-group">
			  <a href="{{ URL::to('inventory/items/edit/'.$item->id) }}">
				  <button class="btn btn-info pull-right"><span class="fa fa-edit"></span> Edit </button>
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
					  <h4>Show Items</h4>
					</div>
					<form class="form-horizontal">
					  <div class="box-body">
						@if (session('status'))
						<div class="col-sm-offset-4 col-sm-5">
						  <div class="alert alert-success">
							<i><center>{{ session('status') }}</center></i>
						  </div>
	   				    </div>
						@endif
						
						<div class="form-group">
						  <label for="inputBrandename3" class="col-sm-4 control-label">Brand Name</label>
						  <div class="col-sm-5">
							<input type="text" name="brand" class="form-control" id="inputBrandename3" placeholder="Brand Name" value="{{ $item->brand }}" disabled>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="inputName3" class="col-sm-4 control-label">Item Name</label>
						  <div class="col-sm-5">
							<input type="text" name="name" class="form-control" id="inputName3" placeholder="Item Name" value="{{ $item->name }}" disabled>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="inputMeasurement3" class="col-sm-4 control-label">Measurement</label>
						  <div class="col-sm-5">
							<input type="text" name="measurement" class="form-control" id="inputMeasurement3" placeholder="Measurement" value="{{ $item->measurement }}" disabled>
						  </div>
						</div>
						
						<div class="form-group">
						  <label for="inputUnitt3" class="col-sm-4 control-label">Unit</label>
						  <div class="col-sm-5">
							<input type="text" name="unit" class="form-control" id="inputUnit3" placeholder="Unit" value="{{ $item->unit }}" disabled>
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