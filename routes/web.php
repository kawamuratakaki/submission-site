<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/posts', [PostController::class, 'store'])->name('store');
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('delete');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::get('/search', [PostController::class, 'search'])->name('search');
    Route::get('/posts/unlike/{id}', [PostController::class, 'unlike'])->name('unlike');
    Route::get('/posts/like/{id}', [PostController::class, 'like'])->name('like');
    Route::get('/posts/share/{id}', [PostController::class, 'share'])->name('share');
    Route::get('/liked-posts', [PostController::class, 'showLikedPosts'])->name('liked-posts');
    Route::get('/histories', [PostController::class, 'histories'])->name('histories');
    Route::delete('/histories/{history}', [PostController::class, 'historiesdestroy'])->name('histories.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{post}', [PostController::class, 'show']);


Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback/store', [FeedbackController::class,'store'])->name('feedback.store');
Route::get('/feedback/index', [FeedbackController::class, 'index'])->name('feedback.index');


require __DIR__.'/auth.php';
