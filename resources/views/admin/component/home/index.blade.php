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
						<a class="text-muted" href="{{ route('film.index') }}">Tổng số Phim</a>
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
						<span class="text-muted">Tổng người dùng</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="d-flex align-items-center">
					<div class="flex-fill">
						<h4 class="mb-0">54,390</h4>
						<span class="text-muted">total comments</span>
					</div>

					<i class="ph-chats ph-2x text-primary ms-3"></i>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="d-flex align-items-center">
					<div class="flex-fill">
						<h4 class="mb-0">389,438</h4>
						<span class="text-muted">total orders</span>
					</div>

					<i class="ph-package ph-2x text-danger ms-3"></i>
				</div>
			</div>
		</div>
	</div>

</div>
@include('admin.layout.footer')
