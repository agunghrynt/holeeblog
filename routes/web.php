<?php

use App\Models\Category;
use App\Livewire\AddComment;
use App\Livewire\SlugGenerator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserDashboardPostController;

Route::get('/', [GeminiController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

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


Route::controller(PostController::class)->group(function()
{
    Route::get('/posts', 'index');
    //halaman single post
    Route::get('/posts/{post:slug}', 'show');
});

Route::controller(LoginController::class)->group(function()
{
    Route::get('/login', 'index')->middleware('guest')->name('login');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function()
{
    Route::get('/register', 'index')->middleware('guest')->name('register');
    Route::post('/register', 'store');
});

// Route::get('/user-dashboard/posts/checkSlug', [UserDashboardPostController::class, 'checkSlug'])->middleware(['auth', 'cors']);
Route::view('/user-dashboard', 'user-dashboard.index', [
    'title' => 'Dashboard',
    'active' => 'dashboard',
])->middleware('auth');
Route::resource('/user-dashboard/posts', UserDashboardPostController::class)->middleware('auth');

Route::resource('/user-dashboard/comments', CommentController::class)->except(['index', 'create', 'store']);
Route::get('/user-dashboard/comments', [CommentController::class, 'index'])->name('comments.index');
Route::middleware('creator')->group(function () {
    Route::get('/user-dashboard/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
    Route::get('/user-dashboard/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/user-dashboard/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/user-dashboard/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Route::get('/user-dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/user-dashboard/categories', AdminCategoryController::class)->except('show')->middleware('mustadmin');

Route::middleware(['auth'])->group(function () {
    // Route::get('/posts/{post}', PostController::class . '@show');
    Route::post('/posts/{post}/comment', AddComment::class)->name('comment.add');
});

Route::middleware(['mustadmin'])->group(function () {
    Route::get('/user-dashboard/manage-comments', [CommentController::class, 'manage'])->name('comments.manage');
    Route::get('/user-dashboard/manage-comments/{comment}', [CommentController::class, 'show'])->name('comments.manage.show');
    Route::delete('/user-dashboard/manage-comments/{comment}', [CommentController::class, 'destroy'])->name('comments.manage.destroy');
});

// Route::resource('comments-manage', CommentController::class)->names([
//     'manage' => 'comments.manage.manage',
//     'show' => 'comments.show',
//     'destroy' => 'comments.destroy'
// ])->middleware('mustadmin');