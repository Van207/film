<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function  index()
	{
		return view('admin.login');
	}
	public function login(Request $request)
	{
		$request->validate(
			[
				'email' => 'required|min:3|max:255',
				'password' => 'required|min:3',
			],
			[
				'email.required' => 'Tên đăng nhập không được để trống',
				'email.min' => 'Tên đăng nhập quá ít',
				'email.max' => 'Tên đăng nhập quá dài',
				'password.required' => 'Mật khẩu không được để trống',
				'password.min' => 'Mật khẩu quá ít',
			]
		);

		$arr = [
			'email' => $request->email,
			'password' => $request->password,
		];
		if (Auth::attempt($arr)) {
			return redirect()->route('homepage');
		} else {

			return redirect()->route('login')->with('error', "Tài khoản hoặc mật khẩu không chính xác");
		}
	}


	function logout(Request $request)
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route('login');
	}
}
