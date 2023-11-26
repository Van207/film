@include('admin.layout.header')

<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif

	@if (session('err'))
		<div class="alert alert-danger">
			{{ session('err') }}
		</div>
	@endif
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Kho dữ liệu thu thập</h5>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Tên phim</th>
						<th>Hình ảnh</th>
						<th>Public now</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					@if (count($film_store) > 0)
						@foreach ($film_store as $f)
							<tr>
								<td>{{ $f->id }}</td>
								<td><a href="{{ route('crawl.view', $f->id) }}" title="Xem chi tiết">{{ $f->name }}</a></td>
								<td>
									@if ($f->image != '')
										<img src="{{ $f->image }}" alt="{{ $f->name }}">
									@else
									@endif

								</td>

								<td></td>
								<td>
									@if ($f->status == 6)
										<div class="badge bg-success p-1">Full</div>
									@else
										<div class="badge bg-warning p-1">Not yet</div>
									@endif
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6">
								<div class="alert alert-danger">Chưa có dữ liệu thu thập</div>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
			<div class="pagination_wrapper text-center mt-3 mb-2">{{ $film_store->links() }}</div>
		</div>
	</div>
</div>
@include('admin.layout.footer')
