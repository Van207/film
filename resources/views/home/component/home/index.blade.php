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
							<a href="{{ route('home.phim', [Str::slug($top->name), $top->id]) }}" title="{{ $top->name_vi }}">
								<div class="portfolio-item">
									<div class="thumb">
										<img src="{!! $top->img_big !!}" alt="{!! $top->name_vi !!}" loading="lazy">
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

<div id="portfolio" class="our-portfolio section" style="padding: 0 !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
					<h4><a href="{{ route('phim.filter') . '?genre=Action' }}">Top phim hành động</a></h4>
					<div class="line-dec"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
		<div class="row">
			<div class="col-lg-12">
				<div class="loop owl-carousel">
					@foreach ($top_action as $action)
						<div class="item">
							<a href="{{ route('home.phim', [Str::slug($action->name), $action->film_id]) }}" title="{{ $action->name_vi }}">
								<div class="portfolio-item">
									<div class="thumb">
										<img src="{!! $action->img_big !!}" alt="{!! $action->name_vi !!}" loading="lazy">
									</div>
									<div class="down-content">
										<h4>{!! $action->name_vi !!}</h4>
										<span>${!! number_format($action->worldwide, 0, '.', ',') !!} </span>
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

<div id="portfolio" class="our-portfolio section" style="padding: 0 !important">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">

					<h4><a href="{{ route('phim.filter') . '?genre=animation' }}">Top phim hoạt hình</a></h4>
					<div class="line-dec"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
		<div class="row">
			<div class="col-lg-12">
				<div class="loop owl-carousel">
					@foreach ($top_animation as $animation)
						<div class="item">
							<a href="{{ route('home.phim', [Str::slug($animation->name), $animation->film_id]) }}" title="{{ $animation->name_vi }}">
								<div class="portfolio-item">
									<div class="thumb">
										<img src="{!! $animation->img_big !!}" alt="{!! $animation->name_vi !!}" loading="lazy">
									</div>
									<div class="down-content">
										<h4>{!! $animation->name_vi !!}</h4>
										<span>${!! number_format($animation->worldwide, 0, '.', ',') !!} </span>
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
