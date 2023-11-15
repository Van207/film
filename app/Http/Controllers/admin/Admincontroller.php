<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
	function index()
	{
		$title = "Trang chủ | Admin";
		$phim_count = Film::count();
		$user_count = User::count();
		return view('admin.component.home.index', compact('title', 'phim_count', 'user_count'));
	}
}
