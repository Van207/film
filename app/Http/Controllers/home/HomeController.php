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
		$casts = $phim->film_cast;

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
			compact('title', 'phim', 'details', 'casts', 'lable_name_opening', 'labels_opening', 'opening', 'lable_name_gross', 'labels_gross', 'gross')
		);
	}

	public function allFilm()
	{
		$title = "Danh sách phim điện ảnh";
		$films = Film::orderby('year', 'DESC')->simplePaginate(16);
		return view('home.component.phim.all', compact('title', 'films'));
	}

	public function film_filter(Request $request)
	{
		$name = $request->input('name');
		$year = $request->input('year');

		$film = Film::query();
		// dd($name, $year);
		if ($name && $name != "") {
			$film->where('name', 'LIKE', "%{$name}%")->orWhere('name_vi', 'LIKE', "%{$name}%");
		}

		if ($year && $year != '0') {
			$film->where('year', $year);
		}



		$films = $film->simplePaginate(16)->appends(['name' => $name, 'year' => $year]);
		// return response()->json($film);
		$title = "Danh sách phim";
		return view('home.component.phim.all', compact('title', 'films'));
	}
}
