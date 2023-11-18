<?php

use App\Http\Controllers\admin\Admincontroller;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\FilmController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\Home\SoSanhController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
	Route::get('/login', [AuthController::class, 'index'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('post.login');
	Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::prefix('admin')->middleware('CheckLogin')->group(function () {
	Route::get('/', [Admincontroller::class, 'index'])->name('homepage');

	Route::prefix('/phim')->group(function () {
		Route::get('/', [FilmController::class, 'index'])->name('film.index');
		Route::get('/detail/{id}', [FilmController::class, 'show'])->name('film.detail');
		Route::get('/create', [FilmController::class, 'create'])->name('film.create');
		Route::post('/create', [FilmController::class, 'store'])->name('film.store');
		Route::get('/edit/{id}', [FilmController::class, 'edit'])->name('film.edit');
		Route::post('/edit/{id}', [FilmController::class, 'update'])->name('film.update');
		Route::get('/delete/{id}', [FilmController::class, 'destroy'])->name('film.delete');
		Route::get('/filter', [FilmController::class, 'filter'])->name('film.filter');


		Route::get('/edit-revenue/{id}', [FilmController::class, 'editRevenue'])->name('film.editRevenue');
	});


	Route::prefix('/category')->group(function () {
		Route::get('/', [CategoryController::class, 'index'])->name('category.index');
		Route::post('/', [CategoryController::class, 'store']);
		Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
		Route::post('/edit/{id}', [CategoryController::class, 'update']);
		Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
	});

	Route::prefix('/post')->group(function () {
		Route::get('/', [PostController::class, 'index'])->name('post.index');
		Route::get('/create', [PostController::class, 'create'])->name('post.create');
		Route::post('/create', [PostController::class, 'store']);
		Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
		Route::post('/edit/{id}', [PostController::class, 'update']);
		Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
	});

	Route::prefix('/user')->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('user.index');
		Route::get('/create', [UserController::class, 'create'])->name('user.create');
		Route::post('/create', [UserController::class, 'store']);
		Route::get('/{id}', [UserController::class, 'profile'])->name('user.profile');
		Route::post('/{id}', [UserController::class, 'update']);
		Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
	});
});


Route::get("/", [HomeController::class, 'index'])->name('home.index');
Route::get("/{slug}_{id}", [HomeController::class, 'phim'])->name('home.phim');
Route::prefix('phim')->group(function () {
	Route::get('/', [HomeController::class, 'allFilm'])->name('phim.index');
	Route::get('/filter', [HomeController::class, 'film_filter'])->name('phim.filter');
});

Route::prefix('so-sanh')->group(function () {
	Route::get('/', [SoSanhController::class, 'index'])->name('phim.sosanh');
	Route::post('/', [SoSanhController::class, 'sosanh'])->name('phim.sosanhAjax');
	Route::GET('/getImg', [SoSanhController::class, 'getImgAjax'])->name('phim.getImgAjax');
});
