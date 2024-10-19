<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route::get('/posts', [PostController::class, 'index']);
// Route::post('/posts', [PostController::class, 'store']);

// Route::post('/comments', [CommentController::class, 'store']);
// Route::post('/likes', [LikeController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/likes', [LikeController::class, 'store']);
});

require __DIR__.'/auth.php';
