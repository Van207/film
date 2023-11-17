@include('admin.layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif



	<div class="mb-3 pt-2">
		<h5 class="mb-2">Danh sách Admin</h5>
		<a href="{{ route('user.create') }}" class="btn btn-info">Tạo tài khoản</a>


	</div>

	<div class="row">
		@if (count($users) > 0)
			@foreach ($users as $user)
				<div class="col-xl-3 col-sm-6">
					<div class="card">
						<div class="card-body text-center">
							<div class="card-img-actions d-inline-block mb-3">
								@if (isset($user->avatar))
									<img class="img-fluid rounded-circle" src="{{ asset('/images/user') . '/' . $user->avatar }}" width="170" height="170" alt="">
								@else
									<img class="img-fluid rounded-circle" src="{{ asset('/images/user') . '/user_empty.png' }}" width="170" height="170" alt="">
								@endif

							</div>

							<h6 class="mb-0">{{ $user->name }}</h6>
							<span class="text-muted">{{ $user->email }}</span>

							<div class="d-flex justify-content-center mt-3">
								<a href="{{ route('user.profile', $user->id) }}" class="link-info" data-bs-popup="tooltip" title="Edit">
									<i class="ph-pencil-simple-line"></i>
								</a>
								<a href="{{ route('user.delete', $user->id) }}" class="link-pink mx-2" data-bs-popup="tooltip" title="Delete" onclick="confirm('Chắc chắn xóa người dùng này?')">
									<i class="ph-trash-simple"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@endif

	</div>

</div>
@include('admin.layout.footer')
