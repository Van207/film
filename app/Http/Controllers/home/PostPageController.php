<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostPageController extends Controller
{
	public function allPost()
	{
		$title = "Tất cả bài viết";
		$posts = Post::where('status', 'Public')->orderBy('id', 'desc')->simplePaginate(16);
		return view('home.component.post.allpost', compact('title', 'posts'));
	}
	public function category($cate_slug)
	{
		$isCategory = Category::where('slug', $cate_slug)->exists();
		if ($isCategory) {
			$cate = Category::where('slug', $cate_slug)->first();
			$posts = $cate->post()->orderBy('id', 'desc')->simplePaginate(16);
			$title = $cate->name;
			return view('home.component.post.category', compact('title', 'cate', 'posts'));
		} else {
			abort(404);
		}
	}

	public function post($post_slug)
	{
		$post = Post::where('slug', $post_slug)->first();
		if ($post && $post->status === 'Public') {
			$cate = $post->category;
			$title = $post->title;

			$related_posts = Post::where('category_id', $post->category_id)
				->where('slug', '!=', $post_slug)
				->where('status', 'Public')
				->limit(4)
				->get();
			return view('home.component.post.post', compact('title', 'cate', 'post', 'related_posts'));
		} else {
			abort(404);
		}
	}
}
