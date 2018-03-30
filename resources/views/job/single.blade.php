@extends('layouts.single')

@section('title', 'Job')

@section('header')
@endsection

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">
	<div class="row sticky-wrapper margin-bottom-10">
		<div class="col-lg-8 col-md-8 padding-right-30 margin-bottom-30">

			<!-- Titlebar -->
			<div id="titlebar" class="listing-titlebar">
				<div class="listing-titlebar-title">
					<div class="row">
						<div class="col-xs-3">
							<img src="{{ $record->path }}" alt="">
						</div>
						<div class="col-xs-9">
							<h2>
							<a target="_blank" href="/job/view/{{ $record->id }}">{{ $record->title }}</a>
							<span class="listing-tag">{{ date('dS M, Y',strtotime($record->closing_date)) }}</span>
							</h2>
						
							<span>
								<a href="#listing-location" class="listing-address">
									<i class="fa fa-map-marker"></i>
									{{ $record->description }}
								</a>
							</span>
							<br/>
							<div class="rating-counter">
							Published on {{ date('dS F, Y',strtotime($record->publish_date)) }}
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<center>
			<br/>
			@if($user)
				@php 
				$application = $record->applications()->where('user_id',$user->id)->first();
				@endphp

				@if($user->user_type_id == 1)
					@if(!$application)
						<a href="/job/apply/{{ $record->id }}" class="button"><i class="sl sl-icon-envelope-open"></i> Apply</a>
					@else
						<h4>You have already applied for this job.</h4>
					@endif
				@endif
			@else	
				<a href="/signup/{{ $record->id }}" class="button"><i class="sl sl-icon-envelope-open"></i> Apply</a>
			@endif
			</center>

			<!-- Overview -->
			<div id="listing-overview" class="listing-section">

				<!-- Description -->
				<h3 class="listing-desc-headline">Job Description</h3>
				<p>{{ $record->description }}</p>

				<!-- Amenities -->
				<h3 class="listing-desc-headline">Job Experiance</h3>
				<ul class="listing-features checkboxes margin-top-0">
					@php
					$experiance = ($record->experiance <> '' ? explode("\n",$record->experiance):[]);
					@endphp
					@foreach($experiance as $exp)
					<li>{!! $exp !!}</li>
					@endforeach
				</ul>
			</div>
		
		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-30 sticky">

			<!-- Contact -->
			<div class="boxed-widget">
				<div class="hosted-by-title">
					<h4>{{ $record->user->first_name }} {{ $record->user->last_name }}</h4>
				</div>
				<ul class="listing-details-sidebar">
					<li><i class="sl sl-icon-phone"></i> {{ $record->user->mobile }}</li>
					<li><i class="fa fa-envelope-o"></i> <a href="mailto:{{ $record->user->email }}">{{ $record->user->email }}</a></li>
				</ul>
			</div>
			<!-- Contact / End-->

		</div>
		<!-- Sidebar / End -->

	</div>
</div>
<br/>
@endsection

@section('footer')
<script>
</script>
@endsection