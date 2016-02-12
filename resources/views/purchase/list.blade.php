@extends('layouts.adminlte')
@section('title', 'Branches')

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
	<script src="{!! asset('resources/assets/js/purchase/purchase-function.js') !!}"></script>
@endsection

@section('content')
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">
            Purchases List	
          </h1>
		  <div class="pull-right">
			<div class="btn-group">
			  <a href="{{ URL::route('purchases.create') }}">
				<button class="btn btn-block btn-sm btn-primary"><span class="fa fa-plus-circle"></span> Create PO</button>
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
                <div class="box-body">
				  <table id="purchases-list-table"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
					  <tr>
						<th>Order #</th>
						<th>Invoice #</th>
						<th>Supplier</th>
						<th>Total</th>
						<th>Status</th>
						<th>Created</th>
						<th>Expected Delivery</th>
						<th></th>
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
@endsection