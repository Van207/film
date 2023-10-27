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
				<div class="card-header text-center">

					<h2>{{ $film->name }}</h2>
					@if ($film->name_vi != $film->name)
						<h5>{{ $film->name_vi }}</h5>
					@endif
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="text-center">
								<img src="{{ $film->img_big }}" alt="{{ $film->name }}" class="w-50">
							</div>
						</div>
						<div class="col-md-6 pt-2">
							<p><b>Năm sản xuất:</b> {{ $film->year }}</p>
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
											<a href="" class="mb-1" style="margin-right: 5px"><span class="badge bg-info p-2">{{ $cate }}</span></a>
										@endforeach
									</div>
								@endif
							@endforeach
							<p><b>Chi phí:</b> <span class="text-secondary ">{{ $film->budget }}</span></p>
							<div class="summary">
								<p><b>Summary</b></p>
								<span>{!! $film->summary !!}</span>

							</div>
						</div>


					</div>

				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h2>Doanh thu</h2>
				</div>
				<div class="card-body">
					<table class="datatable-basic table table-bordered table-hover ">
						<thead>
							<tr>
								<th>STT</th>
								<th>Quốc gia</th>
								<th>Thời gian</th>
								<th>Doanh thu mở bán</th>
								<th>Tổng doanh thu</th>
							</tr>
						</thead>
						<tbody>
							@php
								$stt = 1;
							@endphp
							@foreach ($revenues as $rvn)
								<tr>
									<td>{{ $stt++ }}</td>
									<td>{!! $rvn->country !!}</td>
									<td>{{ date('d/m/Y', strtotime($rvn->release_date)) }}</td>
									<td>{{ $rvn->opening }}</td>
									<td>{{ $rvn->gross }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h2>Diễn viên</h2>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach ($casts as $cast)
							<div class="col-lg-4 col-md-6">
								<div class="mb-4">
									<div class="rounded">
										<div class="list-group list-group-borderless py-2">
											<div class="list-group-item d-flex align-items-center">
												<p href="#" class="d-block me-3">
													@if ($cast->avatar != '')
														<img src="{!! $cast->avatar !!}" class="rounded-circle" width="100%" height="" alt="{!! $cast->name !!}">
													@else
														<img src="{{ asset('/images/user/cast-empty.png') }}" class="rounded-circle" width="140" height="" alt="{!! $cast->name !!}">
													@endif
												</p>

												<div class="flex-fill">
													<div class="fw-semibold">{!! $cast->name !!}</div>
													<p>{!! $cast->role !!}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
@include('admin.layout.footer')
