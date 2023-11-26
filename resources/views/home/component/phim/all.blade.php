@include('home.layout.header')

<div class="section">
	<div class="container">
		<div class="row" style="padding-top: 130px">

			<div class="col-md-12">
				<div class="card my-2">
					<div class="card-header m-0 bg-white">
						<div class="card-title m-0 text-center">
							<h3 class="m-0 fw-bold h3">Lọc & Tìm kiếm</h3>
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
										@php
											$list_year = DB::table('films')
											    ->distinct()
											    ->pluck('year');
										@endphp
										@foreach ($list_year as $year)
											<option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
										@endforeach
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

								<div class="col-md-3 col-lg-3 pb-2 text-center pt-4">
									<button class="btn btn-success m-auto">Lọc phim</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



		{{-- Hiển thị biểu đồ khi chọn year --}}
		@if (request('year') && request('year') != '')
			@if (count($film_name) && count($film_data) > 0)
				<div class="col-md-12 col-12">
					<h2 class="fw-bold">Các phim có doanh thu lớn nhất {{ request('year') }}</h2>

					<div id="chart" style="width: 100%;height:400px;"></div>
				</div>
			@endif
		@endif

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
@if (request('year') && request('year') != '')
	@if (count($film_name) && count($film_data) > 0)
		<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<script type="text/javascript">
			var chartDom = document.getElementById('chart');
			var myChart = echarts.init(chartDom);
			var option;

			option = {
				tooltip: {
					trigger: 'axis',
					axisPointer: {
						type: 'shadow'
					}
				},
				xAxis: {
					type: 'category',
					data: {!! json_encode($film_name) !!}
				},
				yAxis: {
					type: 'value'
				},
				series: [{
					name: 'Doanh thu',
					data: {!! json_encode($film_data) !!},
					type: 'bar'
				}]
			};

			option && myChart.setOption(option);
			window.addEventListener('resize', function() {
				myChart.resize();
			})
		</script>
	@endif
@endif

@include('home.layout.footer')
