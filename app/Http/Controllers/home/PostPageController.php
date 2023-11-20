<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostPageController extends Controller
{
	public function category($cate_slug)
	{
		$isCategory = Category::where('slug', $cate_slug)->exists();
		if ($isCategory) {
			$cate = Category::where('slug', $cate_slug)->first();
			$posts = $cate->post;
			$title = $cate->name;
			return view('home.component.post.category', compact('title', 'cate', 'posts'));
		}
		else {
			abort(404);
		}
	}

	public function post($post_slug)
	{
		$post = Post::where('slug', $post_slug)->first();
		if ($post && $post->status === 'Public') {
			$cate = $post->category;
			$title = $post->title;

			return view('home.component.post.post', compact('title', 'cate', 'post'));
		} else {
			abort(404);
		}
	}
}
