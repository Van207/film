@include('home.layout.header')

<div class="section">
	<div class="container">
		<div class="row" style="padding-top: 130px">
			<div class="col-md-12">
				<div class="card my-2">
					<div class="card-header m-0">
						<div class="card-title m-0">
							<h4 class="m-0">Lọc & Tìm kiếm</h4>
						</div>
					</div>

					<div class="card-body">
						<form action="{{ route('phim.filter') }}" method="GET">
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

								<div class="col-md-3 col-lg-3">
									<label for="name" class="col-form-label">Thể loại</label>
									<select class="form-select select filter" name="genre">
										<option value="0" {{ request('genre') == '' ? 'selected' : '' }}>Tất cả thể loại</option>
										<option value="Action" {{ request('genre') == 'Action' ? 'selected' : '' }}>Hành động</option>
										<option value="Romance" {{ request('genre') == 'Romance' ? 'selected' : '' }}>Lãng mạng</option>
										<option value="Animation" {{ request('genre') == 'Animation' ? 'selected' : '' }}>Hoạt hình</option>
										<option value="Adventure" {{ request('genre') == 'Adventure' ? 'selected' : '' }}>Phiêu lưu</option>
										<option value="Comedy" {{ request('genre') == 'Comedy' ? 'selected' : '' }}>Hài kịch</option>
										<option value="Fantasy" {{ request('genre') == 'Fantasy' ? 'selected' : '' }}>Viễn tưởng</option>
										<option value="Family" {{ request('genre') == 'Family' ? 'selected' : '' }}>Gia đình</option>
										<option value="History" {{ request('genre') == 'History' ? 'selected' : '' }}>Lịch sử</option>
										<option value="War" {{ request('genre') == 'War' ? 'selected' : '' }}>Chiến tranh</option>
										<option value="Sci-Fi" {{ request('genre') == 'Sci-Fi' ? 'selected' : '' }}>Khoa học viễn tưởng</option>
										<option value="Biography" {{ request('genre') == 'Biography' ? 'selected' : '' }}>Tiểu sử</option>
										<option value="Horror" {{ request('genre') == 'Horror' ? 'selected' : '' }}>Kinh dị</option>
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
				<div class="card mt-4">
					<div class="card-header">
						<div class="card-title m-0">
							<h4 class="m-0">Danh sách phim</h4>
						</div>
					</div>

					<div class="card-body">
						<div class="row">
							@if (count($films) > 0)
								@foreach ($films as $film)
									<div class="col-md-4 col-lg-3 col-6 my-2">
										<div class="card">
											<a href="{{ route('home.phim', [Str::slug($film->name), $film->id]) }}" target="_blank" title="{{ $film->name_vi }}" class="text-center">
												<img class="card-img-top img-thumbnail" src="{{ $film->img_big }}" alt="{{ $film->name_vi }}" loading="lazy">
											</a>

											<div class="card-body">
												<a class="card-title m-auto" href="{{ route('home.phim', [Str::slug($film->name), $film->id]) }}" target="_blank" title="{{ $film->name_vi }}">{{ $film->name_vi }} ({{ $film->year }})</a>
												<p class="card-text film-summary">{{ $film->summary }}</p>
											</div>
										</div>
									</div>
								@endforeach
								<div class="pagination_wrapper text-center mt-3 mb-2">
									{{ $films->links() }}

								</div>
							@else
								<div class="col-md-12 col-12">
									<div class="alert alert-danger text-center">Không có kết quả</div>
								</div>
							@endif

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.card-img-top {
		width: 200px !important;
		margin: 0 auto;
	}

	.card-title {
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		min-height: 50px;
		font-size: 18px
	}

	.film-summary {
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		min-height: 33px;
		font-size: 16px;
	}
</style>
@include('home.layout.footer')
