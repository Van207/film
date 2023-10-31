<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\FilmRevenue;
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
		$details = $phim->film_detail;
		$revenue = $phim->film_revenue;

		$lable_name_opening = "Doanh thu ngày mở bán";
		$labels_opening = FilmRevenue::where('film_id', $id)
			->where('opening', '!=', '0')
			->where('country', '!=', 'Domestic')
			->pluck('country')->toArray();
		$opening = FilmRevenue::where('film_id', $id)
			->where('opening', '!=', '0')
			->where('country', '!=', 'Domestic')
			->pluck('opening')->toArray();


		$lable_name_gross = "Tổng doanh thu";
		$labels_gross = FilmRevenue::where('film_id', $id)
			->where('gross', '!=', '0')
			->where('country', '!=', 'Domestic')
			->pluck('country')->toArray();
		$gross = FilmRevenue::where('film_id', $id)
			->where('gross', '!=', '0')
			->where('country', '!=', 'Domestic')
			->pluck('gross')->toArray();
		return view(
			'home.component.phim.index',
			compact('title', 'phim', 'details', 'lable_name_opening', 'labels_opening', 'opening', 'lable_name_gross', 'labels_gross', 'gross')
		);
	}
}
