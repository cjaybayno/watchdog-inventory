@extends('layouts.adminlte')
@section('title', 'Invetory Item')

@section('addStylesheets')
	<!-- Add Datatables Css --->
	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/datatables/dataTables.bootstrap.css') !!}" >
	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') !!}">
@endsection

@section('addScripts')
	<!-- Add Datatables Js --->
    <script src="{!! asset('public/adminlte/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('public/adminlte/plugins/datatables/dataTables.bootstrap.min.js') !!}"></script>
    <script src="{!! asset('public/adminlte/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') !!}"></script>
	<script src="{!! asset('resources/assets/js/inventory-function.js') !!}"></script>
@endsection

@section('content')
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">
            Inventory Item
          </h1>
        </section>
		<br>
		<br>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
		  <div class="row">
            <div class="col-md-12">
			
			<!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
				  <li class="{{ $branchActiveMenu or '' }}"><a href="#branches-list" data-toggle="tab">Branches</a></li>
				  <li class="{{ $itemActiveMenu or '' }}"><a href="#items-list" data-toggle="tab">Items</a></li>
				  <li class="{{ $MunitActiveMenu or '' }}"><a href="#munits-list" data-toggle="tab">Measurement Units</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane {{ $branchActiveMenu or '' }}" id="branches-list">
					<div class="box box-primary">
						<div class="box-header">
						  <h4 class="pull-left">Listing</h4>
						  <div class="pull-right">
							<div class="btn-group">
							  <a href="{{ URL::to('inventory/branches/create') }}">
								 <button class="btn btn-block btn-primary"><span class="fa fa-plus-circle"></span> Create Branch</button>
							  </a>
							</div>
						  </div>
						</div>
						<div class="box-body">
							@if (session('delete_status'))
							  <div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i><center>{{ session('delete_status') }}</center></i>
							  </div>
							@endif
						   <table id="branches-list-table"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Branch Name</th>
								<th>Address</th>
								<th>Contact Person</th>
								<th>Contact Number</th>
								<th>Action</th>
							  </tr>
							</thead>
							<tbody>
							</tbody>
						  </table>
						</div><!-- /.box-body -->
					 </div><!-- /.box -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane {{ $itemActiveMenu or '' }}" id="items-list">
					<div class="box box-primary">
						<div class="box-header">
						  <h4 class="pull-left">Listing</h4>
						  <div class="pull-right">
							<div class="btn-group">
							  <a href="{{ URL::to('inventory/items/create') }}">
								 <button class="btn btn-block btn-primary"><span class="fa fa-plus-circle"></span> Add Items </button>
							  </a>
							</div>
						  </div>
						</div>
						<div class="box-body">
							@if (session('delete_status'))
							  <div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i><center>{{ session('delete_status') }}</center></i>
							  </div>
							@endif
						   <table id="items-list-table"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Brand Name</th>
								<th>Item Name</th>
								<th>Measurement</th>
								<th>Unit</th>
								<th>Action</th>
							  </tr>
							</thead>
							<tbody>
							</tbody>
						  </table>
						</div><!-- /.box-body -->
					 </div><!-- /.box -->
                  </div><!-- /.tab-pane -->
				  
				  <div class="tab-pane {{ $MunitActiveMenu or '' }}" id="munits-list">
					<div class="box box-primary">
						<div class="box-header">
						  <h4 class="pull-left">Listing</h4>
						  <div class="pull-right">
							<div class="btn-group">
							  <a href="{{ URL::route('munits.create') }}">
								 <button class="btn btn-block btn-primary"><span class="fa fa-plus-circle"></span> Add Unit </button>
							  </a>
							</div>
						  </div>
						</div>
						<div class="box-body">
							@if (session('delete_status'))
							  <div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i><center>{{ session('delete_status') }}</center></i>
							  </div>
							@endif
						   <table id="munits-list-table"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Name</th>
								<th>Symbol</th>
								<th>Category</th>
								<th>Action</th>
							  </tr>
							</thead>
							<tbody>
							</tbody>
						  </table>
						</div><!-- /.box-body -->
					 </div><!-- /.box -->
                  </div><!-- /.tab-pane -->
				  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
			
             </div><!-- /col -->
          </div><!-- /.row-->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection