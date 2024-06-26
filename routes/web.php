<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VisualController;


Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware(['auth'])->group(function () {
    Route::get('/index', [PostController::class, 'index'])->name('index');
});

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
    Route::get('/posts/tag/{tag}', [PostController::class, 'showByTag'])->name('posts.show.by.tag');
    Route::get('/toggle-read-status/{id}', [PostController::class, 'toggleReadStatus'])->name('toggleReadStatus');
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
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');


Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::resource('questions', QuestionController::class);

Route::get('/visual', [VisualController::class, 'index'])->name('visual');
Route::get('/my-posts', [VisualController::class, 'myPosts'])->name('my_posts');

Route::post('/questions/{questionId}/answers', [QuestionController::class, 'storeAnswer'])->name('questions.storeAnswer');

Route::middleware(['auth'])->get('/user/posts', [PostController::class, 'userPosts'])->name('user.posts');
require __DIR__.'/auth.php';
