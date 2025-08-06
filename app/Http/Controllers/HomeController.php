<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Category;
use App\Services\getYoutubeVideosService;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories')->latest()->take(6)->get();

        $photos = Photo::latest()->take(6)->get();

        $youtubeVideos = new getYoutubeVideosService();
        $latestVideos = $youtubeVideos->getVideos();

        return view('welcome', compact('posts', 'photos', 'latestVideos'));
    }

    public function allPostsPage() {
        $posts = Post::latest()->paginate(10);

        return view('all-posts', compact('posts'));
    }

    public function allPhotosPage() {
        $galleries = Photo::latest()->paginate(10);

        return view('all-galleries', compact('galleries'));
    }

    public function categoryResultsPage($slug) {
        $categoryModel = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::whereHas('categories', function ($query) use ($categoryModel) {
            $query->where('categories.id', $categoryModel->id);
        })->latest()->paginate(10);
    
        return view('category-results', [
            'posts' => $posts,
            'category' => $categoryModel->name,
        ]);
    }
}
