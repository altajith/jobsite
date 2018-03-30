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

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="/"><img src="{{ elixir('images/logo.png') }}" alt=""></a>
				</div>

				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation" class="style-1">
					<ul id="responsive">

						<li><a class="current" href="/">Home</a></li>

						@if(\Auth::check())
							@php 
							$user = \Auth::user();
							@endphp

							@if($user->user_type_id == 1)
							<li><a class="current" href="/account/cvs">My CVs</a></li>
							<li><a class="current" href="/account/jobs">My Jobs</a></li>
							@endif

							@if($user->user_type_id == 2)
							<li><a class="current" href="/job/create">Create A Job</a></li>
							<li><a class="current" href="/job/list">Jobs</a></li>
							@endif

						@endif
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">
				<div class="header-widget">
				@if(\Auth::check())
					<!-- User Menu -->
					<div class="user-menu">
						@php 
						$user = \Auth::user();
						@endphp
						<div class="user-name"><span><img src="{{ ($user->picture ? $user->picture:elixir('images/user-avatar.jpg')) }}" alt=""></span>{{ $user->first_name }} {{ $user->last_name }}</div>
						<ul>
							<li><a href="/account"><i class="sl sl-icon-settings"></i> Account</a></li>
							<li><a href="/logout"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
				@else	
					<a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
					<a href="/signup" class="button border with-icon">Sign Up <i class="sl sl-icon-plus"></i></a>
				@endif
				</div>
			</div>
			<!-- Right Side Content / End -->

			<!-- Sign In Popup -->
			<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

				<div class="small-dialog-header">
					<h3>Sign In</h3>
				</div>

				<!--Tabs -->
				<div class="sign-in-form style-1">

					<div class="tabs-container alt">

						<!-- Login -->
						<div class="tab-content" id="tab1" style="display: none;">
							<form method="post" action="/login" class="login">
								{{ csrf_field() }}
								<p class="form-row form-row-wide">
									<label for="email">Email:
										<i class="im im-icon-Male"></i>
										<input type="text" class="input-text" name="email" id="email" value="{{ old('email') }}" />
									</label>
								</p>

								<p class="form-row form-row-wide">
									<label for="password">Password:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" name="password" id="password"/>
									</label>
									<span class="lost_password">
										<a href="/forgot/password/0" >Lost Your Password?</a>
									</span>
								</p>

								<div class="form-row">
									<input type="submit" class="button border margin-top-5" name="login" value="Login" />
									<div class="checkboxes margin-top-10">
										<input id="remember_me" type="checkbox" value="1" name="remember_me">
										<label for="remember_me">Remember Me</label>
									</div>
								</div>
								
							</form>
						</div>

					</div>
				</div>
			</div>
			<!-- Sign In Popup / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->

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

@if(!isset($fter))
<!-- Footer
================================================== -->
<div id="footer">
	<!-- Main -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-6">
				<img class="footer-logo" src="{{ elixir('images/logo.png') }}" alt="">
				<br><br>
				<p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
			</div>

			<div class="col-md-4 col-sm-6 ">
				<h4>Helpful Links</h4>
				<ul class="footer-links">
					<li><a href="#">Login</a></li>
					<li><a href="#">Sign Up</a></li>
					<li><a href="#">My Account</a></li>
					<li><a href="#">Add Listing</a></li>
					<li><a href="#">Pricing</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>

				<ul class="footer-links">
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Our Partners</a></li>
					<li><a href="#">How It Works</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>		

			<div class="col-md-3  col-sm-12">
				<h4>Contact Us</h4>
				<div class="text-widget">
					<span>12345 Little Lonsdale St, Melbourne</span> <br>
					Phone: <span>(123) 123-456 </span><br>
					E-Mail:<span> <a href="#">office@example.com</a> </span><br>
				</div>

				<ul class="social-icons margin-top-20">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
				</ul>

			</div>

		</div>
		
		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights">© {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.</div>
			</div>
		</div>

	</div>

</div>
<!-- Footer / End -->
@endif

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->



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

<!-- Style Switcher
================================================== 
<script src="scripts/switcher.js"></script>

<div id="style-switcher">
	<h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>
	
	<div>
		<ul class="colors" id="color1">
			<li><a href="#" class="main" title="Main"></a></li>
			<li><a href="#" class="blue" title="Blue"></a></li>
			<li><a href="#" class="green" title="Green"></a></li>
			<li><a href="#" class="orange" title="Orange"></a></li>
			<li><a href="#" class="navy" title="Navy"></a></li>
			<li><a href="#" class="yellow" title="Yellow"></a></li>
			<li><a href="#" class="peach" title="Peach"></a></li>
			<li><a href="#" class="beige" title="Beige"></a></li>
			<li><a href="#" class="purple" title="Purple"></a></li>
			<li><a href="#" class="celadon" title="Celadon"></a></li>
			<li><a href="#" class="red" title="Red"></a></li>
			<li><a href="#" class="brown" title="Brown"></a></li>
			<li><a href="#" class="cherry" title="Cherry"></a></li>
			<li><a href="#" class="cyan" title="Cyan"></a></li>
			<li><a href="#" class="gray" title="Gray"></a></li>
			<li><a href="#" class="olive" title="Olive"></a></li>
		</ul>
	</div>
		
</div>
 Style Switcher / End -->


</body>
</html>