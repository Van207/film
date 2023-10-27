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
								<th>Nội dung</th>
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
										<td><a href="#">{{ $post->title }}</a></td>
										<td>{!! $post->content !!}</td>
										<td width="10%">
											<img src="{{ asset('/images/post') . '/' . $post->thumbnail }}" alt="{!! $post->title !!}" class="w-100">
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
			</div>
		</div>
	</div>

</div>
@include('admin.layout.footer')
