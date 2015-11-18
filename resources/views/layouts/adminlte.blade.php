<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Watchdog | @yield('title')</title>
	<!-- Add token -->
	<meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
  	<link rel="stylesheet" href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('public/font-awesome-4.4.0/css/font-awesome.min.css') !!}" >
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! asset('public/ionicons-2.0.1/css/ionicons.min.css') !!}">
	<!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="{!! asset('public/adminlte/css/skins/skin-green.min.css') !!}  ">
	<!-- Put modal in center -->
	<style>
		.modal {
		  text-align: center;
		}

		@media screen and (min-width: 768px) {
		  .modal:before {
			display: inline-block;
			vertical-align: middle;
			content: " ";
			height: 80%;
		  }
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}
    </style>
	
	@if (! empty($assets['stylesheet']))
	<!-- Additional Stylesheet -->
		@foreach ($assets['stylesheet'] as $stylesheet)
			@if ($stylesheet != '')
				<link rel="stylesheet"  href="{!! asset('public/'.$stylesheet.'') !!}" >
			@endif
		@endforeach
	@endif
	@yield('addStylesheets')
	<!-- Theme style -->
    <link rel="stylesheet"  href="{!! asset('public/adminlte/css/AdminLTE.min.css') !!}" >
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-green sidebar-mini">
   <div class="wrapper">
   @include('includes.header')
   @include('includes.sidebar')
   @yield('content')
   @include('includes.footer')
   </div><!-- ./wrapper -->
	
	<!-- jQuery 2.1.4 -->
	<script src="{!! asset('public/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap js 3.3.5 -->
	<script src="{!! asset('public/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
	<!-- AdminLTE js App -->
    <script  src="{!! asset('public/adminlte/js/app.min.js') !!}" ></script>
	<!-- Helper Function js -->
    <script src="{!! asset('resources/assets/js/helper-function.js') !!}" ></script>
	<script>
		/* === base url of application === */ 
		var url = "{{ url() }}";
	</script>
	@if (! empty($assets['scripts']))
	<!-- Additional Script -->
		@foreach ($assets['scripts'] as $scripts)
			@if ($scripts != '')
				<script src="{!! asset('public/'.$scripts.'') !!}" ></script>
			@endif
		@endforeach
	@endif
	@yield('addScripts')
	
	<!-- General modal -->
	<div class="modal fade" id="generic-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title generic-modal-title"></h4>
		  </div>
		  <div class="modal-body">
			<div id="generic-modal-alert">
			  <p id="generic-modal-message"></p>
			</div>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
  </body>
<html>