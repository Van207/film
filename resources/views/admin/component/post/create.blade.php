@push('styles')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js" integrity="sha512-OF6VwfoBrM/wE3gt0I/lTh1ElROdq3etwAquhEm2YI45Um4ird+0ZFX1IwuBDBRufdXBuYoBb0mqXrmUA2VnOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@include('admin.layout.header')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Tạo bài viết</h5>
				</div>

				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row mb-3">
							<label class="col-form-label">Tiêu đề</label>
							<div class="col-lg-12">
								<input type="text" class="form-control" name="title">
							</div>
						</div>


						<div class="row mb-3">
							<label class="col-form-label">Nội dung</label>
							<div class="col-lg-12">
								<textarea name="content"></textarea>
								<script>
									CKEDITOR.replace('content');
								</script>
							</div>
						</div>

						<div class="mb-3 row">
							<label class="col-form-label">Danh mục</label>
							<div class="col-lg-12">
								<select class="form-control select" name="category_id">
									@foreach ($cate as $item)
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="mb-3 row">
							<label class="col-form-label">Thumbnail</label>
							<div class="col-lg-12">
								<!-- AJAX upload -->
								<div class="card">
									<div class="card-body">
										<input type="file" name="thumbnail" class="file-input file-input-ajax" multiple="false">
									</div>
								</div>
								<!-- /AJAX upload -->

							</div>
						</div>
						<div class="mb-3 row">
							<div class="col-lg-6">
								<div class="mb-3">
									<p class="fw-semibold">Trạng thái</p>
									<div class="border p-3 rounded">
										<div class="d-inline-flex align-items-center me-3">
											<input type="radio" name="status" id="status" checked="" value="Public">
											<label class="ms-2" for="status">Public</label>
										</div>

										<div class="d-inline-flex align-items-center">
											<input type="radio" name="status" id="status" value="Draft">
											<label class="ms-2" for="status">Draft</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<input type="submit" value="Tạo bài viết" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>
@include('admin.layout.footer')
