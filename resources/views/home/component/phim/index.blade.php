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
								<p><b>Năm sản xuất:</b> {{ $phim->year }}</p>

								@foreach ($details as $detail)
									@if ($detail->title == 'earliest release date')
										<p><b>Ngày phát hành:</b> {{ $detail->details }}</p>
									@endif
									@if ($detail->title == 'domestic distributor')
										<p><b>Nhà sản xuất:</b> {{ $detail->details }}</p>
									@endif
									@if ($detail->title == 'running time')
										<p><b>Thời lượng:</b> {{ $detail->details }}</p>
									@endif
									@if ($detail->title == 'mpaa')
										<p><b>MPAA:</b> {{ $detail->details }}</p>
									@endif

									@if ($detail->title == 'genres')
										<p><b>Thể loại</b></p>
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
								<p><b>Chi phí:</b> <span class="text-primary"> ${{ number_format($phim->budget, 0, '.', ',') }}</span></p>
								<div class="summary">
									<p><b>Summary</b></p>
									<span>{!! $phim->summary !!}</span>

								</div>
							</div>


						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12">
				<h3 class="text-center">Doanh thu ngày mở bán của {{ $phim->name_vi }}</h3>
				<div id="opening" style="width: 100%;height:400px;"></div>
			</div>

			<div class="col-md-12 my-4">
				<h3 class="text-center">Tổng doanh thu của {{ $phim->name_vi }} </h3>

				<div id="gross" style="width: 100%;height:400px;"></div>
			</div>
		</div>
	</div>

</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	opening()
	gross()

	function opening() {
		var chartDom = document.getElementById('opening');
		var myChart = echarts.init(chartDom);
		var option;

		let dataAxis = {!! json_encode($labels_opening) !!};
		let data = {!! json_encode($opening) !!};
		let yMax = {!! max($opening) !!};
		let dataShadow = [];
		for (let i = 0; i < data.length; i++) {
			dataShadow.push(yMax);
		}
		option = {
			title: {
				text: '{!! $lable_name_opening !!}',
				// subtext: 'Feature Sample: Gradient Color, Shadow, Click Zoom'
			},
			xAxis: {
				data: dataAxis,
				axisLabel: {
					inside: true,
					color: '#000'
				},
				axisTick: {
					show: false
				},
				axisLine: {
					show: false
				},
				z: 10
			},
			yAxis: {
				axisLine: {
					show: false
				},
				axisTick: {
					show: false
				},
				axisLabel: {
					color: '#999'
				}
			},
			dataZoom: [{
				type: 'inside'
			}],
			series: [{
				type: 'bar',
				showBackground: true,
				itemStyle: {
					color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
							offset: 0,
							color: '#83bff6'
						},
						{
							offset: 0.5,
							color: '#188df0'
						},
						{
							offset: 1,
							color: '#188df0'
						}
					])
				},
				emphasis: {
					itemStyle: {
						color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
								offset: 0,
								color: '#2378f7'
							},
							{
								offset: 0.7,
								color: '#2378f7'
							},
							{
								offset: 1,
								color: '#83bff6'
							}
						])
					}
				},
				data: data
			}]
		};
		// Enable data zoom when user click bar.
		const zoomSize = 2;
		myChart.on('click', function(params) {
			console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
			myChart.dispatchAction({
				type: 'dataZoom',
				startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
				endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
			});
		});

		option && myChart.setOption(option);

	}

	function gross() {
		var chartDom = document.getElementById('gross');
		var myChart = echarts.init(chartDom);
		var option;

		let dataAxis = {!! json_encode($labels_gross) !!};
		let data = {!! json_encode($gross) !!};
		let yMax = {!! max($gross) !!};
		let dataShadow = [];
		for (let i = 0; i < data.length; i++) {
			dataShadow.push(yMax);
		}
		option = {
			title: {
				text: '{!! $lable_name_gross !!}',
				// subtext: 'Feature Sample: Gradient Color, Shadow, Click Zoom'
			},
			xAxis: {
				data: dataAxis,
				axisLabel: {
					inside: true,
					color: '#000'
				},
				axisTick: {
					show: false
				},
				axisLine: {
					show: false
				},
				z: 10
			},
			yAxis: {
				axisLine: {
					show: false
				},
				axisTick: {
					show: false
				},
				axisLabel: {
					color: '#999'
				}
			},
			dataZoom: [{
				type: 'inside'
			}],
			series: [{
				type: 'bar',
				showBackground: true,
				itemStyle: {
					color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
							offset: 0,
							color: '#83bff6'
						},
						{
							offset: 0.5,
							color: '#188df0'
						},
						{
							offset: 1,
							color: '#188df0'
						}
					])
				},
				emphasis: {
					itemStyle: {
						color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
								offset: 0,
								color: '#2378f7'
							},
							{
								offset: 0.7,
								color: '#2378f7'
							},
							{
								offset: 1,
								color: '#83bff6'
							}
						])
					}
				},
				data: data
			}]
		};
		// Enable data zoom when user click bar.
		const zoomSize = 2;
		myChart.on('click', function(params) {
			console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
			myChart.dispatchAction({
				type: 'dataZoom',
				startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
				endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
			});
		});

		option && myChart.setOption(option);

	}
</script>
@include('home.layout.footer')
