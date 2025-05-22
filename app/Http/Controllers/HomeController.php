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
        $posts = Post::latest()->get();

        $photos = Photo::latest()->get();

        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'key' => env('YOUTUBE_API_KEY'),
            'channelId' => 'UC_x5XG1OV2P6uZZ5FSM9Ttw', 
            'part' => 'snippet',
            'order' => 'date',
            'maxResults' => 3,
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
}
