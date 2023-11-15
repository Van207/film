<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Đăng nhập</title>

	<!-- Global stylesheets -->
	<link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src={{ asset('assets/js/app.js') }}></script>
	<!-- /theme JS files -->

</head>

<body class="bg-dark">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">



					<!-- Login card -->
					<form class="login-form" action="{{ route('post.login') }}" enctype="multipart/form-data" method="POST">
						@csrf
						@if (session('error'))
							<div class="alert alert-danger mb-1 mt-1">
								{{ session('error') }}
							</div>
						@endif
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
										<img src="../../../assets/images/logo_icon.svg" class="h-48px" alt="">
									</div>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Enter your credentials below</span>
								</div>

								<div class="mb-3">
									<label class="form-label">Username</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="email" class="form-control" placeholder="john@doe.com" name="email" value="admin@gmail.com">
										<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>

										@error('email')
											<p class="has-error">{{ $message }}</p>
										@enderror
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input type="password" class="form-control" placeholder="" name="password">
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
										@error('password')
											<p class="has-error">{{ $message }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="mb-3">
								<button type="submit" class="btn btn-primary w-100">Sign in</button>
							</div>

						</div>
				</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /inner content -->

	</div>
	<!-- /main content -->

	</div>
	<!-- /page content -->


</body>

</html>
