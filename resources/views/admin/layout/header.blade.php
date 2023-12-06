<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ $title }}</title>

	<!-- Global stylesheets -->
	<link href="<?= asset('assets/fonts/inter/inter.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= asset('assets/icons/phosphor/styles.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= asset('assets/icons/icomoon/styles.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?= asset('assets/css/all.min.css') ?> " id="stylesheet" rel="stylesheet" type="text/css">
	<link href="<?= asset('assets/css/custom.css') ?> " id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	{{-- <script src="asset('assets/demo/demo_configurator.js') "></script> --}}
	<script src="<?= asset('assets/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?= asset('assets/js/jquery/jquery.min.js') ?>"></script>
	<script src="<?= asset('assets/js/vendor/tables/datatables/datatables.min.js') ?>"></script>

	<script src="<?= asset('assets/js/vendor/uploaders/fileinput/fileinput.min.js') ?>"></script>
	<script src="<?= asset('assets/js/vendor/uploaders/fileinput/plugins/sortable.min.js') ?>"></script>
	<script src="<?= asset('assets/js/vendor/forms/selects/select2.min.js') ?>"></script>

	<!-- /theme JS files -->
	<script src="<?= asset('assets/js/app.js') ?>"></script>
	<script src="<?= asset('assets/demo/pages/datatables_basic.js') ?>"></script>
	<script src="<?= asset('assets/demo/pages/uploader_bootstrap.js') ?>"></script>
	<script src="<?= asset('assets/demo/pages/form_select2.js') ?>"></script>
	@stack('styles')
	@stack('scripts')
</head>

<body>
	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
		<div class="container-fluid">
			<div class="d-flex d-lg-none me-2">
				<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
					<i class="ph-list"></i>
				</button>
			</div>

			<div class="navbar-brand flex-1 flex-lg-0">
				<a href="{{ route('homepage') }}" class="d-inline-flex align-items-center">
					<img src="../../../assets/images/logo_icon.svg" alt="">
					<h3 class="d-none d-sm-inline-block h-16px ms-3 text-light">Quản trị</h3>
				</a>
			</div>

			<ul class="nav flex-row justify-content-end order-1 order-lg-2">


				<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
					<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
						<div class="status-indicator-container">
							@if (Auth::check() && isset(Auth::user()->avatar))
								<img src="{{ asset('/images/user') . '/' . Auth::user()->avatar }}" class="w-32px h-32px rounded-pill" alt="{{ Auth::user()->name }}">
							@else
								<img src="{{ asset('/images/user') . '/user_empty.png' }}" class="w-32px h-32px rounded-pill" alt="{{ Auth::user()->name }}">
							@endif

							<span class="status-indicator bg-success"></span>
						</div>
						<span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name }}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<a href="{{ route('user.profile', Auth::user()->id) }}" class="dropdown-item">
							<i class="ph-user-circle me-2"></i>
							Trang cá nhân
						</a>
						<div class="dropdown-divider"></div>
						<a href="{{ route('logout') }}" class="dropdown-item">
							<i class="ph-sign-out me-2"></i>
							Đăng xuất
						</a>

					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	<div class="page-content">
		@include('admin.layout.sidebar')
		<div class="content-wrapper">
			<div class="content-inner">
