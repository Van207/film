@include('admin.layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif
	<div class="mb-3">
		<h6 class="mb-0">Thống kê nhanh</h6>
		<span class="text-muted"></span>
	</div>
	<div class="row">
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="d-flex align-items-center">
					<i class="ph-video-camera ph-2x text-success me-3"></i>

					<div class="flex-fill text-end">
						<h4 class="mb-0">{{ $phim_count }}</h4>
						<a class="text-success" href="{{ route('film.index') }}" title="Quản lý phim">Tổng số Phim</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="d-flex align-items-center">
					<i class="ph-users ph-2x text-indigo me-3"></i>
					<div class="flex-fill text-end">
						<h4 class="mb-0">{{ $user_count }}</h4>
						<a href="{{ route('user.index') }}" class="text-indigo" title="Quản lý tài khoản">Tổng người dùng</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="d-flex align-items-center">
					<i class="ph-newspaper ph-2x text-pink me-3"></i>
					<div class="flex-fill text-end">
						<h4 class="mb-0">{{ $post_count }}</h4>
						<a href="{{ route('post.index') }}" class="text-pink" title="Quản lý bài viết">Bài viết</a>
					</div>
				</div>
			</div>
		</div>

	
	</div>

</div>
@include('admin.layout.footer')
