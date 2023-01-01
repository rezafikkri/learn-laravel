<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PostController,
    LoginController,
    RegisterController,
    DashboardPostController,
    AdminCategoryController
};
use App\Models\{Category, User};

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

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'home'
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'about',
        'nama' => 'Reza Sariful Fikri',
        'email' => 'rezafikkri@gmail.com',
        'image' => 'reza.png'
    ]);
});

Route::get('/blog', [PostController::class, 'index']);

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('quest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', fn() => view('dashboard.index'))->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug']);
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin')->except(['show']);
// Route::get('/dashboard/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->middleware('auth', 'can:admin');