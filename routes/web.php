<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/@{user:username}',[PublicProfileController::class,'show'])->name('profile.show');


// POST, GUEST & USER ETC
Route::middleware(['auth','verified']) ->group(function () {
Route::get('/', [PostController::class,'index'])->name('dashboard');
Route::get('/post/create', [PostController::class,'create'])->name('post.create');
Route::post('/post/create', [PostController::class,'store'])->name('post.store');
Route::get('/@{username}/{post:slug}',[PostController::class,'show'])->name('post.show');
Route ::post('/follow/{user}',[FollowerController::class,'followUnfollow'])->name('follow');

});
// NEW ROUTES FOR EDIT/DELETE
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
// ADMIN 
Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'create'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'store'])->name('admin.login.store');
    });

    // Authenticated Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
    });
});



// USER PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
