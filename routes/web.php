<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/photos/{slug}',[PhotoController::class ,'show'])->name('photos.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // posts routes
    Route::get('/posts', action: [PostController::class, 'index'])->name('posts.index');
    //i change the route because the route thinks create is a name of a poste '/posts/{post}'
    Route::get('/create/posts', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::put('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
   

    // photos routes
    Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
    Route::get('/create/photos', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photos/store', [PhotoController::class, 'store'])->name('photos.store');
    
    Route::get('/photos/edit/{photo}', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::delete('/photos/destroy/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::put('/photos/update/{photo}', [PhotoController::class, 'update'])->name('photos.update');

    // categories routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create/category', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
});

require __DIR__.'/auth.php';

// comments routes
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
Route::post('/comments/reply/store', [CommentController::class, 'reply'])->name('comments.reply.store');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::put('/comments/approve/{id}', [CommentController::class, 'approveComment'])->name('comments.approve');
Route::put('/comments/reject/{id}', [CommentController::class, 'rejectComment'])->name('comments.reject');
Route::delete('/comments/destroy/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

// static pages routes
Route::get('/page/{slug}', [StaticPageController::class, 'show'])->name('static-pages.show');

Route::middleware('auth')->group(function () {
    // static pages management routes
    Route::get('/static-pages', [StaticPageController::class, 'index'])->name('static-pages.index');
    Route::get('/static-pages/create', [StaticPageController::class, 'create'])->name('static-pages.create');
    Route::post('/static-pages/store', [StaticPageController::class, 'store'])->name('static-pages.store');
    Route::get('/static-pages/edit/{staticPage}', [StaticPageController::class, 'edit'])->name('static-pages.edit');
    Route::put('/static-pages/update/{staticPage}', [StaticPageController::class, 'update'])->name('static-pages.update');
    Route::delete('/static-pages/destroy/{staticPage}', [StaticPageController::class, 'destroy'])->name('static-pages.destroy');
});

