@include('admin.layout.header')
<div class="content">
	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif
	@if (session('false'))
		<div class="alert alert-danger">
			{{ session('false') }}
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
					<form action="{{ route('film.filter') }}" method="GET">
						<div class="row align-items-end">

							<div class="col-md-3 col-lg-3">
								<label for="name" class="col-form-label">Tên phim</label>
								<input type="text" name="name" class="form-control filter" value="{{ request('name') }}">
							</div>

							<div class="col-md-3 col-lg-3">
								<label for="name" class="col-form-label">Năm phát hành</label>
								<select class="form-select select filter" name="year">
									<option value="0" {{ request('year') == 0 ? 'selected' : '' }}>Tất cả năm</option>
									@for ($i = date('Y'); $i >= 2010; $i--)
										<option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
									@endfor
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
					<div class="card-title m-0">
						<h4 class="m-0">Danh sách phim</h4>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>id</th>
								<th>Tên phim</th>
								<th>Hình ảnh</th>
								<th>Tùy chọn</th>
							</tr>
						</thead>
						<tbody>
							@if (count($films) > 0)
								@foreach ($films as $film)
									<tr>
										<td>{{ $film->id }}</td>
										<td><a href="{{ route('film.detail', $film->id) }}" title="Xem chi tiết">{{ $film->name }}</a></td>
										<td>
											@if ($film->image != '')
												<img src="{{ $film->image }}" alt="{{ $film->name }}">
											@else
											@endif
										</td>
										<td>
											<a href="#" class="btn btn-danger">Xóaaaaa</a>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="6">
										<div class="alert alert-danger">Chưa có dữ liệu</div>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
					<div class="pagination_wrapper text-center mt-3 mb-2">{{ $films->links() }}</div>
				</div>
			</div>
		</div>
	</div>

</div>
@include('admin.layout.footer')

<style>
	.card-img-top {
		width: 150px !important;
		margin: 0 auto;
	}

	.card-title {
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		min-height: 56px;
	}

	.film-summary {
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		min-height: 66px;
	}
</style>

<script>
	// Gửi yêu cầu Ajax khi giá trị của dropdown thay đổi
	// $('.filter').on('change', function() {
	// 	// Lấy giá trị của các dropdown
	// 	var name = $('input[name="name"]').val();
	// 	var year = $('select[name="year"]').val();

	// 	// Gửi yêu cầu Ajax đến route 'filter-data' trong Laravel
	// 	$.ajax({
	// 		url: 'phim/filter',
	// 		type: 'GET',
	// 		data: {
	// 			name: name,
	// 			year: year,
	// 		},
	// 		beforeSend: function() {
	// 			// $('.loading-overlay').show();
	// 		},
	// 		success: function(data) {
	// 			film = data.data
	// 			console.log(film);
	// 			$('.film_wrapper').html('');
	// 			if (film.length > 0) {
	// 				console.log(data);
	// 				film.forEach(function(film) {
	// 					$('.film_wrapper').append(`
	// 						<div class="col-md-4 col-lg-3 col-6">
	// 							<div class="card">
	// 								<img class="card-img-top img-thumbnail" src="${film.image}" alt="${film.name_vi}">
	// 								<div class="card-body">
	// 									<h5 class="card-title">${film.name_vi} (${film.year})</h5>
	// 									<p class="card-text film-summary">${film.summary}</p>
	// 									<a href="phim/detail/${film.id}" class="btn btn-primary">Chi tiết</a>
	// 								</div>
	// 							</div>
	// 						</div>
	// 						`)
	// 				})
	// 			}

	// 			// Xử lý phân trang tiếp tục
	// 		},
	// 		error: function(xhr) {
	// 			// Xử lý lỗi nếu có
	// 		}
	// 	});
	// });
</script>
