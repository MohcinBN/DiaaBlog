<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class getYoutubeVideosService
{
    function getVideos()
    {
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

        return $latestVideos;
    }
}
