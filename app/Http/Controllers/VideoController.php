<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::latest()->paginate(2);
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'url' => 'required|url'
        ]);

        $validated['user_id'] = Auth::id();
        Video::create($validated);

        return redirect()->route('videos.index')
            ->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'url' => 'required|url'
        ]);

        $video->update($validated);

        return redirect()->route('videos.index')
            ->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')
            ->with('success', 'Video deleted successfully.');
    }

    public function upload(Request $request)
{
    // Validation des données
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'video' => 'required|mimes:mp4,mov,avi,wmv|max:50000' // Max 50MB
    ]);

    // Sauvegarde de la vidéo dans storage/app/public/videos
    $videoPath = $request->file('video')->store('videos', 'public');

    // Enregistrement dans la base de données
    $video = Video::create([
        'title' => $request->title,
        'description' => $request->description,
        'path' => $videoPath
    ]);

    return response()->json([
        'message' => 'Vidéo uploadée avec succès!',
        'video' => $video
    ], 201);
}

 public function fetchVideos()
{
    $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
        'key' => env('YOUTUBE_API_KEY'),
        'channelId' => 'UC_x5XG1OV2P6uZZ5FSM9Ttw',
        'part' => 'snippet',
        'order' => 'date',
        'maxResults' => 3,
        'type' => 'video',
    ]);

    if ($response->successful()) {
        dd($response->json()); // ⛔ Ajoute cette ligne pour inspecter la réponse
    } else {
        dd('Erreur API YouTube', $response->status(), $response->json());
    }
}

}
