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
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h5>Thêm danh mục</h5>
				</div>
				<div class="card-body">
					<form action="" method="post">
						@csrf
						<div class="row mb-3">
							<label class="col-form-label col-lg-3">Tên danh mục</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="name" id="name">
								@error('name')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<span>Đường dẫn:</span>
							<span id="slug_text" class="text-pink"></span>

							<div class="col-lg-12">
								<input type="text" class="form-control d-none" name="slug" id="slug" value="">
								@error('slug')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-3">Mô tả</label>
							<div class="col-lg-9">
								<textarea rows="3" cols="3" class="form-control" name="description"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 text-center">
								<input type="submit" value="Thêm danh mục" class="btn btn-info">
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Danh mục</h5>
				</div>

				<div class="table-responsive">
					<table class="table border table-responsive table-hover">
						<thead>
							<tr>
								<th>id</th>
								<th>Tên danh mục</th>
								<th>Mô tả</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if (count($cate) > 0)
								@foreach ($cate as $item)
									<tr>
										<td>{{ $item->id }}</td>
										<td><a href="{{ route('category.edit', $item->id) }}">{{ $item->name }}</a></td>
										<td>{{ $item->description }}</td>
										<td><a href="{{ route('category.delete', $item->id) }}" class="text-danger p-2"><i class="ph-trash"></i></a></td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3">
										<p class="text-danger text-center">Không có danh mục</p>
									</td>
								</tr>
							@endif

						</tbody>
					</table>
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
