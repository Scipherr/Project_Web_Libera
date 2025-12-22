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

// Public Profile Route
Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

// AUTHENTICATED ROUTES (User must be logged in)
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [PostController::class, 'index'])->name('dashboard');

    // Post Creation
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');

    // Post Viewing (e.g. /@username/my-slug)
    Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');

    // Follow System
    Route::post('/follow/{user}', [FollowerController::class, 'followUnfollow'])->name('follow');

    // Post Management (Edit/Update/Delete) - Moved INSIDE middleware for security
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

// ADMIN ROUTES
Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'create'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'store'])->name('admin.login.store');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
    });
});

// USER PROFILE MANAGEMENT
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';