@include('home.layout.header')
<div class="film_wrapper section">
	<div class="container">
		<div class="row">


			<div class="col-md-12">
				<div class="card">
					<div class="card-header text-center">

						<h2>{{ $phim->name }}</h2>
						@if ($phim->name_vi != $phim->name)
							<h5>{{ $phim->name_vi }}</h5>
						@endif
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="text-center">
									<img src="{{ $phim->img_big }}" alt="{{ $phim->name }}" class="w-50">
								</div>
							</div>
							<div class="col-md-6 pt-2">
								<p><span class="fw-bold">Năm sản xuất:</span> {{ $phim->year }}</p>

								@foreach ($details as $detail)
									@if ($detail->title == 'earliest release date')
										<p><span class="fw-bold">Ngày phát hành:</span> {{ $detail->details }}</p>
									@endif
									@if ($detail->title == 'domestic distributor')
										<p><span class="fw-bold">Nhà sản xuất:</span> {{ $detail->details }}</p>
									@endif
									@if ($detail->title == 'running time')
										<p><span class="fw-bold">Thời lượng:</span> {{ $detail->details }}</p>
									@endif
									@if ($detail->title == 'mpaa')
										<p><span class="fw-bold">MPAA:</span> {{ $detail->details }}</p>
									@endif

									@if ($detail->title == 'genres')
										<p><span class="fw-bold">Thể loại</span></p>
										@php
											$cate_arr = explode(',', $detail->details);
											$cate_arr = array_filter($cate_arr, 'strlen');
										@endphp
										<div class="cate_wrapper mb-2 d-flex justify-content-start flex-wrap">
											@foreach ($cate_arr as $cate)
												<a href="" class="mb-1" style="margin-right: 5px"><span class="badge bg-primary p-2">{{ $cate }}</span></a>
											@endforeach
										</div>
									@endif
								@endforeach

								@if ($phim->budget)
									<p><span class="fw-bold">Chi phí:</span> <span class="text-primary"> ${{ number_format($phim->budget, 0, '.', ',') }}</span></p>
								@endif

								@if ($phim->domestic)
									<p><span class="fw-bold">Doanh thu trong nước:</span> <span class="text-primary"> ${{ number_format($phim->domestic, 0, '.', ',') }}</span></p>
								@else
									@php
										$phim->domestic = 0;
									@endphp
								@endif

								@php
									$allGross = 0;
									foreach ($gross as $g) {
									    $allGross = $allGross + intval($g);
									}
								@endphp

								<p><span class="fw-bold">Doanh thu quốc tế:</span> <span class="text-primary"> ${{ number_format($allGross, 0, '.', ',') }}</span></p>
								<p><span class="fw-bold">Tổng doanh thu:</span> <span class="text-primary"> ${{ number_format($phim->domestic + $allGross, 0, '.', ',') }}</span></p>

								<div class="summary">
									<p class="fw-bold">Tóm lược:</p>
									<span>{!! $phim->summary !!}</span>

								</div>
							</div>


						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12 my-4">
				<h3 class="text-center">Biểu đồ doanh thu thị trường quốc tế ngày mở bán của {{ $phim->name_vi }}</h3>
				<div id="opening" class="p-3 my-5" style="width: 100%;height:500px;"></div>
			</div>

			<div class="col-md-12 my-4">
				<h3 class="text-center">Biểu đồ tổng doanh thu thị trường quốc tế của {{ $phim->name_vi }} </h3>

				<div id="gross" class="p-3 my-5" style="width: 100%;height:500px;"></div>
			</div>
		</div>

		<div class="row">
			<h3 class="fw-bold">Các diễn viên tham gia</h3>
		</div>
	</div>

</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	pieChartOpening()
	pieChartGross()

	function pieChartOpening() {

		var chartDom = document.getElementById('opening');
		var myChart = echarts.init(chartDom);
		var option;


		var value_arr = {!! json_encode($opening) !!};
		var name_arr = {!! json_encode($labels_opening) !!};
		var data_arr = [];

		for (let i = 0; i < value_arr.length; i++) {
			data_arr.push({
				value: value_arr[i],
				name: name_arr[i]
			});
		}
		const data = genData();
		option = {
			title: {
				text: '',
				subtext: '',
				left: 'center'
			},
			tooltip: {
				trigger: 'item',
				formatter: function(params) {
					return `${params.seriesName} <br/><b>${params.name}</b>: <b class="text-danger">${params.value.toLocaleString('en-US', {style: 'currency', currency: 'USD'})}</b> (${params.percent}%)`;
				}


			},
			legend: {
				type: 'scroll',
				orient: 'vertical',
				right: 10,
				top: 20,
				bottom: 20,
				data: data.legendData
			},
			series: [{
				name: 'Country',
				type: 'pie',
				radius: '70%',
				center: ['40%', '50%'],
				data: data.seriesData,
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}]
		};

		function genData() {
			// prettier-ignore
			const nameList = {!! json_encode($labels_opening) !!};
			// const legendData = [];
			// const seriesData = [];
			legendData = nameList;
			seriesData = data_arr;
			return {
				legendData: legendData,
				seriesData: seriesData
			};

			function makeWord(max, min) {
				const nameLen = Math.ceil(Math.random() * max + min);
				const name = [];
				for (var i = 0; i < nameLen; i++) {
					name.push(nameList[Math.round(Math.random() * nameList.length - 1)]);
				}
				return name.join('');
			}
		}

		option && myChart.setOption(option);

	}

	function pieChartGross() {

		var chartDom = document.getElementById('gross');
		var myChart = echarts.init(chartDom);
		var option;


		var value_arr = {!! json_encode($gross) !!};
		var name_arr = {!! json_encode($labels_gross) !!};
		var data_arr = [];

		for (let i = 0; i < value_arr.length; i++) {
			data_arr.push({
				value: value_arr[i],
				name: name_arr[i]
			});
		}
		const data = genData();
		option = {
			title: {
				text: '',
				subtext: '',
				left: 'center'
			},
			tooltip: {
				trigger: 'item',
				formatter: function(params) {
					return `${params.seriesName} <br/><b>${params.name}</b>: <b class="text-danger">${params.value.toLocaleString('en-US', {style: 'currency', currency: 'USD'})}</b> (${params.percent}%)`;
				}


			},
			legend: {
				type: 'scroll',
				orient: 'vertical',
				right: 10,
				top: 20,
				bottom: 20,
				data: data.legendData
			},
			series: [{
				name: 'Country',
				type: 'pie',
				radius: '70%',
				center: ['40%', '50%'],
				data: data.seriesData,
				emphasis: {
					itemStyle: {
						shadowBlur: 10,
						shadowOffsetX: 0,
						shadowColor: 'rgba(0, 0, 0, 0.5)'
					}
				}
			}]
		};

		function genData() {
			// prettier-ignore
			const nameList = {!! json_encode($labels_gross) !!};
			// const legendData = [];
			// const seriesData = [];
			legendData = nameList;
			seriesData = data_arr;
			return {
				legendData: legendData,
				seriesData: seriesData
			};

			function makeWord(max, min) {
				const nameLen = Math.ceil(Math.random() * max + min);
				const name = [];
				for (var i = 0; i < nameLen; i++) {
					name.push(nameList[Math.round(Math.random() * nameList.length - 1)]);
				}
				return name.join('');
			}
		}

		option && myChart.setOption(option);

	}
</script>
@include('home.layout.footer')
