<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$title = 'Trang Web Phân Tích Doanh Thu Độc Đáo';
		$year = date('Y');
		$top10 = Film::where('year', $year)->orderBy('worldwide', 'desc')->limit(10)->get();
		return view('home.component.home.index', compact('title', 'top10'));
	}

	public function phim($slug, $id)
	{
		$phim = Film::find($id);
		$title = $phim->name_vi;
		
		return view('home.component.phim.index', compact('title', 'phim'));
		// dd($id);
	}
}
