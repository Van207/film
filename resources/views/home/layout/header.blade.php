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

	<title>{!! $title !!}</title>

	<!-- Bootstrap core CSS -->
	<link href="<?= asset('home/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">


	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="<?= asset('home/assets/css/fontawesome.css') ?>">
	<link rel="stylesheet" href="<?= asset('home/assets/css/style.css') ?>">
	<link rel="stylesheet" href="<?= asset('home/assets/css/animated.css') ?>">
	<link rel="stylesheet" href="<?= asset('home/assets/css/owl.css') ?>">
	<!--

TemplateMo 568 DigiMedia

https://templatemo.com/tm-568-digimedia

-->
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
						<a href="index.html" class="logo">
							<img src="assets/images/logo-v2.png" alt="">
						</a>
						<!-- ***** Logo End ***** -->
						<!-- ***** Menu Start ***** -->
						<ul class="nav">
							<li class="scroll-to-section"><a href="{{ route('home.index') }}" class="active">Home</a></li>
							<li class="scroll-to-section"><a href="#about">Tất cả phim</a></li>
							<li class="scroll-to-section"><a href="#services">Review Phim</a></li>
							<li class="scroll-to-section"><a href="#portfolio">Chê Phim</a></li>
							<li class="scroll-to-section"><a href="#blog">Blog</a></li>
							<li class="scroll-to-section"><a href="#contact">Contact</a></li>
							<li class="scroll-to-section">
								<div class="border-first-button"><a href="#contact">Đăng ký</a></div>
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
