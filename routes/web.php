<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::get('/search', 'search')->name('search'); 
    Route::get('/posts/unlike/{id}', 'unlike')->name('unlike');
    Route::get('/posts/like/{id}', 'like')->name('like');
});

Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts/create', [PostController::class, 'create']); 
Route::post('/posts', [PostController::class, 'store']); 
Route::get('/posts/{post}', [PostController::class, 'show']); 


require __DIR__.'/auth.php';
