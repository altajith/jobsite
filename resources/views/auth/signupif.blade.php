@extends('layouts.single')

@section('title', 'Register')

@section('header')
	<link rel="stylesheet" href="{{ elixir('css/plugins/inputmask.css') }}">
@endsection

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

		<div class="row">
			<div class="col-lg-12">
				<br/>

				<form action="/register" method="post">
					{{ csrf_field() }}
					<div id="add-listing" class="separated-form">

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-doc"></i> Basic Informations</h3>
							</div>

							<!-- Name -->
							<div class="row with-forms">
								<div class="col-md-6">
									<h5>First Name<i class="tip" data-tip-content="Enter your first name."></i></h5>
									<input class="search-field" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First name"/>
								</div>
								<div class="col-md-6">
									<h5>Last Name<i class="tip" data-tip-content="Enter your last name."></i></h5>
									<input class="search-field" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last name"/>
								</div>
							</div>

							<!-- Row -->
							<div class="row with-forms">

								<!-- Gender -->
								<div class="col-md-6">
									<h5>Gender<i class="tip" data-tip-content="Enter your gender."></i></h5>
									<select id="gender" name="gender" class="chosen-select-no-single" >
										<option label="blank">Select your gender</option>	
										<option value="male" {{ (old('gender') == 'male' ? 'selected':'') }}>Male</option>
										<option value="female" {{ (old('gender') == 'female' ? 'selected':'') }}>Female</option>
									</select>
								</div>

								<!-- User Type -->
								<div class="col-md-6">
									<h5>User Type<i class="tip" data-tip-content="Select how do you want to use your account."></i></h5>
									<select id="user_type_id" name="user_type_id" class="chosen-select-no-single" >
										<option label="blank">Select User type</option>	
										@foreach(\App\Helpers\Common::getUserTypes() as $userType)
										<option value="{{ $userType->id }}" {{ (old('user_type_id') == $userType->id ? 'selected':'') }}>{{ $userType->type }}</option>
										@endforeach
									</select>
								</div>

							</div>
							<!-- Row / End -->

						</div>
						<!-- Section / End -->

						<!-- Section -->
						<div class="add-listing-section margin-top-45">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-notebook"></i> Contacts</h3>
							</div>

							<div class="submit-section">

								<!-- Row -->
								<div class="row with-forms">

									<!-- Email -->
									<div class="col-md-6">
										<h5>Email<i class="tip" data-tip-content="Enter your email address."></i></h5>
										<input type="email" class="search-field"  name="email" id="email" value="{{ old('email') }}" placeholder="Email address">
									</div>

									<!-- DOB -->
									<div class="col-md-6">
										<h5>Date of birth<i class="tip" data-tip-content="Enter your birthday."></i></h5>
										<input type="text" class="search-field"  name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Birthday"/>
									</div>

									<!-- Mobile -->
									<div class="col-md-6">
										<h5>Mobile<i class="tip" data-tip-content="Enter your mobile number."></i></h5>
										<input type="text" class="search-field"  name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="Mobile number"/>
									</div>
									<input type="hidden" name="job_id" value="{{ $id }}">
								</div>
								<!-- Row / End -->

							</div>
						</div>
						<!-- Section / End -->

						<!-- Row -->
						<div class="row">
							<!-- Mobile -->
							<div class="col-md-12" align="right">
								<button type="submit" class="button preview">Sign Up <i class="fa fa-arrow-circle-right"></i></button>
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

@section('footer')
	<script type="text/javascript" src="{{ elixir('js/scripts/inputmask/jquery.inputmask.bundle.js') }}"></script>
	<script>
	$(document).ready(function(){
  		$("#date_of_birth").inputmask("9999-99-99");
		$("#mobile").inputmask("(999) 9999 999");
	});
	</script>
@endsection