<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = 'Danh sách bài viết';
		$posts = Post::orderBy('id', 'desc')->simplePaginate(25);
		return view('admin.component.post.index', compact('title', 'posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$title = 'Tạo bài viết';
		$cate = Category::all();

		return view('admin.component.post.create', compact('title', 'cate'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate(
			[
				'title' => 'required|max:255',
				'content' => 'required',
				'slug' => 'unique:post,slug',
			],
			[
				'title.required' => "Tiêu đề không được để trống",
				'title.max' => "Tiêu đề quá dài",
				'content.required' => "Nội dung trống",
				'slug.unique' => "Đường dẫn đã tồn tại",

			]
		);

		$post = new Post();
		// Có hình ảnh mới xử lý
		if (isset($request->thumbnail) && $request->thumbnail != '') {
			$file = $request->thumbnail;
			$tenhinhanh = Str::of($request->title)->slug('_') . '.' . $file->getClientOriginalExtension();
			Storage::disk('post')->put($tenhinhanh, File::get($file));
			$post->thumbnail = $tenhinhanh;
		}

		$post->title = $request->title;
		$post->content = $request->content;
		$post->category_id = $request->category_id;
		$post->status = $request->status;
		$post->slug = $request->slug;
		$post->post_date = date('Y-m-d');
		$post->user_id = Auth::user()->id;
		$post->save();
		return redirect()->route('post.index')->with('success', 'Đã tạo bài viết');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$title = 'Cập nhật bài viết';
		$post = Post::find($id);
		$cate = Category::all();
		return view('admin.component.post.edit', compact('title', 'cate', 'post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$request->validate(
			[
				'title' => 'required|max:255',
				'content' => 'required',
				'slug' => Rule::unique('post', 'slug')->ignore($id),
			],
			[
				'title.required' => "Tiêu đề không được để trống",
				'title.max' => "Tiêu đề quá dài",
				'content.required' => "Nội dung trống",
				'slug.unique' => "Đường dẫn đã tồn tại",

			]
		);
		$post = Post::find($id);

		// Có hình ảnh mới xử lý
		if (isset($request->thumbnail) && $request->thumbnail != '') {

			// Xóa ảnh cũ
			$hinhanh_old = $post->thumbnail;
			if ($hinhanh_old && $hinhanh_old != '') {
				Storage::disk('post')->delete($hinhanh_old);
			}


			$file = $request->thumbnail;
			$tenhinhanh = Str::of($request->title)->slug('_') . '.' . $file->getClientOriginalExtension();
			Storage::disk('post')->put($tenhinhanh, File::get($file));
			$post->thumbnail = $tenhinhanh;
		}


		$post->title = $request->title;
		$post->content = $request->content;
		$post->category_id = $request->category_id;
		$post->status = $request->status;
		$post->slug = Str::slug($request->title);
		$post->post_date = date('Y-m-d');
		$post->user_id = Auth::user()->id;
		$post->save();
		return redirect()->route('post.index')->with('success', 'Đã cập nhật bài viết');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);

		$hinhanh = $post->thumbnail;
		if ($hinhanh && $hinhanh != '') {
			Storage::disk('post')->delete($hinhanh);
		}
		$post->delete();
		return redirect()->route('post.index')->with('success', 'Đã xóa!');
	}
}
