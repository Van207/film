<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admincontroller extends Controller
{
	function index()
	{
		$title = "Trang chủ | Admin";
		$phim_count = Film::count();
		$user_count = User::count();
		$post_count = Post::count();
		$schedule_log = DB::table('crawl_log')->orderByDesc('id')->limit(20)->get();
		$schedule_count = DB::table('crawl')->where('start', '1')->count();
		return view('admin.component.home.index', compact('title', 'phim_count', 'user_count', 'post_count', 'schedule_log', 'schedule_count'));
	}
}
