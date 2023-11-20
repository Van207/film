@include('home.layout.header')
<div id="portfolio" class="section" style="padding-top:130px; min-height: 500px">
	<div class="container">
		<h1 class="mb-4">{{ $cate->name }}</h1>
		<div class="row">
			@if ($posts && count($posts) > 0)
				@foreach ($posts as $post)
					@if ($post->status == 'Draft')
						<div class="alert alert-warning text-danger text-center">Chưa có bài viết</div>
					@else
						{{-- Hiển thị bài viết tại đây --}}
						<div class="col-lg-3 col-md-4 col-6">
							<div class="card cate-card">
								<a href="">
									<div class="card-img-top cate-img border text-center">
										@if (isset($post->thumbnail) && $post->thumbnail != '')
											<img src="{{ asset('images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}">
										@else
											<img src="{{ asset('images/post/post_blank.png') }}" alt="{{ $post->title }}">
										@endif

									</div>
								</a>
								<div class="card-body">
									<h2 class="card-title cate-name text-center">
										<a href="{{ route('home.post', $post->slug) }}" style="font-size: 24px">{{ $post->title }}</a>
									</h2>
								</div>
							</div>
						</div>
					@endif
				@endforeach
			@else
				<div class="alert alert-warning text-danger text-center">Chưa có bài viết</div>
			@endif
		</div>

	</div>
</div>
@include('home.layout.footer')
