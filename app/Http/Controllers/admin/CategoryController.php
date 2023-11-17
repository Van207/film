<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = "Danh mục bài viết";
		$cate = Category::all();
		return view('admin.component.category.index', compact('title', 'cate'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
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
				'name' => 'required|max:255',
				'slug' => 'unique:category,slug',
			],
			[
				'name.required' => "Tiêu đề không được để trống",
				'name.max' => "Tiêu đề quá dài",
				'slug.unique' => "Đường dẫn đã tồn tại",
			]
		);
		$cate = new Category();
		$cate->name = $request->name;
		$cate->description = $request->description;
		$cate->slug = Str::slug($request->name);
		$cate->save();
		return redirect()->route('category.index')->with('success', 'Đã thêm danh mục!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$title = 'Cập nhật danh mục';
		$cate = Category::find($id);
		return view('admin.component.category.edit', compact('title', 'cate'));
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
				'name' => 'required|max:255',
				'slug' => 'unique:category,slug',
			],
			[
				'name.required' => "Tiêu đề không được để trống",
				'name.max' => "Tiêu đề quá dài",
				'slug.unique' => "Đường dẫn đã tồn tại",
			]
		);
		$cate = Category::find($id);
		$cate->name = $request->name;
		$cate->description = $request->description;
		$cate->slug = Str::slug($request->name);
		$cate->save();
		return redirect()->route('category.index')->with('success', 'Đã cập nhật danh mục!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$cate = Category::find($id);
		$cate->delete();
		return redirect()->route('category.index')->with('success', 'Đã xóa!');
	}
}
