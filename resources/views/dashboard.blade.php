@extends('layouts.adminlte')
@section('title', 'Dashboard')

@section('addStylesheets')
	 <!-- DateRangepicker Css-->
  	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/daterangepicker/daterangepicker-bs3.css') !!}">
	<!-- Select2 Css--->
	<link rel="stylesheet" href="{!! asset('public/adminlte/plugins/select2/select2.min.css') !!}">
@endsection

@section('addScripts')
	<!-- Select2 Js -->
	<script src="{!! asset('public/adminlte/plugins/select2/select2.full.min.js') !!}"></script>
	<!-- DateRangepicker Js --->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{!! asset('public/adminlte/plugins/daterangepicker/daterangepicker.js') !!}"></script>
	<!-- Add Highstocks Js --->
    <script src="{!! asset('public/adminlte/plugins/highstock/js/highstock.js') !!}"></script>
	<!-- dashboard js --->
    <script src="{!! asset('resources/assets/js/dashboard-function.js') !!}"></script>
@endsection

@section('content')
	   <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="pull-left">
            Dashboard
          </h1>
        </section>
		<br>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
		  <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
				<div class="box-header with-border">
				  <div class="form-group col-md-3">
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <input type="text" class="form-control pull-right datepicker" id="chart1-daterange"  value="{{ $dateRange }}">
					</div>
				  </div>
				  <div class="form-group col-md-5">
					{!! Form::select('charts1-item', $selectItems, $selectedItem, ['class' => 'form-control select2', 'id' => 'charts1-item']) !!}
				  </div>
				  <div class="form-group col-md-2">
					{!! Form::select('charts1-pricerange', $priceRange, null, ['class' => 'form-control select2', 'id' => 'charts1-pricerange']) !!}
				  </div>
				  <div class="form-group col-md-1">
					<button type="submit" class="btn btn-default" id="charts1-view-btn">view</button>
				   </div>
				   <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="col-sm-12" id="chart-1"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             </div><!-- /col -->
          </div><!-- /.row-->

		  <div class="row">
            <div class="col-md-12">
              <div class="box box-info">
				<div class="box-header with-border">
				  <div class="form-group col-md-2">
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <input type="text" class="form-control pull-right datepicker" id="chart2-date"  value="{!! date('m/d/Y') !!}">
					</div>
				  </div>
				  <div class="form-group col-md-5">
					{!! Form::select('charts2-branch', $selectBranches, $selectedBranch, ['class' => 'form-control select2', 'id' => 'charts2-branch']) !!}
				  </div>
				  <div class="form-group col-md-1">
					<button type="submit" class="btn btn-default" id="charts2-view-btn">view</button>
				  </div>
				   <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="col-md-12" id="chart-2"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             </div><!-- /col -->
          </div><!-- /.row-->
		  
		 <!-- <div class="row">
            <div class="col-md-6">
              <div class="box box-primary">
				<div class="box-header with-border">
                  <h3 class="box-title"></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <!-- <div class="box-body">
					<div class="col-md-12" id="chart-3"></div>
                </div><!-- /.box-body -->
              <!--</div><!-- /.box -->
             <!-- </div><!-- /col -->
          <!-- </div><!-- /.row-->
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection