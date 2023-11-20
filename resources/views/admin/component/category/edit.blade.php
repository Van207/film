@include('admin.layout.header')
<div class="content">


	<div class="row">
		<div class="col-md-6 m-auto">
			<div class="card">
				<div class="card-header">
					<h5>Cập nhật danh mục</h5>
				</div>
				<div class="card-body">
					<form action="" method="post">
						@csrf
						<div class="row mb-3">
							<label class="col-form-label col-lg-3">Tên danh mục</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="name" id="name" value="{{ $cate->name }}">
								@error('name')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<span>Đường dẫn:</span>
							<span id="slug_text" class="text-pink">{{ $cate->slug }}</span>

							<div class="col-lg-12">
								<input type="text" class="form-control d-none" name="slug" id="slug" value="{{ $cate->slug }}">
								@error('slug')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-3">Mô tả</label>
							<div class="col-lg-9">
								<textarea rows="3" cols="3" class="form-control" name="description">{{ $cate->description }}</textarea>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-form-label col-lg-3">Hiển thị trên menu</label>
							<div class="border p-3 rounded col-lg-9">
								<div class="form-check form-check-inline">
									<input type="radio" class="form-check-input" name="display_menu" id="yes_display" {{ $cate->display_menu == 1 ? 'checked' : '' }} value="1">
									<label class="form-check-label" for="yes_display">Có</label>
								</div>

								<div class="form-check form-check-inline">
									<input type="radio" class="form-check-input" name="display_menu" id="no_display" value="0" {{ $cate->display_menu == 0 ? 'checked' : '' }}>
									<label class="form-check-label" for="no_display">Không</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 text-center">
								<input type="submit" value="Cập nhật" class="btn btn-primary">
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>

	</div>

</div>
<script>
	$(document).ready(function() {
		$('#name').on('input', function() {
			var name = $(this).val();
			var slug = slugify(name);
			$('#slug').val(slug);
			$('#slug_text').text(slug);
		});

		// Hàm slugify để tạo slug từ chuỗi
		function slugify(input) {
			if (!input)
				return '';

			// make lower case and trim
			var slug = input.toLowerCase().trim();

			// remove accents from charaters
			slug = slug.normalize('NFD').replace(/[\u0300-\u036f]/g, '')

			// replace invalid chars with spaces
			slug = slug.replace(/[^a-z0-9\s-]/g, ' ').trim();

			// replace multiple spaces or hyphens with a single hyphen
			slug = slug.replace(/[\s-]+/g, '-');

			return slug;
		}
	});
</script>
@include('admin.layout.footer')
