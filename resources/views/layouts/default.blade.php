<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Referencing CSS that is hosted locally -->
	<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
  </head>

  <body>
  
    <div class="container">
       <header class="row">
			@include('includes.menu')
		</header>
		
		 <div id="main" class="row">
			@yield('content')
		</div>

		<footer class="row">
			@include('includes.footer')
		</footer>
    </div>
    
	<!-- Referencing JS that is hosted locally -->
	<script src="{!! asset('public/vendor/components/jquery/jquery.min.js') !!}"></script>
	<script src="{!! asset('bootstrap/dist/js/bootstrap.min.js') !!}"></script>
  </body>
</html>