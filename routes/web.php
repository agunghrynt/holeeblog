<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserDashboardPostController;

Route::get('/', function() {
    return view('home', [
        "title" => "Home",
        "active" => 'home',
    ]);
})->name('home');

Route::get('/blog', [PostController::class, 'index']);

Route::get('/project', function () {
    return view('project', [
        "title" => "My Project",
        "active" => 'project',
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        "title" => "Contact Me",
        "active" => 'contact',
    ]);
});

Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        "active" => 'categories',
        'categories' => Category::all(),
    ]);
});

//halaman single post
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/user-dashboard', function() {
    return view('user-dashboard.index', [
        'title' => 'Dashboard',
        'active' => 'dashboard',
    ]);
})->middleware('auth');

Route::get('/user-dashboard/posts/checkSlug', [UserDashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/user-dashboard/posts', UserDashboardPostController::class)->middleware('auth');

Route::get('/user-dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/user-dashboard/categories', AdminCategoryController::class)->except('show')->middleware('mustadmin');
