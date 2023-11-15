<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
	public function index()
	{
		$title = "Quản lý tài khoản";
		$users = User::all();
		return view('admin.component.user.index', compact('title', 'users'));
	}
	function create()
	{
		$title = "Thêm tài khoản";
		return view('admin.component.user.create', compact('title'));
	}
	public function store(Request $request)
	{
		$user = new User;
		$request->validate(
			[
				'name' => 'required|max:255',
				'email' => 'required|email',
				'gender' => 'required',
				'birth' => 'required',
			],
			[
				'name.required' => "Tên không được để trống!",
				'name.max' => "Tên quá dài.",
				'email.required' => "Email không được để trống!",
				'email.email' => "Email không đúng định dạng",
				'gender.required' => "Giới tính không được để trống!",
				'birth.required' => 'Ngày sinh không được để trống!',
			]
		);

		// Có hình ảnh mới xử lý
		if (isset($request->avatar) && $request->avatar != '') {
			$file = $request->avatar;
			$tenhinhanh = Str::of($request->name)->slug('_') . '.' . $file->getClientOriginalExtension();
			Storage::disk('user')->put($tenhinhanh, File::get($file));
			$user->avatar = $tenhinhanh;
		}
		$user->name = $request->name;
		$user->email = $request->email;
		$user->gender = $request->gender;
		$user->address = $request->address;
		$user->birth = $request->birth;
		$user->description = $request->description;
		$user->phone = $request->phone;
		$user->role = $request->role;
		$user->password = Hash::make($request->password);
		$user->save();
		return redirect()->route('user.index')->with('msg', "Thêm thành công");
	}

	public function profile($id)
	{
		$user = User::find($id);
		$name = $user->name;
		$title = "Tài khoản $name";
		return view('admin.component.user.profile', compact('title', 'user'));
	}

	public function update(Request $request, $id)
	{
		$request->validate(
			[
				'name' => 'required|max:255',
				'email' => 'required|email',
				'gender' => 'required',
				'birth' => 'required',
			],
			[
				'name.required' => "Tên không được để trống!",
				'name.max' => "Tên quá dài.",
				'email.required' => "Email không được để trống!",
				'email.email' => "Email không đúng định dạng",
				'gender.required' => "Giới tính không được để trống!",
				'birth.required' => 'Ngày sinh không được để trống!',
			]
		);
		$user = User::find($id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->gender = $request->gender;
		$user->address = $request->address;
		$user->birth = $request->birth;
		$user->description = $request->description;
		$user->phone = $request->phone;

		// Có hình ảnh cần update
		if (isset($request->avatar) && $request->avatar != '') {

			// Xóa ảnh cũ
			if ($user->avatar && $user->avatar != '') {
				Storage::disk('user')->delete($user->avatar);
			}

			$file = $request->avatar;
			$tenhinhanh = Str::of($request->name)->slug('_') . '.' . $file->getClientOriginalExtension();
			Storage::disk('user')->put($tenhinhanh, File::get($file));
			$user->avatar = $tenhinhanh;
		}
		$user->save();
		return redirect()->route('user.profile', $id)->with('msg', "Cập nhật thông tin thành công!");
	}

	public function destroy($id)
	{
		$user = User::find($id);

		$hinhanh = $user->avatar;
		if ($hinhanh && $hinhanh != '') {
			Storage::disk('user')->delete($hinhanh);
		}
		$user->delete();
		return redirect()->route('user.index')->with('success', 'Đã xóa!');
	}
}
