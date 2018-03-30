@extends('layouts.app')

@section('title', 'Forgot Password?')

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

		<div class="row">
			<div class="col-lg-12">
				<br/>

				<form action="/forgot/password/change" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="init" value="{{ ($init ? 1:2) }}" />
					<div id="add-listing" class="separated-form">

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-lock"></i> Forgot Password?</h3>
							</div>

							@if($init)
							<!-- Email -->
							<div class="row with-forms">
								<div class="col-md-12">
									<h5>Your email address</h5>
									<input class="search-field" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email address here."/>
								</div>
							</div>
							@else
							<!-- Email -->
							<div class="row with-forms">
								<div class="col-md-12">
									<h5>Your email address</h5>
									<input class="search-field" type="text" readonly="readonly" value="{{ $email }}" />
									<input type="hidden" name="email" value="{{ $email }}" />
									<input type="hidden" name="token" value="{{ $token }}" />
								</div>
							</div>
							<!-- Password -->
							<div class="row with-forms">
								<div class="col-md-6">
									<h5>New Password</h5>
									<input class="search-field" type="password" name="password" id="password" placeholder="Enter your new password here."/>
								</div>
								<div class="col-md-6">
									<h5>Confirm Password</h5>
									<input class="search-field" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your new password here."/>
								</div>
							</div>
							@endif

						</div>
						<!-- Section / End -->

						<!-- Row -->
						<div class="row">
							<!-- Mobile -->
							<div class="col-md-12" align="right">
								<button type="submit" class="button preview">
								@if($init)
									Reset <i class="fa fa-arrow-circle-right"></i>
								@else
									Change <i class="fa fa-lock"></i>
								@endif
								</button>
							</div>
						</div>
						<!-- Row / End -->
						<br/>

					</div>
				</form>

			</div>

		</div>

	</div>
	<!-- Content / End -->
<!-- Container / End -->
@endsection