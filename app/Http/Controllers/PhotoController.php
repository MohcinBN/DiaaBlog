<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::paginate(2);
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $slug = Str::slug($request->title);

        $paths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('photos', 'public');
            }
        }

        $photo = Photo::create([
            'title' => $request->title,
            'slug'=>$slug,
            'caption' => $request->caption,
            'user_id' => Auth::id(),
            'images' => json_encode($paths)
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $photo = Photo::where('slug' , $slug)->firstOrFail();

        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $slug = Str::slug($request->title);

        $photo->update([
            'title' => $request->title,
            'slug'=> $slug,
            'caption' => $request->caption,
        ]);

        if ($request->hasFile('images')) {
            // Delete old images if replace_images is checked
            if ($request->has('replace_images')) {
                foreach ($photo->images as $image) {
                    Storage::disk('public')->delete($image->path);
                }
                $photo->images()->delete();
            }

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('photos', 'public');
                $photo->images()->create([
                    'path' => $path,
                    'is_primary' => $index === 0 && $request->has('replace_images'), // First image is primary only if replacing all
                    'order' => $photo->images()->count() + $index
                ]);
            }
        }

        return redirect()->route('photos.index')->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }

    public function getPHotos() {
        $photos = Photo::all();
        //dd($photos);
        return view('welcome', compact('photos'));
   }
}
