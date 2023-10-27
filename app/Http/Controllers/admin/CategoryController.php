<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

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
		$cate = new Category();
		$cate->name = $request->name;
		$cate->description = $request->description;
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
		$cate = Category::find($id);
		$cate->name = $request->name;
		$cate->description = $request->description;
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
