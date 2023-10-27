<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
	function index()
	{
		$title = "Trang chủ | Admin";
		return view('admin.component.home.index', compact('title'));
	}
}
