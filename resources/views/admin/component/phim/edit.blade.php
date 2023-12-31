@include('admin.layout.header')
<div class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title text-center">
						<h4>Sửa phim</h4>
					</div>
				</div>
				<div class="card-body">
					<form action="" method="POST">
						@csrf
						<div class="mb-3">
							<label for="name" class="col-form-label">Tên gốc</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ $phim->name }}" required>
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="name_vi" class="col-form-label">Tên phim Tiếng Việt</label>
							<input type="text" class="form-control" id="name_vi" name="name_vi" value="{{ $phim->name_vi }}" required>
							@error('name_vi')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="image" class="col-form-label">Ảnh thumbnail</label>
							<input type="text" class="form-control" id="image" name="image" value="{{ $phim->image }}" required>
							@error('image')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="img_big" class="col-form-label">Ảnh thumbnail chất lượng cao</label>
							<input type="text" class="form-control" id="img_big" name="img_big" value="{{ $phim->img_big }}" required>
							@error('img_big')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="summary" class="col-form-label">Tóm tắt</label>
							<textarea class="form-control" id="summary" name="summary" rows="3" required>{{ $phim->summary }}</textarea>
							@error('summary')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="budget" class="col-form-label">Ngân sách</label>
							<input type="text" class="form-control" id="budget" name="budget" value="{{ $phim->budget }}" required>
							@error('budget')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="mb-3">
							<label for="domestic" class="col-form-label">Doanh thu nội địa</label>
							<input type="text" class="form-control" id="domestic" name="domestic" value="{{ $phim->domestic }}" required>
							@error('domestic')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="worldwide" class="col-form-label">Doanh thu thế giới</label>
							<input type="text" class="form-control" id="worldwide" name="worldwide" value="{{ $phim->worldwide }}" required>
							@error('worldwide')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="mb-3">
							<label for="international" class="col-form-label">Tổng doanh thu</label>
							<input type="text" class="form-control" id="international" name="international" value="{{ $phim->international }}" required>
							@error('international')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="mb-3">
							<label for="year" class="col-form-label">Năm phát hành</label>
							<input type="text" class="form-control" id="year" name="year" value="{{ $phim->year }}" required>
							@error('year')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<button type="submit" class="btn btn-success">Submit</button>
						<a href="{{ route('film.index') }}" class="btn btn-primary">Quay lại</a>
					</form>
				</div>
			</div>

		</div>
	</div>



</div>
@include('admin.layout.footer')
