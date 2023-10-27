@include('home.layout.header')

<div id="portfolio" class="our-portfolio section">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
					{{-- <h6>Our Portofolio</h6> --}}
					<h4>Top 10 phim trong năm {{ date('Y') }}</h4>
					<div class="line-dec"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
		<div class="row">
			<div class="col-lg-12">
				<div class="loop owl-carousel">
					@foreach ($top10 as $top)
						<div class="item">
							<a href="{{ route('home.phim', [Str::slug($top->name), $top->id]) }}">
								<div class="portfolio-item">
									<div class="thumb">
										<img src="{!! $top->img_big !!}" alt="{!! $top->name_vi !!}">
									</div>
									<div class="down-content">
										<h4>{!! $top->name_vi !!}</h4>
										<span>${!! number_format($top->worldwide, 0, '.', ',') !!} </span>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>


@include('home.layout.footer')
