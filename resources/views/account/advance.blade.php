@extends('layouts.app')

@section('title', 'Register')

@section('header')
	<link rel="stylesheet" href="{{ elixir('css/plugins/inputmask.css') }}">
@endsection

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

		<div class="row">

			<div class="col-md-12">
				<h2>Advance Settings</h2>
				<br/>
			</div>

			<div class="col-lg-12">

				<form action="/account/advance/settings/save" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					<div id="add-listing" class="separated-form">

						<!-- Section -->
						@foreach($records as $key => $record)
						<div class="add-listing-section">

							<!-- Headline -->
							<div class="add-listing-headline">
								<h3><i class="sl sl-icon-doc"></i> {{ $key }}</h3>
							</div>

							<!-- Basic -->
							<div class="row with-forms">
								@foreach($record as $element)
								<div class="col-md-4">
									<h5>{{ $element->property_name }}</h5>
									@php 
										$user_property_value = ($element->user_property ? $element->user_property->value:$element->default_value);
									@endphp
									{!! \App\Helpers\Common::buildAdvanceField($element->property_type,$user_property_value,$element->id,$element->note,"search-field",$element->default_value) !!}
								</div>
								@endforeach
							</div>
							
						</div>
						<br/>
						@endforeach

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
		$(".phone").inputmask("(999) 9999 999");
	});
	</script>
@endsection