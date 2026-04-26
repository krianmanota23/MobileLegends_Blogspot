<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// -----------------------------------------------
// PUBLIC ROUTES
// -----------------------------------------------

// Homepage — show all published posts
Route::get('/', [PostController::class, 'index'])->name('home');

// Single post detail page
Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.show');

// -----------------------------------------------
// AUTH ROUTES
// -----------------------------------------------

// Show login page
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Handle login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------------------------------
// ADMIN ROUTES (protected by AdminMiddleware)
// -----------------------------------------------

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Admin dashboard — list all posts
    Route::get('/posts', [PostController::class, 'adminIndex'])->name('posts.index');

    // Create new post form
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    // Store new post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Edit post form
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // Update post
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

    // Delete post
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

});
