@extends('layouts.app')

@section('title', 'Create New Job')

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

		<div class="row">

			<div class="col-md-12">
				<h2>Create New Job</h2>
				<br/>
			</div>


			<div class="col-lg-12">

				<form action="/job/save" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					<div id="add-listing" class="separated-form">

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-pin"></i> Basic Information</h3>
							</div>

							<div class="row with-forms">
								<div class="col-md-12">
									<h5>Title</h5>
									<input class="search-field" type="text" name="job_title" id="job_title" value="{{ $job_title }}" placeholder="Enter the job title"/>
								</div>
							</div>

							<div class="row with-forms">
								<div class="col-md-6">
									<h5>Publish Date</h5>
									<input class="search-field date" type="text" name="publish_date" id="publish_date" value="{{ $publish_date }}"/>
								</div>
								<div class="col-md-6">
									<h5>Closing Date</h5>
									<input class="search-field date" type="text" name="closing_date" id="closing_date" value="{{ $closing_date }}"/>
								</div>
							</div>

						</div>
						<br/>

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-layers"></i> Options</h3>
							</div>

							<!-- Basic -->
							<div class="row with-forms">
								<div class="col-md-6">
									<h5>Category</h5>
									<select id="category" name="category" class="chosen-select-no-single" >
										<option label="blank" value="">Select the job category</option>	
										@foreach($cats as $cat)
										<option value="{{ $cat->id }}" {{ ($category == $cat->id ? 'selected':'') }}>{{ $cat->job_title }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<h5>Image</h5>
									<input class="form-file" type="file" name="job_file" id="job_file" />
									<code>.png,.jpg,.jpeg</code>
								</div>
							</div>

							<div class="row with-forms">
								<div class="col-md-6">
									<h5>Acadamic</h5>
									<select id="acadamic" name="acadamic" class="chosen-select-no-single" >
										<option label="blank" value="">Select the job acadamic</option>	
										@foreach($acs as $ac)
										<option value="{{ $ac->id }}" {{ ($acadamic == $ac->id ? 'selected':'') }}>{{ $ac->acadamic_detail }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<h5>Nature</h5>
									<select id="nature" name="nature" class="chosen-select-no-single" >
										<option label="blank" value="">Select the job nature</option>	
										@foreach($nats as $nat)
										<option value="{{ $nat->id }}" {{ ($nature == $nat->id ? 'selected':'') }}>{{ $nat->nature }}</option>
										@endforeach
									</select>
								</div>
							</div>

						</div>
						<br/>

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-location"></i> Job Location</h3>
							</div>

							<!-- Description -->
							<div class="form">
								<h5>Address</h5>
								<textarea class="WYSIWYG" name="address" cols="40" rows="3" id="address" spellcheck="true" placeholder="Enter the job address.">{{ $address }}</textarea>
							</div>
						</div>
						<br/>

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-energy"></i> Job Description</h3>
							</div>

							<!-- Description -->
							<div class="form">
								<h5>Description</h5>
								<textarea class="WYSIWYG" name="description" cols="40" rows="3" id="description" spellcheck="true" placeholder="Enter the job description.">{{ $description }}</textarea>
							</div>
						</div>
						<br/>

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-share"></i> Job Experiance</h3>
							</div>

							<!-- Description -->
							<div class="form">
								<h5>Experiance</h5>
								<textarea class="WYSIWYG" name="experiance" cols="40" rows="3" id="experiance" spellcheck="true" placeholder="Enter the job experiance.">{{ $experiance }}</textarea>
								<code>Separate with new lines each experience</code>
							</div>
						</div>

						<!-- Row -->
						<div class="row">
							<!-- Mobile -->
							<div class="col-md-12" align="right">
								<button type="submit" class="button preview">Save <i class="fa fa-arrow-circle-right"></i></button>
							</div>
						</div>
					
					</div>
				</form>

			</div>

		</div>

	</div>
	<!-- Content / End -->
<!-- Container / End -->
</br>
@endsection

@section('footer')
	<script type="text/javascript" src="{{ elixir('js/scripts/inputmask/jquery.inputmask.bundle.js') }}"></script>
	<script>
	$(document).ready(function(){
  		$(".date").inputmask("9999-99-99");
		$("#mobile").inputmask("(999) 9999 999");
	});
	</script>
@endsection