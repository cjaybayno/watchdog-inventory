@extends('layouts.adminlte')
@section('title', 'Items Category')

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
	<script src="{!! asset('resources/assets/js/item/item-generic-function.js') !!}"></script>
	<script src="{!! asset('resources/assets/js/item/item-generic-form1-function.js') !!}"></script>
	<script>
		var route = 'items-category';
		var dataTableSelector = $('#items-category-list-table');
	</script>
@endsection

@section('content')
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">
            Items Category List
          </h1>
		  <div class="pull-right">
			<div class="btn-group">
				<div data-toggle="modal" data-target="#create-form-modal">
					<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Create Category</button>
				</div>
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
                <div class="box-body">
					@if (session('delete_status'))
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					    <i><center>{{ session('delete_status') }}</center></i>
					  </div>
				    @endif
				  <table id="items-category-list-table"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
					  <tr>
						<th>Name</th>
						<th>Label</th>
						<th>Description</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					</tbody>
				  </table>				  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             </div><!-- /col -->
          </div><!-- /.row-->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  {!! $createFormModal !!}
	  {!! $editFormModal !!}
@endsection