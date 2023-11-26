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

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header m-0">
					<div class="card-title m-0">
						<h4 class="m-0">Lọc & Tìm kiếm</h4>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('crawl.filter') }}" method="GET">
						<div class="row align-items-end">

							<div class="col-md-3 col-lg-3">
								<label for="name" class="col-form-label">Tên phim</label>
								<input type="text" name="name" class="form-control filter" value="{{ request('name') }}">
							</div>

							<div class="col-md-3 col-lg-3">
								<label for="name" class="col-form-label">Năm phát hành</label>
								<select class="form-select select filter" name="year">
									<option value="0" {{ request('year') == 0 ? 'selected' : '' }}>Tất cả năm</option>
									@php
										$list_year = DB::table('film_store')
										    ->distinct()
										    ->pluck('year');
									@endphp
									@foreach ($list_year as $year)
										<option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
									@endforeach

								</select>
							</div>

							<div class="col-md-3 col-lg-3">
								<label for="name" class="col-form-label">Trạng thái public</label>
								<select class="form-select select filter" name="public">
									<option value="" selected>-----</option>
									<option value="0" {{ request('public') == 0 ? 'selected' : '' }}>Chưa public</option>
									<option value="1" {{ request('public') == 1 ? 'selected' : '' }}>Đã public</option>
								</select>
							</div>
							<div class="col-md-3 col-lg-3 pb-1">
								<button class="btn btn-success m-auto">Lọc phim</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
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
								<th>Public</th>
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

										<td>
											@if ($f->status == 6 && $f->public == 0)
												<a href="{{ route('crawl.public', $f->id) }}" class="btn btn-flat-primary rounded-pill">Public</a>
											@endif
										</td>
										<td>
											@if ($f->status == 6)
												<div class="badge bg-success p-1">Full</div>
											@else
												<div class="badge bg-warning p-1">Not yet</div>
											@endif
										</td>
										<td>
											@if ($f->public == 1)
												<div class="badge bg-primary p-1">Đã public</div>
											@else
												<div class="badge bg-danger p-1">Chưa public</div>
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
	</div>

</div>
@include('admin.layout.footer')
