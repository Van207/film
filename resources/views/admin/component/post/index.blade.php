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
					<table class="table border table-responsive table-hover">
						<thead>
							<tr>
								<th>id</th>
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
								@foreach ($posts as $post)
									<tr>
										<td>{{ $post->id }}</td>
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
				<div class="pagination_wrapper text-center mt-3 mb-2">{{ $posts->links() }}</div>
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
