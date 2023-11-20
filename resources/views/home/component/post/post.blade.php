@include('home.layout.header')
<div id="portfolio" class="section" style="padding-top:130px; min-height: 500px">
	<div class="container">
		<h1 class="mb-4 text-center">{{ $post->title }}</h1>
		<div class="row justify-content-center">
			<div class="col-md-10 col-12 col-lg-9 text-center">
				@if (isset($post->thumbnail) && $post->thumbnail != '')
					<img src="{{ asset('images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-50 ">
				@endif

				<div class="post-content mt-4" style="text-align: justify;">
					{!! $post->content !!}
				</div>
			</div>
		</div>

	</div>
</div>
@include('home.layout.footer')
