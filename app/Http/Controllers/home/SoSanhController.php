<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SoSanhController extends Controller
{
	public function index()
	{
		$title = "So sánh phim";
		$films = Film::all();
		$filmData = [];
		foreach ($films as $film) {
			$filmData[] = [
				'id' => $film->id,
				'text' => $film->name_vi
			];
		}
		return view('home.component.sosanh.index', compact('title', 'films', 'filmData'));
	}

	// public function sosanh(Request $request)
	// {
	// 	$id1 = $request->input('filmId1');
	// 	$id2 = $request->input('filmId2');

	// 	$film1 = Film::find($id1);
	// 	$film2 = Film::find($id2);

	// 	$detail1 = $film1->film_detail;
	// 	$detail2 = $film2->film_detail;
	// 	$revenue1 = $film1->film_revenue;
	// 	$revenue2 = $film2->film_revenue;

	// 	$results = [
	// 		'film1' => $film1,
	// 		'film2' => $film2,
	// 		'detail1' => $detail1,
	// 		'detail2' => $detail2,
	// 		'revenue1' => $revenue1,
	// 		'revenue2' => $revenue2,

	// 	];
	// 	return response()->json([
	// 		'success' => true,
	// 		'message' => 'Xử lý thành công',
	// 		'data' => $results
	// 	]);
	// }

	public function sosanh(Request $request)
	{
		$film1 = Film::find($request->input('filmId1'));
		$film2 = Film::find($request->input('filmId2'));

		$results = [
			'film1' => $film1->load('film_detail', 'film_revenue'),
			'film2' => $film2->load('film_detail', 'film_revenue'),
		];

		return response()->json([
			'success' => true,
			'message' => 'Xử lý thành công',
			'data' => $results,
		]);
	}

	function getImgAjax(Request $request)
	{
		$film = Film::find($request->input('id'));
		$film_url = Str::slug($film->name) . "_" . $film->id;
		return response()->json([
			'success' => true,
			'message' => 'Xử lý thành công',
			'img' => $film->img_big,
			'name' => $film->name_vi,
			'url' => $film_url
		]);
	}
}
