@push('scripts')
	<script src="<?= asset('assets/js/vendor/tables/datatables/datatables.min.js') ?>"></script>
@endpush
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
				<div class="card-header">
					<div class="cart-title">
						<h2>Biến động doanh thu</h2>
					</div>
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs mb-3 nav-tabs-highlight" role="tablist">
						<li class="nav-item" role="presentation">
							<a href="#js-tab1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab" tabindex="-1">
								Theo ngày
							</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="#js-tab2" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">
								Theo tuần
							</a>
						</li>

						<li class="nav-item" role="presentation">
							<a href="#js-tab3" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">
								Theo tháng
							</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="#js-tab4" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab">
								Theo năm
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade active show" id="js-tab1" role="tabpanel">
							<h5 class="text-center text-pink">Doanh thu phim theo ngày</h5>
							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>STT</th>
										<th>Phim</th>
										<th>Doanh thu</th>
										<th>Ngày</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><a href="#" title="Xem chi tiết">The Hunger Games: The Ballad of Songbirds & Snakes (2023)</a></td>
										<td>$199</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
									<tr>
										<td>2</td>
										<td><a href="#" title="Xem chi tiết">Godzilla</a></td>
										<td>$789</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
									<tr>
										<td>3</td>
										<td><a href="#" title="Xem chi tiết">Napoleon (2023)</a></td>
										<td>$656</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
									<tr>
										<td>4</td>
										<td><a href="#" title="Xem chi tiết">Animal (2023)</a></td>
										<td>$774</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
									<tr>
										<td>5</td>
										<td><a href="#" title="Xem chi tiết">Wish (2023)</a></td>
										<td>$221</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
									<tr>
										<td>6</td>
										<td><a href="#" title="Xem chi tiết">Trolls Band Together (2023)</a></td>
										<td>$278</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="tab-pane fade" id="js-tab2" role="tabpanel">
							<h5 class="text-center text-success">Doanh thu phim theo tuần</h5>

							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>STT</th>
										<th>Phim</th>
										<th>Doanh thu</th>
										<th>Tuần</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><a href="#" title="Xem chi tiết">Tên phim 1</a></td>
										<td>$199</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="js-tab3" role="tabpanel">
							<h5 class="text-center text-primary">Doanh thu phim theo tháng</h5>

							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>STT</th>
										<th>Phim</th>
										<th>Doanh thu</th>
										<th>Tháng</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><a href="#" title="Xem chi tiết">Tên phim 1</a></td>
										<td>$199</td>
										<td>{{ date('d/m/Y', strtotime(now())) }}</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="tab-pane fade" id="js-tab4" role="tabpanel">
							<h5 class="text-center text-warning">Doanh thu phim theo năm</h5>

							<table class="table datatable-basic">
								<thead>
									<tr>
										<th>STT</th>
										<th>Phim</th>
										<th>Doanh thu</th>
										<th>Năm</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><a href="#" title="Xem chi tiết">Tên phim 1</a></td>
										<td>$199</td>
										<td>{{ date('Y', strtotime(now())) }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('admin.layout.footer')
<script>
	$('.datatable-basic').DataTable({
		autoWidth: false,
		dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
		language: {
			search: '<span class="me-3">Tìm kiếm:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
			searchPlaceholder: 'Nhập tên...',
			lengthMenu: '<span class="me-3">Show:</span> _MENU_',
			paginate: {
				'first': 'First',
				'last': 'Last',
				'next': document.dir == "rtl" ? '←' : '→',
				'previous': document.dir == "rtl" ? '→' : '←'
			}
		}
	});
</script>
