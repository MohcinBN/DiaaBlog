<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
//Route::get('/', [PostController::class, 'getPosts']);

//Route::get('/', [PhotoController::class, 'getPhotos']);

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

    // videos routes
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos/store', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/videos/edit/{video}', [VideoController::class, 'edit'])->name('videos.edit');
    Route::delete('/videos/destroy/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
    Route::put('/videos/update/{video}', [VideoController::class, 'update'])->name('videos.update');
});

require __DIR__.'/auth.php';

Route::post('/upload-video', [VideoController::class, 'upload']);

Route::get('/youtube-videos', [VideoController::class, 'fetchVideos']);

//Route::get('/', [VideoController::class, 'fetchVideos']);


//Route::get('slug', function (){
    //return Str::slug('hi im mouad');
//});