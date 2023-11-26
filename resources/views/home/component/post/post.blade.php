@include('home.layout.header')
<div id="portfolio" class="section" style="padding-top:130px; min-height: 500px">
	<div class="container">
		<div class="row justify-content-center post-container">
			<div class="col-md-10 col-12 col-lg-9 text-center">
				<h1 class="mb-4 fw-bold h3">{{ mb_strtoupper($post->title) }}</h1>
				@if (isset($post->thumbnail) && $post->thumbnail != '')
					<img src="{{ asset('images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-50 ">
				@endif

				<div class="post-content mt-4">
					{!! $post->content !!}
				</div>
			</div>
		</div>


		@if (count($related_posts) > 0)
			<div class="row justify-content-center mt-4">
				<div class="col-md-10 col-12 col-lg-9 text-left">
					<h3 class="mb-4 fw-bold h3">Có thể bạn sẽ thích</h3>

					<div class="row">
						@foreach ($related_posts as $related)
							<div class="col-md-3 col-lg-3 col-6">
								<div class="card cate-card">
									<a href="">
										<div class="card-img-top cate-img border text-center">
											@if (isset($related->thumbnail) && $related->thumbnail != '')
												<img src="{{ asset('images/post/' . $related->thumbnail) }}" alt="{{ $related->title }}" title="{{ $related->title }}">
											@else
												<img src="{{ asset('images/post/post_blank.png') }}" alt="{{ $related->title }}" title="{{ $related->title }}">
											@endif

										</div>
									</a>
									<div class="card-body">
										<h2 class="card-title cate-name text-center">
											<a href="{{ route('home.post', $related->slug) }}" title="{{ $related->title }}">{{ $related->title }}</a>
										</h2>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif


	</div>
</div>
<style>
	.post-container {
		background-color: #fcfaf6;
	}

	.card-title a {
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		height: 48px;
	}
</style>
@include('home.layout.footer')
