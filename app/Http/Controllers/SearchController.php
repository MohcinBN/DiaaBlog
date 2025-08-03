<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Photo;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('title', 'like', "%$search%")
                       ->orWhere('content', 'like', "%$search%")
                       ->get()
                       ->map(function($item) {
                        $item->type = 'post';
                        return $item;
                    });
                    
        $photos = Photo::where('title', 'like', "%$search%")
                        ->orWhere('caption', 'like', "%$search%")
                        ->get()
                        ->map(function($item) {
                            $item->type = 'photo';
                            return $item;
                        });

        $results = $posts->merge($photos);

        return view('search', compact('results', 'search'));
    }
}
