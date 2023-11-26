<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\FilmRevenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
	public function index()
	{
		$title = 'Phân Tích Doanh Thu Phim | Nguyễn Thế Văn';
		$year = date('Y');
		$top10 = Film::where('year', $year)->orderBy('worldwide', 'desc')->limit(10)->get();

		$top_action = DB::table('films')
			->join('film_detail', 'films.id', '=', 'film_detail.film_id')
			->where('films.year', '=', '2023')
			->where('film_detail.title', '=', 'genres')
			->where('film_detail.details', 'like', '%Action%')
			->orderBy('films.worldwide', 'desc')
			->limit(10)
			->get();
		$top_animation = DB::table('films')
			->join('film_detail', 'films.id', '=', 'film_detail.film_id')
			->where('films.year', '=', '2023')
			->where('film_detail.title', '=', 'genres')
			->where('film_detail.details', 'like', '%Animation%')
			->orderBy('films.worldwide', 'desc')
			->limit(10)
			->get();
		return view('home.component.home.index', compact('title', 'top10', 'top_action', 'top_animation'));
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
		$opening_table = FilmRevenue::where('film_id', $id)
			->where('opening', '!=', '0')
			->where('country', '!=', 'Domestic')
			->get();

		$lable_name_gross = "Tổng doanh thu";
		$labels_gross = FilmRevenue::where('film_id', $id)
			->where('gross', '!=', '0')
			->where('country', '!=', 'Domestic')
			->pluck('country')->toArray();
		$gross = FilmRevenue::where('film_id', $id)
			->where('gross', '!=', '0')
			->where('country', '!=', 'Domestic')
			->pluck('gross')->toArray();
		$gross_table = FilmRevenue::where('film_id', $id)
			->where('gross', '!=', '0')
			->where('country', '!=', 'Domestic')
			->get();
		return view(
			'home.component.phim.index',
			compact('title', 'phim', 'details', 'casts', 'lable_name_opening', 'labels_opening', 'opening', 'opening_table', 'lable_name_gross', 'labels_gross', 'gross', 'gross_table')
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
		$genre = $request->input('genre');

		$film_name = array();
		$film_data = array();
		$film = DB::table('films');

		if ($name !== null && $name != "") {
			$film->where('name', 'LIKE', "%{$name}%")->orWhere('name_vi', 'LIKE', "%{$name}%");
		}
		if ($year && $year != '0') {
			$film->where('year', $year);

			$top_year =  Film::where('year', $year)->orderBy('worldwide', 'desc')->limit(10)->get();
			foreach ($top_year as $top) {
				$film_name[] = $top->name_vi;
				$film_data[] = $top->worldwide;
			}
		}

		if ($genre && $genre != "0") {
			$film->join('film_detail', 'films.id', '=', 'film_detail.film_id')
				->where('film_detail.title', '=', 'genres')
				->where('film_detail.details', 'like', "%{$genre}%");
		}

		$films = $film->simplePaginate(16)->appends(['name' => $name, 'year' => $year, 'genre' => $genre]);
		$title = "Danh sách phim";
		return view('home.component.phim.all', compact('title', 'films', 'film_name', 'film_data'));
	}
}
