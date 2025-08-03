<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(6)->get();

        $photos = Photo::latest()->take(6)->get();

        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
        'key' => env('YOUTUBE_API_KEY'),
        'channelId' => env('YOUTUBE_CHANNEL_ID'),
            'part' => 'snippet',
            'order' => 'date',
            'maxResults' => 6,
            'type' => 'video',
        ]);

        $latestVideos = collect();

        if ($response->successful()) {
            $items = $response->json()['items'] ?? [];

            $latestVideos = collect($items)->map(function ($video) {
                return [
                    'title' => $video['snippet']['title'],
                    'thumbnail' => $video['snippet']['thumbnails']['high']['url'],
                    'videoId' => $video['id']['videoId'],
                ];
            });
        }

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
}
