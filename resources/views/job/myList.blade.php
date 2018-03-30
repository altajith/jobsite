@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

	<div class="row">

		<div class="col-md-12">
			<h2>My Jobs</h2>
			<br/>
		</div>

		
		<div class="row">
		@foreach($records as $item)
			@php
			$record = $item->job;
			@endphp
			<!-- Listing Item -->
			<div class="col-lg-4 col-md-6">
				<a href="/job/view/{{ $record->id }}" class="listing-item-container compact">
					<div class="listing-item">
						<img src="{{ $record->path }}" alt="">

						@php 
						$expired = false;
						if(strtotime($record->closing_date) < strtotime(date('Y-m-d'))){
							$expired = true;
						}
						@endphp


						@if($record->status == 1)
						<div class="listing-badge now-open">Active</div>
						@else
							@if($expired)
								<div class="listing-badge now-closed">Expired</div>
							@else
								<div class="listing-badge now-closed">Inactive</div>
							@endif
						@endif

						<div class="listing-item-content">
							<div class="numerical-rating" data-rating="3.5"></div>
							<h3>{{ $record->title }} 
								@if(!$expired)
								<i class="verified-icon"></i>
								@endif
							</h3>
							<span>{{ $record->location }}</span>
						</div>
						<span class="like-icon"></span>
					</div>
				</a>
			</div>
			<!-- Listing Item / End -->
			@endforeach
		</div>

		{{ $records->links() }}

	</div>

</div>
<!-- Container / End -->
<br/>
@endsection