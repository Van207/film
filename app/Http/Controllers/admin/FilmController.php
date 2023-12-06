<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class FilmController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = "Danh sách phim điện ảnh";
		$films = Film::orderby('year', 'DESC')->simplePaginate(16);
		return view('admin.component.phim.index', compact('title', 'films'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$title = "Thêm mới phim";
		return view('admin.component.phim.create', compact('title'));
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
				'name' => 'required|max:255|unique:films,name',
				'name_vi' => 'required|max:255',
				'budget' => 'numeric',
				'worldwide' => 'numeric',
				'domestic' => 'numeric',
				'international' => 'numeric',
				'year' => 'numeric',
			],
			[
				'name.required' => "Tên phim không được để trống",
				'name.max' => "Tên phim quá dài",
				'name.unique' => "Phim đã tồn tại",
				'name_vi.required' => "Tên phim không được để trống",
				'name_vi.max' => "Tên phim quá dài",
				'budget.numeric' => "Sử dụng định dạng số",
				'worldwide.numeric' => "Sử dụng định dạng số",
				'domestic.numeric' => "Sử dụng định dạng số",
				'international.numeric' => "Sử dụng định dạng số",
				'year.numeric' => "Sử dụng định dạng số",
			]
		);
		$phim = new Film();
		$phim->name = $request->name;
		$phim->name_vi = $request->name_vi;
		$phim->image = $request->image;
		$phim->img_big = $request->img_big;
		$phim->summary = $request->summary;
		$phim->budget = $request->budget;
		$phim->domestic = $request->domestic;
		$phim->worldwide = $request->worldwide;
		$phim->international = $request->international;
		$phim->year = $request->year;
		$phim->url_media = '';
		$phim->link = '';
		$phim->title_summary_link = '';
		$phim->link_imdb = '';
		$phim->status = 6;
		$phim->save();
		return redirect()->route('film.index')->with('msg', 'Đã thêm thành công!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$title = "Thông tin phim";
		$film = Film::find($id);
		$details = $film->film_detail;
		$casts = $film->film_cast;
		$revenues = $film->film_revenue;
		return view('admin.component.phim.detail', compact('title', 'film', 'casts', 'details', 'revenues'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$title = 'Cập nhật phim';
		$phim = Film::find($id);

		return view('admin.component.phim.edit', compact('phim', 'title'));
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
				'name' => [
					'required',
					'max:255',
					Rule::unique('films', 'name')->ignore($id)
				],
				'name_vi' => 'required|max:255',
				'budget' => 'numeric',
				'worldwide' => 'numeric',
				'domestic' => 'numeric',
				'international' => 'numeric',
				'year' => 'numeric',
			],
			[
				'name.required' => "Tên phim không được để trống",
				'name.max' => "Tên phim quá dài",
				'name.unique' => "Phim đã tồn tại",
				'name_vi.required' => "Tên phim không được để trống",
				'name_vi.max' => "Tên phim quá dài",
				'budget.numeric' => "Sử dụng định dạng số",
				'worldwide.numeric' => "Sử dụng định dạng số",
				'domestic.numeric' => "Sử dụng định dạng số",
				'international.numeric' => "Sử dụng định dạng số",
				'year.numeric' => "Sử dụng định dạng số",
			]
		);

		$phim = Film::findOrFail($id);
		$phim->name = $request->name;
		$phim->name_vi = $request->name_vi;
		$phim->image = $request->image;
		$phim->img_big = $request->img_big;
		$phim->summary = $request->summary;
		$phim->budget = $request->budget;
		$phim->domestic = $request->domestic;
		$phim->worldwide = $request->worldwide;
		$phim->international = $request->international;
		$phim->year = $request->year;
		$phim->url_media = '';
		$phim->link = '';
		$phim->title_summary_link = '';
		$phim->link_imdb = '';
		$phim->status = 6;
		$phim->save();
		return redirect()->route('film.index')->with('msg', 'Đã cập nhật thành công!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$phim = Film::find($id);

		// Cập nhật trạng thái public kho lưu trữ pubic = 0
		$name = $phim->name;
		DB::table("film_store")->where('name', '=', $name)->update(['public' => '0']);

		$phim->delete();

		DB::table('film_cast')
			->where('film_id', $id)
			->delete();
		DB::table('film_detail')
			->where('film_id', $id)
			->delete();
		DB::table('film_revenue')
			->where('film_id', $id)
			->delete();
		return redirect()->route('film.index')->with('msg', 'Đã xóa thành công');
	}

	public function filter(Request $request)
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
		return view('admin.component.phim.index', compact('title', 'films'));
	}

	public function doanhthu()
	{
		$title = "Biến động doanh thu";
		return view('admin.component.phim.doanhThu', compact('title'));
	}
}
