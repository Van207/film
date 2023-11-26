@include('admin.layout.header')

<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{!! session('msg') !!}
		</div>
	@endif

	@if (session('err'))
		<div class="alert alert-danger">
			{!! session('err') !!}
		</div>
	@endif
	<div class="mb-3">
		<h4 class="mb-0">Quản lý thu thập</h4>
	</div>

	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Danh sách tiến trình thu thập</h5>
		</div>

		<div class="card-body">
			<a href="" class="btn btn-success">Thêm tiến trình</a>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Tiến trình</th>
						<th>Trạng thái</th>
						<th>Năm</th>
						<th>Đặt lịch</th>
						<th>Run now</th>
						<th>Tùy chọn</th>
					</tr>
				</thead>
				<tbody>
					@if (count($crawl) > 0)
						@foreach ($crawl as $c)
							<tr>
								<td>{{ $c->id }}</td>
								<td>{{ $c->name }}</td>
								<td>
									@if ($c->start === 1)
										<span class="bg-primary badge">Running</span>
									@else
										<span class="bg-danger badge">Stopped</span>
									@endif

								</td>
								<td>{{ $c->year }}</td>

								<td>{{ $c->schedule }}</td>
								<td>
									<a href="{{ route('run', $c->unique_name) }}">Click</a>
								</td>
								<td>
									<a href="{{ route('crawl.edit', $c->id) }}" class="btn btn-primary btn-icon">
										<i class="ph-pencil-simple"></i>
									</a>
									<a href="{{ route('crawl.edit', $c->id) }}" class="btn btn-danger btn-icon">
										<i class="ph-trash"></i>
									</a>
								</td>
							</tr>
						@endforeach
					@else
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('admin.layout.footer')
