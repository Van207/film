<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">


	<link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}" type="image/x-icon">

	<title>{!! isset($title) ? $title : 'Không có nội dung cần tìm' !!}</title>

	<!-- Bootstrap core CSS -->
	<link href="<?= asset('home/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">


	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="<?= asset('home/assets/css/fontawesome.css') ?>">
	<link rel="stylesheet" href="<?= asset('home/assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= asset('home/assets/css/animated.css') ?>">
	<link rel="stylesheet" href="<?= asset('home/assets/css/owl.css') ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	{{-- SELECT 2 --}}
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<meta property="og:title" content="Phân Tích Doanh Thu Phim | Nguyễn Thế Văn">
	<meta property="og:description" content="Dữ liệu thông minh, giao diện thân thiện - hãy bắt đầu hành trình ngay hôm nay">
	<meta property="og:image" content="{{ asset('images/film_avatar.png') }}">
	@stack('css')
	@stack('scripts')
</head>

<body>

	<!-- ***** Preloader Start ***** -->
	<div id="js-preloader" class="js-preloader">
		<div class="preloader-inner">
			<span class="dot"></span>
			<div class="dots">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- ***** Preloader End ***** -->

	<!-- Pre-header Starts -->
	{{-- <div class="pre-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-sm-8 col-7">
					<ul class="info">
						<li><a href="#"><i class="fa fa-envelope"></i>digimedia@company.com</a></li>
						<li><a href="#"><i class="fa fa-phone"></i>010-020-0340</a></li>
					</ul>
				</div>
				<div class="col-lg-4 col-sm-4 col-5">
					<ul class="social-media">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-behance"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div> --}}
	<!-- Pre-header End -->

	<!-- ***** Header Area Start ***** -->
	<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="main-nav">
						<!-- ***** Logo Start ***** -->
						<a href="{{ route('home.index') }}" class="logo">
							<img src="{{ asset('images/favicon.jpg') }}" alt="Phân Tích Doanh Thu Phim">
						</a>
						<!-- ***** Logo End ***** -->

						<!-- ***** Menu Start ***** -->
						<ul class="nav">
							<li class="scroll-to-section">
								<a href="{{ route('home.index') }}" class="{{ request()->routeIs('home.index') ? 'active' : '' }}">Home</a>
							</li>
							<li class="scroll-to-section">
								<a href="{{ route('phim.index') }}" class="{{ request()->routeIs('phim.index') || request()->routeIs('phim.filter') ? 'active' : '' }}">Tất cả phim</a>
							</li>
							<li class="scroll-to-section">
								<a href="{{ route('phim.sosanh') }}" class="{{ request()->routeIs('phim.sosanh') ? 'active' : '' }}">So sánh phim</a>
							</li>
							@php
								$categories = DB::table('category')
								    ->where('display_menu', '1')
								    ->get();
							@endphp
							@foreach ($categories as $cate)
								<li class="scroll-to-section">
									<a href="{{ route('home.category', $cate->slug) }}" class="{{ Request::is("danh-muc/$cate->slug") ? 'active' : '' }}">{{ $cate->name }}</a>
								</li>
							@endforeach
							<li class="scroll-to-section">
								{{-- <div class="border-first-button"><a href="#contact">Đăng ký</a></div> --}}
							</li>
						</ul>
						<a class='menu-trigger'>
							<span>Menu</span>
						</a>
						<!-- ***** Menu End ***** -->
					</nav>

				</div>
			</div>
		</div>
	</header>
	<!-- ***** Header Area End ***** -->

	{{-- <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 align-self-center">
							<div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
								<div class="row">
									<div class="col-lg-12">
										<h6>Film Analyst</h6>
										<h2>Trang Web Phân Tích Doanh Thu Độc Đáo</h2>
										<p>Kho Dữ Liệu Chi Tiết Về Sự Thành Công Trên Màn Ảnh</p>
									</div>
									<div class="col-lg-12">
										<div class="border-first-button scroll-to-section">
											<a href="#contact">Free Quote</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
								<img src="<?= asset('home/assets/images/slider-dec-v2.png') ?>" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
