@include('home.layout.header')
<div id="portfolio" class="section" style="padding-top:130px; min-height: 500px">
	<div class="container">
		<h1 class="mb-4 fw-bold h3 text-center">Tất cả bài viết</h1>
		<div class="row">
			@if ($posts && count($posts) > 0)
				@foreach ($posts as $post)
					@if ($post->status == 'Draft')
						<div class="alert alert-warning text-danger text-center">Chưa có bài viết</div>
					@else
						{{-- Hiển thị bài viết tại đây --}}
						<div class="col-lg-3 col-md-4 col-6 mb-4">
							<div class="card cate-card">
								<a href="">
									<div class="card-img-top cate-img border text-center">
										@if (isset($post->thumbnail) && $post->thumbnail != '')
											<img src="{{ asset('images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}" title="{{ $post->title }}">
										@else
											<img src="{{ asset('images/post/post_blank.png') }}" alt="{{ $post->title }}" title="{{ $post->title }}">
										@endif

									</div>
								</a>
								<div class="card-body">
									<span class="text-muted" style="font-size: 13px"><i>{!! $post->category->name !!}</i></span>
									<h2 class="card-title cate-name text-center pt-2">

										<a href="{{ route('home.post', $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
									</h2>
								</div>
							</div>
						</div>
					@endif
				@endforeach

				<div class="col-md-12 col-12 text-center mt-4">
					{{ $posts->links() }}
				</div>
			@else
				<div class="alert alert-warning text-danger text-center">Chưa có bài viết</div>
			@endif
		</div>

	</div>
</div>
<style>
	.card {
		box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
	}

	.card:hover {
		box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
		cursor: pointer;
	}

	.card-title {
		font-size: 20px;
		text-align: left !important;
	}

	.card-title a {
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		height: 48px;
	}

	.card-body {
		padding: .5rem .5rem !important;
	}

	.card-img-top img {
		height: 140px !important;
		object-fit: contain;
	}
</style>
@include('home.layout.footer')
