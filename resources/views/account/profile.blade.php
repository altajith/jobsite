@extends('layouts.app')

@section('title', 'Account')

@section('header')
	<link rel="stylesheet" href="{{ elixir('css/plugins/inputmask.css') }}">
@endsection

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

	<div class="row">

		<div class="col-md-12">
			<div class="col-md-6">
				<h2>My Account</h2>
			</div>
			<div class="col-md-6" align="right">
				<a href="/account/advance/settings" class="button margin-top-15">Advance Settings</a>
			</div>
			<br/>
		</div>

		<!-- Profile -->
		<div class="col-lg-6 col-md-12">
			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Profile Details</h4>
				<div class="dashboard-list-box-static">
					
					<form action="/account/picture/change" method="post" enctype="multipart/form-data" id="formPicutre">
						{{ csrf_field() }}
						<!-- Avatar -->
						<div class="edit-profile-photo">
							<img src="{{ ($user->picture ? $user->picture:'images/user-avatar.jpg') }}" alt="">
							<div class="change-photo-btn">
								<div class="photoUpload">
									<span><i class="fa fa-upload"></i> Upload Photo</span>
									<input type="file" name="photo" onChange="document.getElementById('formPicutre').submit();" class="upload" />
								</div>
							</div>
						</div>
					</form>

					<!-- Details -->

					<form action="/account/save" method="post">
						<div class="my-profile">
							{{ csrf_field() }}
							<label>Email</label>
							<input value="{{ $user->email }}" readonly="readonly" type="text">

							<label>First Name</label>
							<input value="{{ $user->first_name }}" id="first_name" name="first_name" placeholder="Your first name." type="text">

							<label>Last Name</label>
							<input value="{{ $user->last_name }}" id="last_name" name="last_name" placeholder="Your last name." type="text">

							<label>Mobile</label>
							<input value="{{ $user->mobile }}" id="mobile" name="mobile" placeholder="Your mobile number." type="text">

							<label>Date of birth</label>
							<input value="{{ $user->date_of_birth }}" id="date_of_birth" name="date_of_birth" placeholder="Your birthday." type="text">
							
							<label>Gender</label>
							<select id="gender" name="gender" class="chosen-select-no-single" >
								<option label="blank">Select your gender</option>	
								<option value="male" {{ ($user->gender == 'male' ? 'selected':'') }}>Male</option>
								<option value="female" {{ ($user->gender == 'female' ? 'selected':'') }}>Female</option>
							</select>
						</div>

						<button class="button margin-top-15">Save Changes</button>
					</form>

				</div>
			</div>
		</div>

		<!-- Change Password -->
		<div class="col-lg-6 col-md-12">
			<div class="dashboard-list-box margin-top-0">
				<h4 class="gray">Change Password</h4>
				<div class="dashboard-list-box-static">

					<!-- Change Password -->
					<form action="/account/password/change" method="post">
						{{ csrf_field() }}
						<div class="my-profile">
							<label class="margin-top-0">Current Password</label>
							<input type="password" name="current_password">

							<label>New Password</label>
							<input type="password" name="password">

							<label>Confirm New Password</label>
							<input type="password" name="password_confirmation">

							<button class="button margin-top-15">Change Password</button>
						</div>
					</form>

				</div>
			</div>
		</div>

	</div>

</div>
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