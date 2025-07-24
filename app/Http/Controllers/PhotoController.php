<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\Photos\PhotosStoreRequest;
use App\Http\Requests\Photos\PhotosUpdateRequest;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::paginate(6);
        return view('photos.index', compact('photos'));
    }


    public function create()
    {
        return view('photos.create');
    }

    public function store(PhotosStoreRequest $request)
    {
        $request->validated();

        $slug = Str::slug($request->title);

        $paths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('photos', 'public');
            }
        }

        $photos = new Photo();
        $photos->title = $request->title;
        $photos->slug = $slug;
        $photos->caption = $request->caption;
        $photos->user_id = Auth::id();
        $photos->images = $paths;
        $photos->save();

        return redirect()->route('photos.index')->with('success', 'Photo(s) gallery created successfully.');
    }

    public function show($slug)
    {
        $photo = Photo::where('slug', $slug)->firstOrFail();

        return view('photos.show', compact('photo'));
    }

    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    public function update(PhotosUpdateRequest $request, Photo $photo)
    {
        $request->validated();

        $slug = Str::slug($request->title);

        $photo->update([
            'title' => $request->title,
            'slug' => $slug,
            'caption' => $request->caption,
        ]);

        $existingPaths = $photo->images ?? [];

        // If replace_images is checked, delete old ones
        if ($request->has('replace_images')) {
            foreach ($existingPaths as $image) {
                Storage::disk('public')->delete($image);
            }

            // Use only new images
            foreach ($request->file('images') as $image) {
                $newPaths[] = $image->store('photos', 'public');
            }

            $photo->update([
                'images' => $newPaths
            ]);
        } else {

            // Append new images to existing ones
            foreach ($request->file('images') as $image) {
                $newPaths[] = $image->store('photos', 'public');
            }

            $photo->update([
                'images' => array_merge($existingPaths, $newPaths)
            ]);
        }

        return redirect()->route('photos.index')->with('success', 'Photo updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }
}
