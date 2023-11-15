@include('admin.layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif

	<div class="mb-3 pt-2">
		<h5 class="mb-2">Thêm tài khoản Admin</h5>
	</div>

	<div class="row">
		<div class="container rounded bg-white mt-2 mb-5">
			<div class="row">

				<div class="col-md-9 border-right m-auto">
					<form action="" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="p-3">
							<div class="row mt-3">
								<div class="col-md-12 mb-3">
									<label class="labels mb-1">Họ tên</label>
									<input type="text" class="form-control" placeholder="Full name" name="name">
									@error('name')
										<p class="text-danger">{{ $message }}</p>
									@enderror
								</div>
								<div class="col-md-12 mb-3">
									<label class="labels mb-1">Giới tính</label>
									<div class="border p-3 rounded">
										<div class="form-check form-check-inline">
											<input type="radio" class="form-check-input" name="gender" id="gender" value="1" checked>
											<label class="form-check-label" for="gender">Nam</label>
										</div>

										<div class="form-check form-check-inline">
											<input type="radio" class="form-check-input" name="gender" id="gender" value="0">
											<label class="form-check-label" for="gender">Nữ</label>
										</div>

										@error('gender')
											<p class="text-danger">{{ $message }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Số điện thoại</label>
								<input type="text" class="form-control" name="phone" placeholder="enter phone number">
								@error('phone')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Email</label>
								<input type="text" class="form-control" name="email" placeholder="example@email.com">
								@error('email')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>

							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Mật khẩu đăng nhập</label>
								<input type="password" class="form-control" name="password">
								@error('password')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>

							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Ngày sinh</label>
								<input type="date" name="birth" class="form-control">
								@error('birth')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>

							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Địa chỉ</label>
								<input type="text" class="form-control" name="address" placeholder="Enter address">
								@error('address')
									<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Ghi chú</label>
								<div class="form-floating">
									<textarea class="form-control" name="description" placeholder="Placeholder" style="height: 100px;"></textarea>
									<label>Nhập ghi chú</label>
								</div>
							</div>
							<div class="col-md-12 mb-3">
								<label class="labels mb-1">Vai trò</label>
								<div class="border p-3 rounded">

									<div class="form-check form-check-inline">
										<input type="radio" class="form-check-input" name="role" id="role" value="2">
										<label class="form-check-label" for="role">Superadmin</label>
									</div>
									<div class="form-check form-check-inline">
										<input type="radio" class="form-check-input" name="role" id="role" value="0"checked>
										<label class="form-check-label" for="role">Admin</label>
									</div>
									<div class="form-check form-check-inline">
										<input type="radio" class="form-check-input" name="role" id="role" value="1">
										<label class="form-check-label" for="role">Người dùng</label>
									</div>
								</div>
							</div>
							<div class="col-md-12 mb-3 row">
								<label class="col-form-label">Ảnh đại diện</label>
								<div class="col-lg-12">
									<!-- AJAX upload -->
									<div class="card">
										<div class="card-body">
											<input type="file" name="avatar" class="file-input file-input-ajax" multiple="false">
										</div>
									</div>
									<!-- /AJAX upload -->
								</div>
							</div>
						</div>
						<div class="mt-2 text-center">
							<input type="submit" class="btn btn-primary profile-button" value="Thêm tài khoản">
						</div>
					</form>
				</div>


			</div>
		</div>

	</div>
</div>
@include('admin.layout.footer')
