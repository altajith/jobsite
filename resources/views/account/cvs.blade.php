@extends('layouts.app')

@section('title', 'My CVs')

@section('content')
<div class="clearfix"></div>
<!-- Container -->
<div class="container">

	<div class="row">

		<div class="col-md-12">
			<div class="col-md-6">
				<h2>My CVs</h2>
			</div>
			<div class="col-md-6" align="right">
				<a href="/account/cv/new/0" class="button margin-top-15">New CV</a>
			</div>
			<br/>
		</div>

		<!-- Listings -->
		<div class="col-lg-12 col-md-12">
			<div class="dashboard-list-box margin-top-0">
				<h4>CV Listings</h4>

				<table class="table table-striped">
					<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Status</th>
						<th>Created At</th>
						<th>Actions</th>
					</tr>
					</thead>
					<tbody>
					@foreach($records as $record)
						<tr>
							<td>{{ $record->id }}</td>
							<td><a href="{{ $record->path }}" target="_blank">{{ $record->title }}</a></td>
							<td>{{ ($record->status == 1 ? 'Active':'Inactive') }}</td>
							<td>{{ date('Y-m-d h:i a',strtotime($record->created_at)) }}</td>
							<td>
								<a href="/account/cv/edit/{{ $record->id }}" class="button gray"><i class="sl sl-icon-note"></i> Edit</a>
								<a href="{{ $record->path }}" class="button gray"><i class="sl sl-icon-cloud-download"></i> Download</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>

				{{ $records->links() }}
			</div>
		</div>

	</div>

</div>
<!-- Container / End -->
<br/>
@endsection