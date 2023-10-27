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
								<input type="text" class="form-control" name="name" value="{{ $cate->name }}">
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-form-label col-lg-3">Mô tả</label>
							<div class="col-lg-9">
								<textarea rows="3" cols="3" class="form-control" name="description">{{ $cate->description }}</textarea>
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
@include('admin.layout.footer')
