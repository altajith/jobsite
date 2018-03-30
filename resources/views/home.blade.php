@extends('layouts.app')

@section('title', 'Home')

@section('header')
<style>
.items-section{
    max-height: 500px;
    min-height: 500px;
	overflow-y: scroll;
	background: #ededed;
	padding: 10px;
	border-radius: 5px;
}
.listing-item-container.list-layout .listing-item {
    height: 130px !important;
}
.listing-item-container.list-layout .listing-item-image {
    min-height: 130px !important;
}
.fs-inner-container.content {
    padding-top: 0px !important;
}
.ifrm{
	border: 0;
	height:100%;
    width: 100%;
    margin: 0;
    z-index: 990;
}
.map-container{
	height:100% !important;
}
</style>
@endsection

@section('content')
<!-- Container -->
<div class="fs-container">

	<div class="fs-inner-container content">
		<div class="fs-content">

			<!-- Search -->
			<section class="search">

				<div class="row">
					<div class="col-md-12">

							<!-- Row With Forms -->
							<div class="row with-forms">

								<form action="/" method="get">
									{{ csrf_field() }}
								
									<!-- Main Search Input -->
									<div class="col-fs-6">
										<div class="input-with-icon">
											<i class="sl sl-icon-magnifier"></i>
											<input type="text" name="title" placeholder="What are you looking for?" value="{{ $title }}"/>
										</div>
									</div>

									<!-- Main Search Input -->
									<div class="col-fs-6">
										<div class="input-with-icon location">
											<input type="text" name="address" placeholder="Destination, city, address" value="{{ $address }}"/>
											<a href="#"><i class="fa fa-dot-circle-o"></i></a>
										</div>
									</div>

									<!-- Filters -->
									<div class="col-fs-12">

										<!-- Panel Dropdown / End -->
										<div class="panel-dropdown">
											<a href="#">Categories</a>
											<div class="panel-dropdown-content checkboxes categories">
												
												<!-- Checkboxes -->
												<div class="row">
													@foreach($cats as $cat)
													<div class="col-md-3">
														<input id="cat-{{$cat->id }}" value="{{ $cat->id }}" {{ (in_array($cat->id,$category) ? 'checked':'') }} type="checkbox" name="category[]">
														<label for="cat-{{$cat->id }}">{{ $cat->job_title }}</label>
													</div>
													@endforeach
												</div>
												
												<!-- Buttons -->
												<div class="panel-buttons">
													<button type="button" class="panel-cancel">Cancel</button>
													<button type="submit" class="panel-apply">Apply</button>
												</div>

											</div>
										</div>
										<!-- Panel Dropdown / End -->

										<!-- Panel Dropdown / End -->
										<div class="panel-dropdown">
											<a href="#">Acadamics</a>
											<div class="panel-dropdown-content checkboxes categories">
												
												<!-- Checkboxes -->
												<div class="row">
													@foreach($acs as $ac)
													<div class="col-md-3">
														<input id="ac-{{$ac->id }}" value="{{ $ac->id }}" {{ (in_array($ac->id,$acadamic) ? 'checked':'') }} type="checkbox" name="acadamic[]">
														<label for="ac-{{$ac->id }}">{{ $ac->acadamic_detail }}</label>
													</div>
													@endforeach
												</div>
												
												<!-- Buttons -->
												<div class="panel-buttons">
													<button type="button" class="panel-cancel">Cancel</button>
													<button type="submit" class="panel-apply">Apply</button>
												</div>

											</div>
										</div>
										<!-- Panel Dropdown / End -->

										<!-- Panel Dropdown / End -->
										<div class="panel-dropdown">
											<a href="#">Natures</a>
											<div class="panel-dropdown-content checkboxes categories">
												
												<!-- Checkboxes -->
												<div class="row">
													@foreach($nats as $nat)
													<div class="col-md-3">
														<input id="nat-{{$nat->id }}" value="{{ $nat->id }}" {{ (in_array($nat->id,$nature)  ? 'checked':'') }} type="checkbox" name="nature[]">
														<label for="nat-{{$nat->id }}">{{ $nat->nature }}</label>
													</div>
													@endforeach
												</div>
												
												<!-- Buttons -->
												<div class="panel-buttons">
													<button type="button" class="panel-cancel">Cancel</button>
													<button type="submit" class="panel-apply">Apply</button>
												</div>

											</div>
										</div>
										<!-- Panel Dropdown / End -->

									</form>

								</div>
								<!-- Filters / End -->
	
							</div>
							<!-- Row With Forms / End -->

					</div>
				</div>

			</section>
			<!-- Search / End -->


		<section class="listings-container margin-top-30">
			<!-- Sorting / Layout Switcher -->
			<div class="row fs-switcher">

				<div class="col-md-6">
					<!-- Showing Results -->
					<p class="showing-results">14 Results Found </p>
				</div>

			</div>


			<!-- Listings -->
			<div class="row fs-listings">
				@foreach($records as $record)
                <!-- Listing Item -->
                <div class="col-lg-12 col-md-12">
                    <div class="listing-item-container list-layout">
                        <a href="#ifrm" onClick="changeIframe({{ $record->id }})" class="listing-item">

                            <!-- Image -->
                            <div class="listing-item-image">
                                <img src="{{ $record->path }}" alt="">
                            </div>

                            <!-- Content -->
                            <div class="listing-item-content">
                                <div class="listing-badge closed">{{ date('dS M',strtotime($record->closing_date)) }}</div>

                                <div class="listing-item-inner">
                                    <h3>{{ $record->title }} <i class="verified-icon"></i></h3>
                                    <span>{{ $record->location }}</span>
                                    <br/>
                                    <small>
                                        {{ date('dS M',strtotime($record->publish_date)) }}
                                    </small>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <!-- Listing Item / End -->
                @endforeach
			</div>
			<!-- Listings Container / End -->


			<!-- Pagination Container -->
			<div class="row fs-listings">
				<div class="col-md-12">

					<!-- Pagination -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<!-- Pagination -->
							<div class="pagination-container margin-top-15 margin-bottom-40">
							{{ $records->links() }}
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- Pagination / End -->
				
					<!-- Copyrights -->
					<div class="copyrights margin-top-0">© {{ date('Y') }} Listeo. All Rights Reserved.</div>

				</div>
			</div>
			<!-- Pagination Container / End -->
		</section>

		</div>
	</div>
	<div class="fs-inner-container map-fixed">
		<div class="map-container">
			<iframe class="ifrm" id="ifrm" src="{{ url('/') }}/init"></iframe>
		</div>
	</div>
</div>

@endsection

@section('footer')
<script>
	function changeIframe(id){
		$("#ifrm").attr("src","/job/"+id);
	}
	$(function() {
		$('#ifrm').on("load", function() {
			
		});
	});
</script>
@endsection