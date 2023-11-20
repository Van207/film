@include('home.layout.header')
<div id="portfolio" class="section" style="padding-top:130px; min-height: 500px">
	<div class="container">
		<h1 class="mb-4">{{ $post->title }}</h1>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				@if (isset($post->thumbnail) && $post->thumbnail != '')
					<img src="{{ asset('images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-25 text-center">
				@endif

				<div class="post-content mt-4">
					{!! $post->content !!}
				</div>
			</div>
		</div>

	</div>
</div>
@include('home.layout.footer')
