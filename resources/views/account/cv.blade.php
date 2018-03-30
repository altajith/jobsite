@extends('layouts.app')

@if($id > 0)
@section('title', 'Edit CV')
@else
@section('title', 'New CV')
@endif

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

		<div class="row">

			<div class="col-md-12">
				@if($id > 0)
					<h2>Edit CV</h2>
				@else
					<h2>New CV</h2>
				@endif
				<br/>
			</div>


			<div class="col-lg-12">

				<form action="/account/cv/save" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="cv_id" id="cv_id" value="{{ $id }}" />
					<div id="add-listing" class="separated-form">

						<!-- Section -->
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-doc"></i> CV Informations</h3>
							</div>

							<!-- Basic -->
							<div class="row with-forms">
								<div class="col-md-4">
									<h5>Title</h5>
									<input class="search-field" type="text" name="cv_title" id="cv_title" value="{{ $cv_title }}" placeholder="Enter the cv title"/>
								</div>
								<div class="col-md-4">
									<h5>Status</h5>
									<select id="status" name="status" class="chosen-select-no-single" >
										<option label="blank">Select the cv status</option>	
										<option value="1" {{ ($status == 1 ? 'selected':'') }}>Active</option>
										<option value="0" {{ ($status == 0 ? 'selected':'') }}>Inactive</option>
									</select>
								</div>
								<div class="col-md-4">
									<h5>CV File</h5>
									<input class="form-file" type="file" name="cv_file" id="cv_file" />
									<code>.pdf,.doc,.docx</code>
									@if($path)
										<a href="{{ $path }}" target="_blank">Download CV File</a>
									@endif
								</div>
							</div>
							
							<!-- Description -->
							<div class="form">
								<h5>Cover Letter</h5>
								<textarea class="WYSIWYG" name="cover_letter" cols="40" rows="3" id="cover_letter" spellcheck="true" placeholder="Enter your cover letter.">{{ $cover_letter }}</textarea>
							</div>

							<!-- Row -->
							<div class="row">
								<!-- Mobile -->
								<div class="col-md-12" align="right">
									<button type="submit" class="button preview">Save <i class="fa fa-arrow-circle-right"></i></button>
								</div>
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
  		$("#date_of_birth").inputmask("9999-99-99");
		$("#mobile").inputmask("(999) 9999 999");
	});
	</script>
@endsection