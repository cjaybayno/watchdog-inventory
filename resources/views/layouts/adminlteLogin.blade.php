<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Watchdog | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
  	<link rel="stylesheet" href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet"  href="{!! asset('public/adminlte/css/AdminLTE.min.css') !!}" >
	<!-- Additional Stylesheet -->
	@if (! empty($assets['stylesheet']))
		@foreach ($assets['stylesheet'] as $stylesheet)
			@if ($stylesheet != '')
				<link rel="stylesheet"  href="{!! asset('public/'.$stylesheet.'') !!}" >
			@endif
		@endforeach
	@endif
	@yield('addStylesheets')
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
  	@yield('content')
	
	 <!-- jQuery 2.1.4 -->
	<script src="{!! asset('public/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap 3.3.5 -->
	<script src="{!! asset('public/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
	<!-- Additional Script -->
	@if (! empty($assets['scripts']))
		@foreach ($assets['scripts'] as $scripts)
			@if ($scripts != '')
				<script src="{!! asset('public/'.$scripts.'') !!}" ></script>
			@endif
		@endforeach
	@endif
	@yield('addScripts')
  
  </body>
<html>