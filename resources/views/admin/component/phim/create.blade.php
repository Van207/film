@include('admin.layout.header')
<div class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">
						<h4>Thêm phim</h4>
					</div>
				</div>
				<div class="card-body">
					<form action="" method="POST">
						@csrf
						<div class="mb-3">
							<label for="name" class="col-form-label">Tên gốc</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="name_vi" class="col-form-label">Tên phim Tiếng Việt</label>
							<input type="text" class="form-control" id="name_vi" name="name_vi" value="{{ old('name_vi') }}" required>
							@error('name_vi')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="image" class="col-form-label">Ảnh thumbnail</label>
							<input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}" required>
							@error('image')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="img_big" class="col-form-label">Ảnh thumbnail chất lượng cao</label>
							<input type="text" class="form-control" id="img_big" name="img_big" value="{{ old('img_big') }}" required>
							@error('img_big')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="summary" class="col-form-label">Tóm tắt</label>
							<textarea class="form-control" id="summary" name="summary" rows="3" required>{{ old('summary') }}</textarea>
							@error('summary')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="budget" class="col-form-label">Ngân sách</label>
							<input type="text" class="form-control" id="budget" name="budget" value="{{ old('budget') }}" required>
							@error('budget')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="mb-3">
							<label for="domestic" class="col-form-label">Doanh thu nội địa</label>
							<input type="text" class="form-control" id="domestic" name="domestic" value="{{ old('domestic') }}" required>
							@error('domestic')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="worldwide" class="col-form-label">Doanh thu thế giới</label>
							<input type="text" class="form-control" id="worldwide" name="worldwide" value="{{ old('worldwide') }}" required>
							@error('worldwide')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="international" class="col-form-label">Tổng doanh thu</label>
							<input type="text" class="form-control" id="international" name="international" value="{{ old('international') }}" required>
							@error('international')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="mb-3">
							<label for="year" class="col-form-label">Năm phát hành</label>
							<input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}" required>
							@error('year')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>

		</div>
	</div>



</div>
@include('admin.layout.footer')
