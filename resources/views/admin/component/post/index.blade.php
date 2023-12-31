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
					<h5 class="mb-0">Bài viết</h5>
					<a href="{{ route('post.create') }}" class="btn btn-primary">Thêm bài viết</a>
				</div>

				<div class="table-responsive">
					<table class="table border table-responsive table-hover datatable-basic">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tiêu đề</th>
								<th>Thumbnail</th>
								<th>Danh mục</th>
								<th>Tác giả</th>
								<th>Trạng thái</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if (count($posts) > 0)
								@php
									$stt = 1;
								@endphp
								@foreach ($posts as $post)
									<tr>
										<td>{{ $stt++ }}</td>
										<td width="300px">
											<a href="{{ route('home.post', $post->slug) }}" title="{{ $post->title }}" target="_blank" class="post-title">{{ $post->title }}</a>
										</td>
										<td width="10%">
											@if (isset($post->thumbnail) && $post->thumbnail != '')
												<img src="{{ asset('images/post/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-100">
											@else
												<img src="{{ asset('images/post/post_blank.png') }}" alt="{{ $post->title }}" class="w-100">
											@endif
										</td>
										<td>
											{{ $post->category->name }}
										</td>

										<td>
											{{ $post->user->name }}
										</td>
										<td>
											@if ($post->status == 'Public')
												<span class="badge bg-success">{{ $post->status }}</span>
											@else
												<span class="badge bg-warning">{{ $post->status }}</span>
											@endif
										</td>
										<td>
											<a href="{{ route('post.edit', $post->id) }}" class="text-info p-2"><i class="icon-pencil5"></i></a>
											<a href="{{ route('post.delete', $post->id) }}" class="text-danger p-2"><i class="icon-trash"></i></a>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="6">
										<p class="text-danger text-center">Không có bài viết</p>
									</td>
								</tr>
							@endif

						</tbody>
					</table>

				</div>
				{{-- <div class="pagination_wrapper text-center mt-3 mb-2">{{ $posts->links() }}</div> --}}
			</div>
		</div>
	</div>

</div>
<style>
	.post-title {
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		display: -webkit-box;
		height: 45px;
	}
</style>
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
