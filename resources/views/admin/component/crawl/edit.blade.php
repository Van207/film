@include('admin.layout.header')

<div class="content">

	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Chỉnh sửa thu thập</h5>
		</div>

		<div class="card-body">
			<form action="" method="POST">
				@csrf
				<div class="mb-4">
					<div class="row mb-3">
						<label class="col-form-label col-lg-2 fw-semibold">Tên quá trình</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="name" value="{{ $crawl->name }}">
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-2 fw-semibold">Url</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="url" value="{{ $crawl->url }}">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-2">
							<div class="mb-3">
								<p class="fw-semibold">Trạng thái</p>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="border p-3 rounded">
								<div class="form-check form-check-inline">
									<input type="radio" class="form-check-input" name="start" value="1" id="start1" {!! $crawl->start == 1 ? 'checked' : '' !!}>
									<label class="form-check-label" for="start1">Running</label>
								</div>

								<div class="form-check form-check-inline">
									<input type="radio" class="form-check-input" name="start" value="0" id="start0" {!! $crawl->start == 0 ? 'checked' : '' !!}>
									<label class="form-check-label" for="start0">Stopped</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-3">

						<label class="col-form-label col-lg-2 fw-semibold">Đặt lịch</label>
						<div class="col-lg-10">
							<select class="form-control select" name="schedule">
								<option value="">--------------</option>
								<option value="once a day" {!! $crawl->schedule == 'once a day' ? 'selected' : '' !!}>once a day</option>
								<option value="twice a day" {!! $crawl->schedule == 'twice a day' ? 'selected' : '' !!}>twice a day</option>
							</select>
						</div>
					</div>


					<div class="text-center">
						<button type="submit" class="btn btn-success px-4">Lưu</button>
						<a href="{{ route('crawl.index') }}" class="btn btn-warning">Hủy</a>
					</div>
				</div>
			</form>
		</div>

	</div>
	@include('admin.layout.footer')
