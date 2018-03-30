<!DOCTYPE html>
<head>

	<!-- Basic Page Needs
	================================================== -->
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="{{ elixir('css/style.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/colors/main.css') }}" id="colors">

	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">

	@yield('header')

</head>

<body>

@if ($errors->any())
<!-- Container -->
<br/>
<div class="container">
	<div class="row">
		@php 
		$errors = $errors->all();
		@endphp
		@if(count($errors) > 0)
		<div class="col-lg-12">
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
    	</div>
		@endif


    </div>
</div>
@endif

@if (session('success'))
<!-- Container -->
<br/>
<div class="container">
	<div class="row">
	@php
		$successs = session('success');
		session()->forget('success');
	@endphp
	@if(is_array($successs) && count($successs) > 0)
	<div class="col-lg-12">
		<div class="alert alert-success">
			<ul>
				@foreach ($successs as $success)
					<li>{{ $success }}</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif
    </div>
</div>
@endif

@yield('content')

<!-- Scripts
================================================== -->
<script type="text/javascript" src="{{ elixir('js/scripts/jquery-2.2.0.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/mmenu.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/chosen.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/rangeslider.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/tooltips.min.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/scripts/custom.js') }}"></script>

@yield('footer')

</body>
</html>