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
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="d-flex align-items-center">
					<i class="ph-newspaper ph-2x text-primary me-3"></i>
					<div class="flex-fill text-end">
						<h4 class="mb-0">{{ $schedule_count }}</h4>
						<a href="{{ route('crawl.index') }}" class="text-primary" title="Quản lý thu thập dữ liệu">Thu thập hoạt động</a>
					</div>
				</div>
			</div>
		</div>

	</div>


	@if (count($schedule_log) > 0)
		<div class="row">
			<div class="col-md-10 col-lg-10 col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-tile">Nhật ký tổng hợp</h3>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Thời gian</th>
									<th>Nội dung</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($schedule_log as $log)
									<tr>
										<td>{!! $log->id !!}</td>
										<td>{{ date('h:i:s d/m/Y', strtotime($log->time)) }}</td>
										<td>{!! $log->text !!}</td>

									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	@endif

</div>
@include('admin.layout.footer')
